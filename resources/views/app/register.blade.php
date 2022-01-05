@extends('template')
@section('view')
<div class="col-8 m-auto">
    @if(session()->has('success'))
    <div class="alert alert-success" role="alert">
        <i class="mdi mdi-check-all mr-2"></i> {{ session('success') }}
    </div>
    @endif
    @if(session()->has('registerError'))
    <div class="alert alert-danger" role="alert">
        <i class="mdi mdi-check-all mr-2"></i> {{ session('registerError') }}
    </div>
    @endif
    <div class="card">
        <div class="card-header">
            <i class="fas fa-user-plus-alt"></i> Register
        </div>
        <form method="POST" action="/register">
            <div class="card-body">
                @csrf
                <div class="form-group mb-3">
                    <label class="floating-label" for="email">Nama</label>
                    <input class="form-control @error('name') is-invalid @enderror" type="text" id="name" name="name" required="" placeholder="Enter your name" value="{{ old('name') }}">
                    @error('name')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="form-group mb-3">
                    <label class="floating-label" for="email">Email address</label>
                    <input class="form-control @error('email') is-invalid @enderror" type="email" id="email" name="email" required="" placeholder="Enter your email" value="{{ old('name') }}">
                    @error('email')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="form-group mb-3">
                    <label class="floating-label" for="password">Password</label>
                    <input class="form-control @error('password') is-invalid @enderror" type="password" required="" name="password" id="password" placeholder="Enter your password">
                    @error('password')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
            </div>
            <div class="card-footer">
                <button class="btn btn-success btn-block" type="submit"> Register </button>
            </div>
        </form>
    </div>
    <p class="text-center">Have Account ? <a href="{{url('app/login')}}">Login Now</a></p>
</div>
@endsection