<?php $this->load->view('admin/_includes/sidemenu'); ?>
	
	<!-- *************************** Page Body ********************************** -->
	<aside class="right-side" ng-controller="branchManagementCTRL">
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
                                Edit Branch
                            </h3>
                            <span class="pull-right">
                                <a class="txt-white" href="<?= base_url('admin/branches'); ?>">
                                    <i class="icon-Back" data-name="undo" data-size="16" data-loop="true" data-c="#fff" data-hc="white"></i>Back
                                </a>
                            </span>
                        </div>
                        <div class="panel-body">
                            <form class="form-horizontal" name="editBranchForm"  
                                ng-submit="updateBranch(editBranchForm.$valid)" novalidate autocomplete="off">
                                <fieldset>
                                    <div class="form-group">
                                        <label class="col-md-3 control-label" for="branch_name">Branch Name <span class="text-danger">*</span></label>
                                        <div class="col-md-6">
                                            <input name="branch_name" type="text" ng-model="editBranch.branch_name"
                                                placeholder="First Name" class="form-control"
                                                ng-pattern="stringPattern" required>
                                            <span class="text-danger" ng-show="editBranchForm.branch_name.$error.required && !editBranchForm.branch_name.$pristine">This field is required.</span>
                                            <span class="text-danger" ng-show="editBranchForm.branch_name.$error.pattern && !editBranchForm.branch_name.$pristine">Invaid input.</span>
                                        </div>
                                        <div class="col-md-3 text-right text-danger">
                                            <p class="imp-fields">* Required fields</p>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-3 control-label" for="branch_code">Branch Code <span class="text-danger">*</span></label>
                                        <div class="col-md-6">
                                            <input name="branch_code" type="text" ng-model="editBranch.branch_code"
                                                placeholder="Branch Code" class="form-control"
                                                ng-pattern="stringPattern" required>
                                            <span class="text-danger" ng-show="editBranchForm.branch_code.$error.required && !editBranchForm.branch_code.$pristine">This field is required.</span>
                                            <span class="text-danger" ng-show="editBranchForm.branch_code.$error.pattern && !editBranchForm.branch_code.$pristine">Invaid input.</span>
                                        </div>
                                    </div>  
                                    
									<div class="form-group">
                                        <label class="col-md-3 control-label" for="branch_email">Branch Email <span class="text-danger">*</span></label>
                                        <div class="col-md-6">
                                            <input name="branch_email" type="text" ng-model="editBranch.branch_email"
                                                placeholder="Email ID" class="form-control"
                                                ng-pattern="emailPattern" required>
                                            <span class="text-danger" ng-show="editBranchForm.branch_email.$error.required && !editBranchForm.branch_email.$pristine">This field is required.</span>
                                            <span class="text-danger" ng-show="editBranchForm.branch_email.$error.pattern && !editBranchForm.branch_email.$pristine">Invaid input.</span>
                                        </div>
                                    </div>

                                     <div class="form-group">
                                        <label class="col-md-3 control-label" for="branch_mobile">Mobile No. <span class="text-danger">*</span></label>
                                        <div class="col-md-6">
                                            <input name="branch_mobile" type="text" ng-model="editBranch.branch_mobile"
                                                placeholder="Mobile No." class="form-control" ng-pattern="mobilePattern" 
                                                ng-maxlength="10" ng-minlength="10" maxlength="10" required>
                                            <span class="text-danger" ng-show="editBranchForm.branch_mobile.$error.required && !editBranchForm.branch_mobile.$pristine">This field is required.</span>
                                            <span class="text-danger" ng-show="editBranchForm.branch_mobile.$error.pattern && !editBranchForm.branch_mobile.$pristine">Invaid input.</span>
                                            <span class="text-danger" ng-show="(editBranchForm.branch_mobile.$error.minlength || editBranchForm.branch_mobile.$error.maxlength) && !editBranchForm.branch_mobile.$error.pattern && !editBranchForm.branch_mobile.$pristine">Mobile no. should be of 10 digit.</span>
                                        </div>
                                    </div>

                                     <div class="form-group">
                                        <label class="col-md-3 control-label" for="branch_phone">Alternate Mobile No. <span class="text-danger">*</span></label>
                                        <div class="col-md-6">
                                            <input name="branch_phone" type="text" ng-model="editBranch.branch_phone"
                                                   placeholder="Alternate Mobile No." class="form-control" ng-pattern="mobilePattern"
                                                   ng-maxlength="10" ng-minlength="10" maxlength="10" required>
                                            <span class="text-danger" ng-show="editBranchForm.branch_phone.$error.required && !editBranchForm.branch_phone.$pristine">This field is required.</span>
                                            <span class="text-danger" ng-show="editBranchForm.branch_phone.$error.pattern && !editBranchForm.branch_phone.$pristine">Invaid input.</span>
                                            <span class="text-danger" ng-show="(editBranchForm.branch_phone.$error.minlength || editBranchForm.branch_phone.$error.maxlength) && !editBranchForm.branch_phone.$error.pattern && !editBranchForm.branch_phone.$pristine">Mobile no. should be of 10 digit.</span>
                                        </div>
                                    </div>

									<div class="form-group">
                                        <label class="col-md-3 control-label" for="branch_fax">Branch Fax No. <span class="text-danger">*</span></label>
                                        <div class="col-md-6">
                                            <input name="branch_fax" type="text" ng-model="editBranch.branch_fax"
                                                   placeholder="Fax No." class="form-control" ng-pattern=""
                                                   ng-maxlength="7" ng-minlength="7" maxlength="7" required>
                                            <span class="text-danger" ng-show="editBranchForm.branch_fax.$error.required && !editBranchForm.branch_fax.$pristine">This field is required.</span>
                                            <span class="text-danger" ng-show="editBranchForm.branch_fax.$error.pattern && !editBranchForm.branch_fax.$pristine">Invaid input.</span>
                                            <span class="text-danger" ng-show="(editBranchForm.branch_fax.$error.minlength || editBranchForm.branch_fax.$error.maxlength) && !editBranchForm.branch_fax.$error.pattern && !editBranchForm.branch_fax.$pristine">Mobile no. should be of 10 digit.</span>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-3 control-label" for="status_id">Status <span class="text-danger">*</span></label>
                                        <div class="col-md-6">
                                            <select class="form-control" name="status_id" ng-model="editBranch.status_id"
                                                required>
                                                <option value="1">Active</option>
                                                <option value="2">Inactive</option>
                                            </select>
                                            <span class="text-danger" ng-show="editBranchForm.status_id.$error.required && !editBranchForm.status_id.$pristine">This field is required.</span>
                                        </div>
                                    </div>
                                    <!-- Form actions -->
                                    <div class="form-group">
                                        <div class="col-md-9 text-right">
                                            <md-button class="md-btn-md md-raised md-corner" ng-click="loadBranches();">Cancel</md-button>
                                            <md-button type="submit" 
                                                class="md-btn-md md-raised md-primary md-button md-ink-ripple" 
                                                ng-disabled="editBranchForm.$invalid">Update</md-button>
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
    var editBranch = JSON.parse('<?= $branch_details; ?>');
</script>
<script src="<?= NGAPP_PATH.'branchManagementCTRL.js'; ?>"></script>
<!-- ++++++++++++++++++ /Angular Controllers +++++++++++++++ -->
