<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Preferences extends MX_Controller 
{
    function __construct()
    {
        parent::__construct();
        if ( ! $this->session->userdata('logged_in'))
        { 
            redirect('login');
        }
    }

    function index()
    {
        $data['main'] = 'preferences';        
        $data['title'] = 'GSM - Preferences';        
        $data['page'] = 'index';
        
        $this->load->module('templates');
        $this->templates->page($data);
    }
    
    function password()
    {
        $data['main'] = 'preferences';        
        $data['title'] = 'GSM - Change Password';        
        $data['page'] = 'password';
        
        $this->load->module('templates');
        $this->templates->page($data);
    }
    
    function newsletter()
    {
        $data['main'] = 'preferences';        
        $data['title'] = 'GSM - Newsletter';        
        $data['page'] = 'newsletter';
        
        $this->load->module('templates');
        $this->templates->page($data);
    }
    
    function subscription()
    {
        $data['main'] = 'preferences';        
        $data['title'] = 'GSM - Manage Subscription';        
        $data['page'] = 'subscription';
        
        $this->load->module('templates');
        $this->templates->page($data);
    }
	
}