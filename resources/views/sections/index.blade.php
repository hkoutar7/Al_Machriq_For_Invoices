@extends('layouts.master')

@section('title',"ادارة الاقسام")

@section('css')
<link href="{{URL::asset('assets/plugins/datatable/css/dataTables.bootstrap4.min.css')}}" rel="stylesheet" />
<link href="{{URL::asset('assets/plugins/datatable/css/buttons.bootstrap4.min.css')}}" rel="stylesheet">
<link href="{{URL::asset('assets/plugins/datatable/css/responsive.bootstrap4.min.css')}}" rel="stylesheet" />
<link href="{{URL::asset('assets/plugins/datatable/css/jquery.dataTables.min.css')}}" rel="stylesheet">
<link href="{{URL::asset('assets/plugins/datatable/css/responsive.dataTables.min.css')}}" rel="stylesheet">
<link href="{{URL::asset('assets/plugins/select2/css/select2.min.css')}}" rel="stylesheet">
<link href="{{URL::asset('assets/plugins/prism/prism.css')}}" rel="stylesheet">
<link href="{{URL::asset('assets/plugins/custom-scroll/jquery.mCustomScrollbar.css')}}" rel="stylesheet" />
@endsection


@section('page-header')
<!-- Start breadcrumb -->
<div class="breadcrumb-header justify-content-between">

    @if(session()->has("fail_create"))
    <div class="alert alert-danger" role="alert" style="position: absolute; top: 77px; left: 37px; border-radius: 9px;">
        <button aria-label="Close" class="close" data-dismiss="alert" type="button">
            <span aria-hidden="true">&nbsp; &nbsp; &times;</span>
        </button>
        <strong>خطا</strong>&nbsp; &nbsp; {{session()->get("fail_create")}}
    </div>
    @endif

    @if(session()->has("success_create"))
    <div class="alert alert-success" role="alert" style="position: absolute; top: 77px; left: 37px; border-radius: 9px;">
        <button aria-label="Close" class="close" data-dismiss="alert" type="button">
            <span aria-hidden="true"> &nbsp; &nbsp;&times;</span>
        </button>
        <strong>نجاح</strong>&nbsp; &nbsp; {{session()->get("success_create")}}
    </div>
    @endif

    @if(session()->has("edit_success"))
    <div class="alert alert-success" role="alert" style="position: absolute; top: 77px; left: 37px; border-radius: 9px;">
        <button aria-label="Close" class="close" data-dismiss="alert" type="button">
            <span aria-hidden="true"> &nbsp; &nbsp;&times;</span>
        </button>
        <strong>نجاح</strong>&nbsp; &nbsp; {{session()->get("edit_success")}}
    </div>
    @endif

    @if(session()->has("delete_success"))
    <div class="alert alert-success" role="alert" style="position: absolute; top: 77px; left: 37px; border-radius: 9px;">
        <button aria-label="Close" class="close" data-dismiss="alert" type="button">
            <span aria-hidden="true"> &nbsp; &nbsp;&times;</span>
        </button>
        <strong>نجاح</strong>&nbsp; &nbsp; {{session()->get("delete_success")}}
    </div>
    @endif

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


    <div class="my-auto">
        <div class="d-flex">
            <a href="{{ route("sections.index") }}" class="content-title mb-0 my-auto"> الاعدادات</a><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ ادارة الاقسام</span>
        </div>
    </div>
</div>
<!-- End breadcrumb -->
@endsection


@section('content')

<!-- row -->

<div class="col-xl-12">
    <div class="card mg-b-20">
        <div class="card">
            <div class="card-header pb-0">
                <div class="d-flex justify-content-between">
                    <h4 class="card-title mg-b-0">
                        @if($section_num == 0)
                        <span style="color: red;font-size: large;">
                            لا يوجد قسم
                        </span>&nbsp;
                        @elseif($section_num == 1)
                        <span style="color: #2196F3;font-size: large;">
                            هناك قسم واحد فقط
                        </span>&nbsp;
                        @else
                        <span style="color: #2196F3;font-size: large;">
                            هناك {{$section_num}} أقسام
                        </span>&nbsp;
                        @endif
                    </h4> <i class="mdi mdi-dots-horizontal text-gray"></i>

                </div>
                <p class="tx-12 tx-gray-500 mb-2">ادارة الاقسام يمكنك التجكم عن طريق اضافة قسم تعديل قسم او حدف قسم</p>

                @can('section-create')
                <div style="position: relative; left: 50%; transform: translateX(-50%);">
                    <div class="col-sm-6 col-md-4 col-xl-3 mg-t-20" style="transform: translate(calc(-50% - 225px))">
                        <a class="modal-effect btn btn-outline-primary btn-block" data-effect="effect-super-scaled" data-toggle="modal" href="#modaldemo8">اضافة قسم</a>
                    </div>
                </div>
                @endcan

            </div>

            @can('section-list')
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table text-md-nowrap" id="example1" style="overflow: hidden;">
                        <thead>

                            <tr>
                                <th class="wd-15p border-bottom-0">#</th>
                                <th class="wd-15p border-bottom-0">القسم</th>
                                <th class="wd-20p border-bottom-0">وصف القسم</th>
                                <th class="wd-15p border-bottom-0">العمليات</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                            $i = 0
                            @endphp
                            @foreach($sections as $section)

                            <tr style="width : 100%">
                                <td>{{++$i}}</td>
                                <td>{{ $section->section_name }}</td>
                                <td>{{ $section->description }}</td>
                                <td style="display: flex;align-items: center; justify-content: center; flex-wrap: wrap; width: 100%;gap : 10px">
                                    @can('section-edit')
                                    <a style="width : 30%" class="modal-effect btn btn-outline-primary btn-block" data-effect="effect-slide-in-right" data-toggle="modal" href="#UpdateModal" data-id='{{$section->id}}' data-section_name='{{$section->section_name}}' data-description='{{$section->description}}'><i class="las la-pen"></i></a>
                                    @endcan
                                    @can('section-delete')
                                    <a style="width : 30%;margin-top: 0;" class="modal-effect btn btn-outline-danger btn-block" data-effect="effect-slide-in-right" data-toggle="modal" href="#DeleteModal" data-id='{{ $section->id }}' data-section_name='{{$section->section_name}}'><i class="las la-trash"></i></a>
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


<!-- Start Add Section -->
<div class="modal" id="modaldemo8">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content modal-content-demo">

            <div class="modal-header">
                <h6 class="modal-title">املئ الاستمارة حتى تضيف قسم</h6><button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
            </div>

            <form action="{{route("sections.store")}}" method="post" autocomplete="off">
                <div class="modal-body">
                    @csrf

                    <div class="mb-3 mt-3">
                        <label for="section_name" class="form-label">اسم القسم:</label>
                        <input type="text" class="form-control" id="section_name" placeholder="اكتب لقسم الخاص بك" name=" section_name" value="{{ old('section_name') }}">
                    </div>
                    <label for="description">وصف القسم:</label>
                    <textarea class="form-control" rows="5" id="description" name="description" placeholder="ادخل وصف للقسم">{{old('description')}}</textarea>

                </div>


                <div class="modal-footer">
                    <button type="submit" class="btn ripple btn-primary" type="button">حفظ</button>
                    <button class="btn ripple btn-secondary" data-dismiss="modal" type="button">الغاء</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- End Add Section-->


<!-- Start Moodal edit -->
<div class="modal" id="UpdateModal">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content modal-content-demo">

            <div class="modal-header">
                <h6 class="modal-title">عدل معلومات القسم عن طريق ملئ الاستمارة</h6><button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
            </div>

            <form action="sections/update" method="post" autocomplete="off">
                <div class="modal-body">
                    @csrf
                    @method('PUT')

                    <div class="mb-3 mt-3">
                        <input type="hidden" name="id" id="id" value="">
                        <label for="section_name" class="form-label">اسم القسم:</label>
                        <input type="text" class="form-control" id="section_name" placeholder="اكتب لقسم الخاص بك" name="section_name" value="">
                    </div>
                    <label for="description">وصف القسم:</label>
                    <textarea class="form-control" rows="5" id="description" name="description" placeholder="ادخل وصف للقسم"></textarea>

                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn ripple btn-primary" type="button">حفظ</button>
                    <button class="btn ripple btn-secondary" data-dismiss="modal" type="button">الغاء</button>
                </div>
            </form>
        </div>
    </div>

</div>
<!-- End Modal edit -->

<!--Start Modal Delete -->
<div class="modal" id="DeleteModal">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content modal-content-demo">

            <div class="modal-header">
                <h6 class="modal-title">حذف هذا القسم</h6>
                <button aria-label="Close" class="close" data-dismiss="modal" type="button">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form action="sections/destroy" method="post" autocomplete="off">
                @csrf
                @method('DELETE')
                <div class="modal-body">
                    <input type="hidden" name="id" id="id" value="">
                    <label for="section_name" class="form-label">اسم القسم:</label>
                    <input type="text" class="form-control" id="section_name" name="section_name" value="" readonly>
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


@endsection


</div>


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
<script src="{{URL::asset('assets/js/table-data.js')}}"></script>
<script src="{{URL::asset('assets/js/modal.js')}}"></script>
<script src="{{URL::asset('assets/plugins/jquery-ui/ui/widgets/datepicker.js')}}"></script>
<script src="{{URL::asset('assets/plugins/custom-scroll/jquery.mCustomScrollbar.concat.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/clipboard/clipboard.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/clipboard/clipboard.js')}}"></script>
<script src="{{URL::asset('assets/plugins/prism/prism.js')}}"></script>

{{-- script Start Modal edit  --}}
<script>
    $('#UpdateModal').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget)
        var id = button.data('id')
        var section_name = button.data('section_name')
        var description = button.data('description')
        var modal = $(this)
        modal.find('.modal-body #id').val(id);
        modal.find('.modal-body #section_name').val(section_name);
        modal.find('.modal-body #description').val(description);
    })

</script>
{{-- script End Modal edit  --}}

{{-- Start Modal delete  --}}
<script>
    $('#DeleteModal').on('show.bs.modal', function(event) {
        let btn = $(event.relatedTarget)
        let id = btn.data('id')
        let name = btn.data('section_name')

        let mod = $(this)

        mod.find('.modal-body #id').val(id);
        mod.find('.modal-body #section_name').val(name);
    })

</script>
{{-- End Modal delete  --}}


@endsection
