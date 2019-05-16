@extends('layouts.all')

@section('title' , 'My Profile')

@section('page_header' , 'My Profile')



@section('after_scripts')
    <script type="text/javascript">
        $(".changepic").on('click', function(){
            $("#picModal").modal('toggle');
        });
        $(".uploadidproof").on('click', function(){
            $("#idProofModal").modal('toggle');
        });
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
                <h4 class="card-title">My Profile
                
                    <a href="{{ route('editprofile') }}" title="Edit" class="btn btn-info pull-right btn-sm btn-rounded" title="Add Sports Club / Organization"><i class="mdi mdi-grease-pencil"></i></a>
                  </h4>
                    
                <table class="table table-striped">             
                    <tbody>
                        <tr>
                            <th>Name</th>
                            <td>{{ \Auth::user()->fname." ".\Auth::user()->lname }}</td>
                        </tr>
                        <tr>
                            <th>Contact Details</th>
                            <td>
                                @if(\Auth::user()->email != '') {{ \Auth::user()->email }} <br> @endif
                                @if(\Auth::user()->alternate_email != '') {{ \Auth::user()->alternate_email }} <br> @endif
                                @if(\Auth::user()->mobile != '') {{ \Auth::user()->mobile }} <br> @endif
                                @if(\Auth::user()->alternate_mobile != '') {{ \Auth::user()->alternate_mobile }} <br> @endif
                            </td>
                        </tr>
                        <tr>
                            <th>Club</th>
                            <td>{{ \Auth::user()->club->club_name }}</td>
                        </tr> 
                        <tr>
                            <th>Role</th>
                            <td>{{ \Auth::user()->role->role_name }}</td>
                        </tr>
                        @if(\Auth::user()->sports)
                            <tr>
                                <th>Sports</th>
                                <td>
                                    @foreach( \Auth::user()->sports as $sport)
                                        {{ $sport->sport_name }}<br>
                                    @endforeach
                                </td>
                            </tr>
                        @endif   
                        <tr>
                            <th>ID Proof</th>
                            <td>
                                @if( \Auth::user()->id_proof !='')
                                    <a href="{{ url('images/'.\Auth::user()->id_proof_pic) }}" target="_blank">{{ \Auth::user()->id_proof }}</a>
                                @else
                                    <button class="btn btn-outline-danger btn-icon-text uploadidproof">Upload</button>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>Date Of Birth</th>
                            <td> @if(\Auth::user()->dob != '') {{ date('d-M-Y', strtotime(\Auth::user()->dob)) }} @endif</td>
                        </tr>
                        <tr>
                            <th>Emergency Contact Details</th>
                            <td>
                                 @if(\Auth::user()->emergency_contact_name != '') {{ \Auth::user()->emergency_contact_name }} <br> @endif
                                 @if(\Auth::user()->emergency_contact_number != '') {{ \Auth::user()->emergency_contact_number }} <br> @endif
                            </td>
                        </tr>
                        <tr>
                            <th>Blood Group</th>
                            <td>{{ \Auth::user()->blood_group }}</td>
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
                    @if( \Auth::user()->profile_pic != '' )
                         src="{{ asset('images/'.\Auth::user()->profile_pic) }}"   
                    @else
                         src="{{ asset('noprofilepic.png') }}"
                    @endif
                    alt="{{ \Auth::user()->fname." ".\Auth::user()->lname }}" class="img img-responsive"/> 
                    
                </div>
                <div class="content text-center">
                    <br>
                    <h5 class=" text-primary">{{ \Auth::user()->fname." ".\Auth::user()->lname }}</h5>
                    <button class="btn btn-rounded btn-dark btn-sm changepic">Change</button>
                    <br>
                    <br>
                </div>
            </div>

            @component('components.coachfee')
                @slot('user' , \Auth::user())
            @endcomponent
        </div>
      
      
      
    </div>

    <div class="modal fade" id="picModal" tabindex="-1" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form action="{{ route('updateProfilePic') }}" method="post" enctype="multipart/form-data">
                <div class="modal-header">
                    <h5 class="modal-title" id="ModalLabel">Change Pic</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    @csrf
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">Upload Profile Pic:</label>
                        <input type="file" accept="image/*" required class="form-control" id="profile_pic" name="profile_pic">
                    </div>                      
                 </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">
                        <i class="mdi mdi-upload btn-icon-prepend"></i> Upload
                    </button>
                    <button type="button" class="btn btn-light" data-dismiss="modal">Close</button>
                </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="idProofModal" tabindex="-1" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form action="{{ route('storeidproof') }}" method="post" enctype="multipart/form-data">
                <div class="modal-header">
                    <h5 class="modal-title" id="ModalLabel">Upload ID Proof</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    @csrf
                    <div class="form-group">
                        <label>ID Proof*</label>
                        <select class="form-control" name="id_proof" id="id_proof">
                            @if(count($idproofs))
                                @foreach($idproofs as $idproof)
                                    <option>{{ $idproof->proof_name }}</option>
                                @endforeach
                            @endif
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="id_proof_pic" class="col-form-label">Upload ID Proof:</label>
                        <input type="file" accept="image/*" required class="form-control" id="id_proof_pic" name="id_proof_pic">
                    </div>                      
                 </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">
                        <i class="mdi mdi-upload btn-icon-prepend"></i> Upload
                    </button>
                    <button type="button" class="btn btn-light" data-dismiss="modal">Close</button>
                </div>
                </form>
            </div>
        </div>
    </div>
@endsection