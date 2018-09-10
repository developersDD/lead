
//----------------------User Management Controller---------------------
SedemacApp.controller('messageBoardManagementCTRL',['$scope', '$http', 'blockUI', '$controller', 'DTOptionsBuilder', '$mdDialog',
	function($scope, $http, blockUI, $controller, DTOptionsBuilder, $mdDialog){
		$controller('baseCTRL', { $scope: $scope })
		
		var apiURL = appURL + 'admin/messages/';
		$scope.msgLimit = 100;
		// DataTables configurable options
    	$scope.dtOptions = DTOptionsBuilder.newOptions()
        .withDisplayLength(10)
        .withOption('bLengthChange', true);

		/*-------------------getUsers---------------*/
		$scope.loadMessageboard = function(){
			window.location = apiURL;
		};

		$scope.getMessages = function(){
			$scope.startBlocker();

			$http({
			  method: 'GET',
			  url: apiURL + 'ngGetMessages'

			}).then(function successCallback(response) {
			    $scope.stopBlocker();
				var res = response.data;
				if(res.status == false){
					$scope.errorMessage(res.message);
				}else{
					$scope.messages = res.data;
				}
				$scope.data = res;
				debugger;
			  }, function errorCallback(err) {
			    $scope.stopBlocker();
				console.log(err);
				$scope.errorMessage(err);
			  });
		};


		/*---------------------------Update Category Status-------------------*/
		$scope.showStatusConfirm = function(ev, row) {
		    if(row.status_id == '1'){
		    	var message = 'Are you sure to make this message inactive?';
		    }else{
		    	var message = 'Are you sure to make this message active?';
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
				$scope.getMessages();
			},function(err){
				$scope.stopBlocker();
				console.log(err);
				$scope.errorMessage('Some error occured.');
			})
		};


		/*---------------------------Delete User-------------------*/
		$scope.showDeleteConfirm = function(ev, id) {
		    var confirm = $mdDialog.confirm()
		          .title('Are you sure to delete this message?')
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
		/*------------------------------addMessage--------------------------*/
		$scope.newMessage = {};
		$scope.newMessage.status_id = '1';
		$scope.loadAddMessage = function(){
			window.location = apiURL + 'add';
		};
		$scope.addMessage = function(isValid, form){

			if(isValid){
				$scope.startBlocker();

				$http({
					method: 'POST',
					url: apiURL + 'ngSave',
					data: $scope.newMessage
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
		$scope.messages = messages;
		$scope.updateMessage = function(isValid, form){
			if(isValid){
				$scope.startBlocker();

				$http({
					method: 'POST',
					url: apiURL + 'ngUpdateDetails',
					data: $scope.messages
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