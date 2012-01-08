<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Action extends MY_Controller {
	
	
	public function Index($server='default',$database=false,$collection=false,$action=false){
		if(!$this->config->item($server,'mongo')){
			show_error('MongoDB server not found in config file: '.$server, 500, "Server not found" );
			// $this->Servers();
		}
		$this->server = $server;
		
		if(!$database){
			return $this->Databases();
		}
		$this->database = $database;
		
		if(!$collection){
			return $this->Collections();
		}
		$this->collection = $collection;
		
		// Loading default server
		$this->load->Collection('default');
	}

}

?>