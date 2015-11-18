'use strict';

describe('Controller: LocationsCtrl', function () {

  // load the controller's module
  beforeEach(module('dekombinatdelikatwww'));

  var LocationsCtrl,
    scope;

  // Initialize the controller and a mock scope
  beforeEach(inject(function ($controller, $rootScope) {
    scope = $rootScope.$new();
    LocationsCtrl = $controller('LocationsCtrl', {
      $scope: scope
      // place here mocked dependencies
    });
  }));

  it('should attach a list of awesomeThings to the scope', function () {
    expect(LocationsCtrl.awesomeThings.length).toBe(3);
  });
});
