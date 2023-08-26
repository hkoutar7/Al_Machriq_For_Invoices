@extends('layouts.master2')

@section('title','انشاء حساب')

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


                    <div class="login100-form-title" style="background-image: url({{asset('myImages/signup.jpg')}});">
                        <span class="login100-form-title-1" style="font-weight: bold;">
                            إنشاء حساب مستخدم جديد
                        </span>
                    </div>

                    <form method="POST" action="{{ route('register') }}" class="login100-form validate-form" autocomplete="off">
                        @csrf

                        <div class="wrap-input100 validate-input m-b-26" data-validate="اسم المستخدم مطلوب">
                            <input id="name" type="text" placeholder="أدخل اسم المستخدم" @error('name') is-invalid @enderror name="name" value="{{ old('name') }}" autofocus class="input100">
                        </div>

                        @error('name')
                        <span role="alert" style="width: 100%;margin-top: -19px;">
                            <div class="alert alert-danger" role="alert" style="border-radius: 8px;">
                                <button aria-label="Close" class="close" data-dismiss="alert" type="button">
                                    <span aria-hidden="true">&nbsp; &nbsp; &times;</span>
                                </button>
                                <strong>خطأ</strong>&nbsp; &nbsp; {{$message}}
                            </div>
                        </span>
                        @enderror

                        <div class="wrap-input100 validate-input m-b-26" data-validate="البريد الإلكتروني مطلوب">
                            <input id="email" type="email" placeholder="أدخل عنوان بريدك الإلكتروني" @error('email') is-invalid @enderror name="email" value="{{ old('email') }}" autocomplete="email" autofocus class="input100">
                        </div>

                        @error('email')
                        <span role="alert" style="width: 100%;margin-top: -19px;">
                            <div class="alert alert-danger" role="alert" style="border-radius: 8px;">
                                <button aria-label="Close" class="close" data-dismiss="alert" type="button">
                                    <span aria-hidden="true">&nbsp; &nbsp; &times;</span>
                                </button>
                                <strong>خطأ</strong>&nbsp; &nbsp; {{$message}}
                            </div>
                        </span>
                        @enderror

                        {{-- كلمة المرور   --}}

                        <div class="wrap-input100 validate-input m-b-18" data-validate="كلمة المرور مطلوبة">
                            <input id="password" type="password" placeholder="أدخل كلمة المرور" @error('password') is-invalid @enderror name="password" autocomplete="current-password" class="input100" autocomplete="new-password">
                        </div>

                        @error('password')
                        <span role="alert" style="width: 100%;margin-top: -9px;">
                            <div class="alert alert-danger" role="alert" style="border-radius: 8px;">
                                <button aria-label="Close" class="close" data-dismiss="alert" type="button">
                                    <span aria-hidden="true">&nbsp; &nbsp; &times;</span>
                                </button>
                                <strong>خطأ</strong>&nbsp; &nbsp; {{$message}}
                            </div>
                        </span>
                        @enderror

                        {{-- تأكيد كلمة المرور   --}}

                        <div class="wrap-input100 validate-input m-b-18" data-validate="تأكيد كلمة المرور مطلوب">
                            <input id="password_confirmation" type="password" placeholder="أعد إدخال كلمة المرور " @error('password_confirmation') is-invalid @enderror name="password_confirmation" class="input100" autocomplete="new-password">
                        </div>

                        @error('password_confirmation')

                        <span role="alert" style="width: 100%;margin-top: -9px;">
                            <div class="alert alert-danger" role="alert" style="border-radius: 8px;">
                                <button aria-label="Close" class="close" data-dismiss="alert" type="button">
                                    <span aria-hidden="true">&nbsp; &nbsp; &times;</span>
                                </button>
                                <strong>خطأ</strong>&nbsp; &nbsp; {{$message}}
                            </div>
                        </span>
                        @enderror

                        <div class="container-login100-form-btn">
                            <button type="submit" class="login100-form-btn" style="background: #2196f3;font-size: 19px;">
                                التسجيل
                            </button>
                        </div>

                        <div class="links">
                            <a href="{{route("login")}}">
                                مسجل بالفعل؟
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
