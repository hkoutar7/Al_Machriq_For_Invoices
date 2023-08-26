@extends('layouts.master')

@section('title',"تعديل الفاتورة")

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

    @if(session()->has("created"))
    <div class="alert alert-success" role="alert" style="position: absolute; top: 77px; left: 37px; border-radius: 9px;">
        <button aria-label="Close" class="close" data-dismiss="alert" type="button">
            <span aria-hidden="true"> &nbsp; &nbsp;&times;</span>
        </button>
        <strong>نجاح</strong>&nbsp; &nbsp; {{session()->get("created")}}
    </div>
    @endif


    <div class="my-auto">
        <div class="d-flex">
            <span class="content-title mb-0 my-auto"> الفواتير</span>
            <a href="{{ route("invoices.index") }}" class="content-title mb-0 my-auto">/ قائمة الفواتير</a>
            <span class="text-muted mt-1 tx-13 mr-2 mb-0">/ اضافة فاتورة</span>
        </div>
    </div>
</div>
<!-- breadcrumb -->

{{-- Start Form  --}}
<div class="card">

    <div class="card-body">
        <div class="main-content-label mg-b-5">
        </div>
        <p style="font-size: larger; color: #2196F3; font-weight: 700; margin-bottom: 51px;" class="mg-b-20">ادخل فتورتك عن طريق ملئ هده الاستمارة :</p>

        <form action="{{route('invoices.update',$invoice->id)}}" method="post" autocomplete="off">
            @csrf
            @method('put')

            <div class="row row-sm" style="width : 100%">

                <div class="col-lg">

                    <label for="invoice_number">رقم لفاتورة</label>
                    <input id='invoice_number' name="invoice_number" class="form-control" placeholder="المرجو ادخال رقم الفاتورة" type="text" value="{{$invoice->invoice_number}}">
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
                            <input id="invoice_date" name='invoice_date' class="form-control fc-datepicker" placeholder="MM/DD/YYYY" type="text" value="{{$invoice->invoice_date}}">
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
                            <input id="due_date" name="due_date" class="form-control fc-datepicker" placeholder="MM/DD/YYYY" type="text" value="{{$invoice->due_date}}">

                        </div>
                    </div>
                </div>

            </div>

            <div class="row row-sm mt-3" style="width : 100%">
                <div class="col-lg">
                    <label for="section">القسم</label>
                    <select id="section" name="section" class="SlectBox form-control">
                        <option value="" disabled selected>اختر قسم من الاقسام التالية </option>
                        @foreach($sections as $sec)
                        <option value={{$sec->id}} {{ $sec->id == $invoice->section_id ? 'selected' : ''  }}>
                            {{$sec->section_name}}
                        </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-lg">
                    <label for="product">المنتج</label>
                    <select id="product" name="product" class="form-control" >
                        <option value="{{$invoice->product}}">{{$invoice->product}}</option>

                    </select>
                </div>

                <div class="col-lg">
                    <label for="amount_collection">مبلغ التحصيل</label>
                    <input id='amount_collection' name="amount_collection" value="{{$invoice->amount_collection}}" class="form-control" placeholder="المرجو ادخال مبلغ التحصيل" type="number" min="0">
                </div>

            </div>

            <div class="row row-sm mt-3" style="width : 100%">
                <div class="col-lg">
                    <label for="amount_commission">مبلغ العمولة</label>
                    <input id='amount_commission' name="amount_commission" value="{{ $invoice->amount_commission  }}" class="form-control" placeholder="المرجو ادخال مبلغ العمولة" type="number" min="0" required>
                </div>

                <div class="col-lg">
                    <label for="discount">الخصم</label>
                    <input id='discount' name="discount" value="{{ $invoice->discount }}" class="form-control" placeholder="المرجو ادخال الخصم" type="number" min="0" required>
                </div>

                <div class="col-lg">
                    <label for="rate_vat">نسبة الضريبة المضافة</label>
                    <select id="rate_vat" name="rate_vat" class="SlectBox form-control" required onchange="calculateTotal()">
                        <option disabled selected>اختر نسبة الضريبة المضافة </option>
                        <option value="5%" {{ $invoice->rate_vat == '5%' ? 'selected' : ''  }}>5%</option>
                        <option value="10%" {{ $invoice->rate_vat == '10%' ? 'selected' : ''  }}>10%</option>
                        <option value="15%" {{ $invoice->rate_vat == '15%' ? 'selected' : ''  }}>15%</option>
                    </select>
                </div>
            </div>

            <div class="row row-sm mt-3" style="width : 100%">
                <div class="col-lg">
                    <label for="value_vat">قيمة الضريبة المضافة</label>
                    <input id='value_vat' name="value_vat" value="{{ $invoice->value_vat  }}" class="form-control" placeholder="املئ المعلومات اعلاه" type=" text" min="0" readonly>
                </div>

                <div class="col-lg">
                    <label for="total">الاجمالي الشامل للضريبة</label>
                    <input id='total' name="total" value="{{ $invoice->total  }}" class="form-control" placeholder="املئ المعلومات اعلاه" type="number" min="0" readonly>
                </div>
            </div>

            <div class="row  row-sm mt-5 pr-2">
                <label for="note">ملاحظات <span style="color: tomato">(اختياري)</span></label>
                <textarea id="note" name="note" class="form-control" placeholder="ادخل ماحظات" rows="3">{{ $invoice->note }}</textarea>
            </div>

            <button style="display: block; margin: 0 auto;" class="btn btn-primary mt-5 " type="submit">حفظ البيانات</button>

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
<script src="{{asset('script\invoice\sectionProduct.js')}}"></script>
<script src="{{asset('script\invoice\calculateTotal.js')}}"></script>

<script>
    var date = $('.fc-datepicker').datepicker({
        dateFormat: 'yy-mm-dd'
    }).val();

</script>


@endsection

