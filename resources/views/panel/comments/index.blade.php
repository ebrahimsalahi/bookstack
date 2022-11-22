
@section('title','نظرات')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-12">
                        <h1 class="m-0 text-dark">نظرات</h1>
                        <ol class="breadcrumb float-sm-right mt-2 mb-2">
                            <li class="breadcrumb-item"><a href="{{route('panel')}}">پنل مدیریت</a></li>
                            <li class="breadcrumb-item active">  نظرات </li>
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
                                <h3 class="card-title">جدول نظرات </h3>

                            </div>
                            <!--  /.card-header -->

                            <div class="card-body table-responsive ">
                                @foreach($comments as $comment)
                                    <!-- Post -->
                                    <div class="post">
                                        <div class="user-block">
                                            <img class="img-circle img-bordered-sm" src="{{ url('files/avatars/'.$comment->user->avatar->name) }}" alt="user image">
                                            <span class="username">
                                              <a>{{ $comment->user->name  }} </a>در
                                              <a href="{{route('showbook',$comment->book->slug)}}" target="_blank">  {{ $comment->book->name  }}</a>
                                                @if($comment->status == 1)
                                                    تایید شده
                                                @else
                                                    تایید نشده
                                                @endif


                                            </span>
                                            <span class="description"> {{ jdate($comment->created_at)->format('%A, %d %B %Y') }} </span>
                                        </div>
                                        <!-- /.user-block -->
                                        <p>{{$comment->comment}}</p>
                                        <p>
                                            @if($comment->status == 0)
                                                <a href="{{route('verifyComment',$comment->id)}}" class="link-black text-sm"><i class="fa fa-thumbs-o-up mr-1"></i>   تایید </a>
                                            @else
                                                <a href="{{route('unverifyComment',$comment->id)}}" class="link-black text-sm"><i class="fa fa-thumbs-o-up mr-1"></i>   عدم تایید </a>
                                            @endif
                                            <a href="{{route('deleteComment',$comment->id)}}" class="link-black text-sm mr-2"><i class="fa fa-trash mr-1"></i>   حذف  </a>

                                    </div>
                                @endforeach
                            <!-- /.card-body -->
                                    <div>
                                        {{$comments->links()}}
                                    </div>
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
