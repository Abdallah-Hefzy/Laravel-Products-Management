@extends('layouts.parent')

@section('title', 'Edit Product')


@section('content')

    <div class="col-12">
        <form action="{{ route('products.update', $product->slug) }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('put')
            @include('backend.products._form', [
                'button' => 'Update',
            ])

        </form>
    </div>
@endsection
