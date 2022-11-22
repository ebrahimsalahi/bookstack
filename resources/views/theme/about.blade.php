@section('title','درباره ما')
@section('content')

    @include('theme.layouts.inc.header')

    <div class="container-xl">
        <div class="row  mb-5">
            <div class="col-lg-8 mt-4">
                <div class="box bg-white rounded p-3">

                    <img class="book-image" width="100%" src="{{url('theme/image/about-us.jpg')}}">

                    <div class="text-center mt-4 ">
                        <h2>  درباره ما  </h2>
                        <div class="d-flex">
                            <div class="fs-3 mb-2 ml-3">
                                <i class="fa fa-clock"></i>
                                آخرین بروزرسانی : {{jdate($setting->updated_at)->format('%d %B %Y')}}
                            </div>
                        </div>


                    </div>
                    <div class="content mt-3">
                        {!!  nl2br($setting->about) !!}
                    </div>

                </div>


            </div>


            <div class="col-lg-4 mt-4">
                <div class="box bg-white rounded p-3">
                    <div class="ch-title pl-2 mb-3">جدیدترین کتاب ها</div>


                    <ul class="list-group last-books">
                        @foreach($last_books as $book)
                            <a href="{{ route('showbook',$book->slug) }}"
                               class="list-group-item list-group-item-action flex-column align-items-start ">
                                <div class="d-flex w-100 justify-content-between">
                                    <h5 class="mb-1">{{$book->name}}</h5>
                                    <small>{{ jdate($book->created_at)->ago() }}</small>
                                </div>
                                <small><i class="fa fa-user-o pr-1"></i> {{$book->user->name}}</small>
                                <small class="ml-2"><i class="fa fa-eye pr-1"></i> {{$book->view}}</small>
                                <small class="ml-2"><i class="fa fa-comments pr-1"></i> {{$book->comments->count()}}
                                </small>
                            </a>
                    @endforeach

                </div>

            </div>

        </div>
    </div>
    </div>

@endsection

@extends('theme.layouts.master')
