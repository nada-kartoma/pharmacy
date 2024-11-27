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
          <form action="#" method="post">
            <input type="text" class="form-control" placeholder="Search keyword and hit enter...">
          </form>
        </div>
      </div>

      <div class="container">
        <div class="d-flex align-items-center justify-content-between">
          <div class="logo">
            <div class="site-logo">
              <a href="index.html" class="js-logo-clone">Pharma</a>
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
            <!-- <a href="#" class="icons-btn d-inline-block js-search-open"><span class="icon-search"></span></a>
            <a href="cart.html" class="icons-btn d-inline-block bag">
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

    <div class="bg-light py-3">
      <div class="container">
        <div class="row">
          <div class="col-md-12 mb-0">
            <a href="{{url('/')}}">Home</a> <span class="mx-2 mb-0">/</span>
            <strong class="text-black">Register</strong>
          </div>
        </div>
      </div>
    </div>

    <div class="site-section">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <h2 class="h3 mb-5 text-black">Register</h2>
          </div>
          <div class="col-md-12">
    
          <form action="{{route('register')}}" method="post" class="bg-light p-5 contact-form" enctype="multipart/form-data">
            @csrf
        
                        @if($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif    
                        @if(session('status'))
                            <h6 class="alert alert-success" style="text-align: center;">
                                {{session('status')}}
                            </h6>
                        @endif
              <div class="p-3 p-lg-5 border">
                <div class="form-group row">
                  <div class="col-md-6">
                    <label class="text-black"> Name <span class="text-danger">*</span></label>
                    <input type="text" class="form-control"  name="name">
                  </div>
                  <div class="col-md-6">
                    <label class="text-black">Email <span class="text-danger">*</span></label>
                    <input type="email" class="form-control"  name="email">
                  </div>
                </div>
                <div class="form-group row">
                  <div class="col-md-6">
                    <label  class="text-black"> Image </label>
                    <input type="file" class="form-control" name="image">
                  </div>
                  <div class="col-md-6">
                    <label  class="text-black">Phone</label>
                    <input type="text" class="form-control"  name="phone">
                  </div>
                </div>
                <div class="form-group row">
                  <div class="col-md-6">
                    <label  class="text-black"> Location </label>
                    <input type="text" class="form-control" name="address">
                  </div>
                  <div class="col-md-6">
                    <label  class="text-black">Select role</label>
                    <select name="role" id="role"  class="form-control">
                        <option value="">select role</option>
                        <option value="Pharmacist">Pharmacist</option>
                        <option value="Patient">Patient</option>
                        <option value="Repository">Repository</option>
                    </select>
                  </div>
                </div>
                
                <script>
                    document.getElementById('role').addEventListener('change', function () {
                        var role = this.value;
                        var bio = document.getElementById('bio');

                        if (role === 'Pharmacist') {
                            bio.style.display = 'block';
                        }
                        else {
                            bio.style.display = 'none';
                        }
                    });
                </script>

                <div class="form-group row">
                  <div class="col-md-6">
                    <label  class="text-black"> Password </label>
                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password"  autocomplete="new-password">
                  </div>
                  <div class="col-md-6">
                    <label  class="text-black">Confirm password</label>
                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation"  autocomplete="new-password">
                  </div>
                </div>
    
                <div class="form-group row" id="bio" style="display: none;">
                  <div class="col-md-12">
                    <label for="c_message" class="text-black">Bio </label>
                    <textarea name="bio"  cols="30" rows="7" class="form-control"></textarea>
                  </div>
                </div>
                <div class="form-group row">
                  <div class="col-lg-12">
                    <input type="submit" class="btn btn-primary btn-lg btn-block" value="Register">
                  </div>
                </div>
              </div>
            </form>
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
