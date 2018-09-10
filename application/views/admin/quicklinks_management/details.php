<?php $this->load->view('admin/_includes/sidemenu'); ?>
	
	<!-- *************************** Page Body ********************************** -->
	<aside class="right-side" ng-controller="quickLinksManagementCTRL">
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
                                <i class="livicon" data-name="message-flag" data-size="16" data-loop="true" data-c="#fff" data-hc="white"></i>
                                Quick Link Details
                            </h3>
                            <span class="pull-right">
                                <a class="txt-white" href="<?= base_url('admin/quicklinks'); ?>">
                                    <i class="icon-Back" data-name="undo" data-size="16" data-loop="true" data-c="#fff" data-hc="white"></i>Back
                                </a>
                            </span>
                        </div>
                        <div class="panel-body">
                            <form class="form-horizontal" name="quicklinkDetailsForm" novalidate autocomplete="off">
                                <fieldset>
                                    <div class="form-group">
                                        <label class="col-md-3 control-label" for="link_name">Link Name</label>
                                        <div class="col-md-6">
                                            <input name="link_name" type="text" ng-model="quicklinks.link_name"
                                                placeholder="Link Name" class="form-control bg-white" ng-disabled="true">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-3 control-label" for="link_address">Link Address</label>
                                        <div class="col-md-6">
                                            <input name="link_address" type="text" ng-model="quicklinks.link_address"
                                                placeholder="Link Address" class="form-control bg-white" ng-disabled="true">
                                        </div>
                                    </div>                                    
                                    <div class="form-group">
                                        <label class="col-md-3 control-label" for="status_id">Status</label>
                                        <div class="col-md-6">
                                            <select class="form-control bg-white" ng-disabled="true" name="status_id" ng-model="quicklinks.status_id">
                                                <option value="1">Active</option>
                                                <option value="2">Inactive</option>
                                            </select>
                                        </div>
                                    </div>
                                    
                                    <!-- Form actions -->
                                    <div class="form-group">
                                        <div class="col-md-9 text-right">
                                            <md-button class="md-btn-md md-raised md-corner" ng-click="loadQuickLinks();">Cancel</md-button>
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
    var quicklinks = JSON.parse('<?= $quicklink_details; ?>');
</script>
<script src="<?= NGAPP_PATH.'quickLinksManagementCTRL.js'; ?>"></script>
<!-- ++++++++++++++++++ /Angular Controllers +++++++++++++++ -->
