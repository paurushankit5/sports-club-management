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
                            <th>Month</th>
                            <th>Amount</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if(count($invoices))
                            @php $i =1 ; @endphp
                            @foreach($invoices as $invoice)
                                <tr>
                                    <td>{{ $i++ }}</td>
                                    <td>
                                        <a href="{{ route('downloadInvoice', [$user->id, $invoice->month, $invoice->year]) }}" target="_blank">
                                            {{ date('M-Y', strtotime("01-".$invoice->month."-".$invoice->year) ) }}
                                        </a>
                                    </td>
                                    <td> <b>&#x20B9; {{ $invoice->total_amount }} </b> </td>
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