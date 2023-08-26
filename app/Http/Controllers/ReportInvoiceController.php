<?php

namespace App\Http\Controllers;

use App\Http\Requests\SearchReportClientRequest;
use App\Models\Invoice;
use App\Models\Product;
use App\Models\Section;
use Illuminate\Http\Request;

class ReportInvoiceController extends Controller
{
    public  function index(){

        return view('reports.index');
    }

    public function search(Request $request){

        $choice = $request->rdioChoice;

        // filtering based on type of invoice :
        if ($choice == 1)
        {
            $typeInv = $request->invoice_type;
            $startDate = $request->invoice_date_start;
            $endDate = $request->invoice_date_end;

            if ( isset($startDate) && isset($endDate) )
            {
                if ( $typeInv == 0 || $typeInv == 1 || $typeInv == 2){
                    $invoices = Invoice::select('*')->whereBetween('invoice_date', [$startDate, $endDate])
                    ->where('value_status','=',$typeInv)->get();

                    return view('reports.index', compact('invoices','typeInv','startDate','endDate'));
                }

                $invoices = Invoice::select('*')->whereBetween('invoice_date', [$startDate, $endDate])->get();
                return  view('reports.index', compact('invoices','typeInv','startDate','endDate'));
            }
            else if ( isset($startDate) || isset($endDate)) {

                session()->flash('error_date', 'المرجو ادخال تاريخ البداية و النهاية');
                return  view('reports.index', compact('typeInv'));
            }
            else {

                if ( $typeInv == 0 || $typeInv == 1 || $typeInv == 2){
                    $invoices = Invoice::select('*')->where('value_status','=',$typeInv)->get();

                    return view('reports.index', compact('invoices','typeInv'));
                }

                $invoices = Invoice::select('*')->get();
                return  view('reports.index', compact('invoices','typeInv'));

            }
        }

        //filtering based on invoice number :
        else if ($choice == 2)
        {

            $request->validate([
                'invoice_numb' => 'required|max:255',
            ], [
                'invoice_numb.required' => 'رقم الفاتورة مطلوب',
                'invoice_numb.max' => 'رقم الفاتورة يجب ألا يتجاوز :max حرف',
            ]);


            $invoice_number = $request->invoice_numb;

            $invoices = Invoice::where('invoice_number','=',$invoice_number)->get();

            return  view('reports.index', compact('invoices'));
        }

    }


    public function showClient(){

        $sections = Section::all();
        return view('reports.indexClient',compact('sections'));
    }

    public function searchClient(SearchReportClientRequest $request){

        $sections = Section::all();

        $product = Product::where('id','=',$request->product)->pluck('product_name')[0];
        $startDate = $request->invoice_date_start;
        $endDate = $request->invoice_date_end;
        $prod = $request->product;
        $sect = $request->section;

        if (isset($startDate) && isset($endDate))
        {
            $invoices = Invoice::select('*')->whereBetween('invoice_date', [$startDate, $endDate])
                ->where('section_id',$request->section)->where('product',$product)->get();
            return view('reports.indexClient',compact('sections','sect','prod','startDate','endDate','invoices'));
        }
        else if (!isset($startDate) && !isset($endDate))
        {
            $invoices = Invoice::select('*')->where('section_id',$request->section)->where('product',$product)->get();
            return view('reports.indexClient',compact('sections','sect','prod','invoices'));
        }
        else {
            
            session()->flash('error_date', 'المرجو ادخال تاريخ البداية و النهاية');
            return view('reports.indexClient',compact('sections'));
        }
    }

}
