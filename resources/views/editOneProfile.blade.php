@extends('layouts.all')

@section('title' , "Edit $user->fname $user->lname's Profile")

@section('page_header' , "Edit $user->fname $user->lname's  Profile")


@section('content')
     <div class="row">
      <div class="col-12 grid-margin">
        <div class="card">
          <div class="card-body">
            <h4 class="card-title">Edit <a href="{{ route('getoneuserprofile', $user->id) }}">{{$user->fname." ". $user->lname}}'s</a>  Profile</h4>
            <form method="post" action="{{ route('updateoneuserprofile', $user->id) }}">
              @csrf
              <div>
                <section>           
                  <div class="form-group">
                    <div class="row">
                        <div class="col-md-6">
                            <label>First Name*</label>
                            <input type="text" class="form-control" name="fname" id="fname" value="{{ $user->fname }}" placeholder="Enter First Name" required>
                        </div>
                        <div class="col-md-6">
                            <label>Last Name*</label>
                            <input type="text" class="form-control" name="lname" id="lname" value="{{ $user->lname }}" placeholder="Enter Last Name" required>
                        </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="row">
                        <div class="col-md-6">
                            <label>Email*</label>
                            <input type="email" class="form-control" readonly value="{{ $user->email }}" id="user_email" placeholder="Enter Admin Email" required>
                        </div>
                        <div class="col-md-6">
                            <label>Alternate Email</label>
                            <input type="text" class="form-control" name="user_alternate_email" value="{{ $user->alternate_email }}" id="user_alternate_email" placeholder="Enter Alternate Email" >
                        </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="row">
                        <div class="col-md-6">
                            <label>Mobile*</label>
                            <input type="number" class="form-control" pattern="[789][0-9]{9}" value="{{ $user->mobile }}" name="user_mobile" id="user_mobile" placeholder="Enter Admin Mobile" required>
                        </div>
                        <div class="col-md-6">
                            <label>Alternate Mobile</label>
                            <input type="text" class="form-control" pattern="[789][0-9]{9}" 
                            name="user_alternate_mobile" id="user_alternate_mobile" value="{{ $user->alternate_mobile }}" placeholder="Enter Alternate Mobile" >
                        </div>
                    </div>
                  </div>
                  <div class="form-group">
                  	<div class="row">
                  		<div class="col-md-6">
                  			<label>Emergency Contact Name</label>
                  			<input type="text" name="emergency_contact_name" value="{{ $user->emergency_contact_name }}" class="form-control" placeholder="Enter Emergency Contact Name">
                  		</div>
                  		<div class="col-md-6">
                  			<label>Emergency Contact Number</label>
                  			<input type="text" name="emergency_contact_number" value="{{ $user->emergency_contact_number }}" class="form-control" placeholder="Enter Emergency Contact Number">
                  		</div>                  		
                  	</div>
                  </div>
                  <div class="form-group">
                  	<div class="row">
                  		<div class="col-md-6">
                  			<label>Blood Group</label>
                  			<select class="form-control" name="blood_group" >
                  				<option value="">Select Blood Group</option>
                  				<option @if($user->blood_group == 'O+') selected @endif>O+</option>
                  				<option @if($user->blood_group == 'O-') selected @endif>O-</option>
                  				<option @if($user->blood_group == 'A+') selected @endif>A+</option>
                  				<option @if($user->blood_group == 'A-') selected @endif>A-</option>
                  				<option @if($user->blood_group == 'B+') selected @endif>B+</option>
                  				<option @if($user->blood_group == 'B-') selected @endif>B-</option>
                  				<option @if($user->blood_group == 'AB+') selected @endif>AB+</option>
                  				<option @if($user->blood_group == 'AB-') selected @endif>AB-</option>
                  			</select>
                  		</div>
                  		<div class="col-md-6">
                  			<label>Date Of Birth</label>
                  			<input type="date" name="dob" value="{{ $user->dob }}" class="form-control" placeholder="Enter Date Of Birth">
                  		</div>                  		
                  	</div>
                  </div>
                  
                  <div class="form-group">
                    <input type="submit" class="btn btn-primary" />
                  </div>
                </section>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
@endsection
