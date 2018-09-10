<!DOCTYPE html>
<html ng-app="SedemacApp">

<head>
    <meta charset="UTF-8">
    <title><?= $header_title; ?></title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
    <!-- global css -->
    <link href="<?= THEME_CSS_PATH.'bootstrap.min.css'; ?>" rel="stylesheet" type="text/css" />
    <!-- font Awesome -->
    <link href="<?= THEME_VENDORS_PATH.'font-awesome-4.2.0/css/font-awesome.min.css'; ?>" rel="stylesheet" type="text/css" />
    <link href="<?= THEME_CSS_PATH.'styles/black.css'; ?>" rel="stylesheet" type="text/css" id="colorscheme" />
    <link href="<?= THEME_CSS_PATH.'panel.css'; ?>" rel="stylesheet" type="text/css" />
    <link href="<?= THEME_CSS_PATH.'metisMenu.css'; ?>" rel="stylesheet" type="text/css" />
    <!-- end of global css -->
    <!--page level css -->
    <link href="<?= THEME_VENDORS_PATH.'fullcalendar/css/fullcalendar.css'; ?>" rel="stylesheet" type="text/css" />
    <link href="<?= THEME_CSS_PATH.'pages/calendar_custom.css'; ?>" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" media="all" href="<?= THEME_VENDORS_PATH.'jvectormap/jquery-jvectormap.css'; ?>" />
    <link rel="stylesheet" href="<?= THEME_VENDORS_PATH.'animate/animate.min.css'; ?>">
    <link rel="stylesheet" href="<?= THEME_VENDORS_PATH.'Buttons-master/css/buttons.css'; ?>" />
    <link rel="stylesheet" href="<?= THEME_CSS_PATH.'pages/advbuttons.css'; ?>" />
    <link href="<?= CSS_PATH.'jquery-ui.css'; ?>" rel="stylesheet" type="text/css" />
    <link href="<?= CSS_PATH.'jquery-ui-timepicker.min.css'; ?>" rel="stylesheet" type="text/css" />
    <!--end of page level css-->

    <!-- ++++++++++++++++++ Datatables +++++++++++++++ -->
    <link rel="stylesheet" type="text/css" href="<?= THEME_VENDORS_PATH.'datatables/css/dataTables.colReorder.min.css'; ?>" />
    <link rel="stylesheet" type="text/css" href="<?= THEME_VENDORS_PATH.'datatables/css/dataTables.scroller.min.css'; ?>" />
    <link rel="stylesheet" type="text/css" href="<?= THEME_VENDORS_PATH.'datatables/css/dataTables.bootstrap.css'; ?>" />
    <link href="<?= THEME_CSS_PATH.'pages/tables.css'; ?>" rel="stylesheet" type="text/css">
    <!-- ++++++++++++++++++ /Datatables +++++++++++++++ -->

    <!-- ++++++++++++++++++ Angular Components +++++++++++++++ -->
    <!-- Angular Material style sheet -->
    <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/angular_material/1.1.8/angular-material.min.css">
    <link rel="stylesheet" href="<?= CSS_PATH.'angular-block-ui.min.css'; ?>">
    <!-- ++++++++++++++++++ /Angular Components +++++++++++++++ -->

    <!-- ++++++++++++++++++ /Custom CSS +++++++++++++++ -->
    <link rel="stylesheet" href="<?= STYLES_PATH.'styles.css'; ?>" />
    <link rel="stylesheet" href="<?php echo base_url(); ?>site_data/SVG icons/style.css">

    <!-- ++++++++++++++++++ /Custom CSS +++++++++++++++ -->
     <link rel="icon" href="<?php echo base_url(); ?>site_data/favicon.ico">

</head>

<body class="skin-josh">
    <script>
        var userProfile = '<?= json_encode($this->session->userdata('userProfile')); ?>';
    </script>
    <header class="header" ng-controller="userCTRL">
        <a href="<?= base_url(); ?>" class="logo">
            <!-- <img src="<?php echo base_url(); ?>site_data/logos/logo_Sedemac.png" alt="Sedemac logo" class="logo-img"> -->
            <img src="<?= base_url('site_data/logos/'); ?>{{userProfile.logo_image}}" alt="Sedemac Logo" class="logo-img">
        </a>
        <nav class="navbar navbar-static-top" role="navigation">
            <!-- Sidebar toggle button-->
            <div>
                <a href="#" class="navbar-btn sidebar-toggle" data-toggle="offcanvas" role="button">
                    <div class="responsive_nav"></div>
                </a>
            </div>
            
            <div class="navbar-right">
                <ul class="nav navbar-nav">
                    <li class="dropdown user user-menu">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <img id="profile-thumbnail" src="<?= base_url('site_data/user_profiles/admin/'); ?>{{userProfile.user_profile}}" width="35" class="img-circle img-responsive pull-left" height="35" alt="admin">
                            <div class="riot">
                                <div>
                                    <span id="session_first_name" ng-bind="userProfile.first_name"></span>
                                    <span>
                                        <i class="caret"></i>
                                    </span>
                                </div>
                            </div>
                        </a>
                        <ul class="dropdown-menu">
                            <!-- User image -->
                            <li class="user-header bg-light-blue">
                                <img id="profile-medium" ng-src="<?= base_url('site_data/user_profiles/admin/'); ?>{{userProfile.user_profile}}" class="img-responsive img-circle" alt="admin">
                                <p class="topprofiletext" id="session_name" 
                                    ng-bind="userProfile.first_name+' '+userProfile.last_name"></p>
                            </li>
                            <!-- Menu Body -->
                            <li>
                                <a data-toggle="modal" data-href="#myProfileModal" href="#myProfileModal"
                                    data-backdrop="static" data-keyboard="false">
                                    <i class="icon-Profile" data-name="user" data-s="18"></i>
                                    My Profile
                                </a>
                            </li>
                            <li>
                                <a data-toggle="modal" data-href="#changePasswordModal" href="#changePasswordModal"
                                    data-backdrop="static" data-keyboard="false">
                                    <i class="icon-Password" data-name="key" data-s="18"></i>
                                    Change Password
                                </a>
                            </li>
                            <li role="presentation"></li>
                            <li>
                                <a href="javascript:;" ng-click="doLogout()">
                                    <i class="icon-Logout" data-name="sign-out" data-s="18"></i>
                                    Logout
                                </a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </nav>
    </header>
    
    <!-- +++++++++++++++++++++++++++++++++++++ My Profile Modal +++++++++++++++++++++++++++++++++ -->
    <div class="modal fade in" id="myProfileModal" tabindex="-1" role="dialog" aria-hidden="false" style="display:none;"
        ng-controller="userCTRL">
        <div class="modal-dialog modal-lg">
            <form name="myProfileForm" ng-submit="updateMyProfile(myProfileForm.$valid, myProfileForm)" novalidate autocomplete="off">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"
                    ng-click="resetMyProfileForm(myProfileForm)">×</button>
                    <h4 class="modal-title">My Profile</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                                <?php //print_r($this->session->userdata('userProfile'));?>
                                <div class="form-group row">
                                    <label for="first_name" class="col-sm-3 col-form-label">First Name <span class="text-danger">*</span></label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" name="first_name" 
                                            ng-model="userProfile.first_name" ng-pattern="stringPattern" required>
                                        <span class="text-danger" ng-show="myProfileForm.first_name.$error.required && !myProfileForm.first_name.$pristine">This field is required.</span>
                                        <span class="text-danger" ng-show="myProfileForm.first_name.$error.pattern && !myProfileForm.first_name.$pristine">Invaid input.</span>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="last_name" class="col-sm-3 col-form-label">Last Name <span class="text-danger">*</span></label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" name="last_name" 
                                            ng-model="userProfile.last_name" ng-pattern="stringPattern" required>
                                        <span class="text-danger" ng-show="myProfileForm.last_name.$error.required && !myProfileForm.last_name.$pristine">This field is required.</span>
                                        <span class="text-danger" ng-show="myProfileForm.last_name.$error.pattern && !myProfileForm.last_name.$pristine">Invaid input.</span>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="last_name" class="col-sm-3 col-form-label">Gender <span class="text-danger">*</span></label>
                                    <div class="col-sm-9">
                                        <select class="form-control" name="gender_id" ng-model="userProfile.gender_id"
                                        required>
                                            <option value="1">Male</option>
                                            <option value="2">Female</option>
                                        </select>
                                        <span class="text-danger" ng-show="myProfileForm.gender_id.$error.required && !myProfileForm.gender_id.$pristine">This field is required.</span>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="staticEmail" class="col-sm-3 col-form-label">Email <span class="text-danger">*</span></label>
                                    <div class="col-sm-9">
                                        <input type="email" class="form-control" name="email_id" 
                                            ng-model="userProfile.email_id" ng-disabled="true">
                                    </div>
                                </div>
                                <div class="form-group row">
                                        <label class="col-md-3 control-label" for="date">User Profile <span class="text-danger">*</span></label>
                                        <div class="col-md-4">
                                            <div class="fileinput fileinput-new" data-provides="fileinput">
                                                <div class="fileinput-preview thumbnail" data-trigger="fileinput" style="width: 200px; height: 150px;"></div>
                                                <div>
                                                    <span class="btn btn-default btn-file">
                                                        <span class="fileinput-new">Select image</span>
                                                        <span class="fileinput-exists">Change</span>
                                                        <input type="file" name="img" ng-model="userProfile.user_profile" upload-files multiple>
                                                    </span>
                                                    <a href="#" class="btn btn-default fileinput-exists" data-dismiss="fileinput" ng-click="removeFileSelection()">Remove</a>
                                                </div>
                                                <span class="text-danger"><b>Note:</b> .jpg, .jpeg, .png, .gif with file size upto 1 MB is allowed.</span><br>
                                                <span class="text-danger" ng-bind="fileReqVal"></span>
                                            </div>
                                        </div>
                                        <div ng-if="userProfile.user_profile">
                                            <label class="col-md-1" for="date">Last Upload</label>
                                            <div class="col-md-4">
                                                <img class="last-upload" src="<?= base_url('site_data/user_profiles/admin/'); ?>{{userProfile.user_profile}}" alt="User Profile">   
                                            </div>
                                        </div>
                                </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" data-dismiss="modal" class="btn btn-cancle" ng-click="resetMyProfileForm(myProfileForm)">CANCEL</button>
                    <button type="submit" class="btn btn-primary btn-update" ng-disabled="myProfileForm.$invalid">UPDATE</button>
                </div>
            </div>
            </form>
        </div>
    </div>
    <!-- +++++++++++++++++++++++++++++++++++++ /My Profile Modal +++++++++++++++++++++++++++++++++ -->

    <!-- +++++++++++++++++++++++++++++++++++++ Change Password Modal +++++++++++++++++++++++++++++++++ -->
    <div class="modal fade in" id="changePasswordModal" tabindex="-1" role="dialog" aria-hidden="false" style="display:none;"
        ng-controller="userCTRL">
        <div class="modal-dialog modal-md">
            <form name="changePasswordForm" ng-submit="changePassword(changePasswordForm.$valid, changePasswordForm)" novalidate 
                autocomplete="off">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"
                        ng-click="resetPasswordForm(changePasswordForm)">×</button>
                        <h4 class="modal-title">Change Password</h4>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">                            
                                <div class="form-group row">
                                    <label for="current_password" class="col-sm-4 col-form-label">Current Password <span class="text-danger">*</span></label>
                                    <div class="col-sm-8">
                                        <input type="password" class="form-control" name="current_password" 
                                            ng-model="request.current_password" required>
                                        <span class="text-danger" ng-show="changePasswordForm.current_password.$error.required && !changePasswordForm.current_password.$pristine">This field is required.</span>
                                        <span class="text-danger" ng-show="changePasswordForm.current_password.$error.pattern && !changePasswordForm.current_password.$pristine">Invaid input.</span>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="new_password" class="col-sm-4 col-form-label">New Password <span class="text-danger">*</span></label>
                                    <div class="col-sm-8">
                                        <input type="password" class="form-control" name="new_password" 
                                            ng-minlength="passwordMinlength" ng-model="request.new_password" required>
                                        <span class="text-danger" ng-show="changePasswordForm.new_password.$error.required && !changePasswordForm.new_password.$pristine">This field is required.</span>
                                        <span class="text-danger" ng-show="changePasswordForm.new_password.$error.minlength && !changePasswordForm.new_password.$pristine">Password should contain minimum 5 characters.</span>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="confirm_password" class="col-sm-4 col-form-label">Confirm Password <span class="text-danger">*</span></label>
                                    <div class="col-sm-8">
                                        <input type="password" class="form-control" name="confirm_password" 
                                            ng-minlength="passwordMinlength" ng-model="request.confirm_password" required>
                                        <span class="text-danger" ng-show="changePasswordForm.confirm_password.$error.required && !changePasswordForm.confirm_password.$pristine">This field is required.</span>
                                        <span class="text-danger" 
                                            ng-show="changePasswordForm.confirm_password.$error.minlength && !changePasswordForm.confirm_password.$pristine">Password should contain minimum 5 characters.</span>
                                        <span class="text-danger" ng-show="passwordMismatch">New password and confirm password does not match.</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" data-dismiss="modal" class="btn btn-cancle"
                            ng-click="resetPasswordForm(changePasswordForm)">CANCEL</button>
                        <button type="submit" class="btn btn-primary btn-update" ng-disabled="changePasswordForm.$invalid">UPDATE</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <!-- +++++++++++++++++++++++++++++++++++++ /Change Password Modal +++++++++++++++++++++++++++++++++ -->