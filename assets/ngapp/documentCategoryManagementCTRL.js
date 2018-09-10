
//----------------------User Management Controller---------------------
SedemacApp.controller('documentCategoryManagementCTRL',['$scope', '$http', 'blockUI', '$controller', 'DTOptionsBuilder', '$mdDialog',
	function($scope, $http, blockUI, $controller, DTOptionsBuilder, $mdDialog){
		$controller('baseCTRL', { $scope: $scope })
		
		var apiURL = appURL + 'admin/document/category/';

		// DataTables configurable options
    	$scope.dtOptions = DTOptionsBuilder.newOptions()
        .withDisplayLength(10)
        .withOption('bLengthChange', true);

		/*-------------------getUsers---------------*/
		$scope.loadDocumentCategory = function(){
			window.location = apiURL;
		};
		$scope.getDocumentCategory = function(){
			$scope.startBlocker();

			$http({
			  method: 'GET',
			  url: apiURL + 'ngGetDocumentCategory'

			}).then(function successCallback(response) {
			    $scope.stopBlocker();
				var res = response.data;
				if(res.status == false){
					$scope.errorMessage(res.message);
				}else{
					$scope.categories = res.data;
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
		    	var message = 'Are you sure to make this category inactive?';
		    }else{
		    	var message = 'Are you sure to make this category active?';
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
				$scope.getDocumentCategory();
			},function(err){
				$scope.stopBlocker();
				console.log(err);
				$scope.errorMessage('Some error occured.');
			})
		};


		/*---------------------------Delete Document Category-------------------*/
		$scope.showDeleteConfirm = function(ev, id) {
		    var confirm = $mdDialog.confirm()
		          .title('Are you sure to delete this document category?')
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
		/*------------------------------addUserCategory--------------------------*/
		$scope.newDocumentCategory = {};
		$scope.newDocumentCategory.status_id = '1';
		$scope.loadAddDocumentCategory = function(){
			window.location = appURL + 'admin/document/category/add';
		};
		$scope.addDocumentCategory = function(isValid, form){

			if(isValid){
				$scope.startBlocker();

				$http({
					method: 'POST',
					url: apiURL + 'ngSave',
					data: $scope.newDocumentCategory
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
		$scope.documentCategories = documentCategories;
		$scope.updateDocumentCategory = function(isValid, form){
			if(isValid){
				$scope.startBlocker();

				$http({
					method: 'POST',
					url: apiURL + 'ngUpdateDetails',
					data: $scope.documentCategories
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