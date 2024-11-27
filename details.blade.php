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
    <div class="bg-light py-3">
      <div class="container">
        <div class="row">
          <div class="col-md-12 mb-0"><a href="{{url('/')}}">Home</a> <span class="mx-2 mb-0">/</span> <a
              href="{{url('/')}}#product">Product</a> <span class="mx-2 mb-0">/</span> <strong class="text-black">{{$medicines->name}}</strong></div>
        </div>
      </div>
    </div>

    <div class="site-section">
      <div class="container">
        <div class="row">
          <div class="col-md-5 mr-auto">
            <div class="border text-center">
              <img src="{{asset('uploads/medicines/'.$medicines->image)}}" alt="Image" class="img-fluid p-5">
            </div>
          </div>
          <div class="col-md-6">
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
            <h2 class="text-black">{{$medicines->name}}</h2>
            <p>  <strong class="text-primary h4">Compenent</strong></p>
            <p>{{$medicines->compenent}}</p>
            <p>  <strong class="text-primary h4">Details</strong></p>
            <p>{{$medicines->details}}</p>
            <p>  <strong class="text-primary h4">Expire date</strong></p>
            <p>{{$medicines->time}}</p>

            <p>  <strong class="text-primary h4">{{$medicines->price}}</strong></p>

            
            <form action="{{route('demand.patient')}}" method="post">
  @csrf
  <div class="mb-5">
    <div class="input-group mb-3" style="max-width: 220px;">
      <div class="input-group-prepend">
        <!-- زر النقصان يقلل القيمة في المدخل -->
        <button class="btn btn-outline-primary js-btn-minus" type="button" onclick="decreaseCount()">−</button>
      </div>
      <!-- الحقل الذي يحتوي على عدد الأدوية -->
      <input type="number" class="form-control text-center" name="count" id="medicineCount" value="1" min="1" step="1" placeholder=""
      aria-label="Example text with button addon" aria-describedby="button-addon1">
      <input type="hidden" name="medicine" value="{{$medicines->id}}">
      <div class="input-group-append">
        <!-- زر الزيادة يزيد القيمة في المدخل -->
        <button class="btn btn-outline-primary js-btn-plus" type="button" onclick="increaseCount()">+</button>
      </div>
    </div>
  </div>
  <script>
function increaseCount() {
  let countInput = document.getElementById('medicineCount');
  // استخدم الأساس 10 لتجنب أي أخطاء تحويل
  let currentCount = parseInt(countInput.value, 10); 
  if (isNaN(currentCount)) currentCount = 0; // إذا كانت القيمة غير صالحة، اجعلها 0
  countInput.value = currentCount + 1; // زيادة العدد بمقدار 1
  console.log("Increased count to: " + countInput.value); // تحقق من القيمة هنا
}

function decreaseCount() {
  let countInput = document.getElementById('medicineCount');
  let currentCount = parseInt(countInput.value, 10); // تحويل القيمة إلى عدد صحيح باستخدام الأساس 10
  if (isNaN(currentCount)) currentCount = 0; // إذا كانت القيمة غير صالحة، اجعلها 0
  if (currentCount > 1) {
    countInput.value = currentCount - 1; // نقصان العدد بمقدار 1
    console.log("Decreased count to: " + countInput.value); // تحقق من القيمة هنا
  }
}

  </script>
  
  <!-- حقل مخفي لحفظ معرف الدواء -->
  <!-- زر الإرسال لطلب الدواء مع العدد -->
  <button type="submit" class="buy-now btn btn-sm height-auto px-4 py-3 btn-primary">Demand</button>
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

  <script src="{{asset('js/main.js')}}"></script>

</body>

</html>