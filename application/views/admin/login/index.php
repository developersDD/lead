<!DOCTYPE html>
 <html ng-app="SedemacApp">

<head>
    <title>Login | Sedemac</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- global level css -->
    <link href="<?= THEME_CSS_PATH.'bootstrap.min.css'; ?>" rel="stylesheet" />
    <!-- end of global level css -->
    <!-- page level css -->
    <link rel="stylesheet" type="text/css" href="<?= THEME_CSS_PATH.'pages/login.css'; ?>" />
    <!-- end of page level css -->

    <!-- ++++++++++++++++++ Angular Components +++++++++++++++ -->
    <link rel="stylesheet" href="<?= CSS_PATH.'angular-block-ui.min.css'; ?>">
    <!-- ++++++++++++++++++ /Angular Components +++++++++++++++ -->
</head>

<body>
    <div class="container" ng-controller="userCTRL">
        <div class="row vertical-offset-100" ng-init="getHeaderLogo()">
            <div class="col-sm-6 col-sm-offset-3  col-md-5 col-md-offset-4 col-lg-4 col-lg-offset-4">
                <div id="container_demo">
                    <div id="wrapper">
                        <!-- +++++++++++++++++++ LOGIN FORM ++++++++++++++++++++++++ -->
                        
                        <div id="login" class="animate form">
                            <form name="loginForm" ng-submit="doLogin(loginForm.$valid)" novalidate autocomplete="off">
                                <h3 class="black_bg">
                                        <img src="<?php echo base_url(); ?>site_data/logos/{{logo}}" alt="Sedemac logo" class="logo-img">
                                </h3>
                                <p class="log-head text-center">Login to Your Account</p>
                                <p>
                                    <label style="margin-bottom:0px;" for="email" class="email"> 
                                        <!-- <i class="livicon" data-name="user" data-size="16" data-loop="true" 
                                            data-c="#3c8dbc" data-hc="#3c8dbc"></i> --> Email
                                    </label>
                                    <input type="email" name="email" placeholder="Enter email"
                                    ng-model="user.email" ng-pattern="emailPattern" required>
                                    <span class="text-danger" ng-show="loginForm.email.$error.pattern && !loginForm.email.$pristine">Invaid email.</span>
                                    <span class="text-danger warning-text" 
                                    ng-show="loginForm.email.$error.required && !loginForm.email.$pristine">
                                    This field is required.</span>
                                </p>

                                <p> 
                                    <label style="margin-bottom:0px;" for="password" class="youpasswd"> <!-- <i class="livicon" data-name="key" data-size="16" data-loop="true" data-c="#3c8dbc" data-hc="#3c8dbc"></i> --> Password
                                    </label>
                                    <input type="password" name="password" placeholder="Password"
                                    ng-model="user.password" required>
                                    <span class="text-danger warning-text" ng-show="loginForm.password.$error.required && !loginForm.password.$pristine">This field is required.</span>
                                    <span class="text-danger" ng-bind="customMessage != ''?customMessage:''"></span>
                                </p>
                                
                                <!-- <p class="forget-pass text-right"><a href="#">Forgot Password?</a> </p> -->
                                <p class="login button">
                                    <input type="submit" class="btn btn-sm " ng-disabled="loginForm.$invalid" 
                                        value="LOGIN"/>
                                </p>

                               <!--  <p class="login-button"> -->
                                    <!-- <a class="btn logn-btn" href="#" ng-disabled="loginForm.$invalid">LOGIN</a> -->
                                <!-- </p> -->
                            </form>
                        </div>
                        <!-- +++++++++++++++++++ /LOGIN FORM ++++++++++++++++++++++++ -->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        var appURL = "<?= base_url(); ?>";
        var userProfile = '';
    </script>

    <!-- global js -->
    <script src="<?= THEME_JS_PATH.'jquery-1.11.1.min.js'; ?>" type="text/javascript"></script>
    <!-- Bootstrap -->
    <script src="<?= THEME_JS_PATH.'bootstrap.min.js'; ?>" type="text/javascript"></script>
    <!--livicons-->
    <script src="<?= THEME_VENDORS_PATH.'livicons/minified/raphael-min.js'; ?>" type="text/javascript"></script>
    <script src="<?= THEME_VENDORS_PATH.'livicons/minified/livicons-1.4.min.js'; ?>" type="text/javascript"></script>
    <script src="<?= THEME_JS_PATH.'josh.js'; ?>" type="text/javascript"></script>
    <script src="<?= THEME_JS_PATH.'metisMenu.js'; ?>" type="text/javascript">
    </script>
    <script src="<?= THEME_VENDORS_PATH.'holder-master/holder.js'; ?>" type="text/javascript"></script>
    <script src="<?= THEME_VENDORS_PATH.'datatables/jquery-1.10.7.dataTables.min.js'; ?>"></script>
    <!-- end of global js -->

    <!-- ++++++++++++++++++ Angular Components +++++++++++++++ -->
    <script src="<?= JS_PATH.'simply-toast.min.js' ?>"></script>
    <script src="<?= JS_PATH.'angular.min.js' ?>"></script>
    <!-- Angular Material Library -->
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.9/angular-animate.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.9/angular-aria.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.9/angular-messages.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/angular_material/1.1.8/angular-material.min.js"></script>

    <script src="<?= JS_PATH.'jquery.blockUI.min.js' ?>"></script>
    <script src="<?= JS_PATH.'angular-block-ui.min.js' ?>"></script>
    <script src="<?= JS_PATH.'angular-datatables.min.js'; ?>"></script>
    <!-- ++++++++++++++++++ /Angular Components +++++++++++++++ -->

    <!-- ++++++++++++++++++ Angular Controllers +++++++++++++++ -->
    <script src="<?= NGAPP_PATH.'app.js'; ?>"></script>
    <!-- <script src="<?= NGAPP_PATH.'userCTRL.js'; ?>"></script> -->
    <!-- ++++++++++++++++++ /Angular Controllers +++++++++++++++ -->
</body>

</html>