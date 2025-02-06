@extends('admin.home')
@section('content')
<div class="site-section">
      <div class="container">
        <div class="row mb-5">
            <div class="col-md-12 site-blocks-table">
   
                <h2 >Drugs</h2>
                @if($drug->count()>0)
              <table class="table table-bordered">
                <thead>
                  <tr>
                    <th class="product-name">Name medicine</th>
                    <th class="product-price">Alternative</th>
                    <th class="product-total">Ingredients</th>
                    <th>Price</th>
                    <th class="product-remove">Edit</th>
                    <th class="product-remove">Delete</th>
                  </tr>
                </thead>
                <tbody>
                    @foreach($drug as $row)
                  <tr>
                    <td class="product-name">
                      <h2 class="h5 text-black">{{$row->name}}</h2>
                    </td>
                    <td>{{$row->alternative_name}}</td>
                    <td>{{$row->active_ingredients}}</td>
                    <td>{{$row->price}}</td>
                    <td><a href="{{route('edit.drug' , ['id'=>$row->id])}}" class="btn btn-success">Edit</a></td>
                                <td>
                                  <form action="{{route('delete.drug' , ['id'=>$row->id])}}" method="post">
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
              No Drug yet
              @endif
            </div>
        </div>
    

      </div>
    </div>
@endsection