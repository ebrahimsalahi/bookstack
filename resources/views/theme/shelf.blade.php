@section('title','مشاهده قفسه')
@section('content')
    @include('theme.layouts.inc.header')


    <div class="container-xl">
        <div class="row  mb-5">
            <div class="col-lg-8 mt-4">
                <div class="box bg-white rounded p-3">

                    <img class="book-image" width="100%" src="{{ url('files/shelves/'.$shelf->image->name) }}">

                    <div class="text-center mt-4 ">
                        <h2> {{ $shelf->name }}</h2>
                        <div class="d-flex info-post">

                            <div class="fs-5 mb-2 ">
                                <i class="fa fa-user-o"></i>
                                {{  $shelf->user->name }}
                            </div>

                            <div class="fs-5  mb-3 ml-3">
                                <i class="fa fa-calendar"></i>
                                {{jdate($shelf->created_at)->format('%d %B %Y')}}
                            </div>

                            @if($shelf->created_at != $shelf->updated_at)
                                <div class="fs-5  mb-2 ml-3">
                                    <i class="fa fa-edit"></i>
                                    {{jdate($shelf->updated_at)->format('%d %B %Y')}}
                                </div>
                            @endif

                        </div>


                    </div>


                    <div class="content">
                        <h4 class="font-weight-bold mb-4 mt-3 bookpage-title"> توضیحات قفسه  </h4>
                        <div class="ch-title p-1 lh-lg mb-4">
                            <h6> {{$shelf->description}}</h6>
                        </div>

                        <h4 class="text-dark fw-bold mb-4"><i class="bi bi-card-list"></i> آخرین کتاب های قفسه </h4>

                        <div class="row">

                            @if($shelf->books->count() == 0)
                                <div>هنوز صفحه ای برای این فصل ثبت نشده است</div>
                            @endif


                            @foreach($shelf->books as $key => $book)
                                <div class="col-sm-6">
                                    <a href="{{ route('showbook',$book->slug) }}" class="list-group-item list-group-item-action list-group-item-custom different box-book " aria-current="true">
                                        <div class="d-flex w-100 justify-content-between">

                                            <div class="d-flex">
                                                <h6 class="text-info fw-bold fs-3">{{++$key}}. </h6>
                                                <h6 class="fs-3">{{ $book->name }}</h6>
                                            </div>

                                            @if($book->created_at != $book->updated_at)
                                                <small>بروز رسانی : {{jdate($book->updated_at)->format('%d %B %Y')}} </small>
                                            @endif
                                        </div>
                                        <p class="mb-1"> {{ $book->description }} </p>


                                        <small>
                                            <i class="bi bi-calendar-event"></i>
                                            {{jdate($book->created_at)->format('%d %B %Y')}}
                                        </small>


                                    </a>
                                </div>

                            @endforeach




                        </div>








                    </div>


                </div>


            </div>

            <div class="col-lg-4 mt-4">
                <div class="box bg-white rounded p-3">
                    <div class="ch-title pl-2 mb-3">قفسه های پیشنهادی</div>

                    <ul class="list-group last-books">
                        @foreach($updated_shelves as $shelf)
                            <a href="{{ route('showshelf',$shelf->slug) }}"
                               class="list-group-item list-group-item-action flex-column align-items-start ">
                                <div class="d-flex w-100 justify-content-between">
                                    <h5 class="mb-1">{{$shelf->name}}</h5>
                                    <small>{{ jdate($shelf->created_at)->ago() }}</small>
                                </div>
                                <small><i class="fa fa-user-o pr-1"></i> {{$shelf->user->name}}</small>
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
