@extends('admin.layouts.app')
@section('content')
<div class="card">
					<div class="card-body">
						<div id="invoice">
							<div class="toolbar hidden-print">
								<div class="text-end">
									<button type="button" class="btn btn-dark"><i class="fa fa-print"></i> Print</button>
									<button type="button" class="btn btn-danger"><i class="fa fa-file-pdf-o"></i> Export as PDF</button>
								</div>
								<hr>
							</div>
							<div class="invoice overflow-auto">
								<div style="min-width: 600px">
									<header>
										<div class="row">
											<div class="col">
												<a href="javascript:;">
													<img src="{{asset('assets/images/logo.svg')}}" width="100" alt="">
												</a>
											</div>
											<div class="col company-details">
												<h2 class="name">
									<a target="_blank" href="javascript:;">
									Arboshiki
									</a>
								</h2>
												<div>455 Foggy Heights, AZ 85004, US</div>
												<div>(123) 456-789</div>
												<div>company@example.com</div>
											</div>
										</div>
									</header>
									<main>
										<div class="row contacts">
											<div class="col invoice-to">
												<div class="text-gray-light">INVOICE TO:</div>
												<h2 class="to">{{$order->user->name}}</h2>
												<div class="address">{{ $address['type'] ?? '' }}
                                                    {{ $address['street'] ?? '' }},
                                                    {{ $address['city_name'] ?? '' }},
                                                    {{ $address['state_name'] ?? '' }},
                                                    {{ $address['country_name'] ?? '' }} - 
                                                    {{ $address['zip'] ?? '' }}
                                                </div>
												<div class="email"><a href="mailto:john@example.com">{{$user->email}}</a>
												</div>
											</div>
											<div class="col invoice-details">
												<h1 class="invoice-id">INVOICE{{$order->id}}</h1>
												<div class="date">Date of Invoice:{{ now()->format('d M Y, h:i A') }}</div>
												<div class="date">Due Date: 30/10/2018</div>
											</div>
										</div>
										<table>
											<thead>
												<tr>
                                                    <td>#</td>
													<th class="text-left">NAME</th>
													<th class="text-right"> PRICE</th>
													<th class="text-right">DISCOUNT</th>
													<th class="text-right">QUANTITY</th>
													<th class="text-right">TOTAL</th>
												</tr>
											</thead>
											<tbody>
												@foreach ($products as $index => $product)
                                            <tr>
                                               <td>{{ $index + 1 }}</td>
                                            <td class="text-left">
                                               <h4>{{ $product['name'] }}</h4>
                                               <small>SKU: {{ $product['sku'] }}</small><br>
                                               <small>Brand: {{ $product['brand_name'] }}</small>
                                            </td>
                                            <td class="text-right">₹{{ number_format($product['price'], 2) }}</td>
                                            <td class="text-right">₹{{ number_format($product['disc_price'], 2) }}</td>
                                            <td class="text-right">{{ $product['quantity'] }}</td>
                                            <td class="text-right">
                                             ₹{{number_format($product['price'] * $product['quantity']) }}
                                           </td>
                                            </tr>
                                           @endforeach
										
											</tbody>
											<tfoot>
												<tr>
													<td colspan="2"></td>
													<td colspan="2">SUBTOTAL</td>
													<td>₹{{ number_format($subTotal) }}</td>
												</tr>
												<tr>
													<td colspan="2"></td>
													<td colspan="2">TAX</td>
													<td>{{$order['order_tax']}}</td>
												</tr>
												<tr>
													<td colspan="2"></td>
													<td colspan="2">GRAND TOTAL</td>
													<td>{{($subTotal)+$order['order_tax']}}</td>
												</tr>
											</tfoot>
										</table>
										<div class="thanks">Thank you!</div>
										<div class="notices">
											<div>NOTICE:</div>
											{{-- <div class="notice">A finance charge of 1.5% will be made on unpaid balances after 30 days.</div> --}}
										</div>
									</main>
									<footer>Invoice was created on a computer and is valid without the signature and seal.</footer>
								</div>
								<!--DO NOT DELETE THIS div. IT is responsible for showing footer always at the bottom-->
								<div></div>
							</div>
						</div>
					</div>
				</div>
@endsection
