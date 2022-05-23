@extends('site.app')
@section('title') {{ $pageTitle }} @endsection
@section('content')
<!-- <style type="text/css">
#mapShow
{
    filter: url('data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg"><filter id="g"><feColorMatrix type="matrix" values="0.3 0.3 0.3 0 0 0.3 0.3 0.3 0 0 0.3 0.3 0.3 0 0 0 0 0 1 0"/></filter></svg>#g');
    -webkit-filter: grayscale(100%);
    filter: grayscale(100%);
    filter: progid:DXImageTransform.Microsoft.BasicImage(grayScale=1);
}
</style> -->

<section class="page-banner" style="background: url({{asset('site/images/banner')}}-image.jpg) no-repeat center center; background-size:cover;">
	<div class="container">
		<div class="page-title">Local Directory</div>
		<div class="page-search-block">
			<div class="row align-items-center justify-content-between">
				<div class="col-sm-auto">
					<ul class="nav nav-tabs" id="myTab" role="tablist">
					  	<li class="nav-item" role="presentation">
					    	<a class="nav-link active" id="list-tab" data-toggle="tab" href="#list" role="tab" aria-controls="list" aria-selected="true">
								<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-list"><line x1="8" y1="6" x2="21" y2="6"></line><line x1="8" y1="12" x2="21" y2="12"></line><line x1="8" y1="18" x2="21" y2="18"></line><line x1="3" y1="6" x2="3.01" y2="6"></line><line x1="3" y1="12" x2="3.01" y2="12"></line><line x1="3" y1="18" x2="3.01" y2="18"></line></svg>
							</a>
					  	</li>
					  	<li class="nav-item" role="presentation">
					    	<a class="nav-link" id="gird-tab" data-toggle="tab" href="#gird" role="tab" aria-controls="gird" aria-selected="false">
								<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-grid"><rect x="3" y="3" width="7" height="7"></rect><rect x="14" y="3" width="7" height="7"></rect><rect x="14" y="14" width="7" height="7"></rect><rect x="3" y="14" width="7" height="7"></rect></svg>
							</a>
					  	</li>
					  	<li class="nav-item" role="presentation">
					    	<a class="nav-link" id="map-tab" data-toggle="tab" href="#map" role="tab" aria-controls="map" aria-selected="false">
									<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-map"><polygon points="1 6 1 22 8 18 16 22 23 18 23 2 16 6 8 2 1 6"></polygon><line x1="8" y1="2" x2="8" y2="18"></line><line x1="16" y1="6" x2="16" y2="22"></line></svg>
							</a>
					  </li>
					</ul>
				</div>
				<div class="col">
					<div class="search_form_wrap">
						<form action="">
							<input type="text" name="pin" placeholder="Seatch  by postcode">
							<button><img src="{{asset('site/images/magnify.png')}}"></button>
						</form>
					</div>
				</div>
				<div class="col-sm-auto">
					<ul class="breadcumb_list">
						<li><a href="{!! URL::to('') !!}">Home</a></li>
						<li>/</li>
						<li>Directory List</li>
					</ul>
				</div>
			</div>
		</div>
	</div>
</section>

<!-- <section class="breadcumb_wrap">
	<div class="container">
		<div class="row">
			<div class="col-12">
				<ul class="breadcumb_list">
					<li><a href="{!! URL::to('') !!}">Home</a></li>
					<li><img src="{{asset('site/images/down-arrow.png')}}"></li>
					<li>Directory List</li>
				</ul>
			</div>
		</div>
	</div>
</section> --><!--Breadcumb-->

<section class="search_history_wrap">
	<!-- <div class="history_grid_header history_grid_header-mod">
		<div class="container">
			<div class="row">
				<div class="col-12 d-flex flex-column flex-md-row align-items-center justify-content-between">

				</div>
			</div>
		</div>
	</div> -->
	<div class="history_grid_body history_grid_body-mod">
		<div class="container">
			<div class="row">
				<div class="col-12">
					<div class="tab-content" id="myTabContent">
					  	<div class="tab-pane fade show active" id="list" role="tabpanel" aria-labelledby="list-tab">
					  		<?php /* ?>
					  		<div class="result_tab_title_wrap">
					  			<h5 class="result_tab_title">{{count($businesses)}} results found in <a href="#">Pin Code : {{$pinCode}}</a></h5>
					  			<p>List of directories near you</p>
					  		</div>
					  		<?php */ ?>
					  		<ul class="search_list_items search_list_items-mod">
					  			@foreach($businesses as $key => $business)
					  			<li>
					  				<div class="location_img_wrap">
					  					@if($business->image!='')<img src="{{URL::to('/').'/businesses/'}}{{$business->image}}">@endif
					  				</div>
					  				<div class="list_content_wrap row m-0">
										<div class="col-12 p-0">
											<!-- <ul class="rating_coments">
												<li>
													<img src="images/star.png">
													<h5>4.5 <span>(60 reviews)</span></h5>
												</li>
												<li>
													<img src="images/chat.png">
													<h5><span>40 Comments</span></h5>
												</li>
											</ul> -->
											<div class="location_meta">
												<figure class="bg-orange">
													<img src="{{URL::to('/').'/categories/'}}{{$business->category->image}}">
												</figure>
												<figcaption>
													<p>{{$business->category->title}}</p>
													<h4 class="place_title bebasnew">{{$business->business_name}}</h4>
												</figcaption>
											</div>
											<p class="history_details">{!!strip_tags(substr($business->description,0,300))!!}...</p>
											<div class="location_meta">
												<div class="location_details">
													<span><i class="fas fa-map-marker-alt"></i></span>
													<p class="location">{{$business->address}}</p>
												</div>
												<a href="{!! URL::to('directory-details/'.$business->id.'/'.strtolower(preg_replace("/[^a-zA-Z0-9]+/", "-", $business->business_name))) !!}" class="location_btn">View Details <img src="{{asset('site/images/right-arrow.png')}}"></a>
											</div>
										</div>
					  					<!-- <div class="col-12 p-0">
											<div class="bg-orange text-center ">

											  </div>
										</div> -->
					  				</div>
					  			</li>
					  			@endforeach

					  		</ul>
					  		<!-- <a href="#" class="orange-btm load_btn">View All</a> -->
					  	</div>
					  	<div class="tab-pane fade" id="gird" role="tabpanel" aria-labelledby="gird-tab">
					  		<?php /* ?>
					  		<div class="result_tab_title_wrap">
					  			<h5 class="result_tab_title">{{count($businesses)}} results found in <a href="#">Pin Code : {{$pinCode}}</a></h5>
					  			<p>List of directories near you</p>
					  		</div>
					  		<?php */ ?>
					  		<ul class="search_list_items grid">
					  			@foreach($businesses as $key => $business)
					  			<li>
					  				<div class="location_img_wrap">
					  					@if($business->image!='')<img src="{{URL::to('/').'/businesses/'}}{{$business->image}}">@endif
					  					<!-- <ul class="rating_coments">
					  						<li>
					  							<img src="images/star.png">
					  							<h5>4.5 <span>(60 reviews)</span></h5>
					  						</li>
					  						<li>
					  							<img src="images/chat.png">
					  							<h5><span>40 Comments</span></h5>
					  						</li>
					  					</ul> -->
					  				</div>
					  				<div class="list_content_wrap grid-business row m-0">
					  					<div class="location_meta">
												<figure class="bg-orange">
													<img src="{{URL::to('/').'/categories/'}}{{$business->category->image}}">
												</figure>
												<figcaption>
													<p>{{$business->category->title}}</p>
													<h4 class="place_title bebasnew">{{$business->business_name}}</h4>
												</figcaption>
											</div>
										<!-- <div class="col-12 p-0 title-grid-business">
										</div>
										<div class="col-md-4 p-0">
											<div class="bg-orange text-center">
												<img src="{{URL::to('/').'/categories/'}}{{$business->category->image}}" class="pt-2">
											</div>
										</div> -->

						  				<p class="history_details">{!!strip_tags(substr($business->description,0,180))!!}...</p>
						  				<a href="{!! URL::to('directory-details/'.$business->id.'/'.strtolower(preg_replace("/[^a-zA-Z0-9]+/", "-", $business->business_name))) !!}" class="location_btn">View Details <img src="{{asset('site/images/right-arrow.png')}}"></a>
					  				</div>
					  			</li>
					  			@endforeach

					  		</ul>
					  		<!-- <a href="#" class="orange-btm load_btn">View All</a> -->
					  	</div>
					  	<div class="tab-pane fade" id="map" role="tabpanel" aria-labelledby="map-tab">
					  		<div class="directory-map">
						  		<div id="mapShow" style="width: 100%; height: 600px;"></div>
						  	</div>
					  	</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section><!--Search-list-->
@endsection
@push('scripts')
<script src="https://maps.google.com/maps/api/js?key=AIzaSyDPuZ9AcP4PHUBgbUsT6PdCRUUkyczJ66I" type="text/javascript"></script>
<script type="text/javascript">
	@php
	$locations = array();
	foreach($businesses as $business){
		$data = array($business->business_name,floatval($business->lat),floatval($business->lon));
		array_push($locations,$data);
	}
	@endphp
	var locations = <?php echo json_encode($locations); ?>;
	console.log("businessLocations>>"+JSON.stringify(locations));

    console.log(JSON.stringify(locations));

    var map = new google.maps.Map(document.getElementById('mapShow'), {
      zoom: 16,
      center: new google.maps.LatLng(locations[0][1], locations[0][2]),
      mapTypeId: google.maps.MapTypeId.ROADMAP,
      "styles": [{
				"featureType": "administrative",
				"elementType": "labels.text.fill",
				"stylers": [{
					"color": "#444444"
				}]
			}, {
				"featureType": "landscape",
				"elementType": "all",
				"stylers": [{
					"color": "#f2f2f2"
				}]
			}, {
				"featureType": "poi",
				"elementType": "all",
				"stylers": [{
					"visibility": "off"
				}]
			}, {
				"featureType": "road",
				"elementType": "all",
				"stylers": [{
					"saturation": -100
				}, {
					"lightness": 45
				}]
			}, {
				"featureType": "road.highway",
				"elementType": "all",
				"stylers": [{
					"visibility": "simplified"
				}]
			}, {
				"featureType": "road.arterial",
				"elementType": "labels.icon",
				"stylers": [{
					"visibility": "off"
				}]
			}, {
				"featureType": "transit",
				"elementType": "all",
				"stylers": [{
					"visibility": "off"
				}]
			}, {
				"featureType": "water",
				"elementType": "all",
				"stylers": [{
					"color": "#4f595d"
				}, {
					"visibility": "on"
				}]
			}],
    });

    var infowindow = new google.maps.InfoWindow();

    var marker, i;
    var iconBase = 'http://cp-33.hostgator.tempwebhost.net/~a1627unp/dev/localtales_v2/public/site/images/';

    for (i = 0; i < locations.length; i++) {
      marker = new google.maps.Marker({
        position: new google.maps.LatLng(locations[i][1], locations[i][2]),
        map: map,
        icon: iconBase + 'map_icon.png'
      });

      google.maps.event.addListener(marker, 'click', (function(marker, i) {
        return function() {
          infowindow.setContent(locations[i][0]);
          infowindow.open(map, marker);
        }
      })(marker, i));
    }
  </script>
@endpush
