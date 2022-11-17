@extends('layouts.layout')
@section('content')
<div class="row py-4">
    <div class="row d-flex justify-content-center m-0">
        <div class="col-md-10 py-2 px-4">
            <div class="row shadow-lg custom-rounded bg-white py-4 px-4">
                <div class="row d-flex justify-content-between mt-2 mb-4">
                    <h3 class="w-auto my-auto fw-bold border-bottom pb-1">Kategorije</h3>
                    <a href="{{route('admin.categories.create')}}" class="btn w-auto fw-bold custom-border btn-outline-primary">Nova kategorija</a>
                </div>
                <div class="table-responsive table-responsive-sm table-responsive-md table-responsive-lg table-responsive-xl">
                    <table class="table table-borderless">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Naziv</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($categories as $category)
                            <tr>
                                <td class="mx-auto py-4">{{$category->id}}</td>
                                <td class="me-auto py-4"><span class="fw-bold">{{$category->name}}</span></td>
                                <td class="me-auto py-4 d-flex"><a href="{{route('admin.categories.edit',$category)}}"
                                        class="py-0 fw-bold btn-sm text-decoration-none btn btn-link text-decoration-none pe-2 border-end">Izmeni</a>
                                    <form action="{{route('admin.categories.destroy',$category)}}" method="post">
                                        @csrf
                                        @method('delete')
                                        <button type="submit"
                                            class="py-0 fw-bold btn-sm text-decoration-none text-danger btn btn-link text-decoration-none">Izbrisi</button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                            <tr>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
