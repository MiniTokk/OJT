@extends('auth.layout')
@section('title')
Register
@endsection
@section('content')
<div class="row justify-content-center">
    <div class="col-md-4">
        <div class="card">
            <h3 class="card-header text-center">Register User</h3>
            <div class="card-body">
                <form action="{{ route('register.custom') }}" method="POST">
                    @csrf
                    <div class="form-group mb-3">
                        <input type="text" name="name" class="form-control" placeholder="Enter Name">
                        @error('name')
                        <div class="text-danger mt-1 mb-1">*{{ $message }}*</div>
                        @enderror

                    </div>
                    <div class="form-group mb-3">
                        <input type="text" placeholder="Email" id="email_address" class="form-control" name="email">
                        @error('email')
                        <div class="text-danger mt-1 mb-1">*{{ $message }}*</div>
                        @enderror
                    </div>
                    <div class="form-group mb-3">
                        <input type="password" placeholder="Password" id="password" class="form-control" name="password">
                        @error('password')
                        <div class="text-danger mt-1 mb-1">*{{ $message }}*</div>
                        @enderror
                    </div>
                    <div class="d-grid mx-auto">
                        <button type="submit" class="btn btn-dark btn-block">Sign up</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
