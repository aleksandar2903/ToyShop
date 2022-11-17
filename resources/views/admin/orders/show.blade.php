@extends('layouts.layout')
@section('content')
<div class="row py-5">
    <div class="row d-flex justify-content-center m-0">
        <div class="col-md-10 py-2 px-4">
            <div class="row shadow-lg custom-rounded bg-white py-4 px-4">
                <div class="row d-flex justify-content-between mt-2 mb-4">
                    <h3 class="w-auto my-auto fw-bold border-bottom pb-1">Kupovina #{{$order->id}} | {{$order->totalAmount}}rsd</h3>
                </div>
                <div class="table-responsive table-responsive-sm table-responsive-md table-responsive-lg table-responsive-xl">
                    <table class="table table-borderless">
                        <thead>
                            <tr>
                                <th></th>
                                <th>Naziv</th>
                                <th>Cena</th>
                                <th>Kategorija i potkategorija</th>
                                <th>Količina</th>
                                <th>Ukupno (rsd)</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($order->toys as $toy)
                            <tr>
                                <td class="mx-auto"><img
                                        src="{{asset('/storage/images/'.$toy->toy->image)}}"
                                        width="100" class="custom-rounded" alt="..."></td>
                                <td class="me-auto py-4"><span class="fw-bold">{{$toy->toy->name}}</span></td>
                                <td class="me-auto py-4"><span class="fw-bold">{{$toy->toy->price}}</span></td>
                                <td class="me-auto py-4"><span class="fw-bold">{{$toy->toy->subcategory->category->name}} </span><i class="fas fa-chevron-right   fa-sm mx-1 "></i><span
                                        class="fw-bold text-muted">{{$toy->toy->subcategory->name}}</span></td>
                                <td class="me-auto py-4">
                                    <span class="fw-bold">{{$toy->quantity}}</span>
                                </td>
                                <td class="me-auto py-4">
                                    <span class="fw-bold">{{$toy->total_amount}}</span>
                                </td>
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
