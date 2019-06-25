@if($user->role_id == 2)
    <br>
    <br>
    <div class="card ">
        <div class="content text-center">
            <br>
            <h4 class="card-title text-primary">Membership Plan
                @if(((\Auth::user()->role_id == 10 || \Auth::user()->role_id == 1) && \Auth::user()->club_id == $user->club_id)|| \Auth::user()->is_superuser)
                    <button class="btn btn-primary btn-sm pull-right" data-toggle="modal" data-target="#membership_modal" title="Add Membership"><i class="mdi mdi-pencil"></i> </button>
                @endif
            </h4>
            <div class="table-responsive">
                <table class="table">              
                    @if(count($user->sports))
                        @foreach($user->sports as $sport)
                            <tr>
                                <th>{{ $sport->sport_name }}</th>
                                <td>
                                    @if($sport->membership)
                                        {{ $sport->membership->fees->category_name }}<br>
                                        &#x20B9; {{ $sport->membership->fees[$sport->membership->membership_type] }} {{ ucwords($sport->membership->membership_type) }}
                                    @endif
                                </td>
                                 

                            </tr>
                        @endforeach
                    @endif
                </table>
            </div>
        </div>
    </div>
 
    <div class="modal fade" id="membership_modal" tabindex="-1" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <form action="{{ route('storePlayerMembership') }}" method="post">
                <div class="modal-header">
                    <h5 class="modal-title" id="ModalLabel">Membership Plan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="table-responsive">
                        <table class="table table-striped">
                            @if($user->sports!=Null)
                                <input type="hidden" name="user_id" required value="{{ $user->id }}">
                                @foreach($user->sports as $sport)
                                    <tr>
                                        <th colspan="6" class="bg-primary"><h5 class="text text-center text-white">{{ $sport->sport_name }}</h5></th>
                                    </tr>
                                    @if($sport->club_fees!=Null)
                                        <tr>
                                            <th><label>Membership <input type="hidden" value="{{ $sport->id }}" name="sport_ids[]" required /></label></th>
                                            <th><label>Monthly <input
                                                @if(isset($sport->membership->membership_type ) && $sport->membership->membership_type == 'monthly') checked  @endif
                                             type="radio" required name="member_type_{{ $sport->id }}" value="monthly"></label></th>
                                            <th><label>Quarterly <input type="radio"
                                            @if(isset($sport->membership->membership_type ) && $sport->membership->membership_type == 'quarterly') checked  @endif
                                             name="member_type_{{ $sport->id }}" value="quarterly"></label></th>
                                            <th><label>Half-Yearly <input type="radio"
                                            @if(isset($sport->membership->membership_type ) && $sport->membership->membership_type == 'half_yearly') checked  @endif
                                             name="member_type_{{ $sport->id }}" value="half_yearly"></label></th>
                                            <th><label>Yearly <input type="radio"
                                            @if(isset($sport->membership->membership_type ) && $sport->membership->membership_type == 'yearly') checked  @endif
                                             name="member_type_{{ $sport->id }}" value="yearly"></label></th>
                                        </tr>
                                        @if(count($sport->club_fees))
                                        @foreach($sport->club_fees as $club_fee)
                                            <tr>
                                                <td>

                                                    <label>
                                                    {{ $club_fee->category_name }} 
                                                        <input @if(isset($sport->membership->fees->id) && $sport->membership->fees->id == $club_fee->id) checked @endif type="radio"  required name="fee_id_{{ $sport->id }}" value="{{ $club_fee->id }}">
                                                    </label>
                                                </td>
                                                <td>&#x20B9; {{ $club_fee->monthly }}</td>
                                                <td>&#x20B9; {{ $club_fee->quarterly }}</td>
                                                <td>&#x20B9; {{ $club_fee->half_yearly }}</td>
                                                <td>&#x20B9; {{ $club_fee->yearly }}</td>
                                            </tr>
                                        @endforeach
                                        @endif
                                    @endif
                                @endforeach
                            @endif
                        </table>
                    </div>
                    @csrf
                                          
                 </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">
                        <i class="mdi mdi-save btn-icon-prepend"></i> Submit
                    </button>
                    <button type="button" class="btn btn-light" data-dismiss="modal">Close</button>
                </div>
                </form>
            </div>
        </div>
    </div>
    
@endif

