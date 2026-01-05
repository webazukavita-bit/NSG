@extends('admin.layouts.app')
@section('content')

<div class="card radius-10 border-top border-0 border-3 border-primary">
<div class="card-body p-3">
					<h5 class="card-title text-primary">Add New Order</h5>
					   <hr>
            <div class="form-body mt-4">
				<div class="row">
					   <div class=" col-lg-7">
						
                           <div class=" table-responsive border-top border-0 border-3 border-primary">
							        <table id="example" class="table table-striped       table-bordered"        style="width:100%">
								        <thead>
									        <tr>
										        <th>Name</th>
										        <th>Price</th>
										        <th>Discount</th>
										        <th>Qyt.</th>							
										        <th>Action</th>
											</tr>
										</thead>

								                <tbody>
									              <td> <img class=" border rounded-circle border-black" src="{{asset('admin/assets/images/products/01.png')}}" alt="" height="45">Solar</td>
									               <td>100</td>
									               <td>50</td>
									               <td><div class="input-group input-spinner">
									                   <button class="btn btn-white" type="button" id="button-plus">+</button>
								                             <input type="text" class="form-control" value="1">
									                 <button class="btn btn-white" type="button" id="button-minus">−</button>
								                     </div></td>
									                 <td>
										                <div class="d-flex">
												            <span class="order-actions-primary">
													          <i class="bx bx-trash"></i>
												            </span>
												            																							  
											            </div>
									                </td>										
												</tbody>
												
												<tfoot>
													<tr>
														<td>Total</td>
														<td></td>
														<td></td>
														<td></td>
														<td></td>
													</tr>

												</tfoot>
							        </table>
								
						   
						 </div>
					   </div>

					    <div class="col-lg-5">
						    <div class="card border-top border-0 border-4 border-primary">
					        <div class="card-body">
                                <div class="row g-3">								 
								     <div class="col-12">
									        <label for="inputProductType" class="form-label text-primary bold">Product Category</label>
									      <select class="form-select" id="inputProductType">
										      <option></option>
										      <option value="1">One</option>
										      <option value="2">Two</option>
										      <option value="3">Three</option>
									        </select>
								        </div>
							    </div> 
                   {{-- card --}}

             <div class="row mt-4">
					<div class="col-6">
						<div class="card">
							<img src="{{asset('admin/assets/images/products/01.png')}}" class="card-img-top" alt="...">

							<div class="card-body">
								<h6 class=" normal card-title cursor-pointer">Nest Shaped Chair</h6>
								<div class="clearfix">
									<p class="mb-0 float-start"> Price: <strong>134</strong></p>
									<p class="mb-0 float-end fw-bold"><button class="border rounded-circle">+</button></p>
									<p class="mb-0 float-start"> Discount: <strong>134</strong></p>
							    </div>
						    </div>
					    </div>
				    </div>

					<div class="col-6">
						<div class="card">
							<img src="{{asset('admin/assets/images/products/01.png')}}" class="card-img-top" alt="...">

							<div class="card-body">
								<h6 class=" normal card-title cursor-pointer">Nest Shaped Chair</h6>
								<div class="clearfix">
									<p class="mb-0 float-start"> Price: <strong>134</strong></p>
									<p class="mb-0 float-end fw-bold"><button class="border rounded-circle">+</button></p>
									<p class="mb-0 float-start"> Discount: <strong>134</strong></p>
							    </div>
						    </div>
					    </div>
				    </div>
					<div class="col-6">
						<div class="card">
							<img src="{{asset('admin/assets/images/products/01.png')}}" class="card-img-top" alt="...">

							<div class="card-body">
								<h6 class=" normal card-title cursor-pointer">Nest Shaped Chair</h6>
								<div class="clearfix">
									<p class="mb-0 float-start"> Price: <strong>134</strong></p>
									<p class="mb-0 float-end fw-bold"><button class="border rounded-circle">+</button></p>
									<p class="mb-0 float-start"> Discount: <strong>134</strong></p>
							    </div>
						    </div>
					    </div>
				    </div>
					<div class="col-6">
						<div class="card">
							<img src="{{asset('admin/assets/images/products/01.png')}}" class="card-img-top" alt="...">

							<div class="card-body">
								<h6 class=" normal card-title cursor-pointer">Nest Shaped Chair</h6>
								<div class="clearfix">
									<p class="mb-0 float-start"> Price: <strong>134</strong></p>
									<p class="mb-0 float-end fw-bold"><button class="border rounded-circle">+</button></p>
									<p class="mb-0 float-start"> Discount: <strong>134</strong></p>
							    </div>
						    </div>
					    </div>
				    </div>
					<div class="col-6">
						<div class="card">
							<img src="{{asset('admin/assets/images/products/01.png')}}" class="card-img-top" alt="...">

							<div class="card-body">
								<h6 class=" normal card-title cursor-pointer">Nest Shaped Chair</h6>
								<div class="clearfix">
									<p class="mb-0 float-start"> Price: <strong>134</strong></p>
									<p class="mb-0 float-end fw-bold"><button class="border rounded-circle">+</button></p>
									<p class="mb-0 float-start"> Discount: <strong>134</strong></p>
							    </div>
						    </div>
					    </div>
				    </div>
					<div class="col-6">
						<div class="card">
							<img src="{{asset('admin/assets/images/products/01.png')}}" class="card-img-top" alt="...">

							<div class="card-body">
								<h6 class=" normal card-title cursor-pointer">Nest Shaped Chair</h6>
								<div class="clearfix">
									<p class="mb-0 float-start"> Price: <strong>134</strong></p>
									<p class="mb-0 float-end fw-bold"><button class="border rounded-circle">+</button></p>
									<p class="mb-0 float-start"> Discount: <strong>134</strong></p>
							    </div>
						    </div>
					    </div>
				    </div>
					<div class="col-6">
						<div class="card">
							<img src="{{asset('admin/assets/images/products/01.png')}}" class="card-img-top" alt="...">

							<div class="card-body">
								<h6 class=" normal card-title cursor-pointer">Nest Shaped Chair</h6>
								<div class="clearfix">
									<p class="mb-0 float-start"> Price: <strong>134</strong></p>
									<p class="mb-0 float-end fw-bold"><button class="border rounded-circle">+</button></p>
									<p class="mb-0 float-start"> Discount: <strong>134</strong></p>
							    </div>
						    </div>
					    </div>
				    </div>
					<div class="col-6">
						<div class="card">
							<img src="{{asset('admin/assets/images/products/01.png')}}" class="card-img-top" alt="...">

							<div class="card-body">
								<h6 class=" normal card-title cursor-pointer">Nest Shaped Chair</h6>
								<div class="clearfix">
									<p class="mb-0 float-start"> Price: <strong>134</strong></p>
									<p class="mb-0 float-end fw-bold"><button class="border rounded-circle">+</button></p>
									<p class="mb-0 float-start"> Discount: <strong>134</strong></p>
							    </div>
						    </div>
					    </div>
				    </div>
					<div class="col-6">
						<div class="card">
							<img src="{{asset('admin/assets/images/products/01.png')}}" class="card-img-top" alt="...">

							<div class="card-body">
								<h6 class=" normal card-title cursor-pointer">Nest Shaped Chair</h6>
								<div class="clearfix">
									<p class="mb-0 float-start"> Price: <strong>134</strong></p>
									<p class="mb-0 float-end fw-bold"><button class="border rounded-circle">+</button></p>
									<p class="mb-0 float-start"> Discount: <strong>134</strong></p>
							    </div>
						    </div>
					    </div>
				    </div>
					<div class="col-6">
						<div class="card">
							<img src="{{asset('admin/assets/images/products/01.png')}}" class="card-img-top" alt="...">

							<div class="card-body">
								<h6 class=" normal card-title cursor-pointer">Nest Shaped Chair</h6>
								<div class="clearfix">
									<p class="mb-0 float-start"> Price: <strong>134</strong></p>
									<p class="mb-0 float-end fw-bold"><button class="border rounded-circle">+</button></p>
									<p class="mb-0 float-start"> Discount: <strong>134</strong></p>
							    </div>
						    </div>
					    </div>
				    </div>
				</div>
  
                   {{-- card --}}
				</div>
			   </div>
				 </div>

			    </div><!--end row-->
		    </div>

   <div class="form-body">
	<div class="row">
		<div class="col-12 text-center">
			
   </div>

</div>

</div>


@endsection






