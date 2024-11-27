@extends('pharmacist.home')
@section('content')
<div class="site-section">
      <div class="container">
        <div class="row mb-5">
            <div class="col-md-12 site-blocks-table">
   
                <h2 >Products</h2>
                @if($medicines->count()>0)
              <table class="table table-bordered">
                <thead>
                  <tr>
                    <th class="product-thumbnail">Image</th>
                    <th class="product-name">Product</th>
                    <th class="product-price">Price</th>
                    <th class="product-total">Compenent</th>
                    <th class="product-remove">Edit</th>
                    <th class="product-remove">Remove</th>
                  </tr>
                </thead>
                <tbody>
                    @foreach($medicines as $row)
                  <tr>
                    <td class="product-thumbnail">
                      <img src="{{asset('uploads/medicines/'.$row->image)}}" alt="Image" class="img-fluid">
                    </td>
                    <td class="product-name">
                      <h2 class="h5 text-black">{{$row->name}}</h2>
                    </td>
                    <td>{{$row->price}}</td>
                    <td>{{$row->compenent}}</td>
                    <td><a href="{{route('edit.medicines' , ['id'=>$row->id])}}" class="btn btn-success">Edit</a></td>
                                <td>
                                  <form action="{{route('delete.medicines' , ['id'=>$row->id])}}" method="post">
                                  <button class="btn btn-danger">Delete</button>
                                      @csrf
                                      @method('delete')
                                  </form>
                                </td>
                  </tr>
                  @endforeach
    
                </tbody>
              </table>
              @else
              No product yet
              @endif
            </div>
        </div>
    

      </div>
    </div>
@endsection