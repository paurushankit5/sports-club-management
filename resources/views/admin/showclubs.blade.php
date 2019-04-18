@extends('layouts.admin')

@section('title' , 'Admin Dashboard')

@section('page_header' , 'Admin Dashboard')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="#">Tables</a></li>
    <li class="breadcrumb-item active" aria-current="page">List Clubs</li>
@endsection

@section('content')
    <div class="row">
      
      
      <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <h4 class="card-title">Sports Club / Organization</h4>
            <p class="card-description"> All Active Sports Club <code> listed here.</code>
            </p>
            <table class="table table-striped">
              <thead>
                <tr>
                  <th> Organization </th>
                  <th> Contact Details </th>
                  <th> Players </th>
                  <th> Action </th>
                </tr>
              </thead>
              <tbody>
              	@for($i=0; $i<10;$i++)
                <tr>
                 
                  <td> Herman Beck Sports CLub </td>
                  
                  <td> +91-7531855396 <br> abc@gmail.com </td>
                  <td> {{ rand(11,86) }} </td>
                  <td>
                  	<a href="#" class="btn btn-primary" title="View"><i class="fa fa-eye"></i></a>
                  	<a href="#" class="btn btn-success" title="Edit"><i class="fa fa-pencil"></i></a>
                  	<a href="#" class="btn btn-danger" title="Delete"><i class="fa fa-trash"></i></a>
                  </td>
                </tr>
                @endfor
                
              </tbody>
            </table>
          </div>
        </div>
      </div>
      
      
      
    </div>
@endsection