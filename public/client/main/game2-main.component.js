'use strict';

// Register `phoneList` component, along with its associated controller and template
angular.
  module('game2Main').
  component('game2Main', {
    templateUrl: 'main/game2-main.template.html',
    controller: ['$scope', '$http',
      function MainController($scope, $http) {
          Game.init();
          Game.http = $http;
          $scope.fire = function (num) {
              if (num === 1) {
                  Game.ball = new Fb1(250, 400);
              }
              if (num === 2) {
                  Game.ball = new Fb2(250, 400);
              }
          };
      }
    ]
  });
