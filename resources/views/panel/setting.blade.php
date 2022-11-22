@section('title','تنظیمات سایت')
@section('content')

    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">

                    <div class="col-sm-12">
                        <h1 class="m-0 text-dark">تنظیمات</h1>
                        <ol class="breadcrumb float-sm-right mt-2 mb-2">
                            <li class="breadcrumb-item"><a href="{{route('panel')}}">پنل مدیریت</a></li>
                            <li class="breadcrumb-item active"> مشاهده تنظیمات</li>
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
                                <h3 class="card-title">ویرایش</h3>
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->
                            <div class="card-body">
                                <form action="{{route('updateSetting')}}" method="post" class="form_ajaxi">

                                    @csrf
                                    <div class="row">


                                        <div class="col-md-12 my-1">
                                            آخرین بروزرسانی : {{jdate($setting->created_at)}} (
                                            {{jdate($setting->updated_at)->ago()}})
                                        </div>

                                        <div class="col-md-3 my-1">
                                            <label for="title" class="col-form-label">عنوان سایت</label>
                                            <input type="text" class="form-control" id="title" name="title"
                                                   autocomplete="off" value="{{$setting->title}}">
                                        </div>
                                        <div class="col-md-3 my-1">
                                            <label for="phone" class="col-form-label">تلفن</label>
                                            <input type="text" class="form-control" id="phone" name="phone"
                                                   autocomplete="off" value="{{$setting->phone}}">
                                        </div>

                                        <div class="col-md-3 my-1">
                                            <label for="email" class="col-form-label">ایمیل</label>
                                            <input type="text" class="form-control" id="email" name="email"
                                                   autocomplete="off" value="{{$setting->email}}">
                                        </div>
                                        <div class="col-md-3 my-1">
                                            <label  class=" col-form-label"> وضعیت ثبت نام کاربران</label>
                                            <select name="register_status" class="form-control select2 p-2"
                                                    style="width: 100%;">


                                                <option @if($setting->register_status == 0 ) selected @endif value="0">
                                                    غیرفعال
                                                </option>
                                                <option @if($setting->register_status == 1 ) selected @endif value="1">
                                                    فعال
                                                </option>


                                            </select>
                                        </div>

                                        <div class="col-md-6 my-1">
                                            <label for="rules" class=" col-form-label">متن قوانین و مقررات </label>
                                            <textarea class="form-control default-editor" id="rules"
                                                      name="rules">{{$setting->rules}}</textarea>
                                        </div>

                                        <div class="col-md-6 my-1">
                                            <label for="about" class=" col-form-label">متن درباره ما</label>
                                            <textarea class="form-control default-editor" id="about"
                                                      name="about">{{$setting->about}}</textarea>
                                        </div>



                                    </div>
                                    <div class="col-md-12 my-3">

                                    <button type="submit" class="btn btn-primary">ثبت تغییرات</button>
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
