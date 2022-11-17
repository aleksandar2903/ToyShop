@extends('layouts.app')
@section('content')
<div class="container mt-5 px-4">
    <div class="row g-5">
        <div class="col-md-5 col-lg-4 order-md-last px-2">
            <div class="p-4 shadow-lg custom-rounded">
                <h4 class="d-flex justify-content-between align-items-center mb-3">
                    <span class="text-dark">Vasa korpa</span>
                    <span class="badge bg-warning text-dark rounded-pill">{{$toys->count()}}</span>
                </h4>
                <ul class="list-group mb-3 coustom-rounded">
                    @foreach ($toys as $toy)
                    <li class="list-group-item d-flex justify-content-between lh-sm">
                        <div>
                            <h6 class="my-0 me-2"><a class="text-decoration-none text-dark fw-bold"
                                    href="{{route('toys.show',$toy->toy->id)}}">{{$toy->toy->name}}</a></h6>
                            <small class="text-muted">Kol:{{$toy->quantity}}</small>
                        </div>
                        <span class="text-muted">{{$toy->toy->price}}rsd</span>
                    </li>
                    @endforeach
                    <li class="list-group-item d-flex justify-content-between">
                        <span>Ukupno za placanje (RSD)</span>
                        <strong>{{$toys->sum('totalAmount')}}rsd</strong>
                    </li>
                    <a class="pb-0 mt-2 text-dark text-end" href="/carts">Vidi korpu</a>
                </ul>
            </div>
        </div>
        <div class="col-md-7 custom-rounded shadow-lg col-lg-8 py-4">
            <h4 class="mb-3">Adresa isporuke</h4>
            <form action="{{route('orders.store')}}" method="post">
                @csrf
                <input type="hidden" name="totalAmount" value="{{$toys->sum('totalAmount')}}">
                <div class="row g-3">
                    <div class="col-sm-6">
                        <label for="name" class="form-label">Ime i prezime</label>
                        <input name="name" type="text" class="form-control @error('name') is-invalid
                    @enderror" placeholder="Petar Petrović" required="" value="{{old('name')}}">
                        @error('name')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>

                    <div class="col-sm-6">
                        <label for="phone" class="form-label">Telefon</label>
                        <input type="text" name="phone" class="form-control @error('phone') is-invalid
                    @enderror" placeholder="+381 11111111" value="{{old('phone')}}">
                        @error('phone')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="col-sm-8">
                        <label for="address" class="form-label">Adresa</label>
                        <input type="text" name="shippingAddress" class="form-control @error('shippingAddress') is-invalid
                @enderror" value="{{old('shippingAddress')}}" id="address" placeholder="Beograd, Kralja Petra"
                            required="">
                        @error('shippingAddress')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>

                    <div class="col-sm-4">
                        <label for="zip" class="form-label">Postanski broj</label>
                        <input type="text" name="zip" class="form-control @error('zip') is-invalid
                @enderror" value="{{old('zip')}}" id="zip" placeholder="11000" required="">
                        @error('zip')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                </div>

                <hr class="my-4">

                <h4 class="mb-3">Način plaćanja</h4>

                <div class="my-3">
                    <div class="form-check">
                        <input name="payment" type="radio" class="form-check-input" checked value="Visa" required="">
                        <label class="form-check-label" for="credit">Visa</label>
                    </div>
                    <div class="form-check">
                        <input name="payment" value="MastedCard" type="radio" class="form-check-input" required="">
                        <label class="form-check-label" for="debit">MastedCard</label>
                    </div>
                    <div class="form-check">
                        <input name="payment" value="PayPal" type="radio" class="form-check-input" required="">
                        <label class="form-check-label" for="paypal">PayPal</label>
                    </div>
                </div>

                <div class="row gy-3">
                    <div class="col-md-6">
                        <label for="cc-name" class="form-label">Vlasnik kartice</label>
                        <input type="text" value="{{old('card_name')}}" name="card_name" class="form-control @error('card_name') is-invalid
                @enderror" id="cc-name" placeholder="Petar Petrović" required="">
                        @error('card_name')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label for="cc-number" class="form-label">Broj kartice</label>
                        <input type="text" value="{{old('card_number')}}" name="card_number" class="form-control @error('card_number') is-invalid
                @enderror" id="cc-number" placeholder="1234567890" required="">
                        @error('card_number')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>

                    <div class="col-md-3">
                        <label for="cc-expiration" class="form-label">Datum isteka</label>
                        <input type="text" value="{{old('expiration')}}" name="expiration" class="form-control @error('expiration') is-invalid
                @enderror" id="cc-expiration" placeholder="04/2021" required="">
                        @error('expiration')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>

                    <div class="col-md-3">
                        <label for="cc-cvv" class="form-label">CVV</label>
                        <input type="text" value="{{old('cvv')}}" name="cvv" class="form-control @error('cvv') is-invalid
                @enderror" id="cc-cvv" placeholder="1234" required="">
                        @error('cvv')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                </div>

                <hr class="my-4">

                <button class="w-100 btn btn-warning btn-lg" type="submit">Plati {{$toys->sum('totalAmount')}}rsd</button>
            </form>
        </div>
    </div>
</div>
@endsection
