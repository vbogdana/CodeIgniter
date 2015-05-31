<!-- autor Bogdana -->

<!DOCTYPE html>
<html lang="en-US">

	<?php $this->load->view('templates/include'); ?>	
	
	<!-- Title of the page -->
	<head>
		<title>	Pinboard - <?php echo ($nickname = $this->session->userdata('nickname')) ?> </title>
	</head>
	
	<body onload="">
		
		<!-- Container -->
		<div class="Container">