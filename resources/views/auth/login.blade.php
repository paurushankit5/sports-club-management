@extends('front.layouts.main')




@section('title')
Login
@endsection

@section('extra_after_css')

@endsection

@section('main')

<div class="page-wrapers">
    <!-- Content -->
    <div class="page-content dez-login p-t50 overlay-black-dark bg-img-fix nav" style="background-image:url(front/jpg/bg3.jpg);">
        <div class="login-form relative z-index3 ">
            <div class="tab-content">
                <div id="login" class="tab-pane active text-center">
                    <form class="p-a30 dez-form  m-t100 signup-margin-top" method="POST" action="{{ route('login') }}">
                        @csrf
                        <h3 class="form-title m-t0">Sign In</h3>
                        <div class="dez-separator-outer m-b5">
                            <div class="dez-separator bg-primary style-liner"></div>
                        </div>
                        <p>Enter your e-mail address and your password. </p>
                        <div class="form-group">

                              <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}"  autofocus placeholder="Enter Email ID">

                                @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                        </div>
                        <div class="form-group">

                                                       

 <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password"  placeholder="Type your Secret Password">

                                @if ($errors->has('password'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif                        </div>
                        <div class="form-group text-left">
                            <button class="site-button login-switch" type="submit">login</button>
                            <label>
                            <input id="check1" type="checkbox">
                            <label for="check1">Remember me</label>
                            </label>
                           <!--  <a data-toggle="tab" href="#forgot-password" class="m-l15"><i class="fa fa-unlock-alt"></i> Forgot Password</a>-->
                            </div> 
                            @if (Route::has('password.request'))
                                    <a class="m-l15" href="{{ route('password.request') }}">
                                    <i class="fa fa-unlock-alt"></i>    {{ __('Forgot Password ') }}
                                    </a>
                                @endif
                    </form>
                    <a href="{{route('register')}}" class="text-white"> <div class="bg-primary p-a15 ">Create an account </div>
                    </a>
                </div>
               
                
            </div>
        </div>
    </div>
    <!-- Content END-->
</div>


@endsection
