<?php $this->load->view('admin/_includes/sidemenu'); ?>
	
	<!-- *************************** Page Body ********************************** -->
	<aside class="right-side" ng-controller="quickLinksManagementCTRL">
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
                                <i class="icon icon-Quicklinks" data-name="link" data-size="16" data-loop="true" data-c="#fff" data-hc="white"></i>
                                Edit Quick Link
                            </h3>
                            <span class="pull-right">
                                <a class="txt-white" href="<?= base_url('admin/quicklinks'); ?>">
                                    <i class="icon-Back" data-name="undo" data-size="16" data-loop="true" data-c="#fff" data-hc="white"></i>Back
                                </a>
                            </span>
                        </div>
                        <div class="panel-body">
                            <form class="form-horizontal" name="editQuickLinkForm"  
                                ng-submit="updateQuickLink(editQuickLinkForm.$valid, editQuickLinkForm)" novalidate autocomplete="off">
                                <fieldset>
                                    <!-- <p class="text-center text-danger">* Required fields</p> -->
                                    <div class="form-group">
                                        <label class="col-md-3 control-label" for="link_name">Link Name <span class="text-danger">*</span></label>
                                        <div class="col-md-6">
                                            <input name="link_name" type="text" ng-model="quicklinks.link_name"
                                                placeholder="Link Name" class="form-control"
                                                required>
                                            <span class="text-danger" ng-show="editQuickLinkForm.link_name.$error.required && !editQuickLinkForm.link_name.$pristine">This field is required.</span>
                                        </div>
                                        <div class="col-md-3 text-right text-danger">
                                            <p class="imp-fields">* Required fields</p>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-3 control-label" for="link_address">Link Address <span class="text-danger">*</span></label>
                                        <div class="col-md-6">
                                            <input name="link_address" type="text" ng-model="quicklinks.link_address"
                                                placeholder="Link Address" class="form-control"
                                                ng-pattern="urlPattern" required>
                                            <span class="text-danger" ng-show="editQuickLinkForm.link_address.$error.required && !editQuickLinkForm.link_address.$pristine">This field is required.</span>
                                            <span class="text-danger" ng-show="editQuickLinkForm.link_address.$error.pattern && !editQuickLinkForm.link_address.$pristine">Invaid input.</span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-3 control-label" for="status_id">Status <span class="text-danger">*</span></label>
                                        <div class="col-md-6">
                                            <select class="form-control" name="status_id" ng-model="quicklinks.status_id"
                                                required>
                                                <option value="1">Active</option>
                                                <option value="2">Inactive</option>
                                            </select>
                                            <span class="text-danger" ng-show="editQuickLinkForm.status_id.$error.required && !editQuickLinkForm.status_id.$pristine">This field is required.</span>
                                        </div>
                                    </div>
                                    
                                    <!-- Form actions -->
                                    <div class="form-group">
                                        <div class="col-md-9 text-right">
                                            <md-button class="md-btn-md md-raised md-corner" ng-click="loadQuickLinks();">Cancel</md-button>
                                            <md-button type="submit" 
                                                class="md-btn-md md-raised md-primary md-button md-ink-ripple" 
                                                ng-disabled="editQuickLinkForm.$invalid">Submit</md-button>
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
