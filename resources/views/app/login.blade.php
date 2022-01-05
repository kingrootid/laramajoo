@extends('template')
@section('view')
<div class="col-8 m-auto">
    @if(session()->has('success'))
    <div class="alert alert-success" role="alert">
        <i class="mdi mdi-check-all mr-2"></i> {{ session('success') }}
    </div>
    @endif
    @if(session()->has('loginError'))
    <div class="alert alert-danger" role="alert">
        <i class="mdi mdi-check-all mr-2"></i> {{ session('loginError') }}
    </div>
    @endif
    <div class="card">
        <div class="card-header">
            <i class="fas fa-sign-in-alt"></i> Login
        </div>
        <form method="POST" action="/login">
            <div class="card-body">
                @csrf
                <div class="form-group mb-3">
                    <label class="floating-label" for="Email">Email address</label>
                    <input class="form-control @error('email') is-invalid @enderror" type="email" id="email" name="email" required="" placeholder="Enter your email">
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
                <button class="btn btn-info btn-block" type="submit"> Log In </button>
            </div>
        </form>
    </div>
    <p class="text-center">Don't Have Account ? <a href="{{url('app/register')}}">Register Now</a></p>
</div>
@endsection