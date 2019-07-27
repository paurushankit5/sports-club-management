
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
                             
                         <form class="p-a30 dez-form text-center signup-margin-top" method="POST" action="{{ route('register') }}">
                        @csrf
                        <h3 class="form-title m-t0">Sign Up</h3>
                        <div class="dez-separator-outer m-b5">
                            <div class="dez-separator bg-primary style-liner"></div>
                        </div>
                        <p>Enter your personal details below: </p>
                  
                        <div class="form-group">
                             <input id="fname" type="text" class="form-control{{ $errors->has('fname') ? ' is-invalid' : '' }}" name="fname" value="{{ old('fname') }}" required autofocus placeholder="first Name">

                                @if ($errors->has('fname'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('fname') }}</strong>
                                    </span>
                                @endif
                        </div>
                        <div class="form-group">
                             <input id="lname" type="text" class="form-control{{ $errors->has('lname') ? ' is-invalid' : '' }}" name="lname" value="{{ old('lname') }}" required autofocus placeholder="Last Name">

                                @if ($errors->has('lname'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('lname') }}</strong>
                                    </span>
                                @endif
                        </div>
                         <div class="form-group">
                               <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required placeholder="Email Id">

                                @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                        </div>
                        <div class="form-group">
                                <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required placeholder="Type your secret password">

                                @if ($errors->has('password'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                        </div>
                        
                        <div class="form-group">
                          <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required placeholder="Re-type your password">
                        </div>
                        <label class="m-b30">
                        <input type="checkbox"/>
                        <label>I agree to the <a href="#">Terms of Service </a>& <a href="#">Privacy Policy </label>
                        </label>
                        <div class="form-group text-left "> <a class="site-button outline gray" data-toggle="tab" href="#login">Back</a>
                            <button class="site-button pull-right" type="submit">Submit</button>
                        </div>
                    </form>
                </div>
                <div id="developement-1" class="tab-pane fade">
   
                </div>
            </div>
        </div>
    </div>
    <!-- Content END-->
</div>


@endsection

