@section('title','ثبت نام')

@section('pageStyle','login-page')

@section('content')

    @include('panel.layouts.inc.header')

    <div class="login-box">
        <div class="login-logo">
            <a href="{{ route('register') }}"><b> ثبت نام </b></a>
        </div>
        <!-- /.login-logo -->
        <div class="card">
            <div class="card-body login-card-body">
                <p class="login-box-msg">فرم زیر را تکمیل کنید و ثبت نام را بزنید</p>

                <form action="{{route('registerCheck')}}" method="post" class="form_ajaxi">
                    @csrf
                    <div class="form-group row">
                        <label for="name" class="col-form-label">نام کامل خود را وارد کنید</label>
                        <input type="text" class="form-control" id="name" name="name" autocomplete="off">
                    </div>
                    <div class="form-group row">
                        <label for="email" class="col-form-label">ایمیل</label>
                        <input type="text" class="form-control" id="email" name="email" autocomplete="off">
                    </div>
                    <div class="form-group row">
                        <label for="mobile" class="col-form-label">موبایل</label>
                        <input type="text" class="form-control" id="mobile" name="mobile" autocomplete="off">
                    </div>
                    <div class="form-group row">
                        <label for="password" class="col-form-label">رمزعبور</label>
                        <input type="text" class="form-control" id="password" name="password" autocomplete="off">
                    </div>
                    <div class="form-group row">
                        <label for="password_confirmation" class="col-form-label">تکرار رمزعبور</label>
                        <input type="text" class="form-control" id="password_confirmation" name="password_confirmation"
                               autocomplete="off">
                    </div>


                    <div class="row">

                        <div class="col-12">
                            <button type="submit" class="btn btn-primary btn-block btn-flat">ثبت نام</button>
                        </div>

                        <div class="col-sm-6">
                            <a href="{{route('home')}}" class="mb-1 mt-3 btn btn-success btn-block">
                                <i class="fa fa-home"></i>
                                صفحه اصلی
                            </a>
                        </div>
                        <div class="col-sm-6">
                            <a href="{{route('login')}}" class="mb-1 mt-3 btn btn-info btn-block">
                                <i class="fa fa-sign-in"></i>
                                ورود
                            </a>
                        </div>

                        <!-- /.col -->
                    </div>
                </form>


            </div>
            <!-- /.login-card-body -->
        </div>
    </div>

@endsection

@extends('panel.layouts.master')
