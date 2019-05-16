@extends('layouts.all')

@section('title' , 'Fees Structure')

@section('page_header' , 'Fees Structure')


@section('after_scripts')
  <script type="text/javascript">
    $(document).ready(function(){
        $('[data-toggle="popover"]').popover();  
        $(".align-self-center").click(); 
    });
      function addRow(tableID) {

            var table = document.getElementById(tableID);

            var rowCount = table.rows.length;
            var row = table.insertRow(rowCount);

            var colCount = table.rows[0].cells.length;

            for(var i=0; i<colCount; i++) {

                var newcell = row.insertCell(i);

                newcell.innerHTML = table.rows[0].cells[i].innerHTML;
                //alert(newcell.childNodes);
                switch(newcell.childNodes[0].type) {
                    case "text":
                            newcell.childNodes[0].value = "";
                            break;
                    case "checkbox":
                            newcell.childNodes[0].checked = false;
                            break;
                    case "select-one":
                            newcell.childNodes[0].selectedIndex = 0;
                            break;
                }
            }
        }

        function deleteRow(tableID) {
            try {
            var table = document.getElementById(tableID);
            var rowCount = table.rows.length;

            for(var i=0; i<rowCount; i++) {
                var row = table.rows[i];
                var chkbox = row.cells[0].childNodes[0];
                if(null != chkbox && true == chkbox.checked) {
                    if(rowCount <= 1) {
                        alert("Cannot delete all the rows.");
                        break;
                    }
                    table.deleteRow(i);
                    rowCount--;
                    i--;
                }
            }
            }catch(e) {
                alert(e);
            }
        }

  </script>
@endsection


@section('content')
    <div class="row">
        <div class="col-12 grid-margin">            
            @if(count($sports))
                @foreach($sports as $sport)
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive">
                                <h4 class="card-title">{{ $sport->sport_name }}</h4>                                    
                                    @if(count($sport['fees']))
                                        <table class="table table-striped table-bordered">
                                            <tr>
                                                <th>Category</th>
                                                <th>Monthly</th>
                                                <th>Quarterly</th>
                                                <th>Half-Yearly</th>
                                                <th>Yearly</th>
                                                <th>Late Fees</th>
                                            </tr>
                                            @foreach($sport['fees'] as $fees)
                                                <tr>
                                                    <th>{{ $fees->category_name }}</th>
                                                    <td> &#x20B9; {{ $fees->monthly }}</td>
                                                    <td> &#x20B9; {{ $fees->quarterly }}</td>
                                                    <td> &#x20B9; {{ $fees->half_yearly }}</td>
                                                    <td> &#x20B9; {{ $fees->yearly }}</td>
                                                    <td> After {{$fees->late_fine_day}} days <br> &#x20B9; {{ $fees->late_fine_amount }}</td>
                                                </tr>
                                            @endforeach
                                        </table>
                                    @else
                                        <form method="post" action="{{ route('fees.store') }}">
                                        <input type="hidden" name="sport_id" value={{ $sport->id }}>
                                        @csrf
                                            <div class="table-responsive">
                                                <INPUT type="button" class="btn btn-primary" value="Add More Category" onclick="addRow('dataTable{{$sport->id}}')" />
                                                <INPUT type="button" class="btn btn-danger" value="Remove Category"   onclick="deleteRow('dataTable{{$sport->id}}')" />
                                                    <TABLE    class="table table-striped">
                                                        <thead>
                                                                <tr>
                                                                    <th>#</th>
                                                                    <th style="width:200px;">Category</th>
                                                                    <th>Monthly</th>
                                                                    <th>Quarterly </th>
                                                                    <th>Half-Yearly </th>
                                                                    <th>Yearly</th>
                                                                    <th>Late Fees Day<a href="#"><i class="mdi mdi-information" data-toggle="popover" data-content="This is the last day after which late fees will be added "></i></a></th>
                                                                    <th>Late Fees Amount<a href="#"><i class="mdi mdi-information" data-toggle="popover" data-content="Provide Late fees amount that will be added to the players if he/she does not pay the fees before the prescribed day."></i></a></th>
                                                                </tr>
                                                          </thead>
                                                          <tbody id="dataTable{{$sport->id}}">            
                                                                <tr>
                                                                    <td><INPUT type="checkbox"  name="chk[]"/></td>
                                                                    <td ><input type="text" class="form-control" name="category[]" required value="Standard" ></td>
                                                                    <td><input type="number" class="form-control" name="monthly[]" required ></td>
                                                                    <td><input type="number" class="form-control" name="quarterly[]" required></td>
                                                                    <td><input type="number" class="form-control" name="half_yearly[]" required></td>
                                                                    <td><input type="number" class="form-control" name="yearly[]" required></td>
                                                                    <td><input type="number" class="form-control" value="7" name="late_fees_day[]" required></td>
                                                                    <td><input type="number" class="form-control" name="late_fees[]" required></td>                                      
                                                              </tr>
                                                              <tr>
                                                                    <td><INPUT type="checkbox"  name="chk[]"/></td>
                                                                    <td><input type="text" class="form-control" name="category[]" required value="Advanced"></td>
                                                                    <td><input type="number" class="form-control" name="monthly[]" required ></td>
                                                                    <td><input type="number" class="form-control" name="quarterly[]" required></td>
                                                                    <td><input type="number" class="form-control" name="half_yearly[]" required></td>
                                                                    <td><input type="number" class="form-control" name="yearly[]" required></td>
                                                                    <td><input type="number" class="form-control" name="late_fees_day[]" value="7" required></td>
                                                                    <td><input type="number" class="form-control" name="late_fees[]" required></td>                                      
                                                              </tr>
                                                              
                                                          </tbody>       
                                                    </TABLE>

                                              </div>
                                            <div class="form-group">
                                                <br>
                                                <input type="submit" class="btn btn-primary"/>
                                            </div> 
                                    @endif
                                
                            </div>                            
                        </div>
                    </div>
                    <br>
                            <br>
                            <br>
                @endforeach
            @endif         
                
        </div>
    </div>
@endsection
