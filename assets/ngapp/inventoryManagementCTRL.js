//----------------------Branch Management Controller---------------------
SedemacApp.controller('inventoryManagementCTRL', ['$scope', '$http', 'blockUI', '$controller', 'DTOptionsBuilder', '$mdDialog',
    function($scope, $http, blockUI, $controller, DTOptionsBuilder, $mdDialog) {
        $controller('baseCTRL', { $scope: $scope })

        var apiURL = appURL + 'admin/inventory/';

        // DataTables configurable options
        $scope.dtOptions = DTOptionsBuilder.newOptions()
            .withDisplayLength(10)
            .withOption('bLengthChange', true);


        /*------------------------------addProduct--------------------------*/
        $scope.newProduct = {};
        $scope.branches = branches;
        $scope.loadAddProduct = function() {
            window.location = appURL + 'admin/inventory/add';
        };
        $scope.addProduct = function(isValid) {
            if (isValid) {
                $scope.startBlocker();
                $http({
                    method: 'POST',
                    url: apiURL + 'ngSave',
                    headers: { 'Content-Type': 'application/json' },
                    data: { product: $scope.newProduct }
                }).then(function(response) {
                    $scope.stopBlocker();
                    var res = response.data;
                    if (res.status == true) {
                        window.location = apiURL;
                    } else {
                        $scope.errorMessage(res.message);
                    }
                }, function(err) {
                    $scope.stopBlocker();
                    $scope.errorMessage('Some error occured.');
                    console.log(err);
                });
            }
        };

        // $scope.products = products;
        $scope.loadProducts = function() {
            window.location = apiURL;
        };
        $scope.getProducts = function() {
            $scope.startBlocker();

            $http({
                method: 'GET',
                url: apiURL + 'ngGetProducts'

            }).then(function successCallback(response) {
                $scope.stopBlocker();
                var res = response.data;
                console.log(res);
                if (res.status == false) {
                    $scope.errorMessage(res.message);
                } else {
                    $scope.products = res;
                }

            }, function errorCallback(err) {
                $scope.stopBlocker();
                console.log(err);
                $scope.errorMessage(err);
            });
        };
    }
]);