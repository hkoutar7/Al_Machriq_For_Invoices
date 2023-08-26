@extends('layouts.master')

@section('title'," قائمة الفواتير المدفوعةجزئيا")

@section('css')
<link href="{{URL::asset('assets/plugins/datatable/css/dataTables.bootstrap4.min.css')}}" rel="stylesheet" />
<link href="{{URL::asset('assets/plugins/datatable/css/buttons.bootstrap4.min.css')}}" rel="stylesheet">
<link href="{{URL::asset('assets/plugins/datatable/css/responsive.bootstrap4.min.css')}}" rel="stylesheet" />
<link href="{{URL::asset('assets/plugins/datatable/css/jquery.dataTables.min.css')}}" rel="stylesheet">
<link href="{{URL::asset('assets/plugins/datatable/css/responsive.dataTables.min.css')}}" rel="stylesheet">
<link href="{{URL::asset('assets/plugins/select2/css/select2.min.css')}}" rel="stylesheet">
<link href="{{URL::asset('assets/plugins/fontawesome-free/css/all.min.css')}}" rel="stylesheet">
<link href="{{URL::asset('assets/plugins/notify/css/notifIt.css')}}" rel="stylesheet" />
<link href="{{URL::asset('assets/plugins/treeview/treeview.css')}}" rel="stylesheet" type="text/css" />

@endsection


@section('page-header')
<!-- Start breadcrumb -->
<div class="breadcrumb-header justify-content-between">

    <div class="my-auto">
        <div class="d-flex">
            <a href="{{ route("invoices.index") }}" class="content-title mb-0 my-auto"> الفواتير</a><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ قائمة الفواتير المدفوعةجزئيا</span>

        </div>
    </div>
</div>
<!-- End breadcrumb -->
@endsection


@section('content')

<div class="col-xl-12">
    <div class="card mg-b-20">
        <div class="card-header pb-0">
            <div class="d-flex justify-content-between">
                <h4 class="card-title mg-b-0">هنا قسم الفواتير </h4>
                <i class="mdi mdi-dots-horizontal text-gray"></i>
            </div>
            <p class="tx-12 tx-gray-500 mb-2">لمزيد من المعلومات زر اقسام الفواتير</p>
        </div>


        <div class="card-body">
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
        </div>
    </div>
</div>

{{-- Start Delete Product  --}}
<div class="modal" id="deleteInvoice">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content modal-content-demo">

            <div class="modal-header">
                <h6 class="modal-title">حذف الفاتورة</h6>
                <button aria-label="إغلاق" class="close" data-dismiss="modal" type="button">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form action="{{ route('invoices.destroy','test') }}" method="post" autocomplete="off">
                @csrf
                @method('delete')
                <div class="modal-body">
                    <div class="mb-3 mt-3">
                        <input type="hidden" name="invoice_id" id="invoice_id" value="">
                        <label for="invoice_number" class="form-label">اسم الفاتورة:</label>
                        <input type="text" class="form-control" id="invoice_number" name="invoice_number" value="" readonly>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn ripple btn-danger" type="button">حذف</button>
                    <button class="btn ripple btn-secondary" data-dismiss="modal" type="button">الغاء</button>
                </div>
            </form>

        </div>
    </div>
</div>
{{-- End Delete Product  --}}

{{-- Start Invoice Archive  --}}
<div class="modal" id="archiveInvoice">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content modal-content-demo">

            <div class="modal-header">
                <h6 class="modal-title">ارشفة الفاتورة</h6>
                <button aria-label="إغلاق" class="close" data-dismiss="modal" type="button">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form action="{{ route('invoices.destroy','test') }}" method="post" autocomplete="off">
                @csrf
                @method('delete')
                <div class="modal-body">
                    <div class="mb-3 mt-3">
                        <input type="hidden" name="type_page" value="80">
                        <input type="hidden" name="invoice_id" id="invoice_id" value="">
                        <label for="invoice_number" class="form-label">اسم الفاتورة:</label>
                        <input type="text" class="form-control" id="invoice_number" name="invoice_number" value="" readonly>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn ripple btn-danger" type="button">تاكيد الارشفة</button>
                    <button class="btn ripple btn-secondary" data-dismiss="modal" type="button">الغاء</button>
                </div>
            </form>

        </div>
    </div>
</div>
{{-- End Invoice Archive  --}}

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
<script src="{{URL::asset('assets/plugins/treeview/treeview.js')}}"></script>
<!--Internal  Notify js -->
<script src="{{URL::asset('assets/plugins/notify/js/notifIt.js')}}"></script>
<script src="{{URL::asset('assets/plugins/notify/js/notifit-custom.js')}}"></script>


<script>
    $('#deleteInvoice').on('show.bs.modal', function(event) {

        var button = $(event.relatedTarget)

        var invoice_number = button.data('invoice_number')
        var invoice_id = button.data('invoice_id')

        var modal = $(this)
        modal.find('.modal-body #invoice_id').val(invoice_id);
        modal.find('.modal-body #invoice_number').val(invoice_number);

    })

    $('#archiveInvoice').on('show.bs.modal', function(event) {

        var button = $(event.relatedTarget)

        var invoice_number = button.data('invoice_number')
        var invoice_id = button.data('invoice_id')

        var modal = $(this)
        modal.find('.modal-body #invoice_id').val(invoice_id);
        modal.find('.modal-body #invoice_number').val(invoice_number);

    })

</script>
@endsection
