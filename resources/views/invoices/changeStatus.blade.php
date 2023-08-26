@extends('layouts.master')

@section('title',"تغيير حالة الدفع")

@section('css')
<link href="{{URL::asset('assets/plugins/select2/css/select2.min.css')}}" rel="stylesheet">
<link href="{{URL::asset('assets/plugins/amazeui-datetimepicker/css/amazeui.datetimepicker.css')}}" rel="stylesheet">
<link href="{{URL::asset('assets/plugins/jquery-simple-datetimepicker/jquery.simple-dtpicker.css')}}" rel="stylesheet">
<link href="{{URL::asset('assets/plugins/pickerjs/picker.min.css')}}" rel="stylesheet">
<link href="{{URL::asset('assets/plugins/spectrum-colorpicker/spectrum.css')}}" rel="stylesheet">
<link href="{{URL::asset('assets/plugins/select2/css/select2.min.css')}}" rel="stylesheet">
<link href="{{URL::asset('assets/plugins/select2/css/select2.min.css')}}" rel="stylesheet">
<link href="{{URL::asset('assets/plugins/fileuploads/css/fileupload.css')}}" rel="stylesheet" type="text/css" />
<link href="{{URL::asset('assets/plugins/fancyuploder/fancy_fileupload.css')}}" rel="stylesheet" />
<link rel="stylesheet" href="{{URL::asset('assets/plugins/sumoselect/sumoselect-rtl.css')}}">
<link rel="stylesheet" href="{{URL::asset('assets/plugins/telephoneinput/telephoneinput-rtl.css')}}">

@endsection

@section('page-header')
<!-- breadcrumb -->
<div class="breadcrumb-header justify-content-between">

    <div class="my-auto">
        <div class="d-flex">
            <span class="content-title mb-0 my-auto"> الفواتير</span>
            <a href="{{ route("invoices.index") }}" class="content-title mb-0 my-auto">/ قائمة الفواتير</a>
            <span class="text-muted mt-1 tx-13 mr-2 mb-0">/ تسديد الفاتورة</span>
        </div>
    </div>
</div>
<!-- breadcrumb -->

{{-- Start Form  --}}
<div class="card">

    <div class="card-body">
        <div class="main-content-label mg-b-5">
        </div>
        <p style="font-size: larger; color: #2196F3; font-weight: 700; margin-bottom: 51px;" class="mg-b-20">اختر حالة الدفع كامل او جزئي :</p>

        <form action="{{route('invoices.updateStatus')}}" method="post" autocomplete="off">
            @csrf
            {{-- @method('put') --}}
            <input type="hidden" name="id" value="{{$invoice->id}}">

            <div class="row row-sm" style="width : 100%">
                <div class="col-lg">
                    <label for="invoice_number">رقم لفاتورة</label>
                    <input id='invoice_number'  class="form-control" type="text" value="{{$invoice->invoice_number}}" readonly>
                </div>
                <div class="col-lg mg-t-10 mg-lg-t-0">
                    <label for="invoice_date">تاريخ الفاتورة</label>
                    <div>
                        <div class="input-group ">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <i class="typcn typcn-calendar-outline tx-24 lh--9 op-6"></i>
                                </div>
                            </div>
                            <input id="invoice_date"  class="form-control fc-datepicker" type="text" value="{{$invoice->invoice_date}}" readonly>
                        </div>
                    </div>
                </div>
                <div class="col-lg mg-t-10 mg-lg-t-0">
                    <label for="invoice_date">تاريخ الاستحقاق</label>
                    <div>
                        <div class="input-group ">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <i class="typcn typcn-calendar-outline tx-24 lh--9 op-6"></i>
                                </div>
                            </div>
                            <input id="due_date"  class="form-control fc-datepicker" type="text" value="{{$invoice->due_date}}" readonly>
                        </div>
                    </div>
                </div>

            </div>

            <div class="row row-sm mt-3" style="width : 100%">
                <div class="col-lg">
                    <label for="section">القسم</label>
                    <select id="section"  class="SlectBox form-control" readonly>
                        <option value="{{$invoice->invoice_id}}">{{$invoice->section->section_name}}</option>
                    </select>
                </div>

                <div class="col-lg">
                    <label for="product">المنتج</label>
                    <select id="product"  class="form-control" readonly>
                        <option value="{{$invoice->product}}">{{$invoice->product}}</option>
                    </select>
                </div>

                <div class="col-lg">
                    <label for="amount_collection">مبلغ التحصيل</label>
                    <input id='amount_collection'  value="{{$invoice->amount_collection}}" class="form-control" type="number" readonly>
                </div>

            </div>

            <div class="row row-sm mt-3" style="width : 100%">
                <div class="col-lg">
                    <label for="amount_commission">مبلغ العمولة</label>
                    <input id='amount_commission'  value="{{ $invoice->amount_commission  }}" class="form-control" type="number" readonly>
                </div>

                <div class="col-lg">
                    <label for="discount">الخصم</label>
                    <input id='discount'  value="{{ $invoice->discount }}" class="form-control" type="number" readonly>
                </div>

                <div class="col-lg">
                    <label for="rate_vat">نسبة الضريبة المضافة</label>
                    <select id="rate_vat"  class="SlectBox form-control" readonly>
                        <option value="{{$invoice->rate_vat}}">{{$invoice->rate_vat}}</option>
                    </select>
                </div>
            </div>

            <div class="row row-sm mt-3" style="width : 100%">
                <div class="col-lg">
                    <label for="value_vat">قيمة الضريبة المضافة</label>
                    <input id='value_vat' value="{{ $invoice->value_vat  }}" class="form-control" type="text" readonly>
                </div>

                <div class="col-lg">
                    <label for="total">الاجمالي الشامل للضريبة</label>
                    <input id='total' value="{{ $invoice->total  }}" class="form-control" type="number" readonly>
                </div>
            </div>

            <div class="row  row-sm mt-5 pr-2">
                <label for="note">ملاحظات <span style="color: tomato">(اختياري)</span></label>
                <textarea id="note" class="form-control" rows="3" readonly>{{ $invoice->note }}</textarea>
            </div>

            <div class="row row-sm mt-3" style="width : 100%">
                <div class="col-lg">
                    <label for="value_status">اختر حالة الدفع</label>
                    <select name="value_status" id="value_status" class="SlectBox form-control">
                        <option value="1">مدفوع جزئيا</option>
                        <option value="2" selected>مدفوع بالكامل</option>
                    </select>

                </div>

                <div class="col-lg">
                    <label for="payment_date">تاريخ الدفع</label>
                    <div>
                        <div class="input-group ">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <i class="typcn typcn-calendar-outline tx-24 lh--9 op-6"></i>
                                </div>
                            </div>
                            <input id="payment_date" name='payment_date' class="form-control fc-datepicker" type="text" value="{{date('Y-m-d')}}">
                        </div>
                    </div>
                </div>
            </div>


            <button style="display: block; margin: 0 auto;" class="btn btn-success mt-5 " type="submit">حفظ حالة الدفع</button>

    </div>

</div>

</form>

</div>
</div>
{{-- End Form  --}}

@endsection


@section('content')
<!-- row -->
<div class="row">

</div>
<!-- row closed -->
</div>
<!-- Container closed -->
</div>
<!-- main-content closed -->
@endsection


@section('js')
<script src="{{URL::asset('assets/plugins/jquery-ui/ui/widgets/datepicker.js')}}"></script>
<script src="{{URL::asset('assets/plugins/jquery.maskedinput/jquery.maskedinput.js')}}"></script>
<script src="{{URL::asset('assets/plugins/spectrum-colorpicker/spectrum.js')}}"></script>
<script src="{{URL::asset('assets/plugins/select2/js/select2.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/ion-rangeslider/js/ion.rangeSlider.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/amazeui-datetimepicker/js/amazeui.datetimepicker.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/jquery-simple-datetimepicker/jquery.simple-dtpicker.js')}}"></script>
<script src="{{URL::asset('assets/plugins/pickerjs/picker.min.js')}}"></script>
<script src="{{URL::asset('assets/js/form-elements.js')}}"></script>
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

{{-- my Scripts  --}}

<script>
    var date = $('.fc-datepicker').datepicker({
        dateFormat: 'yy-mm-dd'
    }).val();

</script>


@endsection
