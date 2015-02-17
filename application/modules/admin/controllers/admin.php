<?php
class Admin extends MX_Controller 
{
    function __construct()
    {
        parent::__construct();
    }

    function index()
    {
        $data['main'] = 'admin';        
        $data['title'] = 'GSM - Admin Panel';        
        $data['page'] = 'dashboard';
        
//        $var = 'member';
//        $var_model = $var.'_model';
//        
//        $this->load->model(''.$var.'/'.$var.'_model', ''.$var.'_model');
//        $data['test'] = $this->{$var_model}->get_all();

        $this->load->module('templates');
        $this->templates->admin($data);
	
    }
    
    function view_dashboard()
    {
        $this->load->view('dashboard');
	
    }
    
    function add_company()
    {
        $data['page'] = 'add-company';

        $this->load->module('templates');
        $this->templates->admin($data);
	
    }
    
    function view_add_company()
    {
        $this->load->view('add-company');
	
    }
    
    function bulk_import()
    {
        $data['page'] = 'bulk-import';

        $this->load->module('templates');
        $this->templates->admin($data);
	
    }
    
    function view_bulk_import()
    {
        $this->load->view('bulk-import');
	
    }
    
    function export()
    {
        $data['page'] = 'export';

        $this->load->module('templates');
        $this->templates->admin($data);
	
    }
    
    function view_export()
    {
        $this->load->view('export');
	
    }
    
    function feed($id = NULL)
    {
        $data['main'] = 'admin';        
        $data['title'] = 'GSM - Admin Panel: Feed';        
        $data['page'] = 'feed';
        
        
        
        $var = 'feed';
        $var_model = $var.'_model';
        
        $this->load->model(''.$var.'/'.$var.'_model', ''.$var.'_model');
        if(isset($id)){
            $data[$var] = $this->{$var_model}->get_where($id);
        }else{
            $count = $this->{$var_model}->count_where('approved', 'awaiting_approval');
            if($count > 0){
                $data[$var.'_count'] = $count;
                $data[$var] = $this->{$var_model}->get_where_multiples_order('datetime', 'DESC', 'approved', 'awaiting_approval');
            }
            else{
                $data[$var.'_count'] = 0;
            }
        }

        $this->load->module('templates');
        $this->templates->admin($data);
    }
    
    function feedApprove($id)
    {
        $var = 'feed';
        $var_model = $var.'_model';
        
        $this->load->model(''.$var.'/'.$var.'_model', ''.$var.'_model');
        $mem = $this->{$var_model}->get_where($id)->member_id;
        //echo $mem;
        //exit;
        $data = array(
                    'approved'      => 'yes',
                    'approved_date' => date('Y-m-d H:i:s')
                  );

        $this->{$var_model}->_update($id, $data);
        
        $var1 = 'mailbox';
        $var1_model = $var1.'_model';
        
        $this->load->model(''.$var1.'/'.$var1.'_model', ''.$var1.'_model');
        
         $data = array(
                                    'member_id'         => 5,
                                    'sent_member_id'    => $mem,
                                    'subject'           => 'Feed Approved',
                                    'body'              => 'Your feed has been approved',
                                    'inbox'             => 'yes',
                                    'sent'              => 'yes',
                                    'date'              => date('d-m-Y'),
                                    'time'              => date('H:i'),
                                    'sent_from'         => 'support',
                                    'datetime'          => date('Y-m-d H:i:s')
                                  ); 

        $this->{$var1_model}->_insert($data);
        
        redirect('admin/feed/');
    }
    
    function feedDecline($id)
    {
        $var = 'feed';
        $var_model = $var.'_model';
        
        $this->load->model(''.$var.'/'.$var.'_model', ''.$var.'_model');
        
        $data = array(
                    'approved'      => 'no',
                    'approved_date' => date('Y-m-d H:i:s')
                  );

        $this->{$var_model}->_update($id, $data);
        
        redirect('admin/feed/');
    }
	
}