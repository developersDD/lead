
//----------------------User Controller---------------------
SedemacApp.controller('userCTRL',['$scope', '$http', 'blockUI', '$controller',
	function($scope, $http, blockUI, $controller){
		$controller('baseCTRL', { $scope: $scope })
		
		var apiURL = appURL + 'admin/login/';

		

		//---------------------doLogin------------------------
		$scope.doLogin = function(isValid){
			if(isValid){
				$scope.startBlocker();
				$http({
					method: 'POST',
					url: apiURL + 'ngLogin',
					data: $scope.user
				})
				.then(function(response){
					$scope.stopBlocker();
					var res = response.data;
					
					if(res.status == true){
						window.location = appURL + 'admin/dashboard';
					}else{
						$scope.errorMessage(res.message);
					}
				},function(error){
					$scope.stopBlocker();
					$scope.errorMessage('Some error occured.');
					console.log(error);
				});
			}
		};

		//---------------------doLogout------------------------
		$scope.doLogout = function(){
			$scope.startBlocker();
			$http({
				method: 'POST',
				url: apiURL + 'ngLogout',
				data: $scope.user
			})
			.then(function(response){
				$scope.stopBlocker();
				var res = response.data;
				if(res.status == true){
					window.location = appURL + 'admin/login';
				}else{
					$scope.errorMessage(res.message);
				}
			},function(error){
				$scope.stopBlocker();
				$scope.errorMessage('Some error occured.');
				console.log(error);
			});
		};

		// ----------------------resetMyProfileForm--------------------
		$scope.resetMyProfileForm = function(form){
			$scope.userProfile = JSON.parse(userProfile);

			form.$setPristine();
			form.$setUntouched();
		};

		if(userProfile!=''){
			$scope.userProfile = JSON.parse(userProfile);
		}

		//---------------------updateMyProfile------------------------
		$scope.updateMyProfile = function(isValid, form){
			if(isValid){
				$scope.startBlocker();
				
				var postData = {id: $scope.userProfile.id, first_name: $scope.userProfile.first_name, 
					last_name: $scope.userProfile.last_name, gender_id: $scope.userProfile.gender_id};
				
				$http({
					method: 'POST',
					url: apiURL + 'ngUpdateMyProfile',
					data: postData
				})
				.then(function(response){
					$scope.stopBlocker();
					var res = response.data;

					if(res.status == true){
						form.$setPristine();
						form.$setUntouched();

						angular.element('#myProfileModal').modal('hide');
						angular.element('#session_first_name').text($scope.userProfile.first_name);
						angular.element('#session_name').text($scope.userProfile.first_name+' '+$scope.userProfile.last_name);
						$scope.successMessage(res.message);
					}else{
						$scope.errorMessage(res.message);
					}
				},function(error){
					$scope.stopBlocker();
					$scope.errorMessage('Some error occured.');
					console.log(error);
				});
			}
		};

		// ----------------------resetPasswordForm--------------------
		$scope.resetPasswordForm = function(form){
			$scope.request = {};
			$scope.passwordMismatch = false;
			
			form.$setPristine();
			form.$setUntouched();
		};

		$scope.passwordMismatch = false;
		//---------------------changePassword------------------------
		$scope.changePassword = function(isValid, form){
			if(isValid){
				if($scope.request.new_password != $scope.request.confirm_password){

					$scope.passwordMismatch = true;
				}else{
					$scope.passwordMismatch = false;
				
					$scope.startBlocker();
					
					$http({
						method: 'POST',
						url: apiURL + 'ngChangePassword',
						data: $scope.request
					})
					.then(function(response){
						$scope.stopBlocker();
						var res = response.data;

						if(res.status == true){
							$scope.request = {};
							form.$setPristine();
							form.$setUntouched();

							angular.element('#changePasswordModal').modal('hide');
							$scope.successMessage(res.message);
						}else{
							$scope.errorMessage(res.message);
						}
					},function(error){
						$scope.stopBlocker();
						$scope.errorMessage('Some error occured.');
						console.log(error);
					});
				}
			}
		};
	}
]);