@section('title','مشاهده کتاب')
@section('content')

    @include('theme.layouts.inc.header')

    <div class="container mt-4 mb-5">
        <div class="row">
            <div class="col-md-12 top-slider">
                <div class="slider-item bg-white rounded p-3">
                    <div class="box-title ">
                        <i class="bi bi-book"></i>
                        {{ $chapter->name }}
                        <hr>
                    </div>

                    <div class="content">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="d-flex info-post mb-4 pb-2">
                                    <div class="fs-5  mb-2">
                                        <i class="fa fa-user-o"></i>
                                        {{jdate($chapter->created_at)->format('%d %B %Y')}}
                                    </div>
                                    <div class="fs-5  mb-2 ml-3">
                                        {{ $chapter->pages->count() }}
                                        صفحه
                                    </div>
                                </div>

                            </div>

                        </div>
                        <h4 class="text-dark fw-bold mb-4"><i class="bi bi-card-list"></i> صفحات </h4>

                        <div class="row">


                            @if($chapter->pages->count() == 0)
                                <div>هنوز صفحه ای برای این فصل ثبت نشده است</div>
                            @endif


                            @foreach($chapter->pages as $key => $page)
                                    <div class="col-sm-6 mt-2 mb-2">
                                        <a href="{{ route('showpage',$page->slug) }}" class="list-group-item list-group-item-action list-group-item-custom different box-book " aria-current="true">
                                    <div class="d-flex w-100 justify-content-between">

                                        <div class="d-flex">
                                            <h6 class="text-info fw-bold fs-3">{{++$key}}. </h6>
                                            <h6 class="fs-3">{{ $page->name }}</h6>
                                        </div>

                                        @if($page->created_at != $page->updated_at)
                                            <small>بروز رسانی : {{jdate($page->updated_at)->format('%d %B %Y')}} </small>
                                        @endif
                                    </div>
                                    <p class="mb-1"> {{ $page->description }} </p>


                                    <small>
                                        <i class="bi bi-calendar-event"></i>
                                        {{jdate($page->created_at)->format('%d %B %Y')}}
                                    </small>


                                </a>
                                    </div>

                                @endforeach


                        </div>









                    </div>


                </div>

            </div>

        </div>
    </div>



@endsection

@extends('theme.layouts.master')
