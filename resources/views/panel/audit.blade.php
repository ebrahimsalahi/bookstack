@section('title','گزارشات')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-12">
                        <h1 class="m-0 text-dark">گزارشات</h1>
                        <ol class="breadcrumb float-sm-right mt-2 mb-2">
                            <li class="breadcrumb-item"><a href="{{route('panel')}}">پنل مدیریت</a></li>
                            <li class="breadcrumb-item active"> گزارشات</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->


        <section class="content">
            <div class="container-fluid">

                <!-- /.row -->
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header mb-3">
                                <h3 class="card-title">جدول گزارشات کاربران</h3>

                            </div>
                            <!--  /.card-header -->

                            <div class="card-body table-responsive ">
                                <table class="table table-hover mb-5" id="tb_audit">
                                    <thead>
                                    <tr>
                                        <th>ردیف</th>
                                        <th>شناسه کاربر</th>
                                        <th>رویداد</th>
                                        <th>زمان ایجاد</th>
                                    </tr>
                                    </thead>
                                    <tbody>


                                    </tbody>

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
