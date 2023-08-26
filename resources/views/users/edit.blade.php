@extends('layouts.master')

@section('title' , 'تعديل معلومات المستخدم')

@section('css')
<link href="{{URL::asset('assets/plugins/datatable/css/buttons.bootstrap4.min.css')}}" rel="stylesheet">
<link href="{{URL::asset('assets/plugins/datatable/css/responsive.bootstrap4.min.css')}}" rel="stylesheet" />
<link href="{{URL::asset('assets/plugins/datatable/css/jquery.dataTables.min.css')}}" rel="stylesheet">
<link href="{{URL::asset('assets/plugins/datatable/css/responsive.dataTables.min.css')}}" rel="stylesheet">
<link href="{{URL::asset('assets/plugins/select2/css/select2.min.css')}}" rel="stylesheet">
<link href="{{URL::asset('assets/plugins/owl-carousel/owl.carousel.css')}}" rel="stylesheet">
<link href="{{URL::asset('assets/plugins/multislider/multislider.css')}}" rel="stylesheet">
<link href="{{URL::asset('assets/plugins/select2/css/select2.min.css')}}" rel="stylesheet">
<link rel="stylesheet" href="{{asset('css/users/style.css')}}">

@endsection


@section('page-header')
<!-- breadcrumb -->
<div class="breadcrumb-header justify-content-between">
    <div class="my-auto">
        <div class="d-flex">
            <h4 class="content-title mb-0 my-auto">المستخدمين</h4>
            <a href={{route('users.index')}} class="content-title mb-0 my-auto" style="margin-right: 8px; transform: translateY(1px); font-weight: 700;">/ قائمة المستخدمين</a>
            <span class="text-muted mt-1 tx-13 mr-2 mb-0" style="margin-right: 8px; transform: translateY(1px);">/ تعديل معلومات المستخدم</span>

        </div>
    </div>

</div>
<!-- breadcrumb -->
@endsection


@section('content')
<!-- row -->
<div class="row">

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

    <div class="form_wrapper" style=" justify-content: center; flex-grow: 0.4;border-radius: 11px; box-shadow: rgba(17, 17, 26, 0.1) 0px 1px 0px, rgba(17, 17, 26, 0.1) 0px 8px 24px, rgba(17, 17, 26, 0.1) 0px 16px 48px;     margin-bottom: 80px;">
        <div class="form_container">

            <div class="title_container">
                <h2>edit the information of the user</h2>
            </div>

            <div class="row clearfix" style="justify-content: center;">
                <div style="width: 70% !important">
                    {!! Form::model($user, ['method' => 'PATCH','route' => ['users.update', $user->id]]) !!}

                    <div class="input_field"><span><i aria-hidden="true" class="fa fa-user"></i></span>
                        {!! Form::text('name', null, array('placeholder' => 'ادخل اسم الحساب','class' => 'form-control')) !!}
                    </div>
                    
                    <div class="input_field"> <span><i aria-hidden="true" class="fa fa-envelope"></i></span>
                        {!! Form::text('email', null, array('placeholder' => 'اكتب الايميل الخاصة بالحساب','class' => 'form-control')) !!}
                    </div>

                    <div class="input_field"> <span><i aria-hidden="true" class="fa fa-lock"></i></span>
                        {!! Form::password('password', array('placeholder' => 'ادخل كلمة السر الخاصة بالحساب','class' => 'form-control')) !!}
                    </div>

                    <div class="input_field"> <span><i aria-hidden="true" class="fa fa-lock"></i></span>
                        {!! Form::password('confirm-password', array('placeholder' => ' اعد ادخال كلمة السر الخاصة بالحساب','class' => 'form-control')) !!}
                    </div>


                    <div class="input_field select_option">
                        <p>اختر دور المستخدم من الادوار التالية</p>
                        {!! Form::select('roles[]', $roles,$userRole, array('class' => 'form-control','multiple')) !!}
                    </div>

                    <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                        <button type="submit" class="btn btn-primary">update</button>
                    </div>

                    {!! Form::close() !!}
                </div>
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
<script src="{{URL::asset('assets/plugins/datatable/js/jquery.dataTables.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/dataTables.dataTables.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/dataTables.responsive.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/responsive.dataTables.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/jquery.dataTables.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/dataTables.bootstrap4.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/dataTables.buttons.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/buttons.bootstrap4.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/jszip.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/pdfmake.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/vfs_fonts.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/buttons.html5.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/buttons.print.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/buttons.colVis.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/dataTables.responsive.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/responsive.bootstrap4.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/jquery-ui/ui/widgets/datepicker.js')}}"></script>
<script src="{{URL::asset('assets/plugins/select2/js/select2.min.js')}}"></script>
<script src="{{URL::asset('assets/js/modal.js')}}"></script>
<script src="{{URL::asset('assets/js/table-data.js')}}"></script>
@endsection
