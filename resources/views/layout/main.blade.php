<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/navbar.css') }}">
    <link href="{{ asset('assets/uicons-brands/css/uicons-brands.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/boxicons-2.1.4/css/boxicons.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/Loading.css') }}">

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @yield('style')
    @yield('title')
    @livewireStyles
</head>

<body>
    <div class="contain">
        <livewire:navbar />
        <div class="body_content">
            @yield('content')
        </div>
    </div>
    @livewireScripts

</body>

</html>
@yield('scripts')

<script>

    if (window.innerWidth <= 768) {
        toggleNavbar();
    }
    function toggleNavbar() {
        const navbar = document.querySelector('.navbar_card');
        const body_content = document.querySelector('.body_content');
        const headerSpan = document.querySelector('.navbar_card .nav_header span');
        const footerLabel = document.querySelector('.nav_footer label');
        const footerImg = document.querySelector('.nav_footer .img_frame img');
        const footerIcon = document.querySelector('.nav_footer .icon');
        const circleIcon = document.querySelector('.circle_bt .icon');
        const listLabels = document.querySelectorAll('.navbar_card .nav_list label');
        const navLists = document.querySelectorAll('.navbar_card .nav_list');

        navbar.classList.toggle('close');
        body_content.classList.toggle('close');
        headerSpan.classList.toggle('close');
        footerLabel.classList.toggle('close');
        footerImg.classList.toggle('close');
        footerIcon.classList.toggle('close');
        circleIcon.classList.toggle('close');
        listLabels.forEach(label => label.classList.toggle('close'));
        navLists.forEach(navList => navList.classList.toggle('close'));
    }

    // Function to check if the display is small
    /* function isSmallDisplay() {
        return window.innerWidth <= 768; // Adjust this value as needed
    } */

    // Toggle navbar visibility when window is resized
    window.addEventListener('resize', function () {
        if (isSmallDisplay()) {
            toggleNavbar();
        }
    });

    // Toggle navbar visibility on click of circle button
    document.querySelector('.circle_bt').addEventListener('click', function () {
        toggleNavbar();
    });


</script>