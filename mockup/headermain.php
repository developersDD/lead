<?php 

if ($_SERVER["HTTP_HOST"] === 'localhost') {
    $base_url="http://localhost/ci/sedemac/mockup/";

} else if ($_SERVER["HTTP_HOST"] === 'development.aarnaapps.com') {
  $base_url="https://development.aarnaapps.com/sedemac/mockup/";
}

// $base_url='http://localhost/wordpress/cambridge-international/mockup/';

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
        <link href="<?php echo $base_url; ?>/css/bootstrap.min.css" rel="stylesheet" />
        <link href="<?php echo $base_url; ?>/css/custom.css" rel="stylesheet" />
        <link href='https://fonts.googleapis.com/css?family=Six+Caps' rel='stylesheet' type='text/css'>
        <link href='https://fonts.googleapis.com/css?family=Open+Sans+Condensed:300,300italic,700' rel='stylesheet' type='text/css'>
        <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,300,300italic,400italic,600,600italic,700,700italic,800,800italic' rel='stylesheet' type='text/css'>
    	  <link href="<?php echo $base_url; ?>custom.css" rel="stylesheet" />
        <link href="<?php echo $base_url; ?>css/font-awesome.min.css" rel="stylesheet" />
	    <style>
            .logo1{display:none;}
            .lo{display:none;}
            .lo1{display:block;}
            .shadow{box-shadow: 0 0 2px 1px #999;}
        </style>
        <!--- DO NOT DELETE: Facebook Pixel Code END-->
    </head>
    
    <body>
 
        <!--=================================Menu=================================================--> 
   
        <header class="fixed-header">  
            <div class="container">  
                <div class="hdr"> 
                    <div class="row">
                        <div class="hdr-pd">
                     	</div>
                 		<div class="logo-wrap">
                            <div class="text-center">
                                <a href="<?php echo $base_url; ?>index.php" class="text-center logo-img">
                                    <img class="img-responsive logo " alt="Aarna Systems Logo" src="<?php echo $base_url; ?>img/logo.png"/>	
                                    <img class="img-responsive lo" alt="Aarna Systems Logo" src="<?php echo $base_url; ?>img/aarna_logo.png"/>
                                </a>
                            </div>            
                        </div>
                        <div class="hdr-pdd hidden-xs hidden-sm">
                 	        
                 </div>
                 <div class="hdr-pd1 visible-xs visible-sm">
                 	<ul class="heder-right list-unstyled list-inline">
                    	
                        <li>
                        	<a class="btn-call cnt-now clicktocall" href="tel:+91 888 885 1177" onclick="_gaq.push(['_trackEvevt','Contact US','Click to Call', this.innerHTML]);" rel="nofollow"><span class="pho"><i class="fa fa-phone"></i></span>Call</a>
                            
                        </li>
                        
                    </ul>
                 </div>	
			</div>	
    	</div>
	</div>
</header>

