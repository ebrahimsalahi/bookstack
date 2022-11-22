@section('title','ایجاد کتاب')
@section('content')

    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">

                    <div class="col-sm-12">
                        <h1 class="m-0 text-dark">کتاب ها</h1>
                        <ol class="breadcrumb float-sm-right mt-2 mb-2">
                            <li class="breadcrumb-item"><a href="{{route('panel')}}">پنل مدیریت</a></li>
                            <li class="breadcrumb-item active">افزودن کتاب</li>
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
                                <h3 class="card-title">افرودن کتاب جدید</h3>
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->
                            <div class="card-body">
                                <form action="{{route('saveBook')}}" method="post" class="form_ajaxi"
                                      enctype="multipart/form-data">
                                    @csrf
                                    <div class="row">


                                        <div class="col-md-4 my-1">
                                            <label for="name">عنوان کتاب</label>
                                            <input type="text" class="form-control" id="name" name="name">
                                        </div>


                                        <div class="col-md-4 my-1">
                                            <label>قفسه</label>
                                            <select name="shelf_id" class="form-control select2 p-2" style="width: 100%;">
                                                <option selected="selected" value="0">انتخاب کنید</option>
                                                @foreach($shelves as $shelf)
                                                    <option value="{{$shelf->id}}">{{ $shelf->name}}
                                                        ({{$shelf->books->count() }}کتاب)
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>


                                        <div class="col-md-4 my-1">
                                            <label for="exampleInputFile"> (jpg,jpeg,png)عکس کتاب</label>
                                            <div class="input-group">
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" id="file" name="file"
                                                           accept="image/*">
                                                    <label class="custom-file-label" for="file">انتخاب فایل</label>
                                                </div>

                                            </div>
                                        </div>

                                        <div class="col-md-4 my-1">
                                            <label for="description">توضیحات</label>
                                            <textarea class="form-control" id="description" name="description"></textarea>
                                        </div>
                                        <div class="col-md-12 my-1">
                                            <button type="submit" class="btn btn-primary">ثبت کتاب</button>
                                        </div>


                                </form>
                            </div>
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
