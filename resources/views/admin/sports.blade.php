@extends('layouts.all')

@section('title' , 'Sports / Activities')

@section('content')
    <div class="row">
      
      
      <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <h4 class="card-title">Sports / Activities
            
                <a href="#" title="Edit" data-toggle="modal" data-target="#addSportModal" class="btn btn-info pull-right" title="Add Sports Club / Organization"><i class="fa fa-plus"></i></a>
              </h4>
                
            <table class="table table-striped">
              <thead>
                <tr>
                  <th> # </th>
                  <th> Sports / Activities </th>
                </tr>
              </thead>
              <tbody>
              	@if(count($sports))
                  @php
                      $i=1;
                  @endphp
                  @foreach($sports as $sport)
                    <tr>
                      <td>{{ $i++ }}</td>
                      <td>{{ $sport->sport_name }}</td>
                      
                     
                    </tr>
                  @endforeach
                @endif
                
              </tbody>
            </table>
          </div>
        </div>
      </div>
      
      
      
    </div>
    <div class="modal fade" id="addSportModal" tabindex="-1" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
          <div class="modal-content">
              <form action="{{ route('storeSport') }}" method="post" enctype="multipart/form-data">
              <div class="modal-header">
                  <h5 class="modal-title" id="ModalLabel">Add Sports / Activities</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                  </button>
              </div>
              <div class="modal-body">
                  @csrf
                  <div class="form-group">
                      <input type="text" name="sport_name" class="form-control"  required placeholder="Enter Sport / Activities name" />
                  </div>                      
               </div>
              <div class="modal-footer">
                  <button type="submit" class="btn btn-success">Submit
                  </button>
                  <button type="button" class="btn btn-light" data-dismiss="modal">Close</button>
              </div>
              </form>
          </div>
      </div>
    </div>
@endsection
