<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreInvoiceRequest;
use App\Models\Invoice;
use App\Models\Invoice_attachment;
use App\Models\Invoice_detail;
use App\Models\Section;
use App\Models\User;
use App\Notifications\AddInvoice;
use App\Notifications\InvoicePaidNotif;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Notification;

use function PHPUnit\Framework\isEmpty;

class InvoiceController extends Controller
{
    public function __construct() {
        $this->middleware('permission:invoice-principal', ['only' => ['index']]);
        $this->middleware('permission:add-invoice', ['only' => ['create','store']]);
        $this->middleware('permission:edit-invoice', ['only' => ['edit','update']]);
        $this->middleware('permission:delete-invoice', ['only' => ['destroy']]);
        $this->middleware('permission:change-payment-invoice', ['only' => ['editStatus','updateStatus']]);
        $this->middleware('permission:invoice-paid', ['only' => ['getPaidInvoice']]);
        $this->middleware('permission:invoice-unpaid', ['only' => ['getUnpaidInvoice']]);
        $this->middleware('permission:invoice-halfpaid', ['only' => ['getHalfpaidInvoice']]);
        $this->middleware('permission:print-invoice', ['only' => ['printInvoice']]);
    }

    public function index()
    {
        $invoices = Invoice::all();
        if (!$invoices) {
            abort(404);
        }
        return view("invoices.index",compact("invoices"));
    }

    public function create()
    {
        $sections = Section::all();
        return view("invoices.create",compact('sections'));
    }

    public function store(StoreInvoiceRequest $request)
    {
        $product_name = DB::table('products')->where('id',$request->product)->first()->product_name;

        // Invoice Table :
        Invoice::create([
            "invoice_number" => $request->invoice_number ,
            "invoice_date" => $request->invoice_date ,
            "due_date" => $request->due_date ,
            'section_id' => $request-> section,
            "product" => $product_name,
            'amount_collection' => $request->amount_collection ,
            'amount_commission' => $request->amount_commission ,
            "discount" => $request->discount ,
            "rate_vat" => $request->rate_vat ,
            "value_vat" => $request->value_vat ,
            "total" => $request->total ,
            "note" => $request->note ,
            "value_status" => '0' ,
            "user_id" => auth()->user()->id ,
        ]);

        $inv_id = DB::table('invoices')->latest()->first()->id;
        $section_name = DB::table('sections')->where('id',$request->section)->first()->section_name;

        // Invoice Details :
        Invoice_detail::create([
            'invoice_number'  => $request->invoice_number  ,
            'product' => $product_name  ,
            'section' => $section_name  ,
            'value_Status' => '0'  ,
            'note' => $request->note  ,
            'created_by' => userName()  ,
            'invoice_id' => $inv_id,
        ]);

        //Invoice Attachments:

        if ($request->has('media')  ){

            $file = $request->file('media');

            $fileName = $file->hashName();

            Invoice_attachment::create([
                'invoice_number' => $request->invoice_number  ,
                'file_name' => $fileName  ,
                'created_by' => userName()  ,
                'invoice_id' => $inv_id  ,
            ]);

            $request->file('media')->storeAs('/'.$request->invoice_number,$fileName,'myDisk');
        }

        // create notification : AddNotification :
        $delay = now()->addMinutes(1);
        $users = User::where('id','!=',userID())->get();

        $userName = userName();
        $invoice_created = DB::table('invoices')->latest()->first()->created_at;
        $invoice_name = $request->invoice_number;

        Notification::send($users, new AddInvoice($inv_id,$userName,$invoice_created,$invoice_name));


        session()->flash('created','تمت اضافة الفاتورة بنجاح');
        return redirect()->back();
    }

    public function show(Invoice $invoice)
    {
        //
    }

    public function edit($id)
    {
        $invoice = Invoice::find($id);
        $sections = Section::all();

        return view('invoices.edit',compact('invoice','sections'));
    }

    public function update(Request $request, $id)
    {
        $product_name = DB::table('products')->where('id',$request->product)->first()->product_name;
        $invoice = Invoice::findOrFail($id);

        $invoice->update([
            'invoice_number' => $request->invoice_number,
            'invoice_date' => $request->invoice_date,
            'due_date' => $request->due_date,
            'product' => $product_name,
            'amount_collection' => $request->amount_collection,
            'amount_commission' => $request->amount_commission,
            'discount' => $request->discount,
            'rate_vat' => $request->rate_vat,
            'value_vat' => $request->value_vat,
            'total' => $request->total,
            'note' => $request->note,
            'section_id' => $request->section,
            'user_id' => userID(),
            'updated_at' => now(),
        ]);

        $section_name = DB::table('sections')->where('id',$request->section)->first()->section_name;

        $invoicesDetails = Invoice_detail::where('invoice_id',$id)->get();

        foreach ($invoicesDetails as $invoiceDetail) {

            $invoiceDetail->update([
                'invoice_number' => $request->invoice_number,
                'product' => $product_name,
                'section' => $section_name,
                'note' => $invoice->note,
                'created_by' => userName(),
                'updated_at' => now(),
            ]);
        }

        $invoicesAttachments = Invoice_attachment::where('invoice_id',$id)->get();

        foreach ($invoicesAttachments as $invoiceAttachment){

            $invoiceAttachment->update([
                'invoice_number' => $request->invoice_number,
                'updated_at' => now(),
            ]);

        }

        session()->flash('update-success','تم تعديل الفاتورة بنجاح');
        return redirect()->route('invoicesDetails.getDetails',$id);
    }

    public function destroy(Request $request)
    {
        if ($request->has('type_page') && $request->type_page == '80')
        {
            $invoice = Invoice::find($request->invoice_id);
            $invoice->delete();

            session()->flash('archiveInvoice',' تمت ارشفة '.$request->invoice_number.' بنجاح');
            return redirect()->back();
        }
        else
        {
            $invoice = Invoice::find($request->invoice_id);

            Invoice_detail::where('invoice_id',$request->invoice_id)->delete();

            $invAttach = Invoice_attachment::where('invoice_id',$request->invoice_id)->first();

            if ( !empty( $invAttach ))
            {
                Storage::disk('myDisk')->deleteDirectory($invAttach->invoice_number);

                $invoiceAttachs = Invoice_attachment::where('invoice_id',$request->invoice_id)->get();

                foreach($invoiceAttachs as $att)
                    $att->delete();
            }

            $invoice->forceDelete();

            session()->flash('deleteInvoice','تم حدف الفاتورة '.$request->invoice_number.' بنجاح');
            return redirect()->back();
        }
    }


    public function editStatus($invoice_id){

        $invoice = Invoice::findOrFail($invoice_id);
        if (!$invoice)
            abort(404);

        return view('invoices.changeStatus', compact("invoice"));
    }


    public function updateStatus(Request $req){

        $invoice = Invoice::findOrFail($req->id);
        $invoice->value_status = $req->value_status;
        $invoice->payment_date = $req->payment_date;
        $invoice->save();

        if ($req->value_status == '1')       //partial
        {

            $invoice_detail =  Invoice_detail::where('invoice_id', $req->id)->first();
            Invoice_detail::create([
                'invoice_id' => $req->id,
                'invoice_number' => $invoice_detail->invoice_number,
                'product' => $invoice_detail->product,
                'section'  => $invoice_detail->section ,
                'note' => $invoice_detail-> note,
                'value_Status' => $req->value_status,
                'payment_date' => $req->payment_date,
                'created_by' => userName(),
            ]);

        }
        else if ($req->value_status == 2)   // all
        {
            $invoice_detail =  Invoice_detail::where('invoice_id', $req->id)->first();
            Invoice_detail::create([
                'invoice_id' => $req->id,
                'invoice_number' => $invoice_detail->invoice_number,
                'product' => $invoice_detail->product,
                'section'  => $invoice_detail->section ,
                'note' => $invoice_detail-> note,
                'value_Status' => $req->value_status,
                'payment_date' => $req->payment_date,
                'created_by' => userName(),
            ]);
        }
        else
            return view('404');

        $URL = url('/invoicesDetails/getDetails/'.$req->id);
        $invoice_name = $invoice_detail->invoice_number;
        $user = Auth::user();
        Notification::send($user, new InvoicePaidNotif($URL, $invoice_name) );

        session()->flash('emailPaymentInvoice','تم ارسال الاشعار تحقق من اميلك');
        session()->flash('paymentInvoice', '  تم تسديد الفاتورة  '.$invoice_detail->invoice_number.' بتوقيت '.date('h:i:s a'));
        return redirect()->route('invoicesDetails.getDetails',$req->id);
    }


    public function getPaidInvoice()
    {
        $invoices = Invoice::where('value_status','2')->get();

        return view('invoices.paidInvoices',compact('invoices'));
    }

    public function getUnpaidInvoice()
    {
        $invoices = Invoice::where('value_status','0')->get();

        return view('invoices.unpaidInvoices',compact('invoices'));
    }

    public function getHalfpaidInvoice()
    {
        $invoices = Invoice::where('value_status','1')->get();

        return view('invoices.halfpaidInvoices',compact('invoices'));
    }

    public function printInvoice($idInvoice){

        $invoice = Invoice::findOrFail($idInvoice);

        return view('invoices.printInvoice', compact('invoice'));
    }
}
