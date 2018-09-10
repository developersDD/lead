var SedemacApp = angular.module('SedemacApp', ['blockUI', 'datatables', 'ngMaterial']);


// -----------------------Custom Directives-----------------
// Mulitple File Upload
SedemacApp.directive('uploadFiles', function() {
    return {
        scope: true, //create a new scope  
        link: function(scope, el, attrs) {
            el.bind('change', function(event) {
                var files = event.target.files;
                //iterate files since 'multiple' may be specified on the element  
                for (var i = 0; i < files.length; i++) {
                    //emit event upward  
                    scope.$emit("seletedFile", { file: files[i] });
                }
            });
        }
    };
});


// MYSQL timestamp to strToTime
SedemacApp.filter('strToTime', function() {
    return function(input) {
        return Date.parse(input);
    };
});


//----------------------Base Controller---------------------
SedemacApp.controller('baseCTRL', ['$scope', '$http', 'blockUI',
    function($scope, $http, blockUI) {


        //----------------ngPatterns-------------
        $scope.emailPattern = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
        $scope.stringPattern = /^[a-zA-Z ]*$/;
        $scope.mobilePattern = /^[5-9]\d*$/;
        $scope.passwordMinlength = 5;
        //$scope.urlPattern = /^(http[s]?:\/\/){0,1}(www\.){0,1}[a-zA-Z0-9\.\-]+\.[a-zA-Z]{2,5}[\.]{0,1}/;
        $scope.urlPattern = /^(https?:\/\/[^\s]+)/;
        //------------Block UI----------
        $scope.startBlocker = function() { blockUI.start({ message: 'Please wait....' }); };
        $scope.stopBlocker = function() { blockUI.stop(); };

        //------------Toast Message-----
        $scope.successMessage = function(message) { $.simplyToast(message, 'success'); };
        $scope.errorMessage = function(message) { $.simplyToast(message, 'danger'); };
        $scope.warningMessage = function(message) { $.simplyToast(message, 'warning'); };
    }
]);


//----------------------Dashboard Controller---------------------
SedemacApp.controller('dashboardCTRL', ['$scope', '$http', 'blockUI', '$controller',
    function($scope, $http, blockUI, $controller) {
        $controller('baseCTRL', { $scope: $scope })
        $controller('userCTRL', { $scope: $scope })

        var apiURL = appURL + 'admin/dashboard/';

        $scope.loadUsers = function() {
            window.location = appURL + 'admin/users';
        };
        $scope.loadMessages = function() {
            window.location = appURL + 'admin/messages';
        };
        $scope.loadQuicklinks = function() {
            window.location = appURL + 'admin/quicklinks';
        };
        $scope.loadDocuments = function() {
            window.location = appURL + 'admin/documents';
        };
        //---------------------doLogin------------------------
        $scope.getTotals = function() {
            $scope.startBlocker();
            $http({
                    method: 'POST',
                    url: apiURL + 'ngGetTotals'
                })
                .then(function(response) {
                    $scope.stopBlocker();
                    var res = response.data;
                    var demo = new countUp("myTargetElement1", 1, res.data.users, 0, 6, options);
                    demo.start();
                    var demo = new countUp("myTargetElement2", 1, res.data.messages, 0, 6, options);
                    demo.start();
                    var demo = new countUp("myTargetElement3", 1, res.data.quick_links, 0, 6, options);
                    demo.start();
                    var demo = new countUp("myTargetElement4", 1, res.data.documents, 0, 6, options);
                    demo.start();
                }, function(error) {
                    $scope.stopBlocker();
                    $scope.errorMessage('Some error occured.');
                    console.log(error);
                });
        };

    }
]);


//----------------------User Controller---------------------

SedemacApp.controller('userCTRL', ['$scope', '$http', 'blockUI', '$controller',
    function($scope, $http, blockUI, $controller) {
        $controller('baseCTRL', { $scope: $scope })

        var apiURL = appURL + 'admin/login/';

        // ---------------------get header Settings------------------------
        $scope.getHeaderLogo = function() {
            $scope.logo = "logo.png";
            $http({
                    method: 'POST',
                    url: apiURL + 'ngHeaderLogo',
                    data: $scope.user
                })
                .then(function(response) {
                    $scope.stopBlocker();
                    var res = response.data;
                    if (res.data.logo_image != '') {
                        $scope.logo = res.data.logo_image;
                    } else {
                        $scope.logo = 'logo_Sedemac.png';
                    }
                }, function(error) {
                    $scope.stopBlocker();
                    $scope.errorMessage('Some error occured.');
                    console.log(error);
                });
        };

        //---------------------doLogin------------------------
        $scope.doLogin = function(isValid) {
            if (isValid) {
                $scope.startBlocker();
                $http({
                        method: 'POST',
                        url: apiURL + 'ngLogin',
                        data: $scope.user
                    })
                    .then(function(response) {
                        $scope.stopBlocker();
                        var res = response.data;

                        if (res.status == true) {
                            window.location = appURL + 'admin/dashboard';
                        } else {
                            $scope.customMessage = res.message;
                        }
                    }, function(error) {
                        $scope.stopBlocker();
                        $scope.errorMessage('Some error occured.');
                        console.log(error);
                    });
            }
        };

        $scope.removeFileSelection = function() { $scope.files = []; };
        //---------------------doLogout------------------------
        $scope.doLogout = function() {
            $scope.startBlocker();
            $http({
                    method: 'POST',
                    url: apiURL + 'ngLogout',
                    data: $scope.user
                })
                .then(function(response) {
                    $scope.stopBlocker();
                    var res = response.data;
                    if (res.status == true) {
                        window.location = appURL + 'admin/login';
                    } else {
                        $scope.errorMessage(res.message);
                    }
                }, function(error) {
                    $scope.stopBlocker();
                    $scope.errorMessage('Some error occured.');
                    console.log(error);
                });
        };

        // ----------------------resetMyProfileForm--------------------
        $scope.resetMyProfileForm = function(form) {
            $scope.userProfile = JSON.parse(userProfile);

            form.$setPristine();
            form.$setUntouched();
        };

        if (userProfile != '') {
            $scope.userProfile = JSON.parse(userProfile);
        }

        //---------------------updateMyProfile------------------------
        //1. Used to list all selected files  
        $scope.files = [];

        //2. listen for the file selected event which is raised from directive  
        $scope.$on("seletedFile", function(event, args) {
            $scope.$apply(function() {
                //add the file object to the scope's files collection
                //$scope.files.push(args.file); //push multiple files in files array
                $scope.files[0] = args.file;
            });
        });


        $scope.updateMyProfile = function(isValid, form) {
            if (isValid) {
                if (userProfile.user_profile != "" || $scope.files.length > 0) {
                    $scope.fileReqVal = '';
                    $scope.startBlocker();

                    $http({
                        method: 'POST',
                        url: apiURL + 'ngUpdateMyProfile',
                        headers: { 'Content-Type': undefined },

                        transformRequest: function(data) {
                            var formData = new FormData();
                            formData.append("model", angular.toJson(data.model));
                            //debugger;
                            if (data.files.length > 0) {
                                for (var i = 0; i < data.files.length; i++) {
                                    formData.append("file-" + i, data.files[i]);
                                }
                            } else {
                                formData.append("file-0", '');
                            }
                            return formData;
                        },
                        data: { model: $scope.userProfile, files: $scope.files }
                    }).then(function(response) {
                        $scope.stopBlocker();
                        var res = response.data;

                        if (res.status == true) {
                            form.$setPristine();
                            form.$setUntouched();
                            $scope.userProfile = res.data;
                            angular.element('#myProfileModal').modal('hide');
                            angular.element('#session_first_name').text($scope.userProfile.first_name);
                            angular.element('#session_name').text($scope.userProfile.first_name + ' ' + $scope.userProfile.last_name);
                            angular.element('#profile-thumbnail').attr('src', appURL + "site_data/user_profiles/admin/" + $scope.userProfile.user_profile);
                            angular.element('#profile-medium').attr('src', appURL + "site_data/user_profiles/admin/" + $scope.userProfile.user_profile);
                            $scope.removeFileSelection();
                            $scope.successMessage(res.message);

                        } else {
                            $scope.errorMessage(res.message);
                        }
                    }, function(err) {
                        $scope.stopBlocker();
                        $scope.errorMessage('Some error occured.');
                        console.log(err);
                    });

                    return false;
                } else {
                    $scope.fileReqVal = 'This field is required.';
                    return false;
                }
            }
        };

        // ----------------------resetPasswordForm--------------------
        $scope.resetPasswordForm = function(form) {
            $scope.request = {};
            $scope.passwordMismatch = false;

            form.$setPristine();
            form.$setUntouched();
        };

        $scope.passwordMismatch = false;
        //---------------------changePassword------------------------
        $scope.changePassword = function(isValid, form) {
            if (isValid) {
                if ($scope.request.new_password != $scope.request.confirm_password) {

                    $scope.passwordMismatch = true;
                } else {
                    $scope.passwordMismatch = false;

                    $scope.startBlocker();

                    $http({
                            method: 'POST',
                            url: apiURL + 'ngChangePassword',
                            data: $scope.request
                        })
                        .then(function(response) {
                            $scope.stopBlocker();
                            var res = response.data;

                            if (res.status == true) {
                                $scope.request = {};
                                form.$setPristine();
                                form.$setUntouched();

                                angular.element('#changePasswordModal').modal('hide');
                                $scope.successMessage(res.message);
                            } else {
                                $scope.errorMessage(res.message);
                            }
                        }, function(error) {
                            $scope.stopBlocker();
                            $scope.errorMessage('Some error occured.');
                            console.log(error);
                        });
                }
            }
        };
    }
]);