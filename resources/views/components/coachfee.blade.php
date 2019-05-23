@if($user->role_id == 10)
    <br>
    <br>
    <div class="card ">
        <div class="content text-center">
            <table class="table">
                
                <tr>
                    <th>Per Session Rate</th>
                    <th>
                        <button class="badge badge-outline-dark">&#x20B9; 
                            @if(!$user->coachFees) 0 @else {{$user->coachFees->session_rate}} @endif
                        </button>
                    </th>
                </tr>
                @if($user->id == \Auth::user()->id || (\Auth::user()->role_id == 1 && \Auth::user()->club_id == $user->club_id))
                    <tr>
                        <th colspan="2"> @if($user->coachFess == null) <button class="btn btn-primary sessionrate">Update Session Rate</button> @endif</th>
                    </tr>
                @endif
            </table>
        </div>
    </div>
    <div class="modal fade" id="sessionratemodal" tabindex="-1" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form action="{{ route('addCoachFees') }}" method="post" enctype="multipart/form-data">
                <div class="modal-header">
                    <h5 class="modal-title" id="ModalLabel">Set Session Rate</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    @csrf
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">Enter Session Rate:</label>
                        <input type="number" required value="{{ $user->coachFees->session_rate }}" class="form-control" name="session_rate">
                        <input type="hidden" required class="form-control" name="id" value="{{ $user->id }}">
                    </div>                      
                 </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">
                        <i class="mdi mdi-ontent-save btn-icon-prepend"></i> Save
                    </button>
                    <button type="button" class="btn btn-light" data-dismiss="modal">Close</button>
                </div>
                </form>
            </div>
        </div>
    </div>
@endif

