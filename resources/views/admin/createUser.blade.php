@extends('layouts.all')

@section('title' , 'Add Users')

@section('after_scripts')
  <script type="text/javascript">
    $("#role").on('change',function(){
      var role_id = $(this).val();
      if(role_id =='0')
      {
        toggleRole(false);
        toggleSports(true);

      }
      else if(role_id == 2 || role_id == 10){ //for player or coach
        toggleSports(false);
        toggleRole(true);
      }
      else{
        toggleRole(true);
        toggleSports(true);

      }
    });

    function toggleRole(hide){
      if(hide)
      {
        $(".role_name").addClass('d-none');
         $("#role_name").prop('required',false);
      }
      else{
        $(".role_name").removeClass('d-none');
        $("#role_name").prop('required',true);
      }
    }

    function toggleSports(hide){
      if(hide){
        $(".sportsdiv").addClass('d-none');
        $(".sports").prop('required',false);
      }
      else{
        $(".sportsdiv").removeClass('d-none');
        $(".sports").prop('required',true); 
      }
    }
  </script>
@endsection

@section('content')
     <div class="row">
      <div class="col-12 grid-margin">
        <div class="card">
          <div class="card-body">
            <h4 class="card-title">Add User to {{ $club->club_name }}</h4>
            <form method="post" action="{{ route('users.store') }}">
              @csrf
              <input type="hidden" name="club_id" value="{{ $club->id }}">
              <div>
                <section>   
                  <div class="form-group">
                    <label>Select User Role*</label>
                    <select class="form-control" name="role" required id="role">
                      <option value="">Select Role</option>
                      @if(count($roles))
                        @foreach($roles as $role)
                          <option value="{{ $role->id }}">{{ $role->role_name }}</option>
                        @endforeach
                      @endif
                      <option value="0">Other</option>
                    </select>                  
                  </div>
                  <div class="form-group sportsdiv d-none">
                    <label>Select Sports*</label>
                    <select class="form-control" name="sports[]" id="sports" multiple>
                      @if(count($club->sports))
                        @foreach($club->sports as $sport)
                          <option value="{{ $sport->id }}">{{ $sport->sport_name }}</option>
                        @endforeach
                      @endif
                    </select>
                  </div>   
                  <div class="form-group role_name d-none" >
                    <label>Enter Role Name*</label>
                    <input type="text" name="role_name" id="role_name" class="form-control" placeholder="Enter Role Name">
                  </div>            
                  <div class="form-group">
                    <div class="row">
                        <div class="col-md-6">
                            <label>First Name*</label>
                            <input type="text" class="form-control" name="fname" id="fname" value="{{ old('fname') }}" placeholder="Enter First Name" required>
                        </div>
                        <div class="col-md-6">
                            <label>Last Name*</label>
                            <input type="text" class="form-control" name="lname" id="lname" value="{{ old('lname') }}" placeholder="Enter Last Name" required>
                        </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="row">
                        <div class="col-md-6">
                            <label>Email*</label>
                            <input type="email" class="form-control" name="user_email" value="{{ old('user_email') }}" id="user_email" placeholder="Enter Admin Email" required>
                        </div>
                        <div class="col-md-6">
                            <label>Alternate Email</label>
                            <input type="text" class="form-control" name="user_alternate_email" value="{{ old('user_alternate_email') }}" id="user_alternate_email" placeholder="Enter Alternate Email" >
                        </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="row">
                        <div class="col-md-6">
                            <label>Mobile*</label>
                            <input type="number" class="form-control" pattern="[789][0-9]{9}" value="{{ old('user_mobile') }}" name="user_mobile" id="user_mobile" placeholder="Enter Admin Mobile" required>
                        </div>
                        <div class="col-md-6">
                            <label>Alternate Mobile</label>
                            <input type="text" class="form-control" pattern="[789][0-9]{9}" 
                            name="user_alternate_mobile" id="user_alternate_mobile" value="{{ old('user_alternate_mobile') }}" placeholder="Enter Alternate Mobile" >
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
