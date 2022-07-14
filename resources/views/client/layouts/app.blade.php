<!DOCTYPE html>
<html lang="en">

<head>
    @include('client.layouts.head')
</head>

<body>
    <!-- Topbar Start -->
    @include('client.layouts.header')
    <!-- Topbar End -->


    <!-- Navbar Start -->
    <div class="container-fluid mb-5">
        <div class="row border-top px-xl-5">
            {{-- sự dụng view composer --}}
            @include('client.layouts.category')
           
            <div class="col-lg-9">
                @include('client.layouts.nav')
                @include('client.layouts.slider')
            </div>
        </div>
    </div>
    <!-- Navbar End -->


    {{-- Content Start --}}
    @yield('content')
    {{-- Content End--}}

    <!-- Footer Start -->
    @include('client.layouts.footer')
    <!-- Footer End -->


    <!-- Back to Top -->
    <a href="#" class="btn btn-primary back-to-top"><i class="fa fa-angle-double-up"></i></a>


    @include('client.layouts.script')
</body>

</html>