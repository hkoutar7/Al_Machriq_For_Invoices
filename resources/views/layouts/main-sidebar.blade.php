<!-- main-sidebar -->
<div class="app-sidebar__overlay" data-toggle="sidebar"></div>
<aside class="app-sidebar sidebar-scroll">
    <div class="main-sidebar-header active">
        <div class="desktop-logo logo-light active" style="display: flex; align-items: center; justify-content: space-around; gap: 7px; font-size: 17px; font-weight: 800; color: #277aec;">
            <img src="{{URL::asset('myImages/logo.png')}}" class="main-logo" alt="logo">
            <span>Al Machriq</span>
        </div>
        {{-- <a class="desktop-logo logo-dark active" href="{{ url('/' . $page='index') }}"><img src="{{URL::asset('assets/img/brand/logo-white.png')}}" class="main-logo dark-theme" alt="logo"></a> --}}
        {{-- <a class="logo-icon mobile-logo icon-light active" href="{{ url('/' . $page='index') }}"><img src="{{URL::asset('assets/img/brand/favicon.png')}}" class="logo-icon" alt="logo"></a> --}}
        {{-- <a class="logo-icon mobile-logo icon-dark active" href="{{ url('/' . $page='index') }}"><img src="{{URL::asset('assets/img/brand/favicon-white.png')}}" class="logo-icon dark-theme" alt="logo"></a> --}}
    </div>
    <div class="main-sidemenu">
        <div class="app-sidebar__user clearfix">
            <div class="dropdown user-pro-body">
                <div class="">
                    <img alt="user-img" class="avatar avatar-xl brround" src="{{URL::asset('assets/img/faces/6.jpg')}}"><span class="avatar-status profile-status bg-green"></span>
                </div>
                <div class="user-info" >
                    <h4 class="font-weight-semibold mt-3 mb-0"> {{auth()->user()->name}} </h4>
                    <span class="mb-0 text-muted">{{auth()->user()->email}}</span>
                </div>
            </div>
        </div>
        <ul class="side-menu">
            <li class="side-item side-item-category">برنامج الفواتير</li>
            <li class="slide">
                <a class="side-menu__item" href="{{ route("dashboard") }}"><svg xmlns="http://www.w3.org/2000/svg" class="side-menu__icon" viewBox="0 0 24 24">
                        <path d="M0 0h24v24H0V0z" fill="none" />
                        <path d="M5 5h4v6H5zm10 8h4v6h-4zM5 17h4v2H5zM15 5h4v2h-4z" opacity=".3" />
                        <path d="M3 13h8V3H3v10zm2-8h4v6H5V5zm8 16h8V11h-8v10zm2-8h4v6h-4v-6zM13 3v6h8V3h-8zm6 4h-4V5h4v2zM3 21h8v-6H3v6zm2-4h4v2H5v-2z" /></svg><span class="side-menu__label">الرئيسية</span></a>
            </li>

            @can('invoices')
            <li class="side-item side-item-category">الفواتير</li>

            <li class="slide">
                <a class="side-menu__item icon" data-toggle="slide" href="{{ url('/' . $page='#') }}">
                    <i class="fa fa-file-invoice icon"></i>
                    <span class="side-menu__label">الفواتير</span>
                </a>
                <ul class="slide-menu">
                    @can('invoice-principal')
                    <li><a class="slide-item" href="{{ route("invoices.index") }}">قائمة الفواتير</a></li>
                    @endcan
                    @can('invoice-paid')
                    <li><a class="slide-item" href="{{ route("invoices.paidInvoices") }}">الفواتير المدفوعة</a></li>
                    @endcan
                    @can('invoice-unpaid')
                    <li><a class="slide-item" href="{{ route('invoices.unpaidInvoices') }}">الفواتير الغير مدفوعة</a></li>
                    @endcan
                    @can('invoice-halfpaid')
                    <li><a class="slide-item" href="{{ route('invoices.halfpaidInvoices') }}">الفواتير المدفوعة جزئيا</a></li>
                    @endcan
                    @can('invoice-archive')
                    <li><a class="slide-item" href="{{ route('invoicesArchives.index') }}">ارشيف الفواتير</a></li>
                    @endcan
                </ul>
            </li>
            @endcan

            @can('reports')
            <li class="side-item side-item-category">التقارير</li>
            <li class="slide">
                <a class="side-menu__item icon" data-toggle="slide" href="{{ url('/' . $page='#') }}">
                    <i class="fa fa-file icon"></i>
                    <span class="side-menu__label">التقارير</span><i class="angle fe fe-chevron-down"></i></a>
                <ul class="slide-menu">
                    @can('report-invoice')
                    <li><a class="slide-item" href="{{ route('reportInvoice.index') }}">تقارير الفواتير</a></li>
                    @endcan
                    @can('report-user')
                    <li><a class="slide-item" href="{{ route('reportClient.showClient') }}">تقارير العملاء</a></li>

                    @endcan
                </ul>
            </li>
            @endcan

            @can('users')
            <li class="side-item side-item-category">المستخدمين</li>
            <li class="slide">
                <a class="side-menu__item icon" data-toggle="slide" href="{{ url('/' . $page='#') }}">
                    <i class="fa fa-user icon"></i>
                    <span class="side-menu__label">المستخدمين</span>
                </a>
                <ul class="slide-menu">
                    @can('user-principal')
                    <li><a class="slide-item" href="{{ route('users.index') }}">قائمة المستخدمين</a></li>
                    @endcan
                    @can('user-role')
                    <li><a class="slide-item" href="{{ route('roles.index') }}">صلاحيات المستخدمين</a></li>
                    @endcan
                </ul>
            </li>
            @endcan

            @can('settings')
            <li class="side-item side-item-category">الاعدادات</li>
            <li class="slide">
                <a class="side-menu__item icon" data-toggle="slide" href="{{ url('/' . $page='#') }}">
                    <i class="icon special-icon"></i>
                    <span class="side-menu__label">الاعدادات</span>
                </a>
                <ul class="slide-menu">
                    @can('setting-section')
                    <li><a class="slide-item" href="{{ route("sections.index") }}">ادارة الاقسام</a></li>
                    @endcan
                    @can('setting-product')
                    <li><a class="slide-item" href="{{ route('products.index') }}">ادارة المنتجات</a></li>
                    @endcan
                </ul>
            </li>
            @endcan

        </ul>
    </div>

</aside>
<!-- main-sidebar -->
