'use strict';

describe('Controller: ImprintCtrl', function () {

  // load the controller's module
  beforeEach(module('de.kombinatdelikat.www'));

  var ImprintCtrl,
    scope;

  // Initialize the controller and a mock scope
  beforeEach(inject(function ($controller, $rootScope) {
    scope = $rootScope.$new();
    ImprintCtrl = $controller('ImprintCtrl', {
      $scope: scope
      // place here mocked dependencies
    });
  }));

  it('should attach a list of awesomeThings to the scope', function () {
    expect(ImprintCtrl.awesomeThings.length).toBe(3);
  });
});
