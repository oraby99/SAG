@extends('layouts.app')


@section('content')



<div class="container">
    <div class="row">
        <div class="col-md-9">
            @foreach($carts as $cart)
            <div class="card mb-3">
                <div class="card-body">
                   
                    <table class="table table-striped mt-2 mb-2">
                        <thead>
                            <tr>
                                
                                <th scope="col">Title</th>
                                <th scope="col">Price</th>
                                <th scope="col">Quantity</th>
                                <th scope="col">status</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($cart->items as $item)
                            <tr>
                                
                                <td>{{$item['title'] }}</td>
                                <td>${{$item['price'] }}</td>
                                <td>{{$item['qty'] }}</td>
                                <td> Paid</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                  
                </div>
            </div>
            <p class="btn btn-primary mb-2 p-1 text-white " style="border-radius: 20px">Total Price : ${{$cart->totalPrice}}</p>
            @endforeach
        </div>
    </div>
</div>

@endsection