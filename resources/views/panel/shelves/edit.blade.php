@section('title','ویرایش قفسه')
@section('content')

    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">

                    <div class="col-sm-12">
                        <h1 class="m-0 text-dark">قفسه ها</h1>
                        <ol class="breadcrumb float-sm-right mt-2 mb-2">
                            <li class="breadcrumb-item"><a href="{{route('panel')}}">پنل مدیریت</a></li>
                            <li class="breadcrumb-item active">ویرایش قفسه</li>
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
                                <h3 class="card-title">ویرایش قفسه </h3>
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->
                            <div class="card-body">
                                <form action="{{route('updateShelf',$shelf->id)}}" method="post" class="form_ajaxi"
                                      enctype="multipart/form-data">
                                    @csrf

                                    <div class="row">
                                        <div class="col-md-12 my-1">
                                            <img class="shelf-pic" src="{{url('files/shelves/'.$shelf->image->name)}}">
                                        </div>
                                        <div class="col-md-4 my-1">
                                            <label for="name">عنوان قفسه</label>
                                            <input type="text" class="form-control" id="name" name="name" value="{{$shelf->name}}">
                                        </div>

                                        <div class="col-md-4 my-1">
                                            <label for="slug">نامک (خودکار ساخته می شود)</label>
                                            <input type="text" class="form-control" readonly id="slug" name="slug" value="{{$shelf->slug}}">
                                        </div>



                                        <div class="col-md-4 my-1">
                                            <label for="exampleInputFile"> (jpg,jpeg,png)عکس قفسه</label>
                                            <div class="input-group">
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" id="file" name="file" accept="image/*">
                                                    <label class="custom-file-label" for="file">انتخاب فایل</label>
                                                </div>

                                            </div>
                                        </div>
                                        <div class="col-md-4 my-1">
                                            <label for="description">توضیحات</label>
                                            <textarea class="form-control" id="description" name="description">{{$shelf->description}}</textarea>
                                        </div>
                                        <div class="col-md-12 my-1">
                                        <button type="submit" class="btn btn-primary">ویرایش قفسه</button>
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
