<?php $this->load->view('admin/_includes/sidemenu'); ?>
    <link rel="stylesheet" href="<?= THEME_CSS_PATH.'only_dashboard.css'; ?>" />
    
    <!-- Right side column. Contains the navbar and content of the page -->
    <aside class="right-side" ng-controller="dashboardCTRL">
        <!-- Main content -->
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
        <section class="content" ng-init="getTotals()">
            <div class="row">
                <div class="col-lg-3 col-md-6 col-sm-6 margin_10 animated fadeInLeftBig">
                    <!-- Trans label pie charts strats here-->
                    <div class="lightbluebg no-radius">
                        <div class="panel-body squarebox square_boxs">
                            <div class="col-xs-12 pull-left nopadmar">
                                <div class="row" ng-click="loadUsers();">
                                    <div class="square_box col-xs-7 text-right">
                                        <span>Total Users</span>
                                        <div class="number" id="myTargetElement1"></div>
                                    </div>
                                    <i class="icon icon-Users dash-svg pull-right" data-name="users" data-l="true" data-c="#fff" data-hc="#fff" data-s="70"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 margin_10 animated fadeInUpBig">
                    <!-- Trans label pie charts strats here-->
                    <div class="redbg no-radius">
                        <div class="panel-body squarebox square_boxs">
                            <div class="col-xs-12 pull-left nopadmar">
                                <div class="row" ng-click="loadMessages();">
                                    <div class="square_box col-xs-7 pull-left">
                                        <span>Total Messages</span>
                                        <div class="number" id="myTargetElement2" ></div>
                                    </div>
                                    <i class="icon icon-Message dash-svg pull-right" data-name="message-new" data-l="true" data-c="#fff" data-hc="#fff" data-s="70"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 margin_10 animated fadeInRightBig">
                    <!-- Trans label pie charts strats here-->
                    <div class="palebluecolorbg no-radius">
                        <div class="panel-body squarebox square_boxs">
                            <div class="col-xs-12 pull-left nopadmar">
                                <div class="row" ng-click="loadQuicklinks();">
                                    <div class="square_box col-xs-7 pull-left">
                                        <span>Total Quick Links</span>
                                        <div class="number" id="myTargetElement3" ></div>
                                    </div>
                                    <i class="icon icon-Quicklinks dash-svg pull-right" data-name="link" data-l="true" data-c="#fff" data-hc="#fff" data-s="70"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6 col-md-6 margin_10 animated fadeInDownBig">
                    <!-- Trans label pie charts strats here-->
                    <div class="goldbg no-radius">
                        <div class="panel-body squarebox square_boxs">
                            <div class="col-xs-12 pull-left nopadmar">
                                <div class="row" ng-click="loadDocuments();">
                                    <div class="square_box col-xs-7 pull-left">
                                        <span>Total Documents</span>
                                        <div class="number" id="myTargetElement4" ></div>
                                    </div>
                                    <i class="icon icon-Documents dash-svg pull-right" data-name="folder-open" data-l="true" data-c="#fff" data-hc="#fff" data-s="70"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </section>
    </aside>
    <!-- right-side -->
<?php $this->load->view('admin/_includes/footer'); ?>

<script src="<?= THEME_JS_PATH.'dashboard.js'; ?>" type="text/javascript"></script>

<!-- ++++++++++++++++++ Angular Controllers +++++++++++++++ -->
<script src="<?= NGAPP_PATH.'app.js'; ?>"></script>
<script src="<?= NGAPP_PATH.'dashboardCTRL.js'; ?>"></script>
<!-- ++++++++++++++++++ /Angular Controllers +++++++++++++++ -->