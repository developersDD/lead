<?php $this->load->view('admin/_includes/sidemenu'); ?>
	
	<!-- *************************** Page Body ********************************** -->
	<aside class="right-side" ng-controller="userManagementCTRL">
        <!-- ********************* Page Title ***************** -->
        <section class="content-header">
            <h1><?= $page_title; ?></h1>
            <ol class="breadcrumb">
                <li class="active">
                    <a href="<?= base_url('admin/dashboard'); ?>">
                        <i class="livicon" data-name="home" data-size="16" data-color="#333" data-hovercolor="#333"></i>
                        Dashboard
                    </a>
                </li>
            </ol>
        </section>
        <!-- ********************* /Page Title ***************** -->

        <!-- ********************* Page Content ***************** -->
        <section class="content">
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-primary" id="hidepanel1">
                        <div class="panel-heading">
                            <h3 class="panel-title">
                                <i class="livicon" data-name="user-flag" data-size="16" data-loop="true" data-c="#fff" data-hc="white"></i>
                                User Details
                            </h3>
                            <span class="pull-right">
                                <a class="txt-white" href="<?= base_url('admin/users'); ?>">
                                    <i class="icon-Back" data-name="undo" data-size="16" data-loop="true" data-c="#fff" data-hc="white"></i>Back
                                </a>
                            </span>
                        </div>
                        <div class="panel-body">
                            <form class="form-horizontal" name="userDetailsForm" novalidate autocomplete="off">
                                <fieldset>
                                    
                                    <div class="form-group">
                                        <label class="col-md-3 control-label" for="first_name">First Name</label>
                                        <div class="col-md-6">
                                            <input name="first_name" type="text" ng-model="editUser.first_name"
                                                placeholder="First Name" class="form-control bg-white" ng-disabled="true">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-3 control-label" for="last_name">Last Name</label>
                                        <div class="col-md-6">
                                            <input name="last_name" type="text" ng-model="editUser.last_name"
                                                placeholder="Last Name" class="form-control bg-white" ng-disabled="true">
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label class="col-md-3 control-label" for="email_id">Email ID</label>
                                        <div class="col-md-6">
                                            <input name="email_id" type="text" ng-model="editUser.email_id"
                                                placeholder="Email ID" class="form-control bg-white" ng-disabled="true">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-3 control-label" for="gender_id">Gender</label>
                                        <div class="col-md-6">
                                            <select class="form-control bg-white" ng-disabled="true" name="gender_id" ng-model="editUser.gender_id">
                                                <option value="1">Male</option>
                                                <option value="2">Female</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-3 control-label" for="contact_no">Mobile No.</label>
                                        <div class="col-md-6">
                                            <input name="contact_no" type="text" ng-model="editUser.contact_no"
                                                placeholder="Mobile No." class="form-control bg-white" ng-disabled="true">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-3 control-label" for="status_id">Status</label>
                                        <div class="col-md-6">
                                            <select class="form-control bg-white" ng-disabled="true" name="status_id" ng-model="editUser.status_id">
                                                <option value="1">Active</option>
                                                <option value="2">Inactive</option>
                                            </select>
                                        </div>
                                    </div>
                                    <!-- New columns added-->
                                    <div class="form-group">
                                        <label class="col-md-3 control-label" for="category_id">User Category</label>
                                        <div class="col-md-6">
                                            <select class="form-control bg-white" name="category_id" ng-model="editUser.category_id"
                                                ng-disabled="true">
                                                <option ng-repeat="userCategory in userCategories" value="{{userCategory.id}}" ng-bind="userCategory.category_name"></option>
                                            </select>
                                        </div>
                                    </div>  
                                    <div class="form-group">
                                        <label class="col-md-3 control-label" for="descripton">Desription</label>
                                        <div class="col-md-6">
                                                <textarea ng-model="editUser.descripton" class="form-control bg-white" name="descripton" placeholder="Descripton" ng-disabled="true"></textarea>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-3 control-label" for="date">User Profile</label>
                                        <div class="col-md-4">
                                            <img class="last-upload" ng-src="<?= base_url('site_data/user_profiles/'); ?>{{editUser.user_profile}}" alt="User Profile">
                                        </div>
                                    </div>
                                    <!-- Form actions -->
                                    <div class="form-group">
                                        <div class="col-md-9 text-right">
                                            <md-button class="md-btn-md md-raised md-corner" ng-click="loadUsers();">Cancel</md-button>
                                        </div>
                                    </div>
                                </fieldset>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- ********************* Page Content ***************** -->
    </aside>
	<!-- *************************** /Page Body ********************************** -->

<?php $this->load->view('admin/_includes/footer'); ?>


<!-- +++++++++++++++++++++++++++++++++ Page Level Scripts ++++++++++++++++++++++++++++++++ -->
<?php $this->load->view('form_loader'); ?>
<!-- +++++++++++++++++++++++++++++++++ Page Level Scripts ++++++++++++++++++++++++++++++++ -->


<!-- ++++++++++++++++++ Angular Controllers +++++++++++++++ -->
<script>
    var editUser = JSON.parse('<?= $user_details; ?>');
    var userCategories = JSON.parse('<?= $user_categories; ?>');
</script>
<script src="<?= NGAPP_PATH.'userManagementCTRL.js'; ?>"></script>
<!-- ++++++++++++++++++ /Angular Controllers +++++++++++++++ -->
