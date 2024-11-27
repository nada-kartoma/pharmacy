@extends('patient.home')
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