<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
  <style type="text/css">
  	body{
  		padding: 10px;
  	}
  	.card{
  		width: 30%;
  		font-size:10px;
  		white-space: nowrap; 
		overflow: hidden;
		text-overflow: ellipsis; 
  		/*height:264px;*/
  	}
  	tr{
  		line-height: 10px;
  	}
  	.card-header{
  		height: 50px;
  	}

  	.club-logo{
  		height: 60px;
  	}
  	.header{
  		border-bottom:.5px solid gray;
  		margin: 0px;
  	}
  	.card-body{
  		padding: 0px;
  	}
  	.img-div{
  		width: 100%;
	    border: 0.5px solid gray;
	    height: auto;
	    padding: 2px;
	    margin-top: -.75rem;
	    margin-bottom: -.75rem;
  	}
  	.member-logo{
  		width: 100%;
  		height: 106px;
  	}
  	.table{
  		margin-bottom: 0px;
  	}
  	.table1{
  		margin-bottom: 0px;
  		border-bottom: 0.5px solid gray;
  	}
  	th:nth-child(odd){
  		font-weight: initial;
  	}
  	.input-group-text{
  		font-size: 10px;
  	}
  	.input-group-text{
  		background: none;
    	padding-left: 5px;
    	padding-right: 5px;
  	}
  	.form-control{
  		font-size:10px;
  	}
  </style>
</head>
<body>
 
<div class="container-fluid">
  <div class="card">
    <div class="card-body">
    	<div class="row header">
	  		<div class="col-6">
          @if($user->club && $user->club->logo)
	  			  <img src="{{ asset('images/'.$user->club->logo) }}" class="club-logo">
          @endif
	  		</div>
	  		<div class="col-6" style="padding-top: 10px;">
	  			<div class="input-group">
				    <div class="input-group-prepend">
				      	<div class="input-group-text" id="btnGroupAddon">Branch</div>
				    </div>
				    <input type="text" class="form-control"/>
				</div>
	  		</div>
  		</div>
  		<div class="row">
  			<div class="col-12">
	  			<table class="table">
		      		<tr>
		      			<th style="width: 106px;">Name</th>
		      			<th colspan="2">{{ $user->getFullName() }}</th>
		      		</tr>
	      		</table>
      		</div>
  		</div>
  		<div class="row">
  			<div class="col-md-7">
  				<table class="table">
      				<tr>
		      			<th>MID</th>
		      			<th>Paurush Ankit  </th>
		      		</tr>
		      		<tr>
		      			<th>Membership</th>
		      			<th>{{ $user->id }}</th>
		      		</tr>
		      		<tr>
		      			<th>Validity</th>
		      			<th>Paurush Ankit</th>
		      		</tr>
      			</table>
  			</div>
  			<div class="col-md-5">
  				<div class="img-div">
            @if($user->profile_pic)

      				<img src="{{ asset('images/22781561206434.jpg') }}" class="member-logo">
            @else
              <img src="{{ asset('noprofilepic.png') }}" class="member-logo">
            @endif
      			</div>
  			</div>
  		</div>
      	<table class="table1 table">
      		<tr>
      			<th>Remark</th>
      			<th></th>
      		</tr>
      	</table>
      	<div class="row">
      		<div class="col-12">
      			<span class="float-right" style="padding: 10px">Powered By MSC</span>
			</div>
      	</div>
    </div>
  </div>
  <br>
  
  
</div>

</body>
</html>
