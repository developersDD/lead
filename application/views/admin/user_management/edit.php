<?php $this->load->view('admin/_includes/sidemenu'); ?>
	
	<!-- *************************** Page Body ********************************** -->
	<aside class="right-side" ng-controller="userManagementCTRL">
        <!-- ********************* Page Title ***************** -->
        <section class="content-header">
            <h1><?= $page_title; ?></h1>
            <ol class="breadcrumb">
                <li class="active">
                    <a href="<?= base_url('admin/dashboard'); ?>">
                        <i class="icon-Dashboard" data-name="home" data-size="16" data-color="#333" data-hovercolor="#333"></i>
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
                                <i class="icon-Users" data-name="user-flag" data-size="16" data-loop="true" data-c="#fff" data-hc="white"></i>
                                Edit User
                            </h3>
                            <span class="pull-right">
                                <a class="txt-white" href="<?= base_url('admin/users'); ?>">
                                    <i class="icon-Back" data-name="undo" data-size="16" data-loop="true" data-c="#fff" data-hc="white"></i>Back
                                </a>
                            </span>
                        </div>
                        <div class="panel-body">
                            <form class="form-horizontal" name="editUserForm"  
                                ng-submit="updateUser(editUserForm.$valid, editUserForm)" novalidate autocomplete="off">
                                <fieldset>
								<div class="form-group">
                                        <label class="col-md-3 control-label" for="branch_id">Branch <span class="text-danger">*</span></label>
                                        <div class="col-md-6">
                                            <select class="form-control" name="branch_id" ng-model="editUser.branch_id"
                                                required>
												<option selected="selected" value="">--- Select branch ---</option>
                                                <option ng-repeat="branch in branches" value="{{branch.id}}" ng-bind="branch.branch_name"></option>
                                            </select>
                                            <span class="text-danger" ng-show="addUserForm.branch_id.$error.required && !addUserForm.branch_id.$pristine">This field is required.</span>
                                        </div>
                                    </div>                                      

                                    <div class="form-group">
                                        <label class="col-md-3 control-label" for="first_name">First Name <span class="text-danger">*</span></label>
                                        <div class="col-md-6">
                                            <input name="first_name" type="text" ng-model="editUser.first_name"
                                                placeholder="First Name" class="form-control"
                                                ng-pattern="stringPattern" required>
                                            <span class="text-danger" ng-show="editUserForm.first_name.$error.required && !editUserForm.first_name.$pristine">This field is required.</span>
                                            <span class="text-danger" ng-show="editUserForm.first_name.$error.pattern && !editUserForm.first_name.$pristine">Invaid input.</span>
                                        </div>
                                        <div class="col-md-3 text-right text-danger">
                                            <p class="imp-fields">* Required fields</p>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-3 control-label" for="last_name">Last Name <span class="text-danger">*</span></label>
                                        <div class="col-md-6">
                                            <input name="last_name" type="text" ng-model="editUser.last_name"
                                                placeholder="Last Name" class="form-control"
                                                ng-pattern="stringPattern" required>
                                            <span class="text-danger" ng-show="editUserForm.last_name.$error.required && !editUserForm.last_name.$pristine">This field is required.</span>
                                            <span class="text-danger" ng-show="editUserForm.last_name.$error.pattern && !editUserForm.last_name.$pristine">Invaid input.</span>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label class="col-md-3 control-label" for="email_id">Email ID <span class="text-danger">*</span></label>
                                        <div class="col-md-6">
                                            <input name="email_id" type="text" ng-model="editUser.email_id"
                                                placeholder="Email ID" class="form-control"
                                                ng-pattern="emailPattern" required
                                                ng-disabled="true">
                                            <span class="text-danger" ng-show="editUserForm.email_id.$error.required && !editUserForm.email_id.$pristine">This field is required.</span>
                                            <span class="text-danger" ng-show="editUserForm.email_id.$error.pattern && !editUserForm.email_id.$pristine">Invaid input.</span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-3 control-label" for="gender_id">Gender <span class="text-danger">*</span></label>
                                        <div class="col-md-6">
                                            <select class="form-control" name="gender_id" ng-model="editUser.gender_id"
                                                required>
                                                <option value="1">Male</option>
                                                <option value="2">Female</option>
                                            </select>
                                            <span class="text-danger" ng-show="editUserForm.gender_id.$error.required && !editUserForm.gender_id.$pristine">This field is required.</span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-3 control-label" for="contact_no">Mobile No. <span class="text-danger">*</span></label>
                                        <div class="col-md-6">
                                            <input name="contact_no" type="text" ng-model="editUser.contact_no"
                                                placeholder="Mobile No." class="form-control" ng-pattern="mobilePattern" 
                                                ng-maxlength="10" ng-minlength="10" maxlength="10" required
                                                ng-disabled="true">
                                            <span class="text-danger" ng-show="editUserForm.contact_no.$error.required && !editUserForm.contact_no.$pristine">This field is required.</span>
                                            <span class="text-danger" ng-show="editUserForm.contact_no.$error.pattern && !editUserForm.contact_no.$pristine">Invaid input.</span>
                                            <span class="text-danger" ng-show="(editUserForm.contact_no.$error.minlength || editUserForm.contact_no.$error.maxlength) && !editUserForm.contact_no.$error.pattern && !editUserForm.contact_no.$pristine">Mobile no. should be of 10 digit.</span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-3 control-label" for="status_id">Status <span class="text-danger">*</span></label>
                                        <div class="col-md-6">
                                            <select class="form-control" name="status_id" ng-model="editUser.status_id"
                                                required>
                                                <option value="1">Active</option>
                                                <option value="2">Inactive</option>
                                            </select>
                                            <span class="text-danger" ng-show="editUserForm.status_id.$error.required && !editUserForm.status_id.$pristine">This field is required.</span>
                                        </div>
                                    </div>
									<div class="form-group">
                                        <label class="col-md-3 control-label" for="role_id">Role <span class="text-danger">*</span></label>
                                        <div class="col-md-6">
                                            <select class="form-control" name="role_id" ng-model="editUser.role_id"
                                                required>
												<option selected="selected" value="">--- Select role ---</option>
                                                <option ng-repeat="role in roles" value="{{role.id}}" ng-bind="role.name"></option>
                                            </select>
                                            <span class="text-danger" ng-show="editUserForm.role_id.$error.required && !editUserForm.role_id.$pristine">This field is required.</span>
                                        </div>
                                    </div>  
                                    <div class="form-group">
                                        <label class="col-md-3 control-label" for="descripton">Description <span class="text-danger">*</span></label>
                                        <div class="col-md-6">
                                                <textarea ng-model="editUser.descripton" class="form-control" name="descripton" placeholder="Description" required></textarea>
                                            <span class="text-danger" ng-show="editUserForm.descripton.$error.required && !editUserForm.descripton.$pristine">This field is required.</span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-3 control-label" for="date">User Profile <span class="text-danger">*</span></label>
                                        <div class="col-md-3">
                                            <div class="fileinput fileinput-new" data-provides="fileinput">
                                                <div class="fileinput-preview thumbnail" data-trigger="fileinput" style="width: 200px; height: 150px;"></div>
                                                <div>
                                                    <span class="btn btn-default btn-file">
                                                        <span class="fileinput-new">Select image</span>
                                                        <span class="fileinput-exists">Change</span>
                                                        <input type="file" name="img" ng-model="editUser.user_profile" upload-files multiple>
                                                    </span>
                                                    <a href="#" class="btn btn-default fileinput-exists" data-dismiss="fileinput" ng-click="removeFileSelection()">Remove</a>
                                                </div>
                                                <span class="text-danger"><b>Note:</b> .jpg, .jpeg, .png, .gif with file size upto 1 MB is allowed.</span><br>
                                                <span class="text-danger" ng-bind="fileReqVal"></span>
                                            </div>
                                        </div>
                                        <div ng-if="editUser.user_profile">
                                        <label class="col-md-1" for="date">Last Upload</label>
                                        <div class="col-md-2">
                                            <img class="last-upload img-responsive" src="<?= base_url('site_data/user_profiles/'); ?>{{editUser.user_profile}}" alt="User Profile">
                                        </div>
                                        </div>
                                    </div>
                                    
                                    <!-- Form actions -->
                                    <div class="form-group">
                                        <div class="col-md-9 text-right">
                                            <md-button class="md-btn-md md-raised md-corner" ng-click="loadUsers();">Cancel</md-button>
                                            <md-button type="submit" 
                                                class="md-btn-md md-raised md-primary md-button md-ink-ripple" 
                                                ng-disabled="editUserForm.$invalid">Update</md-button>
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
	var roles = JSON.parse('<?= $roles; ?>');
	var branches = JSON.parse('<?= $branches; ?>');
</script>
<script src="<?= NGAPP_PATH.'userManagementCTRL.js'; ?>"></script>
<!-- ++++++++++++++++++ /Angular Controllers +++++++++++++++ -->
