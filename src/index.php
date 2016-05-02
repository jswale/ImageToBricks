<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>An other brick in the wall</title>
	<meta name="author" content="Jonathan Swale" />
	<meta name="description" content="" />
	<meta name="keywords"  content="" />
	<meta name="Resource-type" content="Document" />
<!-- 	<link href="http://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css"> -->
<!-- 	<link href="http://fonts.googleapis.com/css?family=Lato:400,700,400italic,700italic" rel="stylesheet" type="text/css"> -->
<!-- 	<link rel="stylesheet" type="text/css" href="css/site.css" /> -->
	<style type="text/css">
	body {
		margin:0;
		color:#FFF;
		font-family: "Lato","Helvetica Neue","Helvetica","Arial","sans-serif";
    font-size: 15px;
    background: #2c3e50;
    padding:20px;
	}

	.group:nth-child(odd) {
		background: #2c3e50;
	}
	.group:nth-child(even) {
		background: #233140;
	}

	.group h2 {
		margin:0;
		margin-bottom:20px;
    	text-transform: uppercase;
    	text-decoration: underline;
		font-family: "Montserrat","Helvetica Neue","Helvetica","Arial","sans-serif";
	}

	.form-group {
		display:table;
		margin-bottom: 10px;
	}

	.form-label {
		display: table-cell;
		padding:0px 10px;
		width:250px;
		font-weight: bold;
	}

	.form-field {
		display: table-cell;
		padding:0px 10px;
		border-left:1px solid #FFF;
		width:350px;
	}

	.msg {
		text-align: center;
		font-weight: bold;
		background: #FFF;
		padding:20px;
	}

	</style>

	<!--[if IE]>
		<script type="text/javascript">
			 var console = { log: function() {} };
		</script>
	<![endif]-->

<!-- 	<script type="text/javascript" src="js/site.js"></script> -->
</head>
<body>

<form enctype="multipart/form-data" action="?" method="post">
<input type="hidden" name="MAX_FILE-SIZE" value="30000"/>
	<div class="form-group">
		<div class="form-label">Fichier source :</div>
		<div class="form-input">
			<input type="file" name="file" required="required"/>
		</div>
	</div>
	<div class="form-group">
		<div class="form-label">Taille de la grille :</div>
		<div class="form-input">
			<input type="number" name="gridSize" required="required" value="48" min="1" max="120"/>
		</div>
	</div>
	<div class="form-group">
		<div class="form-label">Couleur :</div>
		<div class="form-input">
			<select name="palette">
				<option value="default">Classique</option>
				<option value="full">Complète</option>
			</select>
		</div>
	</div>
	<div>
		<input type="submit" name="Valider"/>
	</div>
</form>

<div>
<?php
include_once "ImageToBricks.class.php";

if(isset($_FILES["file"])) {
	$builder = new ImageToBricks($_POST["palette"]);
	$image = $builder->pixelate($_FILES["file"]["tmp_name"], $_POST["gridSize"]);

	$output = 'output/output.png';
	imagepng($image, $output);
	imagedestroy($image);

	echo "<img src='$output'/>";
}
?>
</div>

</body>
</html>
