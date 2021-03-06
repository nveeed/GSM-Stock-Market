<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Admin extends MX_Controller 
{
    function __construct()
    {
        parent::__construct(); 
        
        //$CI =& get_instance();
        $this->load->model('admin_model'); 
        
       
    }
    function index()
    { 
        if ( ! $this->session->userdata('admin_logged_in'))
        { 
            redirect('admin/login');
        }
        else{
            redirect('admin/dashboard');
        }
        
    
    }
    
    function seo_friendly($name)
    {

        $name = str_replace(" ", "-", $name);
        $name = str_replace("_", "-", $name);
        $name = strtolower($name);

        return $name;

    }
    
    function dashboard()
    { 
        
        if ( ! $this->session->userdata('admin_logged_in'))
        { 
            redirect('admin/login');
        }
        
        
        $data['main'] = 'admin';        
        $data['title'] = 'GSM - Admin Panel';        
        $data['page'] = 'dashboard';
        $this->load->module('templates');
        $this->templates->admin($data);

    }
    
    function login()
    {
        $data['main'] = 'admin';
        $data['title'] = 'Admin - Please Login';        
        $data['page'] = 'login';
        $this->load->module('templates');
        $this->templates->admin($data);
    }
    
    function view_dashboard()
    {
        if ( ! $this->session->userdata('admin_logged_in'))
        { 
            redirect('admin/login');
        }
        $this->load->view('dashboard');
	
    }
    
    function add_company()
    {
        if ( ! $this->session->userdata('admin_logged_in'))
        { 
            redirect('admin/login');
        }
        $data['page'] = 'add-company';
        $this->load->module('templates');
        $this->templates->admin($data);
	
    }
    
    function view_add_company()
    {
        if ( ! $this->session->userdata('admin_logged_in'))
        { 
            redirect('admin/login');
        }
        $this->load->view('add-company');
	
    }
    
    function bulk_import()
    {
        if ( ! $this->session->userdata('admin_logged_in'))
        { 
            redirect('admin/login');
        }
        $data['page'] = 'bulk-import';
        $this->load->module('templates');
        $this->templates->admin($data);
	
    }
    
    function view_bulk_import()
    {
        if ( ! $this->session->userdata('admin_logged_in'))
        { 
            redirect('admin/login');
        }
        $this->load->view('bulk-import');
	
    }
    
    function export()
    {
        if ( ! $this->session->userdata('admin_logged_in'))
        { 
            redirect('admin/login');
        }
        $data['page'] = 'export';
        $this->load->module('templates');
        $this->templates->admin($data);
	
    }
    
    function view_export()
    {
        if ( ! $this->session->userdata('admin_logged_in'))
        { 
            redirect('admin/login');
        }
        $this->load->view('export');
	
    }
    
    function company_bio($id = NULL)
    {
        if ( ! $this->session->userdata('admin_logged_in'))
        { 
            redirect('admin/login');
        }
        $data['main'] = 'admin';        
        $data['title'] = 'GSM - Admin Panel: Company Bio';        
        $data['page'] = 'company-bio';
        
        $var = 'company';
        $var_model = $var.'_model';
        
        $this->load->model(''.$var.'/'.$var.'_model', ''.$var.'_model');
        if(isset($id)){
            $data[$var] = $this->{$var_model}->get_where($id);
        }else{
            $count = $this->{$var_model}->_custom_query_count('SELECT COUNT(*) AS count FROM company WHERE company_profile_approval != ""');
            if($count[0]->count > 0){
                $data[$var.'_count'] = $count[0]->count;
                $data[$var] = $this->{$var_model}->_custom_query('SELECT * FROM company WHERE company_profile_approval != "" ORDER BY id DESC');
            }
            else{
                $data[$var.'_count'] = 0;
            }
        }
        $this->load->module('templates');
        $this->templates->admin($data);
    }
    
    function edit_bio($id)
    {
        $data['main'] = 'admin';        
        $data['title'] = 'GSM - Admin Panel: Edit Feed';        
        $data['page'] = 'edit-bio';
        
        $var = 'company';
        $var_model = $var.'_model';
        
        $this->load->model(''.$var.'/'.$var.'_model', ''.$var.'_model');
        $data[$var] = $this->{$var_model}->get_where($id);
        
        $this->load->module('templates');
        $this->templates->admin($data);
    }
    
    function bioUpdate($id)
    {
        $var = 'company';
        $var_model = $var.'_model';
        
        $this->load->model(''.$var.'/'.$var.'_model', ''.$var.'_model');
        $mem = $this->{$var_model}->get_where($id)->admin_member_id;
        //echo $mem;
        //exit;
        $data = array(
                    'company_profile_approval'      => '',
                    'company_profile'               => nl2br($this->input->post('content'))
                  );
        $this->{$var_model}->_update($id, $data);
        
        $var1 = 'mailbox';
        $var1_model = $var1.'_model';
        
        $this->load->model(''.$var1.'/'.$var1.'_model', ''.$var1.'_model');
        
         $data = array(
                                    'member_id'         => 5,
                                    'sent_member_id'    => $mem,
                                    'subject'           => 'Company Bio Approved',
                                    'body'              => 'Your company bio has been approved',
                                    'inbox'             => 'yes',
                                    'sent'              => 'yes',
                                    'date'              => date('d-m-Y'),
                                    'time'              => date('H:i'),
                                    'sent_from'         => 'support',
                                    'datetime'          => date('Y-m-d H:i:s')
                                  ); 
        $this->{$var1_model}->_insert($data);
        
        redirect('admin/company_bio/');
    }

    function bioApprove($id)
    {
        $var = 'company';
        $var_model = $var.'_model';
        
        $this->load->model(''.$var.'/'.$var.'_model', ''.$var.'_model');
        $mem = $this->{$var_model}->get_where($id)->admin_member_id;
        $profile = $this->{$var_model}->get_where($id)->company_profile_approval;
        
        $data = array(
                    'company_profile_approval'      => '',
                    'company_profile'               => nl2br($profile)
                  );
        $this->{$var_model}->_update($id, $data);
        
        $var1 = 'mailbox';
        $var1_model = $var1.'_model';
        
        $this->load->model(''.$var1.'/'.$var1.'_model', ''.$var1.'_model');
        
         $data = array(
                                    'member_id'         => 5,
                                    'sent_member_id'    => $mem,
                                    'subject'           => 'Company Bio Approved',
                                    'body'              => 'Your company bio has been approved',
                                    'inbox'             => 'yes',
                                    'sent'              => 'yes',
                                    'date'              => date('d-m-Y'),
                                    'time'              => date('H:i'),
                                    'sent_from'         => 'support',
                                    'datetime'          => date('Y-m-d H:i:s')
                                  ); 
        $this->{$var1_model}->_insert($data);
        
        $this->load->model('notification/notification_model', 'notification_model');
        $this->load->model('member/member_model', 'member_model');
        
        $memcount = $this->notification_model->_custom_query_count("SELECT COUNT(*) AS count FROM notification WHERE member_id = '".$mem."'");
        
        if($memcount[0]->count > 0){
            
            $email_support = $this->notification_model->get_where_multiple('member_id', $mem)->email_support;
                      
            if($email_support == 'yes'){

                  $this->load->module('emails');
                  $config = Array(
                                  'protocol' => 'smtp',
                                  'smtp_host' => 'ssl://server.gsmstockmarket.com',
                                  'smtp_port' => 465,
                                  'smtp_user' => 'noreply@gsmstockmarket.com',
                                  'smtp_pass' => 'ehT56.l}iW]I2ba3f0',
                                  'charset' => 'utf-8',
                                  'wordwrap' => TRUE,
                                  'newline' => "\r\n",
                                  'crlf'    => ""

                              );

                  $this->load->library('email', $config);
                  $this->email->set_mailtype("html");
                  $email_body = 'You have a message from the support team';


                  $this->email->from('noreply@gsmstockmarket.com', 'GSM Stockmarket Support');

                  //$list = array('tim@gsmstockmarket.com', 'info@gsmstockmarket.com');
                  $this->email->to($this->member_model->get_where($mem)->email);
                  $this->email->subject('You have a message in your inbox');
                  $this->email->message($email_body);

                  $this->email->send();                          
            }
            
        }
        
        $this->load->module('profile');
        $this->profile->profile_completion($id);
        
        redirect('admin/company_bio/');
        
    }

    function bioDecline($id)
    {
        $var = 'company';
        $var_model = $var.'_model';
        
        $this->load->model(''.$var.'/'.$var.'_model', ''.$var.'_model');
        $mem = $this->{$var_model}->get_where($id)->admin_member_id;
        
        $data = array(
                    'company_profile_approval'      => '',
                    'company_profile'               => ''
                  );
        $this->{$var_model}->_update($id, $data);
        
        $var1 = 'mailbox';
        $var1_model = $var1.'_model';
        
        $this->load->model(''.$var1.'/'.$var1.'_model', ''.$var1.'_model');
        
         $data = array(
                                    'member_id'         => 5,
                                    'sent_member_id'    => $mem,
                                    'subject'           => 'Company Bio Declined',
                                    'body'              => 'Your company bio has been declined. Please update your information.',
                                    'inbox'             => 'yes',
                                    'sent'              => 'yes',
                                    'date'              => date('d-m-Y'),
                                    'time'              => date('H:i'),
                                    'sent_from'         => 'support',
                                    'datetime'          => date('Y-m-d H:i:s')
                                  ); 
        $this->{$var1_model}->_insert($data);
        
        redirect('admin/company_bio/');
    }
    
    function feed($id = NULL)
    {
        if ( ! $this->session->userdata('admin_logged_in'))
        { 
            redirect('admin/login');
        }
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
    
    function edit_feed($id)
    {
        $data['main'] = 'admin';        
        $data['title'] = 'GSM - Admin Panel: Edit Feed';        
        $data['page'] = 'edit-feed';
        
        $var = 'feed';
        $var_model = $var.'_model';
        
        $this->load->model(''.$var.'/'.$var.'_model', ''.$var.'_model');
        $data[$var] = $this->{$var_model}->get_where($id);
        
        $this->load->module('templates');
        $this->templates->admin($data);
    }
    
    function feedApprove($id)
    {
        if ( ! $this->session->userdata('admin_logged_in'))
        { 
            redirect('admin/login');
        }
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
    
    function feedUpdate($id)
    {
        $var = 'feed';
        $var_model = $var.'_model';
        
        $this->load->model(''.$var.'/'.$var.'_model', ''.$var.'_model');
        $mem = $this->{$var_model}->get_where($id)->member_id;
        //echo $mem;
        //exit;
        $data = array(
                    'approved'      => 'yes',
                    'content'       => nl2br($this->input->post('content')),
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
        if ( ! $this->session->userdata('admin_logged_in'))
        { 
            redirect('admin/login');
        }
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
    
    function feedback($id = NULL)
    {
        if ( ! $this->session->userdata('admin_logged_in'))
        { 
            redirect('admin/login');
        }
        $data['main'] = 'admin';        
        $data['title'] = 'GSM - Admin Panel: Feedback';        
        $data['page'] = 'feedback';
        
        $var = 'feedback';
        $var_model = $var.'_model';
        
        $this->load->model(''.$var.'/'.$var.'_model', ''.$var.'_model');
        if(isset($id)){
            $data[$var] = $this->{$var_model}->get_where($id);
        }else{
            $count = $this->{$var_model}->count_where('authorised', 'no');
            if($count > 0){
                $data[$var.'_count'] = $count;
                $data[$var] = $this->{$var_model}->get_where_multiples_order('datetime', 'DESC', 'authorised', 'no');
            }
            else{
                $data[$var.'_count'] = 0;
            }
        }
        $this->load->module('templates');
        $this->templates->admin($data);
    }
    
    function edit_feedback($id)
    {
        $data['main'] = 'admin';        
        $data['title'] = 'GSM - Admin Panel: Feedback';        
        $data['page'] = 'edit-feedback';
        
        $var = 'feedback';
        $var_model = $var.'_model';
        
        $this->load->model(''.$var.'/'.$var.'_model', ''.$var.'_model');
        $data[$var] = $this->{$var_model}->get_where($id);
        
        $this->load->module('templates');
        $this->templates->admin($data);
    }
    
    function feedbackApprove($id)
    {
        if ( ! $this->session->userdata('admin_logged_in'))
        { 
            redirect('admin/login');
        }
        $var = 'feedback';
        $var_model = $var.'_model';
        
        $this->load->model(''.$var.'/'.$var.'_model', ''.$var.'_model');
        $mem = $this->{$var_model}->get_where($id)->member_id;
        $fem = $this->{$var_model}->get_where($id)->feedback_member_id;
        //echo $mem;
        //exit;
        $data = array(
                    'authorised'      => 'yes',
                    //'approved_date' => date('Y-m-d H:i:s')
                  );
        $this->{$var_model}->_update($id, $data);
        
        $var1 = 'mailbox';
        $var1_model = $var1.'_model';
        
        $this->load->model(''.$var1.'/'.$var1.'_model', ''.$var1.'_model');
        
         $data = array(
                                    'member_id'         => 5,
                                    'sent_member_id'    => $mem,
                                    'subject'           => 'Feedback Approved',
                                    'member_name'       => 'GSM Support',
                                    'body'              => 'Your feedback has been approved',
                                    'inbox'             => 'yes',
                                    'sent'              => 'yes',
                                    'sent_belong'       => 5,
                                    'date'              => date('d-m-Y'),
                                    'time'              => date('H:i'),
                                    'sent_from'         => 'support',
                                    'datetime'          => date('Y-m-d H:i:s')
                                  ); 
        $this->{$var1_model}->_insert($data);
        
        $data = array(
                                    'member_id'         => 5,
                                    'sent_member_id'    => $fem,
                                    'subject'           => 'Feedback Received',
                                    'body'              => 'You have received a new feedback',
                                    'member_name'       => 'GSM Support',
                                    'inbox'             => 'yes',
                                    'sent'              => 'yes',
                                    'sent_belong'       => 5,
                                    'date'              => date('d-m-Y'),
                                    'time'              => date('H:i'),
                                    'sent_from'         => 'support',
                                    'datetime'          => date('Y-m-d H:i:s')
                                  ); 
        $this->{$var1_model}->_insert($data);
        
        redirect('admin/feedback/');
    }
    
    function feedbackUpdate($id)
    {
        $var = 'feedback';
        $var_model = $var.'_model';
        
        $this->load->model(''.$var.'/'.$var.'_model', ''.$var.'_model');
        $mem = $this->{$var_model}->get_where($id)->member_id;
        //echo $mem;
        //exit;
        $data = array(
                    'authorised'      => 'yes',
                    'comments'       => nl2br($this->input->post('content')),
                    //'approved_date' => date('Y-m-d H:i:s')
                  );
        $this->{$var_model}->_update($id, $data);
        
        $var1 = 'mailbox';
        $var1_model = $var1.'_model';
        
        $this->load->model(''.$var1.'/'.$var1.'_model', ''.$var1.'_model');
        
         $data = array(
                                    'member_id'         => 5,
                                    'sent_member_id'    => $mem,
                                    'subject'           => 'Feedback Approved',
                                    'body'              => 'Your feedback has been approved',
                                    'inbox'             => 'yes',
                                    'sent'              => 'yes',
                                    'date'              => date('d-m-Y'),
                                    'time'              => date('H:i'),
                                    'sent_from'         => 'support',
                                    'datetime'          => date('Y-m-d H:i:s')
                                  ); 
        $this->{$var1_model}->_insert($data);
        
        redirect('admin/feedback/');
    }
    
    function feedbackDecline($id)
    {
        if ( ! $this->session->userdata('admin_logged_in'))
        { 
            redirect('admin/login');
        }
        $var = 'feedback';
        $var_model = $var.'_model';
        
        $this->load->model(''.$var.'/'.$var.'_model', ''.$var.'_model');
        
        $data = array(
                    'authorised'      => 'declined',
                    //'approved_date' => date('Y-m-d H:i:s')
                  );
        $this->{$var_model}->_update($id, $data);
        
        redirect('admin/feedback/');
    }
            
    function user_level()
    {
        if ( ! $this->session->userdata('admin_logged_in'))
        { 
            redirect('admin/login');
        }
        
        $data['main'] = 'admin';        
        $data['title'] = 'GSM - Admin Panel: User Level';        
        $data['page'] = 'user-level';
        
        
        
        $var = 'membership';
        $var_model = $var.'_model';
        
        $this->load->model(''.$var.'/'.$var.'_model', ''.$var.'_model');
        
        $data[$var] = $this->{$var_model}->get_where_multiples_order('id', 'DESC', 'id >', 0);
           
        $this->load->module('templates');
        $this->templates->admin($data);
    }
    
    function updateUserLevel($mid, $var, $status)
    {
        $mid      = str_replace("'", "", $mid);
        $var      = str_replace("'", "", $var);
        $status   = str_replace("'", "", $status);
        
        $data = array(
                        $var     => $status
                      );
        $this->load->model('membership/membership_model', 'membership_model');
        $this->membership_model->_update_where($data, 'id', $mid);
    }

    function check_authentication(){
        if ( ! $this->session->userdata('admin_logged_in'))
        { 
            redirect('admin/login');
        }
    }
/*add listing attributes*/
  function add_listing_attribute()
    {
        $this->check_authentication();//check login authentication
        $this->form_validation->set_rules('product_mpn', 'product mpn', '');
        //$this->form_validation->set_rules('product_isbn', 'product isbn', '');
        $this->form_validation->set_rules('product_make', 'product make', 'required');
        $this->form_validation->set_rules('product_model', 'product model', 'required');
        $this->form_validation->set_rules('product_type', 'product type', '');
        $this->form_validation->set_rules('product_color', 'product color', '');
        $this->form_validation->set_rules('product_capacity', 'product capacity', '');
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
        if ($this->form_validation->run() == TRUE){
            $product_capacity='';
            $product_color='';
            if(!empty($this->input->post('product_color'))){
                $colors = explode(',',$this->input->post('product_color'));
                $product_color = json_encode($colors);
            }
            if(!empty($this->input->post('product_capacity'))){
                $capacity=explode(',',$this->input->post('product_capacity'));
                $product_capacity = json_encode($capacity);
            }
            $data_insert=array(
            'product_mpn_isbn' =>  $this->input->post('product_mpn'),
            //'product_isbn' =>  $this->input->post('product_isbn'),
            'product_make' =>  $this->input->post('product_make'),
            'product_model' =>  $this->input->post('product_model'),
            'product_type' =>  $this->input->post('product_type'),
            'product_color' => $product_color ,
            'product_capacity' => $product_capacity,
            'created' => date('Y-m-d h:i:s A'), 
            );
           $this->admin_model->insert('listing_attributes',$data_insert);
           $this->session->set_flashdata('msg_success','List Attribute added successfully.');
           redirect('admin/listing_attributes');
        }
         $items =  $this->admin_model->get_result('listing_categories','','',array('category_name','ASC'));

        if( $items){
            $tree = $this->buildTree($items);
            $data['product_types']=$this->buildTree($items);
        }else{
           $data['product_types']=FALSE;
        }
        $data['makers']  =  $this->admin_model->get_result('product_make');
        $data['models']  =  $this->admin_model->get_result('product_model');
        $data['colors']  =  $this->admin_model->get_result('product_color');

        $data['main'] = 'admin';        
        $data['title'] = 'GSM - Admin Panel: Listing Attribute Level';  
        $data['page'] = 'add_listing_attribute';
        $this->load->module('templates');
        $this->templates->admin($data);
    }

    private function buildTree($items) {

        $childs = array();

        foreach($items as $item)
            $childs[$item->parent_id][] = $item;

        foreach($items as $item) if (isset($childs[$item->id]))
            $item->childs = $childs[$item->id];

        return $childs[0];
    }


    function listing()
    {
        $this->check_authentication();//check login authentication

        $data['listing'] =  $this->admin_model->get_result('listing', array('status'=>0));
        $data['main'] = 'admin';        
        $data['title'] = 'GSM - Admin Panel: Listing';  
        $data['page'] = 'listing';
        $this->load->module('templates');
        $this->templates->admin($data);
    }

   function listing_status($id='',$status='',$offset=''){
        $user_status = '';
        $msg_success = '';
        $listing  = $this->admin_model->get_row('listing', array('id'=>$id));
        if(empty($listing->member_id)) redirect('admin/listing');
            
        $member = $this->admin_model->get_row('members', array('id'=>$listing->member_id));
        $member_email = $member->email; //fatch member email for decline information

        if($status=='1'){

            $this->admin_model->update('listing',array('status'=>1),array('id'=>$id));
            $user_status = "Approve";
            $msg_success = "Listing Status Approve successfully.";

        }else if($status=='3'){
            $this->admin_model->delete('listing',array('id'=>$id));
            $user_status = "Decline";
            $msg_success = "Listing Status Decline successfully.";

        }

        //send email for decline listing request.

        $this->load->library('email');

        $config['protocol'] = 'sendmail';
        $config['mailpath'] = '/usr/sbin/sendmail';
        $config['charset'] = 'iso-8859-1';
        $config['wordwrap'] = TRUE;

        $this->email->initialize($config);

        $this->email->from('info@gsmstock.com', 'Admin');
        $this->email->to($member_email);
        $this->email->subject('Decline listing request');
        $html = "hello user,";
        $html .= "your listing request has been declined.";
        $this->email->message($html);

        $this->email->send();

        $this->session->set_flashdata('msg_success',$msg_success);
        redirect('admin/listing');
    }

    function listing_attributes()
    {
        $this->check_authentication();//check login authentication


        $data['listing_attributes'] =  $this->admin_model->get_result('listing_attributes');
        $data['main'] = 'admin';        
        $data['title'] = 'GSM - Admin Panel: Listing Attribute Level';  
        $data['page'] = 'listing_attributes';
        $this->load->module('templates');
        $this->templates->admin($data);
    }
    function edit_listing_attribute($list_id='')
    {
        $this->check_authentication();//check login authentication
        

        $this->form_validation->set_rules('product_mpn', 'product mpn', '');
       // $this->form_validation->set_rules('product_isbn', 'product isbn', '');
        $this->form_validation->set_rules('product_make', 'product_make', 'required');
        $this->form_validation->set_rules('product_model', 'product_model', 'required');
        $this->form_validation->set_rules('product_type', 'product_type', '');
        $this->form_validation->set_rules('product_color', 'product_color', '');
         $this->form_validation->set_rules('product_capacity', 'product capacity', '');
       
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
        if ($this->form_validation->run() == TRUE){
            $product_capacity='';
            $product_color='';
            if(!empty($this->input->post('product_color'))){
                $colors = explode(',',$this->input->post('product_color'));
                $product_color = json_encode($colors);
            }
            if(!empty($this->input->post('product_capacity'))){
                $capacity=explode(',',$this->input->post('product_capacity'));
                $product_capacity = json_encode($capacity);
            }
            $data_update=array(
            'product_mpn_isbn' =>  $this->input->post('product_mpn'),
            //'product_isbn' =>  $this->input->post('product_isbn'),
            'product_make' =>  $this->input->post('product_make'),
            'product_model' =>  $this->input->post('product_model'),
            'product_type' =>  $this->input->post('product_type'),
            'product_color' =>  $this->input->post('product_color'),
            'product_color' => $product_color ,
            'product_capacity' => $product_capacity,
            'updated' => date('Y-m-d h:i:s A'), 
            );
           $this->admin_model->update('listing_attributes',$data_update,array('id'=>$list_id));
           $this->session->set_flashdata('msg_success','Design updated successfully.');
           redirect('admin/listing_attributes');
        } 
       
        $data['listing_attributes'] =  $this->admin_model->get_row('listing_attributes',array('id'=>$list_id));
        $items =  $this->admin_model->get_result('listing_categories','','',array('category_name','ASC'));
        if( $items){
            $tree = $this->buildTree($items);
            $data['product_types']=$this->buildTree($items);
        }else{
           $data['product_types']=FALSE;
        }
        $data['main'] = 'admin';        
        $data['title'] = 'GSM - Admin Panel: Listing Attribute Level';  
        $data['page'] = 'edit_listing_attribute';
        $this->load->module('templates');
        $this->templates->admin($data);
    }

     function delete_listing_attribute($list_id='')
    {
        $this->check_authentication();//check login authentication
        if(empty($list_id)){ redirect('admin/listing_attributes'); } 

        if($this->admin_model->delete('listing_attributes',array('id'=>$list_id))){
            $this->session->set_flashdata('msg_success','Listing Attribute deleted successfully.');
           redirect('admin/listing_attributes'); 
        }
    }

    public function couriers(){
        $this->check_authentication();//check login authentication

        $data['couriers'] =  $this->admin_model->get_result('couriers');
        $data['main'] = 'admin';
        $data['title'] = 'GSM - Admin Panel: couriers';
        $data['page'] = 'couriers';
        $this->load->module('templates');
        $this->templates->admin($data);
    }

    public function courier_add(){
        $this->check_authentication();//check login authentication

       $this->form_validation->set_rules('courier_name', 'courier name', 'required');
        if ($this->form_validation->run() == TRUE) {
            $post_data=array(
                'courier_name'=>$this->input->post('courier_name'),
                //'description'=>$this->input->post('description'),
                );
           if($this->admin_model->insert('couriers',$post_data)){
            $this->session->set_flashdata('msg_success','courier added successfully.');
            redirect('admin/couriers');
           }
        }

        $data['main'] = 'admin';
        $data['title'] = 'GSM - Admin Panel: courier Add New';
        $data['page'] = 'courier_add';
        $this->load->module('templates');
        $this->templates->admin($data);
    }

    public function courier_edit($id=0){
         if(empty($id)){ redirect('admin/couriers'); }

        $data['couriers']= $this->admin_model->get_row('couriers',array('id'=>$id));
        if( $data['couriers']==FALSE)  redirect('admin/couriers');

        $this->form_validation->set_rules('courier_name', 'courier name', 'required');
        if ($this->form_validation->run() == TRUE) {
            $post_data=array(
                'courier_name'=>$this->input->post('courier_name'),
                //'description'=>$this->input->post('description'),
                );
           if($this->admin_model->update('couriers',$post_data,array('id'=>$id))){
            $this->session->set_flashdata('msg_success','courier updated successfully.');
            redirect('admin/couriers');
           }
        }

        $data['main'] = 'admin';
        $data['title'] = 'GSM - Admin Panel: courier Edit';
        $data['page'] = 'courier_edit';
        $this->load->module('templates');
        $this->templates->admin($data);
    }

    public function courier_delete($id=0){
          $this->check_authentication();//check login authentication
        if(empty($id)){ redirect('admin/couriers'); }

        if($this->admin_model->delete('couriers',array('id'=>$id))){
            $this->session->set_flashdata('msg_success','courier deleted successfully.');
           redirect('admin/couriers');
        }
    }

    // shipping
    public function shippings(){
        $this->check_authentication();//check login authentication

        $data['shippings'] =  $this->admin_model->get_result('shippings');
        $data['main'] = 'admin';
        $data['title'] = 'GSM - Admin Panel: shippings';
        $data['page'] = 'shippings';
        $this->load->module('templates');
        $this->templates->admin($data);
    }

    public function shipping_add(){
        $this->check_authentication();//check login authentication

       $this->form_validation->set_rules('shipping_name', 'shipping name', 'required');
       $this->form_validation->set_rules('couriers[]', 'Couriers', 'required');

        if ($this->form_validation->run() == TRUE) {
            $post_data=array(
                'shipping_name' =>$this->input->post('shipping_name'),
                'description'   =>$this->input->post('description'),
                'couriers'      =>json_encode($this->input->post('couriers')),
                );
           if($this->admin_model->insert('shippings',$post_data)){
            $this->session->set_flashdata('msg_success','shipping added successfully.');
            redirect('admin/shippings');
           }
        }

        $data['couriers'] = $this->admin_model->get_result('couriers');

        $data['main'] = 'admin';
        $data['title'] = 'GSM - Admin Panel: shipping Add New';
        $data['page'] = 'shipping_add';
        $this->load->module('templates');
        $this->templates->admin($data);
    }

    public function shipping_edit($id=0){
         if(empty($id)){ redirect('admin/shippings'); }

        $data['shippings']= $this->admin_model->get_row('shippings',array('id'=>$id));
        if( $data['shippings']==FALSE)  redirect('admin/shippings');

        $this->form_validation->set_rules('shipping_name', 'shipping name', 'required');
        $this->form_validation->set_rules('couriers[]', 'Couriers', 'required');
        if ($this->form_validation->run() == TRUE) {
            $post_data=array(
                'shipping_name'=>$this->input->post('shipping_name'),
                'description'=>$this->input->post('description'),
                'couriers'      =>json_encode($this->input->post('couriers')),
                );
           if($this->admin_model->update('shippings',$post_data,array('id'=>$id))){
            $this->session->set_flashdata('msg_success','shipping updated successfully.');
            redirect('admin/shippings');
           }
        }

        $data['couriers'] = $this->admin_model->get_result('couriers');

        $data['main'] = 'admin';
        $data['title'] = 'GSM - Admin Panel: shipping Edit';
        $data['page'] = 'shipping_edit';
        $this->load->module('templates');
        $this->templates->admin($data);
    }

    public function shipping_delete($id=0){
          $this->check_authentication();//check login authentication
        if(empty($id)){ redirect('admin/shippings'); }

        if($this->admin_model->delete('shippings',array('id'=>$id))){
            $this->session->set_flashdata('msg_success','shipping deleted successfully.');
           redirect('admin/shippings');
        }
    }

    // listing categories
     public function product_types($offset=0){
        $this->check_authentication();//check login authentication

        $per_page=20;
        $data['product_types'] = $this->admin_model->product_types($offset,$per_page);
        $config=backend_pagination();
        $config['base_url'] = base_url().'admin/product_types/';
        $config['total_rows'] = $this->admin_model->product_types(0,0);
        $config['per_page'] = $per_page;
        $config['uri_segment'] = 3;
        if(!empty($_SERVER['QUERY_STRING'])){
        $config['suffix'] = "?".$_SERVER['QUERY_STRING'];
        }else{
        $config['suffix'] ='';
        }
        $config['first_url'] = $config['base_url'].$config['suffix'];
        $this->pagination->initialize($config);
        $data['pagination']=$this->pagination->create_links();
        $data['offset'] = $offset;


        $data['main'] = 'admin';
        $data['title'] = 'GSM - Admin Panel: product types';
        $data['page'] = 'product_types';
        $this->load->module('templates');
        $this->templates->admin($data);
    }

    public function product_type_add(){
       $this->check_authentication();//check login authentication

       $this->form_validation->set_rules('category_name', 'Category name', 'required');
       $this->form_validation->set_rules('parent_id', 'Parent Category name', 'required');

        if ($this->form_validation->run() == TRUE) {
            $post_data=array(
                'parent_id'     => $this->input->post('parent_id'),
                'category_name' => $this->input->post('category_name')
                );
           if($this->admin_model->insert('listing_categories',$post_data)){
            $this->session->set_flashdata('msg_success','Category name added successfully.');
            redirect('admin/product_types');
           }
        }

        $data['product_parent_categories'] = $this->admin_model->get_result('listing_categories',array('parent_id'=>0));

        $data['main'] = 'admin';
        $data['title'] = 'GSM - Admin Panel: Product Type Add New';

        $data['page'] = 'product_type_add';
        $this->load->module('templates');
        $this->templates->admin($data);
    }

    public function product_type_edit($id=0){
         if(empty($id)){ redirect('admin/product_types'); }

        $data['product_types']= $this->admin_model->get_row('listing_categories',array('id'=>$id));
        if( $data['product_types']==FALSE)  redirect('admin/product_types');

        $this->form_validation->set_rules('category_name', 'Category name', 'required');
        $this->form_validation->set_rules('parent_id', 'Parent Category name', 'required');

        if ($this->form_validation->run() == TRUE) {
             $post_data=array(
                'parent_id'     => $this->input->post('parent_id'),
                'category_name' => $this->input->post('category_name')
                );
           if($this->admin_model->update('listing_categories',$post_data,array('id'=>$id))){
            $this->session->set_flashdata('msg_success','Product type updated successfully.');
            redirect('admin/product_types');
           }
        }

        $data['product_parent_categories'] = $this->admin_model->get_result('listing_categories',array('parent_id'=>0));

        $data['main'] = 'admin';
        $data['title'] = 'GSM - Admin Panel: listing category Edit';
        $data['page'] = 'product_type_edit';
        $this->load->module('templates');
        $this->templates->admin($data);
    }

    public function product_type_delete($id=0){
          $this->check_authentication();//check login authentication
        if(empty($id)){ redirect('admin/product_types'); }

        if($this->admin_model->delete('listing_categories',array('id'=>$id))){
            $this->session->set_flashdata('msg_success','Product Type deleted successfully.');
           redirect('admin/product_types');
        }
    }

     function product_make($maker_id=0)
    {
        $this->check_authentication();//check login authentication
        if($this->input->post('product')==1){
            $this->form_validation->set_rules('product_make', 'Product maker name', 'required');
                if ($this->form_validation->run() == TRUE) {
                    $post_data=array(
                        'product_make' => $this->input->post('product_make'),
                        'created' => date('Y-m-d')
                        );
               
                   if($this->admin_model->insert('product_make',$post_data)){
                    $this->session->set_flashdata('msg_success','Product Maker name added successfully.');
                    redirect('admin/product_make');
                   }
                } 
        }else{
    //update
            $id='';
            if(!empty($_POST['make_submit'])){
                $id = $_POST['make_submit'];
           
             
            $post_data=array(
                    'product_make' => $_POST['product_make_'.$id],
                    'created' => date('Y-m-d')
                    );
            if($this->admin_model->update('product_make',$post_data,array('id'=>$id))){
            $this->session->set_flashdata('msg_success','Product Maker updated successfully.');
            redirect('admin/product_make');
            }
           }
            
        }
    //delete
        if(!empty($maker_id)){
           if($this->admin_model->delete('product_make',array('id'=>$maker_id))){
                $this->session->set_flashdata('msg_success','Product Maker delete successfully.');
                redirect('admin/product_make');
                }  
        }

        $data['product_makers'] =  $this->admin_model->get_result('product_make');
        $data['main'] = 'admin';        
        $data['title'] = 'GSM - Admin Panel: Product Make';  
        $data['page'] = 'product_make';
        $this->load->module('templates');
        $this->templates->admin($data);
    }


     function product_model($model_id=0)
    {
        $this->check_authentication();//check login authentication
        if($this->input->post('product')==1){
            $this->form_validation->set_rules('product_model', 'Product model name', 'required');
                if ($this->form_validation->run() == TRUE) {
                    $post_data=array(
                        'product_model' => $this->input->post('product_model'),
                        'created' => date('Y-m-d')
                        );
               
                   if($this->admin_model->insert('product_model',$post_data)){
                    $this->session->set_flashdata('msg_success','Product model name added successfully.');
                    redirect('admin/product_model');
                   }
                } 
        }else{
    //update
            $id='';
            if(!empty($_POST['model_submit'])){
                $id = $_POST['model_submit'];
           
             
            $post_data=array(
                    'product_model' => $_POST['product_model_'.$id],
                    'created' => date('Y-m-d')
                    );
            if($this->admin_model->update('product_model',$post_data,array('id'=>$id))){
            $this->session->set_flashdata('msg_success','Product model updated successfully.');
            redirect('admin/product_model');
            }
           }
            
        }
    //delete
        if(!empty($model_id)){
           if($this->admin_model->delete('product_model',array('id'=>$model_id))){
                $this->session->set_flashdata('msg_success','Product model delete successfully.');
                redirect('admin/product_model');
                }  
        }

        $data['product_model'] =  $this->admin_model->get_result('product_model');
        $data['main'] = 'admin';        
        $data['title'] = 'GSM - Admin Panel: Product model';  
        $data['page'] = 'product_model';
        $this->load->module('templates');
        $this->templates->admin($data);
    }

    function product_color($color_id=0)
    {
        $this->check_authentication();//check login authentication
        if($this->input->post('product')==1){
            $this->form_validation->set_rules('product_color', 'Product color name', 'required');
                if ($this->form_validation->run() == TRUE) {
                    $post_data=array(
                        'product_color' => $this->input->post('product_color'),
                        'created' => date('Y-m-d')
                        );
               
                   if($this->admin_model->insert('product_color',$post_data)){
                    $this->session->set_flashdata('msg_success','Product color name added successfully.');
                    redirect('admin/product_color');
                   }
                } 
        }else{
    //update
            $id='';
            if(!empty($_POST['color_submit'])){
                $id = $_POST['color_submit'];
           
             
            $post_data=array(
                    'product_color' => $_POST['product_color_'.$id],
                    'created' => date('Y-m-d')
                    );
            if($this->admin_model->update('product_color',$post_data,array('id'=>$id))){
            $this->session->set_flashdata('msg_success','Product color updated successfully.');
            redirect('admin/product_color');
            }
           }
            
        }
    //delete
        if(!empty($color_id)){
           if($this->admin_model->delete('product_color',array('id'=>$color_id))){
                $this->session->set_flashdata('msg_success','Product color delete successfully.');
                redirect('admin/product_color');
                }  
        }

        $data['product_color'] =  $this->admin_model->get_result('product_color');
        $data['main'] = 'admin';        
        $data['title'] = 'GSM - Admin Panel: Product color';  
        $data['page'] = 'product_color';
        $this->load->module('templates');
        $this->templates->admin($data);
    }
    
    function upgrades($id = NULL)
    {
        if ( ! $this->session->userdata('admin_logged_in'))
        { 
            redirect('admin/login');
        }
        $data['main'] = 'admin';        
        $data['title'] = 'GSM - Admin Panel: Account Upgrades';        
        $data['page'] = 'upgrades';
        
        $var = 'transaction';
        $var_model = $var.'_model';
        
        $this->load->model(''.$var.'/'.$var.'_model', ''.$var.'_model');
        if(isset($id)){
            $data[$var] = $this->{$var_model}->get_where($id);
        }else{
            $count = $this->{$var_model}->count_where('status', 'not_completed');
            if($count > 0){
                $data[$var.'_count'] = $count;
                $data[$var] = $this->{$var_model}->get_where_multiples_order('date', 'DESC', 'status', 'not_completed');
            }
            else{
                $data[$var.'_count'] = 0;
            }
        }
        $this->load->module('templates');
        $this->templates->admin($data);
    }
    
    function upgradeApprove($id)
    {
        $var = 'transaction';
        $var_model = $var.'_model';        
        $this->load->model(''.$var.'/'.$var.'_model', ''.$var.'_model');
        
        $var1 = 'country';
        $var1_model = $var1.'_model';
        
        $this->load->model(''.$var1.'/'.$var1.'_model', ''.$var1.'_model');
        
        $mem = $this->{$var_model}->get_where($id)->buyer_id;
        $item = $this->{$var_model}->get_where($id)->item;
        
        $data = array(                   
                        'status'               => 'completed'
                      );
        $this->{$var_model}->_update($id, $data);
        
        $var1 = 'member';
        $var1_model = $var1.'_model';
                
        $this->load->model(''.$var1.'/'.$var1.'_model', ''.$var1.'_model');
        
        if($item == 'GSMStockmarket - Silver Membership Fee (1 Year)'){
            
            $data = array(             
                        'membership'          => 2,
                        'membership_expire_date' => date("Y-m-d H:i:s", strtotime("+1 year", strtotime(date("Y-m-d H:i:s"))))
                      ); 
            $this->{$var1_model}->_update($mem, $data);
            
        }
        
        if($item == 'GSMStockmarket - Silver Membership Fee (6 Months)'){
            
            $data = array(             
                        'membership'          => 2,
                        'membership_expire_date' => date("Y-m-d H:i:s", strtotime("+6 months", strtotime(date("Y-m-d H:i:s"))))
                      ); 
            $this->{$var1_model}->_update($mem, $data);
            
        }
        
        $var2 = 'mailbox';
        $var2_model = $var2.'_model';
        
        $this->load->model(''.$var2.'/'.$var2.'_model', ''.$var2.'_model');
        
         $data = array(
                                    'member_id'         => 5,
                                    'sent_member_id'    => $mem,
                                    'subject'           => 'Member Profile Upgraded',
                                    'body'              => 'Your Profile has been upgraded. Please logout and log back in to activate your membership.',
                                    'inbox'             => 'yes',
                                    'sent'              => 'yes',
                                    'date'              => date('d-m-Y'),
                                    'time'              => date('H:i'),
                                    'sent_from'         => 'support',
                                    'datetime'          => date('Y-m-d H:i:s')
                                  ); 
        $this->{$var2_model}->_insert($data);
        
        redirect('admin/upgrades/');
    }
    
    function upgradeDecline($id)
    {
        $var = 'transaction';
        $var_model = $var.'_model';
        
        $this->load->model(''.$var.'/'.$var.'_model', ''.$var.'_model');
        //$mem = $this->{$var_model}->get_where($id)->buyer_id;
        //$profile = $this->{$var_model}->get_where($id)->company_profile_approval;
        
        $data = array(                   
                        'status'               => 'declined'
                      );
        $this->{$var_model}->_update($id, $data);
        
        redirect('admin/upgrades/');
    }
    
    function trade_ref($id = NULL, $code = NULL)
    {
        if ( ! $this->session->userdata('admin_logged_in'))
        { 
            redirect('admin/login');
        }
        
        $data['main'] = 'admin';        
        $data['title'] = 'GSM - Admin Panel: Trade References';        
        $data['page'] = 'trade-refs';
        
        $var = 'tradereference';
        $var_model = $var.'_model';

        $this->load->model(''.$var.'/'.$var.'_model', ''.$var.'_model');
        
        $var1 = 'country';
        $var1_model = $var1.'_model';
        
        $this->load->model(''.$var1.'/'.$var1.'_model', ''.$var1.'_model');
        
        if(isset($id)){
            $trade_mem = $this->{$var_model}->_custom_query("SELECT id, member_id, ".$code."_company AS company, ".$code."_name AS name, ".$code."_email AS email, ".$code."_phone AS phone, ".$code."_country AS country, ".$code."_comments AS comments FROM tradereference WHERE id = '".$id."'");
            $data['ref'] = $trade_mem[0];
            $data['code'] = $code;
        }
        else{

            $tade_count = $this->{$var_model}->_custom_query_count("SELECT COUNT(*) AS count FROM tradereference WHERE (trade_1_confirm = 'yes') OR (trade_2_confirm = 'yes')");
            //echo '<pre>';
            //print_r($tade_count);
            //exit;
            
            if($tade_count[0]->count > 0){
            //$data[$var] = $this->{$var_model}->get_where_multiples_order('id', 'DESC', 'trade_1_confirm', 'yes', 'OR trade_2_confirm', 'yes');
            $data[$var] = $this->{$var_model}->_custom_query("SELECT * FROM tradereference WHERE (trade_1_confirm = 'yes') OR (trade_2_confirm = 'yes')");
            $data['ref_count'] = $tade_count[0]->count;
            }
            else{
                $data['ref_count'] = 0;
            }
        }   
        $this->load->module('templates');
        $this->templates->admin($data);
    }
    
    function edit_tradeRef()
    {}
    
    function tradeRefApprove($id = NULL, $code = NULL)
    {
        $var = 'tradereference';
        $var_model = $var.'_model';

        $this->load->model(''.$var.'/'.$var.'_model', ''.$var.'_model');
        
        $var1 = 'company';
        $var1_model = $var1.'_model';

        $this->load->model(''.$var1.'/'.$var1.'_model', ''.$var1.'_model');
        
        $var2 = 'mailbox';
        $var2_model = $var2.'_model';

        $this->load->model(''.$var2.'/'.$var2.'_model', ''.$var2.'_model');
        
        $var3 = 'member';
        $var3_model = $var3.'_model';

        $this->load->model(''.$var3.'/'.$var3.'_model', ''.$var3.'_model');
        
        $data = array(
                    $code.'_admin_approve' => 'yes'
                    );
        $trade_mem = $this->{$var_model}->_update_where($data, 'id', $id);
        
        $trade1 = $this->{$var_model}->get_where_multiple('id', $id)->trade_1_admin_approve;
        $trade2 = $this->{$var_model}->get_where_multiple('id', $id)->trade_2_admin_approve;
        $mid = $this->{$var_model}->get_where_multiple('id', $id)->member_id;
        $cid = $this->{$var3_model}->get_where_multiple('id', $this->{$var_model}->get_where_multiple('id', $id)->member_id)->company_id;
        
        if($trade1 == 'yes' && $trade2 == 'yes'){
            
            $data = array(
                        'trade_completed' => 'completed'
                        );
            $this->{$var_model}->_update_where($data, 'id', $id);
            
            $data_mem = array(
                        //'marketplace' => 'active'
                        'credit_report' => 'credit_check'
                        );
            $this->{$var1_model}->_update_where($data_mem, 'id', $cid); 
            
            $data_mail = array(
                                    'member_id'         => 5,
                                    'sent_member_id'    => $mid,
                                    'subject'           => 'Trade Reference Approved',
                                    'body'              => 'Your 2 Trade References have been approved.',
                                    'inbox'             => 'yes',
                                    'sent'              => 'yes',
                                    'date'              => date('d-m-Y'),
                                    'time'              => date('H:i'),
                                    'sent_from'         => 'support',
                                    'datetime'          => date('Y-m-d H:i:s')
                                  ); 
            $this->{$var2_model}->_insert($data_mail);
            
        }
        
        redirect('admin/trade_ref');
    }

    function tradeRefDecline($id = NULL, $code = NULL)
    {
        if($code == 'trade_1'){
           $tade_customer = 'First Trade Reference'; 
        }
        else{
            $tade_customer = 'Second Trade Reference';
        }
        
        $var = 'tradereference';
        $var_model = $var.'_model';

        $this->load->model(''.$var.'/'.$var.'_model', ''.$var.'_model');
        
        $var1 = 'member';
        $var1_model = $var1.'_model';

        $this->load->model(''.$var1.'/'.$var1.'_model', ''.$var1.'_model');
        
        $var2 = 'mailbox';
        $var2_model = $var2.'_model';

        $this->load->model(''.$var2.'/'.$var2.'_model', ''.$var2.'_model');
        
        $mid = $this->{$var_model}->get_where_multiple('id', $id)->member_id;
        
        $data = array(
                    $code.'_company' => 'Declined - Please resubmit',
                    $code.'_name' => 'Declined - Please resubmit',
                    $code.'_email' => 'Declined - Please resubmit',
                    $code.'_phone' => 'Declined - Please resubmit',
                    $code.'_country' => '211',
                    $code.'_comments' => 'Declined - Please resubmit',
                    $code.'_confirm' => 'yes_declined',
                    $code.'_admin_approve' => 'declined'
                    );
        $trade_mem = $this->{$var_model}->_update_where($data, 'id', $id);
        
        $data_mail = array(
                                'member_id'         => 5,
                                'sent_member_id'    => $mid,
                                'subject'           => 'Trade Reference Declined',
                                'body'              => 'Your '.$tade_customer.' has been declined. Please could you amend your information.',
                                'inbox'             => 'yes',
                                'sent'              => 'yes',
                                'date'              => date('d-m-Y'),
                                'time'              => date('H:i'),
                                'sent_from'         => 'support',
                                'datetime'          => date('Y-m-d H:i:s')
                              ); 
        $this->{$var2_model}->_insert($data_mail);

        redirect('admin/trade_ref');   
    }
    
    function add_event()
    {
        $data['main'] = 'admin';        
        $data['title'] = 'GSM - Admin Panel: Edit Feed';        
        $data['page'] = 'add-event';
        
        //$var = 'company';
        //$var_model = $var.'_model';
        
        //$this->load->model(''.$var.'/'.$var.'_model', ''.$var.'_model');
        //$data[$var] = $this->{$var_model}->get_where($id);
        
        $this->load->module('templates');
        $this->templates->admin($data);
    }
    
    function eventAdd()
    {
        //echo '<pre>';
        //print_r($_POST);
        
        $var = 'events';
        $var_model = $var.'_model';

        $this->load->model(''.$var.'/'.$var.'_model', ''.$var.'_model');
        
        $data = array(
                    'name'          => $this->input->post('name'),
                    'date'          => $this->input->post('date'),
                    'venue'         => $this->input->post('venue'),
                    'location'      => $this->input->post('location'),
                    'website'       => $this->input->post('website'),
                    'description'   => $this->input->post('description') 
                     );
        
        $eid = $this->{$var_model}->_insert($data);
        
        $this->load->library('upload');
        $base = $this->config->item('base_url');

        $config['upload_path'] = dirname($_SERVER["SCRIPT_FILENAME"]) . '/public/main/template/gsm/images/events/';
        $config['upload_url'] = $base . 'public/main/template/gsm/images/events/';
        $config['allowed_types'] = 'gif|jpg|png';
        $config['file_name'] = $eid;
        $config['max_size'] = 4000;
        $config['overwrite'] = TRUE;
        $config['max_width'] = 1500;
        $config['max_height'] = 1500;

        $this->upload->initialize($config);
        $this->upload->do_upload();        
        
        $this->session->set_flashdata('admin-events', '<div style="margin:0 15px">    
                                                            <div class="alert alert-success">
                                                                That has been added.
                                                            </div>
                                                        </div>');

       redirect('admin/add_event');
    }
    
    function edit_event($eid = NULL)
    {
        $data['main'] = 'admin';        
        $data['title'] = 'GSM - Admin Panel: Edit Feed';        
        $data['page'] = 'edit-event';

        $var = 'events';
        $var_model = $var.'_model';

        $this->load->model(''.$var.'/'.$var.'_model', ''.$var.'_model');
        
        if(isset($eid)){
            
            $data['name'] = $this->{$var_model}->get_where($eid)->name;
            $data['date'] = $this->{$var_model}->get_where($eid)->date;
            $data['venue'] = $this->{$var_model}->get_where($eid)->venue;
            $data['location'] = $this->{$var_model}->get_where($eid)->location;
            $data['website'] = $this->{$var_model}->get_where($eid)->website;
            $data['description'] = $this->{$var_model}->get_where($eid)->description;
            $data['status'] = $this->{$var_model}->get_where($eid)->status;
            
        }
        else{            
            
            $data[$var] = $this->{$var_model}->get_all();
            $data[$var.'_count'] = $this->{$var_model}->count_all();
        
        }
        
        $data['base'] = $this->config->item('base_url');
        $this->load->module('templates');
        $this->templates->admin($data);
    }
    
     function eventEdit($eid = NULL)
    {
         //echo '<pre>';
         //print_r(str_replace('sort_order_', '', $_POST));         
         //echo $eid;
         //exit;
//       
        $var = 'events';
        $var_model = $var.'_model';

        $this->load->model(''.$var.'/'.$var.'_model', ''.$var.'_model');
        
        if($eid){
            
            $data = array(
                        'name'          => $this->input->post('name'),
                        'date'          => $this->input->post('date'),
                        'venue'         => $this->input->post('venue'),
                        'location'      => $this->input->post('location'),
                        'website'       => $this->input->post('website'),
                        'description'   => $this->input->post('description') 
                         );

            $this->{$var_model}->_update($eid, $data);

            $this->load->library('upload');
            $base = $this->config->item('base_url');

            $config['upload_path'] = dirname($_SERVER["SCRIPT_FILENAME"]) . '/public/main/template/gsm/images/events/';
            $config['upload_url'] = $base . 'public/main/template/gsm/images/events/';
            $config['allowed_types'] = 'gif|jpg|png';
            $config['file_name'] = $eid;
            $config['max_size'] = 4000;
            $config['overwrite'] = TRUE;
            $config['max_width'] = 1500;
            $config['max_height'] = 1500;

            $this->upload->initialize($config);
            $this->upload->do_upload();  

            $this->session->set_flashdata('admin-events', '<div style="margin:0 15px">    
                                                                <div class="alert alert-success">
                                                                    The has been edited.
                                                                </div>
                                                            </div>');
        }
        else{
            
            foreach ($_POST as $key => $value){
             
             $id = str_replace('sort_order_', '', $key);
             
             $data = array(
                            'sort_order' => $value
                          );
             $this->{$var_model}->_update($id, $data);             
            }
            
            $this->session->set_flashdata('admin-events', '<div style="margin:0 15px">    
                                                                <div class="alert alert-success">
                                                                    The has been updated.
                                                                </div>
                                                            </div>');
        }

       redirect('admin/edit_event');
    }
    
    function eventActivation($eid, $status)
    {
        $var = 'events';
        $var_model = $var.'_model';

        $this->load->model(''.$var.'/'.$var.'_model', ''.$var.'_model');
        
        $data = array(
                      'status' => $status            
                     );
        
         $this->{$var_model}->_update_where($data, 'id', $eid);
         
         $this->session->set_flashdata('admin-events', '<div style="margin:0 15px">    
                                                            <div class="alert alert-success">
                                                                The status has been changed to '.$status.'.
                                                            </div>
                                                        </div>');

       redirect('admin/edit_event/'.$eid);
        
    }
    
    function eventDelete($eid)
    {
        $var = 'events';
        $var_model = $var.'_model';

        $this->load->model(''.$var.'/'.$var.'_model', ''.$var.'_model');
        
        $this->{$var_model}->_delete($eid);
        
        $var1 = 'attending';
        $var1_model = $var1.'_model';

        $this->load->model(''.$var1.'/'.$var1.'_model', ''.$var1.'_model');
        
        $this->{$var1_model}->_delete_where('event_id', $eid);
        
        $this->session->set_flashdata('admin-events', '<div style="margin:0 15px">    
                                                            <div class="alert alert-success">
                                                                That has been deleted.
                                                            </div>
                                                        </div>');

       redirect('admin/edit_event/');
        
    }
    
    function terms_conditions()
    {
        $data['main'] = 'admin';        
        $data['title'] = 'GSM - Admin Panel: Terms &amp; Conditions';        
        $data['page'] = 'terms-conditions';
        $data['base'] = $this->config->item('base_url'); 
        
        $var = 'legal';
        $var_model = $var.'_model';
        
        $this->load->model(''.$var.'/'.$var.'_model', ''.$var.'_model');
        
        $data['terms'] = $this->{$var_model}->get_where(1);
        
        $this->load->module('templates');
        $this->templates->admin($data);
    }
    
    function privacy_policy()
    {
        $data['main'] = 'admin';        
        $data['title'] = 'GSM - Admin Panel: Privacy Policy';        
        $data['page'] = 'privacy-policy';
        
        $var = 'legal';
        $var_model = $var.'_model';
        
        $this->load->model(''.$var.'/'.$var.'_model', ''.$var.'_model');
        
        $data['policy'] = $this->{$var_model}->get_where(2);
        
        $this->load->module('templates');
        $this->templates->admin($data);
    }
    
    function legalEdit($id)
    {
        //echo '<pre>';
        //print_r($_POST);;
        $user_terms = $this->input->post('user_terms');
        
        $var = 'legal';
        $var_model = $var.'_model';
        
        $this->load->model(''.$var.'/'.$var.'_model', ''.$var.'_model');
        
        $data = array(
                    'title' => $this->input->post('title'),
                    'url_link' => $this->input->post('url_link'),
                    'content' => $this->input->post('content')
        );
        
        $this->{$var_model}->_update($id, $data);
        
        if($user_terms == 'yes'){
            
            $var1 = 'member';
            $var1_model = $var1.'_model';

            $this->load->model(''.$var1.'/'.$var1.'_model', ''.$var1.'_model');
            $this->{$var1_model}->_custom_query_action("UPDATE members SET terms_conditions = 'no' WHERE id != 5");
        }
        
        if($id == 1){
            redirect('admin/terms_conditions');
        }else{
            redirect('admin/privacy_policy');
        }
    }
     /*add Color attributes*/
   

    function color_attributes()
    {
        $this->check_authentication();//check login authentication


        $data['color_attributes'] =  $this->admin_model->get_result('color_attributes');
        $data['main'] = 'admin';        
        $data['title'] = 'GSM - Admin Panel: Listing Attribute Level';  
        $data['page'] = 'color_attributes';
        $this->load->module('templates');
        $this->templates->admin($data);
    }

    function add_color_attribute()
    {
        $this->check_authentication();//check login authentication

        $this->form_validation->set_rules('color_name', 'Color Name', 'required');
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
        if ($this->form_validation->run() == TRUE){
            $data_insert=array(
            'color_name' =>  $this->input->post('color_name'),
            'created' => date('Y-m-d h:i:s A'), 
            );
           $this->admin_model->insert('color_attributes',$data_insert);
           $this->session->set_flashdata('msg_success','Color Attribute added successfully.');
           redirect('admin/color_attributes');
        }
        
        $data['main'] = 'admin';        
        $data['title'] = 'GSM - Admin Panel: Listing Attribute Level';  
        $data['page'] = 'add_color_attribute';
        $this->load->module('templates');
        $this->templates->admin($data);
    }

     function edit_color_attribute($color_id='')
    {
        $this->check_authentication();//check login authentication
        

       $this->form_validation->set_rules('color_name', 'Color Name', 'required');      
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
        if ($this->form_validation->run() == TRUE){
            $data_update=array(
             'color_name' =>  $this->input->post('color_name'),           
             'updated' => date('Y-m-d h:i:s A'), 
            );
           $this->admin_model->update('color_attributes',$data_update,array('id'=>$color_id));
           $this->session->set_flashdata('msg_success','Color attribute updated successfully.');
           redirect('admin/color_attributes');
        } 
       
        $data['color_attributes'] =  $this->admin_model->get_row('color_attributes',array('id'=>$color_id));
       
        $data['main'] = 'admin';        
        $data['title'] = 'GSM - Admin Panel: Listing Attribute Level';  
        $data['page'] = 'edit_color_attribute';
        $this->load->module('templates');
        $this->templates->admin($data);
    }

    function delete_color_attribute($color_id='')
    {
        $this->check_authentication();//check login authentication
        if(empty($color_id)){ redirect('admin/color_attributes'); } 

        if($this->admin_model->delete('color_attributes',array('id'=>$color_id))){
            $this->session->set_flashdata('msg_success','Color Attribute deleted successfully.');
           redirect('admin/color_attributes'); 
        }       
      
    }

    /*   Specification */

     function spec_attributes()
    {
        $this->check_authentication();//check login authentication
        $data['spec_attributes'] =  $this->admin_model->get_result('spec_attributes');
        $data['main'] = 'admin';        
        $data['title'] = 'GSM - Admin Panel: Listing Attribute Level';  
        $data['page'] = 'spec_attributes';
        $this->load->module('templates');
        $this->templates->admin($data);
    }

    function add_spec_attribute()
    {
        $this->check_authentication();//check login authentication

        $this->form_validation->set_rules('spec', 'Specification Name', 'required');
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
        if ($this->form_validation->run() == TRUE){
            $data_insert=array(
            'spec' =>  $this->input->post('spec'),
            'created' => date('Y-m-d h:i:s A'), 
            );
           $this->admin_model->insert('spec_attributes',$data_insert);
           $this->session->set_flashdata('msg_success','Specification Attribute added successfully.');
           redirect('admin/spec_attributes');
        }
        
        $data['main'] = 'admin';        
        $data['title'] = 'GSM - Admin Panel: Listing Attribute Level';  
        $data['page'] = 'add_spec_attribute';
        $this->load->module('templates');
        $this->templates->admin($data);
    }

     function edit_spec_attribute($spec_id='')
    {
        $this->check_authentication();//check login authentication
       $this->form_validation->set_rules('spec', 'Specification', 'required');      
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
        if ($this->form_validation->run() == TRUE){
            $data_update=array(
             'spec' =>  $this->input->post('spec'),           
             'updated' => date('Y-m-d h:i:s A'), 
            );
           $this->admin_model->update('spec_attributes',$data_update,array('id'=>$spec_id));
           $this->session->set_flashdata('msg_success','Specification attribute updated successfully.');
           redirect('admin/spec_attributes');
        } 
       
        $data['spec_attributes'] =  $this->admin_model->get_row('spec_attributes',array('id'=>$spec_id));
       
        $data['main'] = 'admin';        
        $data['title'] = 'GSM - Admin Panel: Listing Attribute Level';  
        $data['page'] = 'edit_spec_attribute';
        $this->load->module('templates');
        $this->templates->admin($data);
    }

    function delete_spec_attribute($spec_id='')
    {
        $this->check_authentication();//check login authentication
        if(empty($spec_id)){ redirect('admin/spec_attributes'); } 

        if($this->admin_model->delete('spec_attributes',array('id'=>$spec_id))){
            $this->session->set_flashdata('msg_success','Specification Attribute deleted successfully.');
           redirect('admin/spec_attributes'); 
        }       
      
    }

       /*   Condition */

     function condition()
    {
        $this->check_authentication();//check login authentication
        $data['condition'] =  $this->admin_model->get_result('condition_attributes');
        $data['main'] = 'admin';        
        $data['title'] = 'GSM - Admin Panel: Listing Attribute Level';  
        $data['page'] = 'condition';
        $this->load->module('templates');
        $this->templates->admin($data);
    }

    function add_condition_attribute()
    {
        $this->check_authentication();//check login authentication

        $this->form_validation->set_rules('condition', 'Condition', 'required');
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
        if ($this->form_validation->run() == TRUE){
            $data_insert=array(
            'condition' =>  $this->input->post('condition'),
            'created' => date('Y-m-d h:i:s A'), 
            );
           $this->admin_model->insert('condition_attributes',$data_insert);
           $this->session->set_flashdata('msg_success','condition Attribute added successfully.');
           redirect('admin/condition');
        }
        
        $data['main'] = 'admin';        
        $data['title'] = 'GSM - Admin Panel: Listing Attribute Level';  
        $data['page'] = 'add_condition_attribute';
        $this->load->module('templates');
        $this->templates->admin($data);
    }

     function edit_condition_attribute($spec_id='')
    {
        $this->check_authentication();//check login authentication
       $this->form_validation->set_rules('condition', 'Condition', 'required');      
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
        if ($this->form_validation->run() == TRUE){
            $data_update=array(
             'condition' =>  $this->input->post('condition'),           
             'updated' => date('Y-m-d h:i:s A'), 
            );
           $this->admin_model->update('condition_attributes',$data_update,array('id'=>$spec_id));
           $this->session->set_flashdata('msg_success','condition attribute updated successfully.');
           redirect('admin/condition');
        } 
       
        $data['condition'] =  $this->admin_model->get_row('condition_attributes',array('id'=>$spec_id));
       
        $data['main'] = 'admin';        
        $data['title'] = 'GSM - Admin Panel: Listing Attribute Level';  
        $data['page'] = 'edit_condition_attribute';
        $this->load->module('templates');
        $this->templates->admin($data);
    }

    function delete_condition_attribute($spec_id='')
    {
        $this->check_authentication();//check login authentication
        if(empty($spec_id)){ redirect('admin/condition'); } 

        if($this->admin_model->delete('condition_attributes',array('id'=>$spec_id))){
            $this->session->set_flashdata('msg_success','Condition Attribute deleted successfully.');
           redirect('admin/condition'); 
        }       
      
    }
    
    function credit_check()
    {
        //echo 'CREDIT CHECK';
        if($this->session->userdata('authority') == 'super_admin'){
        
        $var = 'company';
        $var_model = $var.'_model';
        
        $this->load->model(''.$var.'/'.$var.'_model', ''.$var.'_model');  
        
        $var1 = 'membership';
        $var1_model = $var1.'_model';
        
        $this->load->model(''.$var1.'/'.$var1.'_model', ''.$var1.'_model');
        
        $count = $this->{$var_model}->_custom_query_count('SELECT COUNT(*) AS count FROM company WHERE credit_report = "credit_check"');
        
        if($count[0]->count > 0){
            
           $data['credit_count'] = $count[0]->count;
           $data['credit'] = $this->{$var_model}->get_where_multiples('credit_report', 'credit_check');
        }
        else{
            
            $data['credit_count'] =  0;
        }
        
        $data['main'] = 'admin';        
        $data['title'] = 'GSM - Admin Panel: CRedit Check';  
        $data['page'] = 'credit-check';
        $this->load->module('templates');
        $this->templates->admin($data);
            
        }
        else{
            redirect('admin/dashboard');
        }
    }
    
    function edit_credit($cid)
    {
        $var = 'company';
        $var_model = $var.'_model';
        
        $this->load->model(''.$var.'/'.$var.'_model', ''.$var.'_model');
        
        $var1 = 'country';
        $var1_model = $var1.'_model';
        
        $this->load->model(''.$var1.'/'.$var1.'_model', ''.$var1.'_model');
        
        $data['company'] = $this->{$var_model}->get_where($cid);
        $data['main'] = 'admin';        
        $data['title'] = 'GSM - Admin Panel: CRedit Check - Company';  
        $data['page'] = 'credit-check';
        $this->load->module('templates');
        $this->templates->admin($data);
    }
    
    function creditAdd($mid)
    {
        //echo '<pre>';
        //print_r($_FILES);
        //print_r($_POST);
        
        $base = $this->config->item('base_url');
        $var = 'company';
        $var_model = $var.'_model';
        
        $this->load->model(''.$var.'/'.$var.'_model', ''.$var.'_model');
        
        $var1 = 'member';
        $var1_model = $var1.'_model';
        
        $this->load->model(''.$var1.'/'.$var1.'_model', ''.$var1.'_model');
        
        $member_company = $this->{$var1_model}->get_where_multiples('company_id', $mid);
        
        $admin_email = $this->{$var1_model}->get_where($this->{$var_model}->get_where_multiple('id', $mid)->admin_member_id)->email;
        
        //echo '<pre>';
        //print_r($test);
        //exit;
        
        $this->load->library('form_validation');

        $this->form_validation->set_rules('name', 'Document Name', 'xss_clean');
        
        if ($this->form_validation->run()) {
            
            $data = array(
                           'credit_report' =>  $this->seo_friendly($this->input->post('name'))
                        );
            
            $this->{$var_model}->_update_where($data, 'id', $mid);
            $files = $_FILES;
            
            if ($files['userfile']['size'] > 0) {
                
                $this->load->library('upload');
                $base = $this->config->item('base_url');

                $config['upload_path'] = dirname($_SERVER["SCRIPT_FILENAME"]) . '/public/main/template/gsm/creditdata/';
                $config['upload_url'] = $base . 'public/main/template/gsm/creditdata/';
                $config['allowed_types'] = 'gif|jpg|png|pdf';
                $config['file_name'] = $this->seo_friendly($this->input->post('name'));
                $config['max_size'] = 4000;
                $config['overwrite'] = TRUE;
                //$config['max_width'] = 1500;
                //$config['max_height'] = 1500;

                $this->upload->initialize($config);
                $this->upload->do_upload();
                
            }
            
            foreach($member_company as $mem_comp){
            
                $data = array(
                               'membership' => 2 
                            );

                $this->{$var1_model}->_update_where($data, 'company_id', $mem_comp->company_id);
            
            }
            
            $data = array(
                           'marketplace' => 'active' 
                        );
            
            $this->{$var_model}->_update_where($data, 'id', $mid);
            
            $this->load->module('emails');
            $config = Array(
                'protocol' => 'smtp',
                'smtp_host' => 'ssl://server.gsmstockmarket.com',
                'smtp_port' => 465,
                'smtp_user' => 'noreply@gsmstockmarket.com',
                'smtp_pass' => 'ehT56.l}iW]I2ba3f0',
                'charset' => 'utf-8',
                'wordwrap' => TRUE,
                'newline' => "\r\n",
                'crlf'    => ""

            );

            $this->load->library('email', $config);

            $this->email->set_mailtype("html");
            $email_body = '<table class="body-wrap" style="margin: 0;padding: 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;box-sizing: border-box;font-size: 14px;background-color: #f6f6f6;width: 100%;">
                            <tr style="margin: 0;padding: 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;box-sizing: border-box;font-size: 14px;">
                                    <td style="margin: 0;padding: 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;box-sizing: border-box;font-size: 14px;vertical-align: top;"></td>
                                    <td class="container" width="600" style="margin: 0 auto !important;padding: 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;box-sizing: border-box;font-size: 14px;vertical-align: top;display: block !important;max-width: 600px !important;clear: both !important;">
                                            <div class="content" style="margin: 0 auto;padding: 20px;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;box-sizing: border-box;font-size: 14px;max-width: 600px;display: block;">
                                                    <table class="main" width="100%" cellpadding="0" cellspacing="0" style="margin: 0;padding: 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;box-sizing: border-box;font-size: 14px;background: #fff;border: 1px solid #e9e9e9;border-radius: 3px;">
                                                            <tr style="margin: 0;padding: 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;box-sizing: border-box;font-size: 14px;">
                                                                    <td class="content-wrap" style="margin: 0;padding: 20px;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;box-sizing: border-box;font-size: 14px;vertical-align: top;">
                                                                            <table cellpadding="0" cellspacing="0" style="margin: 0;padding: 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;box-sizing: border-box;font-size: 14px;">
                                                                                    <tr style="margin: 0;padding: 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;box-sizing: border-box;font-size: 14px;">
                                                                                            <td style="margin: 0;padding: 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;box-sizing: border-box;font-size: 14px;vertical-align: top;">
                                                                                                    <img class="img-responsive" src="'.$base.'public/main/template/gsm/images/email/header.png" style="margin: 0;padding: 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;box-sizing: border-box;font-size: 14px;max-width: 100%;">
                                                                                            </td>
                                                                                    </tr>
                                                                                    <tr style="margin: 0;padding: 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;box-sizing: border-box;font-size: 14px;">
                                                                                            <td class="content-block" style="margin: 0;padding: 0 0 20px;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;box-sizing: border-box;font-size: 14px;vertical-align: top;">
                                                                                                    <h3 style="margin: 40px 0 0;padding: 0;font-family: &quot;Helvetica Neue&quot;, Helvetica, Arial, &quot;Lucida Grande&quot;, sans-serif;box-sizing: border-box;font-size: 18px;color: #000;line-height: 1.2;font-weight: 400;">Your account has been verified!</h3>
                                                                                            </td>
                                                                                    </tr>

                                                                                    <tr style="margin: 0;padding: 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;box-sizing: border-box;font-size: 14px;">
                                                                                            <td class="content-block aligncenter" style="margin: 0;padding: 0 0 20px;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;box-sizing: border-box;font-size: 14px;vertical-align: top;text-align: center;">
                                                                                                    <p>We have confirmed your trade references and credit checked your company and you have passed. You now have full access on our platform and can start using the marketplace immediately.</td>
                                                                                    </tr>
                            <tr style="margin: 0;padding: 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;box-sizing: border-box;font-size: 14px;">
                            <td class="content-block" style="margin: 0;padding: 0 0 20px;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;box-sizing: border-box;font-size: 14px;vertical-align: top;">
                            <p style="margin: 0;padding: 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;box-sizing: border-box;font-size: 14px;margin-bottom: 10px;font-weight: normal;">If you need any assistance please call us on +44 (0)207 048 0120 or use the online ticketing customer support within your account and we’ll be happy to help you.</p>
                            <p style="margin: 0;padding: 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;box-sizing: border-box;font-size: 14px;margin-bottom: 10px;font-weight: normal;">Many Thanks,<br style="margin: 0;padding: 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;box-sizing: border-box;font-size: 14px;">
                            GSMStockMarket Team</p>
                            </td>
                            </tr>
                                                                              </table>
                                                                    </td>
                                                            </tr>
                                                    </table></div>
                                    </td>
                                    <td style="margin: 0;padding: 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;box-sizing: border-box;font-size: 14px;vertical-align: top;"></td>
                            </tr>
                    </table>';
            
            $this->email->from('noreply@gsmstockmarket.com', 'GSM Stockmarket Support Team');

            $list = array($admin_email, 'info@gsmstockmarket.com');
            $this->email->to($list);
            $this->email->subject('Your account has been verified!');
            $this->email->message($email_body);

            $this->email->send();
            
            $this->session->set_flashdata('message', '<div style="margin:15px">    
                                                                <div class="alert alert-success">
                                                                    That has been updated.
                                                                </div>
                                                            </div>');

            redirect('admin/credit_check/');
        }
        
    }
}