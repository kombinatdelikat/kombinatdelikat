'use strict';

describe('Controller: OrderCtrl', function () {

  // load the controller's module
  beforeEach(module('de.kombinatdelikat.www'));

  var OrderCtrl,
    scope;

  // Initialize the controller and a mock scope
  beforeEach(inject(function ($controller, $rootScope) {
    scope = $rootScope.$new();
    OrderCtrl = $controller('OrderCtrl', {
      $scope: scope
      // place here mocked dependencies
    });
  }));

  it('should attach a list of awesomeThings to the scope', function () {
    expect(OrderCtrl.awesomeThings.length).toBe(3);
  });
});
