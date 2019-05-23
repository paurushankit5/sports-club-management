@extends('layouts.all')

@section('title' ,$user->fname." ".$user->lname ."'s Profile")

@section('page_header' ,$user->fname." ".$user->lname ."'s Profile")



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
            })
        })
    </script>
@endsection
@section('content')
    <div class="row">      
        <div class="col-lg-8 order-2 order-sm-1 grid-margin stretch-card">
            <div class="card">
              <div class="card-body">
                <h4 class="card-title">{{ $user->fname." ".$user->lname }}'s Profile</h4>
                <div class="table-responsive">
                <table class="table table-striped">             
                    <tbody>
                        <tr>
                            <th>Name</th>
                            <td>{{ $user->fname." ".$user->lname }}</td>
                        </tr>
                         @if($user->club_id == \Auth::user()->club_id)
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
                    @if(\Auth::user()->club_id == $user->club_id && (\Auth::user()->role_id ==1 || \Auth::user()->club_id ==10) )
                        <div class="table-responsive">
                            <table class="table">
                                <tr>
                                    <th colspan="2"><span class="text-primary"> &#x20B9; <?= $user->advance_amount; ?> </span></th>
                                </tr>
                                <tr>
                                    <th>User Status</th>
                                    <td>    {{ $user->is_active == 1 ? 'Active' : 'Deactive' }} </td>
                                </tr>
                                <tr>
                                    <td colspan="2" class="text-center">
                                        <a href="{{ route('changeuserstatus',$user->id) }}" class="btn btn-rounded btn-dark btn-sm changepic">{{ $user->is_active == 0 ? 'Activate' : 'Deactivate' }} User</a>
                                    </td>
                                </tr>
                                <tr>
                                    <th colspan="2">
                                        <a href="/user/payment/{{ $user->id }}/{{ date('m') }}/{{ date('Y') }}" class="btn btn-rounded btn-sm btn-info">Add Invoice</a>

                                    </th>
                                </tr>
                                <tr>
                                    <th colspan="2">
                                        <button class="btn btn-rounded btn-sm btn-info view_invoices">View Invoices</button>
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