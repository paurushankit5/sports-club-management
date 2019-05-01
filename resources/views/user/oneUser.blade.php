@extends('layouts.all')

@section('title' , 'User Profile')

@section('page_header' , 'User Profile')



@section('after_scripts')
    
@endsection
@section('content')
    <div class="row">      
        <div class="col-lg-8 grid-margin stretch-card">
            <div class="card">
              <div class="card-body">
                <h4 class="card-title">{{ $user->fname." ".$user->lname }} Profile</h4>
                    
                <table class="table table-striped">             
                    <tbody>
                        <tr>
                            <th>Name</th>
                            <td>{{ $user->fname." ".$user->lname }}</td>
                        </tr>
                         @if($user->club_id == \Auth::user()->club_id)
                        <tr>
                            <th>Contact Details</th>
                            <td>
                                @if($user->email != '') {{ $user->email }} <br> @endif
                                @if($user->alternate_email != '') {{ $user->alternate_email }} <br> @endif
                                @if($user->mobile != '') {{ $user->mobile }} <br> @endif
                                @if($user->alternate_mobile != '') {{ $user->alternate_mobile }} <br> @endif
                            </td>
                        </tr>
                        @endif
                        <tr>
                            <th>Club</th>
                            <td>{{ $user->club->club_name }}</td>
                        </tr> 
                        <tr>
                            <th>Role</th>
                            <td>{{ $user->role->role_name }}</td>
                        </tr>
                        @if($user->sports)
                            <tr>
                                <th>Sports</th>
                                <td>
                                    @foreach( $user->sports as $sport)
                                        {{ $sport->sport_name }}<br>
                                    @endforeach
                                </td>
                            </tr>
                        @endif
                        @if($user->club_id == \Auth::user()->club_id && \Auth::user()->role_id == 1)
                            <tr>
                                <th>ID Proof</th>
                                <td>
                                    @if( $user->id_proof !='')
                                        <a href="{{ url('images/'.$user->id_proof_pic) }}" target="_blank">{{ $user->id_proof }}</a>
                                    @endif
                                </td>
                            </tr> 
                            <tr>
                            <th>Emergency Contact Details</th>
                                <td>
                                     @if($user->emergency_contact_name != '') {{ $user->emergency_contact_name }} <br> @endif
                                     @if($user->emergency_contact_number != '') {{ $user->emergency_contact_number }} <br> @endif
                                </td>
                            </tr>
                            <tr>
                                <th>Blood Group</th>
                                <td>{{ $user->blood_group }}</td>
                            </tr>
                        @endif   
                        
                        <tr>
                            <th>Date Of Birth</th>
                            <td> @if($user->dob != '') {{ date('d-M-Y', strtotime($user->dob)) }} @endif</td>
                        </tr>
                        
                        
                    </tbody>
                </table>
              </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card card-profile ">
                <div class="card-avatar">
                    <img
                    @if( $user->profile_pic != '' )
                         src="{{ asset('images/'.$user->profile_pic) }}"   
                    @else
                         src="{{ asset('noprofilepic.png') }}"
                    @endif
                    alt="{{ $user->fname." ".$user->lname }}" class="img img-responsive"/> 
                    
                </div>
                <div class="content text-center">
                    <br>
                    <h5 class=" text-primary">{{ $user->fname." ".$user->lname }}</h5>
                    <br>
                    <br>
                </div>
            </div>

        </div>
      
      
      
    </div>

    
@endsection