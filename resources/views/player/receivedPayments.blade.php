@extends('layouts.all')

@section('title' , $user->getFullName().' Invoices')

@section('after_scripts')
    <script type="text/javascript">
      
    </script>
@endsection
@section('content')
    <div class="row">      
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
              <div class="card-body">
                <h4 class="card-title">{!! $user->getFullNameWithAnchor() !!} Invoices</h4>
                <div class="table-responsive">   
                <table class="table table-striped">             
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Payment Date</th>
                            <th>Amount</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if(count($payments))
                            @php $i =1 ; @endphp
                            @foreach($payments as $payment)
                                <tr>
                                    <td>{{ $i++ }}</td>
                                    <td> {{ date('d-M-Y',strtotime($payment->payment_date)) }} </td>
                                    <td> <b>&#x20B9; {{ $payment->payment_received }} </b> </td>
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