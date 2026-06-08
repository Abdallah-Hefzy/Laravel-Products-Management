@extends('layouts.parent')

@section('title', 'Create Product')


@section('content')

    <div class="col-12">

        <form action="{{ route('products.store') }}" method="post" enctype="multipart/form-data">
            @csrf
            @include('backend.products._form', [
                'button' => 'Save',
            ])

        </form>
    </div>
@endsection
