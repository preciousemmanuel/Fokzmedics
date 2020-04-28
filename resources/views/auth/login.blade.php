@extends('layouts.main')

@section('content')
<div class="bg_color_2">
    <div class="container margin_60_35">
        <div id="login-2">
            <h1>Please {{ __('Login') }}</h1>
            
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="box_form clearfix">
                            
                        <div class="box_login">
                                <a href="{{route('redirect','facebook')}}?redirect={{request()->query('redirect')}}&referal={{request()->query('referal')}}" class="social_bt facebook">Login with Facebook</a>
                                <a href="{{route('redirect','google')}}?redirect={{request()->query('redirect')}}&referal={{request()->query('referal')}}" class="social_bt google">Login with Google</a>
                                <a href="{{route('redirect','linkedin')}}?redirect={{request()->query('redirect')}}&referal={{request()->query('referal')}}" class="social_bt linkedin">Login with Linkedin</a>
                            </div>
                        <div class="box_login last">
                        <div class="form-group">
                            <label for="email" class="col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                                <input type="hidden" name="redirect" value="{{request()->query('redirect')}}">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            
                        </div>

                        <div class="form-group">
                            <label for="password" class="col-form-label text-md-right">{{ __('Password') }}</label>

                            
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            
                                @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        <small>{{ __('Forgot Your Password?') }}</small>
                                    </a>
                                @endif
                        </div>

                        

                        <div class="form-group">
                                    <input class="btn_1" type="submit" value="Login">
                                </div>
                                @if(request()->query('redirect'))
                        <p><a href="{{route('register')}}?redirect={{request()->query('redirect')}}">Dont have an account? Register</a></p>
                        @else
                        <p><a href="{{route('register')}}">Dont have an account? Register</a></p>
                        @endif
                    </div>
                    </div>
                    </form>
                
            
        </div>
    </div>
</div>
@endsection
