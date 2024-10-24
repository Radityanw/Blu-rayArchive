<!DOCTYPE html>
<html lang="en">
<head>
    <title>Product Detail</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--===============================================================================================-->  
    <link rel="icon" type="image/png" href="{{ asset('images/icons/favicon.png') }}"/>
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{ asset('vendor/bootstrap/css/bootstrap.min.css') }}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{ asset('fonts/font-awesome-4.7.0/css/font-awesome.min.css') }}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{ asset('fonts/iconic/css/material-design-iconic-font.min.css') }}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{ asset('fonts/linearicons-v1.0.0/icon-font.min.css') }}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{ asset('vendor/animate/animate.css') }}">
    <!--===============================================================================================-->  
    <link rel="stylesheet" type="text/css" href="{{ asset('vendor/css-hamburgers/hamburgers.min.css') }}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{ asset('vendor/select2/select2.min.css') }}">
    <!--===============================================================================================-->  
    <link rel="stylesheet" type="text/css" href="{{ asset('vendor/daterangepicker/daterangepicker.css') }}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{ asset('vendor/slick/slick.css') }}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{ asset('vendor/MagnificPopup/magnific-popup.css') }}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{ asset('vendor/perfect-scrollbar/perfect-scrollbar.css') }}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{ asset('css/util.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/main.css') }}">
    <!--===============================================================================================-->
</head>
<body class="animsition">
    <!-- Header -->
    
    <header class="header-v4">
        <div class="container-menu-desktop">
            
            <nav class="limiter-menu-desktop container">
                <a href="{{ route('mainpage') }}" class="logo">
                    <img src="{{ asset('images/blurayarchive.png') }}">
                </a>
                
                <div class="wrap-icon-header flex-w flex-r-m">
                    <div class="icon-header-item cl2 hov-cl1 trans-04 p-l-22 p-r-11">
                        <a href="{{ route('dashboard') }}">
                            <img src="{{ asset('images/icons/profile.png') }}" alt="Profile Icon" style="width: 24px; height: 24px;">
                        </a>
                    </div>
                </div>
            </nav>
        </div>
    </header>

    <!-- Product Detail -->
    <section class="sec-product-detail bg0 p-t-65 p-b-60">
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-lg-7 p-b-30">
                    <div class="p-l-25 p-r-30 p-lr-0-lg">
                        <div class="wrap-slick3 flex-sb flex-w">
                            <div class="slick3 gallery-lb">
                                <div class="item-slick3" data-thumb="{{ asset('images/cover/' . $bluray->image) }}">
                                    <div class="wrap-pic-w pos-relative">
                                        <img src="{{ asset('images/cover/' . $bluray->image) }}" alt="{{ $bluray->title }}">
                                        <a class="flex-c-m size-108 how-pos1 bor0 fs-16 cl10 bg0 hov-btn3 trans-04" href="{{ asset('images/cover/' . $bluray->image) }}">
                                            <i class="fa fa-expand"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                    
                <div class="col-md-6 col-lg-5 p-b-30">
                    <div class="p-r-50 p-t-5 p-lr-0-lg">
                        <h4 class="mtext-105 cl2 js-name-detail p-b-14">
                            {{ $bluray->title }}
                        </h4>
                
                        <span class="mtext-106 cl2">
                            $<span id="blurayPrice">{{ $bluray->price }} per day</span>
                        </span>
                
                        <p class="stext-102 cl3 p-t-23">
                            {{ $bluray->description }}
                        </p>
                        <div class="stext-102 cl3 p-t-23">
                            <strong>Categories: </strong>
                            {{ implode(', ', $bluray->categories->pluck('name')->toArray()) }}
                        </div>
                        <form action="{{ route('rent.bluray') }}" method="POST">
                            @csrf
                            <div class="p-t-33">
                                <!-- Select Blu-ray ID -->
                                <div class="flex-w flex-r-m p-b-10">
                                    <div class="size-203 flex-c-m respon6">Select Blu-ray</div>
                                    <div class="size-204 respon6-next">
                                        <select class="js-select2" name="bluray_id">
                                            <option>Choose a Blu-ray</option>
                                            @foreach ($bluray_ids as $bluray)
                                                <option value="{{ $bluray->id }}" {{ $bluray->status === 'rented' ? 'disabled' : '' }}>
                                                    {{ $bluray->id }} - {{ $bluray->status === 'rented' ? 'Rented' : 'Available' }}
                                                </option>
                                            @endforeach
                                        </select>
                                        <div class="dropDownSelect2"></div>
                                    </div>
                                </div>
                
                                <!-- Select Rental Days -->
                                <div class="flex-w flex-r-m p-b-10">
                                    <div class="size-203 flex-c-m respon6">Days</div>
                                    <div class="size-204 respon6-next">
                                        <select class="js-select2" id="daysSelect" name="days">
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5">5</option>
                                        </select>
                                        <div class="dropDownSelect2"></div>
                                    </div>
                                </div>
                
                                <!-- Rent Button -->
                                <div class="flex-w flex-r-m p-b-10">
                                    <button type="submit" class="flex-c-m stext-101 cl0 size-101 bg1 bor1 hov-btn1 p-lr-15 trans-04 js-addcart-detail">
                                        Rent
                                    </button>
                                </div>
                            </div>
                        </form>
                
                        <!-- Display the estimated price -->
                        <div class="p-t-10">
                            <span class="mtext-106 cl2">Estimated Price: $</span>
                            <span class="mtext-106 cl2" id="estimatedPrice">0.00</span>
                        </div>
                    </div>
                </div>
                
            <div class="bor10 m-t-50 p-t-43 p-b-40">
                <div class="tab01">
                    <ul class="nav nav-tabs" role="tablist">
                        <li class="nav-item p-b-10">
                            <a class="nav-link active" data-toggle="tab" href="#description" role="tab">Description</a>
                        </li>
                    </ul>

                    <div class="tab-content p-t-43">
                        <div class="tab-pane fade show active" id="description" role="tabpanel">
                            <div class="how-pos2 p-lr-15-md">
                                <p class="stext-102 cl6">
                                    {{ $bluray->description }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg3 p-t-75 p-b-32">
        <div class="container">
            <!-- Footer content (simplified for brevity) -->
        </div>
    </footer>

    <!-- Back to top -->
    <div class="btn-back-to-top" id="myBtn">
        <span class="symbol-btn-back-to-top">
            <i class="zmdi zmdi-chevron-up"></i>
        </span>
    </div>

    <!-- Scripts -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const pricePerDay = {{ $bluray->price }};  // Blu-ray price from the backend
            const daysSelect = document.getElementById('daysSelect');
            const estimatedPriceElement = document.getElementById('estimatedPrice');
    
            // Listen for changes in the 'days' dropdown
            daysSelect.addEventListener('change', function () {
                const selectedDays = parseInt(daysSelect.value);
    
                if (selectedDays > 0) {
                    // Calculate estimated price
                    const estimatedPrice = selectedDays * pricePerDay;
    
                    // Update the estimated price element
                    estimatedPriceElement.textContent = `$${estimatedPrice.toFixed(2)}`;
                } else {
                    // Reset price if no valid option is selected
                    estimatedPriceElement.textContent = '$0.00';
                }
            });
        });
    </script>
    <script src="{{ asset('vendor/jquery/jquery-3.2.1.min.js') }}"></script>
    <script src="{{ asset('vendor/animsition/js/animsition.min.js') }}"></script>
    <script src="{{ asset('vendor/bootstrap/js/popper.js') }}"></script>
    <script src="{{ asset('vendor/bootstrap/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('vendor/select2/select2.min.js') }}"></script>
    <script>
        $(".js-select2").each(function(){
            $(this).select2({
                minimumResultsForSearch: 20,
                dropdownParent: $(this).next('.dropDownSelect2')
            });
        });
    </script>
    <script src="{{ asset('vendor/daterangepicker/moment.min.js') }}"></script>
    <script src="{{ asset('vendor/daterangepicker/daterangepicker.js') }}"></script>
    <script src="{{ asset('vendor/slick/slick.min.js') }}"></script>
    <script src="{{ asset('js/slick-custom.js') }}"></script>
    <script src="{{ asset('vendor/parallax100/parallax100.js') }}"></script>
    <script> $('.parallax100').parallax100(); </script>
    <script src="{{ asset('vendor/MagnificPopup/jquery.magnific-popup.min.js') }}"></script>
    <script>
        $('.gallery-lb').each(function() {
            $(this).magnificPopup({
                delegate: 'a',
                type: 'image',
                gallery: {
                    enabled: true
                },
                mainClass: 'mfp-fade'
            });
        });
    </script>
    <script src="{{ asset('vendor/isotope/isotope.pkgd.min.js') }}"></script>
    <script src="{{ asset('vendor/sweetalert/sweetalert.min.js') }}"></script>
    <script>
        $('.js-addwish-b2, .js-addwish-detail').on('click', function(e){
            e.preventDefault();
        });

        $('.js-addwish-b2').each(function(){
            var nameProduct = $(this).parent().parent().find('.js-name-b2').html();
            $(this).on('click', function(){
                swal(nameProduct, "is added to wishlist!", "success");

                $(this).addClass('js-addedwish-b2');
                $(this).off('click');
            });
        });

         $('.js-addcart-detail').each(function(){
             var nameProduct = $(this).parent().parent().parent().parent().find('.js-name-detail').html();
             $(this).on('click', function(){
                 swal(nameProduct, "Succesfully rented, enjoy!", "success");
            });
        });
    </script>
    <script src="{{ asset('vendor/perfect-scrollbar/perfect-scrollbar.min.js') }}"></script>
    <script>
        $('.js-pscroll').each(function(){
            $(this).css('position','relative');
            $(this).css('overflow','hidden');
            var ps = new PerfectScrollbar(this, {
                wheelSpeed: 1,
                scrollingThreshold: 1000,
                wheelPropagation: false,
            });

            $(window).on('resize', function(){
                ps.update();
            });
        });
    </script>
    <script src="{{ asset('js/main.js') }}"></script>
    <!-- JavaScript to calculate the estimated price dynamically -->

    
</body>
</html>

