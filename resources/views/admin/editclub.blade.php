@extends('layouts.all')

@section('title' , 'Edit '. $club->club_name)


@section('after_scripts')
  
@endsection

@section('content')
     <div class="row">
      <div class="col-12 grid-margin">
        <div class="card">
          <div class="card-body">
            <h4 class="card-title">Edit {{ $club->club_name }}</h4>
            <form method="post" action="{{ route('updateclub', $club->id) }}">
              @csrf
              <div>
                <h3 class="bg-primary text-center text-white" style="padding: 10px">Organization Details</h3>
                <section>
                  <div class="form-group">
                   
                    <label>Organization Name*</label>
                    <input type="text" class="form-control" aria-describedby="emailHelp" name="club_name" value="{{ $club->club_name }}" placeholder="Enter Organization Name" required>
                 </div>
                  
                  <div class="form-group">
                    <div class="row">
                        <div class="col-md-4">
                            <label>GST No.*</label>
                            <input type="text" class="form-control" value="{{ $club->gst_no }}" placeholder="GST Number" name="gst_no" id="gst_no">
                        </div>
                        <div class="col-md-4">
                            <label>Establishment Year</label>
                            <select class="form-control" name="establishment_year" value="{{ old('establishment_year') }}" id="establishment_year" required>
                                @for($i=date('Y'); $i>=1950;$i--)
                                    <option @if($club->establishment_year == $i) selected  @endif) >{{ $i }}</option>
                                @endfor
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label>GST No.*</label>
                            <select class="form-control" name="payment_due_date" id="payment_due_date">
                              <@php
                                for($i=1;$i<=28;$i++){
                                  @endphp
                                    <option value="{{ $i }}" 
                                    @if($i == $club->payment_due_date) selected @endif >{{ $i }}</option>
                                  @php
                                }
                              @endphp
                            </select>
                        </div>
                    </div>  
                  </div>         
                  <div class="form-group">
                    <label>About The Organization</label>
                    <textarea class="form-control" placeholder="Small Details about the organization" rows="5" name="about_club" id="about_club">{{ $club->about_club }}</textarea>
                  </div>
                </section>
                <h3 class="bg-primary text-center text-white" style="padding: 10px">Organization Contact Details</h3>
                <section>
                  <div class="form-group">
                    <div class="row">
                        <div class="col-md-6">
                            <label>Contact Person First name*</label>
                            <input type="text" class="form-control" value="{{ $club->contact_fname }}" aria-describedby="emailHelp" placeholder="Enter first name" name="contact_fname" id="contact_fname" required>
                        </div>
                        <div class="col-md-6">
                            <label>Contact Person Last name</label>
                            <input type="text" class="form-control" aria-describedby="emailHelp" value="{{ $club->contact_lname }}" placeholder="Enter last name" name="contact_lname" id="contact_lname">
                        </div>
                    </div>                    
                  </div>
                  <div class="form-group">
                    <div class="row">
                        <div class="col-md-6">
                            <label>Email*</label>
                            <input type="email" class="form-control" name="email" value="{{ $club->email }}" id="email" required placeholder="Enter Contact Person Email" required>
                        </div>
                        <div class="col-md-6">
                            <label>Alternate Email</label>
                            <input type="email" class="form-control" name="alternate_email" value="{{ $club->alternate_email }}" id="alternate_email" placeholder="Enter Contact Person Email">
                        </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="row">
                        <div class="col-md-6">
                            <label>Mobile*</label>
                            <input type="number" class="form-control" name="mobile" value="{{ $club->mobile }}" pattern="[789][0-9]{9}" id="mobile" required placeholder="Enter Contact Person mobile number" required>
                        </div>
                        <div class="col-md-6">
                            <label>Alternate Mobile</label>
                            <input type="number" class="form-control" pattern="[789][0-9]{9}" value="{{ $club->alternate_mobile }}" name="alternate_mobile" id="alternate_mobile" placeholder="Alternate Mobile">
                        </div>
                    </div>
                  </div>
                  
                </section>
                <h3  class="bg-primary text-center text-white" style="padding: 10px">Address Details</h3>
                <section>
                  <div class="form-group">
                        <label>Address Line 1*</label>
                        <input type="text" class="form-control" value="{{ $club->adl1 }}"  name="adl1" id="adl1" placeholder="Addrss Line 1" required>
                  </div>
                  <div class="form-group">
                        <label>Address Line 2</label>
                        <input type="text" class="form-control" name="adl2" id="adl2" value="{{ $club->adl2 }}" placeholder="Addrss Line 2">
                  </div>
                  <div class="form-group">
                    <div class="row">
                        <div class="col-md-6">
                            <label>City*</label>
                            <input type="text" class="form-control" name="city" value="{{ $club->city }}" id="city" required placeholder="Enter City" required>
                        </div>
                        <div class="col-md-6">
                            <label>State*</label>
                            <input type="text" class="form-control" name="state" id="state" value="{{ $club->state }}" required placeholder="Enter State">
                        </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="row">
                        <div class="col-md-6">
                            <label>Country*</label>
                            <input type="text" class="form-control" name="country" id="country" value="{{ $club->country }}" required placeholder="Enter country" required>
                        </div>
                        <div class="col-md-6">
                            <label>Pin Code*</label>
                            <input type="number" class="form-control" name="pin" id="pin" value="{{ $club->pin }}" required placeholder="Enter pin code">
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
