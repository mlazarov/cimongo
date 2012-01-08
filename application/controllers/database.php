<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Database extends MY_Controller {
	
	var $title = "Database";
	
	public function Index($server='default',$database){
		//$this->getDatabases();
		//var_dump($this->databases);
		$this->getCollections('testdb');
		//var_dump($this->collections[$this->database]);
		//exit;
		$this->load->view('database/index');
	}

}

?>