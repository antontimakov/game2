'use strict';

// Register `phoneList` component, along with its associated controller and template
angular.
  module('game2Main').
  component('game2Main', {
    templateUrl: 'main/game2-main.template.html',
    controller: [
      function MainController(main) {
        console.log(1);
      }
    ]
  });
