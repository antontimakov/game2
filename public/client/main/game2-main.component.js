'use strict';

// Register `phoneList` component, along with its associated controller and template
angular.
  module('game2Main').
  component('game2Main', {
    templateUrl: 'main/game2-main.template.html',
    controller: ['$scope',
      function MainController($scope) {
          Game.init();
          $scope.fire = function (num) {
              Game.ball = new Fb1(250, 400);
          };
      }
    ]
  });
