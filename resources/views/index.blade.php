<!DOCTYPE html>
<html lang="en">
    <head>
        <!-- basic -->
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <!-- mobile metas -->
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <meta name="viewport" content="initial-scale=1, maximum-scale=1" />
        <!-- site metas -->
        <title>Laptop365 - Giải pháp về công nghệ 4.0</title>
        <meta name="keywords" content="" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <!-- site icons -->
        <link rel="icon" href="{{ asset('images/fevicon/fevicon.png') }}" type="image/gif" />
        <!-- bootstrap css -->
        <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}" />
        <!-- Site css -->
        <link rel="stylesheet" href="{{ asset('css/style.css?=ver1.0') }}" />
        <!-- responsive css -->
        <link rel="stylesheet" href="{{ asset('css/responsive.css') }}" />
        <!-- colors css -->
        <link rel="stylesheet" href="{{ asset('css/colors1.css') }}" />
        <!-- custom css -->
        <link rel="stylesheet" href="{{ asset('css/custom.css') }}" />
        <!-- wow Animation css -->
        <link rel="stylesheet" href="{{ asset('css/animate.css') }}" />
        <!-- revolution slider css -->
        <link rel="stylesheet" type="text/css" href="{{ asset('revolution/css/settings.css') }}" />
        <link rel="stylesheet" type="text/css" href="{{ asset('revolution/css/layers.css') }}" />
        <link rel="stylesheet" type="text/css" href="{{ asset('revolution/css/navigation.css') }}" />
        <!-- zoom effect -->
        <link rel='stylesheet' href="{{ asset('css/hizoom.css')}}">
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
            <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>
    <body id="default_theme" class="it_service">
        <!-- loader -->
        <div class="bg_load"><img class="loader_animation" src="{{ asset('images/loaders/loader_1.png')}}" alt="#" /></div>
        
        <!-- end loader -->
        <!-- header -->
        @include('layouts.header')
        <!-- end header -->
        
        @if (\Session::has('success'))
        <div class="row">
            <div class="w-100" style="height: 30px; border-left: solid 1px #28A745; background-color: #52f275;">
                <p class="text-white text-center pt-1">{!! \Session::get('success') !!}</p>
            </div>
        </div>
        @endif
        @if (\Session::has('fail'))
        <div class="row">
            <div class="bg-danger w-100" style="height: 30px;">
                <p class="text-white text-center pt-1">{!! \Session::get('fail') !!}</p>
            </div>
        </div>
        @endif
        @yield('content')
        <div class="section padding_layout_1" style="padding: 50px 0;">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="full">
                            <ul class="brand_list">
                                <li><img src="{{ asset('images/it_service/brand_icon1.png')}}" alt="#" /></li>
                                <li><img src="{{ asset('images/it_service/brand_icon2.png')}}" alt="#" /></li>
                                <li><img src="{{ asset('images/it_service/brand_icon3.png')}}" alt="#" /></li>
                                <li><img src="{{ asset('images/it_service/brand_icon4.png')}}" alt="#" /></li>
                                <li><img src="{{ asset('images/it_service/brand_icon5.png')}}" alt="#" /></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- end section -->
        <!-- Modal -->
        <div class="modal fade" id="search_bar" role="dialog">
            <div class="modal-dialog">
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal"><i class="fa fa-close"></i></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-lg-8 col-md-8 col-sm-8 offset-lg-2 offset-md-2 offset-sm-2 col-xs-10 col-xs-offset-1">
                                <div class="navbar-search">
                                    <form action="#" method="get" id="search-global-form" class="search-global">
                                        <input type="text" placeholder="Nhập tên sản phẩm" autocomplete="off" name="s" id="search" value="" class="search-global__input" />
                                        <button class="search-global__btn"><i class="fa fa-search"></i></button>
                                        <div class="search-global__note">Tìm kiếm sản phẩm</div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Model search bar -->
        <!-- footer -->
        @include('layouts.footer')
        <!-- end footer -->
        <!-- js section -->
        <script src="{{ asset('js/jquery.min.js')}}"></script>
        @yield('script')
        <script src="{{ asset('js/bootstrap.min.js')}}"></script>
        <!-- menu js -->
        <script src="{{ asset('js/menumaker.js')}}"></script>
        <!-- wow animation -->
        <script src="{{ asset('js/wow.js')}}"></script>
        <!-- custom js -->
        <script src="{{ asset('js/custom.js')}}"></script>
        <!-- revolution js files -->
        <script src="{{ asset('revolution/js/jquery.themepunch.tools.min.js')}}"></script>
        <script src="{{ asset('revolution/js/jquery.themepunch.revolution.min.js')}}"></script>
        <script src="{{ asset('revolution/js/extensions/revolution.extension.actions.min.js')}}"></script>
        <script src="{{ asset('revolution/js/extensions/revolution.extension.carousel.min.js')}}"></script>
        <script src="{{ asset('revolution/js/extensions/revolution.extension.kenburn.min.js')}}"></script>
        <script src="{{ asset('revolution/js/extensions/revolution.extension.layeranimation.min.js')}}"></script>
        <script src="{{ asset('revolution/js/extensions/revolution.extension.migration.min.js')}}"></script>
        <script src="{{ asset('revolution/js/extensions/revolution.extension.navigation.min.js')}}"></script>
        <script src="{{ asset('revolution/js/extensions/revolution.extension.parallax.min.js')}}"></script>
        <script src="{{ asset('revolution/js/extensions/revolution.extension.slideanims.min.js')}}"></script>
        <script src="{{ asset('revolution/js/extensions/revolution.extension.video.min.js')}}"></script>
        <!-- map js -->
        <script>
            // 68 Đỗ Ngọc Du, P. Thanh Trung, Thành phố Hải Dương, Hải Dương, Việt Nam.
            function initMap() {
                var map = new google.maps.Map(document.getElementById("map"), {
                    zoom: 16,
                    center: { lat: 20.93663653426282, lng: 106.31269061213159 },
                    styles: [
                        {
                            elementType: "geometry",
                            stylers: [{ color: "#fefefe" }],
                        },
                        {
                            elementType: "labels.icon",
                            stylers: [{ visibility: "off" }],
                        },
                        {
                            elementType: "labels.text.fill",
                            stylers: [{ color: "#616161" }],
                        },
                        {
                            elementType: "labels.text.stroke",
                            stylers: [{ color: "#f5f5f5" }],
                        },
                        {
                            featureType: "administrative.land_parcel",
                            elementType: "labels.text.fill",
                            stylers: [{ color: "#bdbdbd" }],
                        },
                        {
                            featureType: "poi",
                            elementType: "geometry",
                            stylers: [{ color: "#eeeeee" }],
                        },
                        {
                            featureType: "poi",
                            elementType: "labels.text.fill",
                            stylers: [{ color: "#757575" }],
                        },
                        {
                            featureType: "poi.park",
                            elementType: "geometry",
                            stylers: [{ color: "#e5e5e5" }],
                        },
                        {
                            featureType: "poi.park",
                            elementType: "labels.text.fill",
                            stylers: [{ color: "#9e9e9e" }],
                        },
                        {
                            featureType: "road",
                            elementType: "geometry",
                            stylers: [{ color: "#eee" }],
                        },
                        {
                            featureType: "road.arterial",
                            elementType: "labels.text.fill",
                            stylers: [{ color: "#3d3523" }],
                        },
                        {
                            featureType: "road.highway",
                            elementType: "geometry",
                            stylers: [{ color: "#eee" }],
                        },
                        {
                            featureType: "road.highway",
                            elementType: "labels.text.fill",
                            stylers: [{ color: "#616161" }],
                        },
                        {
                            featureType: "road.local",
                            elementType: "labels.text.fill",
                            stylers: [{ color: "#9e9e9e" }],
                        },
                        {
                            featureType: "transit.line",
                            elementType: "geometry",
                            stylers: [{ color: "#e5e5e5" }],
                        },
                        {
                            featureType: "transit.station",
                            elementType: "geometry",
                            stylers: [{ color: "#000" }],
                        },
                        {
                            featureType: "water",
                            elementType: "geometry",
                            stylers: [{ color: "#c8d7d4" }],
                        },
                        {
                            featureType: "water",
                            elementType: "labels.text.fill",
                            stylers: [{ color: "#b1a481" }],
                        },
                    ],
                });
                var image = "images/it_service/location_icon_map_cont.png";
                var beachMarker = new google.maps.Marker({
                    position: { lat: 20.93663653426282, lng: 106.31269061213159 },
                    map: map,
                    icon: image,
                });
            }
        </script>
        <!-- google map js -->
        <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA8eaHt9Dh5H57Zh0xVTqxVdBFCvFMqFjQ&callback=initMap"></script>
        <!-- end google map js -->
    </body>
</html>
