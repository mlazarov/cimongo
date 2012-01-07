<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Databases extends CI_Controller {
		
	var $server = 'default';
	var $database = false;
	var $collection = false;
	
	public function Index($server='default',$database=false,$collection=false,$action=false){
		if(!$this->config->item($server,'mongo')){
			show_error('MongoDB server not found in config file: '.$server, 500, "Server not found" );
		}
		$this->server = $server;
		if(!$database){
			return $this->Server($server);
		}
		
		$this->load->view('database/index');
	}
	
	private function Server($server){
		
		$this->load->view('server/index');
	}
	
	private function Database($server,$database){
		echo $server.' : '.$database;
	}
	
	private function Collection($server,$database,$collection){
		echo $server.' : '.$database.' : '.$collection;
	}
}

?>