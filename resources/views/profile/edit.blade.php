@extends('layouts.master')

@section('title','تعديل الملف الشخصي')

@section('css')
<link href="{{URL::asset('assets/plugins/select2/css/select2.min.css')}}" rel="stylesheet">
@endsection

@section('page-header')
<div class="breadcrumb-header justify-content-between">
    <div class="my-auto">
        <div class="d-flex">
            <h4 class="content-title mb-0 my-auto">الاعدادات</h4>
            <span class="text-muted mt-1 tx-13 mr-2 mb-0">/ تعديل الملف الشخصي</span>
        </div>
    </div>

</div>
@endsection


@section('content')
<!-- row -->
<div class="row row-sm">
    <!-- Col -->
    <div class="col-lg-4">

        <div class="card mg-b-20">
            <div class="card-body">
                <div class="pl-0">
                    <div class="main-profile-overview">
                        <div class="main-img-user profile-user" style="position: relative">
                            <img alt="" src="{{URL::asset('assets/img/faces/6.jpg')}}">
                            <a class="fas fa-camera profile-edit" style="position: absolute;bottom: 0;"></a>

                        </div>
                        <div class="d-flex justify-content-between mg-b-20">
                            <div>
                                <h5 class="main-profile-name">الاسم الكامل:
                                    <span style="color: dodgerblue ;font-size :larger">{{userName()}}</span>
                                </h5>
                                <p class="main-profile-name-text mt-3">الدور:
                                    @foreach(Auth::User()->getRoleNames() as $v)
                                    <label class="badge badge-success">{{ $v }}</label>
                                    @endforeach
                                </p>
                            </div>
                        </div>

                        <h6>السيرة الذاتية</h6>
                        <div class="main-profile-bio">
                            مرحبًا بك في صفحة السيرة الذاتية الخاصة بي. أنا موظف في هذه الشركة منذ سنوات عديدة. لدي خبرة واسعة في مجال العمل وقد قمت بالعديد من المشاريع الناجحة. أنا ملتزم بتقديم أفضل أداء في كل ما أقوم به. أتطلع دائمًا لتحقيق النجاح وتطوير مهاراتي.
                        </div>

                    </div>
                </div>
            </div>
        </div>

        <div class="card mg-b-20">
            <div class="card-body">
                <div class="main-content-label tx-13 mg-b-25">
                    الاتصال
                </div>
                <div class="main-profile-contact-list">
                    <div class="media" style="gap: 15px ">
                        <div class="media-icon bg-primary-transparent text-primary">
                            <i class="fa-solid fa-envelope"></i>
                        </div>
                        <div class="media-body">
                            <span>البريد الإلكتروني</span>
                            <div>
                                {{auth()->user()->email}}
                            </div>
                        </div>
                    </div>
                    <div class="media" style="gap: 15px ">
                        <div class="media-icon bg-success-transparent text-success">
                            <i class="fa fa-phone"></i>
                        </div>
                        <div class="media-body">
                            <span>رقم الهاتف</span>
                            <div>
                                <address>212678-980909+</address>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- Col -->
    <div class="col-lg-8">
        <div class="card">
            <x-app-layout>

                <div class="py-12" style="    background: white;">
                    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
                        <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                            <div class="max-w-xl">
                                @include('profile.partials.update-profile-information-form')
                            </div>
                        </div>

                        <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                            <div class="max-w-xl">
                                @include('profile.partials.update-password-form')
                            </div>
                        </div>

                        <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                            <div class="max-w-xl">
                                @include('profile.partials.delete-user-form')
                            </div>
                        </div>
                    </div>
                </div>


            </x-app-layout>


        </div>
    </div>
    <!-- /Col -->
</div>
<!-- row closed -->
</div>
<!-- Container closed -->
</div>
<!-- main-content closed -->
@endsection


@section('js')
<script src="{{URL::asset('assets/plugins/chart.js/Chart.bundle.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/select2/js/select2.min.js')}}"></script>
<script src="{{URL::asset('assets/js/select2.js')}}"></script>
@endsection
