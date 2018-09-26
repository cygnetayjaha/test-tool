<!-- Start modal for js code. -->
<div class="modal fade" id="modal_add_domain" data-backdrop="static" data-keyboard="false">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 id="" class="modal-title"><i class="fa fa-bar-chart"></i> <?php echo $this->lang->line('website analysis'); ?></h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body" style="padding:30px;">        
		<div class="col-xs-12 text-center" style="padding-top: 20px;">
			<h3><span id="domain_name_show"></span></h3>
		</div>
		<div class="text-center" id="domain_success_msg"></div>    
		 
		<div class="text-center" id="progress_msg">
			<span id="domain_progress_msg_text"></span>
			<div class="progress" style="display: none;height: 25px;" id="domain_progress_bar_con"> 
				<div style="width:3%" class="progress-bar progress-bar-striped"><span style="height: 25px;padding-top: 2px;">1%</span></div>
			</div>
		</div>
		<br>
		<div class="text-center"><h2 id="completed_result_link"></h2></div>
		<div class="row" id="completed_function_str"></div>	
      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal"><?php echo $this->lang->line('close'); ?></button>
      </div>

    </div>
  </div>
</div>

<style type="text/css">	
#completed_function_str{font-size: 18px;}
#completed_function_str .green{color:green;}
</style>


<script type="text/javascript">

	var interval="";

	function get_bulk_progress()
	{
		var base_url="<?php echo base_url(); ?>";			
		$.ajax({
			url:base_url+'home/front_end_bulk_scan_progress_count',
			type:'POST',
			dataType:'json',
			success:function(response){
				var search_complete=response.search_complete;
				var search_total=response.search_total;
				var latest_record=response.latest_record;

				var view_details_button = response.view_details_button;

				$("#domain_progress_msg_text").html(search_complete +" / "+ search_total +" <?php echo $this->lang->line('step completed') ?>");
				$("#completed_function_str").html(response.completed_function_str);
				var width=(search_complete*100)/search_total;
				width=Math.round(width);					
				var width_per=width+"%";
				if(width<3)
				{
					$("#domain_progress_bar_con div").css("width","3%");
					// $("#domain_progress_bar_con div").attr("aria-valuenow","3");
					$("#domain_progress_bar_con div span").html("1%");
				}
				else
				{
					$("#domain_progress_bar_con div").css("width",width_per);
					// $("#domain_progress_bar_con div").attr("aria-valuenow",width);
					$("#domain_progress_bar_con div span").html(width_per);
				}

				if(width==100) 
				{
					$("#domain_progress_msg_text").html("<?php echo $this->lang->line('completed') ?>");
					$("#domain_success_msg").html('');
					$("#completed_result_link").html(response.view_details_button);			
					clearInterval(interval);
				}

				if(view_details_button != 'not_set')
				{
					$("#domain_progress_msg_text").html("<?php echo $this->lang->line('completed') ?>");
					$("#domain_success_msg").html('');
					$("#completed_result_link").html(response.view_details_button);			
					clearInterval(interval);
				}			
				
			}
		});
		
	}
	
	
	$(document).ready(function() {
		$('#submit').click(function(e){
			e.preventDefault();			
			var base_url="<?php echo site_url(); ?>";
			var domain_name = $('#website_name').val();
			$("#domain_name_show").html(domain_name);

			if(domain_name == '') {
				alert("<?php echo $this->lang->line('you have not enter any domain name'); ?>");
			} else {
				$('#modal_add_domain').modal();				

				$("#domain_progress_bar_con div").css("width","3%");
				// $("#domain_progress_bar_con div").attr("aria-valuenow","3");
				$("#domain_progress_bar_con div span").html("1%");
				$("#domain_progress_msg_text").html("");				
				$("#domain_progress_bar_con").show();				
				interval=setInterval(get_bulk_progress, 10000);

				
				$("#domain_success_msg").html('<img style="margin:15px 0;" class="center-block" src="'+base_url+'assets/pre-loader/custom.gif" alt="<?php echo $this->lang->line('please wait'); ?>"><br/>');
				$("#completed_result_link").html('');
				
				$.ajax({
					type:'POST' ,
					url: "<?php echo site_url(); ?>home/front_end_website_analysis",
					data:{domain_name:domain_name},
					success:function(response){
						if(response == 0){
							$('#modal_add_domain').modal('hide');
							alert("<?php echo $this->lang->line("something went wrong, please try again"); ?>");
						}						
						else {
							$("#domain_progress_bar_con div").css("width","100%");
							// $("#domain_progress_bar_con div").attr("aria-valuenow","100");
							$("#domain_progress_bar_con div span").html("100%");
							$("#domain_progress_msg_text").html("<?php echo $this->lang->line('completed') ?>");
							$("#domain_success_msg").html('');
							$("#completed_result_link").html(response);
						}
					}
				}); 
			}
		});
	});

</script>