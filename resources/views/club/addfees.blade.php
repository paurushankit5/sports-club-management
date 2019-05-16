@extends('layouts.all')

@section('title' , 'Setup Fees Structure')

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
        <form method="post" action="{{ route('fees.store') }}">
        <div class="row">
            <div class="col-md-4 offset-md-4">
                <div class="card">
                    <div class="card-body">
                        <label>Select Sport*</label>
                        <select class="form-control" name="sport_id" required>
                            <option value="">Select a game</option> 
                            @php
                                if(count(\Auth::user()->club->sports))
                                {
                                    foreach(\Auth::user()->club->sports as $sport)
                                    {
                                        @endphp
                                            <option value="{{ $sport->id }}">{{ $sport->sport_name }}</option>
                                        @php
                                    }
                                }
                            @endphp
                        </select>
                    </div>
                </div>
            </div>
        </div>
        <br>
        <br>
        <br>
        <div class="card">
          <div class="card-body">
            
                @csrf
                <div class="table-responsive">
                    <INPUT type="button" class="btn btn-primary" value="Add More Category" onclick="addRow('dataTable')" />
                    <INPUT type="button" class="btn btn-danger" value="Remove Category"   onclick="deleteRow('dataTable')" />
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
                              <tbody id="dataTable">            
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
          </div>
        </div>
        </form>
      </div>
    </div>
@endsection
