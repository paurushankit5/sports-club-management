@extends('layouts.all')

@section('title' , 'Users')

@section('page_header' , 'Users')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('clubDashboard') }}">Dashboard</a></li>
    <li class="breadcrumb-item active" aria-current="page">Users</li>
@endsection

@section('content')
    <div class="row">
      
      
      <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <h4 class="card-title">Users
            
                <a href="{{ route('users.create') }}" title="Edit" class="btn btn-info pull-right" title="Add Sports Club / Organization"><i class="fa fa-plus"></i></a>
              </h4>
                
             @component('components.list_user_component')
              @slot('users' , $users)
              @slot('links' , $users->links())
             @endcomponent 
          </div>
        </div>
      </div>
      
      
      
    </div>
@endsection