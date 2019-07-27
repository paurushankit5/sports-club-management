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
                            
                             @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                         <form class="p-a30 dez-form text-center signup-margin-top" method="POST" action="{{ route('password.email') }}">
                        @csrf
                        <h3 class="form-title m-t0">Rest Password</h3>
                        <div class="dez-separator-outer m-b5">
                            <div class="dez-separator bg-primary style-liner"></div>
                        </div>
                        <p>Enter your Email below: </p>
                  
                        <div class="form-group">
                            <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>

                                @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                        </div>
                       
                     
                       
                        <div class="form-group text-left "> 
                            <button class="site-button pull-center" type="submit"> {{ __('Send Password Reset Link') }}</button>
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

