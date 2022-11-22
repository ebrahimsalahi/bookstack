@section('title','مشاهده کتاب')
@section('content')

    @include('theme.layouts.inc.header')

    <div class="container-xl">
        <div class="row  mb-5">
            <div class="col-lg-8 mt-4">
                <div class="box bg-white rounded p-3">

                    <img class="book-image" width="100%" src="{{ url('files/books/'.$book->image->name) }}">

                    <div class="text-center mt-4 ">
                        <h2> {{ $book->name }}</h2>
                        <div class="d-flex info-post">

                            <div class="fs-5 mb-2 ">
                                <i class="fa fa-user-o"></i>
                                {{  $book->user->name }}
                            </div>

                            <div class="fs-5  mb-3 ml-3">
                                <i class="fa fa-calendar"></i>
                                {{jdate($book->created_at)->format('%d %B %Y')}}
                            </div>

                            @if($book->created_at != $book->updated_at)
                                <div class="fs-5  mb-2 ml-3">
                                    <i class="fa fa-edit"></i>
                                    {{jdate($book->updated_at)->format('%d %B %Y')}}
                                </div>
                            @endif

                            <span class="  mb-2 ml-3">
                            <i class="fa fa-layer-group"></i>
                                {{  $book->chapters->count() }}
                            </span>

                            <span class="fs-4  mb-2 ml-3">
                                <i class="fa fa-eye"></i>
                                {{  $book->view }}
                            </span>


                            <span class="fs-4  mb-2 ml-3">
                                <a href="{{  route('showshelf',$book->shelf->slug)  }}">
                                    <i class="fa fa-bars"></i>
                                    {{ $book->shelf->name }}
                                </a>

                            </span>
                        </div>


                    </div>


                    <div class="content">
                        <h4 class="font-weight-bold mb-4 mt-5 bookpage-title"> توضیحات کتاب </h4>
                        <div class="ch-title p-1 lh-lg mb-4">
                            <h4> {{$book->description}}</h4>
                        </div>


                        <h4 class="font-weight-bold mb-4 bookpage-title"> فصل ها </h4>
                        <div class="row">



                            @if($book->chapters->count() == 0)
                                <div>هنوز برای این کتاب فصل ایجاد نشده است</div>
                            @endif

                            @foreach($book->chapters as $key => $chapter)
                                <div class="col-sm-6">

                                    <a href="{{ route('showchapter',$chapter->slug) }}"
                                       class="list-group-item list-group-item-action list-group-item-custom ch-title box-book"
                                       aria-current="true">
                                        <div class="d-flex w-100 justify-content-between">
                                            <div class="d-flex">
                                                <h6 class="text-info fw-bold fs-3">{{++$key}}. </h6>
                                                <h6 class="fs-3">{{ $chapter->name }}</h6>
                                            </div>
                                            @if($chapter->created_at != $chapter->updated_at)
                                                <small>بروز رسانی
                                                    : {{jdate($book->updated_at)->format('%d %B %Y')}} </small>
                                            @endif
                                        </div>
                                        <p class="mb-1"> {{ $chapter->description }} </p>
                                        <small>
                                            <i class="bi bi-calendar-event"></i>
                                            {{jdate($book->created_at)->format('%d %B %Y')}}
                                            <i class="bi bi-clock me-2"></i>
                                            {{jdate($book->created_at)->ago()}}

                                            ({{$chapter->pages->count()}} صفحه )
                                        </small>
                                    </a>

                                </div>
                            @endforeach


                        </div>


                    </div>


                </div>


                <div class="box bg-white rounded p-3 mt-4">
                    <div class="ch-title pl-2 mb-4">نظرات ({{$book->comments->where('status','1')->count()}})</div>
                    <div class="container">
                        <div class="be-comment-block">
                            @foreach($book->comments->where('status','1')->whereNull('parent_id')  as $comment)

                                <div class="be-comment">


                                    <div class="be-img-comment">
                                        <a href="blog-detail-2.html">
                                            <img src="{{url('files/avatars/'.$comment->user->avatar->name)}}" class="be-ava-comment">
                                        </a>
                                    </div>
                                    <div class="be-comment-content">

				<span class="be-comment-name">
					<p>{{$comment->user->name}}</p>
					</span>
                                        <span class="be-comment-time">
					<i class="fa fa-clock-o"></i>
					{{jdate($comment->created_at)->format('Y/m/d ساعت H:i:s')}}
				</span>

                                        <p class="be-comment-text">
                                            {{$comment->comment}}
                                        </p>

                                        @if($book->comments->where('parent_id',$comment->id)->count() > 0)

                                            @foreach($book->comments->where('parent_id',$comment->id) as $reply)

                                              <div class="be-comment">
                                                    <div class="be-img-comment">
                                                        <a href="blog-detail-2.html">
                                                            <img src="{{url('files/avatars/'.$reply->user->avatar->name)}}" class="be-ava-comment">
                                                        </a>
                                                    </div>
                                                    <div class="be-comment-content">

				<span class="be-comment-name">
					<p>{{$reply->user->name}}</p>
					</span>
                                                        <span class="be-comment-time">
					<i class="fa fa-clock-o"></i>
					{{jdate($reply->created_at)->format('Y/m/d ساعت H:i:s')}}
				</span>

                                                        <p class="be-comment-text">
                                                            {{$reply->comment}}
                                                        </p>
                                                    </div>
                                                </div>

                                            @endforeach

                                        @endif




                                    </div>

                                </div>


                            @endforeach


                                <div class="pl-2 mb-2 mt-5">لطفا نظرات خود را با در میان بگذارید</div>
                                @if($book->allow_comment == 0)
                                    <div class="alert alert-danger">ارسال نظر برای این کتاب محدود شده است،امکان ثبت نظر وجود ندارد.</div>
                                @else
                                    @auth()
                                        <form class="form-block form_ajaxi" method="post" action="{{route('newComment')}}" >
                                            @csrf
                                            <input type="hidden" name="book_id" value="{{$book->id}}">
                                            <input type="hidden" name="user_id" value="{{auth()->user()->id}}">
                                            <div class="row">
                                                <div class="col-sm-6 col-sm-6">
                                                    <div class="form-group fl_icon">
                                                        <div class="icon"><i class="fa fa-user"></i></div>
                                                        <input class="form-input" type="text" readonly value="{{auth()->user()->name}}">
                                                    </div>
                                                </div>
                                                <div class="col-sm-6 col-sm-6 fl_icon">
                                                    <div class="form-group fl_icon">
                                                        <div class="icon"><i class="fa fa-envelope-o"></i></div>
                                                        <input class="form-input" type="text" readonly value="{{auth()->user()->email}}">
                                                    </div>
                                                </div>
                                                <div class="col-sm-12">
                                                    <div class="form-group">
                                                        <textarea class="form-input" name="comment" required="" placeholder="متن نظر خود را بنویسید"></textarea>
                                                    </div>
                                                </div>
                                                <div class="col-lg-12">
                                                    <button type="submit" class="btn btn-primary pull-right">ثبت نظر</button>
                                                </div>
                                            </div>
                                        </form>
                                    @else
                                        <div class="alert alert-info">
                                            برای ثبت  نظرات ابتدا باید یه حساب خود وارد شوید.
                                            <a href="{{route('login')}}">ورود</a>
                                        </div>
                                    @endauth


                                @endif







                        </div>
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
