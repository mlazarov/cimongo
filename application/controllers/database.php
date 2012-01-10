<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Database extends MY_Controller {
	
	var $title = "Database";
	
	public function Index($server='default',$database){
		$this->load->library('table');
		
		$this->mongo_db->switch_db('admin');
		
		$query = $this->mongo_db->command(array("getCmdLineOpts" => 1),$this->database);
		if (isset($query["argv"])) {
			$data['commandLine'] = implode(" ", $query["argv"]);
		}
		else {
			$data['commandLine'] = "";
		}

		
		
		$this->load->view('database/index',$data);
	}

}

?>