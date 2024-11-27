<!DOCTYPE html>
<html lang="en">

<head>
  <title>Pharma</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <link href="https://fonts.googleapis.com/css?family=Rubik:400,700|Crimson+Text:400,400i" rel="stylesheet">
  <link rel="stylesheet" href="{{asset('fonts/icomoon/style.css')}}">

  <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
  <link rel="stylesheet" href="{{asset('css/magnific-popup.css')}}">
  <link rel="stylesheet" href="{{asset('css/jquery-ui.css')}}">
  <link rel="stylesheet" href="{{asset('css/owl.carousel.min.css')}}">
  <link rel="stylesheet" href="{{asset('css/owl.theme.default.min.css')}}">


  <link rel="stylesheet" href="{{asset('css/aos.css')}}">

  <link rel="stylesheet" href="{{asset('css/style.css')}}">

</head>

<body>

  <div class="site-wrap">


    <div class="site-navbar py-2">

      <div class="search-wrap">
        <div class="container">
          <a href="#" class="search-close js-search-close"><span class="icon-close2"></span></a>
          <form action="{{route('search')}}" method="get" >
											@csrf
            <input type="text" class="form-control" name="search" placeholder="Search keyword and hit enter...">
          </form>
        </div>
      </div>

      <div class="container">
        <div class="d-flex align-items-center justify-content-between">
          <div class="logo">
            <div class="site-logo">
              <a href="{{url('/')}}" class="js-logo-clone">Pharma</a>
            </div>
          </div>
          <div class="main-nav d-none d-lg-block">
            <nav class="site-navigation text-right text-md-center" role="navigation">
              <ul class="site-menu js-clone-nav d-none d-lg-block">
                <li class="active"><a href="{{url('/')}}">Home</a></li>
                <li><a href="{{url('/')}}#product">Products</a></li>
                <li><a href="{{url('/')}}#pharmacy">Pharmacists</a></li>
              </ul>
            </nav>
          </div>
          <div class="icons">
           @if (Route::has('login'))
              @auth
                <a href="{{ url('/home') }}" >Profile</a>
                @else
                <a href="{{ route('login') }}" >Login / </a>
                @if (Route::has('register'))
                  <a href="{{ route('register') }}" >Register</a>
                @endif
              @endauth
            @endif
           
           <a href="#" class="icons-btn d-inline-block js-search-open"><span class="icon-search"></span></a>
             <!-- <a href="cart.html" class="icons-btn d-inline-block bag">
              <span class="icon-shopping-bag"></span>
              <span class="number">2</span>
            </a>
            <a href="#" class="site-menu-toggle js-menu-toggle ml-3 d-inline-block d-lg-none"><span
                class="icon-menu"></span></a> -->
                
    
          </div>
        </div>
      </div>
    </div>

    <div class="site-blocks-cover" style="background-image: url('images/hero_1.jpg');">
      <div class="container">
        <div class="row">
          <div class="col-lg-7 mx-auto order-lg-2 align-self-center">
            <div class="site-block-cover-content text-center">
              <h2 class="sub-title">Effective Medicine, New Medicine Everyday</h2>
              <h1>Welcome To Pharma</h1>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="site-section" >
      <div class="container">
        <div class="row align-items-stretch section-overlap">
          <div class="col-md-6 col-lg-4 mb-4 mb-lg-0">
            <div class="banner-wrap bg-primary h-100">
              <a href="#" class="h-100">
                <h5>24/7  <br> Pharmacy</h5>
                <p>
                Your Health in Trusted Hands Anytime
                  <strong>We provide medications and medical services whenever you need them.</strong>
                </p>
              </a>
            </div>
          </div>
          <div class="col-md-6 col-lg-4 mb-4 mb-lg-0">
            <div class="banner-wrap h-100">
              <a href="#" class="h-100">
                <h5>Smart  <br> Service</h5>
                <p>
                Always Open: Because Health Can't Wait
                  <strong>Quick and effective solutions for your health at any moment.</strong>
                </p>
              </a>
            </div>
          </div>
          <div class="col-md-6 col-lg-4 mb-4 mb-lg-0">
            <div class="banner-wrap bg-warning h-100">
              <a href="#" class="h-100">
                <h5>Medications  <br> Anytime</h5>
                <p>
                A Smart System for Continuous Care
                  <strong>Always an alternative available with round-the-clock service</strong>
                </p>
              </a>
            </div>
          </div>

        </div>
      </div>
    </div>

 
    
    <div class="site-section bg-light" id="product">
      <div class="container">
        <div class="row">
          <div class="title-section text-center col-12">
            <h2 class="text-uppercase">Our Products</h2>
          </div>
        </div>
        <div class="row">
        @if($medicines->count()>0)
          <div class="col-md-12 block-3 products-wrap">
            <div class="nonloop-block-3 owl-carousel">        
              @foreach($medicines as $row)
                <div class="text-center item mb-4">
                  <a href="{{route('details' , ['id'=>$row->id])}}"> <img src="{{asset('uploads/medicines/'.$row->image)}}" alt="Image" width="60%" height="300px"></a>
                  <h3 class="text-dark"><a href="{{route('details' , ['id'=>$row->id])}}">{{$row->name}}</a></h3>
                  <p class="price">{{$row->price}}</p>
                </div>
              @endforeach       
            </div>
          </div>
          @else
          <div class="col-md-5 block-3">           
          </div>
          <div class="col-md-3 block-3">
            <h3 >No medicines yet</h3>
          </div>
          @endif
        </div>
      </div>
    </div>

    <div class="site-section" id="pharmacy">
      <div class="container">
        <div class="row">
          <div class="title-section text-center col-12">
            <h2 class="text-uppercase">Our Pharmacists</h2>
          </div>
        </div>
        <div class="row">
          @if($user->count()>0)
          <div class="col-md-12 block-3 products-wrap">
            <div class="nonloop-block-3 no-direction owl-carousel">      
              @foreach($user as $row)  
              <div class="testimony">
                <blockquote>
                @if($row->image == NULL)
                <img src="{{asset('profile.jpg')}}" alt="Image" class="img-fluid w-25 mb-4 rounded-circle">
                @else
                <img src="{{url('uploads/user/'.$row->image )}}" alt="Image" class="img-fluid w-25 mb-4 rounded-circle">
                @endif
                  <p>&ldquo; {{$row->bio}} &rdquo;</p>
                </blockquote>

                <p>&mdash; {{$row->name}}</p>
              </div>
              @endforeach
            </div>
          </div>
          @else
          <div class="col-md-5 block-3">           
          </div>
          <div class="col-md-3 block-3">
            <h3 >No Pharmacist yet</h3>
          </div>
          @endif
        </div>
      </div>
    </div>

    <div class="site-section bg-secondary bg-image" style="background-image: url('images/bg_2.jpg');">
      <div class="container">
        <div class="row align-items-stretch">
          <div class="col-lg-6 mb-5 mb-lg-0">
            <a href="#" class="banner-1 h-100 d-flex" style="background-image: url('images/bg_1.jpg');">
              <div class="banner-1-inner align-self-center">
                <h2>Pharma Products</h2>
                <p>Our medications are designed for effectiveness, ensuring you receive the best care for your health.
                </p>
              </div>
            </a>
          </div>
          <div class="col-lg-6 mb-5 mb-lg-0">
            <a href="#" class="banner-1 h-100 d-flex" style="background-image: url('images/bg_2.jpg');">
              <div class="banner-1-inner ml-auto  align-self-center">
                <h2>Rated by Experts</h2>
                <p>Our medical team is continually evolving, dedicated to providing expert support and innovative solutions for your well-being
                </p>
              </div>
            </a>
          </div>
        </div>
      </div>
    </div>


    <footer class="site-footer">
      <div class="container">
        <div class="row">
          <div class="col-md-6 col-lg-3 mb-4 mb-lg-0">

            <div class="block-7">
              <h3 class="footer-heading mb-4">About Us</h3>
              <p>Welcome to our pharmacy website, where your health is our priority. We provide a wide range of quality medications, expert advice, and 24/7 service to ensure you have everything you need for a healthier life</p>
            </div>

          </div>
          <div class="col-lg-3 mx-auto mb-5 mb-lg-0">
            <h3 class="footer-heading mb-4">Quick Links</h3>
            <ul class="list-unstyled">
              <li><a href="{{url('/')}}">Home</a></li>
              <li><a href="{{url('/')}}#pharmacy">Our Pharmacist</a></li>
              <li><a href="{{url('/')}}#product">Our products</a></li>
            </ul>
          </div>

          <div class="col-md-6 col-lg-3">
            <div class="block-5 mb-5">
              <h3 class="footer-heading mb-4">Contact Info</h3>
              <ul class="list-unstyled">
                <li class="address">Mazzah , Damascus , Syria</li>
                <li class="phone"><a href="tel://0933880022">+963 933 880 022</a></li>
                <li class="email">pharma@gmail.com</li>
              </ul>
            </div>


          </div>
        </div>
    
      </div>
    </footer>
  </div>

  <script src="{{asset('js/jquery-3.3.1.min.js')}}"></script>
  <script src="{{asset('js/jquery-ui.js')}}"></script>
  <script src="{{asset('js/popper.min.js')}}"></script>
  <script src="{{asset('js/bootstrap.min.js')}}"></script>
  <script src="{{asset('js/owl.carousel.min.js')}}"></script>
  <script src="{{asset('js/jquery.magnific-popup.min.js')}}"></script>
  <script src="{{asset('js/aos.js')}}"></script>

  <script src="{{asset('js/main.js')}}"></script>

</body>

</html>