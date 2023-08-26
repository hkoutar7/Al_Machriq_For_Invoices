@extends('layouts.master2')

@section('title','تسجيل الدخول')

@section('css')
<link href="{{URL::asset('assets/plugins/sidemenu-responsive-tabs/css/sidemenu-responsive-tabs.css')}}" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="{{asset('css/login/util.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('css/login/main.css')}}">

@endsection



@section('content')
<div class="container-fluid">
    <div class="row no-gutter">

        <div class="limiter">
            <div class="container-login100">
                <div class="wrap-login100">

                    @if(session()->has("user_denied_permission"))
                    <div class="alert alert-danger" role="alert" style="position: absolute; z-index:3; top: 77px;right: 16px; border-radius: 9px;">
                        <button aria-label="Close" class="close" data-dismiss="alert" type="button">
                            <span aria-hidden="true"> &nbsp; &nbsp;&times;</span>
                        </button>
                        <strong>خطا</strong>&nbsp; &nbsp; {{session()->get("user_denied_permission")}}
                    </div>
                    @endif


                    <div class="login100-form-title" style="background-image: url({{asset('myImages/login.jpg')}});">
                        <span style="ont-weight: bold;" class="login100-form-title-1">
                            تسجيل الدخول
                        </span>
                    </div>

                    <form method="POST" action="{{ route('login') }}" class="login100-form validate-form">
                        @csrf

                        <div class="wrap-input100 validate-input m-b-26" data-validate="اسم المستخدم مطلوب">
                            <input id="email" type="email" placeholder="أدخل اسم المستخدم" @error('email') is-invalid @enderror name="email" value="{{ old('email') }}" autocomplete="email" autofocus class="input100">
                        </div>

                        @error('email')
                        <span role="alert" style="width: 100%;margin-top: -19px;">
                            <div class="alert alert-danger" role="alert" style="border-radius: 8px;}">
                                <button aria-label="Close" class="close" data-dismiss="alert" type="button">
                                    <span aria-hidden="true">&nbsp; &nbsp; &times;</span>
                                </button>
                                <strong>خطا</strong>&nbsp; &nbsp; {{$message}}
                            </div>
                        </span>
                        @enderror

                        <div class="wrap-input100 validate-input m-b-18" data-validate="كلمة المرور مطلوبة">
                            <input id="password" type="password" placeholder=" أدخل كلمة المرور" @error('password') is-invalid @enderror name="password" autocomplete="current-password" class="input100">
                        </div>

                        @error('password')
                        <span role="alert" style="width: 100%;margin-top: -9px;">
                            <div class="alert alert-danger" role="alert" style="border-radius: 8px;}">
                                <button aria-label="Close" class="close" data-dismiss="alert" type="button">
                                    <span aria-hidden="true">&nbsp; &nbsp; &times;</span>
                                </button>
                                <strong>خطا</strong>&nbsp; &nbsp; {{$message}}
                            </div>
                        </span>
                        @enderror

                        <div class="form-group row">
                            <div class="col-md-12 offset-md-4">
                                <div class="form-check" style="display: flex; gap: 5px; color: #2196F3; font-weight: 700;">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                    <label class="form-check-label" for="remember">
                                        {{ __('تذكرني') }}
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="container-login100-form-btn">
                            <button type="submit" class="login100-form-btn" style="background: #2196f3;font-size: 19px;">
                                تسجيل الدخول
                            </button>
                        </div>

                        <div class="links">
                            <a href="{{route("password.request")}}">
                                نسيت كلمة المرور ؟
                            </a>
                            <a href="{{route("register")}}">
                                ليس لدي حساب ؟
                            </a>
                        </div>

                    </form>


                </div>

            </div>
        </div>


    </div>
</div>
</div>

</div>
</div>
@endsection


{{-- @if(session()->has("user_denied_permission"))
   <div class="alert alert-danger" role="alert" style="position: absolute; z-index:3; top: 77px;right: 16px; border-radius: 9px;">
       <button aria-label="Close" class="close" data-dismiss="alert" type="button">
           <span aria-hidden="true"> &nbsp; &nbsp;&times;</span>
       </button>
       <strong>خطا</strong>&nbsp; &nbsp; {{session()->get("user_denied_permission")}}
</div>
@php
session()->forget("user_denied_permission")
@endphp
@endif --}}
