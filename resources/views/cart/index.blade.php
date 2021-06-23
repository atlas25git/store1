@extends('layouts.app')

@section('content')
    <h2>Atlas25</h2>

        <table class="table">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Price</th>
                    <th>Quantity</th>
                </tr>
            </thead>
            <tbody>
            
            @foreach($cartItems as $item)
                <tr>
                    <td scope="row">{{$item->name}}</td>
                    <td>{{$item->price}}</td>
                    <td>{{$item->quantity}}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
@endsection