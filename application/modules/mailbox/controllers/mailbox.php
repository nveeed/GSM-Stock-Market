<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mailbox extends MX_Controller 
{
    function __construct()
    {
        parent::__construct();
        if ( ! $this->session->userdata('logged_in'))
        { 
            redirect('login');
        }
        $this->load->model('mailbox/mailbox_model', 'mailbox_model');
        $this->load->library('pagination');
    }

    function index()
    {
        $data['main'] = 'mailbox';        
        $data['title'] = 'GSM - Mailbox';        
        $data['page'] = 'index';
        
        $this->load->module('templates');
        $this->templates->page($data);
    }
    
    function inbox($from = NULL, $mid = NULL, $off = NULL)
    {
        
        $config['base_url'] = $this->config->item('base_url').'mailbox/inbox/'.$from.'/page';
        $config['uri_segment'] = 2;
        
        if(isset($mid) && $mid != 'page'){
            $belong = $this->mailbox_model->get_where($mid)->sent_member_id;
            
            if($belong != $this->session->userdata('members_id')){
               redirect('mailbox/inbox/all');
            }
        }
        
//        if(isset($off)){
//              $offset = 20;
//            }
//            else{
//                $offset = 0;
//            }
//        
        $data['main'] = 'mailbox';
        $data['title'] = 'GSM - Inbox';        
        $data['page'] = 'inbox';        
        $data['message'] = $this->mailbox_model->get_where_multiple('id', $mid);
        $data['from'] = $from;
        
        
        if($from == 'member'){
            
            if(isset($mid) && $mid != 'page'){
                $sent_from = $this->mailbox_model->get_where($mid)->sent_from;                

                if($from != $sent_from){
                   redirect('mailbox/inbox/'.$from);
                }
            }
            
            if(isset($off) && $off > 1){
                $new_mem = $off-1;
                $offset = 20*$new_mem;
            }
            else{
                $offset = 0;
            }

            $data['header'] = 'From Member';
            
            $mem_count = $this->mailbox_model->count_where_multiple('sent_member_id',$this->session->userdata('members_id'), 'sent_from', $from, 'inbox', 'yes');
                        
            if($mem_count > 0){            
                $data['inbox_mem_count'] = $mem_count;
                $data['inbox_mem_ncount'] = $this->mailbox_model->count_where_multiple('sent_member_id',$this->session->userdata('members_id'), 'sent_from', $from, 'inbox', 'yes', 'mail_read', 'no');
                $data['inbox_member'] = $this->mailbox_model->get_where_multiples_order('datetime', 'DESC', 'sent_member_id', $this->session->userdata('members_id'), 'sent_from', $from, 'inbox', 'yes', NULL, NULL, 20, $offset);      
                $data['inbox_ncount'] = 0;
                
                
                $config['total_rows'] = $mem_count;
                $config['per_page'] = 20;
                $config["uri_segment"] = 5;
                $config['use_page_numbers'] = TRUE;
                
                $config['full_tag_open'] = '<div class="btn-group pull-right">';
                $config['full_tag_close'] = '</div>';
                $config['next_tag_open'] = '<div class="btn btn-white">';
                $config['next_tag_close'] = '</div>';
                $config['prev_tag_open'] = ' <div class="btn btn-white">';
                $config['prev_tag_close'] = '</div>';
                $config['cur_tag_open'] = '<div class="btn btn-white  active">';
                $config['cur_tag_close'] = '</div>';
                $config['num_tag_open'] = '<div class="btn btn-white">';                
                $config['num_tag_close'] = '</div>';
                $config['prev_link'] = '<i class="fa fa-chevron-left"></i>';
                $config['next_link'] = '<i class="fa fa-chevron-right"></i>';
                
                $this->pagination->initialize($config);
                
                if(!is_numeric($mid)){
                    $data['pagination'] = $this->pagination->create_links();
                }
                else{
                    $data['pagination'] = '';
                }
            }
            else{            
                $data['inbox_mem_count'] = 0;
                $data['inbox_mem_ncount'] = 0;
            }
            
        }
        elseif($from == 'market'){
            
            if(isset($mid) && $mid != 'page'){
                $sent_from = $this->mailbox_model->get_where($mid)->sent_from;                

                if($from != $sent_from){
                   redirect('mailbox/inbox/'.$from);
                }
            }
            
            if(isset($off) && $off > 1){
                $new_mem = $off-1;
                $offset = 20*$new_mem;
            }
            else{
                $offset = 0;
            }

            $data['header'] = 'From Marketplace';
            
            $mark_count = $this->mailbox_model->count_where_multiple('sent_member_id',$this->session->userdata('members_id'), 'sent_from', $from, 'inbox', 'yes');
            
            if($mark_count > 0){            
                $data['inbox_mark_count'] = $mark_count;
                $data['inbox_mark_ncount'] = $this->mailbox_model->count_where_multiple('sent_member_id',$this->session->userdata('members_id'), 'sent_from', $from, 'inbox', 'yes', 'mail_read', 'no');
                $data['inbox_market'] = $this->mailbox_model->get_where_multiples_order('datetime', 'DESC', 'sent_member_id', $this->session->userdata('members_id'), 'sent_from', $from, 'inbox', 'yes', NULL, NULL, 20, $offset);        
                
                $config['total_rows'] = $mark_count;
                $config['per_page'] = 20;
                $config["uri_segment"] = 5;
                $config['use_page_numbers'] = TRUE;
                
                $config['full_tag_open'] = '<div class="btn-group pull-right">';
                $config['full_tag_close'] = '</div>';
                $config['next_tag_open'] = '<div class="btn btn-white">';
                $config['next_tag_close'] = '</div>';
                $config['prev_tag_open'] = ' <div class="btn btn-white">';
                $config['prev_tag_close'] = '</div>';
                $config['cur_tag_open'] = '<div class="btn btn-white  active">';
                $config['cur_tag_close'] = '</div>';
                $config['num_tag_open'] = '<div class="btn btn-white">';                
                $config['num_tag_close'] = '</div>';
                $config['prev_link'] = '<i class="fa fa-chevron-left"></i>';
                $config['next_link'] = '<i class="fa fa-chevron-right"></i>';

                $this->pagination->initialize($config);

                if(!is_numeric($mid)){
                    $data['pagination'] = $this->pagination->create_links();
                }
                else{
                    $data['pagination'] = '';
                }
            }
            else{            
                $data['inbox_mark_count'] = 0;
                $data['inbox_mark_ncount'] = 0;
            }
            
        }
        elseif($from == 'support'){
            
            if(isset($mid) && $mid != 'page'){
                $sent_from = $this->mailbox_model->get_where($mid)->sent_from;                

                if($from != $sent_from){
                   redirect('mailbox/inbox/'.$from);
                }
            }
            
            if(isset($off) && $off > 1){
                $new_mem = $off-1;
                $offset = 20*$new_mem;
            }
            else{
                $offset = 0;
            }

            $data['header'] = 'From Support Team';
            
            $s_count = $this->mailbox_model->count_where_multiple('sent_member_id',$this->session->userdata('members_id'), 'sent_from', $from, 'inbox', 'yes');
            
            if($s_count > 0){            
                $data['inbox_s_count'] = $s_count;
                $data['inbox_s_ncount'] = $this->mailbox_model->count_where_multiple('sent_member_id',$this->session->userdata('members_id'), 'sent_from', $from, 'inbox', 'yes', 'mail_read', 'no');
                $data['inbox_support'] = $this->mailbox_model->get_where_multiples_order('datetime', 'DESC', 'sent_member_id', $this->session->userdata('members_id'), 'sent_from', $from, 'inbox', 'yes', NULL, NULL, 20, $offset);
                
                $config['total_rows'] = $s_count;
                $config['per_page'] = 20;
                $config["uri_segment"] = 5;
                $config['use_page_numbers'] = TRUE;
                
                $config['full_tag_open'] = '<div class="btn-group pull-right">';
                $config['full_tag_close'] = '</div>';
                $config['next_tag_open'] = '<div class="btn btn-white">';
                $config['next_tag_close'] = '</div>';
                $config['prev_tag_open'] = ' <div class="btn btn-white">';
                $config['prev_tag_close'] = '</div>';
                $config['cur_tag_open'] = '<div class="btn btn-white  active">';
                $config['cur_tag_close'] = '</div>';
                $config['num_tag_open'] = '<div class="btn btn-white">';                
                $config['num_tag_close'] = '</div>';
                $config['prev_link'] = '<i class="fa fa-chevron-left"></i>';
                $config['next_link'] = '<i class="fa fa-chevron-right"></i>';

                $this->pagination->initialize($config);

                if(!is_numeric($mid)){
                    $data['pagination'] = $this->pagination->create_links();
                }
                else{
                    $data['pagination'] = '';
                }
            }
            else{            
                $data['inbox_s_count'] = 0;
                $data['inbox_s_ncount'] = 0;
            }

        }elseif($from == 'all'){
            
            if(isset($off) && $off > 1){
                $new_mem = $off-1;
                $offset = 20*$new_mem;
            }
            else{
                $offset = 0;
            }

            $data['header'] = 'Inbox';
            
            $count = $this->mailbox_model->count_where('sent_member_id',$this->session->userdata('members_id'), 'inbox', 'yes');
            
            if($count > 0){            
                $data['inbox_i_count'] = $count;
                $data['inbox_i_ncount'] = $this->mailbox_model->count_where('sent_member_id',$this->session->userdata('members_id'), 'inbox', 'yes', 'mail_read', 'no');
                $data['inbox_all'] = $this->mailbox_model->get_where_multiples_order('datetime', 'DESC', 'sent_member_id',$this->session->userdata('members_id'), 'inbox', 'yes', NULL, NULL, NULL, NULL, 20, $offset);
                $array = $this->mailbox_model->_custom_query("SELECT id FROM mailbox WHERE sent_member_id = '".$this->session->userdata('members_id')."'");
                
//                echo '<pre>';
//                $count = 0;
//                print_r($array);
//                echo $array[$count+1]->id;
//                foreach ($array as $id => $value){
//                    echo $id->id.'<br/>';
//                }
//                exit;

                $config['total_rows'] = $count;
                $config['per_page'] = 20;
                $config["uri_segment"] = 5;
                $config['use_page_numbers'] = TRUE;
                
                $config['full_tag_open'] = '<div class="btn-group pull-right">';
                $config['full_tag_close'] = '</div>';
                $config['next_tag_open'] = '<div class="btn btn-white">';
                $config['next_tag_close'] = '</div>';
                $config['prev_tag_open'] = ' <div class="btn btn-white">';
                $config['prev_tag_close'] = '</div>';
                $config['cur_tag_open'] = '<div class="btn btn-white  active">';
                $config['cur_tag_close'] = '</div>';
                $config['num_tag_open'] = '<div class="btn btn-white">';                
                $config['num_tag_close'] = '</div>';
                $config['prev_link'] = '<i class="fa fa-chevron-left"></i>';
                $config['next_link'] = '<i class="fa fa-chevron-right"></i>';

                $this->pagination->initialize($config);

                if(!is_numeric($mid)){
                    $data['pagination'] = $this->pagination->create_links();
                }
                else{
                    $data['pagination'] = '';
                }
            }
            else{            
                $data['inbox_count'] = 0;
                $data['inbox_ncount'] = 0;
            }

        }
        
        $this->load->module('templates');
        $this->templates->page($data);
    }
    
    function reply($oid, $mid = NULL)
    { 
//        if(){
//            redirect('mailbox/inbox', 'refresh')
//        }
        $data['main'] = 'mailbox';        
        $data['title'] = 'GSM - Reply Mail';        
        $data['page'] = 'reply';
        
        $count = $this->mailbox_model->_custom_query("SELECT COUNT(id) AS cid FROM mailbox WHERE (sent_member_id = '".$this->session->userdata('members_id')."' AND parent_id = '".$oid."') OR (member_id = '".$this->session->userdata('members_id')."' AND parent_id = '".$oid."')");
        
        foreach ($count as $row)
        {
            $cid = $row->cid;
        }
        
        
        if($cid > 0){
            $data['reply_count'] = $cid;
            $data['inbox_reply'] = $this->mailbox_model->_custom_query("SELECT * FROM mailbox WHERE (sent_member_id = '".$this->session->userdata('members_id')."' AND parent_id = '".$oid."') OR (member_id = '".$this->session->userdata('members_id')."' AND parent_id = '".$oid."') ORDER BY datetime DESC");
        }
        else{
             $data['reply_count'] = 0;
        }
        $data['inbox_original'] = $this->mailbox_model->get_where($oid);
        $this->load->module('templates');
        $this->templates->page($data);
    }
    
    function sent($mid = NULL, $off = NULL)
    {
        
        if(isset($mid) && $mid != 'page'){
            $cid = $this->mailbox_model->get_where($mid)->member_id;                

            if($cid != $this->session->userdata('members_id')){
               redirect('mailbox/sent/');
            }
        }
        
        if(isset($off) && $off > 1){
            $new_mem = $off-1;
            $offset = 20*$new_mem;
        }
        else{
            $offset = 0;
        }
        
        $data['main'] = 'mailbox';        
        $data['title'] = 'GSM - Inbox';        
        $data['page'] = 'sent';
        
        $count = $this->mailbox_model->count_where_multiple('sent_belong',$this->session->userdata('members_id'), 'sent', 'yes');
        
        if($count > 0){            
            $data['inbox_sent_count'] = $count;
            $data['inbox_sent_message'] = $this->mailbox_model->get_where_multiples_order('datetime', 'DESC', 'sent_belong', $this->session->userdata('members_id'), 'sent', 'yes', NULL, NULL, NULL, NULL, 20, $offset);
            
            $config['base_url'] = $this->config->item('base_url').'mailbox/sent/page/';           
            $config['total_rows'] = $count;
            $config['per_page'] = 20;
            $config["uri_segment"] = 4;
            $config['use_page_numbers'] = TRUE;            
            $config['full_tag_open'] = '<div class="btn-group pull-right">';
            $config['full_tag_close'] = '</div>';
            $config['next_tag_open'] = '<div class="btn btn-white">';
            $config['next_tag_close'] = '</div>';
            $config['prev_tag_open'] = ' <div class="btn btn-white">';
            $config['prev_tag_close'] = '</div>';
            $config['cur_tag_open'] = '<div class="btn btn-white  active">';
            $config['cur_tag_close'] = '</div>';
            $config['num_tag_open'] = '<div class="btn btn-white">';                
            $config['num_tag_close'] = '</div>';
            $config['prev_link'] = '<i class="fa fa-chevron-left"></i>';
            $config['next_link'] = '<i class="fa fa-chevron-right"></i>';

            $this->pagination->initialize($config);

            if(!is_numeric($mid)){
                $data['pagination'] = $this->pagination->create_links();
            }
            else{
                $data['pagination'] = '';
            }
        }
        else{            
            $data['inbox_sent_count'] = 0;
        }
        
        $data['message'] = $this->mailbox_model->get_where_multiple('id', $mid);
        
        $this->load->module('templates');
        $this->templates->page($data);
    }
    
    function mark_read($from, $mid)
    {
        $data = array(
                        'mail_read'     => 'yes'
                      );

        $this->load->model('mailbox/mailbox_model', 'mailbox_model');
        $this->mailbox_model->_update($mid, $data);
        
        if($from == 'archive'){
            redirect('mailbox/'.$from);
        }else{        
            redirect('mailbox/inbox/'.$from);
        }
    }
    
    function mark_unread($from, $mid)
    {
        $data = array(
                        'mail_read'     => 'no'
                      );
        
        $this->mailbox_model->_update($mid, $data);
        
        if($from == 'archive'){
            redirect('mailbox/'.$from);
        }else{        
            redirect('mailbox/inbox/'.$from);
        }
    }
    
    function important($mid = NULL, $off = NULL)
    {
        if(isset($mid) && $mid != 'page'){
            $cid = $this->mailbox_model->get_where($mid)->important_belong;                

            if($cid != $this->session->userdata('members_id')){
               redirect('mailbox/important/');
            }
        }        
        
        if(isset($off) && $off > 1){
            $new_mem = $off-1;
            $offset = 20*$new_mem;
        }
        else{
            $offset = 0;
        }        
        
        $data['main'] = 'mailbox';        
        $data['title'] = 'GSM - Inbox';        
        $data['page'] = 'important';
        
        $count = $this->mailbox_model->count_where_multiple('important_belong',$this->session->userdata('members_id'), 'important', 'yes');
        
        if($count > 0){            
            $data['inbox_important_count'] = $count;
             $data['inbox_important_message'] = $this->mailbox_model->get_where_multiples_order('datetime', 'DESC', 'important_belong', $this->session->userdata('members_id'), 'important', 'yes', NULL, NULL, NULL, NULL, 20, $offset);
             
             $config['base_url'] = $this->config->item('base_url').'mailbox/important/page/';           
            $config['total_rows'] = $count;
            $config['per_page'] = 20;
            $config["uri_segment"] = 4;
            $config['use_page_numbers'] = TRUE;            
            $config['full_tag_open'] = '<div class="btn-group pull-right">';
            $config['full_tag_close'] = '</div>';
            $config['next_tag_open'] = '<div class="btn btn-white">';
            $config['next_tag_close'] = '</div>';
            $config['prev_tag_open'] = ' <div class="btn btn-white">';
            $config['prev_tag_close'] = '</div>';
            $config['cur_tag_open'] = '<div class="btn btn-white  active">';
            $config['cur_tag_close'] = '</div>';
            $config['num_tag_open'] = '<div class="btn btn-white">';                
            $config['num_tag_close'] = '</div>';
            $config['prev_link'] = '<i class="fa fa-chevron-left"></i>';
            $config['next_link'] = '<i class="fa fa-chevron-right"></i>';

            $this->pagination->initialize($config);

            if(!is_numeric($mid)){
                $data['pagination'] = $this->pagination->create_links();
            }
            else{
                $data['pagination'] = '';
            }
        }
        else{            
            $data['inbox_important_count'] = 0;
        }
        
        $data['message'] = $this->mailbox_model->get_where_multiple('id', $mid);
        
        $this->load->module('templates');
        $this->templates->page($data);
    }
    
    function important_move($mid)
    {
        $data = array(
                        'trash'             => 'no',
                        'important'         => 'yes',
                        'important_belong'  => $this->session->userdata('members_id'),
                        'archive_belong'    => '',
                        'trash_belong'      => '',
                        'sent_belong'      => '',
                        'draft'             => 'no'
                      );
        
        $this->mailbox_model->_update($mid, $data);
        
        redirect('mailbox/important');
    }
    
    function draft($mid = NULL, $off = NULL)
    {
        if(isset($mid) && $mid != 'page'){
            
            $pid = $this->mailbox_model->get_where_multiple('id', $mid)->parent_id;
            $cid = $this->mailbox_model->get_where($mid)->member_id;
            
            
            if(isset($off) && $off > 1){
                $new_mem = $off-1;
                $offset = 20*$new_mem;
            }
            else{
                $offset = 0;
            }
        
            if($pid > 0){
                
                $count = $this->mailbox_model->count_where_multiple('member_id',$this->session->userdata('members_id'), 'draft', 'yes', 'parent_id', $this->mailbox_model->get_where_multiple('id', $mid)->parent_id);
            
                if($count > 0){            
                    $data['inbox_draft_count_reply'] = $count;
                    $data['inbox_draft_message_reply'] = $this->mailbox_model->get_where_multiples_order('datetime', 'DESC', 'member_id', $this->session->userdata('members_id'), 'draft', 'yes', 'parent_id', $this->mailbox_model->get_where_multiple('id', $mid)->parent_id, NULL, NULL, 20, $offset);
                    
                    $config['base_url'] = $this->config->item('base_url').'mailbox/draft/page/';           
            $config['total_rows'] = $count;
            $config['per_page'] = 20;
            $config["uri_segment"] = 4;
            $config['use_page_numbers'] = TRUE;            
            $config['full_tag_open'] = '<div class="btn-group pull-right">';
            $config['full_tag_close'] = '</div>';
            $config['next_tag_open'] = '<div class="btn btn-white">';
            $config['next_tag_close'] = '</div>';
            $config['prev_tag_open'] = ' <div class="btn btn-white">';
            $config['prev_tag_close'] = '</div>';
            $config['cur_tag_open'] = '<div class="btn btn-white  active">';
            $config['cur_tag_close'] = '</div>';
            $config['num_tag_open'] = '<div class="btn btn-white">';                
            $config['num_tag_close'] = '</div>';
            $config['prev_link'] = '<i class="fa fa-chevron-left"></i>';
            $config['next_link'] = '<i class="fa fa-chevron-right"></i>';

            $this->pagination->initialize($config);

            if(!is_numeric($mid)){
                $data['pagination'] = $this->pagination->create_links();
            }
            else{
                $data['pagination'] = '';
            }
                }
            }
            else{
                        
                $data['inbox_draft_count_reply'] = 0;
            
            }
        

            if($cid != $this->session->userdata('members_id')){
               redirect('mailbox/draft/');
            }
        }
        
        $data['main'] = 'mailbox';        
        $data['title'] = 'GSM - Inbox';        
        $data['page'] = 'draft';
        
        $count = $this->mailbox_model->count_where_multiple('member_id',$this->session->userdata('members_id'), 'draft', 'yes', 'sent', 'no');
        
        
        if($count > 0){            
            $data['inbox_draft_count'] = $count;
            $data['inbox_draft_message'] = $this->mailbox_model->get_where_multiples_order('datetime', 'DESC', 'member_id',$this->session->userdata('members_id'), 'draft', 'yes', 'sent', 'no');
        }
        else{            
            $data['inbox_draft_count'] = 0;
        }
        
        
        
        $data['message'] = $this->mailbox_model->get_where_multiple('id', $mid);
        
        $this->load->module('templates');
        $this->templates->page($data);
    }
    
    function draft_move($mid)
    {
        $data = array(
                        'trash'     => 'no',
                        'sent'      => 'no',
                        'important' => 'no',
                        'inbox'     => 'yes',
                        'draft'     => 'yes'
                      );
        
        $this->mailbox_model->_update($mid, $data);
        
        redirect('mailbox/draft');
    }
    
    function trash($mid = NULL, $off = NULL)
    {
        if(isset($mid) && $mid != 'page'){
            $cid = $this->mailbox_model->get_where($mid)->trash_belong;
            

            if($cid != $this->session->userdata('members_id')){
               redirect('mailbox/trash/');
            }
        }
        
        
        if(isset($off) && $off > 1){
            $new_mem = $off-1;
            $offset = 20*$new_mem;
        }
        else{
            $offset = 0;
        }
        
        
        $data['main'] = 'mailbox';        
        $data['title'] = 'GSM - Inbox';        
        $data['page'] = 'trash';
        
        
        $count = $this->mailbox_model->count_where_multiple('trash_belong', $this->session->userdata('members_id'), 'trash', 'yes'); 
        
        if($count > 0){            
            $data['inbox_trash_count'] = $count;
            $data['inbox_trash_message'] = $this->mailbox_model->get_where_multiples_order('datetime', 'DESC', 'trash_belong', $this->session->userdata('members_id'), 'trash', 'yes', NULL, NULL, NULL, NULL, 20, $offset);                    
            
            $config['base_url'] = $this->config->item('base_url').'mailbox/trash/page/';           
            $config['total_rows'] = $count;
            $config['per_page'] = 20;
            $config["uri_segment"] = 4;
            $config['use_page_numbers'] = TRUE;            
            $config['full_tag_open'] = '<div class="btn-group pull-right">';
            $config['full_tag_close'] = '</div>';
            $config['next_tag_open'] = '<div class="btn btn-white">';
            $config['next_tag_close'] = '</div>';
            $config['prev_tag_open'] = ' <div class="btn btn-white">';
            $config['prev_tag_close'] = '</div>';
            $config['cur_tag_open'] = '<div class="btn btn-white  active">';
            $config['cur_tag_close'] = '</div>';
            $config['num_tag_open'] = '<div class="btn btn-white">';                
            $config['num_tag_close'] = '</div>';
            $config['prev_link'] = '<i class="fa fa-chevron-left"></i>';
            $config['next_link'] = '<i class="fa fa-chevron-right"></i>';

            $this->pagination->initialize($config);

            if(!is_numeric($mid)){
                $data['pagination'] = $this->pagination->create_links();
            }
            else{
                $data['pagination'] = '';
            }
        }
        else{
            $data['inbox_trash_count'] = 0;
        }
        
        $data['message'] = $this->mailbox_model->get_where_multiple('id', $mid);
        
        $this->load->module('templates');
        $this->templates->page($data);
    }
    
    function trash_move($mid)
    {
        $data = array(
                        'trash'                 => 'yes',
                        'trash_belong'          => $this->session->userdata('members_id'),
                        'archive_belong'        => '',
                        'important_belong'      => '',
                        'sent_belong'           => '',
                        'important'             => 'no',
                        'draft'                 => 'no'
                      );

        
        $this->mailbox_model->_update($mid, $data);
        
        redirect('mailbox/trash');
    }
    
    function delete($mid)
    {
        $data = array(
                        'deleted'     => 'yes'
                      );

        $this->load->model('mailbox/mailbox_model', 'mailbox_model');
        $this->mailbox_model->_update($mid, $data);
        
        $this->mailbox_model->_delete_where('deleted', 'yes');
        
        redirect('mailbox/trash');
    }
    
    function side_mail()
    { 
        $inbox_count = $this->mailbox_model->count_where_multiple('sent_member_id',$this->session->userdata('members_id'), 'mail_read', 'no', 'inbox', 'yes');
        $inbox_mem = $this->mailbox_model->count_where_multiple('sent_member_id',$this->session->userdata('members_id'), 'sent_from', 'member', 'mail_read', 'no', 'inbox', 'yes');
        $inbox_mark = $this->mailbox_model->count_where_multiple('sent_member_id',$this->session->userdata('members_id'), 'sent_from', 'market', 'mail_read', 'no', 'inbox', 'yes');
        $inbox_support = $this->mailbox_model->count_where_multiple('sent_member_id',$this->session->userdata('members_id'), 'sent_from', 'support', 'mail_read', 'no', 'inbox', 'yes');
        $inbox_draft = $this->mailbox_model->count_where_multiple('member_id',$this->session->userdata('members_id'), 'draft', 'yes', 'inbox', 'yes');
        
        if( $inbox_count > 0){
            $data['inbox'] = $inbox_count;
        }else{
            $data['inbox'] = 0;
        }
        
        if( $inbox_mem > 0){
            $data['member'] = $inbox_mem;
        }else{
            $data['member'] = 0;
        }
        
        if( $inbox_mark > 0){
            $data['market'] = $inbox_mark;
        }else{
            $data['market'] = 0;
        }
        
        if( $inbox_support > 0){
            $data['support'] = $inbox_support;
        }else{
            $data['support'] = 0;
        }
        
        if( $inbox_draft > 0){
            $data['draft'] = $inbox_draft;
        }else{
            $data['draft'] = 0;
        }
        
        $this->load->view('side-mail', $data);
    }
            
    function compose($mid = NULL)
    {
        $data['main'] = 'mailbox';        
        $data['title'] = 'GSM - Compose Mail';        
        $data['page'] = 'compose';
        
        if($mid != NULL){
            $data['draft'] = $mid;
        }
        
        $this->load->module('templates');
        $this->templates->page($data);
    }
    
    function composeMail()
    {
//        echo '<pre>';
//        print_r($_POST);
//        exit;
        
        $this->load->library('form_validation');
        
        $this->form_validation->set_rules('email_address', 'Email Address', 'xss_clean');
        $this->form_validation->set_rules('subject', 'Subject', 'xss_clean');
        $this->form_validation->set_rules('body', 'Message Body', 'xss_clean');
        
        $submit = $this->input->post('submit');
        $mail_type = $this->input->post('mail_type');
        $pid = $this->input->post('parent_id');
        
        if($pid > 0){
            $parent_id = $pid;
        }
        else{
            
        }
//        
        if($submit == 'Send' || $submit == 'Send Message'){
            
            if($this->form_validation->run()){
                
                $this->load->model('member/member_model', 'member_model');
                $sid = $this->member_model->get_where_multiple('email', $this->input->post('email_address'))->id;
                $message_type = $this->input->post('message_type');
                
                if($mail_type == 'draft'){

                    $data = array(
                                    'member_id'         => $this->session->userdata('members_id'),
                                    'sent_member_id'    => $sid,
                                    'subject'           => $this->input->post('subject'),
                                    'body'              => nl2br($this->input->post('body')),
                                    'inbox'             => 'yes',
                                    'sent'              => 'yes',
                                    'sent_belong'       => $this->session->userdata('members_id'),
                                    'draft'             => 'no',
                                    'date'              => date('d-m-Y'),
                                    'time'              => date('H:i'),
                                    'sent_from'         => 'member',
                                    'parent_id'         => $this->input->post('parent_id'),
                                    'datetime'          => date('Y-m-d H:i:s')
                                  );                    
                    $this->mailbox_model->_update($this->input->post('mail_id'), $data);
                    redirect('mailbox/draft');
                }
                else{                    

                    $data = array(
                                    'member_id'         => $this->session->userdata('members_id'),
                                    'sent_member_id'    => $sid,
                                    'subject'           => $this->input->post('subject'),
                                    'body'              => nl2br($this->input->post('body')),
                                    'inbox'             => 'yes',
                                    'sent'              => 'yes',
                                    'sent_belong'       => $this->session->userdata('members_id'),
                                    'date'              => date('d-m-Y'),
                                    'time'              => date('H:i'),
                                    'sent_from'         => 'member',
                                    'parent_id'         => $this->input->post('parent_id'),
                                    'datetime'          => date('Y-m-d H:i:s')
                                  );                    
                    $this->mailbox_model->_insert($data);
                    redirect('mailbox/inbox/all');
                }
                
            }            
            
            
            
        }
        elseif($submit == 'Draft'){
            
            if($this->form_validation->run()){
                
                $this->load->model('member/member_model', 'member_model');
                $sid = $this->member_model->get_where_multiple('email', $this->input->post('email_address'))->id;
                $mail_id = $this->input->post('mail_id');
                
                if($mail_id != ''){
                    
                    $data = array(
                                    
                                    'body'              => nl2br($this->input->post('body')),                                    
                                    'date'              => date('d-m-Y'),
                                    'time'              => date('H:i'),
                                    'datetime'          => date('Y-m-d H:i:s')
                                  );
                    
                    $this->mailbox_model->_update($mail_id, $data);
                    redirect('mailbox/draft');
                    
                }
                else{

                    $data = array(
                                    'member_id'         => $this->session->userdata('members_id'),
                                    'sent_member_id'    => $sid,
                                    'subject'           => $this->input->post('subject'),
                                    'body'              => nl2br($this->input->post('body')),
                                    'inbox'             => 'yes',
                                    'draft'             => 'yes',
                                    'date'              => date('d-m-Y'),
                                    'time'              => date('H:i'),
                                    'sent_from'         => 'member',
                                    'parent_id'         => $this->input->post('parent_id'),
                                    'datetime'          => date('Y-m-d H:i:s')
                                  );
                    
                    $this->mailbox_model->_insert($data);
                    redirect('mailbox/draft');
                }
            }
            
            redirect('mailbox/inbox/all', 'refresh');
        }
        elseif($submit == 'Delete'){
            
            $mail_id = $this->input->post('mail_id');            
            $this->mailbox_model->_delete($mail_id);
            redirect('mailbox/draft', 'refresh');
            
        }
        elseif($submit == 'Discard'){            
            redirect('mailbox/inbox/all', 'refresh');
        }
//       
            
        
    }
    
    function composeAjaxMail($mid, $sid, $subject, $body)
    {        
        $data = array(
                                    'member_id'         => $mid,
                                    'sent_member_id'    => $sid,
                                    'subject'           => str_replace('%20', ' ',$subject),
                                    'body'              => nl2br(str_replace('%20', ' ',$body)),
                                    'inbox'             => 'yes',
                                    'sent'              => 'yes',
                                    'sent_belong'       => $mid,
                                    'date'              => date('d-m-Y'),
                                    'time'              => date('H:i'),
                                    'sent_from'         => 'member',
                                    'parent_id'         => '',
                                    'datetime'          => date('Y-m-d H:i:s')
                                  );                    
                    $this->mailbox_model->_insert($data);
                    redirect('mailbox/inbox/all');
    }
            
    function archive($mid = NULL, $off = NULL)
    {
        if(isset($mid) && $mid != 'page'){
            $cid = $this->mailbox_model->get_where($mid)->archive_belong;                

            if($cid != $this->session->userdata('members_id')){
               redirect('mailbox/archive/');
            }
        }                
        
        if(isset($off) && $off > 1){
            $new_mem = $off-1;
            $offset = 20*$new_mem;
        }
        else{
            $offset = 0;
        }
        
        $data['main'] = 'mailbox';        
        $data['title'] = 'GSM - Archive Mail';        
        $data['page'] = 'archive';
        
        $count = $this->mailbox_model->count_where_multiple('archive_belong',$this->session->userdata('members_id'), 'archive', 'yes');
        
        if($count > 0){            
            $data['inbox_archive_count'] = $count;
            $data['inbox_archive_message'] = $this->mailbox_model->get_where_multiples_order('datetime', 'DESC', 'archive_belong', $this->session->userdata('members_id'), 'archive', 'yes', NULL, NULL, NULL, NULL, 20, $offset);
            
            $config['base_url'] = $this->config->item('base_url').'mailbox/archive/page/';           
            $config['total_rows'] = $count;
            $config['per_page'] = 20;
            $config["uri_segment"] = 4;
            $config['use_page_numbers'] = TRUE;            
            $config['full_tag_open'] = '<div class="btn-group pull-right">';
            $config['full_tag_close'] = '</div>';
            $config['next_tag_open'] = '<div class="btn btn-white">';
            $config['next_tag_close'] = '</div>';
            $config['prev_tag_open'] = ' <div class="btn btn-white">';
            $config['prev_tag_close'] = '</div>';
            $config['cur_tag_open'] = '<div class="btn btn-white  active">';
            $config['cur_tag_close'] = '</div>';
            $config['num_tag_open'] = '<div class="btn btn-white">';                
            $config['num_tag_close'] = '</div>';
            $config['prev_link'] = '<i class="fa fa-chevron-left"></i>';
            $config['next_link'] = '<i class="fa fa-chevron-right"></i>';

            $this->pagination->initialize($config);

            if(!is_numeric($mid)){
                $data['pagination'] = $this->pagination->create_links();
            }
            else{
                $data['pagination'] = '';
            }
        }
        else{            
            $data['inbox_archive_count'] = 0;
        }        
        
       $data['message'] = $this->mailbox_model->get_where_multiple('id', $mid);
        
        $this->load->module('templates');
        $this->templates->page($data);
    }
    
    function archive_move($mid)
    {
        $data = array(
                        'archive'           => 'yes',
                        'important'         => 'no',
                        'sent_from'         => 'moved_archive',
                        'archive_belong'    => $this->session->userdata('members_id'),
                        'trash_belong'      => '',
                        'sent_belong'      => '',                        
                        'important_belong'  => ''
                      );
        
        $this->mailbox_model->_update($mid, $data);
        
        redirect('mailbox/archive');
    }
    
    function mass_process()
    {
//        echo '<pre>';
//        print_r($_POST);
//        exit;
        $submit = $this->input->post('button');
        $back = $this->input->post('page_from');
        
        if($submit == 'read'){
            
            foreach($_POST as $post_vale => $post_key){
                
                $data = array(
                        'mail_read'     => 'yes'
                      );
        
                $this->mailbox_model->_update($post_vale, $data);
                //redirect('mailbox/inbox/'.$back);
            }
        }
        elseif($submit == 'unread'){
            
            foreach($_POST as $post_vale => $post_key){
                
                $data = array(
                        'mail_read'     => 'no'
                      );
        
                $this->mailbox_model->_update($post_vale, $data);
                //redirect('mailbox/inbox/'.$back);
            }
            
        }
        
        elseif($submit == 'important'){
            
            foreach($_POST as $post_vale => $post_key){
                
                $data = array(
                        'important'         => 'yes',
                        'mail_read'         => 'yes',
                        'inbox'             => 'no',
                        'sent_from'         => 'moved_important',
                        'important_belong'  => $this->session->userdata('members_id'),
                        'archive_belong'    => '',
                        'draft_belong'      => '',
                        'sent_belong'       => '',
                        'trash_belong'      => ''
                      );
        
                $this->mailbox_model->_update($post_vale, $data);
            }
            
        }
        elseif($submit == 'archive'){
            
            foreach($_POST as $post_vale => $post_key){
                
                $data = array(
                        'archive'           => 'yes',
                        'mail_read'         => 'yes',
                        'inbox'             => 'no',
                        'sent_from'         => 'moved_archive',
                        'archive_belong'    => $this->session->userdata('members_id'),
                        'draft_belong'      => '',
                        'trash_belong'      => '',
                        'sent_belong'       => '',                        
                        'important_belong'  => ''
                      );
        
                $this->mailbox_model->_update($post_vale, $data);
            }
            
        }
        elseif($submit == 'trash'){
            
            foreach($_POST as $post_vale => $post_key){
                
                $data = array(
                        'trash'             => 'yes',
                        'trash_belong'      => $this->session->userdata('members_id'),
                        'inbox'             => 'no',                   
                        'mail_read'         => 'yes',
                        'sent_from'         => 'moved_trash',
                        'trash_belong'      => $this->session->userdata('members_id'),
                        'draft_belong'      => '',
                        'important_belong'  => '',                        
                        'sent_belong'      => '',                        
                        'archive_belong'    => ''
                      );
        
                $this->mailbox_model->_update($post_vale, $data);
            }
        }
        
        elseif($submit == 'delete'){
            
            foreach($_POST as $post_vale => $post_key){
                
                $this->mailbox_model->_delete($post_vale);
            }
        }
        if($submit == 'read' || $submit == 'unread'){
            redirect('mailbox/inbox/all');
        }else{
            redirect('mailbox/'.$submit);
        }
    }
    
    function mail_dropdown($mail_count){
        
        $data['base'] = $this->config->item('base_url');
        $count = $this->mailbox_model->count_where_multiple('sent_member_id',$this->session->userdata('members_id'), 'inbox', 'yes', 'mail_read', 'no');
        
        if($count > 0){            
            $data['count'] = $count;
            $data['inbox_message'] = $this->mailbox_model->_custom_query("SELECT * FROM mailbox WHERE mail_read = 'no' AND sent_member_id = '".$this->session->userdata('members_id')."' AND inbox = 'yes' ORDER BY datetime DESC LIMIT ".$mail_count."");
        }
        else{
            $data['count'] = 0;
        }
        $this->load->view('dropdown', $data);
    }
    
    function mail_recent($mail_count){
        
        $data['base'] = $this->config->item('base_url');
        
        $draft_count = $this->mailbox_model->count_where_multiple('member_id',$this->session->userdata('members_id'), 'draft', 'yes');
        
        if($draft_count > 0){
            
            $data['d_count'] = $draft_count;
            
        }
        else{
            $data['d_count'] = 0;
        }
        
        $new_count = $this->mailbox_model->count_where_multiple('sent_member_id',$this->session->userdata('members_id'), 'inbox', 'yes', 'mail_read', 'no');
        
        if($new_count > 0){
            
            $data['n_count'] = $new_count;
            
        }
        else{
            $data['n_count'] = 0;
        }
        
        $count = $this->mailbox_model->count_where_multiple('sent_member_id',$this->session->userdata('members_id'), 'inbox', 'yes');
        
        if($count > 0){            
            $data['inbox_count'] = $count;
            $data['inbox_recent'] = $this->mailbox_model->_custom_query("SELECT * FROM mailbox WHERE sent_member_id = '".$this->session->userdata('members_id')."' AND inbox = 'yes' ORDER BY datetime DESC LIMIT ".$mail_count."");
        }
        else{
            $data['inbox_count'] = 0;
        }
        $this->load->view('recent', $data);
         
    }
    
    function messages_count(){
        echo $this->mailbox_model->count_where_multiple('sent_member_id',$this->session->userdata('members_id'), 'mail_read', 'no', 'inbox', 'yes').'/'.$this->mailbox_model->count_where_multiple('sent_member_id',$this->session->userdata('members_id'), 'inbox', 'yes');        
        
    }    
    function new_message(){
        $count = $this->mailbox_model->count_where_multiple('sent_member_id',$this->session->userdata('members_id'), 'mail_read', 'no', 'inbox', 'yes');
        if($count > 0){
            echo '<span class="label label-warning">'.$count.'</span>';            
        }  
        
    }
    function new_message_all(){
        $count = $this->mailbox_model->count_where_multiple('sent_member_id',$this->session->userdata('members_id'), 'mail_read', 'no', 'inbox', 'yes');
        if($count > 0){
            echo "<span class='label label-warning pull-right'>".$count."</span>";            
        }  
        
    }
    
    function new_message_member(){
        $count = $this->mailbox_model->count_where_multiple('sent_member_id',$this->session->userdata('members_id'), 'mail_read', 'no', 'inbox', 'yes', 'sent_from', 'member');        
        if($count > 0){
            echo "<span class='label label-warning pull-right'>".$count."</span>";           
        }
    }
    function new_message_market(){
        $count = $this->mailbox_model->count_where_multiple('sent_member_id',$this->session->userdata('members_id'), 'mail_read', 'no', 'inbox', 'yes', 'sent_from', 'market');        
        if($count > 0){
            echo '<span class="label label-warning pull-right">'.$count.'</span>';           
        }
    }
    function new_message_support(){
        $count = $this->mailbox_model->count_where_multiple('sent_member_id',$this->session->userdata('members_id'), 'mail_read', 'no', 'inbox', 'yes', 'sent_from', 'support');        
        if($count > 0){
            echo '<span class="label label-warning pull-right">'.$count.'</span>';           
        }
    }
    
    function results($result)
    {
        $data['results'] = $result;
        $data['main'] = 'mailbox';        
        $data['title'] = 'GSM - Email Search Results';        
        $data['page'] = 'results';
        
        $this->load->module('templates');
        $this->templates->page($data);
    }
            
    function refresh()
    {
         redirect($_SERVER['HTTP_REFERER'], 'refresh');  
    }
    
    function ajaxRefresh()
    {
        //echo 'TEST!';
        $this->load->view('inbox-ajax');
    }
	
}