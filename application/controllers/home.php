<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller {
	
	var $title = "Home";
	
	public function Index(){
		
		//$this->getDatabases();
		$this->load->view('home');
		
	}

}

?>