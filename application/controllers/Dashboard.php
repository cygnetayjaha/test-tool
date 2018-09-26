<?php

require_once("Home.php"); // including home controller

/**
* class config
* @category controller
*/
class Dashboard extends Home
{

    public $user_id;
    /**
    * load constructor method
    * @access public
    * @return void
    */
    public function __construct()
    {
        parent::__construct();

        if ($this->session->userdata('logged_in')!= 1) {
            redirect('home/login_page', 'location');
        }

        $this->important_feature();
        
        $this->user_id=$this->session->userdata('user_id');

        $this->member_validity();
    }

    /**
    * load index method. redirect to config
    * @access public
    * @return void
    */
    public function index()
    {
        $this->admin_dashboard();
    }



    public function admin_dashboard()
    {
        $country_list = $this->get_country_names();

        if($this->session->userdata("user_type")=="Member")
        {
            $package_info=$this->session->userdata("package_info");              
            $package_name="No Package";
            if(isset($package_info["package_name"]))  $package_name=$package_info["package_name"];
            $validity="0";
            if(isset($package_info["validity"]))  $validity=$package_info["validity"];
            $price="0";
            if(isset($package_info["price"]))  $price=$package_info["price"];
            $data['package_name']=$package_name;
            $data['validity']=$validity;
            $data['price']=$price;
        }
        $data['payment_config']=$this->basic->get_data('payment_config');

        $data['body'] = "dashboard/admin_dashboard";
        $data['page_title'] = $this->lang->line('dashboard');

        $where['where'] = array('user_id'=>$this->user_id);

        $visitor_type_where['where'] = array("user_id"=>$this->user_id);
        $visitor_type_data = $this->basic->get_data('domain',$visitor_type_where,$select='',$join='',$limit=4,$start=NULL,$order_by='dashboard desc');

        $k=0;
        foreach($visitor_type_data as $value1){
            $k++;
            $select=array("GROUP_CONCAT(is_new SEPARATOR ',') as new_vs_returning");
            $new_or_returning_where=array();

            $today = date("Y-m-d");
            $from_date = $today." 00:00:00";
            $to_date = $today." 23:59:59";

            $new_or_returning_where['where'] = array(
                "date_time >=" => $from_date,
                "date_time <=" => $to_date
                );
            $total_new_returning = $this->basic->get_data($value1['table_name'],$new_or_returning_where,$select,$join="",$limit='',$start='',$order_by='',$group_by='cookie_value,session_value');

            $new_or_returning = array();
            $new_user = 0;
            $returning_user = 0;
            foreach($total_new_returning as $value){
                $new_or_returning = explode(',', $value['new_vs_returning']);
                if(in_array(1, $new_or_returning)) $new_user++;
                else $returning_user++;
            }
            $data_number = "pie_chart_data_".$k;
            $website_name = "website_name_".$k; 
            $temp_data = array(
                0 => array(
                    "value" => $new_user,
                    "color" => "#51A39D",
                    "highlight" => "#51A39D",
                    "label" => "New Users",
                    ),
                1 => array(
                    "value" => $returning_user,
                    "color" => "#B7695C",
                    "highlight" => "#B7695C",
                    "label" => "Returning Users",
                    )
                );
            $data[$data_number] = json_encode($temp_data);
            $data[$website_name] = $value1['domain_name'];
        }


        $l=0;
        foreach($visitor_type_data as $value){
            $l++;
            $select=array("count(id) as user_number","country");
            $country_report_where=array();

            $today = date("Y-m-d");
            $from_date = $today." 00:00:00";
            $to_date = $today." 23:59:59";

            $country_report_where['where'] = array(
                "date_time >=" => $from_date,
                "date_time <=" => $to_date,
                "is_new"=>"1"
                );

            // $country_report_where['where'] = array("is_new"=>"1","date_format(date_time,'%Y-%m-%d')"=>date("Y-m-d"));
            $country_report_data = $this->basic->get_data($value['table_name'],$country_report_where,$select,$join="",$limit=5,$start='',$order_by='user_number desc',$group_by='country');

            $temp_data = array();
            $m=0;
            $color_array = array("#F9E559","#218C8D","#6CCECB","#EF7126","#8EDC9D","#473E3F");           

            // $str = '<ul class="chart-legend clearfix" id="visitor_type_color_codes">';
            $str="";

            foreach($country_report_data as $value1){
                $temp_data[$m] = array(
                    "value" => $value1['user_number'],
                    "color" => $color_array[$m],
                    "highlight" => $color_array[$m],
                    "label" => $value1['country']
                    );
                $br='';
                if(($m+1)%3==0) $br='<br>';
                $str .= '<i class="fa fa-circle-o" style="color: '.$color_array[$m].';"></i> '.array_search($value1['country'],$country_list).' : '.$value1['user_number'].' '.$br;
                $m++;
            }

            // $str .= '</ul>';

            $data_number = "country_chart_data_".$l;
            $country_name_data = "country_name_list_".$l;
            $data[$data_number] = json_encode($temp_data);
            $data[$country_name_data] = $str;
        }


        $website_analysis = $this->basic->get_data('web_common_info',$where,$select=array('id','domain_name'),$join='',$limit=5,$start=NULL,$order_by='id desc');
        $data['website_analysis'] = $website_analysis;

        $search_engine_index = $this->basic->get_data('search_engine_index',$where,$select='',$join='',$limit=5,$start=NULL,$order_by='id desc');
        $data['search_engine_index'] = $search_engine_index;

        
        $search_engine_page_rank = $this->basic->get_data('search_engine_page_rank',$where,$select='',$join='',$limit=5,$start=NULL,$order_by='id desc');
        $data['search_engine_page_rank'] = $search_engine_page_rank;


        $whois_search = $this->basic->get_data('whois_search',$where,$select=array('id','domain_name','is_registered'),$join='',$limit=5,$start=NULL,$order_by='id desc');
        $data['whois_search'] = $whois_search;


        $alexa_info_full = $this->basic->get_data('alexa_info_full',$where,$select='',$join='',$limit=5,$start=NULL,$order_by='id desc');
        $data['alexa_info_full'] = $alexa_info_full;

        $similar_web_info = $this->basic->get_data('similar_web_info',$where,$select=array('id','domain_name','global_rank'),$join='',$limit=5,$start=NULL,$order_by='id desc');
        $data['similar_web_info'] = $similar_web_info;

        $link_analysis = $this->basic->get_data('link_analysis',$where,$select='',$join='',$limit=5,$start=NULL,$order_by='id desc');
        $data['link_analysis'] = $link_analysis;


        $backlink_search = $this->basic->get_data('backlink_search',$where,$select='',$join='',$limit=5,$start=NULL,$order_by='id desc');
        $data['backlink_search'] = $backlink_search;

        $curdate=date("Y-m-d");
        $from_date=date('Y-m-d', strtotime($curdate. " - 7 days"));
        $from_date = $from_date." 00:00:00";
        $to_date = $curdate." 23:59:59";

        // code for line chart
        $k=0;
        $line_char_data = array();
        foreach($visitor_type_data as $value)
        {
            $table =  $value['table_name'];
            
            $where = array();
            $where['where'] = array(
                "date_time >=" => $from_date,
                "date_time <=" => $to_date,
                );
            $select = array(
                "date_format(date_time,'%Y-%m-%d') as date",
                "count(id) as number_of_user",
                "visit_url"
                );
            $day_wise_visitor = $this->basic->get_data($table,$where,$select,$join='',$limit='',$start='',$order_by='',$group_by="date");


            $day_count = date('Y-m-d', strtotime($from_date. " + 1 days"));

            $day_wise_info=array();
            foreach ($day_wise_visitor as $value2){
                $day_wise_info[$value2['date']] = $value2['number_of_user'];
            }

            $dDiff = strtotime($to_date) - strtotime($from_date);
            $no_of_days = floor($dDiff/(60*60*24));

            
            for($i=0;$i<=$no_of_days+1;$i++){
                $day_count = date('Y-m-d', strtotime($from_date. " + $i days"));
                if(isset($day_wise_info[$day_count])){
                    $line_char_data[$k][$i]['user'] = $day_wise_info[$day_count];
                } else {
                    $line_char_data[$k][$i]['user'] = 0;
                }
                $line_char_data[$k][$i]['date'] = date('Y-m-d', strtotime($from_date. " + $i days"));
                $line_char_data[$k][$i]['domain'] = $value['domain_name'];
            }
            $k++;
        }
        $data['day_wise_click_report'] = json_encode($line_char_data); 
        // end of code for line chart
        
        //line chart compare
        $k=0;
        $line_char_data_compare=array();
        foreach ($line_char_data as $key => $value)
        {
          foreach ($value as $key2 => $value2) 
          {
             $line_char_data_compare[$value2['date']]['date']=$value2['date'];
             $domainName=str_ireplace(array('https://','http://','/'), '', $value2['domain']);
             $domainName=trim($domainName,'/');
             $line_char_data_compare[$value2['date']][$domainName]=$value2['user'];
          }
          $k++;
        }

         // code for bar chart
        $k=0;
        $traffic_soure_barchart = array();
        foreach($visitor_type_data as $value)
        {
            $table =  $value['table_name'];
            
            $where = array();
            $where['where'] = array(
                "date_time >=" => $from_date,
                "date_time <=" => $to_date,
                );
            $select = array("*");
            $day_wise_traffic = $this->basic->get_data($table,$where,$select,$join='',$limit='',$start='',$order_by='',$group_by="");

            $ref=array();
            foreach ($day_wise_traffic as $key2 => $value2) 
            {
               $refferer=$value2["referrer"];
               $refferer=get_domain_only($refferer);
               if(!isset($ref[$refferer])) $ref[$refferer]=0;
               $ref[$refferer]++;
            }
            arsort($ref);
            $l=0;
            foreach ($ref as $key2 => $value2) 
            {
                if($key2=="") $key2="Direct";
                $traffic_soure_barchart[$k][]=array('source_name' => $key2, 'value' => $value2);
                $l++;
                if($l==5) break;
            }

            $k++;
        }
        $data['traffic_soure_barchart'] = json_encode($traffic_soure_barchart); 
        // end of code for bar chart

        // echo '<pre>';print_r($line_char_data);echo '</pre>'; 
        // echo '<pre>';print_r($line_char_data_compare);echo '</pre>'; 
        // echo '<pre>';print_r(array_values($line_char_data_compare));echo '</pre>'; 
        $data['day_wise_click_report_compare'] = json_encode(array_values($line_char_data_compare)); 

        $data["visitor_type_data"]=$visitor_type_data;

        $this->_viewcontroller($data);
    }




}
