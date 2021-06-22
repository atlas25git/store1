@extends('layouts.app')

@section('content')
<div class="container text-center">
  
  <h2>Products</h2>

   <div class="row">

   @foreach($allProducts as $products)

   <div class="card col-3">
       <img class="card-img-top" src="{{asset('default.jpg')}}" alt="Card image cap">
       <div class="card-body">
           <h4 class="card-title">{{$products->name}}</h4>
           <p class="card-text">Text</p>
       </div>
       <div class="card-body">
           <a href="#" class="card-link">Another link</a>
       </div>
   </div>

    @endforeach

   </div>
</div>
@endsection
