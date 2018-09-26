<div role="tabpanel" class="tab-pane fade" id="social_network">
	<div id="social_network_success_msg" class="text-center" ></div>		
	<!-- <div id="social_network_name"></div> -->
	<div class="row">
		<div class="col-xs-12">
			<h3><div class="well text-center">Domain Name - <span class="domain_name"></span></div></h3>
		</div>
	</div>

	<div class="row">
		<div class="col-xs-12 col-sm-6 col-sm-offset-3">
			<div class="text-center"><h2 style="font-weight:900;">Social Network Comparison</h2></div>
			<div class="box-body">
				<div class="row">
					<div class="col-md-8 col-xs-12">
						<div class="chart-responsive">
							<canvas id="social_network_pieChart" height="220"></canvas>
						</div><!-- ./chart-responsive -->
					</div><!-- /.col -->
					<div class="col-md-4 col-xs-12" style="padding-top:35px;">
						<ul class="chart-legend clearfix" id="color_codes">
						</ul>
					</div><!-- /.col -->
				</div><!-- /.row -->
			</div><!-- /.box-body -->
		</div>		
	</div>
	
	<div class="row" style="margin-top: 25px;"></div>

	<div class="row">

		<div class="col-xs-12 col-sm-12 col-md-4">
			<div class="box box-warning" style="border:1px solid #ccc;">
				<div class="box-header with-border" >
					<h3 class="box-title text-center"><i class="fa fa-pinterest-p" style="color: orange;"></i> Pinterest Info</h3>
					<div class="box-tools pull-right">
						<button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
					</div><!-- /.box-tools -->
				</div><!-- /.box-header -->
				<div class="box-body" style="background: #eee;">
					<h1 style="color: orange;" id="pinterest_pin"></h1>
					<b>Pinterest Pin</b>
				</div><!-- /.box-body -->
			</div><!-- /.box -->
		</div>
		<div class="col-xs-12 col-sm-12 col-md-4">
			<div class="box box-warning" style="border:1px solid #ccc;">
				<div class="box-header with-border" >
					<h3 class="box-title text-center"><i class="fa fa-btc" style="color: orange;"></i> Buffer Info</h3>
					<div class="box-tools pull-right">
						<button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
					</div><!-- /.box-tools -->
				</div><!-- /.box-header -->
				<div class="box-body" style="background: #eee;">
					<h1 style="color: orange;" id="buffer_share"></h1>
					<b>Buffer Share</b>
				</div><!-- /.box-body -->
			</div><!-- /.box -->
		</div>
		<div class="col-xs-12 col-sm-12 col-md-4">
			<div class="box box-warning" style="border:1px solid #ccc;">
				<div class="box-header with-border" >
					<h3 class="box-title text-center"><i class="fa fa-xing" style="color: orange;"></i> Xing Info</h3>
					<div class="box-tools pull-right">
						<button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
					</div><!-- /.box-tools -->
				</div><!-- /.box-header -->
				<div class="box-body" style="background: #eee;">
					<h1 style="color: orange;" id="xing_share"></h1>
					<b>Xing Share</b>
				</div><!-- /.box-body -->
			</div><!-- /.box -->
		</div>
		<div class="col-xs-12 col-sm-12 col-md-4">
			<div class="box box-warning" style="border:1px solid #ccc;">
				<div class="box-header with-border" >
					<h3 class="box-title text-center"><i class="fa fa-facebook" style="color: orange;"></i> Facebook Info</h3>
					<div class="box-tools pull-right">
						<button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
					</div><!-- /.box-tools -->
				</div><!-- /.box-header -->
				<div class="box-body" style="background: #eee;">
					<h1 style="color: orange;" id="fb_total_share"></h1>
					<b>Facebook Share</b>
				</div><!-- /.box-body -->
			</div><!-- /.box -->
		</div>
		<div class="col-xs-12 col-sm-12 col-md-4">
			<div class="box box-warning" style="border:1px solid #ccc;">
				<div class="box-header with-border" >
					<h3 class="box-title text-center"><i class="fa fa-facebook" style="color: orange;"></i> Stumbleupon Info</h3>
					<div class="box-tools pull-right">
						<button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
					</div><!-- /.box-tools -->
				</div><!-- /.box-header -->
				<div class="box-body" style="background: #eee;">
					<h1 style="color: orange;" id="stumbleupon_total_view"></h1>
					<b>Stumbleupon View</b>
				</div><!-- /.box-body -->
			</div><!-- /.box -->
		</div>
	</div>

	<div class="row" style="">
		<div class="col-xs-12 text-center"><h2 style="color: #00A65A;">Reddit Information</h2></div>
		<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
			<div class="info-box bg-blue">
				<span class="info-box-icon"><i class="fa fa-reddit"></i></span>
				<div class="info-box-content">
					<!-- <span class="info-box-text">Inventory</span> -->
					<span class="info-box-number" id="reddit_score"></span>
					<div class="progress">
						<div class="progress-bar" style="width: 70%"></div>
					</div>
					<span class="progress-description">
						<b style="font-size: 18px;">Reddit Score</b>
					</span>
				</div><!-- /.info-box-content -->
			</div><!-- /.info-box -->
		</div>
		<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
			<div class="info-box bg-green">
				<span class="info-box-icon"><i class="fa fa-reddit"></i></span>
				<div class="info-box-content">
					<!-- <span class="info-box-text">Inventory</span> -->
					<span class="info-box-number" id="reddit_ups"></span>
					<div class="progress">
						<div class="progress-bar" style="width: 70%"></div>
					</div>
					<span class="progress-description">
						<b style="font-size: 18px;">Reddit Ups</b>
					</span>
				</div><!-- /.info-box-content -->
			</div><!-- /.info-box -->
		</div>
		<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
			<div class="info-box bg-red">
				<span class="info-box-icon"><i class="fa fa-reddit"></i></span>
				<div class="info-box-content">
					<!-- <span class="info-box-text">Inventory</span> -->
					<span class="info-box-number" id="reddit_downs"></span>
					<div class="progress">
						<div class="progress-bar" style="width: 70%"></div>
					</div>
					<span class="progress-description">
						<b style="font-size: 18px;">Reddit Downs</b>
					</span>
				</div><!-- /.info-box-content -->
			</div><!-- /.info-box -->
		</div>
	</div>

</div>