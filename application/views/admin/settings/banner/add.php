<?php $this->load->view('admin/_includes/sidemenu'); ?>
	
	<!-- *************************** Page Body ********************************** -->
	<aside class="right-side" ng-controller="bannerManagementCTRL">
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
                                <i class="livicon" data-name="clock" data-size="16" data-loop="true" data-c="#fff" data-hc="white"></i>
                                Add New Banner
                            </h3>
                            <span class="pull-right">
                                <a class="txt-white" href="<?= base_url('admin/settings/banner'); ?>">
                                    <i class="icon-Back" data-name="undo" data-size="16" data-loop="true" data-c="#fff" data-hc="white"></i>Back
                                </a>
                            </span>
                        </div>
                        <div class="panel-body">
                            <form class="form-horizontal" name="addBannerForm" 
                                ng-submit="addBanner(addBannerForm.$valid, addBannerForm)" novalidate 
                                autocomplete="off">
                                <fieldset>
                                    <!-- <p class="text-center text-danger">* Required fields</p> -->
                                    <div class="form-group">
                                        <label class="col-md-3 control-label" for="banner_name">Banner Name <span class="text-danger">*</span></label>
                                        <div class="col-md-6">
                                            <input name="banner_name" type="text" ng-model="newBanner.banner_name"
                                                placeholder="Banner Name" class="form-control"
                                                required>
                                            <span class="text-danger" ng-show="addBannerForm.banner_name.$error.required && !addBannerForm.banner_name.$pristine">This field is required.</span>
                                        </div>
                                        <div class="col-md-3 text-right text-danger">
                                            <p class="imp-fields">* Required fields</p>
                                        </div>
                                    </div>                                   
                                    <div class="form-group">
                                        <label class="col-md-3 control-label" for="date">Banner Image <span class="text-danger">*</span></label>
                                        <div class="col-md-4">
                                            <div class="fileinput fileinput-new" data-provides="fileinput">
                                                <div class="fileinput-preview thumbnail" data-trigger="fileinput" style="width: 200px; height: 150px;"></div>
                                                <div>
                                                    <span class="btn btn-default btn-file">
                                                        <span class="fileinput-new">Select image</span>
                                                        <span class="fileinput-exists">Change</span>
                                                        <input type="file" name="banner_image" ng-model="newBanner.banner_image" upload-files multiple>
                                                    </span>
                                                    <a href="#" class="btn btn-default fileinput-exists" data-dismiss="fileinput" ng-click="removeFileSelection()">Remove</a>
                                                </div>
                                                <span class="text-danger"><b>Note:</b> .jpg, .jpeg, .png, .gif with file size upto 1 MB is allowed.</span><br>
                                                <span class="text-danger" ng-bind="fileReqVal"></span>
                                            </div>
                                        </div>
                                    </div>                                    
                                    <!--<div class="form-group">
                                        <label class="col-md-3 control-label" for="status_id">Status <span class="text-danger">*</span></label>
                                        <div class="col-md-9">
                                            <select class="form-control" name="status_id" ng-model="newBanner.status_id"
                                                required>
                                                <option value="1">Active</option>
                                                <option value="2">Inactive</option>
                                            </select>
                                            <span class="text-danger" ng-show="addBannerForm.status_id.$error.required && !addBannerForm.status_id.$pristine">This field is required.</span>
                                        </div>
                                    </div>-->
                                    
                                    
                                    <!-- Form actions -->
                                    <div class="form-group">
                                        <div class="col-md-9 text-right">
                                            <md-button class="md-btn-md md-raised md-corner" ng-click="loadBanners();">Cancel</md-button>
                                            <md-button type="submit" 
                                                class="md-btn-md md-raised md-primary md-button md-ink-ripple" 
                                                ng-disabled="addBannerForm.$invalid">Submit</md-button>
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
<script> var editbanner = {};</script>
<script src="<?= NGAPP_PATH.'bannerManagementCTRL.js'; ?>"></script>
<!-- ++++++++++++++++++ /Angular Controllers +++++++++++++++ -->
