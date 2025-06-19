<link rel="shortcut icon" href="{{ asset('assets/img/logo/Logo_Favicon.png') }}">
<!--<< Bootstrap min.css >>-->
<link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
<!--<< All Min Css >>-->
<link rel="stylesheet" href="{{ asset('assets/css/all.min.css') }}">
<!--<< Animate.css >>-->
<link rel="stylesheet" href="{{ asset('assets/css/animate.css') }}">
<!--<< Magnific Popup.css >>-->
<link rel="stylesheet" href="{{ asset('assets/css/magnific-popup.css') }}">
<!--<< MeanMenu.css >>-->
<link rel="stylesheet" href="{{ asset('assets/css/meanmenu.css') }}">
<!--<< Swiper Bundle.css >>-->
<link rel="stylesheet" href="{{ asset('assets/css/swiper-bundle.min.css') }}">
<!--<< Nice Select.css >>-->
<link rel="stylesheet" href="{{ asset('assets/css/nice-select.css') }}">
<!--<< Main.css >>-->
<link rel="stylesheet" href="{{ asset('assets/css/main.css') }}">
<!-- Swiper CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.css" />

<style>
    .custom-hero-style {
        background: linear-gradient(to right, rgba(0, 60, 30, 0.8), rgba(0, 60, 30, 0.4)), url('../img/banner/farm.jpg') no-repeat center center;
        background-size: cover;
        padding: 100px 0;
    }

    .hero-contentv01 {
        padding-left: 20px;
        max-width: 90%;
    }

    .hero-contentv01 h1 {
        font-size: 48px;
        font-weight: 700;
        line-height: 1.3;
        margin-bottom: 20px;
    }

    .hero-contentv01 .harves {
        display: block;
        font-size: 38px;
        font-weight: 400;
        margin-top: 10px;
    }

    .hero-contentv01 p {
        font-size: 18px;
        line-height: 1.6;
        margin-bottom: 30px;
        color: #f8f8f8;
    }

    .cmn-btn {
        background-color: #28a745;
        border: none;
        color: white;
        padding: 12px 25px;
        font-size: 16px;
        border-radius: 50px;
        transition: 0.3s ease;
        text-decoration: none;
    }

    .cmn-btn:hover {
        background-color: #218838;
    }

    @media (max-width: 768px) {
        .hero-contentv01 h1 {
            font-size: 32px;
        }

        .hero-contentv01 .harves {
            font-size: 24px;
        }

        .hero-contentv01 p {
            font-size: 16px;
        }
    }

    .pagination .current,
    .pagination a {
        background-color: #204f3e;
        color: #fff;
        padding: 8px 14px;
        border-radius: 5px;
        text-decoration: none;
        display: inline-block;
        transition: 0.3s;
    }

    .pagination a:hover {
        background-color: #163b2d;
        color: #fff;
    }

    .pagination .disabled {
        background-color: #ccc !important;
        color: #666 !important;
        pointer-events: none;
    }

    .pagination li {
        list-style: none;
    }

    .pagination svg {
        stroke: #fff;
    }
</style>
