@extends('layouts.all')

@section('title' ,"Payment  from ".$user->fname." ".$user->lname)

@section('page_header' ,"Payment Received from ".$user->fname." ".$user->lname)



@section('after_scripts')

@endsection
@section('content')
    <div class="row">      
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
              <div class="card-body">
                <h4 class="card-title">Payment Received from {{ $user->fname." ".$user->lname }}</h4>
                 	<div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <th>#</th>
                                <th>Amount</th>
                                <th>Date</th>
                                <th>Remarks</th>
                            </thead>
                            <tbody>
                                @if(count($user->recordpayments))
                                    @php
                                        $i=1;
                                    @endphp
                                    @foreach($user->recordpayments as $recordpayment)
                                        <tr>
                                            <td>{{ $i++ }}</td>
                                            <td>&#x20B9; {{ $recordpayment->payment_received }}</td>
                                            <td>{{ $recordpayment->payment_date }}</td>
                                            <td>{{ $recordpayment->notes }}</td>
                                        </tr>
                                    @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>
              </div>
            </div>

        </div>
         
      
      
      
    </div>

     

    
@endsection