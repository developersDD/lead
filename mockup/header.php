<?php 

if ($_SERVER["HTTP_HOST"] === 'localhost') {
    $base_url="http://localhost/ci/sedemac/mockup/";

} else if ($_SERVER["HTTP_HOST"] === 'development.aarnaapps.com') {
  $base_url="https://development.aarnaapps.com/sedemac/mockup/";
}

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
       
        <title><?php echo $pageTitle; ?></title>
    	<link rel="shortcut icon" type="image/png" href="<?php echo $base_url; ?>img/favicon.ico">
        <!-- Bootstrap -->
        <link href="<?php echo $base_url; ?>css/bootstrap.min.css" rel="stylesheet" />
        <link href='https://fonts.googleapis.com/css?family=Six+Caps' rel='stylesheet' type='text/css'>
        <link href='https://fonts.googleapis.com/css?family=Open+Sans+Condensed:300,300italic,700' rel='stylesheet' type='text/css'>
        <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,300,300italic,400italic,600,600italic,700,700italic,800,800italic' rel='stylesheet' type='text/css'>
    	  <link href="<?php echo $base_url; ?>css/custom.css" rel="stylesheet" />
        <link href="<?php echo $base_url; ?>css/font-awesome.min.css" rel="stylesheet" />
	
        
    </head>
    
    <body>
 

