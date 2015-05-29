

<!DOCTYPE html>
<html lang="en-US">

	<?php $this->load->view('templates/include'); ?>	
	
	<!-- Title of the page -->
	<head>
		<title>	Pinboard - <?php echo ($nickname = $this->session->userdata('nickname')) ?> </title>
	</head>
	
	<body onload="javascript:fg_hideform('fg_formContainer','fg_backgroundpopup');">
		
		<!-- Container -->
		<div class="Container">