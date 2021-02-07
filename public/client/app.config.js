'use strict';

angular.
  module('game2App').
  config(['$routeProvider',
    function config($routeProvider) {
      $routeProvider.
        when('/', {
          template: '<game2-main></game2-main>'
        }).
        otherwise('/');
    }
  ]);
