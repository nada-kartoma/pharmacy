@extends('pharmacist.home')
@section('content')
<div class="site-section">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <h2 class="h3 mb-5 text-black">Add medicin</h2>
          </div>
          <div class="col-md-12">
    
          <form action="{{route('store.demand.amount')}}" method="post" class="bg-light p-5 contact-form" enctype="multipart/form-data">
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
                        <input type="hidden" name="medicine" value="{{$medicine->id}}">
                        <input type="hidden" name="repository" value="{{$user->id}}">

              <div class="p-3 p-lg-5 border">
                  <div class="col-md-6">
                    <label class="text-black">Count </label>
                    <input type="number" class="form-control"  name="count">
                  </div>
                </div>
                <div class="p-3 p-lg-5 border">
                <div class="form-group row">
                  <div class="col-lg-12">
                    <input type="submit" class="btn btn-primary btn-lg btn-block" value="Demand">
                  </div>
                </div>
</div>
              </div>
            </form>
          </div>
          
        </div>
      </div>
    </div>

@endsection