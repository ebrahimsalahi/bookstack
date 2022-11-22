<!DOCTYPE html >
<html lang="fa" dir="rtl">

@include('panel.layouts.inc.head')
<body class="@yield('pageStyle')">

    @auth
        @include('panel.layouts.inc.navbar')
        @include('panel.layouts.inc.sidebar')
    @endauth


    @yield('content')

    @include('panel.layouts.inc.scripts')

    @auth
        @include('panel.layouts.inc.footer')
    @endauth


    @stack('files')

</body>
</html>
