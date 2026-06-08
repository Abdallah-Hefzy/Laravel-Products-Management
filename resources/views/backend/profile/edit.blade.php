@extends('layouts.parent')

@section('title', 'Edit Profile')

@section('styles')

    <link rel="stylesheet" href="{{ asset('assets/css/animate.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/slick.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/chosen.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/themify-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/jquery-ui.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/meanmenu.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <style>
        .breadcrumb-item a {
            color: #007bff !important;
        }
    </style>
@endsection


@section('content')

    @if (session()->has('success'))
        <div class="alert alert-success text-center w-100">
            {{ session()->get('success') }}
        </div>
    @endif

    <div class="col-12">
        <div class="checkout-area pb-80 pt-100">
            <div class="container">
                <div class="row">
                    <div class="ml-auto mr-auto col-lg-9">
                        <div class="checkout-wrapper">
                            <div id="faq" class="panel-group">
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h5 class="panel-title"> <a data-toggle="collapse" data-parent="#faq"
                                                href="#my-account-1">Edit your account information </a></h5>
                                    </div>
                                    <div id="my-account-1" class="panel-collapse collapse show">
                                        <div class="panel-body">
                                            <div class="billing-information-wrapper">

                                                <form action="{{ route('my-profile.update-personal-details') }}"
                                                    method="post" enctype="multipart/form-data">
                                                    @csrf
                                                    @method('put')
                                                    <div class="account-info-wrapper">
                                                        <h4>Your Personal Details</h4>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-12">
                                                            <div class="row">

                                                                <div class="col-4 offset-4 mt-5">
                                                                    <img src="{{ asset('dist/img/users/' . Auth::user()->profile_photo) }}"
                                                                        id="profile_photo" alt=""
                                                                        class="rounded-circle"
                                                                        style="cursor: pointer;width: 200px; height: 200px; object-fit: cover;">
                                                                    <input type="file" name="profile_photo"
                                                                        id="file"
                                                                        class="d-none @error('profile_photo') is-invalid @enderror">
                                                                    <small class="text-danger">
                                                                        @error('profile_photo')
                                                                            {{ $message }}
                                                                        @enderror
                                                                    </small>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6 col-md-6 mt-5">
                                                            <div class="billing-info">
                                                                <label for="name">Name</label>
                                                                <input type="text"
                                                                    value="{{ old('name', Auth::user()->name) }}"
                                                                    name="name" id="name"
                                                                    class="form-control @error('name') is-invalid @enderror">
                                                                <small class="text-danger">
                                                                    @error('name')
                                                                        {{ $message }}
                                                                    @enderror
                                                                </small>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6 col-md-6 mt-5">
                                                            <div class="billing-info">
                                                                <label for="city">City</label>
                                                                <input type="text"
                                                                    value="{{ old('city', Auth::user()->city) }}"
                                                                    name="city"
                                                                    class="form-control @error('city') is-invalid @enderror">
                                                                <small class="text-danger">
                                                                    @error('city')
                                                                        {{ $message }}
                                                                    @enderror
                                                                </small>

                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6 col-md-6">
                                                            <div class="billing-info">
                                                                <label for="phone">Phone</label>
                                                                <input type="tel"
                                                                    value="{{ old('phone', Auth::user()->phone) }}"
                                                                    name="phone"
                                                                    class="form-control @error('phone') is-invalid @enderror">
                                                                <small class="text-danger">
                                                                    @error('phone')
                                                                        {{ $message }}
                                                                    @enderror
                                                                </small>

                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6 col-md-6">
                                                            <div class="billing-info">
                                                                <label for="birthday">Birthday</label>
                                                                <input type="date"
                                                                    value="{{ old('birthday', Auth::user()->birthday) }}"
                                                                    name="birthday"
                                                                    class="form-control @error('birthday') is-invalid @enderror">
                                                                <small class="text-danger">
                                                                    @error('birthday')
                                                                        {{ $message }}
                                                                    @enderror
                                                                </small>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6 col-md-6">
                                                            <div class="billing-info">
                                                                <label for="gender">Gender</label>

                                                                <select name="gender"
                                                                    class="form-control @error('gender') is-invalid @enderror">
                                                                    <option
                                                                        {{ old('gender', Auth::user()->gender) == 'male' ? 'selected' : '' }}
                                                                        value="male">Male</option>
                                                                    <option
                                                                        {{ old('gender', Auth::user()->gender) == 'female' ? 'selected' : '' }}
                                                                        value="female">Female</option>
                                                                </select>
                                                                <small class="text-danger">
                                                                    @error('gender')
                                                                        {{ $message }}
                                                                    @enderror
                                                                </small>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-6 offset-6">
                                                        <button type="submit"
                                                            class="btn  btn-outline-info btn-block">Update</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h5 class="panel-title"> <a data-toggle="collapse" data-parent="#faq"
                                                href="#my-account-2">Change your password </a></h5>
                                    </div>
                                    <div id="my-account-2" class="panel-collapse collapse">
                                        <div class="panel-body">
                                            <div class="billing-information-wrapper">
                                                <form action="{{ route('my-profile.update-Password') }}" method="post">
                                                    @csrf
                                                    @method('put')
                                                    <div class="row">
                                                        <div class="col-lg-12 col-md-12">
                                                            <div class="billing-info">
                                                                <label for="current_password">Current Password</label>
                                                                <input type="password" name="current_password"
                                                                    id="current_password"
                                                                    class="form-control @error('current_password') is-invalid @enderror">
                                                                <small class="text-danger">
                                                                    @error('current_password')
                                                                        {{ $message }}
                                                                    @enderror
                                                                </small>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-12 col-md-12">
                                                            <div class="billing-info">
                                                                <label for="password">New Password</label>
                                                                <input type="password" name="password" id="password"
                                                                    class="form-control @error('password') is-invalid @enderror">
                                                                <small class="text-danger">
                                                                    @error('password')
                                                                        {{ $message }}
                                                                    @enderror
                                                                </small>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-12 col-md-12">
                                                            <div class="billing-info">
                                                                <label for="password_confirmation">Password
                                                                    Confirmation</label>
                                                                <input type="password" name="password_confirmation"
                                                                    id="password_confirmation"
                                                                    class="form-control @error('password_confirmation') is-invalid @enderror">
                                                                <small class="text-danger">
                                                                    @error('password_confirmation')
                                                                        {{ $message }}
                                                                    @enderror
                                                                </small>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-6 offset-3">
                                                        <button type="submit"
                                                            class="btn  btn-outline-success btn-block">Update</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('scripts')
    <script>
        $('#profile_photo').on('click', function() {
            $('#file').click()
        });
    </script>
@endsection
