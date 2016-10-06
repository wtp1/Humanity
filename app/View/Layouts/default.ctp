<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8"/>
		<meta name="description" content="" />
		<meta name="keywords" content="" />

		<link rel="stylesheet" type="text/css" href="<?php echo $this->webroot; ?>css/map.css"/>
		<!-- <link rel="stylesheet" type="text/css" href="<?php echo $this->webroot; ?>css/context_menu.css"/> -->
        <link rel="stylesheet" type="text/css" href="<?php echo $this->webroot; ?>css/jquery-ui.min.css"/>
        <link rel="stylesheet" type="text/css" href="<?php echo $this->webroot; ?>css/interface_elements.css"/>

        <script src="<?php echo $this->webroot ?>js/jquery-1.9.1.min.js"></script>
        <script src="<?php echo $this->webroot ?>js/jquery-ui-1.10.2.custom.min.js"></script>
        <script src="<?php echo $this->webroot ?>js/jquery.blockUI.js"></script>

        <script src="<?php echo $this->webroot ?>js/context_menu.js"></script>

		<title>
			<?php if(!empty($this->title)) echo $this->title; else echo 'start app';?>
		</title>
		<?php //ccs, js.. ?>
	</head>
	<body>
		<?php $this->fetch(); ?>
	</body>
</html>
