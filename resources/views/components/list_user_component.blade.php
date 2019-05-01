@if(count($users))
	<div class="table-responsive">
		<table class="table table-striped">
			<thead>
                <tr>
                  <th> # </th>
                  <th> Organization </th>
                  <th> Contact Details </th>
                  <th> Action </th>
                </tr>
             </thead>
			<tbody>
				@php
	                  $i=1;
	                  if(isset($_GET['page']))
	                  {
	                      $i  =    env('RESULT_LIMIT')*--$_GET['page']+1;   
	                  }

	              @endphp
				@foreach($users as $user)
	                <tr>
	                  	<td>{{ $i++ }}</td>
	                  	<td>
	                    	{{ $user->fname ." ". $user->lname }}
	                    	@if($user->role->role_name != '' ) {!! "<br>(".$user->role->role_name.")" !!}  @endif
	                    </td>
	                   	<td>
	                   		@if($user->email != '' ) {!! $user->email."<br>" !!}  @endif
	                   		@if($user->alternate_email != '' ) {!! $user->alternate_email."<br>" !!}  @endif
	                   		@if($user->mobile != '' ) {!! $user->mobile."<br>" !!}  @endif
	                   		@if($user->alternate_mobile != '' ) {!! $user->alternate_mobile."<br>" !!}  @endif
		                
	                	</td>
	                  	<td>
	                        <a href="{{ route('getoneuserprofile',$user->id) }}" class="btn btn-sm btn-gradient-primary" title="View Details">
	                            <i class="mdi mdi-eye"></i>
	                        </a>

	                        <button type="button" class="btn btn-sm btn-gradient-success " title="Edit Details">
	                            <i class="mdi mdi-pencil"></i>
	                        </button>

	                        <button type="button" class="btn btn-sm btn-gradient-danger " title="Delete">
	                            <i class="mdi mdi-delete"></i>
	                        </button>
	                  	</td>
	                </tr>
	            @endforeach
	            @if(isset($links))
	            	<tr>
	            		<td colspan="4">
	            			{{ $links }}
	            		</td>
	            	</tr>
	            @endif
			</tbody>
		</table>
	</div>
@endif