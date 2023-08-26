@extends('layouts.master2')

@section('title',' إعادة تعيين كلمة المرور عبر البريد الإلكتروني')

@section('css')
<!--- Internal Fontawesome css-->
<link href="{{URL::asset('assets/plugins/fontawesome-free/css/all.min.css')}}" rel="stylesheet">
<!---Ionicons css-->
<link href="{{URL::asset('assets/plugins/ionicons/css/ionicons.min.css')}}" rel="stylesheet">
<!---Internal Typicons css-->
<link href="{{URL::asset('assets/plugins/typicons.font/typicons.css')}}" rel="stylesheet">
<!---Internal Feather css-->
<link href="{{URL::asset('assets/plugins/feather/feather.css')}}" rel="stylesheet">
<!---Internal Falg-icons css-->
<link href="{{URL::asset('assets/plugins/flag-icon-css/css/flag-icon.min.css')}}" rel="stylesheet">
@endsection


@section('content')
<!-- Main-error-wrapper -->
<div class="main-error-wrapper  page page-h " style="width: 900px;height: 900px;margin: 0 auto;">


    <div class="container" style="background: white; border-radius: 54px; padding: 54px;box-shadow: rgba(50, 50, 93, 0.25) 0px 13px 27px -5px, rgba(0, 0, 0, 0.3) 0px 8px 16px -8px;">

        <img src="{{ asset('myImages/logo.png')}}" alt="error" style="width: 300px">

        <div class="mb-4 text-sm text-gray-600" style="    margin-top: 19px;font-size: px;">
            هل نسيت كلمة المرور؟ لا مشكلة. فقط أخبرنا بعنوان بريدك الإلكتروني وسنرسل لك رابط إعادة تعيين كلمة المرور عبر البريد الإلكتروني الذي سيمكنك من اختيار كلمة مرور جديدة.
        </div>

        <!-- حالة الجلسة -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <form method="POST" action="{{ route('password.email') }}" autocomplete="off">
            @csrf

            <!-- عنوان البريد الإلكتروني -->
            <div style="display: flex; justify-content: center; align-items: center;">
                <label for="email" style="width : 30%">البريد الإلكتروني</label>
                <x-text-input id="email" class="form-control" type="email" name="email" :value="old('email')" required autofocus />
            </div>

            @error('email')
            <span role="alert" style="width: 100%">
                <div class="alert alert-danger" role="alert" style="border-radius: 8px;margin-top:9px;" class="mt-4">
                    <button aria-label="Close" class="close" data-dismiss="alert" type="button">
                        <span aria-hidden="true">&nbsp; &nbsp; &times;</span>
                    </button>
                    <strong>خطأ</strong>&nbsp; &nbsp; {{$message}}
                </div>
            </span>
            @enderror


            <div class="flex items-center justify-end mt-4">
                <button type="submit" class="btn btn-secondary">تاكيد</button>
            </div>
        </form>




    </div>

</div>


<!-- /Main-error-wrapper -->
@endsection


@section('js')
@endsection
