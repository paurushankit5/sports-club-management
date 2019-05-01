@extends('layouts.all')

@section('title' , 'Error')

@section('page_header' , 'Error')



@section('after_scripts')
  
@endsection
@section('content')
    <div class="row">      
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
              <div class="card-body">
                
                @if(isset($msg))
                  <div class="alert alert-fill-danger" role="alert"><p><i class="mdi mdi-alert-circle"></i> {{ $msg }} </p></div>    
                @endif                
                
              </div>
            </div>
        </div>
      
      
      
    </div>

   
@endsection