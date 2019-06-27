@extends('layouts.all')

@section('title' ,$user->fname." ".$user->lname ."'s Profile")

@section('after_scripts')
    <script type="text/javascript">
        $(".sessionrate").click(function(){
            $("#sessionratemodal").modal('toggle');
        });
        $(".view_invoices").on('click',function(){
            $.ajax({
                type: "POST",
                url : "{{ route('getinvoices', $user->id) }}",
                data : {
                    "_token" :  "{{csrf_token()}}",
                    "id"    :   "{{ $user->id }}"
                },
                success : function(data){
                    //console.log(data.length);
                    var len = data.length;
                    var monthNames = {
                        "1" : "Jan",
                        "2" : "Feb",
                        "3" : "Mar",
                        "4" : "Apr",
                        "5" : "May",
                        "6" : "Jun",
                        "7" : "Jul",
                        "8" : "Aug",
                        "9" : "Sep",
                        "10" : "Oct",
                        "11" : "Nov",
                        "12" : "Desc",
                    };
                    if(len)
                    {
                        $(".invoices-list").html("");
                        for(i=0;i<len;i++)
                        {
                            
                            $(".invoices-list").append("<a href='/user/showpayment/{{ $user->id }}/"+data[i].month+"/"+data[i].year+"' target='_blank' class='list-group-item'>"+monthNames[data[i].month]+" / "+ data[i].year +"</a>");

                        }
                        $("#invoices_modal").modal("toggle");
                    }
                    else{
                        alert("No invoices generated yet.");
                    }
                }
            });
        });
        $(".delete-sport-user").on('click', function(){
            var r = confirm("Do you really want to remove this game from the user?");
            if(r){
                var sport_id = $(this).attr('data-sport_id');
                $.ajax({
                    type    : 'POST',
                    url     :  "{{ route('removeSportUserAssociation', $user->id) }}",
                    data    :   {
                        "sport_id"  :   sport_id,
                        "_token"    :   "{{ csrf_token() }}"
                    },
                    success :   function(data){
                        //console.log(data);
                        location.reload();
                    }
                });
            }
        });
        $(".addpsorts").on('click', function(){
            $.ajax({
                type : "GET",
                url  : "{{ route('getUnAssociatedSports', $user->id) }}",
                success : function(data){
                    console.log(data.status);
                    $("#add_sports_ids").html();
                    if(data.status == 1){
                        $("#add_sports_ids").html("");

                        $.each(data.data, function(i,value){
                            $("#add_sports_ids").append("<option value='"+i+"'>"+value.sport_name+"</option>");
                        });
                        $("#addpsortsModal").modal('toggle');

                    }else{
                        alert("No sports available to associate "); 
                    }
                    
                }
            });
        });
        $(".uploadidproof").on('click', function(){
            $("#idProofModal").modal('toggle');
        });

    </script>

@endsection
@section('content')
    <div class="row">      
        <div class="col-lg-8 order-2 order-sm-1 grid-margin stretch-card">
            <div class="card">
              <div class="card-body">
                <h4 class="card-title">
                    {{ $user->fname." ".$user->lname }}'s Profile 
                    @if(\Auth::user()->is_superuser || (\Auth::user()->role_id == 1 && \Auth::user()->club_id == $user->club_id ))
                        <a href="{{ route('editOneProfile', $user->id) }}" class="btn btn-primary float-right btn-sm"><i class="fa fa-pencil"></i></a>
                    @endif
                </h4>
                <div class="table-responsive">
                <table class="table table-striped">             
                    <tbody>
                        <tr>
                            <th>Name</th>
                            <td>{{ $user->fname." ".$user->lname }}</td>
                        </tr>
                         @if(\Auth::user()->is_superuser || $user->club_id == \Auth::user()->club_id)
                        <tr>
                            <th>Contact <br> Details</th>
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
                            <td>
                                @if(\Auth::user()->is_superuser) 
                                    <a href="{{ route('clubDetail', $user->club_id) }}"> {{ $user->club->club_name }} </a>
                                @else 
                                    {{ $user->club->club_name }}
                                @endif
                            </td>
                        </tr> 
                        <tr>
                            <th>Role</th>
                            <td>{{ $user->role->role_name }}</td>
                        </tr>
                        @if($user->sports)
                            <tr>
                                <th>Sports</th>
                                <td>
                                    @if(\Auth::user()->is_superuser || (\Auth::user()->role_id == 1 && \Auth::user()->club_id == $user->club_id ))
                                        <button class="btn btn-sm btn-success float-right addpsorts"><i class="fa fa-plus"></i></button>
                                        <br><br>
                                    @endif
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
                                            <button data-sport_id="{{ $sport->id }}" class="btn btn-sm btn-danger float-right delete-sport-user" title="Delete Sports"><i class="fa fa-times"></i></button>
                                             <a href="{{ route('addcoachtoplayer',array($sport->id,$user->id)) }}" class="btn btn-primary btn-sm float-right" title="Edit" title="Assign/Remove Coach"><i class="mdi mdi-pencil"></i></a>

                                        @endif
                                        <hr>
                                    @endforeach
                                </td>
                            </tr>
                        @endif
                        @if(\Auth::user()->is_superuser || ($user->club_id == \Auth::user()->club_id && \Auth::user()->role_id == 1))
                            <tr>
                                <th>ID Proof</th>
                                <td>
                                    @if( $user->id_proof !='')
                                        <a href="{{ url('images/'.$user->id_proof_pic) }}" target="_blank">{{ $user->id_proof }}</a>
                                    @else
                                        <button class="btn btn-outline-danger btn-icon-text uploadidproof">Upload</button>
                                    @endif
                                </td>
                            </tr> 
                            <tr>
                            <th>Emergency <br> Details</th>
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
                @if($user->role_id == 2 && $user->club_id == \Auth::user()->club_id && (\Auth::user()->role_id==1 || \Auth::user()->role_id==10) )

                @endif
              </div>
            </div>

        </div>
        <div class="col-md-4 order-1 order-sm-2">
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
                    @if(\Auth::user()->is_superuser || ( \Auth::user()->club_id == $user->club_id && (\Auth::user()->role_id ==1 || \Auth::user()->club_id ==10)) )
                        <div class="table-responsive">
                            <table class="table">
                                @if($user->role_id ==2)
                                <tr>
                                    <th colspan="2"><span class="text-primary"> &#x20B9; <?= $user->advance_amount; ?> </span></th>
                                </tr>
                                @endif
                                <tr>
                                    <th>User Status</th>
                                    <td>    {{ $user->is_active == 1 ? 'Active' : 'Deactive' }} </td>
                                </tr>
                                <tr>
                                    <td colspan="2" class="text-center">
                                        <a href="{{ route('changeuserstatus',$user->id) }}" class="btn btn-rounded btn-dark btn-sm changepic">{{ $user->is_active == 0 ? 'Activate' : 'Deactivate' }} User</a>
                                    </td>
                                </tr>
                                @if($user->role_id == 2)
                                <tr>
                                    <th colspan="2">
                                        <a href="/user/payment/{{ $user->id }}/{{ date('m') }}/{{ date('Y') }}" class="btn btn-rounded btn-sm btn-info">Add Invoice</a>

                                    </th>
                                </tr>
                                <tr>
                                    <th colspan="2">
                                        <button class="btn btn-rounded btn-sm btn-info view_invoices">Show Invoices</button>
                                        <div class="modal fade" id="invoices_modal" tabindex="-1" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content ">
                                                    <h3 class="modal-title">Invoices for {{ $user->fname." ". $user->lname }}</h3>
                                                    <div class="list-group invoices-list">
                                                        
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </th>
                                </tr>
                                <tr>
                                    <th colspan="2">
                                        <a href="{{ route('recordpayment',$user->id) }}" class="btn btn-rounded btn-sm btn-info">Record Payment</a>
                                    </th>
                                </tr>
                                <tr>
                                    <th colspan="2">
                                        <a href="{{ route('showreceivedpayment',$user->id) }}" class="btn btn-rounded btn-sm btn-info">Show Received Payment</a>
                                    </th>
                                </tr>
                                @elseif(\Auth::user()->is_superuser && $user->role_id == 10)
                                    <tr>
                                        <th colspan="2">
                                            <a href="{{ route('getOneCoachRevenue',[$user->id, date('m'), date('Y')] ) }}" class="btn btn-rounded btn-sm btn-info">Revenue Generated</a>
                                        </th>
                                    </tr>
                                @endif
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
        <div class="modal fade" id="addpsortsModal" tabindex="-1" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <form action="{{ route('storeUnAssociatedSports', $user->id) }}" method="post" enctype="multipart/form-data">
                    <div class="modal-header">
                        <h5 class="modal-title" id="ModalLabel">Change Pic</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        @csrf
                        <div class="form-group">
                            <label for="recipient-name" class="col-form-label">Select Sports:</label>
                            <select class="form-control" id='add_sports_ids' name="add_sports_ids[]" multiple>
                                
                            </select>
                        </div>                      
                     </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success">Submit
                        </button>
                        <button type="button" class="btn btn-light" data-dismiss="modal">Close</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
      
      
    </div>

    <div class="modal fade" id="idProofModal" tabindex="-1" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form action="{{ route('storeuseridproof', $user->id) }}" method="post" enctype="multipart/form-data">
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