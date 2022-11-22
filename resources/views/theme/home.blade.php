@section('title','صفحه اصلی')
@section('content')

    @include('theme.layouts.inc.header')

    <section class="my-5">
        <div class="container-xl">
            <div class="row">
                <div class="col-md-12">
                    <div class="blog-slider">
                        <div class="blog-slider__wrp swiper-wrapper">

                            @foreach($updated_books as $book)
                                <div class="blog-slider__item swiper-slide">
                                    <div class="blog-slider__img">
                                        <img src="{{url('files/books/'.$book->image->name)}}" alt="">
                                    </div>
                                    <div class="blog-slider__content">
                                        <span class="blog-slider__code">{{ jdate($book->updated_at)->ago() }}</span>
                                        <div class="blog-slider__title">{{$book->name}}</div>
                                        <div class="blog-slider__text">{{$book->description}}</div>
                                        <a href="{{ route('showbook',$book->slug) }}" class="blog-slider__button">مشاهده
                                            کتاب</a>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <div class="blog-slider__pagination"></div>
                    </div>
                </div>


            </div>
        </div>

    </section>


    <div class="container-xl  overflow-hidden">
        <div class="title">
            <h1> کتاب های پر بازدید </h1>
        </div>

        <section class="position-relative new-books" style="msargin-top: 8rem;overfclow: hidden;padding: 45px;">

            <div class="swiper mySwiper">
                <div class="swiper-wrapper">

                    @foreach($popular_books as $book)
                        <div class="swiper-slide">
                            <div class="box mt-5 w-100">
                                <div class="mb-4 position-relative">
                                    <a href="{{ route('showbook',$book->slug) }}">

                                        <img src="{{url('files/books/'.$book->image->name)}}">
                                        <div class="info-book">
                                            <div class="author"><i class="fa fa-user-o"></i> {{$book->user->name}}
                                            </div>
                                            <div class="date"><i
                                                    class="fa fa-date"></i> {{jdate($book->created_at)->format('%d %B %Y')}}
                                            </div>
                                        </div>
                                    </a>

                                </div>
                                <div class="info">
                                    <a href="{{ route('showbook',$book->slug) }}">
                                        <h5>{{$book->name}}</h5>
                                    </a>

                                </div>
                            </div>
                        </div>
                    @endforeach


                </div>
                <div class="swiper-button-next"></div>
                <div class="swiper-button-prev"></div>
                <div class="swiper-pagination"></div>
            </div>
    </div>

    </section>



    <div class="last-iconsc pb-5 position-relative">
        <div class="last-backl"></div>
        <div class="container-xl mb-5">
            <div class="title text-center mb-4 mt-3">
                <h1>آمار سایت</h1>
            </div>


            <div class="row ">

                <div class="col-6 col-lg-3 ">
                    <div class="info-box site-info">
                        <div class="icon icon-user"></div>
                        <div class="text">{{$users}} کاربر</div>
                    </div>
                </div>
                <div class="col-6 col-lg-3 ">
                    <div class="info-box site-info">
                        <div class="icon icon-shelves"></div>
                        <div class="text">{{$shelves}} قفسه</div>
                    </div>
                </div>
                <div class="col-6 col-lg-3 ">
                    <div class="info-box site-info">
                        <div class="icon icon-book"></div>
                        <div class="text">{{$books}} کتاب</div>
                    </div>
                </div>
                <div class="col-6 col-lg-3 ">
                    <div class="info-box site-info">
                        <div class="icon icon-comment"></div>
                        <div class="text">{{$comments->count()}} نظر</div>
                    </div>
                </div>


            </div>
        </div>
    </div>
    <div class="container-xl  overflow-hidden position-relative">
        <div class="title">
            <h1>قفسه های بروز شده</h1>
        </div>

        <section class="position-relative new-books" style="msargin-top: 8rem;overfclow: hidden;padding: 45px;">

            <div class="swiper mySwiper">
                <div class="swiper-wrapper">

                    @foreach($updated_shelves as $shelf)
                        <div class="swiper-slide">
                            <div class="box mt-5 w-100">
                                <div class="mb-4 position-relative">
                                    <a href="{{ route('showshelf',$shelf->slug) }}">
                                        <img src="{{url('files/shelves/'.$shelf->image->name)}}">
                                        <div class="info-book">
                                            <div class="author"><i class="fa fa-user-o"></i> {{$shelf->user->name}}
                                            </div>
                                            <div class="date"><i
                                                    class="fa fa-date"></i> {{jdate($shelf->created_at)->format('%d %B %Y')}}
                                            </div>
                                        </div>
                                    </a>

                                </div>
                                <div class="info">
                                    <a href="{{ route('showshelf',$shelf->slug) }}">
                                        <h5>{{$shelf->name}}</h5>
                                    </a>

                                </div>
                            </div>
                        </div>
                    @endforeach


                </div>
                <div class="swiper-button-next"></div>
                <div class="swiper-button-prev"></div>
                <div class="swiper-pagination"></div>
            </div>
    </div>
    <div class="container-xl mt-5 mb-5">

        <div class="feedback">
            <div class="row align-items-center">
                <div class="col-xs-12 offset-lg-1 col-lg-3 mb-4 mb-lg-0">
                    <h2 class="feedback__title">نظرات کاربران</h2>
                    <p class="feedback__text">آخرین نظرات کاربران در اینجا نمایش داده می شود</p>
                </div>
                <div class="col-xs-12 offset-lg-1 col-lg-7">
                    <div class="swiper feedback__slider overflow-hidden">
                        <div class="swiper-wrapper">

                            @if($comments->count() == 0)
                                <div class="feedback__item swiper-slide">
                                    <h5 class="feedback__name">هنوز نظری ثبت نشده است</h5>
                                </div>

                            @else
                                @foreach($comments as $comment)
                                    <div class="feedback__item swiper-slide">
                                        <img src="{{url('files/avatars/'.$comment->user->avatar->name)}}" alt="Photo"
                                             class="feedback__image">
                                        <h5 class="feedback__name">{{$comment->user->name}}
                                            برای کتاب
                                            <a href="{{route('showbook',$comment->book->slug)}}">{{$comment->book->name}}</a>
                                            نوشته :
                                        </h5>
                                        <p class="feedback__text"> {{$comment->comment}} </p>
                                    </div>
                                @endforeach
                            @endif


                        </div>
                        <div class="swiper-button-next"></div>
                        <div class="swiper-button-prev"></div>
                    </div>
                </div>
            </div>


        </div>

    </div>

@endsection

@extends('theme.layouts.master')
