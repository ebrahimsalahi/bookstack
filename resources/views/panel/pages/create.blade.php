
@section('title','ایجاد صفحه')
@section('content')


    <div class="content-wrapper" >
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">

                    <div class="col-sm-12">
                        <h1 class="m-0 text-dark">صفحه ها</h1>
                        <ol class="breadcrumb float-sm-right mt-2 mb-2">
                            <li class="breadcrumb-item"><a href="{{route('panel')}}">پنل مدیریت</a></li>
                            <li class="breadcrumb-item active">افزودن صفحه</li>
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
                                <h3 class="card-title">افرودن صفحه جدید</h3>
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->
                            <div class="card-body">
                                <form action="{{route('savePage')}}" method="post"  class="form_ajaxi" enctype="multipart/form-data">
                                    @csrf

                                    <div class="row">


                                    <div class="col-md-4 my-1">
                                        <label for="name">عنوان صفحه</label>
                                        <input type="text" class="form-control" id="name" name="name" >
                                    </div>
                                    <div class="col-md-4 my-1">
                                        <label>کتاب</label>
                                        <select name="book_id" class="form-control select2 p-2" style="width: 100%;">
                                            <option selected="selected" value="0">انتخاب کنید</option>
                                            @foreach($books as $book)
                                                <option value="{{$book->id}}"> {{ $book->name}} </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="col-md-4 my-1">
                                        <label>فصل</label>
                                        <select name="chapter_id" class="form-control select2 p-2" style="width: 100%;">
                                            <option selected="selected" value="0">انتخاب کنید</option>
                                            @foreach($chapters as $chapter)
                                                <option value="{{$chapter->id}}"> {{ $chapter->name}} </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-12 my-1">
                                        <label for="name">متن صفحه</label>
                                        <textarea id="description" class="default-editor" name="text"></textarea>
                                    </div>

                                    <div class="col-md-4 my-3">
                                        <div class="form-check p-">
                                            <input type="checkbox" name="status"  class="form-check-input iCheck" id="status">
                                            <label class="form-check-label" for="status">   منتشر نشود ؟ </label>
                                        </div>
                                    </div>



                                    <div class="col-md-12 my-2">
                                        <button type="submit" class="btn btn-primary">ایجاد صفحه</button>
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
