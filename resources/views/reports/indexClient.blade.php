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
    @endif

    @if ($errors->any())
    <div style="position: absolute; left: 34px; z-index: 2; display: flex; flex-direction: column; width: 280px;">
        @foreach ($errors->all() as $error)
        <div class="alert alert-danger" role="alert" style="border-radius: 8px;}">

            <button aria-label="Close" class="close" data-dismiss="alert" type="button">
                <span aria-hidden="true">&nbsp; &nbsp; &times;</span>
            </button>
            <strong>خطا</strong>&nbsp; &nbsp; {{$error}}
        </div>
        @endforeach
    </div>
    @endif

    <div class="my-auto">
        <div class="d-flex">
            <h4 class="content-title mb-0 my-auto">التقارير</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ تقارير العملاء</span>
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
                    <h4 class="card-title mg-b-0" style="font-weight: 400;color: #9E9E9E;">هن يمكنك معاينة العملاء و الاطلاع على جميع العملاء</h4>
                    <i class="mdi mdi-dots-horizontal text-gray"></i>
                </div>
            </div>

            <div class="card-body">

                <form action="{{route('reportClient.searchClient')}}" method="post" autocomplete="off">
                    @csrf

                    <div class="row row-sm mt-3 mb-4">
                        <div class="col-lg">
                            <label for="section">القسم</label>
                            <select id="section" name="section" class="SlectBox form-control">
                                <option value="" disabled selected>اختر قسم من الاقسام التالية </option>
                                @foreach($sections as $section)
                                <option value={{$section->id}}>
                                    {{$section->section_name }}
                                </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-lg">
                            <label for="product">المنتج</label>
                            <select id="product" name="product" class="form-control">
                            </select>
                        </div>

                        <div class="col-lg mg-t-10 mg-lg-t-0">
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

                        <div class="col-lg mg-t-10 mg-lg-t-0">
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
                    </div>

                    <button type="submit" class="btn btn-outline-primary mb-4" style="width: 100px">بحث</button>
                </form>

                @isset($invoices)
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

                @endisset





            </div>
        </div>
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

{{-- my script  --}}
<script src="{{asset('script\invoice\sectionProduct.js')}}"></script>

<script>
    var date = $('.fc-datepicker').datepicker({
        dateFormat: 'yy-mm-dd'
    }).val();

</script>

@endsection
