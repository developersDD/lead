
//----------------------Branch Management Controller---------------------
SedemacApp.controller('branchManagementCTRL',['$scope', '$http', 'blockUI', '$controller', 'DTOptionsBuilder', '$mdDialog',
	function($scope, $http, blockUI, $controller, DTOptionsBuilder, $mdDialog){
		$controller('baseCTRL', { $scope: $scope })
		
		var apiURL = appURL + 'admin/branches/';

		// DataTables configurable options
    	$scope.dtOptions = DTOptionsBuilder.newOptions()
        .withDisplayLength(10)
        .withOption('bLengthChange', true);

		/*-------------------getBranches---------------*/
		$scope.loadBranches = function(){
			window.location = apiURL;
		};
		$scope.getBranches = function(){
			$scope.startBlocker();

			$http({
			  method: 'GET',
			  url: apiURL + 'ngGetBranches'

			}).then(function successCallback(response) {
			    $scope.stopBlocker();
				var res = response.data;
				console.log(res);
				if(res.status == false){
					$scope.errorMessage(res.message);
				}else{
					$scope.branches = res.data;
				}
				$scope.data = res;

			  }, function errorCallback(err) {
			    $scope.stopBlocker();
				console.log(err);
				$scope.errorMessage(err);
			  });
		};

		/*---------------------------Update Branch Status-------------------*/
		$scope.showStatusConfirm = function(ev, row) {
		    if(row.status_id == '1'){
		    	var message = 'Are you sure to make this branch inactive?';
		    }else{
		    	var message = 'Are you sure to make this branch active?';
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
				$scope.getBranches();
			},function(err){
				$scope.stopBlocker();
				console.log(err);
				$scope.errorMessage('Some error occured.');
			})
		};


		/*---------------------------Delete Branch-------------------*/
		$scope.showDeleteConfirm = function(ev, id) {
		    var confirm = $mdDialog.confirm()
		          .title('Are you sure to delete this branch?')
		          .textContent('All the related data will be deleted permanently.')
		          .ariaLabel('Lucky day')
		          .targetEvent(ev)
		          .ok('Confirm')
		          .cancel('Cancel');

		    $mdDialog.show(confirm).then(function() {
		    	//confirm
		    	$scope.startBlocker();
		    	window.location = appURL + 'admin/branches/delete/' + id;
		    },function() {
		    	//cancel
		    });
		};


		$scope.removeFileSelection = function(){	$scope.files = []; };
		/*------------------------------addBranch--------------------------*/
		$scope.newBranch = {};
		$scope.newBranch.gender_id = '1';
		$scope.loadAddBranch = function(){
			window.location = appURL + 'admin/branches/add';
		};

			//1. Used to list all selected files  
    	$scope.files = [];
    		//2. listen for the file selected event which is raised from directive  
	    $scope.$on("seletedFile", function (event, args) {  
	        $scope.$apply(function () {  
	            //add the file object to the scope's files collection
	            //$scope.files.push(args.file); //push multiple files in files array
	            $scope.files[0] = args.file;
	        });  
	    });
		$scope.addBranch = function(isValid, form){
			
			if(isValid){
				if($scope.files.length > 0){
				$scope.fileReqVal = '';
				$scope.startBlocker();

				$http({  
		            method: 'POST',  
		            url: apiURL + 'ngSave',
		            headers: { 'Content-Type': undefined },  
		             
		            transformRequest: function (data) {  
		                var formData = new FormData();  
		                formData.append("model", angular.toJson(data.model));  
		                //debugger;
		                if(data.files.length>0){
			                for (var i = 0; i < data.files.length; i++) {  
			                    formData.append("file-" + i, data.files[i]);  
			                }
			            }else{
			            	formData.append("file-0", '');
			            }
		                return formData;  
		            },  
		            data: { model: $scope.newBranch, files: $scope.files }
		        }).then(function(response){
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

				return false;
				}else{
					$scope.fileReqVal = 'This field is required.';
					return false;
				}
			}
		};


		/*----------------------------Edit Branch----------------------------*/
		$scope.editBranch = editBranch;
		// $scope.brancheCategories = brancheCategories;

		$scope.updateBranch = function(isValid, form){

			if(isValid){
				if(editBranch.branch_profile != "" || $scope.files.length > 0){
				$scope.fileReqVal = '';
				$scope.startBlocker();

				$http({  
		            method: 'POST',  
		            url: apiURL + 'ngUpdateDetails',
		            headers: { 'Content-Type': undefined },  
		             
		            transformRequest: function (data) {  
		                var formData = new FormData();  
		                formData.append("model", angular.toJson(data.model));  
		                if(data.files.length>0){
			                for (var i = 0; i < data.files.length; i++) {  
			                    formData.append("file-" + i, data.files[i]);  
			                }
			            }else{
			            	formData.append("file-0", '');
			            }
		                return formData;  
		            },  
		            data: { model: $scope.editBranch, files: $scope.files }
		        }).then(function(response){
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

				return false;
				}else{
					$scope.fileReqVal = 'This field is required.';
					return false;
				}
			}
		};
	}
]);