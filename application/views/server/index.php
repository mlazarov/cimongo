<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

$this->load->view('header');

?>
	<h1><?php echo $title;?></h1>
	
	<div id="body">

		<?php	
	
		$rows = array();
		$tmpl = array ( 'table_open'  => '<table border="1" cellpadding="2" cellspacing="1" class="mytable" width="600">' );
                $this->table->set_template($tmpl);
		$this->table->set_heading(array('Command Line (db.serverCmdLineOpts())'));
		$rows = array(array((string)$commandLine));
		echo $this->table->generate($rows);

		echo '<br/>';

		$this->table->set_heading(array('data'=>'Web Server','colspan'=>3));
		$rows = array();
		if (isset($_SERVER["SERVER_SOFTWARE"])) {
                        list($webServer) = explode(" ", $_SERVER["SERVER_SOFTWARE"]);
			list($webServerName,$webServerVersion) = explode("/",$webServer);
			$rows[] = array('Web Server',$webServerName,$webServerVersion);
                   	
                }
		$rows[] = array("<a href=\"http://www.php.net\" target=\"_blank\">PHP version</a>","PHP", PHP_VERSION);
		$rows[] = array("<a href=\"http://www.php.net/mongo\" target=\"_blank\">PHP extension</a>", "<a href=\"http://pecl.php.net/package/mongo\" target=\"_blank\">mongo</a>" , Mongo::VERSION);
		$rows[] = array('','CodeIgniter',CI_VERSION);
		
		echo $this->table->generate($rows);
		
		echo '<br/>';

		 //build info
                $ret = $this->mongo->command(array("buildinfo" => 1));
                $rows = array();
		$this->table->set_heading(array('data'=>'Build Information ({buildinfo:1})','colspan'=>2));
                if ($ret["ok"]) {
                        unset($ret["ok"]);
			$ret['versionArray'] = implode('.',$ret['versionArray']);
			
			foreach($ret as $k=>$v){
				$rows[] = array($k,$v);
			}
                }
		echo $this->table->generate($rows);

		echo '<br/>';
		$ret = ini_get_all("mongo");
		$rows = array();
                $this->table->set_heading(array('data'=>'Directives','colspan'=>3));
		$rows[] = array('<b>Directive</b>','<b>Gloval value</b>','<b>Local value</b>');
		foreach($ret as $param=>$value){
                	$rows[] = array($param,$value['global_value'],$value['local_value']);
                }
		echo $this->table->generate($rows);
		?>

		
	</div>
<?php

$this->load->view('footer');

?>