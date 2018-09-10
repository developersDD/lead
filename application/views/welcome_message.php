<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="utf-8">
        <title>Welcome to CodeIgniter</title>
        
        <!-- ++++++++++++++++++ Assets +++++++++++++++ -->
        <link rel="stylesheet" href="<?= CSS_PATH.'bootstrap.min.css'; ?>">
        <link rel="stylesheet" href="<?= CSS_PATH.'angular-block-ui.min.css'; ?>">
        <!-- ++++++++++++++++++ /Assets +++++++++++++++ -->


        <style type="text/css">
         ::selection {
            background-color: #E13300;
            color: white;
        }

        ::-moz-selection {
            background-color: #E13300;
            color: white;
        }

        body {
            background-color: #fff;
            margin: 40px;
            font: 13px/20px normal Helvetica, Arial, sans-serif;
            color: #4F5155;
        }

        a {
            color: #003399;
            background-color: transparent;
            font-weight: normal;
        }

        h1 {
            color: #444;
            background-color: transparent;
            border-bottom: 1px solid #D0D0D0;
            font-size: 19px;
            font-weight: normal;
            margin: 0 0 14px 0;
            padding: 14px 15px 10px 15px;
        }

        code {
            font-family: Consolas, Monaco, Courier New, Courier, monospace;
            font-size: 12px;
            background-color: #f9f9f9;
            border: 1px solid #D0D0D0;
            color: #002166;
            display: block;
            margin: 14px 0 14px 0;
            padding: 12px 10px 12px 10px;
        }

        #body {
            margin: 0 15px 0 15px;
        }

        p.footer {
            text-align: right;
            font-size: 11px;
            border-top: 1px solid #D0D0D0;
            line-height: 32px;
            padding: 0 10px 0 10px;
            margin: 20px 0 0 0;
        }

        #container {
            margin: 10px;
            border: 1px solid #D0D0D0;
            box-shadow: 0 0 8px #D0D0D0;
        }
        </style>
    </head>

    <body ng-app="stackApp">
        <div id="container">
            <h1>Welcome to CodeIgniter!</h1>
            <div id="body" ng-controller="userCTRL" ng-init="getData()">
            	<div class="container">
            		<div class="row">
            			<!-- +++++++++++++++++++++++++ Login Form ++++++++++++++++++++++++++ -->
            			<div class="col-md-4">
            				<form name="loginForm" ng-submit="doLogin(loginForm.$valid)" novalidate autocomplete="off">
            				    <div class="form-group">
            				        <label>Email</label>
            				        <input type="email" class="form-control" name="email" placeholder="Enter email"
            				        ng-model="user.email" ng-pattern="emailPattern" required>
            				        <p class="text-danger" ng-show="loginForm.email.$error.required && !loginForm.email.$pristine">This field is required.</p>
            				        <p class="text-danger" ng-show="loginForm.email.$error.pattern && !loginForm.email.$pristine">Invaid email.</p>
            				    </div>
            				    <div class="form-group">
            				        <label>Password</label>
            				        <input type="password" class="form-control" name="password" placeholder="Password"
            				        ng-model="user.password" required>
            				        <p class="text-danger" ng-show="loginForm.password.$error.required && !loginForm.password.$pristine">This field is required.</p>
            				    </div>
            				    <button type="submit" class="btn btn-sm btn-primary" ng-disabled="loginForm.$invalid">Login</button>
            				    <button type="button" class="btn btn-sm btn-warning" ng-click="doLogout()">Logout</button>
            				</form>
            			</div>
            		</div>
            	</div>
            </div>
            <p class="footer">Page rendered in <strong>{elapsed_time}</strong> seconds.
                <?php echo  (ENVIRONMENT === 'development') ?  'CodeIgniter Version <strong>' . CI_VERSION . '</strong>' : '' ?></p>
        </div>
    </body>
	<script>
		var appURL = "<?= base_url(); ?>";
	</script>
	<script src="<?= JS_PATH.'jquery.min.js' ?>"></script>
	<script src="<?= JS_PATH.'jquery-ui.min.js' ?>"></script>
	<script src="<?= JS_PATH.'bootstrap.min.js' ?>"></script>
	<script src="<?= JS_PATH.'simply-toast.min.js' ?>"></script>
	<script src="<?= JS_PATH.'angular.min.js' ?>"></script>
	<script src="<?= JS_PATH.'jquery.blockUI.min.js' ?>"></script>
	<script src="<?= JS_PATH.'angular-block-ui.min.js' ?>"></script>

	<!-- Angular Assets -->
	<script src="<?= NGAPP_PATH.'app.js'; ?>"></script>
	<script src="<?= NGAPP_PATH.'userCTRL.js'; ?>"></script>

    </html>