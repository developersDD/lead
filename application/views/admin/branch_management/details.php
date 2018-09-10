<?php $this->load->view('admin/_includes/sidemenu'); ?>
	
	<!-- *************************** Page Body ********************************** -->
	<aside class="right-side" ng-controller="branchManagementCTRL">
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
                                Branch Details
                            </h3>
                            <span class="pull-right">
                                <a class="txt-white" href="<?= base_url('admin/branches'); ?>">
                                    <i class="icon-Back" data-name="undo" data-size="16" data-loop="true" data-c="#fff" data-hc="white"></i>Back
                                </a>
                            </span>
                        </div>
                        <div class="panel-body">
                            <form class="form-horizontal" name="branchDetailsForm" novalidate autocomplete="off">
                                <fieldset>
                                    
                                    <div class="form-group">
                                        <label class="col-md-3 control-label" for="branch_name">Branch Name</label>
                                        <div class="col-md-6">
                                            <input name="first_name" type="text" ng-model="editBranch.branch_name"
                                                placeholder="Branch Name" class="form-control bg-white" ng-disabled="true">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-3 control-label" for="branch_code">Branch Code</label>
                                        <div class="col-md-6">
                                            <input name="branch_code" type="text" ng-model="editBranch.branch_code"
                                                placeholder="Branch Code" class="form-control bg-white" ng-disabled="true">
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label class="col-md-3 control-label" for="branch_email">Branch Email</label>
                                        <div class="col-md-6">
                                            <input name="branch_email" type="text" ng-model="editBranch.branch_email"
                                                placeholder="Branch Email Id" class="form-control bg-white" ng-disabled="true">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-3 control-label" for="branch_mobile">Branch Mobile</label>
                                        <div class="col-md-6">
                                            <input name="branch_mobile" type="text" ng-model="editBranch.branch_mobile"
                                                placeholder="Branch Mobile Number" class="form-control bg-white" ng-disabled="true">
                                        </div>
                                    </div>
									<div class="form-group">
                                        <label class="col-md-3 control-label" for="branch_phone">Branch Phone</label>
                                        <div class="col-md-6">
                                            <input name="branch_phone" type="text" ng-model="editBranch.branch_phone"
                                                placeholder="Branch Phone" class="form-control bg-white" ng-disabled="true">
                                        </div>
                                    </div>
									<div class="form-group">
                                        <label class="col-md-3 control-label" for="branch_fax">Branch Fax</label>
                                        <div class="col-md-6">
                                            <input name="branch_fax" type="text" ng-model="editBranch.branch_fax"
                                                placeholder="Branch Fax" class="form-control bg-white" ng-disabled="true">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-3 control-label" for="status_id">Status</label>
                                        <div class="col-md-6">
                                            <select class="form-control bg-white" ng-disabled="true" name="status_id" ng-model="editBranch.status_id">
                                                <option value="1">Active</option>
                                                <option value="2">Inactive</option>
                                            </select>
                                        </div>
                                    </div>
                                    <!-- Form actions -->
                                    <div class="form-group">
                                        <div class="col-md-9 text-right">
                                            <md-button class="md-btn-md md-raised md-corner" ng-click="loadBranches();">Cancel</md-button>
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
