@section('title','کاربران')
@section('content')

    <div class="content-wrapper" style="min-height: 255px;">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-12">
                        <h1 class="m-0 text-dark">کاربران</h1>
                        <ol class="breadcrumb float-sm-right mt-2 mb-2">
                            <li class="breadcrumb-item"><a href="{{route('panel')}}">پنل مدیریت</a></li>
                            <li class="breadcrumb-item active">کاربران</li>
                        </ol>
                    </div><!-- /.col -->
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">

                <!-- /.row -->
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header mb-3">
                                <h3 class="card-title">جدول کاربران</h3>
                                <div class="card-tools">

                                    @can('check','users_add')
                                        <a href="{{route('newUser')}}" class="btn btn-primary btn-sm float-left">
                                            <i class="fa fa-plus"></i>
                                            افزودن کاربر </a>
                                    @endcan
                                </div>
                            </div>
                            <!--  /.card-header -->

                            <div class="card-body table-responsive ">
                                <table class="table table-hover mb-5" id="tb_users">
                                    <thead>

                                    <tr>
                                        <th>شناسه</th>
                                        <th>نام</th>
                                        <th>وضعیت</th>
                                        <th>ایمیل</th>
                                        <th>موبایل</th>
                                        <th>نقش</th>
                                        <th>تاریخ ثبت نام</th>
                                        <th>عملیات</th>
                                    </tr>
                                    </thead>
                                    <tbody></tbody>

                                </table>

                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
@endsection

@extends('panel.layouts.master')
