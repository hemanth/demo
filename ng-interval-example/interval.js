angular.module("time",[])
.controller("timeCtrl",['$scope','$interval',function($scope,$interval){
  $interval(function(){
    $scope.time = Date.now();
  },0)
}]);
