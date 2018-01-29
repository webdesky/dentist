<?php 
		$this->load->view("../../../../common/admin_header");
	  	$this->load->view('patient/common/admin_sidebar');  
	  	$this->load->view("patient/".$body);  
	  	$this->load->view("../../../../common/admin_footer");	 	   
?>
