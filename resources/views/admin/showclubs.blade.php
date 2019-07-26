@extends('layouts.all')

@section('title' , 'Organization List')

@section('page_header' , 'Organization List')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('adminDashboard') }}">Dashboard</a></li>
    <li class="breadcrumb-item active" aria-current="page">Organization List</li>
@endsection

@section('content')
    <div class="row">
      
      
      <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <h4 class="card-title">Sports Club / Organization
            
                <a href="{{ route('clubs.create') }}" title="Edit" class="btn btn-info pull-right" title="Add Sports Club / Organization"><i class="fa fa-plus"></i></a>
              </h4>
                
            <table class="table table-striped">
              <thead>
                <tr>
                  <th colspan="4">
                    <div class="form-group">
                      <form>
                        <div class="input-group">
                          <input type="text" required name="search" @if(isset($_GET['search'])) value="{{ $_GET['search'] }}" @endif class="form-control" placeholder="Search Here" aria-label="Recipient's username" aria-describedby="basic-addon2">
                          <div class="input-group-append">
                            <button class="btn btn-sm btn-gradient-primary" type="button">Search</button>
                        </div>
                      </div>
                    </div>
                  </th>
                </tr>
                <tr>
                  <th> # </th>
                  <th> Organization </th>
                  <th> Users </th>
                  <th> Contact Details </th>
                </tr>
              </thead>
              <tbody>
              	@if(count($clubs))
                  @php
                      $i=1;
                      if(isset($_GET['page']))
                      {
                          $i  =    env('RESULT_LIMIT')*--$_GET['page']+1;   
                      }

                  @endphp
                  @foreach($clubs as $club)
                    <tr>
                      <td>{{ $i++ }}</td>
                      <td><a href="{{ route('clubDetail', $club->id) }}">{{ $club->club_name }}</a></td>
                      <td> {{ count($club->users) }} </td>
                      <td>
                        {{ $club->contact_fname ." ". $club->contact_lname }}<br>
                        {!! $club->email ."<br>". $club->alternate_email !!}<br>
                        {!! $club->mobile ."<br>". $club->alternate_mobile !!}
                      </td>
                     
                    </tr>
                  @endforeach
                @endif
                
              </tbody>
            </table>
            {{ $clubs->appends($_GET)->links() }}
          </div>
        </div>
      </div>
      
      
      
    </div>
@endsection
