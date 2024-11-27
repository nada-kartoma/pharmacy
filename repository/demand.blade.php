@extends('repository.home')
@section('content')
<div class="site-section">
      <div class="container">
        <div class="row mb-5">
            <div class="col-md-12 site-blocks-table">
   
                <h2 >Demand</h2>
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
                @if($demand->count()>0)
              <table class="table table-bordered">
                <thead>
                  <tr>
                    <th class="product-thumbnail">Medicine name</th>
                    <th class="product-name">count</th>
                    <th class="product-price">Status</th>
                    <th class="product-remove">Accept</th>
                    <th class="product-remove">Reject</th>
                  </tr>
                </thead>
                <tbody>
                    @foreach($demand as $row)
                  <tr>
                    <td class="product-name">
                      <h2 class="h5 text-black">{{$row->medicine->name}}</h2>
                    </td>
                    <td>{{$row->count}}</td>
                    <td>{{$row->status}}</td>
                                <td>
                                  @if($row->status == 'accept for this count')
                                  Accepted this demand
                                  @else
                                  <form action="{{route('accept.demand' , ['id'=>$row->id])}}" method="post">
                                  @csrf
                                  <input type="hidden" name="medicine" value="{{$row->medicine_id}}">
                                  <input type="hidden" name="count" value="{{$row->count}}">
                                  <button class="btn btn-success">Accept</button>
                                  </form>
                                  @endif
                                </td>
                                <td>
                                @if($row->status == 'No amount for this medicine')
                                  Rejected this demand
                                  @else
                                  <a href="{{route('reject.demand' , ['id'=>$row->id])}}" class="btn btn-danger">Reject</a></td>
                                @endif
                  </tr>
                  @endforeach
    
                </tbody>
              </table>
              @else
              No demand yet
              @endif
            </div>
        </div>
    

      </div>
    </div>
@endsection