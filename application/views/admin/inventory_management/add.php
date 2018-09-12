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
 <section class="content">
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-primary" id="hidepanel1">
                        <div class="panel-heading">
                            <h3 class="panel-title">
                                <i class="icon icon-Add-User" data-name="user-add" data-size="16" data-loop="true" data-c="#fff" data-hc="white"></i>
                                Add New Product
                            </h3>
                            <span class="pull-right">
                                <a class="txt-white" href="<?= base_url('admin/inventory'); ?>">
                                    <i class="icon-Back" data-name="undo" data-size="16" data-loop="true" data-c="#fff" data-hc="white"></i>Back
                                </a>
                            </span>
                        </div>
                        <div class="panel-body">
                            <form class="form-horizontal" name="addProductForm"
                                ng-submit="addProduct(addProductForm.$valid)" novalidate
                                autocomplete="off">
                                <fieldset>
                                    <!-- <p class="text-center text-danger">* Required fields</p> -->
                                    <!-- <p class="text-center text-danger">* Required fields</p> -->
									<div class="form-group">
                                        <label class="col-md-3 control-label" for="branch_id">Branch <span class="text-danger">*</span></label>
                                        <div class="col-md-6">
                                            <select class="form-control" name="branch_id" ng-model="newProduct.branch_id"
                                                required>
												<option selected="selected" value="">--- Select branch ---</option>
                                                <option ng-repeat="branch in branches" value="{{branch.id}}" ng-bind="branch.branch_name"></option>
                                            </select>
                                            <span class="text-danger" ng-show="addUserForm.branch_id.$error.required && !addUserForm.branch_id.$pristine">This field is required.</span>
                                        </div>
                                    </div>  
                                    <div class="form-group">
                                        <label class="col-md-3 control-label" for="product_name">Product Name <span class="text-danger">*</span></label>
                                        <div class="col-md-6">
                                            <input name="product_name" type="text" ng-model="newProduct.product_name"
                                                placeholder="Product Name" class="form-control"
                                                ng-pattern="stringPattern" required>
                                            <span class="text-danger" ng-show="addProductForm.product_name.$error.required && !addProductForm.product_name.$pristine">This field is required.</span>
                                            <span class="text-danger" ng-show="addProductForm.product_name.$error.pattern && !addProductForm.product_name.$pristine">Invaid input.</span>
                                        </div>
                                        <div class="col-md-3 text-right text-danger">
                                            <p class="imp-fields">* Required fields</p>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-3 control-label" for="branch_code">Model Number <span class="text-danger">*</span></label>
                                        <div class="col-md-6">
                                            <input name="product_model" type="text" ng-model="newProduct.product_model"
                                                placeholder="Model Number" class="form-control"
                                                ng-pattern="stringPattern" required>
                                            <span class="text-danger" ng-show="addProductForm.product_model.$error.required && !addProductForm.product_model.$pristine">This field is required.</span>
                                            <span class="text-danger" ng-show="addProductForm.product_model.$error.pattern && !addProductForm.product_model.$pristine">Invaid input.</span>
                                        </div>
                                    </div> 
                                    <div class="form-group">
                                        <label class="col-md-3 control-label" for="product_price">Price <span class="text-danger">*</span></label>
                                        <div class="col-md-6">
                                            <input name="product_price" type="text" ng-model="newProduct.product_price"
                                                placeholder="Product Price" class="form-control" 
                                                ng-maxlength="10" ng-minlength="2" maxlength="10" required>
                                            <span class="text-danger" ng-show="addProductForm.product_price.$error.required && !addProductForm.product_price.$pristine">This field is required.</span>
                                            <span class="text-danger" ng-show="addProductForm.product_price.$error.pattern && !addProductForm.product_price.$pristine">Invaid input.</span>
                                        </div>
                                    </div>
   
                                    <div class="form-group">
                                        <label class="col-md-3 control-label" for="product_name">Product Description <span class="text-danger">*</span></label>
                                        <div class="col-md-6">
                                            <input name="product_desc" type="text" ng-model="newProduct.product_desc"
                                                placeholder="Product Description" class="form-control"
                                                ng-pattern="stringPattern" required>
                                            <span class="text-danger" ng-show="addProductForm.product_desc.$error.required && !addProductForm.product_desc.$pristine">This field is required.</span>
                                            <span class="text-danger" ng-show="addProductForm.product_desc.$error.pattern && !addProductForm.product_desc.$pristine">Invaid input.</span>
                                        </div>
                                    </div>
                                    
                                    <!-- Form actions -->
                                    <div class="form-group">
                                        <div class="col-md-9 text-right">
                                            <md-button class="md-btn-md md-raised md-corner" ng-click="loadProducts();">Cancel</md-button>
                                            <md-button type="submit" 
                                                class="md-btn-md md-raised md-primary md-button md-ink-ripple" 
												ng-disabled="addProductForm.$invalid">Submit</md-button>
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
var editProduct = {};
var branches = JSON.parse('<?= $branches; ?>');
</script>
<script src="<?= NGAPP_PATH.'inventoryManagementCTRL.js'; ?>"></script>
<!-- ++++++++++++++++++ /Angular Controllers +++++++++++++++ -->
