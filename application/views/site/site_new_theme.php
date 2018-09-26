<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="author" content="<?php echo $this->config->item('institute_address1');?>">
    <meta name="description" content="<?php echo $this->config->item('product_name')." | ".$this->config->item('slogan');?>">

    <title><?php echo $this->config->item('product_name')." | ".$this->config->item('slogan');?></title>

    <!-- Bootstrap Core CSS -->
    <link href="<?php echo base_url('assets/site_new/vendor/bootstrap/css/bootstrap.min.css');?>" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="<?php echo base_url('assets/site_new/vendor/font-awesome/css/font-awesome.min.css');?>" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,700,300italic,400italic,700italic" rel="stylesheet" type="text/css">
    <link href="<?php echo base_url('assets/site_new/vendor/simple-line-icons/css/simple-line-icons.css');?>" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="<?php echo base_url('assets/site_new/css/stylish-portfolio.min.css');?>" rel="stylesheet">
    <link href="<?php echo base_url('assets/site_new/css/price.css');?>" rel="stylesheet">
    <link href="<?php echo base_url('assets/site_new/css/custom.css');?>" rel="stylesheet">

    <!-- Favicon -->
    <link rel="shortcut icon" href="<?php echo base_url();?>assets/images/favicon.png"> 

  </head>

  <body id="page-top">
    <!-- Navigation -->
    <a class="menu-toggle rounded" href="#">
      <i class="fa fa-bars"></i>
    </a>

    <nav id="sidebar-wrapper">
        <ul class="sidebar-nav">
          <!--logo section-->
          <li class="sidebar-brand">
            <a href="#banner"><img id="logo" style="max-height:50px !important" src="<?php echo base_url('assets/images/logo.png');?>"></a>
          </li>
          <!-- menu -->
          <li class="sidebar-nav-item">
            <a class="js-scroll-trigger" href="#page-top"><i class="fa fa-home"></i> &nbsp;&nbsp; <?php echo $this->lang->line("home"); ?></a>
          </li>
          <li class="sidebar-nav-item">
            <a class="js-scroll-trigger" href="#about"><i class="fa fa-bullhorn"></i> &nbsp;&nbsp; <?php echo $this->lang->line("about"); ?></a>
          </li>
          <li class="sidebar-nav-item">
            <a class="js-scroll-trigger" href="#features"><i class="fa fa-th-large"></i> &nbsp;&nbsp; <?php echo $this->lang->line("features"); ?></a>
          </li>
          <li class="sidebar-nav-item">
            <a class="js-scroll-trigger" href="#price"><i class="fa fa-money"></i> &nbsp;&nbsp; <?php echo $this->lang->line("pricing"); ?></a>
          </li>     
          <li class="sidebar-nav-item">
            <a class="js-scroll-trigger" href="#contact"><i class="fa fa-envelope"></i> &nbsp;&nbsp; <?php echo $this->lang->line("contact"); ?></a>
          </li>    
          <li class="sidebar-nav-item">
            <a class="js-scroll-trigger" href="<?php echo site_url('home/login'); ?>"><i class="fa fa-sign-in"></i> &nbsp;&nbsp; <?php echo $this->lang->line("login"); ?></a>            
          </li>
          <?php if($this->session->userdata("logged_in")!=1) 
          { ?>          
          <li class="sidebar-nav-item"><a class="js-scroll-trigger" href="<?php echo site_url('home/sign_up'); ?>"><i class="fa fa-user"></i> &nbsp;&nbsp; <?php echo $this->lang->line("sign up"); ?></a></li>
          <?php 
          } 
          else
          { ?>
            <li class="sidebar-nav-item"><a class="js-scroll-trigger" href="<?php echo site_url('home/logout'); ?>"><i class="fa fa-sign-out"></i> &nbsp;&nbsp; <?php echo $this->lang->line("logout"); ?></a></li>
          <?php 
          } ?>
        </ul>
    </nav>

    <!-- Header -->
    <header class="masthead d-flex">
      <div class="container text-center my-auto">
        <!-- laguage   -->             
        <div class="form-group">
          <?php 
          $select_lan="english";
          if($this->session->userdata("selected_language")=="") $select_lan=$this->config->item("language");
          else $select_lan=$this->session->userdata("selected_language");
          echo form_dropdown('language',$language_info,$select_lan,'class="form-control  pull-right" id="language_change"');?>
          <span class="red"><?php echo form_error('language'); ?></span>           
        </div>
        <!-- end language --> 
        <h1 class="mb-1"><a href="#banner"><img id="logo" src="<?php echo base_url('assets/images/logo.png');?>"></a></h1>
        <h3 class="mb-5">
          <span class="em"><?php echo $this->lang->line("catch line"); ?></span>

          <?php if($this->config->item('front_end_search_display') == 'yes') : ?>
          <div class="lead text-center form_holder">  
            <input  class="center-block" type="text" name="website_name" id="website_name" placeholder="<?php echo $this->lang->line('type web address and hit search button'); ?>">
            <button class="center-block"  id="submit" type="submit"> <i class="fa fa-search fa-2x"></i> </button>
          </div>
          <br/>
          <?php endif; ?>
          <p class="lead text-center">
            <a href="<?php echo site_url('home/sign_up'); ?>" class="btn btn-warning btn-xl js-scroll-trigger"> <?php echo $this->lang->line('sign up now');?></a>
          </p>
        </h3>      
      </div>
      <div class="overlay"></div>
    </header>

    <!-- About -->
    <section class="content-section bg-light padding-top-20" id="about">
      <div class="container-fluid">              
        <div class="space"></div>
        <div class="row">
          <div class="col-xs-12 col-md-8 offset-md-2 text-center"> 
           <?php 
            if($this->is_ad_enabled && $this->is_ad_enabled1) : ?>  
              <div class="add-970-90 hidden-xs hidden-sm"><?php echo $this->ad_content1; ?></div> 
              <div class="add-320-100 hidden-md hidden-lg"><?php echo $this->ad_content1_mobile; ?></div> 
              <br> <br>
            <?php endif; 
            ?>                     
            <h2 class="text-center orna"><?php echo $this->lang->line("analysis was never this easy!");?></h2><br><br><br>
          </div>
          <div class="col-xs-12 <?php if($this->is_ad_enabled && ($this->is_ad_enabled2 || $this->is_ad_enabled3 || $this->is_ad_enabled4)) echo "col-md-6 offset-md-1"; else echo "col-md-8 offset-md-2";?> text-justify">
            <p class="lead mb-5">
                 <img class="img-thumbnail" style="width:100%;" src="<?php echo base_url();?>assets/site_new/img/responsive.png" alt="">
                 <p class="description"><?php echo $this->lang->line('description 1');?></p>
                 <p class="description"><?php echo $this->lang->line('description 2');?></p>
                 <p class="description"><?php echo $this->lang->line('description 3');?></p>
                 <p class="description"><?php echo $this->lang->line('description 4');?></p>
            </p>
            <br><br>
            <div class="text-center"><a class="btn btn-dark btn-xl js-scroll-trigger" href="#features"><?php echo $this->lang->line("detailed features");?></a></div>
            <br>
          </div>
          <?php if($this->is_ad_enabled && ($this->is_ad_enabled2 || $this->is_ad_enabled3 || $this->is_ad_enabled4))
          { ?>
          <div class="col-xs-12 col-md-4 text-center">
            <?php 
              $part4='<div class="add-300-600 float-md-right">';
                if($this->is_ad_enabled4) $part4.=$this->ad_content4;
              $part4.='</div>';
              echo $part4;
              $part2='<div class="add-300-250 float-md-right">';
                if($this->is_ad_enabled2) $part2.="<div style='margin-top:20px'></div>".$this->ad_content2;
                if($this->is_ad_enabled3) $part2.="<div style='margin-top:20px'></div>".$this->ad_content3;
              $part2.='</div>';
              echo $part2;            
            ?>
          </div>
          <?php 
          } ?>
        </div>
      </div>
    </section>

    <!-- Services -->
    <section class="content-section bg-primary text-white text-center" id="features">
      <div class="container">
        <div class="content-section-heading">
          <h2 class="mb-5"><?php echo $this->lang->line("detailed features");?></h2>
          <br><br>
        </div>
        <div class="row row1">
          <div class="col-lg-4 col-md-6 mb-5 mb-lg-0">
            <div class="deatils-container">
              <span class="service-icon rounded-circle mx-auto mb-3">
                <i class="fa fa-line-chart"></i>
              </span>
              <h4>
                <strong class="orange"><?php echo $this->lang->line("visitor analysis");?></strong>
              </h4>
              <p class="text-faded mb-0 black">
                <hr>
                <ul class="text-left">
                    <li>Unique Visitor</li>
                    <li>Page View</li>
                    <li>Bounce Rate</li>
                    <li>Average Stay Time</li>
                    <li>Average Visit</li>
                    <li>Traffic Analysis</li>
                    <li>Top Refferer</li>
                    <li>New & Returning Visitor</li>
                    <li>Content Overview</li>
                    <li>Country & Browser Report</li>
                    <li>OS & Device Report</li>
                  </ul>
              </p>
            </div>
          </div>
          <div class="col-lg-4 col-md-6 mb-5 mb-lg-0">
            <div class="deatils-container">
              <span class="service-icon rounded-circle mx-auto mb-3">
                <i class="fa fa-share-alt"></i>
              </span>
              <h4>
                <strong class="orange"><?php echo $this->lang->line("social network analysis");?></strong>
              </h4>
              <p class="text-faded mb-0 black">
                <hr>
                <ul class="text-left">
                  <li>Facebook Share</li>
                  <li>Xing Share</li>
                  <li>Reddit Score, Up, Down</li>
                  <li>Pinterest Pin</li>
                  <li>Buffer Share</li>
                  <li>StumbleUpon View</li>   
                </ul>
              </p>
            </div>
          </div>
          <div class="col-lg-4 col-md-6 mb-5 mb-lg-0">
            <div class="deatils-container">
              <span class="service-icon rounded-circle mx-auto mb-3">
                <i class="fa fa-line-chart"></i>
              </span>
              <h4>
                <strong class="orange"><?php echo $this->lang->line("rank & index analysis");?></strong>
              </h4>
              <p class="text-faded mb-0 black">
                <hr>
                <ul class="text-left">
                    <li>Alexa Rank</li>
                    <li>Alexa Data</li>
                    <li>SimilarWeb Rank &amp; Data</li>
                    <li>MOZ Check</li>
                    <!-- <li>Google Page Rank</li> -->
                    <li>Google Index</li>
                    <li>Yahoo Index</li>
                    <li>Bing Index</li>
                </ul>
              </p>
            </div>
          </div>
        </div>
        <br>
        <div class="row row2">
          <div class="col-lg-4 col-md-6 mb-5 mb-lg-0">
            <div class="deatils-container">
              <span class="service-icon rounded-circle mx-auto mb-3">
                <i class="fa fa-server"></i>
              </span>
              <h4>
                <strong class="orange"><?php echo $this->lang->line("domain analysis");?></strong>
              </h4>
              <p class="text-faded mb-0 black">
                <hr>
                <ul class="text-left">
                  <li>Whois Search</li>
                  <li>Auction Domain List</li>
                  <li>DNS Information</li>
                  <li>Server Information</li>
                </ul>
              </p>
            </div>
          </div>
          <div class="col-lg-4 col-md-6 mb-5 mb-lg-0">
            <div class="deatils-container">
              <span class="service-icon rounded-circle mx-auto mb-3">
                <i class="fa fa-map-marker"></i>
              </span>
              <h4>
                <strong class="orange"><?php echo $this->lang->line("ip analysis");?></strong>
              </h4>
              <p class="text-faded mb-0 black">
                <hr>
                <ul class="text-left"> 
                  <li>What is my IP</li>
                  <li>Domain IP Information</li>
                  <li>Sites in Same IP</li> 
                  <li>Ipv6 Compability Check</li> 
                  <li>IP Canonical Check</li> 
                  <li>IP Traceout</li> 
                </ul>
              </p>
            </div>
          </div>
          <div class="col-lg-4 col-md-6 mb-5 mb-lg-0">
            <div class="deatils-container">
              <span class="service-icon rounded-circle mx-auto mb-3">
                <i class="fa fa-tags"></i>
              </span>
              <h4>
                <strong class="orange"><?php echo $this->lang->line("keyword analysis");?></strong>
              </h4>
              <p class="text-faded mb-0 black">
                <hr>
                <ul class="text-left">
                  <li>Keyword Analyzer</li>
                  <li>Keyword Position</li>
                  <li>Keyword Position Tracking (Daily)</li>
                  <li>Correlared Trending Keywords</li>
                  <li>Keyword Auto Suggestion</li>
                </ul>
              </p>
            </div>
          </div>
        </div>
        <br>
        <div class="row row3">
          <div class="col-lg-4 col-md-6 mb-5 mb-lg-0">
            <div class="deatils-container">
              <span class="service-icon rounded-circle mx-auto mb-3">
                <i class="fa fa-link"></i>
              </span>
              <h4>
                <strong class="orange"><?php echo $this->lang->line("backlink & ping");?></strong>
              </h4>
              <p class="text-faded mb-0 black">
                <hr>
                <ul class="text-left">
                  <li>Google Backlink Search</li>
                  <li>Backlink Generator</li>
                  <li>Website/Blog Ping</li>
                </ul>
              </p>
            </div>
          </div>
          <div class="col-lg-4 col-md-6 mb-5 mb-lg-0">
            <div class="deatils-container">
              <span class="service-icon rounded-circle mx-auto mb-3">
                <i class="fa fa-shield"></i>
              </span>
              <h4>
                <strong class="orange"><?php echo $this->lang->line("malware scan");?></strong>
                </h4>
                <p class="text-faded mb-0 black">
                  <hr>
                  <ul class="text-left"> 
                    <li>Google Safe Browser</li>
                    <li>Norton</li>
                    <li>VirusTotal (67 different scans) </li> 
                  </ul>
                </p>
              </div>
          </div>
          <div class="col-lg-4 col-md-6 mb-5 mb-lg-0">
              <div class="deatils-container">
                <span class="service-icon rounded-circle mx-auto mb-3">
                  <i class="fa fa-anchor"></i>
                </span>
                <h4>
                  <strong class="orange"><?php echo $this->lang->line("link analysis");?></strong>
                </h4>
                <p class="text-faded mb-0 black">
                  <hr>
                  <ul class="text-left">
                    <li>Link Analyzer <br/>(internal, external, doFollow, noFollow)</li>
                    <li>Page Status Check</li>
                  </ul>
                </p>
              </div>
          </div>
        </div>
        <br>
        <div class="row row4">
          <div class="col-lg-4 col-md-6 mb-5 mb-lg-0">
            <div class="deatils-container">
              <span class="service-icon rounded-circle mx-auto mb-3">
                <i class="fa fa-asterisk"></i>
              </span>
              <h4>
                <strong class="orange"><?php echo $this->lang->line("utilities");?></strong>
              </h4>
              <p class="text-faded mb-0 black">
                <hr>
                <ul class="text-left">
                  <li>Email Encoder/ Decoder</li>
                  <li>URL Encoder/ Decoder</li>
                  <li>Base64 Encoder/Decoder</li>
                  <li>Meta Tag Generator</li>
                  <li>Robot Code Generator</li>
                  <li>Plagiarism Check</li>
                  <li>Valid Email Check</li>
                  <li>Duplicate Email Filter</li>
                  <li>URL Canonical Check</li>
                  <li>Gzip Check</li>
                </ul>
              </p>
            </div>
          </div>
          <div class="col-lg-4 col-md-6 mb-5 mb-lg-0">
            <div class="deatils-container">
              <span class="service-icon rounded-circle mx-auto mb-3">
                <i class="fa fa-google"></i>
              </span>
              <h4>
                <strong class="orange"><?php echo $this->lang->line("Google Tools");?></strong>
                </h4>
                <p class="text-faded mb-0 black">
                  <hr>
                  <ul class="text-left">  
                    <li>Google URL Shortener + Analytics</li>
                    <li>Google Adwords Scraper</li>
                  </ul>
                </p>
              </div>
          </div>
          <div class="col-lg-4 col-md-6 mb-5 mb-lg-0">
              <div class="deatils-container">
                <span class="service-icon rounded-circle mx-auto mb-3">
                  <i class="fa fa-code"></i>
                </span>
                <h4>
                  <strong class="orange"><?php echo $this->lang->line("code minifier");?></strong>
                </h4>
                <p class="text-faded mb-0 black">
                  <hr>
                  <ul class="text-left">
                    <li>HTML code minifier</li>
                    <li>CSS code minifier</li>
                    <li>JS code minifier</li>
                  </ul>
                </p>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- TRIAL price -->
    <section class="content-section bg-warning text-white" id="price">
      <div class="container text-center">
          <?php
          if(isset($default_package[0])) 
            { ?>
              <h2 class="mb-4"><?php echo $this->lang->line("trial"); ?> : <?php echo $default_package[0]["validity"] ?> <?php echo $this->lang->line("days"); ?> - <?php echo $this->lang->line("try if for free now, buy it if you like it."); ?></h2>
            <?php 
            } 
          ?>
        <a href="<?php echo site_url('home/sign_up'); ?>" class="btn btn-xl btn-light"><?php echo $this->lang->line("sign up"); ?></a>
        <a href="<?php echo site_url('home/login'); ?>" class="btn btn-xl btn-dark"><?php echo $this->lang->line("login"); ?></a>
      </div>
    </section>


    <!-- pricing table start -->     
    <div class="container-fluid">  
      <!--BLOCK ROW START-->
      <div class="row"  id="pricing">
        <?php 
        $ct=0;
        foreach($payment_package as $pack)
        {
          $ct++;
          $class=""; 
          if($ct==2) $class="blue";
          if($ct==3) $class="orange";
          if($ct==4) $class="red";
          ?>
          <div class="col-xs-12 col-md-3">
            <!--PRICE CONTENT START-->
            <div class="generic_content <?php echo $class;?> clearfix"> 
              <!--HEAD PRICE DETAIL START-->
              <div class="generic_head_price clearfix">
                <!--HEAD CONTENT START-->
                <div class="generic_head_content clearfix">
                  <!--HEAD START-->
                  <div class="head_bg"></div>
                  <div class="head">
                    <span><?php echo $pack["package_name"]; ?></span>
                  </div>
                  <!--//HEAD END-->   
                </div>
                <!--//HEAD CONTENT END-->
                <!--PRICE START-->
                <div class="generic_price_tag clearfix">  
                  <span class="price">
                    <span class="sign"><?php echo $currency; ?></span>
                    <span class="currency"><?php echo $pack["price"]?> /</span>
                    <span class="cent"><?php echo $pack["validity"]?></span>
                    <span class="month"><?php echo $this->lang->line("days"); ?></span>
                  </span>
                </div>
                <!--//PRICE END-->    
              </div>                            
              <!--//HEAD PRICE DETAIL END-->

              <!--FEATURE LIST START-->
              <div class="generic_feature_list">
                <ul>
                  <?php 
                  $module_ids=$pack["module_ids"];
                  $monthly_limit=json_decode($pack["monthly_limit"],true);
                  $module_names_array=$this->basic->execute_query('SELECT module_name,id FROM modules WHERE FIND_IN_SET(id,"'.$module_ids.'") > 0  ORDER BY module_name ASC');  
                  foreach ($module_names_array as $row) 
                  {
                    $limit=0;
                    $limit=$monthly_limit[$row["id"]];
                    if($limit=="0") $limit2="<b>".$this->lang->line("unlimited")."</b>";
                    else $limit2=$limit;
                    if($row["id"]!="1" && $limit!="0") $limit2="<b>".$limit2."/".$this->lang->line("month")."</b>";
                    echo "<li><span>".$this->lang->line($row["module_name"])."</span>";
                    if($row["id"]!="13" && $row["id"]!="14" && $row["id"]!="16") echo " : <b>". $limit2."</b>"."<br></li>";
                      else echo "<br></li>";
                    }
                    ?>
                    <!-- <li><span>Backlink & Ping : <b></span><b>Unlimited</b></b></li> -->
                </ul>
              </div>
              <!--//FEATURE LIST END-->
              <!--BUTTON START-->
              <div class="generic_price_btn clearfix">
                <a class="" href="http://sitespy.xeroneit.net/home/sign_up"><?php echo $this->lang->line("Sign up");?></a>
              </div>
                <!--//BUTTON END-->             
            </div>
              <!--//PRICE CONTENT END-->        
          </div>
          <?php 
        } ?>
      </div>  
      <!--//BLOCK ROW END-->     
    </div>
  
    <!-- //end price table// -->

    <!-- CONTACT START -->
     <!-- TRIAL price -->
    <section class="content-section bg-primary text-white" id="contact">
      <div class="container-fluid">
        <h2 class="mb-4 text-center"><?php echo $this->lang->line("feel free to contact us");?></h2>
        <hr><br><br>
        <div class="row">
          <div class="col-md-5 offset-md-1 col-xs-12">
            <div class="contact-form">
              <form action="<?php echo base_url('home/email_contact');?>" method="POST">
                <div>
                    <?php 
                    if($this->session->userdata('mail_sent') == 1) {
                      echo "<div class='alert alert-success text-center'>".$this->lang->line("we have received your email. we will contact you through email as soon as possible")."</div>";
                      $this->session->unset_userdata('mail_sent');
                    }
                    ?>
                </div>
                <div class="row" >
                  <div class="comment-box"></div>                  
                  <div class="col-md-6 form-group">
                    <input name="email" class="form-control" <?php echo set_value("email"); ?>  required  placeholder="<?php echo $this->lang->line("email");?>" type="email">
                    <span class="red"><?php echo form_error("email") ?></span>
                  </div>
                  <div class="col-md-6 form-group">
                    <input name="subject" class="form-control" <?php echo set_value("subject"); ?> required  placeholder="<?php echo $this->lang->line("message subject");?>" type="text">
                    <span class="red"><?php echo form_error("subject") ?></span>
                  </div>

                  <label class="col-md-12 control-label" for="textarea"></label>
                  <div class="col-md-12">                     
                    <textarea class="form-control" id="textarea" <?php echo set_value("message"); ?> required  placeholder="<?php echo $this->lang->line("message");?>" name="message"></textarea>
                    <span class="red"><?php echo form_error("message") ?></span><br>
                  </div>

                  <div class="col-md-12 text-right">
                    <label  class="sr-only" for="captcha"><?php echo $this->lang->line("captcha");?> * </label>
                    <input type="number" class="form-control" step="1" id="captcha" <?php echo set_value("captcha"); ?> required  placeholder="<?php echo $contact_num1. "+". $contact_num2." = ?"; ?>" name="captcha">
                    <span class="red text-left">
                      <?php 
                      if(form_error('captcha')) 
                        echo form_error('captcha'); 
                      else  
                      { 
                        echo $this->session->userdata("contact_captcha_error"); 
                        $this->session->unset_userdata("contact_captcha_error"); 
                      } 
                      ?>
                    </span>
                    <button class="contact-btn" type="submit"><?php echo $this->lang->line("send email");?></button>
                  </div>
                </div>
              </form>
            </div>
          </div>
          <div class="col-md-4 offset-md-1 col-sm-12">
            <div class="contact-info">
              <h4><i class="fa fa-hand-o-right pr-10"></i> &nbsp;<?php echo $this->config->item("product_name"); ?></h4>
              <h4><i class="fa fa-map-marker pr-10"></i> &nbsp;<?php echo $this->config->item("institute_address2"); ?></h4>
              <h4><i class="fa fa-phone pr-10"></i> &nbsp;<?php echo $this->config->item("institute_mobile"); ?></h4>
              <h4><i class="fa fa-building pr-10"></i> &nbsp;<?php echo $this->config->item("institute_address1"); ?></h4>
              <h4><i class="fa fa-envelope-o pr-10"></i> &nbsp;<?php echo $this->config->item("institute_email"); ?></h4>       
            </div>
          </div>
        </div>          
      </div>
    </section>

    <!-- END CONTACT -->


    <!-- Footer -->
    <footer class="footer text-center bg-info">
      <div class="container">
        <ul class="list-inline mb-5">
          <li class="list-inline-item">
            <a class="social-link rounded-circle text-white mr-3" href="#">
              <i class="icon-social-facebook"></i>
            </a>
          </li>
          <li class="list-inline-item">
            <a class="social-link rounded-circle text-white mr-3" href="#">
              <i class="icon-social-twitter"></i>
            </a>
          </li>
          <li class="list-inline-item">
            <a class="social-link rounded-circle text-white" href="#">
              <i class="icon-social-youtube"></i>
            </a>
          </li>
        </ul>
        <p class="text-muted small mb-0"><?php echo $this->config->item("product_short_name"); ?> &copy; <a target="_blank" href="<?php echo site_url(); ?>"><?php echo $this->config->item("institute_address1"); ?></a></p>
      </div>
    </footer>

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded js-scroll-trigger" href="#page-top">
      <i class="fa fa-angle-up"></i>
    </a>

    <!-- Bootstrap core JavaScript -->
    <script src="<?php echo base_url('assets/site_new/vendor/jquery/jquery.min.js');?>"></script>
    <script src="<?php echo base_url('assets/site_new/vendor/bootstrap/js/bootstrap.bundle.min.js');?>"></script>

    <!-- Plugin JavaScript -->
    <script src="<?php echo base_url('assets/site_new/vendor/jquery-easing/jquery.easing.min.js');?>"></script>

    <!-- Custom scripts for this template -->
    <script src="<?php echo base_url('assets/site_new/js/stylish-portfolio.min.js');?>"></script>

  </body>

</html>

<?php $this->load->view('site/site_theme_script_modal'); ?>
<script type="text/javascript">
  $(document).ready(function() {
    $("#language_change").change(function(){
      var language=$(this).val();
      $("#language_label").html("Loading Language...");
      $.ajax({
        url: '<?php echo site_url("home/language_changer");?>',
        type: 'POST',
        data: {language:language},
        success:function(response){
          $("#language_label").html("Language");
          location.reload(); 
        }
      })

    });
  });
</script>