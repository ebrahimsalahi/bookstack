
@section('title','ویرایش کاربر')
@section('content')


    <div class="content-wrapper" >
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">

                    <div class="col-sm-12">
                        <h1 class="m-0 text-dark">کاربران</h1>
                        <ol class="breadcrumb float-sm-right mt-2 mb-2">
                            <li class="breadcrumb-item"><a href="{{route('panel')}}">پنل مدیریت</a></li>
                            <li class="breadcrumb-item active"> ویرایش کاربر</li>
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
                                <form action="{{route('updateUser',$user->id)}}" method="post" class="form_ajaxi">

                                    <div class="row">
                                    @csrf

                                        <div class="col-md-4 my-1">
                                            <label for="id" class="col-form-label">شناسه کاربری</label>
                                            <input type="text" readonly class="form-control" id="id" value="{{$user->id}}">
                                        </div>
                                        <div class="col-md-4 my-1">
                                            <label for="created_at" class=" col-form-label">تاریخ  ثبت نام</label>
                                            <input type="text" readonly class="form-control" id="created_at" value="{{$user->created_at}}">
                                        </div>

                                        <div class="col-md-4 my-1">
                                            <label for="name" class=" col-form-label">نام</label>
                                            <input type="text" class="form-control" id="name"  name="name"   value="{{$user->name}}">
                                        </div>



                                        <div class="col-md-4 my-1">
                                        <label for="email" class=" col-form-label">ایمیل</label>
                                        <input type="text" class="form-control" id="email" name="email"  value="{{$user->email}}">
                                    </div>

                                        <div class="col-md-4 my-1">
                                        <label for="mobile" class=" col-form-label">موبایل</label>
                                        <input type="text" class="form-control" id="mobile" name="mobile"  value="{{$user->mobile}}">
                                    </div>






                                        <div class="col-md-4 my-1">
                                        <label class=" col-form-label">نقش کاربر</label>
                                        <select name="role" class="form-control select2 p-2" style="width: 100%;">
                                            <option selected="selected" value="0">انتخاب کنید</option>
                                            @foreach($roles as $role)
                                                <option value="{{$role->id}}" @if($user->roles()->first()->id == $role->id )  selected @endif>{{ $role->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>




                                        <div class="col-md-4 my-1">
                                        <label for="password" class=" col-form-label">رمزعبور</label>
                                        <input type="password" class="form-control" id="password" name="password" >
                                    </div>
                                        <div class="col-md-4 my-1">
                                            <div class="form-check p-5">
                                                <input type="checkbox" name="is_active"    @if( $user->is_active == 1) checked @endif  class="form-check-input" id="exampleCheck1">
                                                <label class="form-check-label" for="exampleCheck1"> کاربر فعال باشد </label>
                                            </div>
                                        </div>
                                        <div class="col-md-12">


                                    <button type="submit" class="btn btn-primary">ثبت تغییرات</button>
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
