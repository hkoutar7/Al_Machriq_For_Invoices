@extends('layouts.master')
@section('title',"قسم ادارة بيانات المستخدمين ")

@section('css')
<link href="{{URL::asset('assets/plugins/datatable/css/dataTables.bootstrap4.min.css')}}" rel="stylesheet" />
<link href="{{URL::asset('assets/plugins/datatable/css/buttons.bootstrap4.min.css')}}" rel="stylesheet">
<link href="{{URL::asset('assets/plugins/datatable/css/responsive.bootstrap4.min.css')}}" rel="stylesheet" />
<link href="{{URL::asset('assets/plugins/datatable/css/jquery.dataTables.min.css')}}" rel="stylesheet">
<link href="{{URL::asset('assets/plugins/datatable/css/responsive.dataTables.min.css')}}" rel="stylesheet">
<link href="{{URL::asset('assets/plugins/select2/css/select2.min.css')}}" rel="stylesheet">
<link href="{{URL::asset('assets/plugins/owl-carousel/owl.carousel.css')}}" rel="stylesheet">
<link href="{{URL::asset('assets/plugins/multislider/multislider.css')}}" rel="stylesheet">
<link href="{{URL::asset('assets/plugins/select2/css/select2.min.css')}}" rel="stylesheet">

@endsection


@section('page-header')
<!-- breadcrumb -->
<div class="breadcrumb-header justify-content-between">

    @if(session()->has("user_created"))
    <div class="alert alert-success" role="alert" style="position: absolute; top: 77px; left: 37px; border-radius: 9px;">
        <button aria-label="Close" class="close" data-dismiss="alert" type="button">
            <span aria-hidden="true"> &nbsp; &nbsp;&times;</span>
        </button>
        <strong>نجاح</strong>&nbsp; &nbsp; {{session()->get("user_created")}}
    </div>
    @endif

    @if(session()->has("user_updated"))
    <div class="alert alert-success" role="alert" style="position: absolute; top: 77px; left: 37px; border-radius: 9px;">
        <button aria-label="Close" class="close" data-dismiss="alert" type="button">
            <span aria-hidden="true"> &nbsp; &nbsp;&times;</span>
        </button>
        <strong>نجاح</strong>&nbsp; &nbsp; {{session()->get("user_updated")}}
    </div>
    @endif

    @if(session()->has("user_deleted"))
    <div class="alert alert-success" role="alert" style="position: absolute; top: 77px; left: 37px; border-radius: 9px;">
        <button aria-label="Close" class="close" data-dismiss="alert" type="button">
            <span aria-hidden="true"> &nbsp; &nbsp;&times;</span>
        </button>
        <strong>نجاح</strong>&nbsp; &nbsp; {{session()->get("user_deleted")}}
    </div>
    @endif
    @if(session()->has("changeStatus"))
    <div class="alert alert-success" role="alert" style="position: absolute; top: 77px; left: 37px; border-radius: 9px;">
        <button aria-label="Close" class="close" data-dismiss="alert" type="button">
            <span aria-hidden="true"> &nbsp; &nbsp;&times;</span>
        </button>
        <strong>نجاح</strong>&nbsp; &nbsp; {{session()->get("changeStatus")}}
    </div>
    @endif

    <div class="my-auto">
        <div class="d-flex">
            <h4 class="content-title mb-0 my-auto">المستخدمين</h4>
            <span class="text-muted mt-1 tx-13 mr-2 mb-0">/ قائمة المستخدمين</span>
        </div>
    </div>
</div>
<!-- breadcrumb -->
@endsection


@section('content')
<!-- row -->
<div class="row">

    <div class="col-xl-12">
        <div class="card">
            <div class="card-header pb-0">
                <div class="d-flex justify-content-between">
                    <h4 class="card-title mg-b-0">
                        @if($num_users == 0)
                        <span style="color: red;font-size: large;">
                            لا يوجد اي مستخدم
                        </span>&nbsp;
                        @elseif($num_users == 1)
                        <span style="color: #2196F3;font-size: large;">
                            يوجد مستخدم واحد
                        </span>&nbsp;
                        @else
                        <span style="color: #2196F3;font-size: large;">
                            هنالك {{$num_users}} مسخدمين
                        </span>&nbsp;
                        @endif</h4>
                    <i class="mdi mdi-dots-horizontal text-gray"></i>
                </div>
                <p class="tx-12 tx-gray-500 mb-2">مرحبا بك في قسم ادارة المستخدمين , يمكنك عن طريق هدا القسم التحكم في المستخدمين </p>

                @can('user-create')
                <div style="display: flex; justify-content: center; align-items: center;">
                    <div class="col-sm-6 col-md-4 col-xl-3 mg-t-20" style="">
                        <a href="{{ route('users.create') }}" class="btn btn-outline-primary btn-block">اضافة مستخدم &nbsp;&nbsp;&nbsp; <i class="fa fa-user-plus"></i></a>
                    </div>
                </div>
                @endcan

            </div>

            @can('user-list')
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table text-md-nowrap" id="example1">
                        <thead>
                            <tr>
                                <th class="wd-15p border-bottom-0">الرقم الترتيبي</th>
                                <th class="wd-15p border-bottom-0">الاسم الكامل</th>
                                <th class="wd-20p border-bottom-0">الايميل</th>
                                <th class="wd-15p border-bottom-0">حالة الحساب</th>
                                <th class="wd-10p border-bottom-0">الوظيفة</th>
                                <th class="wd-25p border-bottom-0">العمليات</th>

                            </tr>
                        </thead>
                        <tbody>
                            @php
                            $i = 1;
                            @endphp
                            @foreach($users as $user)
                            <tr>
                                <td>{{$i++}}</td>
                                <td>{{$user->name}} </td>
                                <td>{{$user->email}}</td>
                                <td>
                                    @if ($user->status == 1)
                                    <span style="position:relative; display :block;width : 50% ;margin: 0 auto ;background-color: #6aa52b; " class="badge badge-success">
                                        <span style="position: absolute; top: -4px; right: -3px" class="avatar-status profile-status bg-green"></span>
                                        مفعل
                                    </span>
                                    @else
                                    <span style="position:relative; display :block; width : 50%;margin: 0 auto ;background-color: #cf5151;; " class="badge badge-success">
                                        <span style="position: absolute; top: -2px; right: -2px" class=" pulse-danger"></span>
                                        موقوف
                                    </span>
                                    @endif
                                </td>
                                <td>
                                    @if(!empty($user->getRoleNames()))
                                    @foreach($user->getRoleNames() as $v)
                                    <label class="badge badge-success">{{ $v }}</label>
                                    @endforeach
                                    @endif
                                </td>
                                <td>
                                    @can('user-show')
                                    <a class="btn btn-outline-success" href="{{ route('users.show',$user->id) }}"><i class="fa fa-user-tie"></i></a>
                                    @endcan
                                    @can('user-edit')
                                    <a class="btn btn-outline-primary" href="{{ route('users.edit',$user->id) }}"> <i class="fa fa-user-pen"></i></a>
                                    @endcan
                                    @can('user-delete')
                                    <a class="modal-effect btn btn-outline-danger" data-effect="effect-slide-in-right" data-toggle="modal" href="#DeleteModal" data-id='{{ $user->id }}' data-name='{{$user->name}}' data-password='{{$user->password}}'><i class="fa fa-user-slash"></i></a>
                                    @endcan
                                    @can('user-changeStatus')
                                    <a class="modal-effect btn btn-outline-danger" data-effect="effect-slide-in-right" data-toggle="modal" href="#ChangeStatus" data-id='{{ $user->id }}' data-name='{{$user->name}}' data-status='{{$user->status}}'><i class="fa fa-ban"></i></a>
                                    @endcan
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            @endcan
        </div>
    </div>





</div>
<!-- row closed -->
</div>
<!-- Container closed -->
</div>
<!-- main-content closed -->
@endsection

<!--Start Modal Delete -->
<div class="modal" id="DeleteModal">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content modal-content-demo">

            <div class="modal-header">
                <h6 class="modal-title">حدف الحساب</h6>
                <button aria-label="Close" class="close" data-dismiss="modal" type="button">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form action="{{ url('users/destroy') }}" method="post" autocomplete="off">
                @csrf
                @method('DELETE')
                <div class="modal-body">
                    <input type="hidden" name="id" id="id" value="">
                    <label for="name" class="form-label">اسم المستخدم:</label>
                    <input type="text" class="form-control" id="name" name="name" value="" readonly>
                    {{-- <label for="password" class="form-label">كلمة السر الخاصة بالحساب:</label>
                    <input type="text" class="form-control" id="password" name="password" > --}}
                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn ripple btn-danger">حذف</button>
                    <button class="btn ripple btn-secondary" data-dismiss="modal" type="button">الغاء</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!--End Modal Delete -->

<!--Start Modal ChangeStatus -->
<div class="modal" id="ChangeStatus">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content modal-content-demo">

            <div class="modal-header">
                <h6 class="modal-title">تغييير حالة المستخدم</h6>
                <button aria-label="Close" class="close" data-dismiss="modal" type="button">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form action="{{ url('users/changeStatus') }}" method="post" autocomplete="off">
                @csrf
                @method('POST')
                <div class="modal-body">
                    <input type="hidden" name="id" id="id" value="">
                    <input type="hidden" name="status" id="status" value="">
                    <label for="name" class="form-label">اسم المستخدم:</label>
                    <input type="text" class="form-control" id="name" name="name" value="" readonly>
                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn ripple " id="changeBtn"></button>
                    <button class="btn ripple btn-secondary" data-dismiss="modal" type="button">الغاء</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!--End Modal ChangeStatus -->




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


<script>
    $('#DeleteModal').on('show.bs.modal', function(event) {
        let btn = $(event.relatedTarget)
        let id = btn.data('id')
        let name = btn.data('name')

        let mod = $(this)

        mod.find('.modal-body #id').val(id);
        mod.find('.modal-body #name').val(name);
    })


    $('#ChangeStatus').on('show.bs.modal', function(event) {
        let btn = $(event.relatedTarget);
        let id = btn.data('id');
        let name = btn.data('name');
        let status = btn.data('status');

        let mod = $(this);

        mod.find('.modal-body #id').val(id);
        mod.find('.modal-body #name').val(name);
        mod.find('.modal-body #status').val(status);

        let changeBtn = $('#changeBtn');

        if (status == 1) {
            changeBtn.text('"تعطيل الحساب')
                .addClass('btn-danger')
                .removeClass('btn-success');
        } else {
            changeBtn.text('تفعيل الحساب')
                .addClass('btn-success')
                .removeClass('btn-danger');
        }
    });

</script>

@endsection
