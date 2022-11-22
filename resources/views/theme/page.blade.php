@section('title','مشاهده صفحه')
@section('content')

    @include('theme.layouts.inc.header')

    <div class="container mt-4 mb-5">
        <div class="row">
            <div class="col-md-12 top-slider">
                <div class="slider-item bg-white rounded p-3">
                    <div class="box-title ">
                        <i class="bi bi-book"></i>
                        {{ $page->name }}
                        <hr>
                    </div>

                    <div class="content">
                        <div class="row">
                            <div class="col-sm-7">
                                <div class="mb-4 d-flex">
                                    <div class="fs-5  mb-2">
                                        <i class="fa fa-user-o"></i>
                                        {{jdate($page->created_at)->format('%d %B %Y')}}
                                    </div>

                                </div>

                            </div>



                        </div>

                        <div class="row">

                            <div class="p-4">
                                {{$page->text}}
                            </div>


                        </div>



                        <div class="mb-4 text-center">
                            @if(!empty($prevPage))
                                <a href="{{route('showpage',$prevPage->slug)}}" class="btn btn-primary btn-sm">صفحه قبل </a>
                            @endif
                            @if(!empty($nextPage))
                                <a href="{{route('showpage',$nextPage->slug)}}" class="btn btn-primary btn-sm">صفحه بعد</a>
                            @endif


                        </div>





                    </div>


                </div>

            </div>

        </div>
    </div>



@endsection

@extends('theme.layouts.master')
