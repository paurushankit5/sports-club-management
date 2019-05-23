@extends('layouts.all')

@section('title' , 'Coach Dashboard')

@section('page_header' , 'Coach Dashboard')

@section('breadcrumb')
	<li class="breadcrumb-item"><a href="#">Tables</a></li>
	<li class="breadcrumb-item active" aria-current="page">Basic tables</li>
@endsection

@section('content')
	<div class="row">
		<div class="col-md-4 stretch-card grid-margin">
			<div class="card bg-gradient-danger card-img-holder text-white">
				<div class="card-body">
					<img src="{{ asset('admin/svg/circle.svg') }}" class="card-img-absolute" alt="circle-image" />
				   	<h4 class="font-weight-normal mb-3">Monthly Revenue <i class="mdi mdi-chart-line mdi-24px float-right"></i>
					</h4>
					<h2 class="mb-5">&#X20b9; 15,0000</h2>
					<h6 class="card-text">Increased by 60%</h6>
			  	</div>
			</div>
		</div>
		<div class="col-md-4 stretch-card grid-margin">
			<div class="card bg-gradient-info card-img-holder text-white">
			 	<div class="card-body">
					<img src="{{ asset('admin/svg/circle.svg') }}" class="card-img-absolute" alt="circle-image" />
					<h4 class="font-weight-normal mb-3">Total Players <i class="mdi mdi-bookmark-outline mdi-24px float-right"></i>
					</h4>
					<h2 class="mb-5">342</h2>
					<h6 class="card-text">Decreased by 10%</h6>
			  	</div>
			</div>
		</div>
		<div class="col-md-4 stretch-card grid-margin">
			<div class="card bg-gradient-success card-img-holder text-white">
				<div class="card-body">
					<img src="{{ asset('admin/svg/circle.svg') }}" class="card-img-absolute" alt="circle-image" />
					<h4 class="font-weight-normal mb-3">Dummy Data <i class="mdi mdi-diamond mdi-24px float-right"></i>
					</h4>
					<h2 class="mb-5">95,5741</h2>
					<h6 class="card-text">Increased by 5%</h6>
			  	</div>
			</div>
		</div>
	</div>

	<div class="row">
	  	<div class="col-12">
			<div class="card">
		  		<div class="card-body">
					<h4 class="card-title">Recent Sports Club</h4>
					<div class="table-responsive">
			  			<table class="table">
							<thead>
								<tr>
									<th> Organization </th>
									<th> Contact Details </th>
									<th> Players </th>
									<th> Action </th>
								</tr>
							</thead>
							<tbody>
								@for($i=0; $i<5;$i++)
									<tr>								 
										<td> Herman Beck Sports CLub </td>								  
										<td> +91-7531855396 <br> abc@gmail.com </td>
										<td> {{ rand(11,86) }} </td>
								  		<td>
											<a href="#" class="btn btn-primary" title="View"><i class="fa fa-eye"></i></a>
											<a href="#" class="btn btn-success" title="Edit"><i class="fa fa-pencil"></i></a>
											<a href="#" class="btn btn-danger" title="Delete"><i class="fa fa-trash"></i></a>
								  		</td>
									</tr>
								@endfor								
							  </tbody>
						</table>
					</div>
		  		</div>
			</div>
	  	</div>
	</div>

@endsection