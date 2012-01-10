<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>CiMongo::<?php echo $this->title;?></title>
	<link href="<?php echo site_url('css/bootstrap.css');?>" rel="stylesheet" media="screen">
	<link href="<?php echo site_url('css/style.css');?>" rel="stylesheet" type="text/css" media="screen">
	
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.4/jquery.min.js" type="text/javascript"></script>
	<script src="<?php echo site_url('js/bootstrap-dropdown.js');?>" type="text/javascript"></script>
	<script src="<?php echo site_url('js/bootstrap-buttons.js');?>" type="text/javascript"></script>
</head>
<body>

	<div class="topbar">
	  <div class="fill">
	    <div class="container">
	      <a class="brand" href="<?php echo site_url();?>">CiMongo</a>
	      <ul class="nav">
	      	<li class="dropdown" data-dropdown="dropdown" >
	      		<a href="#" class="dropdown-toggle"><span class="icon-server"></span>Server <?php if(isset($this->server)) echo '('.$this->server.')';?></a>
	      		<ul class="dropdown-menu">
	      			<?php
	      			$mongo_servers = $this->config->item('mongo');
					$current_server = isset($this->server)?$this->server:false;
					foreach($mongo_servers as $name=>$config){
						echo '<li><a href="'.site_url('db/'.$name.'/').'"'.($name == $current_server?' class="active"':'').'>'.$name.'</a></li>';
					}
	      			?>
			    </ul>
	      	</li>
	      </ul>
	      <div class="pull-right">
		      <ul class="nav">
		        <li><a href="<?php echo site_url('contact');?>">Contact</a></li>
		        <li><a href="<?php echo site_url('about');?>">About</a></li>
		      </ul>
	     </div>
	    </div>
	  </div>
	</div>
	<div class="container-fluid">
		<?php
		if(isset($this->databases) && $this->databases){?>
		<div class="sidebar" style="border: 0px solid red;">
			<ul class="databases">
			<?php
			foreach($this->databases as $dbname=>$dbsize){
				echo '<li class="database"'.($dbname==$this->database?'style="font-weight:bold;"':'').'><a href="'.site_url('db/'.$this->server.'/'.$dbname).'">'.$dbname.'</a>';
				if($dbname==$this->database && isset($this->collections[$dbname])){
					echo '<ul class="collections">';
					foreach($this->collections[$dbname] as $colname=>$colsize){
						echo '<li class="collection"'.($colname==$this->collection?'style="font-weight:bold;"':'').'><a href="'.site_url('db/'.$this->server.'/'.$dbname.'/'.$colname).'">'.$colname."</a></li>\n";
					}
					echo "</ul>\n";
					
				}
				
				echo "</li>\n";
			}
			?>
			</ul>
		</div>
		<?php } ?>
		<div class="content">