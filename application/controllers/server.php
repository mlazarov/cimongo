<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Server extends MY_Controller {
	
	public function Index(){
		
		$this->load->view('server/index');
		
	}
}

?>