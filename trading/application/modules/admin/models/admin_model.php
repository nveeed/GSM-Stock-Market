<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Admin_model extends MY_Model {

	function __construct()
	{		
		parent::__construct();
		$this->table = 'change_this';
	
	}
}

