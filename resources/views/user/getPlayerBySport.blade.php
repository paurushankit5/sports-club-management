@extends('layouts.all')

@section('title' ,  $sport->sport_name." ".$user_type )

@section('page_header' ,  $sport->sport_name." ".$user_type  )



@section('after_scripts')
    
@endsection
@section('content')
    <div class="row">      
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
              <div class="card-body">
                <h4 class="card-title"> {{  $sport->sport_name." ".$user_type }}</h4>
                 @component('components.list_user_component')
                 	@slot('users' , $users)
                 @endcomponent   
                
              </div>
            </div>
        </div>     
    </div>    
@endsection