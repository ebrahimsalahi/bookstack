@section('title','پروفایل')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-12">
                        <h1 class="m-0 text-dark">پروفایل</h1>
                        <ol class="breadcrumb float-sm-right mt-2 mb-2">
                            <li class="breadcrumb-item"><a href="{{route('panel')}}">پنل مدیریت</a></li>
                            <li class="breadcrumb-item active">مشاهده پروفایل </li>
                        </ol>
                    </div><!-- /.col -->
                </div>


            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-3">

                        <!-- Profile Image -->
                        <div class="card card-primary card-outline">
                            <div class="card-body box-profile">
                                <div class="text-center">
                                    <img class="profile-user-img img-fluid img-circle"
                                         src="{{ url('files/avatars/'.auth()->user()->avatar->name) }}"
                                         alt="User profile picture">
                                </div>

                                <h3 class="profile-username text-center"> {{ auth()->user()->name }}</h3>
                                <p class="text-muted text-center"> {{ auth()->user()->roles()->first()->name }} </p>

                                <ul class="list-group list-group-unbordered mb-3">
                                    <li class="list-group-item">
                                        <b>تعداد کتاب</b> <a class="float-left">{{auth()->user()->books()->count()}}</a>
                                    </li>
                                    <li class="list-group-item">
                                        <b> قفسه </b> <a class="float-left">{{auth()->user()->shelves()->count()}}</a>
                                    </li>


                                </ul>


                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->

                        <!-- About Me Box -->
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">درباره من</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <strong><i class="fa fa-book mr-1"></i> تحصیلات</strong>
                                <p class="text-muted">
                                    {{$user->education->name}}
                                </p>

                                <hr>

                                <strong><i class="fa fa-map-marker mr-1"></i> موقعیت</strong>

                                <p class="text-muted">{{$user->province->name}}</p>

                                <hr>

                                <strong><i class="fa fa-pencil mr-1"></i> مهارت&zwnj;ها</strong>
                                @if ($user->skills != "")
                                    <p class="text-muted">
                                        @foreach(explode(',', $user->skills) as $skill)
                                            <span class="badge badge-danger">{{$skill}}</span>
                                        @endforeach
                                    </p>
                                @endif




                                <hr>

                                <strong><i class="fa fa-file-text-o mr-1"></i> یادداشت</strong>

                                <p class="text-muted">{{ $user->note   }}</p>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                    <!-- /.col -->
                    <div class="col-md-9">
                        <div class="card">
                            <div class="card-header p-2">
                                <ul class="nav nav-pills">
                                    <li class="nav-item">
                                        <a class="nav-link active show" href="#settings" data-toggle="tab">اطلاعات شخصی</a>
                                    </li>
                                </ul>
                            </div><!-- /.card-header -->
                            <div class="card-body">
                                <div class="tab-content">

                                    <div class="tab-pane active show" id="settings">
                                        <form class="form-horizontal form_ajaxi" method="post" action="{{route('updateAccount',$user->id)}}" >
                                            @csrf
                                            <div class="row-1">
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label for="name" class="col-sm-2 control-label">نام</label>
                                                        <input type="text" class="form-control" id="name" name="name" value="{{ $user->name  }}">
                                                    </div>
                                                </div>

                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label for="email" class="col-sm-2 control-label">ایمیل</label>
                                                        <input type="text" class="form-control" id="email" name="email" value="{{ $user->email  }}">
                                                    </div>
                                                </div>

                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label for="mobile" class="col-sm-2 control-label">موبایل</label>
                                                        <input type="text" class="form-control" id="mobile" name="mobile" value="{{ $user->mobile  }}">
                                                    </div>
                                                </div>

                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label>مدرک تصیلی</label>
                                                        <select name="edu_id" class="form-control p-2"  style="width: 100%;">
                                                            <option selected="selected" value="0">انتخاب کنید</option>
                                                            @foreach($educations as $edu)
                                                                <option value="{{$edu->id}}" @if($user->edu_id == $edu->id ) selected @endif>{{ $edu->name}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>


                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label>شهر محل زندگی</label>
                                                        <select name="province_id" class="form-control"  style="width: 100%;">
                                                            <option selected="selected" value="0">انتخاب کنید</option>
                                                            @foreach($provinces as $province)
                                                                <option value="{{$province->id}}" @if($province->id == $user->province_id ) selected @endif>{{ $province->name}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label for="skills" class="control-label">مهارت ها(با ، جدا شوند)</label>
                                                        <textarea name="skills" class="form-control">{{ $user->skills }}</textarea>
                                                    </div>
                                                </div>

                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label for="about" class="control-label">درباره من</label>
                                                        <textarea name="about" class="form-control">{{ $user->about }}</textarea>
                                                    </div>
                                                </div>

                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label for="note" class="control-label">یادداشت</label>
                                                        <textarea name="note" class="form-control">{{ $user->note }}</textarea>
                                                    </div>
                                                </div>

                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label for="inputEmail" class="control-label">رمزعبور جدید</label>
                                                        <input type="text" class="form-control" name="password" placeholder="اگر قصد تغییر رمزعبور ندارید ، خالی بگذرارید" ">
                                                    </div>
                                                </div>
                                            </div>








                                            <div class="form-group">
                                                <div class="col-sm-offset-2 col-sm-10">
                                                    <button type="submit" class="btn btn-danger">ثبت تغییرات</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    <!-- /.tab-pane -->
                                </div>
                                <!-- /.tab-content -->
                            </div><!-- /.card-body -->
                        </div>
                        <!-- /.nav-tabs-custom -->
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>

@endsection

@extends('panel.layouts.master')
