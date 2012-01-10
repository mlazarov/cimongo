<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MY_Controller extends CI_Controller{
	
	var $title = '';
	
	var $server = 'default';
	var $database = false;
	var $collection = false;
	var $action = false;
		
	var $databases = array();
	var $collections = array();
	
	function __construct(){
		parent::__construct();
		//$this->output->enable_profiler(TRUE);
		$server = $this->uri->segment(2);
		if(!$this->config->item($server,'mongo')){
			show_error('MongoDB server not found in config file: '.$server, 500, "Server not found" );
			// $this->Servers();
		}
		$this->server = $server;
		
		$this->load->library('mongo_db',array('server'=>$server));
		
		$this->getDatabases();
		// Load default config file with $server config
		
		$database = $this->uri->segment(3);
		if($database){
			if(isset($this->databases[$database])){
				$this->database = $database;
				$this->mongo_db->switch_db($database);
				$this->getCollections();
				
				$collection = $this->uri->segment(4);
				if($collection){
					if(isset($this->collections[$this->database][$collection])){
						$this->collection = $collection;
					}else{
						show_error('Collection not found');
					}
				}
			}else{
				var_dump($this->databases);
				show_error('Database not found');
			}
		}
		$this->load->library('mongo_db',array('server'=>$server,'database'=>$this->database));
		
		$this->action = $this->uri->segment(5);
		//var_dump($server,$database,$collection,$action);
		//exit;
	}
	protected function getDatabases($server=false){
		$result = $this->mongo_db->getDatabases();
		if($result['ok']){
			foreach($result['databases'] as $database){
				$this->databases[$database['name']] = $database['sizeOnDisk'];
			}
		}
		ksort($this->databases);
		
	}
	protected function getCollections(){
		$result = $this->mongo_db->getCollections();
		//$result = $this->mongo_db->command();
		//var_dump($result);
		//exit;
		foreach($result as $res){
			list ($dbname, $collection) = explode('.',(string)$res);
			$this->collections[$this->database][$collection]['indexes'] = $res->getIndexInfo();
		}
	}

}
?>