@extends('layouts.app')
@section('content')
<div class="container mt-5 px-4">
    <div class="row gx-4 gx-lg-5">
        <div class="col-lg-8"><img class="card-img-top w-100 mb-5 mb-md-0"
                src="{{asset('/storage/images/'.$toy->image)}}"
                alt="..."></div>
        <div class="col-lg-4 shadow-lg pb-5">
            <div class="small mt-5 mb-3"><span class="bg-warning px-2 py-1">{{$toy->extra}}</span></div>
            <h2 class="fs-2">{{$toy->name}}</h2>
            <div class="my-4">
                <strong class="fs-3 fw-bold">{{$toy->price}}rsd</strong>
            </div>
            <p style="white-space: pre-wrap;" class="mb-4">{{$toy->description}}</p>
            <div class="row mt-5">
                <div class="col-9">
                    <form action="{{route('carts.store')}}" method="post">
                        @csrf
                        <input type="hidden" name="toy_id" value="{{$toy->id}}">
                        <input type="hidden" name="quantity" value="1">
                        <input type="hidden" name="totalAmount" value="{{$toy->price}}">
                        <input type="hidden" name="orderNow" value="1">
                        <button type="submit" class="btn btn-warning py-3 my-auto fw-bold rounded-pill w-100">Poruci odmah</button>
                    </form>

                </div>
                <div class="col-3">
                    @if (auth()->check() && auth()->user()->cart->contains('toy_id',$toy->id))
                                <span class="d-flex w-100 h-100" tabindex="0" data-bs-toggle="tooltip"
                                    data-bs-placement="right" title="U korpi">
                                    <button type="button"
                                        class="btn btn-warning text-dark rounded-pill custom-border"
                                        disabled><svg width="30" class="my-auto mx-auto" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M5 13l4 4L19 7"></path>
                                        </svg></button>
                                </span>
                                @else
                                <form class="h-100 w-100 d-flex" action="{{route('carts.store')}}" method="post">
                                    @csrf
                                    <input type="hidden" name="toy_id" value="{{$toy->id}}">
                                        <input type="hidden" name="quantity" value="1">
                                        <input type="hidden" name="totalAmount" value="{{$toy->price}}">
                                        <input type="hidden" name="orderNow" value="0">
                                    <button
                                    class="btn btn-outline-warning text-dark rounded-pill custom-border"><svg width="30"
                                    class="my-auto mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                                </svg></button>
                                </form>
                                @endif
                </div>
            </div>
        </div>
        <div class="col-12">

            <div class="px-4 my-5">
                @if ($toy->specifications)
                <p class="fs-4 "><span class="text-uppercase fw-bold custom-border-bottom">Specifikacije</span></p>
                <p class="1h-sm border-bottom pb-4" style="white-space: pre-wrap;">{!!$toy->specifications!!}</p>
                @endif
            </div>
            <h2 class="py-2">Preporucujemo za Vas</h2>

            <div style="align-items: stretch;
            display: flex;
            flex-direction: row;
            flex-wrap: nowrap;
            overflow-x: auto;
            overflow-y: hidden;" class="custom-scroll-x pb-4 mb-5 row">
                @foreach ($relatedToys as $relatedToy)
                @if ($relatedToy->id != $toy->id)
                <div class="card mx-2" style="width: 19rem;">
                    <div style="height: 18rem;" class="d-flex">
                        <img src="{{asset('/storage/images/'.$relatedToy->image)}}"
                        class="card-img-top my-auto" alt="...">
                    </div>
                    <div class="card-body">
                        <p class="fw-bold"><a href="{{route('toys.show',$relatedToy)}}" class="link-dark text-decoration-none">{{$relatedToy->name}}</a></p>
                        <p class="fw-bold text-danger">{{$relatedToy->price}}rsd</p>
                        <div class="row bottom-0"><div class="col-8">
                            <a href="#" class="btn btn-warning btn-sm py-2 my-auto fw-bold rounded-pill w-100">Poruci odmah</a>

                            </div>
                            <div class="col-4">
                                <a class="btn btn-outline-warning text-dark rounded-pill p-0 my-1 custom-border"><svg
                                    width="20" class="mx-2 my-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                                </svg></a>
                            </div></div>

                    </div>
                </div>
                @endif
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection
