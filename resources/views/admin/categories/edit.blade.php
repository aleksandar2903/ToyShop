@extends('layouts.layout')
@section('content')
<div class="row py-4">
    <div class="row d-flex justify-content-center m-0">
        <div class="col-md-10 py-2 px-lg-5">
            <div class="row shadow-lg custom-rounded bg-white py-4 px-4">
                <h3 class="my-4"><span class="border-bottom pb-1 fw-bold">Izmeni kategoriju</span> </h3>
                <form class="px-lg-5" enctype="multipart/form-data" action="{{route('admin.categories.update',$category)}}"
                    method="post">
                    @csrf
                    @method('put')
                    <div class="form-group mt-2">
                        <label for="name" class="form-label">Naziv</label>
                        <input type="text" class="form-control @error('name')
                    is-invalid
                @enderror" id="name" name="name" placeholder="Lego® igracke" value="{{old('name',$category->name)}}">
                        @error('name')
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
