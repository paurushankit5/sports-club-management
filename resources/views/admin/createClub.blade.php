@extends('layouts.admin')

@section('title' , 'Add Organization / Sports Club')

@section('page_header' , 'Add Sports Club')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="#">Tables</a></li>
    <li class="breadcrumb-item active" aria-current="page">Add Organization / Sports Club</li>
@endsection

@section('after_scripts')
  
@endsection

@section('content')
     <div class="row">
      <div class="col-12 grid-margin">
        <div class="card">
          <div class="card-body">
            <h4 class="card-title">Add Organization / Sports Club</h4>
            <form method="post" action="{{ route('clubs.store') }}">
              @csrf
              <div>
                <h3 class="bg-primary text-center text-white" style="padding: 10px">Organization Details</h3>
                <section>
                  <div class="form-group">
                    <label>Organization Name*</label>
                    <input type="text" class="form-control" aria-describedby="emailHelp" name="club_name" value="{{ old('club_name') }}" placeholder="Enter Organization Name" required>
<!--                     <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
 -->              </div>
                  <div class="form-group">
                    <div class="row">
                        <div class="col-md-6">
                            <label>GST No.*</label>
                            <input type="text" class="form-control" value="{{ old('gst_no') }}" placeholder="GST Number" name="gst_no" id="gst_no">
                        </div>
                        <div class="col-md-6">
                            <label>Establishment Year</label>
                            <select class="form-control" name="establishment_year" value="{{ old('establishment_year') }}" id="establishment_year" required>
                                @for($i=date('Y'); $i>=1950;$i--)
                                    <option>{{ $i }}</option>
                                @endfor
                            </select>
                        </div>
                    </div>  
                  </div>         
                  <div class="form-group">
                    <label>About The Organization</label>
                    <textarea class="form-control" placeholder="Small Details about the organization" rows="5" name="about_club" id="about_club">{{ old('about_club') }}</textarea>
                  </div>
                </section>
                <h3 class="bg-primary text-center text-white" style="padding: 10px">Organization Contact Details</h3>
                <section>
                  <div class="form-group">
                    <div class="row">
                        <div class="col-md-6">
                            <label>Contact Person First name*</label>
                            <input type="text" class="form-control" value="{{ old('contact_fname') }}" aria-describedby="emailHelp" placeholder="Enter first name" name="contact_fname" id="contact_fname" required>
                        </div>
                        <div class="col-md-6">
                            <label>Contact Person Last name</label>
                            <input type="text" class="form-control" aria-describedby="emailHelp" value="{{ old('contact_lname') }}" placeholder="Enter last name" name="contact_lname" id="contact_lname">
                        </div>
                    </div>                    
                  </div>
                  <div class="form-group">
                    <div class="row">
                        <div class="col-md-6">
                            <label>Email*</label>
                            <input type="email" class="form-control" name="email" value="{{ old('email') }}" id="email" required placeholder="Enter Contact Person Email" required>
                        </div>
                        <div class="col-md-6">
                            <label>Alternate Email</label>
                            <input type="email" class="form-control" name="alternate_email" value="{{ old('alternate_email') }}" id="alternate_email" placeholder="Enter Contact Person Email">
                        </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="row">
                        <div class="col-md-6">
                            <label>Mobile*</label>
                            <input type="number" class="form-control" name="mobile" value="{{ old('mobile') }}" pattern="[789][0-9]{9}" id="mobile" required placeholder="Enter Contact Person mobile number" required>
                        </div>
                        <div class="col-md-6">
                            <label>Alternate Mobile</label>
                            <input type="number" class="form-control" pattern="[789][0-9]{9}" value="{{ old('alternate_mobile') }}" name="alternate_mobile" id="alternate_mobile" placeholder="Alternate Mobile">
                        </div>
                    </div>
                  </div>
                  
                </section>
                <h3  class="bg-primary text-center text-white" style="padding: 10px">Address Details</h3>
                <section>
                  <div class="form-group">
                        <label>Address Line 1*</label>
                        <input type="text" class="form-control" value="{{ old('adl1') }}"  name="adl1" id="adl1" placeholder="Addrss Line 1" required>
                  </div>
                  <div class="form-group">
                        <label>Address Line 2</label>
                        <input type="text" class="form-control" name="adl2" id="adl2" value="{{ old('adl2') }}" placeholder="Addrss Line 2">
                  </div>
                  <div class="form-group">
                    <div class="row">
                        <div class="col-md-6">
                            <label>City*</label>
                            <input type="text" class="form-control" name="city" value="{{ old('city') }}" id="city" required placeholder="Enter City" required>
                        </div>
                        <div class="col-md-6">
                            <label>State*</label>
                            <input type="text" class="form-control" name="state" id="state" value="{{ old('state') }}" required placeholder="Emter State">
                        </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="row">
                        <div class="col-md-6">
                            <label>Country*</label>
                            <input type="text" class="form-control" name="country" id="country" value="{{ old('country') }}" required placeholder="Enter country" required>
                        </div>
                        <div class="col-md-6">
                            <label>Pin Code*</label>
                            <input type="number" class="form-control" name="pin" id="pin" value="{{ old('pin') }}" required placeholder="Emter pin code">
                        </div>
                    </div>
                  </div>
                </section>
                <h3 class="bg-primary text-center text-white" style="padding: 10px">Admin Details</h3>
                <section>
                  
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
