@extends('layouts.all')

@section('title' ,$user->fname." ".$user->lname ."'s Profile")

@section('page_header' ,$user->fname." ".$user->lname ."'s Profile")



@section('after_scripts')
    <script type="text/javascript">
        $(".sessionrate").click(function(){
            $("#sessionratemodal").modal('toggle');
        });
    </script>
@endsection
@section('content')
    <div class="row">      
        <div class="col-lg-8 grid-margin stretch-card">
            <div class="card">
              <div class="card-body">
                <h4 class="card-title">{{ $user->fname." ".$user->lname }}'s Profile</h4>
                    
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
                                        {{ $sport->sport_name }}
                                        @if($user->role_id == 2)
                                            @if($sport->coach)
                                                (
                                                    <a href="{{ route('getoneuserprofile',$sport->coach->id) }}">{{$sport->coach->fname}}
                                                        {{$sport->coach->lname}}
                                                    </a>
                                                )                                                
                                            @endif
                                            <a href="{{ route('addcoachtoplayer',array($sport->id,$user->id)) }}" class="btn btn-primary btn-sm float-right" title="Assign/Remove Coach"><i class="mdi mdi-pencil"></i></a>
                                        @endif
                                        <hr>
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
                @if($user->role_id == 2 && $user->club_id == \Auth::user()->club_id && (\Auth::user()->role_id==1 || \Auth::user()->role_id==10) )
                    <a href="/user/payment/{{ $user->id }}/{{ date('m') }}/{{ date('Y') }}">Add Payment</a>

                @endif
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
                    @if(\Auth::user()->club_id == $user->club_id && \Auth::user()->role_id ==1 )
                        <div class="table-responsive">
                            <table class="table">
                                <tr>
                                    <th>User Status</th>
                                    <td>    {{ $user->is_active == 1 ? 'Active' : 'Deactive' }} </td>
                                </tr>
                                <tr>
                                    <td colspan="2" class="text-center">
                                        <a href="{{ route('changeuserstatus',$user->id) }}" class="btn btn-rounded btn-dark btn-sm changepic">{{ $user->is_active == 0 ? 'Activate' : 'Deactivate' }} User</a>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    @endif
                    <br>
                    <br>
                </div>
            </div>
            @component('components.coachfee')
                @slot('user' , $user)
            @endcomponent

            @component('components.playerMembership')
                @slot('user' , $user)
            @endcomponent

        </div>
      
      
      
    </div>

     

    
@endsection