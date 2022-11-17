@extends('layouts.app')
@section('content')
<div class="container mt-5 px-4">
    <div class="row">
        <div class="col-12 col-lg-8">
            <div class="table-responsive table-responsive-sm table-responsive-md table-responsive-lg">
                @if(count($toys) > 0)
                <table class="table">
                    <thead style="background-color: #f1f1f1" class="border">
                        <tr>
                            <th>Detalji</th>
                            <th></th>
                            <th>Kolicina</th>
                            <th>Ukupno</th>
                            <th>Ukloni</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($toys as $toy)
                        <tr>
                            <td>
                                <img style="width:6rem;" src="{{asset('/storage/images/'.$toy->toy->image)}}" alt="...">
                            </td>
                            <td><a class="text-dark text-nowrap" href="http://"><span
                                        class="fw-bold small">{{$toy->toy->name}}</span></a>
                                <span class="d-flex mt-2 fw-bold">{{$toy->toy->price}}rsd</span></td>
                            <td class="py-4">
                                <form class="px-4 d-flex" action="{{route('carts.update',['cart'=>$toy->id])}}"
                                    method="post">
                                    @csrf
                                    @method('put')
                                    <input type="hidden" name="price" value="{{$toy->toy->price}}">
                                    <input class="form-control" type="number" name="quantity"
                                        value="{{$toy->quantity}}">
                                    <button type="submit" class="btn btn-link text-decoration-none text-success"><i
                                            class="fas fa-check    "></i></button>
                                </form>
                            </td>
                            <td class="py-4">{{$toy->totalAmount}}rsd</td>
                            <td class="text-center py-4">
                                <form action="{{route('carts.destroy',$toy)}}" method="post">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" class="btn p-0 m-0 text-danger"><i
                                            class="fas fa-trash-alt"></i></button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                @else
                <p class="text-center"><svg width="200" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                    </svg></p>
                <p class="text-center">Vasa korpa je prazna. <a href="/shop" class="text-muted">Nastavi sa kupovinom</a>
                </p>
                @endif
            </div>
        </div>
        <div class="col-12 col-lg-4">
            <div class="row py-3 fw-bold text-center bg-warning"><span>Vasa korpa</span></div>
            <div class="row bg-white py-4 px-4">
                <p class="py-2 px-0 border-bottom"><span class="">Standardna dostava:</span> <span
                        class="float-end">Besplatno</span></p>
                <p class="py-2 px-0 border-bottom"><span class="fw-bold fs-5">Ukupno za placanje:</span> <span
                        class="fw-bold float-end fs-5">{{auth()->user()->cart->sum('totalAmount')}}rsd</span></p>
                @if(count($toys) == 0)
                <button class="w-100 btn btn-warning py-3 fw-bold mb-2" disabled>DALJE</button>
                @else
                <a href="/orders/create" class="w-100 btn btn-warning py-3 fw-bold mb-2">DALJE</a>
                @endif
                <a href="/shop" class="w-100 btn btn-outline-warning text-dark py-2">Nazad u prodavnicu</a>
            </div>
        </div>
    </div>
</div>
@endsection
