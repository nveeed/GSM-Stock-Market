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
    }

    function index()
    {
        $data['main'] = 'mailbox';        
        $data['title'] = 'GSM - Mailbox';        
        $data['page'] = 'index';
        
        $this->load->module('templates');
        $this->templates->page($data);
    }
    
    function inbox($mid = NULL)
    {
        
        $data['main'] = 'mailbox';        
        $data['title'] = 'GSM - Inbox';        
        $data['page'] = 'inbox';
        $data['inbox_count'] = $this->mailbox_model->count_where('sent_member_id',$this->session->userdata('members_id'));
        $data['inbox_message'] = $this->mailbox_model->get_where_multiples('sent_member_id',$this->session->userdata('members_id'));
        
        $data['message'] = $this->mailbox_model->get_where_multiple('id', $mid);
        
        $this->load->module('templates');
        $this->templates->page($data);
    }
    
    function sent($mid = NULL)
    {
        
        $data['main'] = 'mailbox';        
        $data['title'] = 'GSM - Inbox';        
        $data['page'] = 'sent';
        $data['inbox_count'] = $this->mailbox_model->count_where_multiple('member_id',$this->session->userdata('members_id'), 'sent', 'yes');
        $data['inbox_message'] = $this->mailbox_model->get_where_multiples('member_id',$this->session->userdata('members_id'), 'sent', 'yes');
        
        $data['message'] = $this->mailbox_model->get_where_multiple('id', $mid);
        
        $this->load->module('templates');
        $this->templates->page($data);
    }
    
    function mark_read($mid)
    {
        $data = array(
                        'read'     => 'yes'
                      );

        $this->load->model('mailbox/mailbox_model', 'mailbox_model');
        $this->mailbox_model->_update($mid, $data);
        
        redirect('mailbox/inbox');
    }
    
    function mark_unread($mid)
    {
        $data = array(
                        'read'     => 'no'
                      );

        $this->load->model('mailbox/mailbox_model', 'mailbox_model');
        $this->mailbox_model->_update($mid, $data);
        
        redirect('mailbox/inbox');
    }
    
    function important($mid = NULL)
    {
        
        $data['main'] = 'mailbox';        
        $data['title'] = 'GSM - Inbox';        
        $data['page'] = 'important';
        $data['inbox_count'] = $this->mailbox_model->count_where_multiple('member_id',$this->session->userdata('members_id'), 'important', 'yes');
        $data['inbox_message'] = $this->mailbox_model->get_where_multiples('member_id',$this->session->userdata('members_id'), 'important', 'yes');
        
        $data['message'] = $this->mailbox_model->get_where_multiple('id', $mid);
        
        $this->load->module('templates');
        $this->templates->page($data);
    }
    
    function important_move($mid)
    {
        $data = array(
                        'trash'     => 'no',
                        'sent'      => 'no',
                        'important' => 'yes',
                        'draft'     => 'no'
                      );

        $this->load->model('mailbox/mailbox_model', 'mailbox_model');
        $this->mailbox_model->_update($mid, $data);
        
        redirect('mailbox/important');
    }
    
    function draft($mid = NULL)
    {
        
        $data['main'] = 'mailbox';        
        $data['title'] = 'GSM - Inbox';        
        $data['page'] = 'draft';
        $data['inbox_count'] = $this->mailbox_model->count_where_multiple('member_id',$this->session->userdata('members_id'), 'draft', 'yes');
        $data['inbox_message'] = $this->mailbox_model->get_where_multiples('member_id',$this->session->userdata('members_id'), 'draft', 'yes');
        
        $data['message'] = $this->mailbox_model->get_where_multiple('id', $mid);
        
        $this->load->module('templates');
        $this->templates->page($data);
    }
    
    function daft_move($mid)
    {
        $data = array(
                        'trash'     => 'no',
                        'sent'      => 'no',
                        'important' => 'no',
                        'draft'     => 'yes'
                      );

        $this->load->model('mailbox/mailbox_model', 'mailbox_model');
        $this->mailbox_model->_update($mid, $data);
        
        redirect('mailbox/draft');
    }
    
    function trash($mid = NULL)
    {
        
        $data['main'] = 'mailbox';        
        $data['title'] = 'GSM - Inbox';        
        $data['page'] = 'trash';
        $data['inbox_count'] = $this->mailbox_model->count_where_multiple('member_id',$this->session->userdata('members_id'), 'trash', 'yes');
        $data['inbox_message'] = $this->mailbox_model->get_where_multiples('member_id',$this->session->userdata('members_id'), 'trash', 'yes');
        
        $data['message'] = $this->mailbox_model->get_where_multiple('id', $mid);
        
        $this->load->module('templates');
        $this->templates->page($data);
    }
    
    function trash_move($mid)
    {
        $data = array(
                        'trash'     => 'yes',
                        'sent'      => 'no',
                        'important' => 'no',
                        'draft'     => 'no'
                      );

        $this->load->model('mailbox/mailbox_model', 'mailbox_model');
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
        $data['inbox'] = $this->mailbox_model->count_where_multiple('sent_member_id',$this->session->userdata('members_id'), 'read', 'no');
        $data['draft'] = $this->mailbox_model->count_where_multiple('member_id',$this->session->userdata('members_id'), 'draft', 'yes');
        $this->load->view('side-mail', $data);
    }
            
    function compose()
    {
        $data['main'] = 'mailbox';        
        $data['title'] = 'GSM - Compose Mail';        
        $data['page'] = 'compose';
        
        $this->load->module('templates');
        $this->templates->page($data);
    }
    
    function composeMail()
    {
        $this->load->library('form_validation');
        
        $this->form_validation->set_rules('email_address', 'Email Address', 'xss_clean');
        $this->form_validation->set_rules('subject', 'Subject', 'xss_clean');
        $this->form_validation->set_rules('body', 'Message Body', 'xss_clean');
        
            if($this->form_validation->run()){
                
                $this->load->model('member/member_model', 'member_model');
                $sid = $this->member_model->get_where_multiple('email', $this->input->post('email_address'))->id;

                $data = array(
                                'member_id'         => $this->session->userdata('members_id'),
                                'sent_member_id'    => $sid,
                                'subject'           => $this->input->post('subject'),
                                'body'              => $this->input->post('body'),
                                'sent'              => 'yes',
                                'date'              => date('d-m-Y'),
                                'time'              => date('H:i')
                              );

                $this->load->model('mailbox/mailbox_model', 'mailbox_model');
                $this->mailbox_model->_insert($data);
            }
            
        redirect('mailbox/inbox');
        
    }
            
    function archive()
    {
        $data['main'] = 'mailbox';        
        $data['title'] = 'GSM - Archive Mail';        
        $data['page'] = 'archive';
        
        $this->load->module('templates');
        $this->templates->page($data);
    }	
	
}