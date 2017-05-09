/**
 * Created by Good on 3/28/2017.
 */
app.controller('SlideController', function($scope, $http, API) {

    /**
     * Load danh sách danh mục sản phẩm
     */
    $scope.loadSlide = function () {
        $http.get(API).then(function (response) {
            $scope.slides = response.data;
        });
    };
    $scope.loadSlide();

    /**
     * CRUD đơn vị tính
     */
    $scope.createSlide = function () {
        $http({
            method : 'POST',
            url : API,
            data : $scope.new,
            cache : false,
            header : {'Content-Type':'application/x-www-form-urlencoded'}
        }).then(function (response) {
            if(response.data.success) {
                toastr.success(response.data.success);
                $("[data-dismiss=modal]").trigger({ type: "click" });
                $scope.loadSlide();
            }
            else
                toastr.error(response.data[0]);
        });
    };

    $scope.readSlide = function (slide) {
        $http.get(API + 'slide/' + slide.id).then(function (response) {
            $scope.selected = response.data;
        });
    };

    $scope.updateSlide = function () {
        $http({
            method : 'PUT',
            url : API + 'slide/' + $scope.selected.id,
            data : $scope.selected,
            cache : false,
            header : {'Content-Type':'application/x-www-form-urlencoded'}
        }).then(function (response) {
            if(response.data.success) {
                toastr.success(response.data.success);
                $("[data-dismiss=modal]").trigger({ type: "click" });
                $scope.loadSlide();
            }
            else
                toastr.error(response.data[0]);
        });
    };

    $scope.deleteSlide = function () {
        $http({
            method : 'DELETE',
            url : API + 'slide/' + $scope.selected.id,
            cache : false,
            header : {'Content-Type':'application/x-www-form-urlencoded'}
        }).then(function (response) {
            if(response.data.success) {
                toastr.success(response.data.success);
                $("[data-dismiss=modal]").trigger({ type: "click" });
                $scope.loadSlide();
            } else
                toastr.error(response.data[0]);
        });
    };

});