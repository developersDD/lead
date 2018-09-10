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
                                <i class="icon icon-Add-New-Document" data-name="folder-add" data-size="16" data-loop="true" data-c="#fff" data-hc="white"></i>
                                Add New Document
                            </h3>
                            <span class="pull-right">
                                <a class="txt-white" href="<?= base_url('admin/documents'); ?>">
                                    <i class="icon-Back" data-name="undo" data-size="16" data-loop="true" data-c="#fff" data-hc="white"></i>Back
                                </a>
                            </span>
                        </div>
                        <div class="panel-body">
                            <form class="form-horizontal" name="addDocumentForm" 
                                ng-submit="addDocument(addDocumentForm.$valid, addDocumentForm)" novalidate 
                                autocomplete="off">
                                <fieldset>
                                    <!-- <p class="text-center text-danger">* Required fields</p> -->

                                    <div class="form-group">
                                        <label class="col-md-3 control-label" for="document_title">Document Title <span class="text-danger">*</span></label>
                                        <div class="col-md-6">
                                            <input name="document_title" type="text" ng-model="newDocument.document_title"
                                                placeholder="Document Title" class="form-control"
                                                ng-pattern="stringPattern" required>
                                            <span class="text-danger" ng-show="addDocumentForm.document_title.$error.required && !addDocumentForm.document_title.$pristine">This field is required.</span>
                                            <span class="text-danger" ng-show="addDocumentForm.document_title.$error.pattern && !addDocumentForm.document_title.$pristine">Invaid input.</span>
                                        </div>
                                        <div class="col-md-3 text-right text-danger">
                                            <p class="imp-fields">* Required fields</p>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                            <label class="col-md-3 control-label" for="name">Document <span class="text-danger">*</span></label>
                                            <div class="col-md-6">
                                                <div class="fileinput fileinput-new input-group" data-provides="fileinput">
                                                    <div class="form-control" data-trigger="fileinput">
                                                        <i class="glyphicon glyphicon-file fileinput-exists"></i>
                                                        <span class="fileinput-filename"></span>
                                                    </div>
                                                    <span class="input-group-addon btn btn-default btn-file btn-select">
                                                        <span class="fileinput-new">Select file</span>
                                                        <span class="fileinput-exists">Change</span>
                                                        <input type="file" name="document_url" ng-model="newDocument.document_url" upload-files ></span>
                                                    <a href="#" class="input-group-addon btn btn-default fileinput-exists" data-dismiss="fileinput" ng-click="removeFileSelection()">Remove</a>
                                                </div>
                                                <span class="text-danger"><b>Note:</b> .doc, .docx, .pdf with file size upto 10 MB is allowed.</span><br>
                                                <span class="text-danger" ng-bind="fileReqVal"></span>
                                            </div>
                                        </div>
                                    <div class="form-group">
                                        <label class="col-md-3 control-label" for="category_id">Document Category <span class="text-danger">*</span></label>
                                        <div class="col-md-6">
                                            <select class="form-control" name="category_id" ng-model="newDocument.category_id"
                                                required>
                                                <option ng-repeat="documentCategory in documentCategories" value="{{documentCategory.id}}" ng-bind="documentCategory.category_name"></option>
                                            </select>
                                            <span class="text-danger" ng-show="addDocumentForm.category_id.$error.required && !addDocumentForm.category_id.$pristine">This field is required.</span>
                                        </div>
                                    </div>  

                                    <div class="form-group">
                                        <label class="col-md-3 control-label" for="is_downloadable">Downloadable <span class="text-danger">*</span></label>
                                        <div class="col-md-9">
                                            <select class="form-control" name="is_downloadable" ng-model="newDocument.is_downloadable"
                                                required>
                                                <option value="1">Yes</option>
                                                <option value="2">No</option>
                                            </select>
                                            <span class="text-danger" ng-show="addQuickLinkForm.is_downloadable.$error.required && !addQuickLinkForm.is_downloadable.$pristine">This field is required.</span>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-3 control-label" for="status_id">Status <span class="text-danger">*</span></label>
                                        <div class="col-md-6">
                                            <select class="form-control" name="status_id" ng-model="newDocument.status_id"
                                                required>
                                                <option value="1">Active</option>
                                                <option value="2">Inactive</option>
                                            </select>
                                            <span class="text-danger" ng-show="addQuickLinkForm.status_id.$error.required && !addQuickLinkForm.status_id.$pristine">This field is required.</span>
                                        </div>
                                    </div>
                                    
                                    <!-- Form actions -->
                                    <div class="form-group">
                                        <div class="col-md-9 text-right">
                                            <md-button class="md-btn-md md-raised md-corner" ng-click="loadDocuments();">Cancel</md-button>
                                            <md-button type="submit" 
                                                class="md-btn-md md-raised md-primary md-button md-ink-ripple" 
                                                ng-disabled="addDocumentForm.$invalid">Submit</md-button>
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
<script> var editDocument = {};
var documentCategories = JSON.parse('<?= $document_categories; ?>');
</script>
<script src="<?= NGAPP_PATH.'documentManagementCTRL.js'; ?>"></script>
<!-- ++++++++++++++++++ /Angular Controllers +++++++++++++++ -->
