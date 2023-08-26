@extends('layouts.master')

@section('css')
@endsection


@section('page-header')
<!-- breadcrumb -->
<div class="breadcrumb-header justify-content-between">
    <div class="my-auto">
        <div class="d-flex">
            <h4 class="content-title mb-0 my-auto">المستخدمين</h4>
            <a href={{route('roles.index')}} class="content-title mb-0 my-auto" style="margin-right: 8px; transform: translateY(1px); font-weight: 700;">/ صلاحيات المستخدمين</a>
            <span class="text-muted mt-1 tx-13 mr-2 mb-0" style="margin-right: 8px; transform: translateY(1px);">/ اظهار صلاحيات المستخدمين</span>
        </div>
    </div>


</div>
<!-- breadcrumb -->
@endsection


@section('content')
<!-- row -->
<div class="d-flex justify-content-center align-items-center" style="min-height: calc(100vh - 129px);">

    <div class="col-12 col-sm-6 col-lg-6 col-xl-3">
        <div class="card card-primary" style="width: 400px; transform: translateX(100px);">
            <div class="card-header pb-0">
                <h5 class="card-title mb-0 pb-0" style="text-align: center; font-size: 19px; margin-bottom: 19px !important;">
                    <span style="font-weight: 800;">الدور</span>
                    <span style="color: dodgerblue">{{ $role->name  }}</span>
                </h5>
            </div>
            <hr>
            <div class="card-body text-primary">
                <p class="mb-4" style="font-weight: 800;">الصلاحيات:</p>
                <div style="font-size: 17px; color: black; ">
                    @if(!empty($rolePermissions))
                    @foreach($rolePermissions as $v)
                    <p style="margin: 0 5px;">-<bdi dir="ltr">{{ $v->name }}</bdi></p>
                    @endforeach
                    @endif
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
@endsection
