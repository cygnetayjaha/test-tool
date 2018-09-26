<div class="clearfix"></div>
<br><br>
<div class="row" style="margin-top: 20px;">
	<div class="col-xs-12 col-sm-12 col-md-6 col-md-offset-3 col-lg-6 col-lg-offset-3 well" style="padding-bottom: 20px;background: #fff;">
		<br><h2 class="text-center" style="margin-bottom: 15px; margin-top: 0px;"><?php echo $this->lang->line("IP Traceout");?></h2><hr><br>
		
		<div class="row">
			<div class="col-xs-12 col-sm-12 col-md-8 col-lg-8">
				<input type="text" class="form-control" id="ip_address" value="<?php echo $check_ip; ?>" placeholder="IP Address">
			</div>
			<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
				<button class="btn btn-info"  id="ip_address_search"><i class="fa fa-hourglass-half"></i> <?php echo $this->lang->line("Start Tracing");?></button>
			</div>
		</div>
		<div class="row">
			<div class="col-xs-12">				
				<a class="label label-success" href="<?php echo site_url()."ip/domain_info"; ?>"><?php echo $this->lang->line("Get Your Domain IP");?></a>
			</div>
		</div>
		
		<br/><br/><br/>
		<div id="blacklist_waiting_div" class="text-center"></div>
	</div>
</div>

<div class="row table-responsive" style="margin-top: 30px; padding-left: 40px; padding-right: 40px;" id="blacklist_analyzer_data">
	
</div>

<script>

	$j("document").ready(function(){
		var ip_address=$("#ip_address").val();
		if(ip_address!="")
			$("#ip_address_search").click();
	});
	
	



	$(document.body).on('click','#ip_address_search',function(){
		var base_url="<?php echo base_url(); ?>";
		var ip_address = $("#ip_address").val();
		if(ip_address == '') alert('<?php echo $this->lang->line("you have not enter any IP address"); ?>');
		else {
			$('#blacklist_waiting_div').html('<img class="center-block" style="" src="'+base_url+'assets/pre-loader/Fancy pants.gif" alt="<?php echo $this->lang->line("please wait"); ?>">');

			$("#blacklist_analyzer_data").html('');
			$.ajax({
					type: "POST",
					url : "<?php echo site_url('ip/traceout_check_data'); ?>",
					data:{ip_address:ip_address},
					dataType: '',
					async: false,
					success:function(response){
						$('#blacklist_waiting_div').html('');
						$("#blacklist_analyzer_data").html(response);					
					}
				});
		}
	});
</script>
<?php 
if(isset($google_api[0]['google_api_key'])) $google_api_key=$google_api[0]['google_api_key'];
else $google_api_key="AIzaSyBG0sIVBWReW1Q0WGkWO28uGaKWhQp7Q4c";
?>
<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&libraries=places&key=<?php echo $google_api_key;?>"></script>