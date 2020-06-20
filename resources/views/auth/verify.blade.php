@extends('layouts.main')

@section('content')
<div class="bg_color_2">
   <div class="container margin_60_35">
        <div class="col-md-8 offset-md-2">
            <div class="card">
                <div class="card-header"><strong>{{ __('Verify Your Email Address') }}</strong></div>

                <div class="card-body py-2">
                    @if (session('resent'))
                        <div class="alert alert-success" role="alert">
                            {{ __('A fresh verification link has been sent to your email address.') }}
                        </div>
                    @endif

                    {{ __('Before proceeding, please check your email for a verification link.') }}
                    {{ __('If you did not receive the email') }}, <a href="{{ route('verification.resend') }}"><strong>{{ __('click here to request another') }}</strong></a>.
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
