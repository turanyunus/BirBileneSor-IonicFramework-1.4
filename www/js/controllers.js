angular.module('starter.controllers', [])

.controller('AppCtrl', function ($scope, $ionicModal, $cordovaCamera, $timeout, $state, $http,$ionicHistory,$window) {

    $scope.webServiceUrl = "http://localhost/giyimapi/";

    $scope.user = null;
    // Form data for the login modal
    $scope.loginData = {};
    $scope.loginData.username = "";
    $scope.loginData.password = "";

    // GİRİŞ BURDA YAPILIYOR BAŞLADI 
    $ionicModal.fromTemplateUrl('templates/tab-login.html', {
      scope: $scope
    }).then(function (modal) {
      $scope.login_modal = modal;
    });

    $scope.openModal = function (item) {
      if (item == 'login') {
        $scope.login_modal.show();
      }
    };

    $scope.closeModal = function (item) {
      if (item == 'login') {
        $scope.login_modal.hide();
      }else if (item == 'login2kayit'){
        $timeout(function(){
          $scope.closeModal('login');
          $state.go('tab.register');
        },200);
      }
    };


    $scope.doLogin = function () {
      $http.get($scope.webServiceUrl + "json_login.php?kadi=" + $scope.loginData.username + "&sifre="+$scope.loginData.password)
       .then(function (response) {
         if (typeof response.data.errorMessage !== 'undefined'){
             alert(response.data.errorMessage);
         }else{
            $scope.user = response.data.data;

            $scope.id = $scope.user.id;
            $scope.name = $scope.user.name;
            $scope.username = $scope.user.username;
            $scope.sifre = $scope.user.sifre;

            $scope.closeModal('login');
         }
      });
    };
      $scope.logout = function(){
       $scope.user = null;
       $window.location.reload(true);
    };

    // GİRİŞ BURDA YAPILIYOR BİTTİ 

    // POST EKLEMEK BURDA BAŞLIYOR 
    $ionicModal.fromTemplateUrl('templates/tab-add.html', {
      scope: $scope
    }).then(function (modal) {
      $scope.login_modale = modal;
    });
    
    $scope.doAdd = function (item) {
      if (item == 'add') {
        $scope.login_modale.show();
      }
    };

    $scope.closeAdd = function (item) {
      if (item == 'add') {
        $scope.login_modale.hide();
      }
    };

    $scope.image = "http://placehold.it/200x200";

    $scope.takePicture = function(){

      var options = {
        quality: 50,
        destinationType: Camera.DestinationType.DATA_URL,
        encodingType: Camera.EncodingType.JPEG,
      };


      $cordovaCamera.getPicture(options).then(function(imageData) {
           $scope.image =  "data:image/jpeg;base64," + imageData;
         }, function(err) {
        // error
      });
    }


    // POST EKLEMEK BURDA BİTİYOR
  })


.controller('RegisterCtrl', function($scope,$http,$state,$ionicHistory) {

    $scope.user = null;

    $scope.kayit = {};
    $scope.kayit.kul_adi = "";
    $scope.kayit.kul_sifre = "";
    $scope.kayit.kul_sifret = "";
    $scope.kayit.kul_email = "";
    $scope.kayit.onay = "";

    $scope.doRegister = function() {
      var postData=[];
      postData.push(encodeURIComponent("oonay") + "=" + encodeURIComponent($scope.kayit.onay));
      postData.push(encodeURIComponent("kadi") + "=" + encodeURIComponent($scope.kayit.kul_adi));
      postData.push(encodeURIComponent("sifre") + "=" + encodeURIComponent($scope.kayit.kul_sifre));
      postData.push(encodeURIComponent("sifret") + "=" + encodeURIComponent($scope.kayit.kul_sifret));
      postData.push(encodeURIComponent("email") + "=" + encodeURIComponent($scope.kayit.kul_email));
      var data = postData.join("&");

        $http({
          method: 'POST',
          url: $scope.webServiceUrl+'json_register.php',
          data: data,
          headers: {'Content-Type': 'application/x-www-form-urlencoded'}
        }).success(function (data) {
          if (data != ""){
              alert(data);
          }else{
            $scope.user = $scope.kayit;
           // window.location.href="#/tab/login";
           $state.go("tab.login");
           $ionicHistory.clearHistory();
          }
        }).error(function (data) {
          alert(data);
        });
      };  
})  

.controller('ChatsCtrl', function($scope, $http, $rootScope) {
  $http.get($scope.webServiceUrl + "json_homepage.php")
      .then(function (response) {
        $rootScope.person = response.data;
      });
})

.controller('ChatDetailCtrl', function($scope, $stateParams, Chats) {
  $scope.chat = Chats.get($stateParams.chatId);
})


.controller('InfoCtrl', function($scope) {

})


.controller('MessCtrl', function($scope) {
  
});





