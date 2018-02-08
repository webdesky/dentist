<?php 
	$this->load->view("../../../../common/admin_header");
  	$this->load->view('doctor/common/admin_sidebar');
  	$this->load->view("doctor/".$body);
  	$this->load->view("../../../../common/admin_footer");
?>
	  	