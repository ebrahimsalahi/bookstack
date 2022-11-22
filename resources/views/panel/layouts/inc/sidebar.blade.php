<aside class="main-sidebar sidebar-dark-primary elevation-4" style="min-height: 815px;">
    <!-- Brand Logo -->
    <a href="{{route('panel')}}" class="brand-link">
        <img src="{{url('panel/dist/img/AdminLTELogo.png')}}" alt="panel" class="brand-image img-circle elevation-3"
             style="opacity: .8">
        <span class="brand-text font-weight-light">پنل مدیریت</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <div>
            <!-- Sidebar user panel (optional) -->
            <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                <div class="image">
                    <img src="{{ url('files/avatars/'.auth()->user()->avatar->name) }}" class="img-circle elevation-2"
                         alt="User Image">
                </div>
                <div class="info">
                    <a href="{{route('account')}}" class="d-block">{{ auth()->user()->name }}</a>
                </div>
            </div>

            <!-- Sidebar Menu -->
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                    data-accordion="false">


                    <li class="nav-item">
                        <a href="{{ route('panel') }}" class="nav-link @if($menu == 'dashboard') active @endif ">
                            <i class="nav-icon fa fa-dashboard"></i>
                            <p>داشبورد</p>
                        </a>
                    </li>

                    @can('check','users_view')
                        <li class="nav-item">
                            <a href="{{ route('users') }}" class="nav-link @if($menu == 'users') active @endif ">
                                <i class="nav-icon fa fa-users"></i>
                                <p>کاربران</p>
                            </a>
                        </li>
                    @endcan

                    @can('check','shelves_view')
                        <li class="nav-item">
                            <a href="{{ route('shelves') }}" class="nav-link @if($menu == 'shelves') active @endif ">
                                <i class="nav-icon fa fa-bars"></i>
                                <p>قفسه ها</p>
                            </a>
                        </li>
                    @endcan

                    @can('check','books_view')
                        <li class="nav-item">
                            <a href="{{ route('books') }}" class="nav-link @if($menu == 'books') active @endif ">
                                <i class="nav-icon  fa fa-book"></i>
                                <p>کتاب ها</p>
                            </a>
                        </li>
                    @endcan


                    @can('check','chapters_view')
                        <li class="nav-item">
                            <a href="{{ route('chapters') }}" class="nav-link @if($menu == 'chapters') active @endif ">
                                <i class="nav-icon fa fa-layer-group"></i>
                                <p> فصل ها</p>
                            </a>
                        </li>
                    @endcan

                    @can('check','pages_view')
                        <li class="nav-item">
                            <a href="{{ route('pages') }}" class="nav-link @if($menu == 'pages') active @endif ">
                                <i class="nav-icon fa fa-file"></i>
                                <p> صفحه ها</p>
                            </a>
                        </li>
                    @endcan

                    @can('check','audit_view')
                        <li class="nav-item">
                            <a href="{{ route('audit') }}" class="nav-link @if($menu == 'audit') active @endif ">
                                <i class="nav-icon fa fa-solid fa-flag"></i>
                                <p>گزارشات</p>
                            </a>
                        </li>
                    @endcan






                    @can('check','roles_view')
                        <li class="nav-item">
                            <a href="{{ route('roles') }}" class="nav-link @if($menu == 'roles') active @endif ">
                                <i class="nav-icon  fa fa-user-shield"></i>
                                <p>نقش ها</p>
                            </a>
                        </li>
                    @endcan

                    <li class="nav-item">
                        <a href="{{ route('account') }}" class="nav-link @if($menu == 'account') active @endif ">
                            <i class="nav-icon fa fa-user-gear"></i>
                            <p>پروفایل</p>
                        </a>
                    </li>
                    @can('check','comments')
                    <li class="nav-item">
                        <a href="{{ route('comments') }}" class="nav-link @if($menu == 'comments') active @endif ">
                            <i class="nav-icon fa fa-comments"></i>
                            <p>نظرات</p>
                            @php
                                $count = App\BookComment::where('status','=','0')->count()
                            @endphp
                            @if($count > 0)
                                <span class="right badge badge-danger">{{$count}}</span>
                            @endif
                        </a>
                    </li>
                    @endcan

                    @can('check','settings')
                    <li class="nav-item">
                        <a href="{{ route('settings') }}" class="nav-link @if($menu == 'setting')  active @endif ">
                            <i class=" nav-icon fa fa-cogs"></i>
                            <p>تنظیمات</p>
                        </a>
                    </li>
                    @endcan

                    <li class="nav-item">
                        <a href="{{ route('logout') }}" class="nav-link">
                            <i class="nav-icon fa fa-sign-out"></i>
                            <p>خروج</p>
                        </a>
                    </li>
                </ul>
            </nav>
            <!-- /.sidebar-menu -->
        </div>
    </div>
    <!-- /.sidebar -->
</aside>
