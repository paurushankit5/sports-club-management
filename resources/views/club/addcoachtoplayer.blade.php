@extends('layouts.all')

@section('title' , "Assign Coach to ".$user->fname." ".$user->lname." for ".$sport->sport_name)

@section('page_header' , "Assign Coach to ".$user->fname." ".$user->lname." for ".$sport->sport_name)



@section('after_scripts')
  
@endsection

@section('content')
     <div class="row">
      <div class="col-12 grid-margin">
        <div class="row">
            <div class="col-md-4 offset-md-4">
                <div class="card">
                    <div class="card-body">
                    	<form method="post" action="{{ route('assigncoach') }}">
	                    	<div class="form-group">
		                        <label>Select Coach *</label>
		                        <select class="form-control" name="coach_id">
		                            <option value="">Select a Coach</option> 
		                            @php
		                                if(count($coaches))
		                                {
		                                    foreach($coaches as $coach)
		                                    {
		                                        @endphp
		                                            <option value="{{ $coach->id }}" @if($selected_coach_id == $coach->id) selected @endif>{{ $coach->fname." ".$coach->lname }}</option>
		                                        @php
		                                    }
		                                }
		                            @endphp
		                        </select>
		                        <input type="hidden" required name='sport_id' value="{{ $sport->id }}">
		                        <input type="hidden" required name='user_id' value="{{ $user->id }}">
	                    	</div>
	                    	@csrf	                
			                <div class="form-group">
			                    <br>
			                    <input type="submit" class="btn btn-primary btn-block"/>
			                </div> 
		            	</form>
                    </div>
                </div>
            </div>
        </div>
        
      </div>
    </div>
@endsection
