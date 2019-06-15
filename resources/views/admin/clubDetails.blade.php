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
             				<th>Action</th>
             			</tr>
             			@if(count($club->users))
             				@foreach($club->users as $user)
             					<tr>
	             					<td>
	             						{{$user->fname." ".$user->lname}}
	             						<br>({{ $user->role->role_name }})
	             					</td>
	             					<td>
	             						<a href="{{ route('loginAsUser', $user->id) }}" class="btn btn-primary">Login</a>
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
