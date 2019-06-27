@extends('layouts.all')

@section('title' , $club->club_name)

@section('page_header' , $club->club_name)


@section('after_scripts')
    <script type="text/javascript">
        $("#associate_sports").on('click',function(){
            $.ajax({
                type    : 'GET',
                url     :   "{{ route('getClubUnassociatedSports',$club->id) }}",
                success     :   function(data){
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
        $(".delete-sport-user").on('click', function(){
            var r = confirm("Do you really want to remove this game from the user?");
            if(r){
                var sport_id = $(this).attr('data-sport_id');
                $.ajax({
                    type    : 'POST',
                    url     :  "{{ route('removeSportClubAssociation', $club->id) }}",
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
    </script>
@endsection

@section('content')
     <div class="row">
      <div class="col-12 grid-margin">
        <div class="card">
          <div class="card-body">
            <h4 class="card-title">{{ $club->club_name }}
                <span class="pull-right">
                
                <a href="{{ route('revenue_module', array(date('m'), date('Y'), $club->id )) }}" class="btn btn-sm btn-gradient-primary ">Revenue</a>
                &nbsp;
                <a href="{{ route('admin.fees', $club->id) }}" class="btn btn-sm btn-gradient-primary ">Fees Structure</a>
                &nbsp;
                <a href="{{ route('clubs.createUser', $club->id) }}" class="btn btn-sm btn-gradient-primary">+ Add Users</a>
                </span>
            </h4>
             	<div class="table table-responsive">
             		<table class="table">
                        <tr>
                            <th>Name</th>
                            <th>{{ $club->club_name }}</th>
                        </tr>
                        <tr>
                            <th>Email</th>
                            <th>
                                {{ $club->email }}<br>
                                {{$club->alternate_email}}
                            </th>
                        </tr>
                        <tr>
                            <th>Contact Details</th>
                            <th>
                                {{ $club->contact_fname }} {{ $club->contact_lname }}  <br>
                                {{ $club->mobile }}<br>
                                {{$club->alternate_mobile}}
                            </th>
                        </tr>
                        <tr> 
                            <th>Sports</th>
                            <th>
                                <span class="pull-right">
                                    <button class="btn btn-primary btn-sm" id="associate_sports"><i class="fa fa-plus"></i> Sports</button>
                                </span>
                                <br>
                                <br>
                                @if(count($club->sports))
                                    @foreach($club->sports as $sport)
                                        {{ $sport->sport_name }}  <button data-sport_id="{{ $sport->id }}" class="btn btn-sm btn-danger float-right delete-sport-user" title="Delete Sports"><i class="fa fa-times"></i></button>
                                             
                                             <br>
                                             <br>
                                    @endforeach
                                @endif
                            </th>
                        </tr>
                        <tr>
                            <th>Address</th>
                            <th>
                                {{ $club->adl1 }}<br>
                                {{ $club->adl2 }}<br>
                                {{ $club->city }} 
                                {{ $club->state }} 
                                {{ $club->country }} 
                                {{ $club->pin }} 
                            </th>
                        </tr>
                        <tr>
                            <th>Late Fees</th>
                            <th> &#x20B9; {{ $club->late_fees }} </th>
                        </tr>
                        <tr>
                            <th>GST No</th>
                            <th>{{ $club->gst_no }} </th>
                        </tr>
                        <tr>
                            <th>Establishment Year</th>
                            <th>{{ $club->establishment_year }} </th>
                        </tr>   
                        <tr>
                            <th colspan="2">
                                About Organization: <br> {{ $club->about_club }}
                            </th>
                        </tr>
             			<tr>
             				<th>Name</th>
             				<th>Action</th>
             			</tr>
             			@if(count($club->users))
             				@foreach($club->users as $user)
             					<tr>
	             					<td>
	             						<a href="{{ route('getoneuserprofile', $user->id) }}">{{$user->fname." ".$user->lname}}</a>
	             						<br>({{ $user->role->role_name }})
	             					</td>
	             					<td>
	             						<!-- <a href="{{ route('loginAsUser', $user->id) }}" class="btn btn-primary">Login</a> -->
	             					</td>
	             				</tr>
             				@endforeach
             			@endif
             		</table>
             	</div>
              
          </div>
        </div>
      </div>
    </div>
    <div class="modal fade" id="addpsortsModal" tabindex="-1" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
          <div class="modal-content">
              <form action="{{ route('storeUnAssociatedSportsToClub', $user->club->id) }}" method="post" enctype="multipart/form-data">
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
@endsection
