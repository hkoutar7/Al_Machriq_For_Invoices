@extends('layouts.master')

@section('css')
@endsection

@section('title','اظهار معلومات المستخدم')

@section('page-header')
<!-- breadcrumb -->
<div class="breadcrumb-header justify-content-between">
    <div class="my-auto">
        <div class="d-flex">
            <h4 class="content-title mb-0 my-auto">المستخدمين</h4>
            <a href={{route('users.index')}} class="content-title mb-0 my-auto" style="margin-right: 8px; transform: translateY(1px); font-weight: 700;">/ قائمة المستخدمين</a>
            <span class="text-muted mt-1 tx-13 mr-2 mb-0" style="margin-right: 8px; transform: translateY(1px);">/ اظهار معلومات المستخدم</span>
        </div>
    </div>


</div>
<!-- breadcrumb -->
@endsection


@section('content')
<!-- row -->
<div class="d-flex justify-content-center align-items-center" style="min-height: calc(100vh - 129px);">

    <div class="col-12 col-sm-6 col-lg-6 col-xl-3">
        <div class="card card-primary" style="width: 400px; height: 349px;    transform: translateX(100px);">
            <div class="card-header pb-0">
                <h5 class="card-title mb-0 pb-0" style="text-align: center; font-size: 19px; margin-bottom: 19px !important;">
                    المعلومات الشخصية
                </h5>
            </div>
            <hr>
            <div class="card-body text-primary">
                <p style="font-size: 17px; color: black; display: flex; justify-content: space-between;">
                    <span style="font-weight: 800;">الاسم</span>
                    <span style="color: dodgerblue">{{ $user->name }}</span>
                </p>
                <p style="font-size: 17px; color: black; display: flex; justify-content: space-between;">
                    <span style="font-weight: 800;">البريد الإلكتروني</span>
                    <span style="color: dodgerblue">{{ $user->email }}</span>
                </p>
                <p style="font-size: 17px; color: black; display: flex; justify-content: space-between;">
                    <span style="font-weight: 800;">حالة الحساب</span>
                    @if ($user->status == 1)
                    <span style="color: dodgerblue"> مفعل
                    </span>
                    @else
                    <span style="color: crimson">
                        موقوف
                    </span>
                    @endif
                </p>
            </div>
            <div class="form-group mr-4 ml-4" style="font-size: 17px; color: black; display: flex; justify-content: space-between;">
                <strong>الأدوار:</strong>
                @if(!empty($user->getRoleNames()))
                @foreach($user->getRoleNames() as $v)
                <label style="padding: 5px 17px; font-size: 17px; background: #8BC34A; color: white; border-radius: 18px; font-weight: 700; letter-spacing: 1px;">
                    {{ $v }}
                </label>
                @endforeach
                @endif
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
@endsection
