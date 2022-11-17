@extends('layouts.layout')
@section('content')
<div class="row">
    <div class="row d-flex justify-content-center m-0">
        <div class="col-md-10 py-2 px-lg-5">
            <div class="row shadow-lg custom-rounded bg-white py-4 px-4">
                <h3 class="my-4"><span class="border-bottom pb-1 fw-bold">Nova igracka</span> </h3>
                <form class="px-lg-5" enctype="multipart/form-data" action="{{route('admin.toys.store')}}"
                    method="post">
                    @csrf
                    <div class="form-group mt-2">
                        <label for="name" class="form-label">Naziv</label>
                        <input type="text" class="form-control @error('name')
                    is-invalid
                @enderror" id="name" name="name" placeholder="Bugatti Chiron" value="{{old('name')}}">
                        @error('name')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="form-group mt-2">
                        <label for="name" class="form-label">Kategorija i potkategorija</label>
                        <select name="subcategory_id" class="form-select @error('subcategory_id')
                        is-invalid
                    @enderror" required>
                            @foreach ($subcategories as $subcategory)
                            @if($subcategory['id'] == old('subcategory_id'))
                            <option value="{{$subcategory['id']}}" selected>{{$subcategory->category->name}} &rsaquo;
                                {{$subcategory['name']}}</option>
                            @else
                            <option value="{{$subcategory['id']}}">{{$subcategory->category->name}} &rsaquo;
                                {{$subcategory['name']}}</option>
                            @endif
                            @endforeach
                        </select>
                        @error('subcategory_id')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="form-group mt-2">
                        <label for="description" class="form-label">Opis</label>
                        <textarea class="form-control @error('description')
                    is-invalid
                @enderror" id="description" rows="4" name="description"
                            placeholder="Slavi inovativnu tehnologiju i dizajn jednog od najprestižnijih proizvođača automobila na svetu uz ovaj veličanstveni LEGO® Technic™ 42083 Bugatti Chiron model.">{{old('description')}}</textarea>
                        @error('description')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="form-group mt-2">
                        <label for="specifications" class="form-label">Specifikacije</label>
                        <textarea class="form-control @error('specifications')
                    is-invalid
                @enderror" id="specifications" rows="4" name="specifications"
                            placeholder="Slavi inovativnu tehnologiju i dizajn jednog od najprestižnijih proizvođača
                            automobila na svetu uz ovaj veličanstveni LEGO® Technic™ 42083 Bugatti Chiron model.">{{old('specifications')}}</textarea>
                        @error('specifications')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="row">
                        <div class="col-12 col-md-6">
                            <div class="form-group @error('image') is-inavalid
                            @enderror">
                                <label class="form-label" for="image">Slika</label>
                                <input type="file" name="image" id="image" class="form-control @error('image') is-inavalid
                                @enderror" required>
                                @error('image')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <label for="price" class="form-label">Cena</label>
                            <input type="number" class="form-control @error('price')
                    is-invalid
                @enderror" id="price" name="price" value="{{old('price', 1)}}" min="1">
                            @error('price')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group mt-2">
                        <label for="name" class="form-label">Dodatno</label>
                        <input name="extra" value="{{old('extra')}}" class="form-control @error('extra')
                        is-invalid
                        @enderror">
                        @error('extra')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="form-check my-2">
                        <label class="form-check-label">
                            <input type="checkbox" class="form-check-input" name="for_sale" id="for_sale" value="1"
                                checked>
                            Prikazi
                        </label>
                    </div>
                    <button type="submit"
                        class="btn text-light w-auto fw-bold custom-border mt-2 btn-primary">Sacuvaj</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
