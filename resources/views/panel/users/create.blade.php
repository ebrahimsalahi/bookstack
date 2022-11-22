@section('title','کاربران')
@section('content')

    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">

                    <div class="col-sm-12">
                        <h1 class="m-0 text-dark">کاربران</h1>
                        <ol class="breadcrumb float-sm-right mt-2 mb-2">
                            <li class="breadcrumb-item"><a href="{{route('panel')}}">پنل مدیریت</a></li>
                            <li class="breadcrumb-item active">افزودن کاربر</li>
                        </ol>
                    </div><!-- /.col -->
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <section class="content">
            <div class="container-fluid">
                <div class="row">

                    <div class="col-md-12">
                        <!-- general form elements -->
                        <div class="card card-light">
                            <div class="card-header">
                                <h3 class="card-title">افرودن کاربر جدید</h3>
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->
                            <div class="card-body">
                                <form action="{{route('saveUser')}}" method="post" class="form_ajaxi">
                                    @csrf


                                    <div class="row">
                                        <div class="col-md-4 my-1">
                                            <label for="name">نام و نام خانوادگی</label>
                                            <input type="text" class="form-control" id="name" name="name">
                                        </div>
                                        <div class="col-md-4 my-1">
                                            <label for="email">ایمیل</label>
                                            <input type="email" class="form-control" id="email" name="email">
                                        </div>
                                        <div class="col-md-4 my-1">
                                            <label for="mobile">موبایل</label>
                                            <input type="text" class="form-control" id="mobile" name="mobile">
                                        </div>

                                        <div class="col-md-4 my-1">
                                            <label>نقش کاربر</label>
                                            <select name="role" class="form-control select2 p-2" style="width: 100%;">
                                                <option selected="selected" value="0">انتخاب کنید</option>
                                                @foreach($roles as $role)
                                                    <option value="{{$role->id}}">{{ $role->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>


                                        <div class="col-md-4 my-1">
                                            <label for="password">رمزعبور</label>
                                            <input type="text" class="form-control" id="password" name="password">
                                        </div>
                                        <div class="col-md-4 my-1">
                                            <div class="form-check p-5">
                                                <input type="checkbox" name="is_active" checked class="form-check-input"
                                                       id="exampleCheck1">
                                                <label class="form-check-label" for="exampleCheck1"> کاربر فعال
                                                    باشد </label>
                                            </div>
                                        </div>
                                        <div class="col-md-12 my-1">

                                            <button type="submit" class="btn btn-primary">ثبت کاربر</button>
                                        </div>
                                    </div>

                                </form>

                            </div>
                        </div>
                        <!-- /.card -->


                    </div>


                </div>
                <!-- /.row -->
            </div><!-- /.container-fluid -->
        </section>
    </div>
@endsection

@extends('panel.layouts.master')
