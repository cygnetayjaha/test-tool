<style type="text/css">
	.box{border:1px solid #ccc;background: #fefefe;}
	.content-wrapper{background: #fff !important;}
</style>

<div class="container-fluid">
	<div class="text-center" style="margin-top: 5px;padding:12px 0 8px 0 !important"><p style="color: #55AAFF; font-size: 28px; font-weight: bold;"><i class="fa fa-dashboard"></i> <?php echo $this->lang->line("Dashboard"); ?></p></div>
	<?php if($this->session->userdata("user_type")=="Member") {?>
	<div class="row">
		<div class="col-xs-12">
			<div class="info-box bg-gray">
				<span class="info-box-icon"><i class="fa fa-cube"></i></span>
				<div class="info-box-content">
					<span class="info-box-number">
					   <?php if($price=="Trial") $price=0; ?>
					   <?php echo $package_name;?> 
					   <!-- @ <?php echo $payment_config[0]['currency']; ?> <?php echo $price;?> /
					   <?php echo $validity;?> <?php echo $this->lang->line("days")?> -->	
					</span>
					<div class="progress">
						<div style="width: 70%" class="progress-bar"></div>
					</div>
					<span class="progress-description">
						<b><?php echo $this->lang->line("your package")?></b>
					</span>
				</div>
			</div>	
		</div>
	</div>
	<?php } ?>


	<textarea class="hidden" id="country_chart_data_1"><?php if(isset($country_chart_data_1)) echo $country_chart_data_1; ?></textarea>
	<textarea class="hidden" id="country_chart_data_2"><?php if(isset($country_chart_data_2)) echo $country_chart_data_2; ?></textarea>
	<textarea class="hidden" id="country_chart_data_3"><?php if(isset($country_chart_data_3)) echo $country_chart_data_3; ?></textarea>
	<textarea class="hidden" id="country_chart_data_4"><?php if(isset($country_chart_data_4)) echo $country_chart_data_4; ?></textarea>

	<textarea class="hidden" id="pie_chart_data_1"><?php if(isset($pie_chart_data_1)) echo $pie_chart_data_1; ?></textarea>
	<textarea class="hidden" id="pie_chart_data_2"><?php if(isset($pie_chart_data_2)) echo $pie_chart_data_2; ?></textarea>
	<textarea class="hidden" id="pie_chart_data_3"><?php if(isset($pie_chart_data_3)) echo $pie_chart_data_3; ?></textarea>
	<textarea class="hidden" id="pie_chart_data_4"><?php if(isset($pie_chart_data_4)) echo $pie_chart_data_4; ?></textarea>

	<?php $day_wise_click_report_array=json_decode($day_wise_click_report,true); ?>
	<?php $traffic_soure_barchart_array=json_decode($traffic_soure_barchart,true); ?>

	<textarea name="day_wise_click_report_1" id="day_wise_click_report_1" class="hidden"><?php if(isset($day_wise_click_report_array[0])) echo json_encode($day_wise_click_report_array[0]);else echo json_encode(array());?></textarea>
	<textarea name="day_wise_click_report_2" id="day_wise_click_report_2" class="hidden"><?php if(isset($day_wise_click_report_array[1])) echo json_encode($day_wise_click_report_array[1]);else echo json_encode(array());?></textarea>
	<textarea name="day_wise_click_report_3" id="day_wise_click_report_3" class="hidden"><?php if(isset($day_wise_click_report_array[2])) echo json_encode($day_wise_click_report_array[2]);else echo json_encode(array());?></textarea>
	<textarea name="day_wise_click_report_4" id="day_wise_click_report_4" class="hidden"><?php if(isset($day_wise_click_report_array[3])) echo json_encode($day_wise_click_report_array[3]);else echo json_encode(array());?></textarea>
	
	<textarea name="traffic_soure_barchart_1" id="traffic_soure_barchart_1" class="hidden"><?php if(isset($traffic_soure_barchart_array[0])) echo json_encode($traffic_soure_barchart_array[0]);else echo json_encode(array());?></textarea>
	<textarea name="traffic_soure_barchart_2" id="traffic_soure_barchart_2" class="hidden"><?php if(isset($traffic_soure_barchart_array[1])) echo json_encode($traffic_soure_barchart_array[1]);else echo json_encode(array());?></textarea>
	<textarea name="traffic_soure_barchart_3" id="traffic_soure_barchart_3" class="hidden"><?php if(isset($traffic_soure_barchart_array[2])) echo json_encode($traffic_soure_barchart_array[2]);else echo json_encode(array());?></textarea>
	<textarea name="traffic_soure_barchart_4" id="traffic_soure_barchart_4" class="hidden"><?php if(isset($traffic_soure_barchart_array[3])) echo json_encode($traffic_soure_barchart_array[3]);else echo json_encode(array());?></textarea>
	
	<textarea name="day_wise_click_comparison_report" id="day_wise_click_comparison_report" class="hidden"><?php echo $day_wise_click_report_compare;?></textarea>
	<?php 
	$day_wise_click_report_compare_array=json_decode($day_wise_click_report_compare,true);

	$day_wise_click_report_compare_first=isset($day_wise_click_report_compare_array[0])?$day_wise_click_report_compare_array[0]:array();
	$domain_list=array();
	foreach ($day_wise_click_report_compare_first as $key => $value) 
	{
		if($key!='date')
		$domain_list[]=$key;
	}
	?>
	<textarea name="domain_list" id="domain_list" class="hidden"><?php echo json_encode($domain_list);?></textarea>

	<div class="row" style="padding-left:12px;padding-right: 12px;">
		<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6" style="padding-left:3px;padding-right: 3px;">
			<div href="http://facebook.com" style="background: #eee;padding:20px 0;margin:7px 2px;border-radius: 10px;min-height: 600px;" class="<?php if(count($day_wise_click_report_array)<1) echo "hidden"; ?>">
				<a href='<?php echo isset($visitor_type_data[0]) ? base_url("domain_details_visitor/domain_details/".$visitor_type_data[0]["id"]):"#";?>'>
					<div class="row">
						<div class="text-center col-xs-12" style="font-size:17px;font-weight: bold; color:#3C8DBC;" id="country_domain_name_1"></div><br>
						<div class="col-md-6 col-xs-6 text-center">
							<div class="chart-responsive">
								<canvas id="country_type_pieChart_1" height="220"></canvas>
							</div>
							<div class="col-md-12 col-xs-12">
								<b><small class="orange"><?php echo $this->lang->line("Today's New Visitor");?></small></b><br><br>
								<?php if(isset($country_name_list_1)) echo $country_name_list_1; ?>
							</div>
						</div>
						<div class="col-md-6 col-xs-6 text-center">
							<div class="chart-responsive">
								<canvas id="visitor_type_pieChart_1" height="220"></canvas>
							</div>
							<b><small class="orange"><?php echo $this->lang->line("Today's New/Returning");?></small></b><br><br>
							<?php
							if(isset($pie_chart_data_1))
							{
								$tmp=json_decode($pie_chart_data_1,true);					
								foreach ($tmp as $key => $value) 
								{
									echo "<i class='fa fa-circle-o' style='color:".$value['color']."'></i> ".$value['label'].": ".$value['value']."<br>";
								}
							}
							?>
						</div>
					</div>
					<div class="row">
						<div class="col-xs-12 col-md-6 text-center">
							<br><b><small class="orange"><?php echo $this->lang->line("Visitor - Last 7 Days");?></small></b>
							<div class="chart">						
								<div class="chart" id="day_wise_click_report_chart_1" style="height: 170px;"></div>
							</div>
						</div>
						<div class="col-xs-12 col-md-6 text-center">
							<br><b><small class="orange"><?php echo $this->lang->line("Traffic Source - Last 7 Days");?></small></b>
							<div class="chart">						
								<div class="chart" id="traffic_barchart_1" style="height: 170px;"></div>
							</div>
						</div>
					</div>
				</a>
			</div>
		</div>

		<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6" style="padding-left:3px;padding-right: 3px;">
			<div style="background: #ddd;padding:20px 0;margin:7px 2px;border-radius: 10px;min-height: 600px;" class="<?php if(count($day_wise_click_report_array)<2) echo "hidden"; ?>">
				<a href='<?php echo isset($visitor_type_data[1]) ? base_url("domain_details_visitor/domain_details/".$visitor_type_data[1]["id"]):"#";?>'>
					<div class="row">
					<div class="text-center col-xs-12" style="font-size:17px;font-weight: bold; color:#3C8DBC;" id="country_domain_name_2"></div><br>
					<div class="col-md-6 col-xs-6 text-center">
						<div class="chart-responsive">
							<canvas id="country_type_pieChart_2" height="220"></canvas>
						</div>
						<b><small class="orange"><?php echo $this->lang->line("Today's New Visitor");?></small></b><br><br>
						<?php if(isset($country_name_list_2)) echo $country_name_list_2; ?>
					</div>
					<div class="col-md-6 col-xs-6 text-center">
						<div class="chart-responsive">
							<canvas id="visitor_type_pieChart_2" height="220"></canvas>
						</div>
						<b><small class="orange"><?php echo $this->lang->line("Today's New/Returning");?></small></b><br><br>
						<?php
						if(isset($pie_chart_data_2))
						{
							$tmp=json_decode($pie_chart_data_2,true);									
							foreach ($tmp as $key => $value) 
							{
								echo "<i class='fa fa-circle-o' style='color:".$value['color']."'></i> ".$value['label'].": ".$value['value']."<br>";
							}
						}
						?>
					</div>
					</div>
					<div class="row">
						<div class="col-xs-12 col-md-6 text-center">
							<br><b><small class="orange"><?php echo $this->lang->line("Visitor - Last 7 Days");?></small></b>
							<div class="chart">						
								<div class="chart" id="day_wise_click_report_chart_2" style="height: 170px;"></div>
							</div>
						</div>
						<div class="col-xs-12 col-md-6 text-center">
							<br><b><small class="orange"><?php echo $this->lang->line("Traffic Source - Last 7 Days");?></small></b>
							<div class="chart">						
								<div class="chart" id="traffic_barchart_2" style="height: 170px;"></div>
							</div>
						</div>
					</div>
				</a>
			</div>
		</div>
	</div>

	<div class="row" style="padding-left:12px;padding-right: 12px;" >

		<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6" style="padding-left:3px;padding-right: 3px;">
			<div style="background: #ddd;padding:20px 0;margin:7px 2px;border-radius: 10px;min-height: 600px;" class="<?php if(count($day_wise_click_report_array)<3) echo "hidden"; ?>">
				<a href='<?php echo isset($visitor_type_data[2]) ? base_url("domain_details_visitor/domain_details/".$visitor_type_data[2]["id"]):"#";?>'>
					<div class="row">
						<div class="text-center col-xs-12" style="font-size:17px;font-weight: bold; color:#3C8DBC;" id="country_domain_name_3"></div><br>
						<div class="col-md-6 col-xs-6 text-center">
							<div class="chart-responsive">
								<canvas id="country_type_pieChart_3" height="220"></canvas>
							</div>
							<b><small class="orange"><?php echo $this->lang->line("Today's New Visitor");?></small></b><br><br>
							<?php if(isset($country_name_list_3)) echo $country_name_list_3; ?>
						</div>
						<div class="col-md-6 col-xs-6 text-center">
							<div class="chart-responsive">
								<canvas id="visitor_type_pieChart_3" height="220"></canvas>
							</div>
							<b><small class="orange"><?php echo $this->lang->line("Today's New/Returning");?></small></b><br><br>
							<?php
							if(isset($pie_chart_data_3))
							{
								$tmp=json_decode($pie_chart_data_3,true);					
								foreach ($tmp as $key => $value) 
								{
									echo "<i class='fa fa-circle-o' style='color:".$value['color']."'></i> ".$value['label'].": ".$value['value']."<br>";
								}
							}
							?>
						</div>
					</div>
					<div class="row">
						<div class="col-xs-12 col-md-6 text-center">
							<br><b><small class="orange"><?php echo $this->lang->line("Visitor - Last 7 Days");?></small></b>
							<div class="chart">						
								<div class="chart" id="day_wise_click_report_chart_3" style="height: 170px;"></div>
							</div>
						</div>
						<div class="col-xs-12 col-md-6 text-center">
							<br><b><small class="orange"><?php echo $this->lang->line("Traffic Source - Last 7 Days");?></small></b>
							<div class="chart">						
								<div class="chart" id="traffic_barchart_3" style="height: 170px;"></div>
							</div>
						</div>
					</div>
				</a>
			</div>
		</div>



		<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6" style="padding-left:3px;padding-right: 3px;">
			
			<div style="background: #ddd;padding:20px 0;margin:7px 2px;border-radius: 10px;min-height: 600px;" class="<?php if(count($day_wise_click_report_array)<4) echo "hidden"; ?>">
				<a href='<?php echo isset($visitor_type_data[3]) ? base_url("domain_details_visitor/domain_details/".$visitor_type_data[3]["id"]):"#";?>'>
					<div class="row">
					<div class="text-center col-xs-12" style="font-size:17px;font-weight: bold; color:#3C8DBC;" id="country_domain_name_4"></div><br>
					<div class="col-md-6 col-xs-6 text-center">
						<div class="chart-responsive">
							<canvas id="country_type_pieChart_4" height="220"></canvas>
						</div>
						<b><small class="orange"><?php echo $this->lang->line("Today's New Visitor");?></small></b><br><br>
						<?php if(isset($country_name_list_4)) echo $country_name_list_4; ?>
					</div>
					<div class="col-md-6 col-xs-6 text-center">
						<div class="chart-responsive">
							<canvas id="visitor_type_pieChart_4" height="220"></canvas>
						</div>
						<b><small class="orange"><?php echo $this->lang->line("Today's New/Returning");?></small></b><br><br>
						<?php
						if(isset($pie_chart_data_4))
						{
							$tmp=json_decode($pie_chart_data_4,true);					
							foreach ($tmp as $key => $value) 
							{
								echo "<i class='fa fa-circle-o' style='color:".$value['color']."'></i> ".$value['label'].": ".$value['value']."<br>";
							}
						}
						?>
					</div>
					</div>
					<div class="row">
						<div class="col-xs-12 col-md-6 text-center">
							<br><b><small class="orange"><?php echo $this->lang->line("Visitor - Last 7 Days");?></small></b>
							<div class="chart">						
								<div class="chart" id="day_wise_click_report_chart_4" style="height: 170px;"></div>
							</div>
						</div>
						<div class="col-xs-12 col-md-6 text-center">
							<br><b><small class="orange"><?php echo $this->lang->line("Traffic Source - Last 7 Days");?></small></b>
							<div class="chart">						
								<div class="chart" id="traffic_barchart_4" style="height: 170px;"></div>
							</div>
						</div>
					</div>
				</a>
			</div>
			
		</div>

		<div class="col-xs-12" style="padding-left:3px;padding-right: 3px;">
			<div class="row" style="background: #eee;padding:20px 0;margin:7px 2px;border-radius: 10px;">
				<div class="text-center col-xs-12" style="font-size:17px;font-weight: bold; color:#3C8DBC;"><?php echo $this->lang->line("Visitor Comparison- Last 7 Days"); ?></div><br>			
				<div class="col-xs-12 text-center">
					<div class="chart">						
						<div class="chart" id="day_wise_click_comparsion_report_chart" style="height: 250px;"></div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<br>

	<div class="row">
		
		<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">			
			<div class="box">
				<div class="box-header with-border">
					<h3 class="box-title" style="color: #198EC8"><i class="fa fa-bar-chart" style="color: #E05A17;"></i> <?php echo $this->lang->line("Website Analysis"); ?></h3>
					<div class="box-tools pull-right">
						<button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
					</div><!-- /.box-tools -->
				</div><!-- /.box-header -->
				<div class="box-body table-responsive">					
					<?php 
						if(empty($website_analysis)) echo "<h3 class='text-center'>No data to show</h3>";
						else {
					?>

					<table class="table table-hover table-striped table-bordered table-condensed ">
						<tr>
							<th>Name</th>
							<th>Details</th>
						</tr>
						<?php foreach($website_analysis as $value): ?>
							<tr>
								<td><?php echo $value['domain_name']; ?></td>
								<td><a class="label label-default" target="_blank" href="<?php echo base_url('domain/domain_details_view').'/'.$value['id']; ?>"><i class="fa fa-binoculars"></i> View Details</a></td>
							</tr>
						<?php endforeach; ?>
					</table>
					<?php } ?>
					<br>
					<div class="text-center" style="margin-top: 5px;"><span><a class="btn btn-default btn-sm" href="<?php echo base_url('domain/domain_list_for_domain_details'); ?>"  target="_blank"><i class="fa fa-arrow-circle-right"></i> More Info</a></span></div>
				</div><!-- /.box-body -->
			</div><!-- /.box -->			
		</div>

		<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">			
			<div class="box">
				<div class="box-header with-border">
					<h3 class="box-title" style="color: #198EC8"><i class="fa fa-anchor" style="color: #E05A17;"></i> <?php echo $this->lang->line("Link Analyzer"); ?></h3>
					<div class="box-tools pull-right">
						<button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
					</div><!-- /.box-tools -->
				</div><!-- /.box-header -->
				<div class="box-body table-responsive">
					<?php 
						if(empty($link_analysis)) echo "<h3 class='text-center'>No data to show</h3>";
						else {
					?>

					<table class="table table-hover table-striped table-bordered table-condensed ">
						<tr>
							<th>Name</th>
							<th>External Link Count</th>
							<th>Internal Link Count</th>
						</tr>
						<?php foreach($link_analysis as $value): ?>
							<tr>
								<td><?php echo $value['url'];?></td>
								<td><?php echo $value['external_link_count'];?></td>
								<td><?php echo $value['internal_link_count'];?></td>
							</tr>
						<?php endforeach; ?>
					</table>
					<?php } ?>
					<br>
					<div class="text-center" style="margin-top: 5px;"><span><a class="btn btn-default btn-sm" href="<?php echo base_url('link_analysis/index'); ?>"  target="_blank"><i class="fa fa-arrow-circle-right"></i> More Info</a></span></div>
				</div><!-- /.box-body -->
			</div><!-- /.box -->			
		</div>
		
	</div>
	<!-- search engine index and google page rank -->
	<div class="row">
		<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">			
			<div class="box">
				<div class="box-header with-border">
					<h3 class="box-title" style="color: #198EC8"><i class="fa fa-list-ol" style="color: #E05A17;"></i> <?php echo $this->lang->line("Search Engine Index"); ?></h3>
					<div class="box-tools pull-right">
						<button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
					</div><!-- /.box-tools -->
				</div><!-- /.box-header -->
				<div class="box-body table-responsive">
					<?php 
						if(empty($search_engine_index)) echo "<h3 class='text-center'>No data to show</h3>";
						else {
					?>

					<table class="table table-hover table-striped table-bordered table-condensed ">
						<tr>
							<th>Name</th>
							<th><i class="fa fa-google" style="color: orange;"></i> Google Index</th>
							<th><i class="fa fa-windows" style="color: orange;"></i> Bing Index</th>
							<th><i class="fa fa-yahoo" style="color: orange;"></i> Yahoo Index</th>
						</tr>
						<?php foreach($search_engine_index as $value): ?>
							<tr>
								<td><?php echo $value['domain_name']; ?></td>
								<td><?php echo $value['google_index']; ?></td>
								<td><?php echo $value['bing_index']; ?></td>
								<td><?php echo $value['yahoo_index']; ?></td>
								
							</tr>
						<?php endforeach; ?>
					</table>
					<?php } ?>
					<br>
					<div class="text-center" style="margin-top: 5px;"><span><a class="btn btn-default btn-sm" href="<?php echo base_url('search_engine_index/index'); ?>"  target="_blank"><i class="fa fa-arrow-circle-right"></i> More Info</a></span></div>
				</div><!-- /.box-body -->
			</div><!-- /.box -->			
		</div>
		
		<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">			
			<div class="box">
				<div class="box-header with-border">
					<h3 class="box-title" style="color: #198EC8"><i class="fa fa-link" style="color: #E05A17;"></i><?php echo $this->lang->line("Google Backlink Search"); ?></h3>
					<div class="box-tools pull-right">
						<button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
					</div><!-- /.box-tools -->
				</div><!-- /.box-header -->
				<div class="box-body table-responsive">
					<?php 
						if(empty($backlink_search)) echo "<h3 class='text-center'>No data to show</h3>";
						else {
					?>

					<table class="table table-hover table-striped table-bordered table-condensed ">
						<tr>
							<th>Name</th>
							<th>Backlink Count</th>
						</tr>
						<?php foreach($backlink_search as $value): ?>
							<tr>
								<td><?php echo $value['domain_name'];?></td>
								<td><?php echo $value['backlink_count'];?></td>
							</tr>
						<?php endforeach; ?>
					</table>
					<?php } ?>
					<br>
					<div class="text-center" style="margin-top: 5px;"><span><a class="btn btn-default btn-sm" href="<?php echo base_url('backlink/backlink_search'); ?>"  target="_blank"><i class="fa fa-arrow-circle-right"></i> More Info</a></span></div>
				</div><!-- /.box-body -->
			</div><!-- /.box -->			
		</div>
	</div>


	<div class="row">
		
		<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">			
			<div class="box">
				<div class="box-header with-border">
					<h3 class="box-title" style="color: #198EC8"><img style="height:18px;margin-right: 5px;" src="<?php echo base_url();?>assets/images/Similarweb.png" alt="SiteSpy" class="pull-left img-responsive"> <?php echo $this->lang->line("SimilarWeb Data"); ?></h3>
					<div class="box-tools pull-right">
						<button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
					</div><!-- /.box-tools -->
				</div><!-- /.box-header -->
				<div class="box-body table-responsive">
					<?php 
						if(empty($similar_web_info)) echo "<h3 class='text-center'>No data to show</h3>";
						else {
					?>

					<table class="table table-hover table-striped table-bordered table-condensed ">
						<tr>
							<th>Name</th>
							<th>Global Rank</th>
							<th>Details</th>
						</tr>
						<?php foreach($similar_web_info as $value): ?>
							<tr>
								<td><?php echo $value['domain_name']; ?></td>
								<td><?php echo $value['global_rank']; ?></td>
								<td><a class="label label-default" target="_blank" href="<?php echo base_url('rank/similar_web_details').'/'.$value['id']; ?>"><i class="fa fa-binoculars"></i> View Details</a></td>
							</tr>
						<?php endforeach; ?>
					</table>
					<?php } ?>
					<br>
					<div class="text-center" style="margin-top: 5px;"><span><a class="btn btn-default btn-sm" href="<?php echo base_url('rank/similar_web'); ?>"  target="_blank"><i class="fa fa-arrow-circle-right"></i> More Info</a></span></div>
				</div><!-- /.box-body -->
			</div><!-- /.box -->			
		</div>
		<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">			
			<div class="box">
				<div class="box-header with-border">
					<h3 class="box-title" style="color: #198EC8"><img style="height:18px;margin-right: 5px;" src="<?php echo base_url();?>assets/images/Alexa.png" alt="SiteSpy" class="pull-left img-responsive"> <?php echo $this->lang->line("Alexa Data"); ?></h3>
					<div class="box-tools pull-right">
						<button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
					</div><!-- /.box-tools -->
				</div><!-- /.box-header -->
				<div class="box-body table-responsive">
					<?php 
						if(empty($alexa_info_full)) echo "<h3 class='text-center'>No data to show</h3>";
						else {
					?>

					<table class="table table-hover table-striped table-bordered table-condensed ">
						<tr>
							<th>Name</th>
							<th>Details</th>
						</tr>
						<?php foreach($alexa_info_full as $value): ?>
							<tr>
								<td><?php echo $value['domain_name']; ?></td>
								<td><a class="label label-default" target="_blank" href="<?php echo base_url('rank/alexa_details').'/'.$value['id']; ?>"><i class="fa fa-binoculars"></i> View Details</a></td>
							</tr>
						<?php endforeach; ?>
					</table>
					<?php } ?>
					<br>
					<div class="text-center" style="margin-top: 5px;"><span><a class="btn btn-default btn-sm" href="<?php echo base_url('rank/alexa_rank_full'); ?>"  target="_blank"><i class="fa fa-arrow-circle-right"></i> More Info</a></span></div>
				</div><!-- /.box-body -->
			</div><!-- /.box -->			
		</div>
	</div>

</div>

<input type="hidden" id="website_name_1" value="<?php if(isset($website_name_1)) echo $website_name_1; ?>">
<input type="hidden" id="website_name_2" value="<?php if(isset($website_name_2)) echo $website_name_2; ?>">
<input type="hidden" id="website_name_3" value="<?php if(isset($website_name_3)) echo $website_name_3; ?>">
<input type="hidden" id="website_name_4" value="<?php if(isset($website_name_4)) echo $website_name_4; ?>">

<script type="text/javascript">
	$j("document").ready(function(){
		var domain_name_1 = $("#website_name_1").val();
		$("#domain_name_1").text(domain_name_1);
		$("#country_domain_name_1").text(domain_name_1);
		var domain_name_2 = $("#website_name_2").val();
		$("#domain_name_2").text(domain_name_2);
		$("#country_domain_name_2").text(domain_name_2);
		var domain_name_3 = $("#website_name_3").val();
		$("#domain_name_3").text(domain_name_3);
		$("#country_domain_name_3").text(domain_name_3);
		var domain_name_4 = $("#website_name_4").val();
		$("#domain_name_4").text(domain_name_4);
		$("#country_domain_name_4").text(domain_name_4);

		/****************  Day Wise Click Report Line Chanrt  ********************/
	    var day_wise_click_report_1=JSON.parse($("#day_wise_click_report_1").val());
		var line = new Morris.Line({
	          element: 'day_wise_click_report_chart_1',
	          resize: true,
	          data: day_wise_click_report_1,
	          xkey: 'date',
	          ykeys: ['user'],
	          labels: ['Click'],
	          lineColors: ['#3c8dbc'],
	          hideHover: 'auto',
	          lineWidth: 1
	    });
	    var day_wise_click_report_2=JSON.parse($("#day_wise_click_report_2").val());
		var line = new Morris.Line({
	          element: 'day_wise_click_report_chart_2',
	          resize: true,
	          data: day_wise_click_report_2,
	          xkey: 'date',
	          ykeys: ['user'],
	          labels: ['Click'],
	          lineColors: ['#3c8dbc'],
	          hideHover: 'auto',
	          lineWidth: 1
	    });
	    var day_wise_click_report_3=JSON.parse($("#day_wise_click_report_3").val());
		var line = new Morris.Line({
	          element: 'day_wise_click_report_chart_3',
	          resize: true,
	          data: day_wise_click_report_3,
	          xkey: 'date',
	          ykeys: ['user'],
	          labels: ['Click'],
	          lineColors: ['#3c8dbc'],
	          hideHover: 'auto',
	          lineWidth: 1
	    });
	    var day_wise_click_report_4=JSON.parse($("#day_wise_click_report_4").val());
		var line = new Morris.Line({
	          element: 'day_wise_click_report_chart_4',
	          resize: true,
	          data: day_wise_click_report_3,
	          xkey: 'date',
	          ykeys: ['user'],
	          labels: ['Click'],
	          lineColors: ['#3c8dbc'],
	          hideHover: 'auto',
	          lineWidth: 1
	    });
		/****************  Day Wise Click Report  ********************/


		/****************  Day Wise Click Comparison Report  ********************/
	    var day_wise_click_comparison_report=JSON.parse($("#day_wise_click_comparison_report").val());
	    var domain_list=JSON.parse($("#domain_list").val());
		var area = new Morris.Line({
		    element: 'day_wise_click_comparsion_report_chart',
		    resize: true,
		    data: day_wise_click_comparison_report,
		    xkey: 'date',
		    ykeys: domain_list,
		    labels: domain_list,
		    lineColors: ['#FFB85F', '#357CA5', '#FFC0CB','#624E84'],
		    // lineColors: ['#FFB85F', '#74828F', '#BEB9B5', '#C25B56','#BCCF3D','#D79C8C'],
		    hideHover: 'auto',
		    pointSize: 6,
		    lineWidth: 2
		  });
		/****************  Day Wise Click Comparison Report  ********************/


		//TRAFFIC BAR CHART
		var traffic_soure_barchart_1=JSON.parse($("#traffic_soure_barchart_1").val());
        var bar = new Morris.Bar({
          element: 'traffic_barchart_1',
          resize: true,
          data: traffic_soure_barchart_1,
          barColors: ['#218C8D'],
          xkey: 'source_name',
          ykeys: ['value'],
          labels: ['Visitor'],
          hideHover: 'auto'
        });
        var traffic_soure_barchart_2=JSON.parse($("#traffic_soure_barchart_2").val());
        var bar = new Morris.Bar({
          element: 'traffic_barchart_2',
          resize: true,
          data: traffic_soure_barchart_2,
          barColors: ['#218C8D'],
          xkey: 'source_name',
          ykeys: ['value'],
          labels: ['Visitor'],
          hideHover: 'auto'
        });
        var traffic_soure_barchart_3=JSON.parse($("#traffic_soure_barchart_3").val());
        var bar = new Morris.Bar({
          element: 'traffic_barchart_3',
          resize: true,
          data: traffic_soure_barchart_3,
          barColors: ['#218C8D'],
          xkey: 'source_name',
          ykeys: ['value'],
          labels: ['Visitor'],
          hideHover: 'auto'
        });
        var traffic_soure_barchart_4=JSON.parse($("#traffic_soure_barchart_4").val());
        var bar = new Morris.Bar({
          element: 'traffic_barchart_4',
          resize: true,
          data: traffic_soure_barchart_4,
          barColors: ['#218C8D'],
          xkey: 'source_name',
          ykeys: ['value'],
          labels: ['Visitor'],
          hideHover: 'auto'
        });
		/******************************/


		
        var pieOptions = {
          //Boolean - Whether we should show a stroke on each segment
          segmentShowStroke: true,
          //String - The colour of each segment stroke
          segmentStrokeColor: "#fff",
          //Number - The width of each segment stroke
          segmentStrokeWidth: 2,
          //Number - The percentage of the chart that we cut out of the middle
          percentageInnerCutout:0, // This is 0 for Pie charts
          //Number - Amount of animation steps
          animationSteps: 100,
          //String - Animation easing effect
          animationEasing: "easeOutBounce",
          //Boolean - Whether we animate the rotation of the Doughnut
          animateRotate: true,
          //Boolean - Whether we animate scaling the Doughnut from the centre
          animateScale: false,
          //Boolean - whether to make the chart responsive to window resizing
          responsive: true,
          // Boolean - whether to maintain the starting aspect ratio or not when responsive, if set to false, will take up entire container
          maintainAspectRatio: false
        };

        var pieOptions2 = {
          //Boolean - Whether we should show a stroke on each segment
          segmentShowStroke: true,
          //String - The colour of each segment stroke
          segmentStrokeColor: "#fff",
          //Number - The width of each segment stroke
          segmentStrokeWidth: 2,
          //Number - The percentage of the chart that we cut out of the middle
          percentageInnerCutout: 30, // This is 0 for Pie charts
          //Number - Amount of animation steps
          animationSteps: 100,
          //String - Animation easing effect
          animationEasing: "easeOutBounce",
          //Boolean - Whether we animate the rotation of the Doughnut
          animateRotate: true,
          //Boolean - Whether we animate scaling the Doughnut from the centre
          animateScale: false,
          //Boolean - whether to make the chart responsive to window resizing
          responsive: true,
          // Boolean - whether to maintain the starting aspect ratio or not when responsive, if set to false, will take up entire container
          maintainAspectRatio: false
        };

        //-------------
		  //- PIE CHART -
		  //-------------
		  // Get context with jQuery - using jQuery's .get() method.
		  var pieChartCanvas = $("#visitor_type_pieChart_1").get(0).getContext("2d");
		  var pieChart = new Chart(pieChartCanvas);
		  var pie_chart_data_1 = $("#pie_chart_data_1").val();
		  if(pie_chart_data_1 != "" && pie_chart_data_1 != "undefined"){
			  var PieData1 = JSON.parse(pie_chart_data_1);			  
			  // You can switch between pie and douhnut using the method below.  
			  pieChart.Doughnut(PieData1, pieOptions);
			  //-----------------
			  //- END PIE CHART -
			  //-----------------
		  }


		  //-------------
		  //- PIE CHART -
		  //-------------
		  // Get context with jQuery - using jQuery's .get() method.
		  var pieChartCanvas = $("#country_type_pieChart_1").get(0).getContext("2d");
		  var pieChart = new Chart(pieChartCanvas);
		  var country_chart_data_1 = $("#country_chart_data_1").val();
		  if(country_chart_data_1 != "" && country_chart_data_1 != "undefined"){
			  var countryData1 = JSON.parse(country_chart_data_1);			  
			  // You can switch between pie and douhnut using the method below.  
			  pieChart.Doughnut(countryData1, pieOptions2);
			  //-----------------
			  //- END PIE CHART -
			  //-----------------
		  }



		  //-------------
		  //- PIE CHART -
		  //-------------
		  // Get context with jQuery - using jQuery's .get() method.
		  var pieChartCanvas = $("#visitor_type_pieChart_2").get(0).getContext("2d");
		  var pieChart = new Chart(pieChartCanvas);
		  var pie_chart_data_2 = $("#pie_chart_data_2").val();
		  if(pie_chart_data_2 != "" && pie_chart_data_2 != "undefined"){

			  var PieData2 = JSON.parse(pie_chart_data_2);
			  
			  // You can switch between pie and douhnut using the method below.  
			  pieChart.Doughnut(PieData2, pieOptions);
			  //-----------------
			  //- END PIE CHART -
			  //-----------------
		  }


		  //-------------
		  //- PIE CHART -
		  //-------------
		  // Get context with jQuery - using jQuery's .get() method.
		  var pieChartCanvas = $("#country_type_pieChart_2").get(0).getContext("2d");
		  var pieChart = new Chart(pieChartCanvas);
		  var country_chart_data_2 = $("#country_chart_data_2").val();
		  if(country_chart_data_2 != "" && country_chart_data_2 != "undefined"){
			  var countryData2 = JSON.parse(country_chart_data_2);			  
			  // You can switch between pie and douhnut using the method below.  
			  pieChart.Doughnut(countryData2, pieOptions2);
			  //-----------------
			  //- END PIE CHART -
			  //-----------------
		  }



		  //-------------
		  //- PIE CHART -
		  //-------------
		  // Get context with jQuery - using jQuery's .get() method.
		  var pieChartCanvas = $("#visitor_type_pieChart_3").get(0).getContext("2d");
		  var pieChart = new Chart(pieChartCanvas);
		  var pie_chart_data_3 = $("#pie_chart_data_3").val();
		  if(pie_chart_data_3 != "" && pie_chart_data_3 != "undefined"){		  	
			  var PieData3 = JSON.parse(pie_chart_data_3);			  
			  // You can switch between pie and douhnut using the method below.  
			  pieChart.Doughnut(PieData3, pieOptions);
			  //-----------------
			  //- END PIE CHART -
			  //-----------------
		  }



		  //-------------
		  //- PIE CHART -
		  //-------------
		  // Get context with jQuery - using jQuery's .get() method.
		  var pieChartCanvas = $("#country_type_pieChart_3").get(0).getContext("2d");
		  var pieChart = new Chart(pieChartCanvas);
		  var country_chart_data_3 = $("#country_chart_data_3").val();
		  if(country_chart_data_3 != "" && country_chart_data_3 != "undefined"){
			  var countryData3 = JSON.parse(country_chart_data_3);			  
			  // You can switch between pie and douhnut using the method below.  
			  pieChart.Doughnut(countryData3, pieOptions2);
			  //-----------------
			  //- END PIE CHART -
			  //-----------------
		  }


		   //-------------
		  //- PIE CHART -
		  //-------------
		  // Get context with jQuery - using jQuery's .get() method.
		  var pieChartCanvas = $("#visitor_type_pieChart_4").get(0).getContext("2d");
		  var pieChart = new Chart(pieChartCanvas);
		  var pie_chart_data_4 = $("#pie_chart_data_4").val();
		  if(pie_chart_data_4!= "" && pie_chart_data_4 != "undefined"){		  	
			  var PieData4 = JSON.parse(pie_chart_data_4);			  
			  // You can switch between pie and douhnut using the method below.  
			  pieChart.Doughnut(PieData4, pieOptions);
			  //-----------------
			  //- END PIE CHART -
			  //-----------------
		  }



		  //-------------
		  //- PIE CHART -
		  //-------------
		  // Get context with jQuery - using jQuery's .get() method.
		  var pieChartCanvas = $("#country_type_pieChart_4").get(0).getContext("2d");
		  var pieChart = new Chart(pieChartCanvas);
		  var country_chart_data_4 = $("#country_chart_data_4").val();
		  if(country_chart_data_4 != "" && country_chart_data_4 != "undefined"){
			  var countryData4 = JSON.parse(country_chart_data_4);			  
			  // You can switch between pie and douhnut using the method below.  
			  pieChart.Doughnut(countryData4, pieOptions2);
			  //-----------------
			  //- END PIE CHART -
			  //-----------------
		  }





	});
</script>