@extends('layouts.all')

@section('title' , $club->club_name)

@section('page_header' , $club->club_name)


@section('after_scripts')
  
@endsection

@section('content')
     <div class="row">
      <div class="col-12 grid-margin">
        <div class="card">
          <div class="card-body">
            <h4 class="card-title">{{ $club->club_name }}
                <a href="{{ route('clubs.createUser', $club->id) }}" class="btn pull-right btn-sm btn-gradient-primary mt-">+ Add Users</a>
            </h4>
             	<div class="table table-responsive">
             		<table class="table">
                        <tr>
                            <th>Name</th>
                            <th>{{ $club->club_name }}</th>
                        </tr>
                        <tr>
                            <th>Email</th>
                            <th>
                                {{ $club->email }}<br>
                                {{$club->alternate_email}}
                            </th>
                        </tr>
                        <tr>
                            <th>Contact Details</th>
                            <th>
                                {{ $club->contact_fname }} {{ $club->contact_lname }}  <br>
                                {{ $club->mobile }}<br>
                                {{$club->alternate_mobile}}
                            </th>
                        </tr>
                        <tr> 
                            <th>Sports</th>
                            <th>
                                @if(count($club->sports))
                                    @foreach($club->sports as $sport)
                                        {{ $sport->sport_name }}  <button data-sport_id="{{ $sport->id }}" class="btn btn-sm btn-danger float-right delete-sport-user" title="Delete Sports"><i class="fa fa-times"></i></button>
                                             <a href="" class="btn btn-primary btn-sm float-right" title="Edit" title="Assign/Remove Coach"><i class="mdi mdi-pencil"></i></a>
                                             <br>
                                             <br>
                                    @endforeach
                                @endif
                            </th>
                        </tr>
                        <tr>
                            <th>Address</th>
                            <th>
                                {{ $club->adl1 }}<br>
                                {{ $club->adl2 }}<br>
                                {{ $club->city }} 
                                {{ $club->state }} 
                                {{ $club->country }} 
                                {{ $club->pin }} 
                            </th>
                        </tr>
                        <tr>
                            <th>Late Fees</th>
                            <th> &#x20B9; {{ $club->late_fees }} </th>
                        </tr>
                        <tr>
                            <th>GST No</th>
                            <th>{{ $club->gst_no }} </th>
                        </tr>
                        <tr>
                            <th>Establishment Year</th>
                            <th>{{ $club->establishment_year }} </th>
                        </tr>   
                        <tr>
                            <th colspan="2">
                                About Organization: <br> {{ $club->about_club }}
                            </th>
                        </tr>
             			<tr>
             				<th>Name</th>
             				<th>Action</th>
             			</tr>
             			@if(count($club->users))
             				@foreach($club->users as $user)
             					<tr>
	             					<td>
	             						<a href="{{ route('getoneuserprofile', $user->id) }}">{{$user->fname." ".$user->lname}}</a>
	             						<br>({{ $user->role->role_name }})
	             					</td>
	             					<td>
	             						<!-- <a href="{{ route('loginAsUser', $user->id) }}" class="btn btn-primary">Login</a> -->
	             					</td>
	             				</tr>
             				@endforeach
             			@endif
             		</table>
             	</div>
              
          </div>
        </div>
      </div>
    </div>
@endsection
