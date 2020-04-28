@extends('layouts.main')

@section('content')
<div class="bg_color_2">
            <div class="container margin_60_35">
                <div id="register">
                    <h1>Please Register!</h1>
                    <div class="row justify-content-center">
                        <div class="col-md-5">

                            <a id="fbButton" href="{{route('redirect','facebook')}}?redirect={{request()->query('redirect')}}&referal={{request()->query('referal')}}" style="outline: none;border: none;width: 100%"  class="social_bt facebook">Signup with Facebook</a>
                            <a id="fbButton" href="{{route('redirect','google')}}?redirect={{request()->query('redirect')}}&referal={{request()->query('referal')}}" style="outline: none;border: none;width: 100%"  class="social_bt google">Signup with Google</a>
                            <a id="fbButton" href="{{route('redirect','linkedin')}}?redirect={{request()->query('redirect')}}&referal={{request()->query('referal')}}" style="outline: none;border: none;width: 100%"  class="social_bt linkedin">Signup with Linkedin</a>
                            @include('partials.error')

                            <form action="{{ route('register') }}" method="POST">
                                @csrf

                                <div class="box_form">
                                    <div class="form-group has-error">
                                        <label>{{ __('Name') }}</label>
                                        <input type="text" value="{{ old('name') }}" required name="name" class="form-control" placeholder="Your full name">
                                         @error('name')
                                            <span class="help-block" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <input type="hidden" name="redirect" value="{{request()->query('redirect')}}">
                                   
                                    <div class="form-group has-error">
                                        <label for="email">Email</label>
                                        <input type="email" required id="email" name="email" value="{{ old('email') }}" class="form-control" placeholder="Your email address">
                                         @error('name')
                                            <span class="help-block" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                     <div class="form-group has-error">
                                        <label for="type">Register Type</label>
                                        <select name="type" id="type" class="form-control">
                                            <option value="1">Patient</option>
                                            <option value="2">Doctor</option>
                                            <option value="3">Pharmacist Partner</option>
                                            <option value="4">Diagnostic Partner</option>
                                            <option value="5">Freelancer</option>
                                        </select>
                                         @error('type')
                                            <span class="help-block" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group has-error">
                                        <label for="password">{{ __('Password') }}</label>
                                        <input type="password" class="form-control" name="password" id="password" placeholder="Your password">
                                         @error('password')
                                            <span class="help-block" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group has-error">
                                        <label>{{ __('Confirm Password') }}</label>
                                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" placeholder="Confirm Password" required autocomplete="new-password">
                                    </div>
                                    <div class="form-group has-error">
                                        <label for="referal">Referal Email (optional)</label>
                                        <input type="email" value="{{ request()->query('referal') }}" class="form-control" name="referal" id="referal" placeholder="Referal Email">
                                        
                                        @error('referal')
                                            <span class="help-block" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div id="pass-info" class="clearfix"></div>
                                    <div class="checkbox-holder text-left">
                                        <div class="checkbox_2">
                                            <input type="checkbox" checked value="accept_2" id="check_2" name="check_2" >
                                            <label for="check_2"><span>I Agree to the <strong> <a href="terms-condition"> Terms &amp; Conditions</a></strong></span></label>
                                        </div>
                                        <p><small>By clicking register you agree to our terms and conditions.</small></p>
                                    </div>
                                    <div class="form-group text-center add_top_30">
                                        <button type="submit" class="btn_1">{{ __('Register') }}</button>
                                    </div>
                                </div>
                                <!-- <p class="text-center"><small>Has voluptua vivendum accusamus cu. Ut per assueverit temporibus dissentiet. Eum no atqui putant democritum, velit nusquam sententiae vis no.</small></p> -->
                            </form>
                            <p class="text-center link_bright">Already have an account? <a href="{{route('login')}}"><strong class="text-danger">Login now!</strong></a></p>
                        </div>
                    </div>
                    <!-- /row -->
                </div>
                <!-- /register -->
            </div>
        </div>
@endsection
