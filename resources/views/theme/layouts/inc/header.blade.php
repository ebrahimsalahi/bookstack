<nav class="navbar navbar-expand-lg navbar-light bg-white cm-navbar ">
    <div class="container-xl">

        <a class="nav-link" href="{{ route('home') }}">
            <div class="brand-image">
            <img src="{{url('logo.png')}}" style="height: 60px;">
        </div>
        </a>

    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
                <a class="nav-link" href="{{ route('home') }}">صفحه اصلی </a>
            </li>

            <li class="nav-item active">
                <a class="nav-link" href="{{ route('rules') }}"> قوانین و مقررات </a>
            </li>

            <li class="nav-item active">
                <a class="nav-link" href="{{ route('about-us') }}"> درباره ما </a>
            </li>



        </ul>
        @if(Auth::check())
            <a href="{{route('panel')}}" type="button" class="btn btn-primary mr-2">
                <i class="fa-solid fa-user"></i>
                حساب کاربری
            </a>

        <a href="{{route('logout')}}" type="button" class="btn btn-danger">
            <i class="fa-solid fa-sign-out"></i>
            خروج
        </a>
        @else
            <a href="{{route('login')}}" type="button" class="btn btn-primary">
                <i class="fa-solid fa-right-to-bracket"></i>
                ورود
            </a>
        @endif

    </div>

    </div>
</nav>
