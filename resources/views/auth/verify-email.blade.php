@extends('layouts.master2')

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
            شكرًا لتسجيلك! قبل أن تبدأ، هل يمكنك تأكيد عنوان بريدك الإلكتروني عن طريق النقر على الرابط الذي أرسلناه لك عبر البريد الإلكتروني؟ إذا لم تتلقَّ البريد الإلكتروني، سنكون سعداء بإعادة إرساله لك
        </div>

        @if (session('status') == 'verification-link-sent')
        <div class="mb-4 font-medium text-sm text-green-600">
            {{ __('تم إرسال رابط التحقق الجديد إلى عنوان البريد الإلكتروني الذي قدّمته أثناء التسجيل.') }}
        </div>
        @endif

        <div class="mt-4 flex items-center justify-between">

            <form method="POST" action="{{ route('verification.send') }}">
                @csrf
                <button type='submit' class="btn btn-primary">
                    إعادة إرسال رسالة التحقق
                </button>
            </form>

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="btn btn-secondary">
                    {{ __('تسجيل الخروج') }}
                </button>
            </form>
        </div>
    </div>

</div>


<!-- /Main-error-wrapper -->
@endsection


@section('js')
@endsection
