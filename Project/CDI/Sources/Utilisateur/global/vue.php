<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="description" content="">
		<meta name="author" content="">
        <link rel="stylesheet" href="<?php echo $data['path']; ?>bootstrap/bootstrap.css" />
        <link rel="stylesheet" href="<?php echo $data['path']; ?>bootstrap/bootstrap-responsive.css" />		
        <link rel="stylesheet" href="<?php echo $data['path']; ?>CDI_style.css" />		
		
        <title><?php echo $data['namesite'] . ' - ' . $data['namepage'] ?></title>
		<style type="text/css">
		  body {
			padding-top: 60px;
			padding-bottom: 40px;
		  }
		</style>
    </head>
    <body id="body">
	
		<div class="navbar navbar-inverse navbar-fixed-top">
			<div class="navbar-inner">
				<div class="container">
				  <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				  </a>
					<a class="brand" href="?user">CDI</a>
					<div class="nav-collapse collapse">
						<?php include 'header.php'; ?>
					</div>
				</div>
			</div>
		</div>
		 <div class="container">
	        <header>
	            <?php echo $data['navi']; ?>
	        </header>
	     </div>
        
        <div id="main">
            <?php include($data['page']); ?>
        </div>
		
        <div class="container">
			<footer>
				<p>&copy; Company 2012</p>
			</footer>
		</div>
    </body>
</html>
