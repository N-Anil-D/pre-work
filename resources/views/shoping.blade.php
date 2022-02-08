@extends('layouts.app')
<!-- @section('title') -->
<!-- @section('css') -->
<!-- <link href="{{asset('backoffice/assets/plugins/datatable/dataTables.bootstrap4.min.css')}}" rel="stylesheet">
<link href="{{asset('backoffice/assets/plugins/datatable/responsivebootstrap4.min.css')}}" rel="stylesheet">
<link href="{{asset('backoffice/assets/plugins/datatable/fileexport/buttons.bootstrap4.min.css')}}"> -->
<!---Sweet-Alert css-->
<!-- <link href="{{asset('backoffice/assets/plugins/sweet-alert/sweetalert.css')}}" rel="stylesheet"> -->
<!---Ion.rangeslider css-->
<!-- <link href="{{asset('backoffice/assets/plugins/ion-rangeslider/css/ion.rangeSlider.css')}}" rel="stylesheet">
<link href="{{asset('backoffice/assets/plugins/ion-rangeslider/css/ion.rangeSlider.skinFlat.css')}}" rel="stylesheet"> -->

<style type="text/css">
	.green {
		color: #03c895;
	}

	.red {
		color: #ff473d;
	}

	.orange {
		color: #eb6f33;
	}

	.border-green {
		border-color: #03c895 !important;
	}

	.border-red {
		border-color: #ff473d !important;
	}

	.transferAmountShow {
		color: #8760fb;
	}

	.packageTransferAmountShow {
		color: #8760fb;
	}

	.no-js #loader {
		display: none;
	}

	.js #loader {
		display: block;
		position: absolute;
		left: 100px;
		top: 0;
	}

	.se-pre-con {
		display: none;
		position: fixed;
		left: 0px;
		top: 0px;
		width: 100%;
		height: 100%;
		z-index: 9999;
		/* background: url('https://backoffice.weecoins.org/backoffice/hourglass.gif') center no-repeat #fff; */
	}
</style>
@endsection
@section('content')
<!-- Page Header -->
<div class="page-header">
	<div>
		<h2 class="main-content-title text-primary tx-24 mg-b-5">Weecoins Shop</h2>
		<ol class="breadcrumb">
			<li class="breadcrumb-item"><a href="#">Weecoins Lisanslı ürünlerini bakiyeniz ile satın alabilirsiniz.</a></li>

		</ol>
	</div>
	<div class="btn btn-list">
		<a class="btn ripple btn-secondary" href="#"><i class="fas fa-wallet"></i> Bakiye:{{ (int) $avaliable_balance }} WCS</a>


	</div>
</div>
<!-- End Page Header -->
<!-- Row -->
<div class="row">
	<div class="col-md-8 col-lg-12">
		<div class="row">
			@foreach($product as $product)
			<div class="col-sm-6 col-lg-3">
				<div class="card item-card custom-card">

					<div class="card-body h-100">
						<div class="product h-100">
							<div class="text-center product-img">
								<img src="{{ $product->path }}" alt="img" class="img-fluid">
							</div>
							<div class="text-center mt-4">
								<div class="text-center text-warning fs-12">
									<i class="fa fa-star"></i>
									<i class="fa fa-star"></i>
									<i class="fa fa-star"></i>
									<i class="fa fa-star"></i>
									<i class="fa fa-star"></i>
								</div>
								<h6 class="mb-0 mt-2">{{ $product->name }}</h6>
								<div class="price mt-2 h5 mb-0">
									<h4 class="mb-0 mt-2 text-secondary">{{ $product->price_wcs }} WCS</h4>
								</div>
							</div>
							<div class="product-info">
								<button class="btn ripple  btn-secondary text-white satin_al" data-toggle="tooltip" data-placement="bottom" value="{{$product->id}}" title="Satın Al">
									Satın Al
								</button>
							</div>
						</div>
					</div>
				</div>
			</div>
			@endforeach
		</div>
	</div>

</div>


<div class="container">
	<!-- Modal -->
	<div class="modal" id="myModal" role="dialog">
		<div class="modal-dialog modal-dialog-centered" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title"></h4>
					<button type="button" class="close" data-dismiss="modal">&times;</button>
				</div>
				<div id="success_message"></div>
				<div class="modal-body" id="note">
					<label>{{ 'Satın al' }} :</label>
					<!-- <label>{{ __("backoffice/wallet.confirmation_code") }} :</label> -->
					<input type="text" name="code" id="code" placeholder="{{ 'WCS miktarı giriniz' }}">
					<p>{{ '' }} </p>
					<!-- <p>{{ __("backoffice/wallet.confirmation_text") }} </p> -->
					<p class="text-warning">{{ '' }} </p>
					<!-- <p class="text-warning">{{ __("backoffice/wallet.infotime") }} </p> -->
					<select id="locationSelect" class="form-select" name="locationSelect">
						<option selected disabled value="0">Adres Seçiniz</option>
						@foreach($locations as $location)
							<option value="{{$location->id}}">{{$location->country.'/'.$location->city.'/'.$location->location}}</option>
						@endforeach
					</select>

				</div>
				<div class="modal-footer modal_taban">
					<button class="btn ripple btn-primary buy" id="confirmModal" value="" type="button">{{ 'Satın Al' }}</button>
					<!-- <button class="btn ripple btn-primary" id="confirmModal" type="button">{{ __("backoffice/wallet.approve") }}</button> -->
					<button class="btn ripple btn-secondary" data-dismiss="modal" type="button">{{ 'Vazgeç' }}</button>
					<!-- <button class="btn ripple btn-secondary closeModal" onclick="closeModal()" data-dismiss="modal" type="button">{{ __("backoffice/wallet.close") }}</button> -->
				</div>
				<div class="alert alert-info" role="alert" id="siparislerime_git">
					<p>Satın alım ayrıntılarınızı görmek için : <a href="{{route('all.orders')}}">Siparişlerim</a></p>
				</div>
			</div>

		</div>
	</div>
</div>

@endsection

@section('scripts')

<script>
	$(document).on('click', '.satin_al', function(e) {
		e.preventDefault();
		$('#code').val("");
		$('#note').show();
		$('.modal_taban').show();
		$('#confirmModal').show();
		$('#siparislerime_git').hide();
		$('#myModal').modal('show');
		$('#success_message').removeClass()
		$('#success_message').text("");
        var urun_id = $(this).val();
		// console.log(urun_id);
		$('#confirmModal').val(urun_id);

	});

	$(document).on('click', '.buy', function(e) {
		e.preventDefault();

		var data = {
			'demand': $('#code').val(),
			'uye_id': {{Auth::user()->id}},
			'cripto_id':$(this).val(),
			'user_location_id':$('#locationSelect').val()
		}
		// console.log(data);
		$.ajaxSetup({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			}
		});

		$.ajax({
			type: "POST",
			url: "/buy",
			data: data,
			dataType: "json",
			success: function(response) {
				console.log(response.status);
				if (response.status == 400) {
					$('#note').hide();
					$('#confirmModal').hide();
					$('#success_message').addClass("alert alert-danger");
					$('#success_message').text("Satın alma işleminiz başarısız oldu.");
					$('#code').val("");
				}
				if (response.status == 200) {
					$('#note').hide();
					$('#success_message').addClass("alert alert-success");
					$('#success_message').text("Satın alma işleminiz başarıyla tamamlandı.");
					$('#code').val("");
					$('.modal_taban').slideUp(500);
					$('#siparislerime_git').show(500);
				}
			}
		});
	});
</script>
@endsection