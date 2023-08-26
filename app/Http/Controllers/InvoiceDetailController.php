<?php

namespace App\Http\Controllers;

use App\Exports\InvoiceExport;
use App\Exports\UsersExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\Invoice;
use App\Models\Invoice_attachment;
use App\Models\Invoice_detail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use File;
class InvoiceDetailController extends Controller
{
    public function __construct() {
        $this->middleware('permission:add-file-invoice', ['only' => ['store']]);
        $this->middleware('permission:delete-file-invoice', ['only' => ['destroy']]);
        $this->middleware('permission:detail-invoice', ['only' => ['getDetail']]);
        $this->middleware('permission:show-file-invoice', ['only' => ['showFile']]);
        $this->middleware('permission:download-file-invoice', ['only' => ['downloadFile']]);
        $this->middleware('permission:exportXML-invoice', ['only' => ['export']]);
    }

    public function index()
    {

    }

    public function create()
    {

    }

    public function store(Request $request)
    {
        $request->validate([
            'media' => 'required|mimes:jpg,png,pdf',
        ],[
            'media.required' => 'حقل الملف مطلوب.',
            'media.mimes' => 'نوع الملف يجب أن يكون JPG أو PNG أو PDF.',
        ]);

        if ( $request->has('media')){

            $file = $request->file('media');
            $fileName = $file->hashName();

            Invoice_attachment::create([
                'invoice_number' => $request->invoice_number ,
                'file_name' => $fileName,
                'created_by' => userName(),
                'invoice_id' => $request->invoice_id,
            ]);

            $request->file('media')->storeAs('/'.$request->invoice_number,$fileName,'myDisk');

            session()->flash('add_file_success','تمت اضافة الملحق بنجاح');
            return redirect()->back();
        }

        session()->flash('error_add_file','حدث خطا اثناء محاولة اضافة الملف');
        return redirect()->back();
    }

    public function show(Invoice_detail $invoice_detail)
    {
        //
    }

    public function edit(Invoice_detail $invoice_detail)
    {
        //
    }

    public function update(Request $request, Invoice_detail $invoice_detail)
    {
        //
    }

    public function destroy(Request $request)
    {
        $invoiceFile = Invoice_attachment::where('id',$request->id)->first();
        $invoiceFile->delete();

        $isExists = Storage::disk('myDisk')->exists($request->invoice_number.'/'.$request->file_name);

        if ($isExists){
            Storage::disk('myDisk')->delete($request->invoice_number.'/'.$request->file_name);
            session()->flash('deleted', 'تم حدف الملف  '.' بنجاح ');
        }
        else
            session()->flash('deleted', 'لا يوجد هدا الملف ');

        return redirect()->back();
    }

    public function getDetail($id){

        $invoice = Invoice::withTrashed()->where("id",$id)->first();
        $invoice_detail = Invoice_detail::where('invoice_id',$id)->get();
        $attachment = Invoice_attachment::where('invoice_id',$id)->get();

        if (Invoice_attachment::where('invoice_id',$id)->first())
            $id_user = User::where('name', Invoice_attachment::where('invoice_id',$id)->first()->created_by )->first()->id;
        else
            $id_user = NUll;

        return view('invoices.details',compact('invoice','invoice_detail','attachment',"id_user"));
    }

    public function showFile($idInvoice, $idfile){

        $filePath = Storage::disk('myDisk')->path($idInvoice.'/'.$idfile);

        $isExists = Storage::disk('myDisk')->exists($idInvoice.'/'.$idfile);
        if ($isExists)

            return response()->file($filePath);

    }

    public function downloadFile($idInvoice, $fileName){

        $filePath = Storage::disk('myDisk')->path($idInvoice . '/' . $fileName);

        if (Storage::disk('myDisk')->exists($idInvoice . '/' . $fileName))
            return response()->download($filePath);

        return '"' . $idInvoice . '/' . $fileName . '"' . " doesn't exist";
    }

    public function export()
    {
        Excel::store(new InvoiceExport, 'invoices.xlsx', 'excelDisk');
        return Excel::download(new InvoiceExport, 'invoices.xlsx');
    }


}
