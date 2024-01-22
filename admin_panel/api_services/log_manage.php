<?php

function log_manage($param = array(),$output = array(),$operation = '')
{
    global $outputjson, $gh, $db, $const, $postmark_message_id;    
    //$outputjson['success'] = 0;
    $record_id = $gh->read("record_id",0);
    $user_id = $gh->read('user_id',0);
    $custom_text = $gh->read('custom_text','');
    $from = $gh->read("from",PANEL_CONSTANT);
    $extraDataTrack = 0; // For Track to Add Extra Data
    $force_login=$gh->read('force_login',0);


    if($operation!='')
    {
        $str_arr = explode ("_", $operation);  
        /*For user_id*/
        if($str_arr[0]=='login' && $output['success']==1)
        {
            $user_id = $output['data']['user']['user_id'];
        }

        $data = array(
            'record_id' => $record_id
            , 'user_id' => $user_id
            , 'action' => ''
            , 'operation' => $operation
            , 'from' => $from
            , 'status' => $output['success']
            , 'date_added' => date("Y-m-d H:i:s")
            , 'date_modified' => date("Y-m-d H:i:s")
            , 'custom_text' => $custom_text
        );

        /*For Additional Data Add When Multiple Action Add From Single API call*/
        $dataExtra = $data; //Take Same Initialize Data Parmeters


        /*For Action Taken*/

        $data['action'] = '';

        if($str_arr[0]=='save')
        {
           $data['action'] = "Add";
        
        }
        else if (  in_array($str_arr[0], array('add', 'update', 'delete', 'login'))) {

            $data['action'] = ucwords($str_arr[0]);

        }
        else if ($operation=='send_custom_email') {

            $data['action'] = 'Sent Email';

        }
        
        /*For record_id & module_id*/

        if($str_arr[0]!='login')
        {
            /*with data object*/
            if(!empty($output['data']) || !empty($output['file']))
            {
                /*Delete Module Global*/
                if ($operation=='delete_module_record') {

                    $data['record_id'] = $gh->read('primary_key',0);
                    $data['module_id'] = 0;
                    $data['module_key'] = $gh->read('module_key','');
                }
                else
                {
                    $data['is_deleted'] = 1;
                }

            }
            else
            {
                /*without data object*/

                if ($operation=='delete_module_record') {

                    $data['record_id'] = $gh->read('primary_key',0);
                    $data['module_id'] = 0;
                    $data['module_key'] = $gh->read('module_key','');
                }
                else
                {
                    $data['is_deleted'] = 1;      
                }
                
            }
            
        }
        $data['ip_address'] = $ipaddress = $gh->get_client_ip();
        
        if(!($str_arr[0]=='login' && empty($output['success'])) && $force_login == 0){

            $log_id = $db->insert("tbl_audit_logs", $data);            
            $gh->Log("audit_log_service > LOGID: $log_id");
        }
    }
   
}

?>