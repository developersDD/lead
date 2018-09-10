
//----------------------User Management Controller---------------------
SedemacApp.controller('quickLinksManagementCTRL',['$scope', '$http', 'blockUI', '$controller', 'DTOptionsBuilder', '$mdDialog',
	function($scope, $http, blockUI, $controller, DTOptionsBuilder, $mdDialog){
		$controller('baseCTRL', { $scope: $scope })
		
		var apiURL = appURL + 'admin/quicklinks/';

		// DataTables configurable options
    	$scope.dtOptions = DTOptionsBuilder.newOptions()
        .withDisplayLength(10)
        .withOption('bLengthChange', true);

		/*-------------------getUsers---------------*/
		$scope.loadQuickLinks = function(){
			window.location = apiURL;
		};

		$scope.getQuickLinks = function(){
			$scope.startBlocker();

			$http({
			  method: 'GET',
			  url: apiURL + 'ngGetQuickLinks'

			}).then(function successCallback(response) {
			    $scope.stopBlocker();
				var res = response.data;
				if(res.status == false){
					$scope.errorMessage(res.message);
				}else{
					$scope.quicklinks = res.data;
				}
				$scope.data = res;

			  }, function errorCallback(err) {
			    $scope.stopBlocker();
				console.log(err);
				$scope.errorMessage(err);
			  });
		};


		/*---------------------------Update Category Status-------------------*/
		$scope.showStatusConfirm = function(ev, row) {
		    if(row.status_id == '1'){
		    	var message = 'Are you sure to make this Quick Link inactive?';
		    }else{
		    	var message = 'Are you sure to make this Quick Link active?';
		    }
		    var confirm = $mdDialog.confirm()
		          .title(message)
		          .textContent('')
		          .ariaLabel('Lucky day')
		          .targetEvent(ev)
		          .ok('Confirm')
		          .cancel('Cancel');

		    $mdDialog.show(confirm).then(function() {
		    	//confirm
		    	$scope.updateStatus(row);
		    },function() {
		    	//cancel
		    });
		};

		$scope.updateStatus = function(row){
			$scope.startBlocker();
			$http({
				method: 'POST',
				url: apiURL + 'updateStatus',
				data: row
			})
			.then(function(response){
				$scope.stopBlocker();
				var res = response.data;
				
				$scope.successMessage(res.message);
				$scope.getQuickLinks();
			},function(err){
				$scope.stopBlocker();
				console.log(err);
				$scope.errorMessage('Some error occured.');
			})
		};


		/*---------------------------Delete User-------------------*/
		$scope.showDeleteConfirm = function(ev, id) {
		    var confirm = $mdDialog.confirm()
		          .title('Are you sure to delete this Quick Link?')
		          .textContent('All the related data will be deleted permanently.')
		          .ariaLabel('Lucky day')
		          .targetEvent(ev)
		          .ok('Confirm')
		          .cancel('Cancel');

		    $mdDialog.show(confirm).then(function() {
		    	//confirm
		    	$scope.startBlocker();
		    	window.location = apiURL + 'delete/' + id;
		    },function() {
		    	//cancel
		    });
		};

		$scope.removeFileSelection = function(){	$scope.files = []; };
		/*------------------------------addQuickLink--------------------------*/
		$scope.newQuickLink = {};
		$scope.newQuickLink.status_id = '1';
		$scope.loadAddQuickLink = function(){
			window.location = apiURL + 'add';
		};
		$scope.addQuickLink = function(isValid, form){

			if(isValid){
				$scope.startBlocker();

				$http({
					method: 'POST',
					url: apiURL + 'ngSave',
					data: $scope.newQuickLink
				})
				.then(function(response){
					$scope.stopBlocker();
					var res = response.data;
					if(res.status == true){
						window.location = apiURL;
					}else{
						$scope.errorMessage(res.message);
					}
				},function(err){
					$scope.stopBlocker();
					$scope.errorMessage('Some error occured.');
					console.log(err);
				});
			}
		};

		/*----------------------------Edit User----------------------------*/
		$scope.quicklinks = quicklinks;
		$scope.updateQuickLink = function(isValid, form){
			if(isValid){
				$scope.startBlocker();

				$http({
					method: 'POST',
					url: apiURL + 'ngUpdateDetails',
					data: $scope.quicklinks
				})
				.then(function(response){
					$scope.stopBlocker();
					var res = response.data;
					
					if(res.status == true){
						window.location = apiURL;
					}else{
						$scope.errorMessage(res.message);
					}
				},function(err){
					$scope.stopBlocker();
					$scope.errorMessage('Some error occured.');
					console.log(err);
				});
			}
		};

	}
]);