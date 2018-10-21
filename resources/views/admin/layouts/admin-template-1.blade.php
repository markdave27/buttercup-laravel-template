@include('admin.includes.head')
@include('admin.includes.header')
{{--@include('admin.includes.main-sidebar', [$variable])--}}
@include('admin.includes.main-sidebar')
@yield('page-content')
@include('admin.includes.footer')
@include('admin.includes.control-sidebar')
@include('admin.includes.script-footer')