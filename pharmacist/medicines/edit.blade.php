@extends('pharmacist.home')
@section('content')
<div class="site-section">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <h2 class="h3 mb-5 text-black">Edit medicin</h2>
          </div>
          <div class="col-md-12">
    
          <form action="{{route('update.medicines')}}" method="post" class="bg-light p-5 contact-form" enctype="multipart/form-data">
            @csrf
            @method('PUT')
        
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
                        <input type="hidden" name="id" value="{{$medicines->id}}">
              <div class="p-3 p-lg-5 border">
                <div class="form-group row">
                  <div class="col-md-6">
                    <label class="text-black"> Name </label>
                    <input type="text" class="form-control" value="{{$medicines->name}}"  name="name">
                  </div>
                  <div class="col-md-6">
                    <label class="text-black">Count </label>
                    <input type="number" class="form-control" value="{{$medicines->count}}"  name="count">
                  </div>
                </div>
                <div class="form-group row">
                  <div class="col-md-6">
                    <label  class="text-black"> Image </label>
                    <img src="{{asset('/uploads/medicines/'.$medicines->image)}}" alt="" width="150px" height="150px">
                    <input type="file" class="form-control" name="image">
                  </div>
                  <div class="col-md-6">
                    <label  class="text-black">Price</label>
                    <input type="text" class="form-control" value="{{$medicines->price}}"  name="price">
                  </div>
                </div>
                <div class="form-group row">
                  <div class="col-md-6">
                    <label  class="text-black"> Expire date </label>
                    <input type="date" class="form-control" value="{{$medicines->time}}" name="time">
                  </div>
                  <div class="col-md-6">
                    <label  class="text-black"> Compenent</label>
                    <input type="text" class="form-control" value="{{$medicines->compenent}}" name="compenent">
                  </div>
                 
                </div>
    
                <div class="form-group row" >
                  <div class="col-md-12">
                    <label for="c_message" class="text-black">Details </label>
                    <textarea name="details"  cols="30" rows="7" class="form-control">{{$medicines->details}}</textarea>
                  </div>
                </div>
                <div class="form-group row">
                  <div class="col-lg-12">
                    <input type="submit" class="btn btn-primary btn-lg btn-block" value="Update">
                  </div>
                </div>
              </div>
            </form>
          </div>
          
        </div>
      </div>
    </div>

@endsection