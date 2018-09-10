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
        <section class="content data-table-custom">
            <div class="row" ng-init="getDocuments()">
                <div class="col-lg-12">
                    <div class="panel panel-success filterable panel-scroll1" >
                        <div class="panel-heading">
                        	<div class="row">
                        		<div class="col-md-6">
                        			<h3 class="panel-title displY-in">
                                 		<i class="icon icon-Document-List" data-name="folder-open" data-size="16" data-loop="true" data-c="#fff" data-hc="white"></i> Document List
                            		</h3>
                        		</div>
                        		<div class="col-md-6 text-right	">
                                    <md-button class="md-btn-sm md-raised md-corner add-user-btn" ng-click="loadAddDocument();"> Add Document </md-button>
                        		</div>
                        	</div>
                        </div>
                        <div class="panel-body">
                            <table class="table table-striped table-bordered"  datatable="ng" dt-options="dtOptions">
                                <thead>
                                    <tr>
                                        <th>Sr. No.</th>
                                        <th>Document Title</th>
                                        <th>Document</th>
                                        <th>Document Category</th>
                                        <th>Downloadable</th>
                                        <th>Status</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr ng-repeat="row in documents">
                                        <td><span ng-bind="$index+1"></span></td>
                                        <td><span ng-bind="row.document_title"></span></td>
                                        <td>
                                        <a name="document_url" ng-href="<?= base_url('site_data/documents/'); ?>{{row.document_url}}" placeholder="Document" target="_blank" ng-bind="row.document_url"></a></td>
                                        <td><span ng-bind="row.category_name"></span></td>
                                        <td>
                                            <md-button class="md-btn-sm md-raised md-corner" 
                                                ng-class="{'md-success':row.is_downloadable==1,'md-danger':row.is_downloadable==2}"
                                                ng-click="showDownloadableConfirm($event, row)" 
                                                ng-bind="row.is_downloadable==1?'Yes':'No'">
                                            </md-button>
                                        </td>
                                        <td>
                                            <md-button class="md-btn-sm md-raised md-corner" 
                                                ng-class="{'md-success':row.status_id==1,'md-danger':row.status_id==2}"
                                                ng-click="showStatusConfirm($event, row)" 
                                                ng-bind="row.status_id==1?'Active':'Inactive'">
                                            </md-button>
                                        </td>
                                        <td>
                                            <div class="button-dropdown" data-buttons="dropdown">
                                                <md-button class="md-btn-sm md-raised md-primary md-button md-ink-ripple action-btn">
                                                    Actions
                                                    <i class="fa fa-caret-down"></i>
                                                </md-button>
                                                <ul class="button-dropdown-menu-below" style="display: none;">
                                                    <li>
                                                        <a class="" href="<?= base_url('admin/documents/details/'); ?>{{row.id}}">
                                                            View Details
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a class="" href="<?= base_url('admin/documents/edit/'); ?>{{row.id}}">
                                                            Edit Details
                                                        </a>
                                                    </li>
                                                    <li class="button-dropdown-divider">
                                                        <!-- <?= base_url('admin/documents/delete/'); ?>{{row.id}}-->
                                                        <a class="" href="javascript:;" ng-click="showDeleteConfirm($event, row.id)">
                                                            Delete
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
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

<!-- +++++++++++++++++++++++++++++++++ Page Level Scripts ++++++++++++++++++++++++++++++++ -->


<!-- ++++++++++++++++++ Angular Controllers +++++++++++++++ -->
<script> var editDocument = {};
var documentCategories = {}; </script>
<script src="<?= NGAPP_PATH.'documentManagementCTRL.js'; ?>"></script>
<!-- ++++++++++++++++++ /Angular Controllers +++++++++++++++ -->
