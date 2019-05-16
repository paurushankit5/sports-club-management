@if($user->role_id == 2)
    <br>
    <br>
    <div class="card ">
        <div class="content text-center">
            <br>
            <h4 class="card-title text-primary">Membership Plan</h4>
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
                             @if((\Auth::user()->role_id == 10 || \Auth::user()->role_id == 1) && \Auth::user()->club_id == $user->club_id)
                            <td><button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#membership_modal" title="Add Membership"><i class="mdi mdi-plus"></i> </button></td>
                            @endif

                        </tr>
                    @endforeach
                @endif
            </table>
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
                                            <th><label>Monthly <input type="radio" required name="member_type_{{ $sport->id }}" value="monthly"></label></th>
                                            <th><label>Quarterly <input type="radio" name="member_type_{{ $sport->id }}" value="quarterly"></label></th>
                                            <th><label>Half-Yearly <input type="radio" name="member_type_{{ $sport->id }}" value="half_yearly"></label></th>
                                            <th><label>Yearly <input type="radio" name="member_type_{{ $sport->id }}" value="yearly"></label></th>
                                            <th>Late Fees</th>
                                        </tr>
                                        @foreach($sport->club_fees as $club_fee)
                                            <tr>
                                                <td>
                                                    <label>
                                                    {{ $club_fee->category_name }} 
                                                        <input type="radio" required name="fee_id_{{ $sport->id }}" value="{{ $club_fee->id }}">
                                                    </label>
                                                </td>
                                                <td>&#x20B9; {{ $club_fee->monthly }}</td>
                                                <td>&#x20B9; {{ $club_fee->quarterly }}</td>
                                                <td>&#x20B9; {{ $club_fee->half_yearly }}</td>
                                                <td>&#x20B9; {{ $club_fee->yearly }}</td>
                                                <td> {{ $club_fee->late_fine_day }} days <br> &#x20B9; {{ $club_fee->late_fine_amount }}</td>
                                            </tr>
                                        @endforeach
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

