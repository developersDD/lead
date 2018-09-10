<?php $this->load->view('admin/_includes/sidemenu'); ?>
	
	<!-- *************************** Page Body ********************************** -->
	<aside class="right-side" ng-controller="documentManagementCTRL">
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
                                <i class="icon icon-Document-List" data-name="folder-flag" data-size="16" data-loop="true" data-c="#fff" data-hc="white"></i>
                                Document Details
                            </h3>
                            <span class="pull-right">
                                <a class="txt-white" href="<?= base_url('admin/documents'); ?>">
                                    <i class="icon-Back" data-name="undo" data-size="16" data-loop="true" data-c="#fff" data-hc="white"></i>Back
                                </a>
                            </span>
                        </div>
                        <div class="panel-body">
                            <form class="form-horizontal" name="documentDetailsForm" novalidate autocomplete="off">
                                <fieldset>
                                    
                                    <div class="form-group">
                                        <label class="col-md-3 control-label" for="document_title">Document Title</label>
                                        <div class="col-md-6">
                                            <input name="document_title" type="text" ng-model="editDocument.document_title"
                                                placeholder="Document Title" class="form-control bg-white" ng-disabled="true">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-3 control-label" for="document_url">Document</label>
                                        <div class="col-md-6">
                                            <a name="document_url" ng-href="<?= base_url('site_data/documents/'); ?>{{editDocument.document_url}}" placeholder="Document" target="_blank" ng-bind="editDocument.document_url"></a>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label class="col-md-3 control-label" for="category_id">Document Category</label>
                                        <div class="col-md-6">
                                            <select class="form-control bg-white" name="category_id" ng-model="editDocument.category_id"
                                                ng-disabled="true" required>
                                                <option ng-repeat="documentCategory in documentCategories" value="{{documentCategory.id}}" ng-bind="documentCategory.category_name"></option>
                                            </select>
                                        </div>
                                    </div> 

                                    <div class="form-group">
                                        <label class="col-md-3 control-label" for="is_downloadable">Downloadable</label>
                                        <div class="col-md-6">
                                            <select class="form-control bg-white" ng-disabled="true" name="is_downloadable" ng-model="editDocument.is_downloadable">
                                                <option value="1">Yes</option>
                                                <option value="2">No</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-3 control-label" for="status_id">Status</label>
                                        <div class="col-md-6">
                                            <select class="form-control bg-white" ng-disabled="true" name="status_id" ng-model="editDocument.status_id">
                                                <option value="1">Active</option>
                                                <option value="2">Inactive</option>
                                            </select>
                                        </div>
                                    </div>
                                   
                                    <!-- Form actions -->
                                    <div class="form-group">
                                        <div class="col-md-9 text-right">
                                            <md-button class="md-btn-md md-raised md-corner" ng-click="loadDocuments();">Cancel</md-button>
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
    var editDocument = JSON.parse('<?= $document_details; ?>');
    var documentCategories = JSON.parse('<?= $document_categories; ?>');
</script>
<script src="<?= NGAPP_PATH.'documentManagementCTRL.js'; ?>"></script>
<!-- ++++++++++++++++++ /Angular Controllers +++++++++++++++ -->
