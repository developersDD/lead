<?php $this->load->view('admin/_includes/sidemenu'); ?>
	
	<!-- *************************** Page Body ********************************** -->
	<aside class="right-side" ng-controller="inventoryManagementCTRL">
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
            <div class="row" ng-init="getProducts()">
                <div class="col-lg-12">
                    <div class="panel panel-success filterable panel-scroll1">
                        <div class="panel-heading">
                        	<div class="row">
                        		<div class="col-md-6">
                        			<h3 class="panel-title displY-in">
                                 		<i class="icon-User-List" data-name="products" data-size="16" data-loop="true" data-c="#fff" data-hc="white"></i> Product List
                            		</h3>
                        		</div>
                        		<div class="col-md-6 text-right	">
                                    <md-button class="md-btn-sm md-raised md-corner add-user-btn" ng-click="loadAddProduct();">
                                     Add Product </md-button>

                        		</div>
                        	</div>
                        </div>
                        <div class="panel-body">
                            <table class="table table-striped table-bordered"  datatable="ng" dt-options="dtOptions">
                                <thead>
                                    <tr>
										<th>Sr. No.</th>
										<th>Branch Name.</th>
                                        <th>Product Name</th>
                                        <th>Model Number</th>
                                        <th>Price</th>
                                        <th>Description</th>
                                        <th>Avalaible</th>
                                        <th>Status</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr ng-repeat="row in products">
                                        <td><span ng-bind="$index+1"></span></td>
                                        <td><span ng-bind="row.branch_name"></span></td>
                                        <td><span ng-bind="row.product_name"></span></td>
                                        <td><span ng-bind="row.model_no"></span></td>
										<td><span ng-bind="row.price"></span></td>
										<td><span ng-bind="row.description"></span></td>
										<td><span ng-bind="row.available == 1 ? 'Yes' : 'No'"></span></td>
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
                                                    <i class="fa fa-caret-down fa-margin"></i>
                                                </md-button>
                                                <ul class="button-dropdown-menu-below" style="display: none;">
                                                    <li>
                                                        <a class="" href="<?= base_url('admin/inventory/details/'); ?>{{row.id}}">
                                                            View Details
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a class="" href="<?= base_url('admin/inventory/edit/'); ?>{{row.id}}">
                                                            Edit Details
                                                        </a>
                                                    </li>
                                                    <li class="button-dropdown-divider">
                                                        <!-- <?= base_url('admin/inventory/delete/'); ?>{{row.id}}-->
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
<script> 
var editBranch = {};
var branches = {};
</script>
<script src="<?= NGAPP_PATH.'inventoryManagementCTRL.js'; ?>"></script>
<!-- ++++++++++++++++++ /Angular Controllers +++++++++++++++ -->
