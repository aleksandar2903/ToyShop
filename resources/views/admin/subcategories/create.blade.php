@extends('layouts.layout')
@section('content')
<div class="row py-4">
    <div class="row d-flex justify-content-center m-0">
        <div class="col-md-10 py-2 px-lg-5">
            <div class="row shadow-lg custom-rounded bg-white py-4 px-4">
                <h3 class="my-4"><span class="border-bottom pb-1 fw-bold">Nova potkategorija</span> </h3>
                <form class="px-lg-5" action="{{route('admin.subcategories.store')}}"
                    method="post">
                    @csrf
                    <div class="form-group mt-2">
                        <label for="name" class="form-label">Naziv</label>
                        <input type="text" class="form-control @error('name')
                    is-invalid
                @enderror" id="name" name="name" placeholder="LEGO® Art" value="{{old('name')}}">
                        @error('name')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="form-group mt-2">
                        <label for="name" class="form-label">Izaberi kategoriju</label>
                        <select name="category_id" class="form-select @error('category_id')
                        is-invalid
                    @enderror" required>
                            @foreach ($categories as $category)
                            @if($category->id == old('category_id'))
                            <option value="{{$category->id}}" selected>{{$category->name}}</option>
                            @else
                            <option value="{{$category->id}}">{{$category->name}}</option>
                            @endif
                            @endforeach
                        </select>
                        @error('category_id')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="form-group mt-2">
                        <label for="description" class="form-label">Opis</label>
                        <textarea class="form-control @error('description')
                    is-invalid
                @enderror" id="description" rows="4" name="description"
                            placeholder="LEGO® Art setovi nude odraslim graditeljima bekstvo iz svakodnevnog života jer pružaju posebno LEGO® iskustvo gradnje...">{{old('description')}}</textarea>
                        @error('description')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                    <button type="submit"
                        class="btn text-light w-auto fw-bold custom-border mt-2 btn-primary">Sacuvaj</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
