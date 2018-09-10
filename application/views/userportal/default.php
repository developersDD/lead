<?php
	// Include header file
	include('includes/header.php');
?>
<section class="main-content">
	<div class="container">
		<div class="row banner-sec">
			<div class="col-md-7">
				<img class="ban" src="<?= base_url(); ?>assets/images/Banner.jpg" alt="Sedemac Banner">
				<p class="banner-text"> <span> Innovative </span> Powertrain Control</p>
			</div>
			<div class="col-md-5">
				<div class="row">
					<div class="col-md-6 tile erp">
						<img class="tile-icon" src="<?= base_url(); ?>assets/images/erp.png" alt="Sedemac ERP">
						<p class="view-erp"> <a class="view-erp" href="#"> View ERP </a> </p>
						<div class="description">
							<span> ERP </span> <br> Enterprise Resource Planning
						</div>
					</div>
					<div class="col-md-6 tile crms">
						<img class="tile-icon" src="<?= base_url(); ?>assets/images/crm.png" alt="Sedemac CRM">
						<p class="view-crm"> <a class="view-crm" href="#"> View CRM </a> </p>
						<div class="description">
							<span> CRM </span> <br> Customer Relationship Management
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-6 tile hrms">
						<img class="tile-icon" src="<?= base_url(); ?>assets/images/hrms.png" alt="Sedemac HRMS">
						<p class="view-hrms"> <a class="view-hrms" href="#"> View HRMS </a> </p>
						<div class="description">
							<span> HRMS </span> <br> Human Resource Management System
						</div>
					</div>
					<div class="col-md-6 tile plm">
						<img class="tile-icon" src="<?= base_url(); ?>assets/images/plm.png" alt="Sedemac PLM">
						<p class="view-plm"> <a class="view-plm" href="#"> View PLM </a> </p>
						<div class="description">
							<span> PLM </span> <br> Product Lifecycle Management
						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="row sec-row second">
			<div class="col-md-6">
				<div class="row">
					<div class="col-md-12">
						<img class="small-image" src="<?= base_url(); ?>assets/images/announce.png" alt="Sedemac Announcement">
						<h6>Latest Announcements</h6>
						<p class="announce" style="width: 509px;">Lorem ipsum dolor sit amet, consectetuer adipiscing aenean commodo ligula. Lorem ipsum amet, consectetuer adipiscing aenean commodo ligula.</p>
						<hr>
						<p class="announce-ptag" style="width: 549px;">Lorem ipsum dolor sit amet, consectetuer adipiscing aenean commodo ligula. Lorem ipsum amet, consectetuer adipiscing aenean commodo ligula. conse adipiscing aenean commodo ligula.</p>
					</div>
				</div>
				<div class="row row-msg">
					<div class="col-md-12">
						<div class="row sec-row msg-row ms">
							<img class="small-image" src="<?= base_url(); ?>assets/images/messages.png" alt="Sedemac Messages">
							<h6>Messages</h6>
							<div class="col-scroll-announce">
								<div class="announce-div-color">
									<div class="col-md-8">
										<p class="announce message">Lorem ipsum dolor sit amet, consectetuer adipiscing aenean commodo ligula. Lorem ipsum amet, consectetuer adipiscing aenean commodo ligula.
										</p>
									</div>
									<div class="col-md-4">
										<span class="mes-date"> 10 June 2017, 01:15 pm </span>
									</div>
								</div>

								<div class="announce-sec-div-color">
									<div class="col-md-8">
										<p class="ptag">Lorem ipsum dolor sit amet, consectetuer adipiscing aenean commodo ligula. Lorem ipsum amet, consectetuer adipiscing aenean commodo ligula. conse adipiscing aenean commodo ligula.
										</p>
									</div>
									<div class="col-md-4">
										<span class="mes-date pad"> 10 June 2017, 01:15 pm </span>
									</div>
								</div>

								<div class="announce-sec-div-color">
									<div class="col-md-8">
										<p class="ptag">Lorem ipsum dolor sit amet, consectetuer adipiscing aenean commodo ligula. Lorem ipsum amet, consectetuer adipiscing aenean commodo ligula. conse adipiscing aenean commodo ligula.
										</p>
									</div>
									<div class="col-md-4">
										<span class="mes-date pad"> 10 June 2017, 01:15 pm </span>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>

			<div class="col-md-4 persons-list-div">
				<img class="small-image" src="<?= base_url(); ?>assets/images/concern_person.png" alt="Sedemac Concern Persons">
				<h6> Concern Persons </h6>
				<div class="row row-person">
					<div class="col-md-12 col-scroll-announce newes">
						<div class="col-per-height">
							<div class="con-name" id="person-names"> <!--all the names start-->
								<img src="<?= base_url();?>assets/images/01.png" alt="Sedemac Person"> Rajesh Kulkarni <span> Admin </span> 
							  	<div id="hover-content"> <!--hover content start-->
							  		<div class="row">
								        <div class="hover-names">
								        	<div class="col-md-4"> 
								        		<img src="<?= base_url();?>assets/images/01.png" alt="Sedemac Person">
								        	</div>
								        	<div class="col-md-8">
								        		<p class="per-name">Rajesh Kulkarni</p>
								        		<p class="per-desig"> Admin </p>
								        		<p class="per-desig">rajesh@sedemac.com</p> 
								        		<p class="per-mob">+91 123 456 7890</p>
								        	</div>
								        </div>
								    </div>
							    </div> <!--hover content close-->
							
								<hr>
								<div class="con-name" id="person-names"> 
									<img src="<?= base_url();?>assets/images/02.png" alt="Sedemac Person">Nikhil Rai <span> HR </span> 
								</div>
								<hr>
								<div class="con-name" id="person-names"> 
									<img src="<?= base_url();?>assets/images/03.png" alt="Sedemac Person">Amit Dixit <span> IT </span> 
								</div>
								<hr>
								<div class="con-name" id="person-names"> 
									<img src="<?= base_url();?>assets/images/01.png" alt="Sedemac Person">Manish Sharma <span> Operation Manager </span> 
								</div>
								<hr>
								<div class="con-name" id="person-names"> 
									<img src="<?= base_url();?>assets/images/01.png" alt="Sedemac Person">Rajesh Sheth <span> Finance </span> 
								</div>
								<hr>
								<div class="con-name" id="person-names"> 
									<img src="<?= base_url();?>assets/images/02.png" alt="Sedemac Person">Nikhil Rai <span> HR </span> 
								</div>
								<hr>
								<div class="con-name" id="person-names"> 
									<img src="<?= base_url();?>assets/images/03.png" alt="Sedemac Person">Amit Dixit <span> IT </span>
								</div>
								<hr>
								<div class="con-name" id="person-names"> 
									<img src="<?= base_url();?>assets/images/01.png" alt="Sedemac Person">Manish Sharma <span> Operation Manager </span> 
								</div>
							</div>  <!--all the names close-->
						</div>	
					</div>
				</div>
			</div>
			<div class="col-md-2 key-docs">
				<img class="small-image" src="<?= base_url(); ?>assets/images/key_doc.png"  alt="Sedemac Key Documents">
				<h6> Key Documents </h6>
				<div class="view-doc"><a href="#"> View Documents</a></div>
				<p>70 Documents</p>
			</div>
		</div>
	</div>
</section>
<?php
	// Include header file
	include('includes/footer.php');
?>