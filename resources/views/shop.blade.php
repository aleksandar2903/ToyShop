@extends('layouts.app')
@section('content')
<div class="container mt-5 px-4">
    <div style="background-color: #f1f1f1" class="row my-4 px-4 rounded">
        <p class="lead fw-bold mt-4">{{isset($toys->name) ? $toys->name : "Sve igracke"}}</p>
        <p class="small mb-4">{{isset($toys->description) ? $toys->description : "U asortimanu ToyShop prodavnica nalazi se veliki broj igračaka različitih brendova,
            kako za dečake, tako i za devojčice: LEGO®, NERF, Play-Doh, Frozen, LOL, Little Tikes, Revell, Burago...
            Očekuje vas najveći izbor kreativnih, popularnih i edukativnih igara na jednom mestu: od plišanih igračaka i
            prvih igračkica za bebe, preko minijaturnih kuhinja i svih vrsta najlepših lutaka za vaše princeze, akcionih
            figura, metalnih autića i velikih radionica sa alatom, do maketa automobila, aviona i brodova, kao i
            konstruktora za vaše male arhitekte i kreativce. "}}</p>
    </div>

    <div class="row">
        <div class="col-12 col-lg-3 d-none d-lg-block rounded">
            <div class="row py-3 fw-bold text-center bg-warning"><span>Kategorije</span></div>
            <div class="row bg-white py-4">
                <ul class="list-unstyled">
                    @foreach ($categories as $category)
                    <li>
                        <button class="btn btn-link d-flex text-dark text-decoration-none mb-2 w-100" type="button"
                            data-bs-toggle="collapse" data-bs-target="#collapse{{$category->id}}" aria-expanded="false"
                            aria-controls="collapse{{$category->id}}">
                            <span class="fw-bold">{{$category->name}} </span><span class="ms-auto"><i
                                    class="fas fa-chevron-down ms-auto"></i></span>
                        </button>
                        <div class="collapse" id="collapse{{$category->id}}">
                            <div class="card card-body">
                                @foreach ($category->subcategories as $subcategory)
                                <a href="{{route('shop',$subcategory->id)}}" class="text-muted fw-bold text-decoration-none">{{$subcategory->name}}</a>
                                @endforeach
                            </div>
                        </div>
                    </li>
                    @endforeach
                </ul>
            </div>
        </div>
        <div class="col-12 col-lg-9">
            @if(isset($search))
            <div class="row mb-2">
                <span>Prikaz <span class="fw-bold">{{$toys->count()}}</span> rezultata za "{{$search}}"</span>
            </div>
            @endif
            <div class="row">
                @foreach (isset($toys->toys) ? $toys->toys : $toys as $toy)
                <div class="col-12 col-sm-6 col-lg-4 pb-4 px-2">
                    <div class="card w-100">
                        <img src="{{asset('/storage/images/'.$toy->image)}}"
                           height="170" class="card-img-top" alt="...">
                        <div class="card-body">
                            <div class="small mt-2 mb-3"><span class="bg-warning px-2 py-1">{{$toy->extra}}</span></div>
                            <p class="fw-bold"><a class="text-decoration-none text-dark" href="{{route('toys.show',$toy)}}">{{$toy->name}}</a></p>
                            <p class="fw-bold text-danger">{{$toy->price}}rsd</p>
                            <div class="row">
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
                </div>
                @endforeach
            </div>
            {!! isset($toys->toys) ? $toys->toys->links() : $toys->links() !!}
        </div>
    </div>
</div>
@endsection
