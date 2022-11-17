@extends('layouts.layout')
@section('content')
<div class="row py-2">
    <div class="col-12 col-md-6 py-2 col-xl-3 px-4">
        <div class="row shadow-lg rounded-pill bg-white py-4">
            <div class="my-auto d-flex px-4"><span class="p-2 bg-success rounded-circle"><svg width="30"
                        class="rounded-circle my-auto" fill="none" stroke="white" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path>
                    </svg></span>
                <div class="my-auto ms-4 float-right">
                    <h5 class="mb-0 fw-bold">Ukupno prodaja</h5> <span class="fw-bold text-muted">{{$totalSales}}</span>
                </div>
            </div>

        </div>
    </div>
    <div class="col-12 col-md-6 py-2 col-xl-3 px-4">
        <div class="row shadow-lg rounded-pill bg-white py-4">
            <div class="my-auto d-flex px-4"><span class="p-2 bg-orange rounded-circle"><svg width="30"
                        class="rounded-circle my-auto" fill="none" stroke="white" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path>
                    </svg></span>
                <div class="my-auto ms-4 float-right">
                    <h5 class="mb-0 fw-bold">Prihod(rsd)</h5> <span class="fw-bold text-muted">{{$totalAmount}}</span>
                </div>
            </div>

        </div>
    </div>
    <div class="col-12 col-md-6 py-2 col-xl-3 px-4">
        <div class="row shadow-lg rounded-pill bg-white py-4">
            <div class="my-auto d-flex px-4"><span class="p-2 bg-primary rounded-circle"><svg width="30"
                        class="rounded-circle my-auto" fill="none" stroke="white" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path>
                    </svg></span>
                <div class="my-auto ms-4 float-right">
                    <h5 class="mb-0 fw-bold">Ukupno igracaka</h5> <span class="fw-bold text-muted">{{$totalToys}}</span>
                </div>
            </div>

        </div>
    </div>
    <div class="col-12 col-md-6 py-2 col-xl-3 px-4">
        <div class="row shadow-lg rounded-pill bg-white py-4">
            <div class="my-auto d-flex px-4"><span class="p-2 bg-danger rounded-circle"><svg width="30"
                        class="rounded-circle my-auto" fill="none" stroke="white" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path>
                    </svg></span>
                <div class="my-auto ms-4 float-right">
                    <h5 class="mb-0 fw-bold">Ukupno kupaca</h5> <span class="fw-bold text-muted">{{$totalCustomers}}</span>
                </div>
            </div>

        </div>
    </div>
</div>
<div class="row">
    <div class="col-12 col-lg-6 rounded-pill py-5 px-4">
        <div class="col-12 pb-4 shadow-lg custom-rounded">
            <div class="row py-4">
                <p class="fs-4 fw-bold px-5 pb-0 mb-0">Najnovije igracke</p>
                <p class="fs-6 fw-bold text-muted px-5">Poslednje dodato: {{$recentlyAdded->first()->created_at->format('d-M-Y H:i')}}</p>
            </div>
            @foreach ($recentlyAdded as $toy)
            <div class="row mb-2 px-4">
                <div class="col-4">
                    <img src="{{asset('/storage/images/'.$toy->image)}}"
                        width="100" class="custom-rounded" alt="...">
                </div>
                <div class="col-4">
                    <p class="my-auto">
                        <p class="fw-bold mb-0 pb-0">{{$toy->name}}</p>
                        <p class="text-muted fw-bold">{{$toy->subcategory->name}}</p>
                    </p>
                </div>
                <div class="col-4 text-end">{{$toy->price}}rsd</div>
            </div>
            @endforeach
        </div>
    </div>
    <div class="col-12 col-lg-6 py-5 px-4">
        <div class="col-12 pb-4 shadow-lg custom-rounded">
            <div class="row py-4">
                <p class="fs-4 fw-bold px-5 pb-0 mb-0">Najprodavanije igracke</p>
                <p class="fs-6 fw-bold text-muted px-5">{{$bestsellers->sum('solds_count')}} prodaja</p>
            </div>
            @foreach ($bestsellers as $toy)
            <div class="row mb-2 px-4">
                <div class="col-4">
                    <img src="{{asset('/storage/images/'.$toy->image)}}"
                        width="100" class="custom-rounded" alt="...">
                </div>
                <div class="col-4">
                    <p class="my-auto">
                        <p class="fw-bold mb-0 pb-0">{{$toy->name}}</p>
                        <p class="text-muted fw-bold">{{$toy->subcategory->name}}</p>
                    </p>
                </div>
                <div class="col-4 text-end">{{$toy->solds_count}} prodaja</div>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
