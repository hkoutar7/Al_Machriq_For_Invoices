@extends('layouts.master')
@section('title',"ادارة المنتجات")

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
<!-- breadcrumb -->
<div class="breadcrumb-header justify-content-between">

    @if(session()->has("created"))
    <div class="alert alert-success" role="alert" style="position: absolute; top: 77px; left: 37px; border-radius: 9px;">
        <button aria-label="Close" class="close" data-dismiss="alert" type="button">
            <span aria-hidden="true"> &nbsp; &nbsp;&times;</span>
        </button>
        <strong>نجاح</strong>&nbsp; &nbsp; {{session()->get("created")}}
    </div>
    @endif

    @if(session()->has("updated"))
    <div class="alert alert-success" role="alert" style="position: absolute; top: 77px; left: 37px; border-radius: 9px;">
        <button aria-label="Close" class="close" data-dismiss="alert" type="button">
            <span aria-hidden="true"> &nbsp; &nbsp;&times;</span>
        </button>
        <strong>نجاح</strong>&nbsp; &nbsp; {{session()->get("updated")}}
    </div>

    @endif
    @if(session()->has("deleted"))
    <div class="alert alert-success" role="alert" style="position: absolute; top: 77px; left: 37px; border-radius: 9px;">
        <button aria-label="Close" class="close" data-dismiss="alert" type="button">
            <span aria-hidden="true"> &nbsp; &nbsp;&times;</span>
        </button>
        <strong>نجاح</strong>&nbsp; &nbsp; {{session()->get("deleted")}}

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
        <a href="{{ route("products.index") }}" class="content-title mb-0 my-auto"> الاعدادات</a><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ ادارة المنتجات</span>
    </div>
</div>
<div class="d-flex my-xl-auto right-content">
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

                        @switch($prod_num)
                        @case(0)
                        <span style="color: firebrick">لا يوجد منتج</span>
                        @break
                        @case(1)
                        <span style="color: firebrick">هناك منتج واحد فقط</span>
                        @break
                        @default
                        <span style="color: dodgerblue">هناك {{$prod_num}} منتج</span>
                        @endswitch

                    </h4>
                    <i class="mdi mdi-dots-horizontal text-gray"></i>
                </div>
                <p class="tx-12 tx-gray-500 mb-2">ادارة العروض و المنتجات يمكنك التحكم عن طريق اضافة او التعديل او حدف منتج</p>

                @can('product-create')
                <div style="position: relative; left: 50%; transform: translateX(-50%);">
                    <div class="col-sm-6 col-md-4 col-xl-3 mg-t-20" style="transform: translate(calc(-50% - 225px))">
                        <a class="modal-effect btn btn-outline-primary btn-block" data-effect="effect-super-scaled" data-toggle="modal" href="#addProduct">اضافة منتج</a>
                    </div>
                </div>
                @endcan

            </div>

            @can('product-list')
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table text-md-nowrap" id="example1">
                        <thead>
                            <tr>
                                <th class="wd-15p border-bottom-0">#</th>
                                <th class="wd-15p border-bottom-0">اسم المنتج</th>
                                <th class="wd-15p border-bottom-0">اسم القسم</th>
                                <th class="wd-20p border-bottom-0">الوصف</th>
                                <th class="wd-25p border-bottom-0">العمليات</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                            $i = 0;
                            @endphp
                            @foreach($products as $product)
                            <tr>
                                <td>{{ ++$i }}</td>
                                <td>{{$product->product_name}}</td>
                                <td>{{$product->section->section_name }}</td>


                                <td>{!! $product->description ? $product->description : '<span style="color: red">لا يوجد وصف</span>' !!}</td>
                                <td style="display: flex;align-items: center; justify-content: center; flex-wrap: wrap; width: 100%;gap : 10px">

                                    @can('product-edit')
                                    <a style="width : 30%" class="modal-effect btn btn-outline-primary btn-block" data-effect="effect-scale" data-toggle="modal" href="#updateProduct" data-id='{{$product->id}}' data-product_name="{{$product->product_name}}" data-description="{{$product->description}}" data-section_name="{{$product->section->section_name }}"><i class="las la-pen"></i></a>
                                    @endcan
                                    @can('product-delete')
                                    <a style="width : 30%;margin-top: 0;" class="modal-effect btn btn-outline-danger btn-block" data-effect="effect-scale" data-toggle="modal" href="#deleteProduct" data-id='{{$product->id}}' data-product_name="{{$product->product_name}}"><i class="las la-trash"></i></a>
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


    {{-- Start Add Product  --}}
    <div class="modal" id="addProduct">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content modal-content-demo">

                <div class="modal-header">
                    <h6 class="modal-title">أدخل النموذج لإضافة منتج جديد</h6>
                    <button aria-label="إغلاق" class="close" data-dismiss="modal" type="button">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <form action="{{ route("products.store") }}" method="post" autocomplete="off">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3 mt-3">
                            <label for="product_name" class="form-label">اسم المنتج:</label>
                            <input type="text" class="form-control" id="product_name" placeholder="أدخل اسم المنتج" name="product_name" value="{{old("product_name")}}">
                        </div>
                        <select class="form-select form-control" name="section_id">
                            <option value="" disabled selected>اختر من البنوك المناسبة</option>
                            @foreach($sections as $section)
                            <option value={{ $section->id }} {{ old('section_id') ? 'selected'  : ""   }}>
                                {{ $section->section_name }}
                            </option>
                            @endforeach
                        </select>

                        <label for="description">الوصف :</label>
                        <textarea class="form-control" rows="5" id="description" name="description" placeholder="أدخل وصف المنتج">{{old("description")}}</textarea>
                    </div>

                    <div class="modal-footer">
                        <button type="submit" class="btn ripple btn-primary" type="button">حفظ</button>
                        <button class="btn ripple btn-secondary" data-dismiss="modal" type="button">الغاء</button>
                    </div>
                </form>


            </div>
        </div>
    </div>
    {{-- End Add Product  --}}

    {{-- Start Update Product  --}}
    <div class="modal" id="updateProduct">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content modal-content-demo">

                <div class="modal-header">
                    <h6 class="modal-title">أدخل النموذج modify منتج جديد</h6>
                    <button aria-label="إغلاق" class="close" data-dismiss="modal" type="button">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <form action="products/update" method="post" autocomplete="off">
                    @csrf
                    @method('put')
                    <div class="modal-body">
                        <div class="mb-3 mt-3">
                            <input type="hidden" name="id" id="id" value="">
                            <label for="product_name" class="form-label">اسم المنتج:</label>
                            <input type="text" class="form-control" placeholder="أدخل اسم المنتج" id="product_name" name="product_name" value="">
                        </div>
                        <select class="form-select form-control" name="section_name" id="section_name">
                            <option disabled selected>اختر من البنوك المناسبة</option>
                            @foreach($sections as $section)
                            <option>
                                {{ $section->section_name }}
                            </option>
                            @endforeach
                        </select>

                        <label for="description">الوصف :</label>
                        <textarea class="form-control" rows="5" id="description" name="description" placeholder="أدخل وصف المنتج"></textarea>
                    </div>

                    <div class="modal-footer">
                        <button type="submit" class="btn ripple btn-primary" type="button">حفظ</button>
                        <button class="btn ripple btn-secondary" data-dismiss="modal" type="button">الغاء</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
    {{-- End Update Product  --}}

    {{-- Start Delete Product  --}}
    <div class="modal" id="deleteProduct">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content modal-content-demo">

                <div class="modal-header">
                    <h6 class="modal-title">حذف المنتج</h6>
                    <button aria-label="إغلاق" class="close" data-dismiss="modal" type="button">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <form action="products/destroy" method="post" autocomplete="off">
                    @csrf
                    @method('delete')
                    <div class="modal-body">
                        <div class="mb-3 mt-3">
                            <input type="hidden" name="id" id="id" value="">
                            <label for="product_name" class="form-label">اسم المنتج:</label>
                            <input type="text" class="form-control" placeholder="أدخل اسم المنتج" id="product_name" name="product_name" value="" readonly>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="submit" class="btn ripple btn-danger" type="button">حذف</button>
                        <button class="btn ripple btn-secondary" data-dismiss="modal" type="button">الغاء</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
    {{-- End Delete Product  --}}


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
<script src="{{URL::asset('assets/js/table-data.js')}}"></script>
<script src="{{URL::asset('assets/js/modal.js')}}"></script>
<script src="{{URL::asset('assets/plugins/jquery-ui/ui/widgets/datepicker.js')}}"></script>
<script src="{{URL::asset('assets/plugins/custom-scroll/jquery.mCustomScrollbar.concat.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/clipboard/clipboard.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/clipboard/clipboard.js')}}"></script>
<script src="{{URL::asset('assets/plugins/prism/prism.js')}}"></script>

{{-- script Start Modal edit  --}}
<script>
    $('#updateProduct').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget)
        var product_name = button.data('product_name')
        var section_name = button.data('section_name')
        var id = button.data('id')
        var description = button.data('description')
        var modal = $(this)
        modal.find('.modal-body #product_name').val(product_name);
        modal.find('.modal-body #section_name').val(section_name);
        modal.find('.modal-body #description').val(description);
        modal.find('.modal-body #id').val(id);

    })

    $('#deleteProduct').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget)
        var product_name = button.data('product_name')
        var id = button.data('id')
        var modal = $(this)
        modal.find('.modal-body #product_name').val(product_name);
        modal.find('.modal-body #id').val(id);

    })

</script>
{{-- script End Modal edit  --}}



@endsection
