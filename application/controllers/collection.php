<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Collection extends MY_Controller {
	
	
	public function Index(){
		$this->load->view('collection/index');
	}
	function Indexes(){
		$this->load->view('database/index');
	}

}

?>