<?php $this->load->view('admin/_includes/sidemenu'); ?>

	<!-- *************************** Page Body ********************************** -->
	<aside class="right-side" ng-controller="documentManagementCTRL">
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
                                <i class="icon icon-Documents" data-name="folder-flag" data-size="16" data-loop="true" data-c="#fff" data-hc="white"></i>
                                Edit Document
                            </h3>
                            <span class="pull-right">
                                <a class="txt-white" href="<?= base_url('admin/documents'); ?>">
                                    <i class="icon-Back" data-name="undo" data-size="16" data-loop="true" data-c="#fff" data-hc="white"></i>Back
                                </a>
                            </span>
                        </div>
                        <div class="panel-body">
                            <form class="form-horizontal" name="editDocumentForm"  
                                ng-submit="updateDocument(editDocumentForm.$valid, editDocumentForm)" novalidate autocomplete="off">
                                <fieldset>
                                    <!-- <p class="text-center text-danger">* Required fields</p> -->
                                    <div class="form-group">
                                        <label class="col-md-3 control-label" for="document_title">Document Title <span class="text-danger">*</span></label>
                                        <div class="col-md-6">
                                            <input name="document_title" type="text" ng-model="editDocument.document_title"
                                                placeholder="First Name" class="form-control"
                                                required>
                                            <span class="text-danger" ng-show="editDocumentForm.document_title.$error.required && !editDocumentForm.document_title.$pristine">This field is required.</span>
                                        </div>
                                        <div class="col-md-3 text-right text-danger">
                                            <p class="imp-fields">* Required fields</p>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                            <label class="col-md-3 control-label" for="document_url">Document <span class="text-danger">*</span></label>
                                            <div class="col-md-6">
                                                <div class="fileinput input-group" ng-class="{'fileinput-new':editDocument.document_url=='','fileinput-exists':editDocument.document_url!=''}" data-provides="fileinput">
                                                    <div class="form-control" data-trigger="fileinput">
                                                        <i class="glyphicon glyphicon-file fileinput-exists"></i>
                                                        <span class="fileinput-filename" ng-bind="editDocument.document_url"></span>
                                                    </div>
                                                    <span class="input-group-addon btn btn-default btn-file">
                                                        <span class="fileinput-new">Select file</span>
                                                        <span class="fileinput-exists">Change</span>
                                                        <input type="file" name="document_url" ng-model="editDocument.document_url" upload-files></span>
                                                    <a href="#" class="input-group-addon btn btn-default fileinput-exists" data-dismiss="fileinput" ng-click="removeFileSelection()">Remove</a>
                                                </div>
                                                <span class="text-danger"><b>Note:</b> .doc, .docx, .pdf with file size upto 10 MB is allowed.</span><br>
                                                <span class="text-danger" ng-bind="fileReqVal"></span>
                                            </div>
                                        </div>

                                    <div class="form-group">
                                        <label class="col-md-3 control-label" for="category_id">Document Category <span class="text-danger">*</span></label>
                                        <div class="col-md-6">
                                            <select class="form-control" name="category_id" ng-model="editDocument.category_id"
                                                required>
                                                <option ng-repeat="documentCategory in documentCategories" value="{{documentCategory.id}}" ng-bind="documentCategory.category_name"></option>
                                            </select>
                                            <span class="text-danger" ng-show="editDocumentForm.category_id.$error.required && !editDocumentForm.category_id.$pristine">This field is required.</span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-3 control-label" for="is_downloadable">Downloadable <span class="text-danger">*</span></label>
                                        <div class="col-md-6">
                                            <select class="form-control" name="is_downloadable" ng-model="editDocument.is_downloadable"
                                                required>
                                                <option value="1">Yes</option>
                                                <option value="2">No</option>
                                            </select>
                                            <span class="text-danger" ng-show="editDocumentForm.is_downloadable.$error.required && !editDocumentForm.is_downloadable.$pristine">This field is required.</span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-3 control-label" for="status_id">Status <span class="text-danger">*</span></label>
                                        <div class="col-md-6">
                                            <select class="form-control" name="status_id" ng-model="editDocument.status_id"
                                                required>
                                                <option value="1">Active</option>
                                                <option value="2">Inactive</option>
                                            </select>
                                            <span class="text-danger" ng-show="editDocumentForm.status_id.$error.required && !editDocumentForm.status_id.$pristine">This field is required.</span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-md-9 text-right">
                                            <md-button class="md-btn-md md-raised md-corner" ng-click="loadDocuments();">Cancel</md-button>
                                            <md-button type="submit" 
                                                class="md-btn-md md-raised md-primary md-button md-ink-ripple" 
                                                ng-disabled="editDocumentForm.$invalid">Update</md-button>
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
