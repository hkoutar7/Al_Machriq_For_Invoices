<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\Invoice_attachment;
use App\Models\Invoice_detail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class InvoiceArchiveController extends Controller
{

    public function __construct() {
        $this->middleware('permission:archive-invoice', ['only' => ['index']]);
        $this->middleware('permission:restore-archive-invoice', ['only' => ['restoreInvoice']]);
        $this->middleware('permission:delete-archive-invoice', ['only' => ['destroy']]);
    }
    public function index()
    {
        $invoices = Invoice::onlyTrashed()->get();
        $numArchives = Invoice::onlyTrashed()->count();

        return view('invoices.archives',compact('invoices',"numArchives"));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }
    public function show($id)
    {
        //
    }

    public function edit(string $id)
    {
        //
    }

    public function update(Request $request, string $id)
    {
        //
    }

    public function restoreInvoice(Request $request)
    {
        Invoice::onlyTrashed()->where('id',$request->invoice_id)->restore();

        session()->flash('restoreArchive','تم ارجاع الفاتورة '.$request->invoice_number.' الى القائمة الرئيسية بنجاح');
        return redirect()->back();
    }

    public function destroy(Request $request)
    {
        $invoice = Invoice::onlyTrashed()->where('id',$request->invoice_id)->first();

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

        session()->flash('deleteInvoice',' تم حدف الفاتورة  '.$request->invoice_number.' بنجاح ');
        return redirect()->back();
    }


}
