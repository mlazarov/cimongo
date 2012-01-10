<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

$this->load->view('header');

?>
	<h1><?php echo $this->collection;?></h1>

	<div id="body">
		<?php
		var_dump($this->collections[$this->database][$this->collection]['indexes']);
		?>
	</div>

<?php

$this->load->view('footer');

?>