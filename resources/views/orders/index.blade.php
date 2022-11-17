@extends('layouts.app')
@section('content')
<div class="row py-5 m-0">
    <div class="row d-flex justify-content-center m-0">
        <div class="col-md-10 py-2 px-4">
            <div class="row shadow-lg custom-rounded bg-white py-4 px-4">
                <div class="row d-flex justify-content-between mt-2 mb-4">
                    <h3 class="w-auto my-auto fw-bold border-bottom pb-1">Kupovine</h3>
                </div>
                <div class="table-responsive table-responsive-sm table-responsive-md table-responsive-lg table-responsive-xl">
                    <table class="table table-borderless">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Ime i prezime</th>
                                <th>Telefon</th>
                                <th>Adresa</th>
                                <th>Poštanski broj</th>
                                <th>Vlasnik kartice</th>
                                <th>Način plaćanja</th>
                                <th>Ukupno (rsd)</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($orders as $order)
                            <tr>
                                <td><a class="text-dark" href="{{route('orders.myorder',$order->id)}}">{{$order->id}}</a></td>
                                <td>{{$order->name}}</td>
                                <td>{{$order->phone}}</td>
                                <td>{{$order->shippingAddress}}</td>
                                <td>{{$order->zip}}</td>
                                <td>{{$order->card_name}}</td>
                                <td>{{$order->payment}}</td>
                                <td>{{$order->totalAmount}}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
