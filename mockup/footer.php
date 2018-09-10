<footer>
    <div class="footer-cnt-us">
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center">
                    <h4 class="title white">Contact Us <span class="bdr-btm bdr-blu"> </span></h4>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 text-center">      
                    <div class="icon icon-location pin"></div>
                    <div class="pin-bder-btm"></div>
                    <span class="cmpny-name">Aarna Systems</span>
                    <span class="addr"  itemprop = "address" itemscope itemtype = "http://www.schema.org/PostalAddress">
                        <span> 403, Speciality Business Center,</span>
                        <span itemprop = "streetAddress"> Next to MITCON, Balewadi Rd,</span>
                        <span itemprop = "addressLocality">Balewadi</span>,
                        <span itemprop = "addressRegion"> Pune</span>
                        <span itemprop = "postalCode"> 411045</span>
                        <span itemprop = "addressCountry">INDIA</span>
                    </span>
                </div> 
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="ftr-bdr"></div> 
                </div>
            </div>  
            <div class="row">
                <div class="col-md-12">
                    <ul class="mail-cont">
                        <li class=""><span class="us"></span>
                            <a title="Aarna Systems" href="http://www.aarnasystems.com"></a>
                            <a href="tel:+1 (973) 440-2122" class="clicktocall" onclick="_gaq.push(['_trackEvevt','Contact US','Click to Call', this.innerHTML]);" rel="nofollow">+1 (973) 440-2122 </a>
                    	</li>
                   		<li class=""><span class="ind"></span>
                            <a href="tel:+91 888 885 1177" class="clicktocall" onclick="_gaq.push(['_trackEvevt','Contact US','Click to Call', this.innerHTML]);" rel="nofollow"><span itemprop="telephone">+91 888 885 1177 </span></a>
                    	</li>
                    	<li class=""><span class="skyp"></span>
                            <a href="callto://aarna.systems" rel="nofollow">aarna.systems</a>
                    	</li>
                    	<li class=""><span class="icon mail" data-icon="l"></span>
                    	   <a href="mailto:info@aarnasystems.com">info@aarnasystems.com</a>
                        </li>	
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="footer-cpryt">
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center">
                    <ul class="footer-menu">
                        <li><a href="http://www.aarnasystems.com">Home</a></li>
                        <!-- <li><a href="<?php echo $base_url; ?><?php echo $extra; ?>website-design-portfolio.php">Work</a></li>
                        <li><a href="<?php echo $base_url; ?>about-us.php">About</a></li>
                        <li><a href="<?php echo $base_url; ?>services.php">Services</a></li>
                        <li><a href="http://www.aarnasystems.com/blog/" target="_blank">Blog</a></li>
                        <li><a href="<?php echo $base_url; ?>contact-us.php">Contact</a></li>
                        <li><a href="<?php echo $base_url; ?>privacy-policy.php">Privacy Policy</a></li> -->
                    </ul>	
                    &copy; 2018 <h2><a href="http://www.aarnasystems.com/">Digital Marketing Company</a></h2>
                </div>
            </div>
        </div>
    </div>
</footer>
  
    
 
    
<!----------================================================================================-------------------->
											<!--	JQUERY Start   -->
<!----------================================================================================-------------------->

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="<?php echo $base_url; ?>js/bootstrap.min.js"></script>
    
    
    
    
    
<!--script for header resize on scroll-->      
<script>         
 $(window).scroll(function(){ 
  if ($(this).scrollTop() > 10){  
   // x should be from where you want this to happen from top//
    //make CSS changes here    
	$('.logo').addClass("logo1");
	$('.lo').addClass("lo1");
	$('.fixed-header').addClass("shadow");
  } 
  else{
    //back to default styles
	$('.logo').removeClass("logo1");
	$('.lo').removeClass("lo1");
	$('.fixed-header').removeClass("shadow");
  }
}); 

 wow = new WOW(
    {
      boxClass:     'wow',      // default
      animateClass: 'animated', // default
      offset:       0,          // default
      mobile:       true,       // default
      live:         true        // default
    }
  )
  wow.init();

 
</script> 



<!---------------========================================================================================----------------------->
										<!------Css 3 Animations------------>
<!---------------========================================================================================----------------------->  
<!--<script>
$(document).ready(function(){

$('.repeat').addClass('go');

});
</script>-->
                                      
<!---------------====================================Share it===================================================------------------------->
<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-51931e8036beec85" async="async"></script>
<!---------------=======================================================================================------------------------->	
 <script>
$(document).ready(function() {
$(".btn-gr .btn").click(function () {
    $(".btn-gr .btn").removeClass("acv");
    // $(".tab").addClass("active"); // instead of this do the below 
    $(this).addClass("acv");   
});
$(".port-new .nav-tabs >li>a").click(function () {
    $(".port-new .nav-tabs>li>a").removeClass("acv");
    // $(".tab").addClass("active"); // instead of this do the below 
    $(this).addClass("acv");   
});
});
 </script>
