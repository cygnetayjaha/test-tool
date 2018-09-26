<?php

require_once("Home.php"); // loading home controller

class Antivirus extends Home
{

    public $user_id;    
    public $scan_places;    
    
    public function __construct()
    {
        parent::__construct();
        if ($this->session->userdata('logged_in') != 1)
        redirect('home/login_page', 'location');       
 
        $this->user_id=$this->session->userdata('user_id');
        set_time_limit(0);

        $this->important_feature();
        $this->member_validity();
        if($this->session->userdata('user_type') != 'Admin' && !in_array(10,$this->module_access))
        redirect('home/login_page', 'location'); 


        $this->scan_places=array (
          0 => 'CLEAN MX',
          1 => 'DNS8',
          2 => 'OpenPhish',
          3 => 'VX Vault',
          4 => 'ZDB Zeus',
          5 => 'ZCloudsec',
          6 => 'PhishLabs',
          7 => 'Zerofox',
          8 => 'K7AntiVirus',
          9 => 'FraudSense',
          10 => 'Virusdie External Site Scan',
          11 => 'Quttera',
          12 => 'AegisLab WebGuard',
          13 => 'MalwareDomainList',
          14 => 'ZeusTracker',
          15 => 'zvelo',
          16 => 'Google Safebrowsing',
          17 => 'Kaspersky',
          18 => 'BitDefender',
          19 => 'Opera',
          20 => 'Certly',
          21 => 'G-Data',
          22 => 'C-SIRT',
          23 => 'CyberCrime',
          24 => 'SecureBrain',
          25 => 'Malware Domain Blocklist',
          26 => 'MalwarePatrol',
          27 => 'Webutation',
          28 => 'Trustwave',
          29 => 'Web Security Guard',
          30 => 'CyRadar',
          31 => 'desenmascara.me',
          32 => 'ADMINUSLabs',
          33 => 'Malwarebytes hpHosts',
          34 => 'Dr.Web',
          35 => 'AlienVault',
          36 => 'Emsisoft',
          37 => 'Rising',
          38 => 'Malc0de Database',
          39 => 'malwares.com URL checker',
          40 => 'Phishtank',
          41 => 'Malwared',
          42 => 'Avira',
          43 => 'NotMining',
          44 => 'StopBadware',
          45 => 'Antiy-AVL',
          46 => 'Forcepoint ThreatSeeker',
          47 => 'SCUMWARE.org',
          48 => 'Comodo Site Inspector',
          49 => 'Malekal',
          50 => 'ESET',
          51 => 'Sophos',
          52 => 'Yandex Safebrowsing',
          53 => 'Spam404',
          54 => 'Nucleon',
          55 => 'Sucuri SiteCheck',
          56 => 'Blueliv',
          57 => 'Netcraft',
          58 => 'AutoShun',
          59 => 'ThreatHive',
          60 => 'FraudScore',
          61 => 'Tencent',
          62 => 'URLQuery',
          63 => 'Fortinet',
          64 => 'ZeroCERT',
          65 => 'Baidu-International',
          66 => 'securolytics',
        );

    }

    public function index()
    {
        $this->scan();
    }

    public function scan()
    {
        $data['body'] = 'admin/antivirus/antivirus_scan';
        $data['page_title'] = $this->lang->line('malware scan');
        $this->_viewcontroller($data);
    }
    

    public function scan_data()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'GET')
        redirect('home/access_forbidden', 'location');
        

        $page = isset($_POST['page']) ? intval($_POST['page']) : 15;
        $rows = isset($_POST['rows']) ? intval($_POST['rows']) : 5;
        $sort = isset($_POST['sort']) ? strval($_POST['sort']) : 'id';
        $order = isset($_POST['order']) ? strval($_POST['order']) : 'DESC';

        $domain_name = trim($this->input->post("domain_name", true));

        $from_date = trim($this->input->post('from_date', true));        
        if($from_date) $from_date = date('Y-m-d', strtotime($from_date));

        $to_date = trim($this->input->post('to_date', true));
        if($to_date) $to_date = date('Y-m-d', strtotime($to_date));


        // setting a new properties for $is_searched to set session if search occured
        $is_searched = $this->input->post('is_searched', true);


        if ($is_searched) 
        {
            // if search occured, saving user input data to session. name of method is important before field
            $this->session->set_userdata('antivirus_scan_domain_name', $domain_name);
            $this->session->set_userdata('antivirus_scan_from_date', $from_date);
            $this->session->set_userdata('antivirus_scan_to_date', $to_date);
        }

        // saving session data to different search parameter variables
        $search_domain_name   = $this->session->userdata('antivirus_scan_domain_name');
        $search_from_date  = $this->session->userdata('antivirus_scan_from_date');
        $search_to_date = $this->session->userdata('antivirus_scan_to_date');

        // creating a blank where_simple array
        $where_simple=array();
        
        if ($search_domain_name)    $where_simple['domain_name like ']    = "%".$search_domain_name."%";
        if ($search_from_date) 
        {
            if ($search_from_date != '1970-01-01'){
                $search_from_date = $search_from_date." 00:00:00";
                $where_simple["scanned_at >="]= $search_from_date;
            }
            
        }
        if ($search_to_date) 
        {
            if ($search_to_date != '1970-01-01'){
                $search_to_date = $search_to_date." 23:59:59";
                $where_simple["scanned_at <="]=$search_to_date;
            }
            
        }

        $where_simple['user_id'] = $this->user_id;
        $where  = array('where'=>$where_simple);
        $order_by_str=$sort." ".$order;
        $offset = ($page-1)*$rows;
        $result = array();
        $table = "antivirus_scan_info";
        $info = $this->basic->get_data($table, $where, $select='', $join='', $limit=$rows, $start=$offset, $order_by=$order_by_str, $group_by='');

        $total_rows_array = $this->basic->count_row($table, $where, $count="id", $join='');
        $total_result = $total_rows_array[0]['total_rows'];

        echo convert_to_grid_data($info, $total_result);
    }

    public function scan_action()
    {
        $this->load->library('web_common_report');
        $urls=$this->input->post('urls', true);
        $is_google=$this->input->post('is_google', true);
        $is_norton=$this->input->post('is_norton', true);
       
        $urls=str_replace("\n", ",", $urls);
        $url_array=explode(",", $urls);
        $url_array=array_filter($url_array);
        $url_array=array_unique($url_array);

        //************************************************//
        $status=$this->_check_usage($module_id=10,$request=count($url_array));
        if($status=="2") 
        {
            echo $this->lang->line("sorry, your bulk limit is exceeded for this module.")."<a href='".site_url('payment/usage_history')."'>".$this->lang->line("click here to see usage log")."</a>";
            exit();
        }
        else if($status=="3") 
        {
            echo $this->lang->line("sorry, your monthly limit is exceeded for this module.")."<a href='".site_url('payment/usage_history')."'>".$this->lang->line("click here to see usage log")."</a>";
            exit();
        }
        //************************************************//
        
      
        $this->session->set_userdata('antivirus_scan_bulk_total_search',count($url_array));
        $this->session->set_userdata('antivirus_scan_complete_search',0);
        $download_id= $this->session->userdata('download_id');
        
        $download_path=fopen("download/antivirus/antivirus_{$this->user_id}_{$download_id}.csv", "w");
        fprintf($download_path, chr(0xEF).chr(0xBB).chr(0xBF)); // unicode compatible csv
        $total_count=0;
        
        /**Write header in csv file***/
        $write_data[]="Domain";
        if($is_google==1) $write_data[]="Google Status";
        if($is_norton==1) $write_data[]="Norton Status";
        $write_data[]="Scanned at";       
        
        fputcsv($download_path, $write_data);
        
        $antivirus_scan_complete=0;
        $api="";
        $config_data=$this->basic->get_data("config",array("where"=>array("user_id"=>$this->user_id)));
        if(count($config_data)>0) $api=$config_data[0]["google_safety_api"];

        $count=0;
        $str="<table class='table table-bordered table-hover table-striped'><tr><td>SL</td><td>Domain Name</td>";
        if($is_google==1) $str.="<td>Google Status</td>";
        if($is_norton==1) $str.="<td>Norton Status</td>";      
        $str.="</tr>";
        foreach ($url_array as $domain) 
        {        
            /***Remove all www. http:// and https:// ****/            
            $domain=str_replace("www.","",$domain);
            $domain=str_replace("http://","",$domain);
            $domain=str_replace("https://","",$domain);
            
            $google_status="";
            $norton_status="";
            
            if($is_google==1) $google_status=$this->web_common_report->google_safety_check($api,$domain);
            if($is_norton==1) $norton_status=$this->web_common_report->norton_safety_check($domain,$proxy="");   
            
            $scanned_at= date("Y-m-d H:i:s");
                  
            $write_data=array();
            $write_data[]=$domain;
            if($is_google==1) $write_data[]=$google_status;
            if($is_norton==1) $write_data[]=$norton_status;
            $write_data[]=$scanned_at;
        
            fputcsv($download_path, $write_data);
            
            /** Insert into database ***/
   
            $insert_data=array
            (
                'user_id'           => $this->user_id,
                'domain_name'       => $domain,
                'scanned_at'        => $scanned_at
            );
            if($is_google==1) $insert_data["google_status"]=$google_status;
            if($is_norton==1) $insert_data["norton_status"]=$norton_status;

            $count++;

            $str.= "<tr><td>".$count."</td><td>".$domain."</td>";
            if($is_google==1) $str.="<td>".$google_status."</td>";      
            if($is_norton==1) $str.="<td>".$norton_status."</td>";      
            $str.="</tr>";
            
            $this->basic->insert_data('antivirus_scan_info', $insert_data);    
            $antivirus_scan_complete++;
            $this->session->set_userdata("antivirus_scan_complete_search",$antivirus_scan_complete);        
        }

        //******************************//
        // insert data to useges log table
        $this->_insert_usage_log($module_id=10,$request=count($url_array));   
        //******************************//

        echo $str.="</table>";

    }  

    public function scan_download()
    {
        $all=$this->input->post("all");
        $table = 'antivirus_scan_info';
        $where=array();
        if($all==0)
        {
            $selected_grid_data = $this->input->post('info', true);
            $json_decode = json_decode($selected_grid_data, true);
            $id_array = array();
            foreach ($json_decode as  $value) 
            {
                $id_array[] = $value['id'];
            }
            $where['where_in'] = array('id' => $id_array);
        }

        $where['where'] = array('user_id'=>$this->user_id);

        $info = $this->basic->get_data($table, $where, $select ='', $join='', $limit='', $start=null, $order_by='id asc');
        $download_id=$this->session->userdata('download_id');
        $fp = fopen("download/antivirus/antivirus_{$this->user_id}_{$download_id}.csv", "w");
        fprintf($fp, chr(0xEF).chr(0xBB).chr(0xBF)); // unicode compatible csv
        $head=array("Doamin","Google Status","Norton Status","Scanned at");
                    
        fputcsv($fp, $head);
        $write_info = array();

        foreach ($info as  $value) 
        {
            $write_info['domain_name'] = $value['domain_name'];
            $write_info['google_status'] = $value['google_status'];
            $write_info['norton_status'] = $value['norton_status'];
            $write_info['scanned_at'] = $value['scanned_at'];
            
            fputcsv($fp, $write_info);
        }

        fclose($fp);
        $file_name = "download/antivirus/antivirus_{$this->user_id}_{$download_id}.csv";
        echo $file_name;
    }    

    public function scan_delete()
    {
        $all=$this->input->post("all");

        if($all==0)
        {
            $selected_grid_data = $this->input->post('info', true);
            $json_decode = json_decode($selected_grid_data, true);
            $id_array = array();
            foreach ($json_decode as  $value) 
            {
                $id_array[] = $value['id'];
            }     
            $this->db->where_in('id', $id_array);
        }
        $this->db->where('user_id', $this->user_id);
        $this->db->delete('antivirus_scan_info');
    }

    public function bulk_scan_progress_count()
    {
        $bulk_tracking_total_search=$this->session->userdata('antivirus_scan_bulk_total_search'); 
        $bulk_complete_search=$this->session->userdata('antivirus_scan_complete_search'); 
        
        $response['search_complete']=$bulk_complete_search;
        $response['search_total']=$bulk_tracking_total_search;
        
        echo json_encode($response);
        
    }


    public function virus_total()
    {
        $data['body'] = 'admin/antivirus/virus_total';
        $data['page_title'] = $this->lang->line('VirusTotal Scan');
        $this->_viewcontroller($data);
    }
    

    public function virus_total_scan_data()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'GET')
        redirect('home/access_forbidden', 'location');
        

        $page = isset($_POST['page']) ? intval($_POST['page']) : 15;
        $rows = isset($_POST['rows']) ? intval($_POST['rows']) : 5;
        $sort = isset($_POST['sort']) ? strval($_POST['sort']) : 'id';
        $order = isset($_POST['order']) ? strval($_POST['order']) : 'DESC';

        $domain_name = trim($this->input->post("domain_name", true));

        $from_date = trim($this->input->post('from_date', true));        
        if($from_date) $from_date = date('Y-m-d', strtotime($from_date));

        $to_date = trim($this->input->post('to_date', true));
        if($to_date) $to_date = date('Y-m-d', strtotime($to_date));


        // setting a new properties for $is_searched to set session if search occured
        $is_searched = $this->input->post('is_searched', true);


        if ($is_searched) 
        {
            // if search occured, saving user input data to session. name of method is important before field
            $this->session->set_userdata('antivirustotal_scan_domain_name', $domain_name);
            $this->session->set_userdata('antivirustotal_scan_from_date', $from_date);
            $this->session->set_userdata('antivirustotal_scan_to_date', $to_date);
        }

        // saving session data to different search parameter variables
        $search_domain_name   = $this->session->userdata('antivirustotal_scan_domain_name');
        $search_from_date  = $this->session->userdata('antivirustotal_scan_from_date');
        $search_to_date = $this->session->userdata('antivirustotal_scan_to_date');

        // creating a blank where_simple array
        $where_simple=array();
        
        if ($search_domain_name)    $where_simple['domain_name like ']    = "%".$search_domain_name."%";
        if ($search_from_date) 
        {
            if ($search_from_date != '1970-01-01'){
                $search_from_date = $search_from_date." 00:00:00";
                $where_simple["scanned_at >="]= $search_from_date;
            }
            
        }
        if ($search_to_date) 
        {
            if ($search_to_date != '1970-01-01'){
                $search_to_date = $search_to_date." 23:59:59";
                $where_simple["scanned_at <="]=$search_to_date;
            }
            
        }

        $where_simple['user_id'] = $this->user_id;
        $where  = array('where'=>$where_simple);
        $order_by_str=$sort." ".$order;
        $offset = ($page-1)*$rows;
        $result = array();
        $table = "virustotal";
        $info = $this->basic->get_data($table, $where, $select='', $join='', $limit=$rows, $start=$offset, $order_by=$order_by_str, $group_by='');

        foreach ($info as $key => $value) 
        {
            $info[$key]["report"]="<button class='btn btn-primary virus_total_report' data-id='".$value['id']."'><i class='fa fa-th-large'></i> ".$this->lang->line("report")."</button>";
        }

        $total_rows_array = $this->basic->count_row($table, $where, $count="id", $join='');
        $total_result = $total_rows_array[0]['total_rows'];

        echo convert_to_grid_data($info, $total_result);
    }

    public function virus_total_scan_action()
    {  
        $this->load->library('web_common_report');
        $domain=$this->input->post('urls', true);
       
        //************************************************//
        $status=$this->_check_usage($module_id=10,$request=1);
        if($status=="2") 
        {
            echo $this->lang->line("sorry, your bulk limit is exceeded for this module.")."<a href='".site_url('payment/usage_history')."'>".$this->lang->line("click here to see usage log")."</a>";
            exit();
        }
        else if($status=="3") 
        {
            echo $this->lang->line("sorry, your monthly limit is exceeded for this module.")."<a href='".site_url('payment/usage_history')."'>".$this->lang->line("click here to see usage log")."</a>";
            exit();
        }
        //************************************************//
        
      
        $this->session->set_userdata('antivirustotal_scan_bulk_total_search',1);
        $this->session->set_userdata('antivirustotal_scan_complete_search',0);
        $download_id= $this->session->userdata('download_id');
        
        $download_path=fopen("download/antivirus/antivirus_{$this->user_id}_{$download_id}.csv", "w");
        fprintf($download_path, chr(0xEF).chr(0xBB).chr(0xBF)); // unicode compatible csv
        $total_count=0;
        
        /**Write header in csv file***/
        $write_data[]="Domain";
        $write_data[]="Positives";
        $write_data[]="Total Scan";
        $write_data[]="Scanned at"; 
        foreach ($this->scan_places as $key => $value) 
        {
            $write_data[]=$value;
        }     
        
        fputcsv($download_path, $write_data);
        
        $antivirus_scan_complete=0;
        $api="";
        $config_data=$this->basic->get_data("config",array("where"=>array("user_id"=>$this->user_id)));
        if(count($config_data)>0) $api=$config_data[0]["virus_total_api"];

        if($api=="") 
        {
            echo "<div class='alert alert-warning text-center red'><a target='_BLANK' href='".base_url("config/index")."'>".$this->lang->line("VirusTotal API key not found. Please setup API key first.")."</a></div>";
            exit();
        }

        $count=0;
         
               
        /***Remove all www. http:// and https:// ****/            
        $domain=str_replace("www.","",$domain);
        $domain=str_replace("http://","",$domain);
        $domain=str_replace("https://","",$domain);
         
        $scan_report=$this->web_common_report->virus_total_scan($api,$domain);

        $scanned_at= date("Y-m-d H:i:s");
              
        $write_data=array();
        $write_data[]=$domain;
        $positives=isset($scan_report['positives']) ? $scan_report['positives'] : 0;
        $write_data[]=$positives;
        $total_scan=isset($scan_report['total']) ? $scan_report['total'] : 0;
        $write_data[]=$total_scan;
        $write_data[]=$scanned_at;

        $str="";
        $str.= "<h3 class='text-center'>Domain : ".$domain."</h3>";
        $str.= "<h3 class='text-center'>Positives : ".$positives."/".$total_scan."</h3>";
        $str.= "<h5 class='text-center'>Scanned at : ".$scanned_at."</h5><br></br>";

        $str.="<ol class='list-group' style='max-width:500px;display:block;margin:0 auto;'>";   

        foreach ($this->scan_places as $key => $value) 
        {
            $temp="";
            $temp2="";
            $count++;
            if(isset($scan_report['scans'][$value]))
            {
                if(isset($scan_report['scans'][$value]['result'])) $temp.=$scan_report['scans'][$value]['result']; 
                // if(isset($scan_report['scans'][$value]['detected']) && $scan_report['scans'][$value]['detected']!="") $temp.=" | ".$scan_report['scans'][$value]['detected'];

                if(isset($scan_report['scans'][$value]['result'])) $temp2=$scan_report['scans'][$value]['result']; 
                if(trim($temp2)=="clean site") $temp2="<span class='label label-success'>".$temp2."</span>";
                else $temp2="<span class='label label-warning'>".$temp2."</span>";
            }

            $write_data[]=$temp;
            $str.= "<li class='list-group-item' style='font-size:16px;'>".$count.". ".$value." <span class='pull-right'> ".$temp2."</span></li>";
        }  
        $str.="</ol>";
    
        fputcsv($download_path, $write_data);
        
        /** Insert into database ***/

        $insert_data=array();            
        $insert_data['user_id']           = $this->user_id;
        $insert_data['domain_name']       = $domain;
        $insert_data['scanned_at']        = $scanned_at;
        $insert_data['response_code']     = isset($scan_report['response_code']) ? $scan_report['response_code'] : "";
        $insert_data['permalink']         = isset($scan_report['permalink']) ? $scan_report['permalink'] : "";
        $insert_data['verbose_msg']       = isset($scan_report['verbose_msg']) ? $scan_report['verbose_msg'] : "";
        $insert_data['positives']         = isset($scan_report['positives']) ? $scan_report['positives'] : 0;
        $insert_data['total']             = isset($scan_report['total']) ? $scan_report['total'] : 0;
        $insert_data['scans']             = isset($scan_report['scans']) ? json_encode($scan_report['scans']) : json_encode(array());
      
       
        $this->basic->insert_data('virustotal', $insert_data);    
        $antivirus_scan_complete++;
        $this->session->set_userdata("antivirustotal_scan_complete_search",$antivirus_scan_complete);        
        

        //******************************//
        // insert data to useges log table
        $this->_insert_usage_log($module_id=10,$request=1);   
        //******************************//

        echo $str;

    }  

    public function virus_total_report()
    {  
        if ($_SERVER['REQUEST_METHOD'] === 'GET')
        redirect('home/access_forbidden', 'location');

        $id=$this->input->post("id");

        $count=0;

        $scanreport=$this->basic->get_data("virustotal",array("where"=>array("id"=>$id,"user_id"=>$this->user_id)));
        $scanreport=isset($scanreport[0]) ? $scanreport[0] : array();
        if(empty($scanreport)) exit();

        $domain=$scanreport["domain_name"];
        $positives=$scanreport["positives"];
        $total_scan=$scanreport["total"];
        $scanned_at=$scanreport["scanned_at"];

        $scan_report=json_decode($scanreport['scans'],true);

        $str="";
        $str.= "<h3 class='text-center'>Domain : ".$domain."</h3>";
        $str.= "<h3 class='text-center'>Positives : ".$positives."/".$total_scan."</h3>";
        $str.= "<h5 class='text-center'>Scanned at : ".$scanned_at."</h5><br></br>";

        $str.="<ol class='list-group' style='max-width:500px;display:block;margin:0 auto;'>";   

        foreach ($this->scan_places as $key => $value) 
        {
            $temp2="";
            $count++;
            if(isset($scan_report[$value]))
            {
                if(isset($scan_report[$value]['result'])) $temp2=$scan_report[$value]['result']; 
                if(trim($temp2)=="clean site") $temp2="<span class='label label-success'>".$temp2."</span>";
                else $temp2="<span class='label label-warning'>".$temp2."</span>";
            }
            $str.= "<li class='list-group-item' style='font-size:16px;'>".$count.". ".$value." <span class='pull-right'> ".$temp2."</span></li>";
        }  
        $str.="</ol>";   

        echo $str;

    }  


    public function virus_total_scan_download()
    {
        $all=$this->input->post("all");
        $table = 'virustotal';
        $where=array();
        if($all==0)
        {
            $selected_grid_data = $this->input->post('info', true);
            $json_decode = json_decode($selected_grid_data, true);
            $id_array = array();
            foreach ($json_decode as  $value) 
            {
                $id_array[] = $value['id'];
            }
            $where['where_in'] = array('id' => $id_array);
        }

        $where['where'] = array('user_id'=>$this->user_id);

        $info = $this->basic->get_data($table, $where, $select ='', $join='', $limit='', $start=null, $order_by='id asc');
        $download_id=$this->session->userdata('download_id');
        $fp = fopen("download/antivirus/antivirus_{$this->user_id}_{$download_id}.csv", "w");
        fprintf($fp, chr(0xEF).chr(0xBB).chr(0xBF)); // unicode compatible csv

        $write_data=array();
        $write_data[]="Domain";
        $write_data[]="Positives";
        $write_data[]="Total Scan";
        $write_data[]="Scanned at"; 
        foreach ($this->scan_places as $key => $value) 
        {
            $write_data[]=$value;
        }           
        fputcsv($fp, $write_data);


        foreach ($info as  $value) 
        {
            
            $write_info = array();    
            $scan_report=json_decode($value['scans'],true);
          
            $write_info[]=$value["domain_name"];
            $positives=isset($value['positives']) ? $value['positives'] : 0;
            $write_info[]=$positives;
            $total_scan=isset($value['total']) ? $value['total'] : 0;
            $write_info[]=$total_scan;
            $write_info[]=isset($value['scanned_at']) ? $value['scanned_at'] : '';

            foreach ($this->scan_places as $key => $value2) 
            {
                $temp="";              
                if(isset($scan_report[$value2]['result'])) $temp=$scan_report[$value2]['result']; 
                // if(isset($scan_report['scans'][$value]['detected']) && $scan_report['scans'][$value]['detected']!="") $temp.=" | ".$scan_report['scans'][$value]['detected']; 
                $write_info[]=$temp;
            }              
            
            fputcsv($fp, $write_info);
        }

        fclose($fp);
        $file_name = "download/antivirus/antivirus_{$this->user_id}_{$download_id}.csv";
        echo $file_name;
    }    

    public function virus_total_scan_delete()
    {
        $all=$this->input->post("all");

        if($all==0)
        {
            $selected_grid_data = $this->input->post('info', true);
            $json_decode = json_decode($selected_grid_data, true);
            $id_array = array();
            foreach ($json_decode as  $value) 
            {
                $id_array[] = $value['id'];
            }     
            $this->db->where_in('id', $id_array);
        }
        $this->db->where('user_id', $this->user_id);
        $this->db->delete('virustotal');
    }
        
    public function virus_total_bulk_scan_progress_count()
    {
        $bulk_tracking_total_search=$this->session->userdata('antivirustotal_scan_bulk_total_search'); 
        $bulk_complete_search=$this->session->userdata('antivirustotal_scan_complete_search'); 
        
        $response['search_complete']=$bulk_complete_search;
        $response['search_total']=$bulk_tracking_total_search;
        
        echo json_encode($response);
        
    }

    

   

}
