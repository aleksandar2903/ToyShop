@extends('layouts.app')

@section('content')
<div class="position-relative">
    <img class="w-100 d-none d-lg-block" src="{{asset('/storage/images/lego.jpg')}}" alt="" srcset="">
    <img class="w-100 d-block d-lg-none" src="{{asset('/storage/images/lego1.jpg')}}" alt="" srcset="">
    <div style="top:35%; left:15%;" class="d-none d-lg-block position-absolute">
        <h1 class="fw-bold">NOVO</h1>
        <h3 class="fw-bold text-secondary">LEGO® Super Mario™</h3>
        <a href="{{route('shop',4)}}" class="btn btn-outline-orange custom-border rounded-pill fw-bold">Poruci odmah</a>
    </div>
    <div class="d-block d-lg-none text-center text-light bg-success py-5">
        <h3 class="fw-bold">NOVO</h3>
        <h4 class="fw-bold pb-2">LEGO® Super Mario™</h4>
        <a href="{{route('shop',4)}}" class="btn btn-outline-light custom-border rounded-pill fw-bold">Poruci odmah</a>
    </div>
</div>
<div class="container">
    <div class="bg-light">
        <div class="container py-5">
            <h2 class="py-2">Preporucujemo za Vas</h2>
            <div style="align-items: stretch;
            display: flex;
            flex-direction: row;
            flex-wrap: nowrap;
            overflow-x: auto;
            overflow-y: hidden;" class="custom-scroll-x pb-4 row">
                @foreach ($toys as $toy)
                <div class="card mx-2" style="width: 19rem;">
                    <div style="height: 18rem;" class="d-flex">
                        <img src="{{asset('/storage/images/'.$toy->image)}}" class="card-img-top my-auto" alt="...">
                    </div>
                    <div class="card-body">
                        <p class="fw-bold"><a href="{{route('toys.show',$toy)}}"
                                class="link-dark text-decoration-none">{{$toy->name}}</a></p>
                        <p class="fw-bold text-danger">{{$toy->price}}rsd</p>
                        <div class="row bottom-0">
                            <div class="col-8">
                                <form action="{{route('carts.store')}}" method="post">
                                    @csrf
                                    <input type="hidden" name="toy_id" value="{{$toy->id}}">
                                    <input type="hidden" name="quantity" value="1">
                                    <input type="hidden" name="totalAmount" value="{{$toy->price}}">
                                    <input type="hidden" name="orderNow" value="1">
                                    <button type="submit"
                                        class="btn btn-warning btn-sm py-2 my-auto fw-bold rounded-pill w-100">Poruci
                                        odmah</button>
                                </form>

                            </div>
                            <div class="col-4">
                                @if (auth()->check() && auth()->user()->cart->contains('toy_id',$toy->id))
                                <span class="d-inline-block" tabindex="0" data-bs-toggle="tooltip"
                                    data-bs-placement="right" title="U korpi">
                                    <button type="button"
                                        class="btn btn-warning text-dark rounded-pill p-0 my-1 custom-border"
                                        disabled><svg width="20" class="mx-2 my-1" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M5 13l4 4L19 7"></path>
                                        </svg></button>
                                </span>
                                @else
                                <form action="{{route('carts.store')}}" method="post">
                                    @csrf
                                    <input type="hidden" name="toy_id" value="{{$toy->id}}">
                                    <input type="hidden" name="quantity" value="1">
                                    <input type="hidden" name="totalAmount" value="{{$toy->price}}">
                                    <input type="hidden" name="orderNow" value="0">
                                    <button
                                        class="btn btn-outline-warning text-dark rounded-pill p-0 my-1 custom-border"><svg
                                            width="20" class="mx-2 my-1" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                                        </svg></button>
                                </form>
                                @endif
                            </div>
                        </div>

                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
    <div class="container col-xxl-8 px-4 py-5">
        <div class="row flex-lg-row-reverse align-items-center g-5 py-5">
            <div class="col-10 col-sm-8 col-lg-6">
                <img src="{{asset('/storage/images/adventure.webp')}}" class="d-block mx-lg-auto img-fluid" alt="Truck"
                    loading="lazy">
            </div>
            <div class="col-lg-6">
                <h1 class="fw-bold mb-3">LEGO Super Mario™ Lakitu Sky World Expansion Set</h1>
                <p class="lead">Bori se sa Lakituom uz pomoć ovog kompleta za proširenje koji možeš da dodaš LEGO® Super
                    Mario™ početnom nivou. Pomeri klizne oblake unazad i unapred najbrže što možeš da pokušaš da zavrtiš
                    Lakitua tako da odleti sa oblaka – ali čuvaj se Metka Bila! Porazi Fazija i skoči na Vremenski blok
                    da dobiješ dodatno vreme.</p>
                <div class="d-grid gap-2 d-md-flex justify-content-md-start">
                    <a href="{{route('toys.show',3)}}"
                        class="btn btn-outline-success btn-lg custom-border px-4 rounded-pill me-md-2">Pogledaj
                        ponudu</a>
                </div>
            </div>
        </div>
    </div>
    <div class="container py-2">
        <h2 class="py-2">U trendu</h2>
        <div style="align-items: stretch;
            display: flex;
            flex-direction: row;
            flex-wrap: nowrap;
            overflow-x: auto;
            overflow-y: hidden;" class="custom-scroll-x pb-4 mb-5 row">
            @foreach ($trends as $trend)
            <div class="card border-0 shadow mx-2" style="width: 20rem; height:24rem;">
                @if (isset($trend->toys->first()->image))
                <img height="200" src="{{asset('/storage/images/'.$trend->toys->first()->image)}}" class="card-img-top"
                    alt="...">
                @endif
                <div class="card-body text-center">
                    <p class="fw-bolder lead">{{$trend->name}}</p>
                    <p class="small">{{Str::limit($trend->description,100)}}</p>
                    <a href="{{route('shop',['subcategory'=>$trend->id])}}" class="text-decoration-none text-dark"><span
                            class="fw-bold custom-border-bottom">Poruci odmah</span> <i
                            class="fas fa-chevron-right ms-1"></i></a>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
