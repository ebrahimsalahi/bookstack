@section('title','ورود به پنل')

@section('pageStyle','login-page')

@section('content')

    @include('panel.layouts.inc.header')

    <div class="login-box">
        <div class="login-logo">
            <a href="{{ route('login') }}"><b>ورود به سایت</b></a>
        </div>
        <!-- /.login-logo -->
        <div class="card">
            <div class="card-body login-card-body">
                <p class="login-box-msg">فرم زیر را تکمیل کنید و ورود بزنید</p>

                <form action="{{route('loginCheck')}}" method="post" class="form_ajaxi">
                    @csrf
                    <div class="input-group mb-3">
                        <input type="text" class="form-control " name="email"  value="{{ old('email') }}"  placeholder="ایمیل">
                        <div class="input-group-append">
                            <span class="fa fa-envelope input-group-text"></span>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="password" class="form-control " name="password"    placeholder="رمز عبور">
                        <div class="input-group-append">
                            <span class="fa fa-lock input-group-text"></span>
                        </div>
                    </div>
                    <div class="row">

                        <div class="col-12">
                            <button type="submit" class="btn btn-primary btn-block btn-flat">ورود</button>
                        </div>

                        <div class="col-sm-6">
                            <a href="{{route('home')}}" class="mb-1 mt-3 btn btn-success btn-block">
                                <i class="fa fa-home"></i>
                                صفحه اصلی
                            </a>
                        </div>
                        <div class="col-sm-6">
                            <a href="{{route('register')}}" class="mb-1 mt-3 btn btn-info btn-block">
                                <i class="fa fa-sign-in"></i>
                                ثبت نام
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
