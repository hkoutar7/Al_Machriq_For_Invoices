@extends('layouts.master')

@section('title','تقارير الفواتير')

@section('css')
<link href="{{URL::asset('assets/plugins/datatable/css/dataTables.bootstrap4.min.css')}}" rel="stylesheet" />
<link href="{{URL::asset('assets/plugins/datatable/css/buttons.bootstrap4.min.css')}}" rel="stylesheet">
<link href="{{URL::asset('assets/plugins/datatable/css/responsive.bootstrap4.min.css')}}" rel="stylesheet" />
<link href="{{URL::asset('assets/plugins/datatable/css/jquery.dataTables.min.css')}}" rel="stylesheet">
<link href="{{URL::asset('assets/plugins/datatable/css/responsive.dataTables.min.css')}}" rel="stylesheet">
<link href="{{URL::asset('assets/plugins/select2/css/select2.min.css')}}" rel="stylesheet">
<link href="{{URL::asset('assets/plugins/select2/css/select2.min.css')}}" rel="stylesheet">
<link href="{{URL::asset('assets/plugins/amazeui-datetimepicker/css/amazeui.datetimepicker.css')}}" rel="stylesheet">
<link href="{{URL::asset('assets/plugins/jquery-simple-datetimepicker/jquery.simple-dtpicker.css')}}" rel="stylesheet">
<link href="{{URL::asset('assets/plugins/pickerjs/picker.min.css')}}" rel="stylesheet">

@endsection


@section('page-header')

<!-- breadcrumb -->
<div class="breadcrumb-header justify-content-between">

    @if(session()->has("error_date"))
    <div class="alert alert-danger" role="alert" style="position: absolute; top: 77px; left: 37px; border-radius: 9px;">
        <button aria-label="Close" class="close" data-dismiss="alert" type="button">
            <span aria-hidden="true"> &nbsp; &nbsp;&times;</span>
        </button>
        <strong>خطا</strong>&nbsp; &nbsp; {{session()->get("error_date")}}
    </div>
    @php
    session()->forget('error_date');
    @endphp
    @endif

    <div class="my-auto">
        <div class="d-flex">
            <h4 class="content-title mb-0 my-auto">التقارير</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ تقارير الفواتير</span>
        </div>
    </div>

</div>
<!-- breadcrumb -->
@endsection


@section('content')
<!-- row -->
<div class="row">
    <div class="col-xl-12">

        <div class="card">
            <div class="card-header pb-0">
                <div class="d-flex justify-content-between">
                    <h4 class="card-title mg-b-0" style="font-weight: 400;color: #9E9E9E;">هن يمكنك معاينة الفواتير و الاطلاع على جميع الفواتير</h4>
                    <i class="mdi mdi-dots-horizontal text-gray"></i>
                </div>
            </div>

            <div class="card-body">

                <form action="{{ route('searchInvoice') }}" method="post" autocomplete="off" style="margin-bottom: 40px;">

                    @csrf

                    <div i class="row mg-t-10" style="flex-direction: column; gap: 3px; margin-bottom: 45px;">
                        <div class="col-lg-3">
                            <label class="rdiobox">
                                <input checked name="rdioChoice" type="radio" value="1" onchange="pickerInvoiceSelector(1)"> <span>بحث بنوع الفاتوة</span>
                            </label>
                        </div>
                        <div class="col-lg-3 mg-t-20 mg-lg-t-0">
                            <label class="rdiobox">
                                <input name="rdioChoice" type="radio" value="2" onchange="pickerInvoiceSelector(2)"> <span>بحث برقم الفاتورة</span>
                            </label>
                        </div>
                    </div>

                    <div class="row row-sm mb-4" style="width : 100%">

                        <div id="inv-type" class="col-lg-4 mg-t-20 mg-lg-t-0">
                            <label for="invoice_type" class="mg-b-10">نوع الفواتير</label>
                            <select name="invoice_type" id="invoice_type" class="form-control select2">
                                @if (isset($typeInv))
                                <option value="-1" disabled>اختر نوع من الفواتير</option>
                                <option value="0" @if ($typeInv==0) selected @endif>الفواتير الغير المدفوعة</option>
                                <option value="1" @if ($typeInv==1) selected @endif>الفواتير المدفوعة جزئيا</option>
                                <option value="2" @if ($typeInv==2) selected @endif>الفواتير المدفوعة كليا</option>
                                <option value="3" @if ($typeInv==3) selected @endif>كل الفواتير</option>
                                @else
                                <option value="-1" disabled>اختر نوع من الفواتير</option>
                                <option value="0">الفواتير الغير المدفوعة</option>
                                <option value="1">الفواتير المدفوعة جزئيا</option>
                                <option value="2">الفواتير المدفوعة كليا</option>
                                <option value="3" selected>كل الفواتير</option>
                                @endif
                            </select>

                        </div>

                        <div id="inv-date-start" class="col-lg mg-t-10 mg-lg-t-0">
                            <label for="invoice_date_start">من تاريخ الاصدار</label>
                            <div>
                                <div class="input-group ">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">
                                            <i class="typcn typcn-calendar-outline tx-24 lh--9 op-6"></i>
                                        </div>
                                    </div>
                                    <input id="invoice_date_start" name='invoice_date_start' class="form-control fc-datepicker" placeholder="MM/DD/YYYY" type="text" value="{{$startDate ?? ''}}">
                                </div>
                            </div>
                        </div>

                        <div id="inv-date-end" class="col-lg mg-t-10 mg-lg-t-0">
                            <label for="invoice_date_end">الى تاريخ</label>
                            <div>
                                <div class="input-group ">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">
                                            <i class="typcn typcn-calendar-outline tx-24 lh--9 op-6"></i>
                                        </div>
                                    </div>
                                    <input id="invoice_date_end" name="invoice_date_end" class="form-control fc-datepicker" placeholder="MM/DD/YYYY" type="text" value="{{ $endDate ?? '' }}">
                                </div>
                            </div>
                        </div>

                        <div id="inv-number" style="display : none" class="col-lg-4 mg-t-20 mg-lg-t-0">
                            <div>
                                <label for="invoice_numb" class="mg-b-10" style="font-weight: 600;color: #3895e7;">البحث برقم الفاتورة</label>
                                <input id="invoice_numb" name="invoice_numb" class="form-control mg-b-20" placeholder="مرجو ادخال اسم الفاتورة" type="text" class="@error('invoice_numb') is-invalid @enderror">
                                @error('invoice_numb')
                                <div class="alert alert-danger" role="alert" style="margin-top: -11px; border-radius: 9px;">
                                    <button aria-label="Close" class="close" data-dismiss="alert" type="button">
                                        <span aria-hidden="true"> &nbsp; &nbsp;&times;</span>
                                    </button>
                                    <strong>خطا</strong>&nbsp; &nbsp; {{$message}}
                                </div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-outline-primary" style="width: 100px">بحث</button>
                </form>

                @if(isset($invoices))

                <div class="table-responsive">
                    <table id="example" class="table key-buttons text-md-nowrap">
                        <thead>
                            <tr>
                                <th class="border-bottom-0">#</th>
                                <th class="border-bottom-0">رقم الفاتورة</th>
                                <th class="border-bottom-0">تاريخ الفاتورة</th>
                                <th class="border-bottom-0">تاريخ الاستحقاق</th>
                                <th class="border-bottom-0">القسم</th>
                                <th class="border-bottom-0">المنتج</th>
                                <th class="border-bottom-0">الخصم</th>
                                <th class="border-bottom-0">نسبة الضريبة</th>
                                <th class="border-bottom-0">قيمة الضربة</th>
                                <th class="border-bottom-0">الاجمالي</th>
                                <th class="border-bottom-0">الحالة</th>
                                <th class="border-bottom-0">الملاحظات</th>
                                <th class="border-bottom-0">العمليات</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                            $i = 0;
                            @endphp
                            @foreach($invoices as $invoice)
                            <tr>
                                <td>{{ ++$i }}</td>
                                <td>{{$invoice->invoice_number}}</td>
                                <td>{{$invoice->invoice_date}}</td>
                                <td>{{$invoice->due_date}}</td>
                                <td>
                                    @can('detail-invoice')
                                    <a href="{{url("/invoicesDetails/getDetails/$invoice->id") }}">{{$invoice->section->section_name}}</a>
                                    @endcan
                                </td>
                                <td>{{$invoice->product}}</td>
                                <td>{{$invoice->discount}}</td>
                                <td>{{$invoice->rate_vat}}</td>
                                <td>{{$invoice->value_vat}}</td>
                                <td>{{$invoice->total}}</td>
                                <td>
                                    @switch($invoice->value_status)
                                    @case('0')
                                    <span class="text-danger">غير مدفوع</span>
                                    @break
                                    @case('1')
                                    <span style="color: goldenrod">مدفوع جزئيا</span>
                                    @break
                                    @case('2')
                                    <span class="text-success">مدفوع بالكامل</span>
                                    @break
                                    @default
                                    <span class="text-success">خطأ</span>
                                    @break
                                    @endswitch
                                </td>
                                <td>
                                    @if($invoice->note)
                                    {{$invoice->note}}
                                    @else
                                    <span class="text-danger">لا توجد اي ملاحظة</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="dropdown" style="display: inline-block;">
                                        <button aria-expanded="false" aria-haspopup="true" class="btn ripple btn-secondary" data-toggle="dropdown" type="button">قائمة العمليات &nbsp;&nbsp;
                                            <i class="fas fa-caret-down ml-1"></i>
                                        </button>
                                        <div class="dropdown-menu tx-13">
                                            <h6 class="dropdown-header tx-uppercase tx-11 tx-bold tx-inverse tx-spacing-1"> المرجو الاختيار</h6>
                                            @can('change-payment-invoice')
                                            <a class="dropdown-item" href="{{route("invoices.editStatus",$invoice->id)}}">
                                                <i class="fa fa-file-invoice"></i>&nbsp;&nbsp;تغيير حالة الدفع
                                            </a>
                                            @endcan
                                            @can('edit-invoice')
                                            <a class="dropdown-item" href="{{route("invoices.edit",$invoice->id)}}">
                                                <i class="fa fa-pen"></i>&nbsp;&nbsp;تعديل
                                            </a>
                                            @endcan
                                            @can('print-invoice')
                                            <a class="dropdown-item" href="{{  route('invoices.printInvoice', ['id' => $invoice->id]) }}">
                                                <i class="fa fa-print"></i>&nbsp;&nbsp;طباعة
                                            </a>
                                            @endcan
                                            @can('delete-invoice')
                                            <a class="dropdown-item modal-effect" href="#deleteInvoice" data-invoice_id='{{$invoice->id}}' data-invoice_number='{{$invoice->invoice_number}}' data-effect="effect-scale" data-toggle="modal">
                                                <i class="las la-trash"></i> &nbsp;&nbsp;حذف
                                            </a>
                                            @endcan
                                            @can('archive-invoice')
                                            <a class="dropdown-item modal-effect" href="#archiveInvoice" data-invoice_id='{{$invoice->id}}' data-invoice_number='{{$invoice->invoice_number}}' data-effect="effect-scale" data-toggle="modal">
                                                <i class="fa fa-ban"></i> &nbsp;&nbsp;ارشفة
                                            </a>
                                            @endcan
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                @endif




            </div><!-- bd -->
        </div><!-- bd -->
    </div>


</div>
<!-- row closed -->
</div>
<!-- Container closed -->
</div>
<!-- main-content closed -->
@endsection



@section('js')
<script src="{{URL::asset('assets/plugins/datatable/js/jquery.dataTables.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/dataTables.dataTables.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/dataTables.responsive.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/responsive.dataTables.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/jquery.dataTables.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/dataTables.bootstrap4.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/dataTables.buttons.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/buttons.bootstrap4.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/jszip.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/pdfmake.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/vfs_fonts.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/buttons.html5.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/buttons.print.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/buttons.colVis.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/dataTables.responsive.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/responsive.bootstrap4.min.js')}}"></script>
<script src="{{URL::asset('assets/js/table-data.js')}}"></script>
<script src="{{URL::asset('assets/plugins/select2/js/select2.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/jquery-ui/ui/widgets/datepicker.js')}}"></script>
<script src="{{URL::asset('assets/plugins/jquery.maskedinput/jquery.maskedinput.js')}}"></script>
<script src="{{URL::asset('assets/plugins/spectrum-colorpicker/spectrum.js')}}"></script>
<script src="{{URL::asset('assets/plugins/select2/js/select2.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/ion-rangeslider/js/ion.rangeSlider.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/amazeui-datetimepicker/js/amazeui.datetimepicker.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/jquery-simple-datetimepicker/jquery.simple-dtpicker.js')}}"></script>
<script src="{{URL::asset('assets/plugins/pickerjs/picker.min.js')}}"></script>
<script src="{{URL::asset('assets/js/form-elements.js')}}"></script>


<script>
    var date = $('.fc-datepicker').datepicker({
        dateFormat: 'yy-mm-dd'
    }).val();

</script>

<script src="{{  asset('script/reports/reportInvoice.js') }}" defer></script>



@endsection
