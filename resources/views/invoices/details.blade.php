@extends('layouts.master')

@section('css')
<link href="{{URL::asset('assets/plugins/prism/prism.css')}}" rel="stylesheet">
<link href="{{URL::asset('assets/plugins/inputtags/inputtags.css')}}" rel="stylesheet">
<link href="{{URL::asset('assets/plugins/custom-scroll/jquery.mCustomScrollbar.css')}}" rel="stylesheet">
<link href="{{URL::asset('assets/plugins/owl-carousel/owl.carousel.css')}}" rel="stylesheet">
<link href="{{URL::asset('assets/plugins/multislider/multislider.css')}}" rel="stylesheet">
<link href="{{URL::asset('assets/plugins/select2/css/select2.min.css')}}" rel="stylesheet">
<link href="{{URL::asset('assets/plugins/select2/css/select2.min.css')}}" rel="stylesheet">
<link href="{{URL::asset('assets/plugins/fileuploads/css/fileupload.css')}}" rel="stylesheet" type="text/css" />
<link href="{{URL::asset('assets/plugins/fancyuploder/fancy_fileupload.css')}}" rel="stylesheet" />
<link rel="stylesheet" href="{{URL::asset('assets/plugins/sumoselect/sumoselect-rtl.css')}}">
<link rel="stylesheet" href="{{URL::asset('assets/plugins/telephoneinput/telephoneinput-rtl.css')}}">

<style>
    .spe {
        font-size: 16px;
        text-align: center;
        font-weight: 600 !important;
        background-color: #ecf0fa;
    }

</style>
@endsection

@section('page-header')
<!-- breadcrumb -->
<div class="breadcrumb-header justify-content-between">

    @if(session()->has("emailPaymentInvoice"))
    <script>
        window.onload = function() {
            notif({
                msg: "تم ارسال الاشعار تحقق من اميلك"
                , type: "success",

            })
        }

    </script>
    @endif

    @if(session()->has("deleted"))
    <div class="alert alert-success" role="alert" style="position: absolute; top: 77px; left: 37px; border-radius: 9px;">
        <button aria-label="Close" class="close" data-dismiss="alert" type="button">
            <span aria-hidden="true"> &nbsp; &nbsp;&times;</span>
        </button>
        <strong>نجاح</strong>&nbsp; &nbsp; {{session()->get("deleted")}}
    </div>
    @endif

    @if(session()->has("add_file_success"))
    <div class="alert alert-success" role="alert" style="position: absolute; top: 77px; left: 37px; border-radius: 9px;">
        <button aria-label="Close" class="close" data-dismiss="alert" type="button">
            <span aria-hidden="true"> &nbsp; &nbsp;&times;</span>
        </button>
        <strong>نجاح</strong>&nbsp; &nbsp; {{session()->get("add_file_success")}}
    </div>
    @endif

    @if(session()->has("error_add_file"))
    <div class="alert alert-danger" role="alert" style="position: absolute; top: 77px; left: 37px; border-radius: 9px;">
        <button aria-label="Close" class="close" data-dismiss="alert" type="button">
            <span aria-hidden="true"> &nbsp; &nbsp;&times;</span>
        </button>
        <strong>خطا</strong>&nbsp; &nbsp; {{session()->get("error_add_file")}}
    </div>
    @endif

    @if(session()->has("paymentInvoice"))
    <div class="alert alert-success" role="alert" style="position: absolute; top: 77px; left: 37px; border-radius: 9px;">
        <button aria-label="Close" class="close" data-dismiss="alert" type="button">
            <span aria-hidden="true"> &nbsp; &nbsp;&times;</span>
        </button>
        <strong>نجاح</strong>&nbsp; &nbsp; {{session()->get("paymentInvoice")}}
    </div>
    @endif

    @if(session()->has("update-success"))
    <div class="alert alert-success" role="alert" style="position: absolute; top: 77px; left: 37px; border-radius: 9px;">
        <button aria-label="Close" class="close" data-dismiss="alert" type="button">
            <span aria-hidden="true"> &nbsp; &nbsp;&times;</span>
        </button>
        <strong>نجاح</strong>&nbsp; &nbsp; {{session()->get("update-success")}}
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
            <a href="{{ route("invoices.index") }}" class="content-title mb-0 my-auto"> الفواتير</a>
            <span class="text-muted mt-1 tx-13 mr-2 mb-0">/ معلومات مفصلة عن
                <span style="display: inline-block; transform: translateY(2px); font-size: 15px; letter-spacing: 1px;}">{{ $invoice->invoice_number }}</span>
            </span>
        </div>
    </div>

</div>
<!-- breadcrumb -->
@endsection


@section('content')
<!-- row -->
<div class="row" style="background-color: #FFF; border-radius: 6px; border-top: 3px solid #2196F3; box-shadow: -3px 5px 12px 0px #5c5c5c47;">

    <div class="text-wrap" style="flex-grow: 1;">
        <div class="example">

            <div class="card-header pb-0" style="margin-bottom: 40px;">
                <div class="d-flex justify-content-between">
                    <h4 class="card-title mg-b-0">هنا معلومات مفصلة عن الفاتورة {{ $invoice->invoice_number }}</h4>
                    <i class="mdi mdi-dots-horizontal text-gray"></i>
                </div>
                <p class="tx-12 tx-gray-500 mb-2">لمزيد من المعلومات زر اقسام الفواتير</p>
            </div>

            <div class="panel panel-primary tabs-style-2">
                <div class=" tab-menu-heading">
                    <div class="tabs-menu1">
                        <!-- Tabs -->
                        <ul class="nav panel-tabs main-nav-line">
                            <li><a href="#infoInvoice" class="nav-link active" data-toggle="tab">معلومات الفاتورة</a></li>
                            <li><a href="#stausPayment" class="nav-link" data-toggle="tab">حالات الدفع</a></li>
                            @can('list-file-invoice')
                            <li><a href="#attachments" class="nav-link" data-toggle="tab">المرفقات</a></li>
                            @endcan
                        </ul>
                    </div>
                </div>
                <div class="panel-body tabs-menu-body main-content-body-right border">
                    <div class="tab-content">

                        <div class="tab-pane active" id="infoInvoice">
                            <div class="table-responsive">
                                <table class="table  table-responsive mg-b-0">
                                    <tbody>
                                        <tr>
                                            <th class="spe">رقم الفاتورة</th>
                                            <td>{{ $invoice->invoice_number }}</td>
                                            <th class="spe">تاريخ الفاتورة</th>
                                            <td>{{ $invoice->invoice_date }}</td>
                                            <th class="spe">تاريخ الاستحقاق</th>
                                            <td>{{ $invoice->due_date }}</td>
                                            <th class="spe">اسم القسم</th>
                                            <td>{{ $invoice->section->section_name }}</td>
                                            <th class="spe">اسم المنتج</th>
                                            <td>{{ $invoice->product }}</td>
                                        </tr>
                                        <tr>
                                            <th class="spe">مبلغ التحصيل</th>
                                            <td>{{ $invoice->amount_collection }}</td>
                                            <th class="spe">مبلغ العمولة</th>
                                            <td>{{ $invoice->amount_commission }}</td>
                                            <th class="spe">الخصم</th>
                                            <td>{{ $invoice->discount }}</td>
                                            <th class="spe">نسبة الضريبة</th>
                                            <td>{{ $invoice->rate_vat }}</td>
                                            <th class="spe">قيمة الضريبة</th>
                                            <td>{{ $invoice->value_vat }}</td>
                                        </tr>
                                        <tr>
                                            <th class="spe">الإجمالي</th>
                                            <td>{{ $invoice->total }}</td>
                                            <th class="spe">حالة القيمة</th>
                                            <td>
                                                @switch($invoice->value_status)
                                                @case('0')
                                                <span class="badge badge-danger" style="font-size: 14px !important;">غير مدفوع</span>
                                                @break
                                                @case('1')
                                                <span class="badge badge-warning" style="font-size: 14px !important;">مدفوع جزئيا</span>
                                                @break
                                                @case('2')
                                                <span class="badge badge-success" style="font-size: 14px !important;">مدفوع بالكامل</span>
                                                @break
                                                @default
                                                <span class="badge badge-secondary" style="font-size: 14px !important;">خطأ</span>
                                                @break
                                                @endswitch
                                            </td>
                                            <th class="spe">تاريخ الدفع</th>
                                            <td>
                                                @if($invoice->payment_date)
                                                <span>{{$invoice->payment_date}} </span>
                                                @else
                                                <span class="text-danger">لم يتم الدفع بعد</span>
                                                @endif
                                            </td>
                                            <th class="spe">تم الإنشاء بواسطة</th>
                                            <td colspan="3">{{ $invoice->user->name }}</td>
                                        </tr>
                                        <tr>
                                            <th class="spe">ملاحظة</th>
                                            <td colspan="9">
                                                @if($invoice->note)
                                                <span>{{$invoice->note}} </span>
                                                @else
                                                <span class="text-danger">لا توجد اي ملاحظات</span>
                                                @endif
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>


                            </div>
                        </div>

                        <div class="tab-pane" id="stausPayment">


                            <div class="table-responsive">
                                <table class="table mg-b-0 text-md-nowrap">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>رقم الفاتورة</th>
                                            <th>القسم</th>
                                            <th>المنتج</th>
                                            <th>حالة القيمة</th>
                                            <th>تاريخ الدفع</th>
                                            <th>تم الإنشاء بواسطة</th>
                                            <th>ملاحظة</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                        $i = 0
                                        @endphp
                                        @foreach($invoice_detail as $detail)

                                        <tr>
                                            <th scope="row">{{++$i}}</th>
                                            <td> {{ $detail->invoice_number }} </td>
                                            <td> {{ $detail->section }} </td>
                                            <td> {{ $detail->product }} </td>
                                            <td>
                                                @switch($detail->value_Status)
                                                @case('0')
                                                <span class="badge badge-danger" style="font-size: 14px !important;">غير مدفوع</span>
                                                @break
                                                @case('1')
                                                <span class="badge badge-warning" style="font-size: 14px !important;">مدفوع جزئيا</span>
                                                @break
                                                @case('2')
                                                <span class="badge badge-success" style="font-size: 14px !important;">مدفوع بالكامل</span>
                                                @break
                                                @default
                                                <span class="badge badge-secondary" style="font-size: 14px !important;">خطأ</span>
                                                @break
                                                @endswitch
                                            </td>

                                            <td>
                                                @if($detail->payment_date)
                                                <span>{{$detail->payment_date}} </span>
                                                @else
                                                <span class="text-danger">لم يتم الدفع بعد</span>
                                                @endif
                                            </td>

                                            <td> {{ $detail->created_by }} </td>
                                            <td>
                                                @if($detail->note)
                                                <span>{{$detail->note}} </span>
                                                @else
                                                <span class="text-danger">لا توجد اي ملاحظات</span>
                                                @endif
                                            </td>

                                        </tr>

                                        @endforeach
                                    </tbody>
                                </table>
                            </div>





                        </div>
                        <div class="tab-pane" id="attachments">

                            @can('add-file-invoice')
                            <div class="custom-file mt-3 mb-5" style="width: 80%; margin: 0 auto; display: block;">
                                <form action="{{ route('invoicesDetails.store') }}" method="post" enctype="multipart/form-data" style="position: relative">
                                    @csrf
                                    <div class="col-sm-7 col-md-6 col-lg-4">
                                        <div class="custom-file">
                                            <input class="custom-file-input" id="media" name="media" type="file">
                                            <label class="custom-file-label" for="media">اختر المرفق</label>
                                            <input type="hidden" name="invoice_id" value="{{ $invoice->id }}">
                                            <input type="hidden" name="invoice_number" value="{{ $invoice->invoice_number }}">
                                        </div>
                                    </div>
                                    <button style="position: absolute; top: 0; left: 165px;" class="btn btn-primary" type="submit">اضافة المرفق</button>
                                </form>
                            </div>
                            @endcan

                            <div class="table-responsive">
                                <table class="table mg-b-0 text-md-nowrap">
                                    <thead class="table-hover">
                                        <tr>
                                            <th>#</th>
                                            <th>رقم الفاتورة</th>
                                            <th>اسم الملف</th>
                                            <th>تم الإنشاء بواسطة</th>
                                            <th>العمليات</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                        $i = 1
                                        @endphp
                                        @foreach($attachment as $inv)

                                        <tr>
                                            <th scope="row">{{$i++}}</th>
                                            <td>{{$inv->invoice_number}}</td>
                                            <td style="direction: ltr">{{ Str::limit($inv->file_name, 10) }}</td>
                                            <td>{{$inv->created_by}}</td>
                                            <td>
                                                @can('show-file-invoice')
                                                <a href="{{ url("invoicesDetails/show/".$inv->invoice_number.'/'.$inv->file_name)  }}" class="btn btn-success" target="_blank">
                                                    <i class="fas fa-eye"></i>&nbsp;&nbsp;عرض
                                                </a>
                                                @endcan
                                                @can('download-file-invoice')
                                                <a href="{{ url("/invoicesDetails/download/".$inv->invoice_number.'/'.$inv->file_name)  }}" class="btn btn-secondary">
                                                    <i class="fas fa-download"></i>&nbsp;&nbsp;تحميل
                                                </a>
                                                @endcan
                                                @can('delete-file-invoice')
                                                <a data-id='{{$inv->id}}' data-invoice_number='{{$inv->invoice_number}}' data-file_name='{{$inv->file_name}}' data-effect="effect-scale" data-toggle="modal" href="#deleteFile" class="modal-effect btn btn-danger">
                                                    <i class="fa fa-trash"></i> &nbsp;&nbsp; حذف
                                                </a>
                                                @endcan
                                            </td>
                                        </tr>

                                        @endforeach
                                    </tbody>
                                </table>
                            </div>



                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <div class="modal" id="deleteFile">
        <div class="modal-dialog" role="document">
            <div class="modal-content modal-content-demo">

                <div class="modal-header">
                    <h6 class="modal-title">حذف الملف</h6>
                    <button aria-label="إغلاق" class="close" data-dismiss="modal" type="button">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <form action="{{url('invoicesDetails/destroy')}}" method="post" autocomplete="off">
                    @csrf
                    @method('delete')

                    <div class="modal-body">
                        <label for="invoice_number">اضغط على زر الحدف لتزيل هدا الملف</label>
                        <input type="text" readonly name="invoice_number" id="invoice_number" value="" class="form-control">
                        <input type="hidden" name="id" id="id" value="">
                        <input type="hidden" name="file_name" id="file_name" value="">
                    </div>

                    <div class="modal-footer">
                        <button class="btn ripple btn-danger" type="submit">تأكيد الحذف</button>
                        <button class="btn ripple btn-secondary" data-dismiss="modal" type="button">إلغاء</button>
                    </div>

                </form>

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
<script src="{{URL::asset('assets/plugins/jquery-ui/ui/widgets/datepicker.js')}}"></script>
<script src="{{URL::asset('assets/plugins/select2/js/select2.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/custom-scroll/jquery.mCustomScrollbar.concat.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/inputtags/inputtags.js')}}"></script>
<script src="{{URL::asset('assets/plugins/tabs/jquery.multipurpose_tabcontent.js')}}"></script>
<script src="{{URL::asset('assets/js/tabs.js')}}"></script>
<script src="{{URL::asset('assets/plugins/clipboard/clipboard.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/clipboard/clipboard.js')}}"></script>
<script src="{{URL::asset('assets/plugins/prism/prism.js')}}"></script>
<script src="{{URL::asset('assets/plugins/jquery-ui/ui/widgets/datepicker.js')}}"></script>
<script src="{{URL::asset('assets/plugins/select2/js/select2.min.js')}}"></script>
<script src="{{URL::asset('assets/js/modal.js')}}"></script>
<script src="{{URL::asset('assets/plugins/select2/js/select2.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/fileuploads/js/fileupload.js')}}"></script>
<script src="{{URL::asset('assets/plugins/fileuploads/js/file-upload.js')}}"></script>
<script src="{{URL::asset('assets/plugins/fancyuploder/jquery.ui.widget.js')}}"></script>
<script src="{{URL::asset('assets/plugins/fancyuploder/jquery.fileupload.js')}}"></script>
<script src="{{URL::asset('assets/plugins/fancyuploder/jquery.iframe-transport.js')}}"></script>
<script src="{{URL::asset('assets/plugins/fancyuploder/jquery.fancy-fileupload.js')}}"></script>
<script src="{{URL::asset('assets/plugins/fancyuploder/fancy-uploader.js')}}"></script>
<script src="{{URL::asset('assets/js/advanced-form-elements.js')}}"></script>
<script src="{{URL::asset('assets/js/select2.js')}}"></script>
<script src="{{URL::asset('assets/plugins/sumoselect/jquery.sumoselect.js')}}"></script>
<script src="{{URL::asset('assets/plugins/telephoneinput/telephoneinput.js')}}"></script>
<script src="{{URL::asset('assets/plugins/telephoneinput/inttelephoneinput.js')}}"></script>


<script>
    $('#deleteFile').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget)
        var invoice_number = button.data('invoice_number')
        var id = button.data('id')
        var file_name = button.data('file_name')
        var modal = $(this)

        modal.find('.modal-body #id').val(id);
        modal.find('.modal-body #invoice_number').val(invoice_number);
        modal.find('.modal-body #file_name').val(file_name);

    })

</script>




@endsection
