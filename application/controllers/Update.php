<?php
class Update extends CI_Controller
{
      
    public function __construct()
    {
        parent::__construct();   
        $this->load->database();
        $this->load->model('basic');
        set_time_limit(0);
    }

    public function index()
    {
        $this->v_3_5tov4_0();
    }

    public function v_3_5tov4_0()
    {

        // writing application/config/my_config
        $app_my_config_data = "<?php ";
        $app_my_config_data.= "\n\$config['default_page_url'] = '".$this->config->item('default_page_url')."';\n";
        $app_my_config_data.= "\$config['product_version'] = '4.0';\n";
        $app_my_config_data.= "\$config['institute_address1'] = '".$this->config->item('institute_address1')."';\n";
        $app_my_config_data.= "\$config['institute_address2'] = '".$this->config->item('institute_address2')."';\n";
        $app_my_config_data.= "\$config['institute_email'] = '".$this->config->item('institute_email')."';\n";
        $app_my_config_data.= "\$config['institute_mobile'] = '".$this->config->item('institute_mobile')."';\n\n";
        $app_my_config_data.= "\$config['slogan'] = '".$this->config->item('slogan')."';\n";
        $app_my_config_data.= "\$config['product_name'] = '".$this->config->item('product_name')."';\n";
        $app_my_config_data.= "\$config['product_short_name'] = '".$this->config->item('product_short_name')."';\n";
        $app_my_config_data.= "\$config['developed_by'] = '".$this->config->item('developed_by')."';\n";
        $app_my_config_data.= "\$config['developed_by_href'] = '".$this->config->item('developed_by_href')."';\n";
        $app_my_config_data.= "\$config['developed_by_title'] = '".$this->config->item('developed_by_title')."';\n";
        $app_my_config_data.= "\$config['developed_by_prefix'] = '".$this->config->item('developed_by_prefix')."' ;\n";
        $app_my_config_data.= "\$config['support_email'] = '".$this->config->item('support_email')."' ;\n";
        $app_my_config_data.= "\$config['support_mobile'] = '".$this->config->item('support_mobile')."' ;\n";                
        $app_my_config_data.= "\$config['time_zone'] = '".$this->config->item('time_zone')."';\n";              
        $app_my_config_data.= "\$config['language'] = '".$this->config->item('language')."';\n";
        $app_my_config_data.= "\$config['sess_use_database'] = FALSE;\n";
        $app_my_config_data.= "\$config['front_end_search_display'] = '".$this->config->item('front_end_search_display')."';\n";  
      
        file_put_contents(APPPATH.'config/my_config.php', $app_my_config_data, LOCK_EX);  //writting  application/config/my_config

        $lines="DROP TABLE IF EXISTS `add_ons`;
            CREATE TABLE IF NOT EXISTS `add_ons` (
              `id` int(11) NOT NULL AUTO_INCREMENT,
              `add_on_name` varchar(255) NOT NULL,
              `unique_name` varchar(255) NOT NULL,
              `version` varchar(255) NOT NULL,
              `installed_at` datetime NOT NULL,
              `update_at` datetime NOT NULL,
              `purchase_code` varchar(100) NOT NULL,
              `module_folder_name` varchar(255) NOT NULL,
              `project_id` int(11) NOT NULL,
              PRIMARY KEY (`id`),
              UNIQUE KEY `unique_name` (`unique_name`)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8;
            DROP TABLE IF EXISTS `version`;
            CREATE TABLE IF NOT EXISTS `version` (
              `id` int(11) NOT NULL AUTO_INCREMENT,
              `version` varchar(255) NOT NULL,
              `current` enum('1','0') NOT NULL DEFAULT '1',
              `date` datetime NOT NULL,
              PRIMARY KEY (`id`),
              UNIQUE KEY `version` (`version`)
            ) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
            INSERT INTO `version` (`id`, `version`, `current`, `date`) VALUES
            (1, '4.0', '0', '2018-04-01 14:22:27');
            ALTER TABLE `modules` ADD `add_ons_id` INT(11) NOT NULL AFTER `module_name`;
            ALTER TABLE `modules` ADD `extra_text` VARCHAR(50) NOT NULL AFTER `add_ons_id`;
            ALTER TABLE `modules` ADD `limit_enabled` ENUM('0','1') NOT NULL AFTER `extra_text`;
            DROP TABLE IF EXISTS `menu`;
            CREATE TABLE IF NOT EXISTS `menu` (
              `id` int(11) NOT NULL AUTO_INCREMENT,
              `name` varchar(255) NOT NULL,
              `icon` varchar(255) NOT NULL,
              `url` varchar(255) NOT NULL,
              `serial` int(11) NOT NULL,
              `module_access` varchar(255) NOT NULL,
              `have_child` enum('1','0') NOT NULL DEFAULT '0',
              `only_admin` enum('1','0') NOT NULL DEFAULT '1',
              `only_member` enum('1','0') NOT NULL DEFAULT '0',
              `add_ons_id` int(11) NOT NULL,
              `is_external` enum('0','1') NOT NULL DEFAULT '0',
              PRIMARY KEY (`id`)
            ) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8;
            INSERT INTO `menu` (`id`, `name`, `icon`, `url`, `serial`, `module_access`, `have_child`, `only_admin`, `only_member`, `add_ons_id`, `is_external`) VALUES
            (1, 'dashboard', 'fa fa-dashboard', 'dashboard/index', 1, '', '0', '0', '0', 0, '0'),
            (2, 'usage log', 'fa fa-list-ol', 'payment/usage_history', 2, '', '0', '0', '1', 0, '0'),
            (3, 'Settings', 'fa fa-cog', '#', 3, '', '1', '0', '1', 0, '0'),
            (4, 'Payment', 'fa fa-paypal', 'payment/member_payment_history', 4, '', '0', '0', '1', 0, '0'),
            (5, 'Administration', 'fa fa-user-plus', '#', 5, '', '1', '1', '0', 0, '0'),
            (6, 'Visitor Analytics', 'fa fa-line-chart', 'domain_details_visitor/domain_list_visitor', 6, '1', '0', '0', '0', 0, '0'),
            (7, 'Website Analysis', 'fa fa-bar-chart', 'domain/domain_list_for_domain_details', 7, '2', '0', '0', '0', 0, '0'),
            (8, 'Social Network Analysis', 'fa fa-share-alt', 'social/social_list', 8, '3', '0', '0', '0', 0, '0'),
            (9, 'Rank & Index Analysis', 'fa fa-trophy', '#', 9, '4', '1', '0', '0', 0, '0'),
            (10, 'Domain Analysis', 'fa fa-server', '#', 10, '5', '1', '0', '0', 0, '0'),
            (11, 'IP Analysis', 'fa fa-map-marker', '#', 11, '6', '1', '0', '0', 0, '0'),
            (12, 'Link Analysis', 'fa fa-anchor', '#', 12, '7', '1', '0', '0', 0, '0'),
            (13, 'Keyword Analysis', 'fa fa-tags', '#', 13, '8', '1', '0', '0', 0, '0'),
            (14, 'Keyword Position Tracking', 'fa fa-eye', '#', 14, '16', '1', '0', '0', 0, '0'),
            (15, 'Backlink & Ping', 'fa fa-link', '#', 15, '9', '1', '0', '0', 0, '0'),
            (16, 'Malware Scan', 'fa fa-shield', 'antivirus/scan', 16, '10', '0', '0', '0', 0, '0'),
            (17, 'Google Adwords Scraper', 'fa fa-google', 'google_adwords/index', 17, '11', '0', '0', '0', 0, '0'),
            (18, 'Google url shortener', 'fa fa-cut', '#', 18, '18', '1', '1', '0', 0, '0'),
            (19, 'Utilities', 'fa fa-asterisk', '#', 19, '13,12', '1', '0', '0', 0, '0'),
            (20, 'Code minifier', 'fa fa-object-group', '#', 20, '17', '1', '1', '0', 0, '0'),
            (21, 'Native Widget', 'fa fa-delicious', 'widgets/get_widget', 21, '14', '0', '0', '0', 0, '0'),
            (22, 'Native API', 'fa fa-plug', 'native_api/index', 22, '15', '0', '0', '0', 0, '0'),
            (24, 'add-ons', 'fa fa-plus', 'addons/lists', 24, '', '0', '0', '0', 0, '0'),
            (25, 'Check Update', 'fa fa-angle-double-up', 'update_system/index', 25, '', '0', '1', '0', 0, '0');
            DROP TABLE IF EXISTS `menu_child_1`;
            CREATE TABLE IF NOT EXISTS `menu_child_1` (
              `id` int(11) NOT NULL AUTO_INCREMENT,
              `name` varchar(255) NOT NULL,
              `url` varchar(255) NOT NULL,
              `serial` int(11) NOT NULL,
              `icon` varchar(255) NOT NULL,
              `module_access` varchar(255) NOT NULL,
              `parent_id` int(11) NOT NULL,
              `have_child` enum('1','0') NOT NULL DEFAULT '0',
              `only_admin` enum('1','0') NOT NULL DEFAULT '1',
              `only_member` enum('1','0') NOT NULL DEFAULT '0',
              `is_external` enum('0','1') NOT NULL DEFAULT '0',
              PRIMARY KEY (`id`)
            ) ENGINE=InnoDB AUTO_INCREMENT=47 DEFAULT CHARSET=utf8;
            INSERT INTO `menu_child_1` (`id`, `name`, `url`, `serial`, `icon`, `module_access`, `parent_id`, `have_child`, `only_admin`, `only_member`, `is_external`) VALUES
            (1, 'Settings', '#', 1, 'fa fa-cogs', '', 5, '1', '1', '0', '0'),
            (2, 'User Management', 'admin/user_management', 2, 'fa fa-user', '', 5, '0', '1', '0', '0'),
            (3, 'Send Notification', 'admin/notify_members', 3, 'fa fa-bell-o', '', 5, '0', '1', '0', '0'),
            (4, 'Payment', '#', 4, 'fa fa-paypal', '', 5, '1', '1', '0', '0'),
            (5, 'Delete Junk Files', 'admin/delete_junk_file', 5, 'fa fa-trash-o', '', 5, '0', '1', '0', '0'),
            (6, 'Alexa Rank', 'rank/alexa_rank', 1, 'fa fa-circle-o', '4', 9, '0', '0', '0', '0'),
            (7, 'Alexa Data', 'rank/alexa_rank_full', 2, 'fa fa-circle-o', '4', 9, '0', '0', '0', '0'),
            (8, 'Similarweb Data', 'rank/similar_web', 3, 'fa fa-circle-o', '4', 9, '0', '0', '0', '0'),
            (9, 'Moz Check', 'rank/moz_rank', 4, 'fa fa-circle-o', '4', 9, '0', '0', '0', '0'),
            (10, 'Search Engine Index', 'search_engine_index/index', 5, 'fa fa-circle-o', '4', 9, '0', '0', '0', '0'),
            (11, 'Whois Search', 'who_is/index', 1, 'fa fa-circle-o', '5', 10, '0', '0', '0', '0'),
            (12, 'DMOZ Check', 'rank/dmoz_rank', 2, 'fa fa-circle-o', '5', 10, '0', '0', '0', '0'),
            (13, 'Auction Domain List', 'expired_domain/index', 3, 'fa fa-circle-o', '5', 10, '0', '0', '0', '0'),
            (14, 'DNS Information', 'dns_info/index', 4, 'fa fa-circle-o', '5', 10, '0', '0', '0', '0'),
            (15, 'Server Information', 'server_info/index', 5, 'fa fa-circle-o', '5', 10, '0', '0', '0', '0'),
            (16, 'My IP Information', 'ip/index', 1, 'fa fa-circle-o', '6', 11, '0', '0', '0', '0'),
            (17, 'Domain IP Information', 'ip/domain_info', 2, 'fa fa-circle-o', '6', 11, '0', '0', '0', '0'),
            (18, 'Sites In Same IP', 'ip/site_this_ip', 3, 'fa fa-circle-o', '6', 11, '0', '0', '0', '0'),
            (19, 'Ipv6 Compability Check', 'ip/ipv6_check', 4, 'fa fa-circle-o', '6', 11, '0', '0', '0', '0'),
            (20, 'IP Canonical Check', 'ip/ip_canonical_check', 5, 'fa fa-circle-o', '6', 11, '0', '0', '0', '0'),
            (21, 'Link Analyzer', 'link_analysis/index', 1, 'fa fa-circle-o', '7', 12, '0', '0', '0', '0'),
            (22, 'Page Status Check', 'page_status/index', 2, 'fa fa-circle-o', '7', 12, '0', '0', '0', '0'),
            (23, 'Keyword Analyzer', 'keyword/keyword_analyzer', 1, 'fa fa-circle-o', '8', 13, '0', '0', '0', '0'),
            (24, 'Keyword Position Analysis', 'keyword/index', 2, 'fa fa-circle-o', '8', 13, '0', '0', '0', '0'),
            (25, 'Google Correlated Keywords', 'keyword/google_correlated_keyword', 3, 'fa fa-circle-o', '8', 13, '0', '0', '0', '0'),
            (26, 'Keyword Auto Suggestion', 'keyword/keyword_suggestion', 4, 'fa fa-circle-o', '8', 13, '0', '0', '0', '0'),
            (27, 'Keyword Tracking Settings', 'keyword_position_tracking/index', 1, 'fa fa-circle-o', '16', 14, '0', '0', '0', '0'),
            (28, 'Keyword Position Report', 'keyword_position_tracking/keyword_position_report', 2, 'fa fa-circle-o', '16', 14, '0', '0', '0', '0'),
            (29, 'Google Backlink Search', 'backlink/backlink_search', 1, 'fa fa-circle-o', '9', 15, '0', '0', '0', '0'),
            (30, 'Backlink Generator', 'backlink/index', 2, 'fa fa-circle-o', '9', 15, '0', '0', '0', '0'),
            (31, 'Website Ping', 'ping/index', 3, 'fa fa-circle-o', '9', 15, '0', '0', '0', '0'),
            (32, 'Url shortener', 'url_shortener/index', 1, 'fa fa-circle-o', '18', 18, '0', '1', '0', '0'),
            (33, 'Analytics', 'url_shortener/url_analytics_page_loader', 2, 'fa fa-circle-o', '18', 18, '0', '1', '0', '0'),
            (34, 'Email Encoder/Decoder', 'tools/email_encoder_decoder', 1, 'fa fa-circle-o', '12,13', 19, '0', '0', '0', '0'),
            (35, 'Metatag Generator', 'tools/meta_tag_list', 2, 'fa fa-circle-o', '12,13', 19, '0', '0', '0', '0'),
            (36, 'Plagiarism Check', 'tools/plagarism_check_list', 3, 'fa fa-circle-o', '12,13', 19, '0', '0', '0', '0'),
            (37, 'Valid Email Check', 'tools/index', 4, 'fa fa-circle-o', '12,13', 19, '0', '0', '0', '0'),
            (38, 'Duplicate Email Filter', 'tools/duplicate_email_filter_list', 5, 'fa fa-circle-o', '12,13', 19, '0', '0', '0', '0'),
            (39, 'URL Encoder/Decoder', 'tools/url_encode_list', 6, 'fa fa-circle-o', '12,13', 19, '0', '0', '0', '0'),
            (40, 'URL Canonical Check', 'tools/url_canonical_check', 7, 'fa fa-circle-o', '12,13', 19, '0', '0', '0', '0'),
            (41, 'Gzip Check', 'tools/gzip_check', 8, 'fa fa-circle-o', '12,13', 19, '0', '0', '0', '0'),
            (42, 'Base64 Encoder/Decoder', 'tools/base64_encode_list', 9, 'fa fa-circle-o', '12,13', 19, '0', '0', '0', '0'),
            (43, 'Robot Code Generator', 'tools/robot_code_generator', 10, 'fa fa-circle-o', '12,13', 19, '0', '0', '0', '0'),
            (44, 'HTML minifier', 'code_minifier/html_minifier', 1, 'fa fa-circle-o', '17', 20, '0', '1', '0', '0'),
            (45, 'CSS minifier', 'code_minifier/css_minifier', 2, 'fa fa-circle-o', '17', 20, '0', '1', '0', '0'),
            (46, 'JS minifier', 'code_minifier/js_minifier', 3, 'fa fa-circle-o', '17', 20, '0', '1', '0', '0');
            DROP TABLE IF EXISTS `menu_child_2`;
            CREATE TABLE IF NOT EXISTS `menu_child_2` (
              `id` int(11) NOT NULL AUTO_INCREMENT,
              `name` varchar(255) NOT NULL,
              `url` varchar(255) NOT NULL,
              `serial` int(11) NOT NULL,
              `icon` varchar(255) NOT NULL,
              `module_access` varchar(255) NOT NULL,
              `parent_child` int(11) NOT NULL,
              `only_admin` enum('1','0') NOT NULL DEFAULT '1',
              `only_member` enum('1','0') NOT NULL DEFAULT '0',
              `is_external` enum('0','1') NOT NULL DEFAULT '0',
              PRIMARY KEY (`id`)
            ) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;
            INSERT INTO `menu_child_2` (`id`, `name`, `url`, `serial`, `icon`, `module_access`, `parent_child`, `only_admin`, `only_member`, `is_external`) VALUES
            (1, 'General Settings', 'admin_config/configuration', 1, 'fa fa-cog', '', 1, '1', '0', '0'),
            (2, 'Email Settings', 'admin_config_email/index', 2, 'fa fa-envelope', '', 1, '1', '0', '0'),
            (3, 'Connectivity Settings', 'config/index', 3, 'fa fa-connectdevelop', '', 1, '1', '0', '0'),
            (4, 'Proxy Settings', 'config/proxy', 4, 'fa fa-user-secret', '', 1, '1', '0', '0'),
            (5, 'Advertisement Settings', 'admin_config_ad/ad_config', 5, 'fa fa-bullhorn', '', 1, '1', '0', '0'),
            (6, ' Social Login Settings', 'admin_config_login/login_config', 6, 'fa fa-sign-in', '', 1, '1', '0', '0'),
            (7, 'Dashboard', 'payment/payment_dashboard_admin', 1, 'fa fa-dashboard', '', 4, '1', '0', '0'),
            (8, 'Package Settings', 'payment/package_settings', 2, 'fa fa-cube', '', 4, '1', '0', '0'),
            (9, 'Payment Settings', 'payment/payment_setting_admin', 3, 'fa fa-money', '', 4, '1', '0', '0'),
            (10, 'Payment History', 'payment/admin_payment_history', 4, 'fa fa-history', '', 4, '1', '0', '0');
            CREATE TABLE IF NOT EXISTS `update_list` (
              `id` int(11) NOT NULL AUTO_INCREMENT,
              `files` text NOT NULL,
              `sql_query` text NOT NULL,
              `update_id` int(11) NOT NULL,
              PRIMARY KEY (`id`)
            ) ENGINE=InnoDB DEFAULT CHARSET=latin1;
             DROP TABLE IF EXISTS `ci_sessions`;
             CREATE TABLE IF NOT EXISTS `ci_sessions` (
                `id` varchar(40) NOT NULL,
                `ip_address` varchar(45) NOT NULL,
                `timestamp` int(10) unsigned DEFAULT 0 NOT NULL,
                `data` blob NOT NULL,
                PRIMARY KEY (id),
                KEY `ci_sessions_timestamp` (`timestamp`)
            );
            ALTER TABLE `search_engine_index` CHANGE `google_index` `google_index` VARCHAR(20) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL;
            UPDATE `menu` SET `name` = 'Security Tools', `url` = '', `have_child` = '1' WHERE `menu`.`id` = 16;
            INSERT INTO `menu_child_1` (`id`, `name`, `url`, `serial`, `icon`, `module_access`, `parent_id`, `have_child`, `only_admin`, `only_member`, `is_external`) VALUES (NULL, 'Malware Scan', 'antivirus/scan', '1', 'fa fa-circle-o', '10', '16', '0', '0', '0', '0');
            INSERT INTO `menu_child_1` (`id`, `name`, `url`, `serial`, `icon`, `module_access`, `parent_id`, `have_child`, `only_admin`, `only_member`, `is_external`) VALUES (NULL, 'VirusTotal Scan', 'antivirus/virus_total', '2', 'fa fa-circle-o', '10', '16', '0', '0', '0', '0');
            DELETE FROM `menu_child_1` WHERE `menu_child_1`.`id` = 12;
            ALTER TABLE `config` ADD `virus_total_api` VARCHAR(255) NOT NULL AFTER `mobile_ready_api_key`;
            INSERT INTO `menu_child_1` (`name`, `url`, `serial`, `icon`, `module_access`, `parent_id`, `have_child`, `only_admin`, `only_member`, `is_external`) VALUES
            ('Connectivity Settings', 'config/index', 1, 'fa fa-connectdevelop','', 3, 0, '0', '1', '0'),
            ('Proxy Settings', 'config/proxy',2, 'fa fa-user-secret','', 3, 0, '0', '1', '0');
            INSERT INTO `menu_child_1` (`id`, `name`, `url`, `serial`, `icon`, `module_access`, `parent_id`, `have_child`, `only_admin`, `only_member`, `is_external`) VALUES (NULL, 'IP Traceout', 'ip/ip_traceout', '7', 'fa fa-circle-o', '6', '11', '0', '0', '0', '0');
            DROP TABLE IF EXISTS `virustotal`;
            CREATE TABLE IF NOT EXISTS `virustotal` (
              `id` int(11) NOT NULL AUTO_INCREMENT,
              `domain_name` varchar(255) NOT NULL,
              `response_code` varchar(50) NOT NULL,
              `permalink` tinytext NOT NULL,
              `verbose_msg` varchar(255) NOT NULL,
              `positives` int(11) NOT NULL,
              `total` int(11) NOT NULL,
              `scans` longtext NOT NULL,
              `scanned_at` datetime NOT NULL,
              `user_id` int(11) NOT NULL,
              PRIMARY KEY (`id`),
              KEY `domain_name` (`domain_name`,`scanned_at`,`user_id`)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8;
            UPDATE `modules` SET `module_name` = 'Security Tools' WHERE `modules`.`id` = 10;
            ALTER TABLE `domain` ADD `dashboard` ENUM('0','1') NOT NULL DEFAULT '0' AFTER `add_date`";       
        // Loop through each line
        $lines=explode(";", $lines);
        $count=0;
        foreach ($lines as $line) 
        {
            $count++;      
            $this->db->query($line);
        }
        echo "SiteSpy has been updated to v4.0 successfully.".$count." queries executed.";
    }

    public function v3_4to3_5()
    {
        $lines='ALTER TABLE `ip_domain_info` ADD `organization` VARCHAR(100) NOT NULL AFTER `isp`';       
        // Loop through each line
        $lines=explode(";", $lines);
        $count=0;
        foreach ($lines as $line) 
        {
            $count++;      
            $this->db->query($line);
        }
        echo "SiteSpy has been updated to v3.5 successfully.".$count." queries executed.";
    }


    public function v3_2to3_3()
    {
        $lines='CREATE TABLE IF NOT EXISTS `ad_config` (
          `id` int(11) NOT NULL AUTO_INCREMENT,
          `section1_html` longtext,
          `section1_html_mobile` longtext,
          `section2_html` longtext,
          `section3_html` longtext,
          `section4_html` longtext,
          `status` enum("0","1") NOT NULL DEFAULT "1",
          PRIMARY KEY (`id`)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8';


       
        // Loop through each line

        $lines=explode(";", $lines);
        $count=0;
        foreach ($lines as $line) 
        {
            $count++;      
            $this->db->query($line);
        }
        echo "SiteSpy has been updated to v3.3 successfully.".$count." queries executed.";
    }

    public function v1_to_v1_1()
    {
        // writting client js
        $client_js_content=file_get_contents('js/analytics_js/client.js');
        $client_js_content_new=str_replace("base_url_replace/", site_url(), $client_js_content);
        file_put_contents('js/analytics_js/client.js', $client_js_content_new, LOCK_EX);
        // writting client js

        $sql="ALTER TABLE domain ADD add_date DATE NOT NULL AFTER table_name;";
        $this->basic->execute_complex_query($sql);

        $current_config=array();
        $current_config=$this->basic->get_data("payment_config");
        if(count($current_config)==0) 
        {
            $sql="INSERT INTO payment_config (id ,paypal_email ,monthly_fee ,currency ,deleted)
            VALUES (1 , 'yourPaypalemail@example.com', '0', 'USD', '0');";
            $this->basic->execute_complex_query($sql);
        }
        echo "SiteSpy has been updated to v1.1 successfully.";    
    }

    public function v2to_v2_1()
    {

        $lines='ALTER TABLE  `web_common_info` ADD  `yahoo_back_link_count` VARCHAR( 150 ) NULL AFTER  `google_back_link_count`;
        ALTER TABLE  `web_common_info` ADD  `bing_back_link_count` VARCHAR( 150 ) NULL AFTER  `yahoo_back_link_count`;
        ALTER TABLE  `web_common_info`  ADD  `similar_site` TEXT NULL AFTER  `avg_status`;
        ALTER TABLE `config` ADD `mobile_ready_api_key` VARCHAR( 100 ) NOT NULL AFTER `moz_secret_key`;
        ALTER TABLE `web_common_info` ADD `mobile_ready_data` TEXT NOT NULL ;
        ALTER TABLE `web_common_info` CHANGE `mobile_ready_data` `mobile_ready_data` LONGTEXT CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL;
        ALTER TABLE `web_common_info` ENGINE = MYISAM;
        ALTER TABLE `web_common_info` ADD `sites_in_same_ip` LONGTEXT NOT NULL;
        ALTER TABLE `web_common_info` CHANGE `mobile_ready_data` `mobile_ready_data` LONGTEXT CHARACTER SET utf8 COLLATE utf8_general_ci NULL ,
        CHANGE `sites_in_same_ip` `sites_in_same_ip` LONGTEXT CHARACTER SET utf8 COLLATE utf8_general_ci NULL;
        ALTER TABLE `package` ADD `monthly_limit` TEXT NULL AFTER `module_ids` ,
        ADD `bulk_limit` TEXT NULL AFTER `monthly_limit`;
        UPDATE `package` SET `package_name` = "Trial",
        `module_ids` = "9,5,11,6,8,16,7,10,15,14,12,4,3,13,1,2",
        `monthly_limit` = \'{"9":0,"5":0,"11":0,"6":0,"8":0,"16":"0","7":0,"10":0,"15":0,"14":0,"12":0,"4":0,"3":0,"13":0,"1":0,"2":0}\',
        `bulk_limit` = \'{"9":0,"5":0,"11":0,"6":0,"8":0,"16":"0","7":0,"10":0,"15":0,"14":0,"12":0,"4":0,"3":0,"13":0,"1":0,"2":0}\',
        `price` = "Trial" WHERE `package`.`id` =1;
        CREATE TABLE `usage_log` (
        `id` BIGINT NOT NULL AUTO_INCREMENT PRIMARY KEY ,
        `module_id` INT NOT NULL ,
        `user_id` INT NOT NULL ,
        `usage_month` INT NOT NULL ,
        `usage_year` YEAR NOT NULL ,
        `usage_count` INT NOT NULL
        ) ENGINE = InnoDB CHARACTER SET utf8 COLLATE utf8_general_ci;
        CREATE
         ALGORITHM = UNDEFINED
         VIEW `view_usage_log`
         (id,module_id,user_id,usage_month,usage_year,usage_count)
         AS select * from usage_log where `usage_month`=MONTH(curdate()) and `usage_year`= YEAR(curdate()) ;
         update users set package_id=0 where user_type="Admin"';


       
        // Loop through each line

        $lines=explode(";", $lines);
        $count=0;
        foreach ($lines as $line) 
        {
            $count++;      
            $this->db->query($line);
        }
        echo "SiteSpy has been updated to v2.1 successfully.".$count." queries executed.";    
    }

    public function v2_2to_v3_0()
    {

        // writting client js
        $client_js_content=file_get_contents('js/analytics_js/client.js');
        $client_js_content_new=str_replace("base_url_replace/", site_url(), $client_js_content);
        file_put_contents('js/analytics_js/client.js', $client_js_content_new, LOCK_EX);
        // writting client js

        $lines='ALTER TABLE `web_common_info` ADD INDEX ( `user_id` , `domain_name` ); 

        ALTER TABLE `antivirus_scan_info` ADD INDEX  `scan_info` (  `user_id` ,  `scanned_at` ,  `domain_name` );

        ALTER TABLE `backlink_generator` ADD INDEX  `backlink_generator` (  `user_id` ,  `generated_at` ,  `domain_name` );

        ALTER TABLE `backlink_search` ADD INDEX ( `user_id` , `searched_at` , `domain_name` ); 

        ALTER TABLE `domain` ADD INDEX ( `user_id` );

        ALTER TABLE `social_info` ADD INDEX ( `user_id` , `search_at` , `domain_name` );

        ALTER TABLE `alexa_info` ADD INDEX ( `user_id` , `checked_at` , `domain_name` );

        ALTER TABLE `alexa_info_full` ADD INDEX ( `user_id` , `searched_at` , `domain_name` );

        ALTER TABLE `dmoz_info` ADD INDEX ( `user_id` , `checked_at` , `domain_name` );

        ALTER TABLE `similar_web_info` ADD INDEX ( `user_id` , `searched_at` , `domain_name` );

        ALTER TABLE `expired_domain_list` ADD `sync_at` DATE NOT NULL AFTER `auction_end_date`; 

        ALTER TABLE `website_ping` ADD INDEX ( `user_id` , `ping_at` )';


       
        // Loop through each line

        $lines=explode(";", $lines);
        $count=0;
        foreach ($lines as $line) 
        {
            $count++;      
            $this->db->query($line);
        }
        echo "SiteSpy has been updated to v3.0 successfully.".$count." queries executed.";
    }


    function v_3_1to3_2()
    {
        $lines="ALTER TABLE `web_common_info` ADD INDEX ( `user_id` , `domain_name` ); 

        ALTER TABLE `antivirus_scan_info` ADD INDEX  `scan_info` (  `user_id` ,  `scanned_at` ,  `domain_name` );

        ALTER TABLE `backlink_generator` ADD INDEX  `backlink_generator` (  `user_id` ,  `generated_at` ,  `domain_name` );

        ALTER TABLE `backlink_search` ADD INDEX ( `user_id` , `searched_at` , `domain_name` ); 

        ALTER TABLE `domain` ADD INDEX ( `user_id` );

        ALTER TABLE `social_info` ADD INDEX ( `user_id` , `search_at` , `domain_name` );

        ALTER TABLE `alexa_info` ADD INDEX ( `user_id` , `checked_at` , `domain_name` );

        ALTER TABLE `alexa_info_full` ADD INDEX ( `user_id` , `searched_at` , `domain_name` );

        ALTER TABLE `dmoz_info` ADD INDEX ( `user_id` , `checked_at` , `domain_name` );

        ALTER TABLE `similar_web_info` ADD INDEX ( `user_id` , `searched_at` , `domain_name` );   

        ALTER TABLE `website_ping` ADD INDEX ( `user_id` , `ping_at` );

        ALTER TABLE `expired_domain_list` ADD `sync_at` DATE NOT NULL AFTER `auction_end_date`;
        
        INSERT INTO `modules` (`id`, `module_name`, `deleted`) VALUES (NULL, 'Code Minifier', '0');
        INSERT INTO `modules` (`id`, `module_name`, `deleted`) VALUES (NULL, 'URL Shortener', '0');

        CREATE TABLE `url_shortener` (
        `id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY ,
        `long_url` TEXT NULL ,
        `short_url` TEXT NULL ,
        `add_date` DATE NOT NULL
        ) ENGINE = InnoDB CHARACTER SET utf8 COLLATE utf8_general_ci;
        ALTER TABLE `url_shortener` ADD `user_id` INT( 11 ) NOT NULL;

        CREATE TABLE `ip_v6_check` (
        `id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY ,
        `ipv6` VARCHAR( 200 ) NULL ,
        `searched_at` DATETIME NOT NULL
        ) ENGINE = MYISAM ;

        ALTER TABLE `ip_v6_check` ADD `ip` VARCHAR( 200 ) NULL ,
        ADD `is_ipv6_compatiable` VARCHAR( 10 ) NOT NULL DEFAULT '0';
        ALTER TABLE `ip_v6_check` ADD `domain_name` TEXT NULL AFTER `id`;
        ALTER TABLE `ip_v6_check` ADD `user_id` INT NOT NULL DEFAULT '0' AFTER `is_ipv6_compatiable`;
        ALTER TABLE `ip_v6_check` CHANGE `is_ipv6_compatiable` `is_ipv6_support` VARCHAR( 10 ) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT '0';
        CREATE TABLE `login_config` (
        `id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY ,
        `api_id` VARCHAR( 250 ) NULL ,
        `api_secret` VARCHAR( 250 ) NULL ,
        `google_client_id` VARCHAR( 250 ) NULL ,
        `google_client_secret` VARCHAR( 250 ) NULL ,
        `status` ENUM( '0', '1' ) NOT NULL DEFAULT '1',
        `deleted` ENUM( '0', '1' ) NOT NULL DEFAULT '0'
        ) ENGINE = InnoDB CHARACTER SET utf8 COLLATE utf8_general_ci;
        ALTER TABLE `login_config` ADD `app_name` VARCHAR( 100 ) CHARACTER SET utf8 COLLATE utf8_general_ci NULL AFTER `id` ;
        ALTER TABLE `login_config` CHANGE `google_client_id` `google_client_id` TEXT CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL;
        ALTER TABLE `page_status` CHANGE `url` `url` TEXT CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL;
        ALTER TABLE `ip_v6_check` CHANGE `domain_name` `domain_name` TEXT CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL;
        ALTER TABLE `payment_config` CHANGE `currency` `currency` ENUM( 'USD', 'AUD', 'CAD', 'EUR', 'ILS', 'NZD', 'RUB', 'SGD', 'SEK', 'BRL' ) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL;
        ALTER TABLE `transaction_history` ADD `stripe_card_source` TEXT NOT NULL;
        ALTER TABLE `payment_config` ADD `stripe_secret_key` VARCHAR( 150 ) NOT NULL AFTER `paypal_email`;
        ALTER TABLE `payment_config` ADD `stripe_publishable_key` VARCHAR( 150 ) NOT NULL AFTER `stripe_secret_key`";


       
        // Loop through each line

        $lines=explode(";", $lines);
        $count=0;
        foreach ($lines as $line) 
        {
            $count++;      
            $this->db->query($line);
        }
        echo "SiteSpy has been updated to v3.2 successfully.".$count." queries executed.";
    }


    public function v_3_1to3_2_1() // 3.2 to 3.2 fix version (new users : 3.2 only)
    {
        $lines="ALTER TABLE `web_common_info` ADD INDEX ( `user_id` , `domain_name` ); 

        ALTER TABLE `antivirus_scan_info` ADD INDEX  `scan_info` (  `user_id` ,  `scanned_at` ,  `domain_name` );

        ALTER TABLE `backlink_generator` ADD INDEX  `backlink_generator` (  `user_id` ,  `generated_at` ,  `domain_name` );

        ALTER TABLE `backlink_search` ADD INDEX ( `user_id` , `searched_at` , `domain_name` ); 

        ALTER TABLE `domain` ADD INDEX ( `user_id` );

        ALTER TABLE `social_info` ADD INDEX ( `user_id` , `search_at` , `domain_name` );

        ALTER TABLE `alexa_info` ADD INDEX ( `user_id` , `checked_at` , `domain_name` );

        ALTER TABLE `alexa_info_full` ADD INDEX ( `user_id` , `searched_at` , `domain_name` );

        ALTER TABLE `dmoz_info` ADD INDEX ( `user_id` , `checked_at` , `domain_name` );

        ALTER TABLE `similar_web_info` ADD INDEX ( `user_id` , `searched_at` , `domain_name` );   

        ALTER TABLE `website_ping` ADD INDEX ( `user_id` , `ping_at` );

        ALTER TABLE `expired_domain_list` ADD `sync_at` DATE NOT NULL AFTER `auction_end_date`";


       
        // Loop through each line

        $lines=explode(";", $lines);
        $count=0;
        foreach ($lines as $line) 
        {
            $count++;      
            $this->db->query($line);
        }
        echo "SiteSpy has been updated to v3.2 successfully.".$count." queries executed.";
    }



    function delete_update()
    {
        unlink(APPPATH."controllers/update.php");
    }
 


}
