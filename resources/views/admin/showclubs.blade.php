@extends('layouts.admin')

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
                  <th> # </th>
                  <th> Organization </th>
                  <th> Contact Details </th>
                  <th> Action </th>
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
                      <td>{{ $club->club_name }}</td>
                      <td>
                        {{ $club->contact_fname ." ". $club->contact_lname }}<br>
                        {{ $club->email ." ". $club->alternate_email }}<br>
                        {{ $club->mobile ." ". $club->alternate_mobile }}
                      </td>
                      <td>
                        <a href="{{ route('clubDetails', $club->id) }}" class="btn btn-primary" title="View"><i class="fa fa-eye"></i></a>
                        <a href="#" class="btn btn-success" title="Edit"><i class="fa fa-pencil"></i></a>
                        <a href="#" class="btn btn-danger" title="Delete"><i class="fa fa-trash"></i></a>
                      </td>
                    </tr>
                  @endforeach
                @endif
                
              </tbody>
            </table>
            {{ $clubs->links() }}
          </div>
        </div>
      </div>
      
      
      
    </div>
@endsection