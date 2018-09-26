<?php 
if($ip_info["status"]!="success") 
{
	$ip_info['city']="";
	$ip_info['country']="";
	$ip_info['postal']="";
	$ip_info['org']="";
	$ip_info['hostname']="";
	$ip_info['region']="";
	$ip_info['latitude']="";
	$ip_info['longitude']="";
}
?>

<div class="container-fluid">	
	<div class="row">
		<div class="col-xs-12">
			<h3><div class="well text-center" style="background: #fff;"><?php echo $this->lang->line("ip information");?></div></h3>
		</div>
	</div>
	<div class="row">
		<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
			<div class="info-box" style="border:1px solid #00C0EF;border-bottom:2px solid #00C0EF;">
				<span class="info-box-icon bg-aqua"><i class="fa fa-tag"></i></span>
				<div class="info-box-content">
					<span class="info-box-text">IP Address</span>
					<span class="info-box-number" ><?php echo $my_ip; ?></span>
				</div><!-- /.info-box-content -->
			</div>
		</div>	

		<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
			<div class="info-box" style="border:1px solid #00C0EF;border-bottom:2px solid #00C0EF;">
				<span class="info-box-icon bg-aqua"><i class="fa fa-map-marker"></i></span>
				<div class="info-box-content">
					<span class="info-box-text">Latitude</span>
					<span class="info-box-number" ><?php echo $ip_info["latitude"]; ?></span>
				</div><!-- /.info-box-content -->
			</div>
		</div>	

		<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
			<div class="info-box" style="border:1px solid #00C0EF;border-bottom:2px solid #00C0EF;">
				<span class="info-box-icon bg-aqua"><i class="fa fa-map-marker"></i></span>
				<div class="info-box-content">
					<span class="info-box-text">Longitude</span>
					<span class="info-box-number" ><?php echo $ip_info["longitude"]; ?></span>
				</div><!-- /.info-box-content -->
			</div>
		</div>	

		<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
			<div class="info-box" style="border:1px solid #00C0EF;border-bottom:2px solid #00C0EF;">
				<span class="info-box-icon bg-aqua"><i class="fa fa-building"></i></span>
				<div class="info-box-content">
					<span class="info-box-text">Organization</span>
					<span class="info-box-number" ><?php echo $ip_info["org"]; ?></span>
				</div><!-- /.info-box-content -->
			</div>
		</div>	

		<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
			<div class="info-box" style="border:1px solid #00C0EF;border-bottom:2px solid #00C0EF;">
				<span class="info-box-icon bg-aqua"><i class="fa fa-server"></i></span>
				<div class="info-box-content">
					<span class="info-box-text">Hostname</span>
					<span class="info-box-number" ><?php echo $ip_info["hostname"]; ?></span>
				</div><!-- /.info-box-content -->
			</div>
		</div>	

		<div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">
			<div class="info-box" style="border:1px solid #00C0EF;border-bottom:2px solid #00C0EF;">
				<span class="info-box-icon bg-aqua"><i class="fa fa-globe"></i></span>
				<div class="info-box-content">
					<span class="info-box-text">Country</span>
					<span class="info-box-number" ><?php echo $ip_info["country"]; ?></span>
				</div><!-- /.info-box-content -->
			</div>
		</div>	

		<div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">
			<div class="info-box" style="border:1px solid #00C0EF;border-bottom:2px solid #00C0EF;">
				<span class="info-box-icon bg-aqua"><i class="fa fa-map"></i></span>
				<div class="info-box-content">
					<span class="info-box-text">Region</span>
					<span class="info-box-number" ><?php echo $ip_info["region"]; ?></span>
				</div><!-- /.info-box-content -->
			</div>
		</div>	

		<div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">
			<div class="info-box" style="border:1px solid #00C0EF;border-bottom:2px solid #00C0EF;">
				<span class="info-box-icon bg-aqua"><i class="fa fa-home"></i></span>
				<div class="info-box-content">
					<span class="info-box-text">City</span>
					<span class="info-box-number" ><?php echo $ip_info["city"]; ?></span>
				</div><!-- /.info-box-content -->
			</div>
		</div>	

		<div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">
			<div class="info-box" style="border:1px solid #00C0EF;border-bottom:2px solid #00C0EF;">
				<span class="info-box-icon bg-aqua"><i class="fa fa-envelope"></i></span>
				<div class="info-box-content">
					<span class="info-box-text">Postal Code</span>
					<span class="info-box-number" ><?php echo $ip_info["postal"]; ?></span>
				</div><!-- /.info-box-content -->
			</div>
		</div>		
		
		<div id="map" class="col-xs-12 col-sm-12 col-md-8 col-lg-8 col-md-offset-2 col-lg-offset-2">
			
		</div>
		
	</div>
</div>

<br>
<br>
<br>


<script>

function success(input_possition) {

  var mapcanvas = document.createElement('div');
  mapcanvas.id = 'mapcontainer';
  mapcanvas.style.height = '400px';
  mapcanvas.style.width = '100%';
  
  document.getElementById('map').appendChild(mapcanvas);
  
  var possition_array=input_possition.split(",",2);
  var coords = new google.maps.LatLng(possition_array[0],possition_array[1]);
  var options = {
    zoom: 5,
    center: coords,
    mapTypeControl: false,
    navigationControlOptions: {
    	style: google.maps.NavigationControlStyle.SMALL
    },
    mapTypeId: google.maps.MapTypeId.ROADMAP
  };
  var map = new google.maps.Map(document.getElementById("mapcontainer"), options);

  var marker = new google.maps.Marker({
      position: coords,
      map: map,
      title:"You are here!"
  });
}

var lat_long="<?php echo $ip_info['latitude']; ?>,"+"<?php echo $ip_info['longitude']; ?>";

success(lat_long);

</script>







