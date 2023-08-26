@extends('layouts.master')

@section('title',"طباعة فاتورة")

@section('css')
<link rel="stylesheet" href="{{   asset('css/printInvoice.css')  }}">
<style>
    @media print {
        button.btn {
            display: none;
        }
    }

</style>
@endsection


@section('page-header')
<!-- breadcrumb -->
<div class="breadcrumb-header justify-content-between" style="flex-direction: column;gap: 20px;">

    <div class="my-auto">
        <div class="d-flex">
            <span class="content-title mb-0 my-auto"> الفواتير</span>
            <a href="{{ route("invoices.index") }}" class="content-title mb-0 my-auto">/ قائمة الفواتير</a>
            <span class="text-muted mt-1 tx-13 mr-2 mb-0">/ بيان الفاتورة</span>
        </div>
    </div>

    <div>
        <div class="container mt-6 mb-7">
            <div class="row justify-content-center">
                <div class="col-lg-12 col-xl-7">

                    <div class="card" id="printCard" style="position: relative;">
                        <div class="card-body p-5">
                            <h2>
                                مرحبا يا <span style="color: #2196F3;">{{ userName() }}</span>
                            </h2>
                            <p class="mt-5 mb-4">
                                <span>حررت الفاتورة <span style="color: #2196F3;">{{ $invoice->invoice_number }}</span></span> <br>
                                <span>يوم <span style="color: #2196F3;">{{ date('Y F l') }}</span></span><br>
                                <span> بتوقيت <span style="color: #2196F3;">{{ date('m:i a') }}</span></span> <br>
                            </p>

                            <div class="border-top border-gray-200 pt-4 mt-4">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="text-muted mb-2">حالة الفاتورة</div>
                                        <strong>
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
                                        </strong>
                                    </div>
                                    <div class="col-md-6 text-md-end">
                                        <div class="text-muted mb-2">تاريخ الدفع</div>
                                        <strong>
                                            @if($invoice->payment_date)
                                            <span>{{$invoice->payment_date}} </span>
                                            @else
                                            <span class="text-danger">لم يتم الدفع بعد</span>
                                            @endif
                                        </strong>
                                    </div>
                                </div>
                            </div>

                            <div class="border-top border-gray-200 mt-4 py-4">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="text-muted mb-2">اسم المشرف</div>
                                        <strong>
                                            {{ $invoice->user->name }}
                                        </strong>
                                        <p class="fs-sm">
                                            {{$invoice->user->email}}
                                            <br>
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <table class="table border-bottom border-gray-200 mt-3">
                                <thead>
                                    <tr>
                                        <th scope="col" class="fs-sm text-dark text-uppercase-bold-sm px-0">القدر</th>
                                        <th scope="col" class="fs-sm text-dark text-uppercase-bold-sm text-end px-0">الوصف</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="px-0">مبلغ العمولة</td>
                                        <td class="text-end px-0">$ &nbsp; {{ number_format($invoice->amount_commission,2,'.',',')}} </td>
                                    </tr>
                                    <tr>
                                        <td class="px-0">نسبة الضريبة</td>
                                        <td class="text-end px-0" style="color: dimgray">{{ $invoice->rate_vat}}</td>
                                    </tr>
                                    <tr>
                                        <td class="px-0">قيمة الضريبة</td>
                                        <td class="text-end px-0">$ &nbsp; {{ number_format($invoice->value_vat,2,'.',',')}}</td>
                                    </tr>
                                </tbody>
                            </table>

                            <div class="mt-5">
                                <div class="d-flex justify-content-end">
                                    <p class="text-muted me-3">الخصم</p> &nbsp; &nbsp;
                                    <span>$ {{ $invoice->discount }}</span>
                                </div>
                                <div class="d-flex justify-content-end mt-3">
                                    <h5 class="me-3">الإجمالي</h5> &nbsp; &nbsp;
                                    <h5 class="text-success">{{number_format($invoice->total,2,'.',',')}} USD</h5>

                                </div>
                            </div>
                        </div>

                        <p style="margin-right: 26px;color: #78909C;">شكرًا لتفضيلكم لخدماتنا.</p>
                        <button onclick="printContent()" class="btn btn-success" style="width: fit-content; left: 16px; position: absolute; bottom: 9px;">طباعة</button>
                    </div>
                </div>
            </div>
        </div>


    </div>



</div>
<!-- breadcrumb -->
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

<script src=" {{ asset('script/invoice/printInvoice.js')  }} "></script>

@endsection
