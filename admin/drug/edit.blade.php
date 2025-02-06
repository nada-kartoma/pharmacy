@extends('admin.home')
@section('content')
<div class="site-section">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <h2 class="h3 mb-5 text-black">Edit drug</h2>
          </div>
          <div class="col-md-12">
    
          <form action="{{route('update.drug')}}" method="post" class="bg-light p-5 contact-form" enctype="multipart/form-data">
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
              <div class="p-3 p-lg-5 border">
                <div class="form-group row">
                  <div class="col-md-12">
                    <input type="hidden" name="id" value="{{$drug->id}}">
                    <label class="text-black"> Name medicine </label>
                    <input type="text" class="form-control" value="{{$drug->name}}"  name="name">
                  </div>
                </div>
                <div class="form-group row">
                <div class="col-md-6">
                    <label  class="text-black"> Alternative name</label>
                    <input type="text" class="form-control" value="{{$drug->alternative_name}}" name="alternative_name">
                  </div>
                  <div class="col-md-6">
                    <label  class="text-black"> Active ingredients</label>
                    <input type="text" class="form-control" value="{{$drug->active_ingredients}}" name="active_ingredients">
                  </div>
                 
                </div>
                <div class="form-group row">
             
                  <div class="col-md-12">
                    <label  class="text-black">Price</label>
                    <input type="number" class="form-control" value="{{$drug->price}}"  name="price">
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