<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller {
	var $title = 'Status';
	public function Index(){
		$this->load->view('home');
	}
}

?>