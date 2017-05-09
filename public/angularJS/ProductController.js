/**
 * Created by Good on 3/28/2017.
 */

app.controller('ProductController', function($scope, $http, API) {

    $http.get(API + 'category').then(function (response) {
        $scope.categorys = response.data;
    }); // Load nhóm sản phẩm

    $http.get(API + 'unit').then(function (response) {
        $scope.units = response.data;
    }); // Load đơn vị tính

    $http.get(API + 'manufacturer').then(function (response) {
        $scope.manufacturers = response.data;
    }); // Load nhà sản xuất

    $http.get(API + 'attribute').then(function (response) {
        $scope.attributes = response.data;
    }); // Load thuộc tính sản phẩm
    $http.get(API + 'image').then(function (response) {
        $scope.images = response.data;
    });


    // Load danh sách sản phẩm
    $scope.loadProduct = function () {
        $http.get(API + 'product').then(function (response) {
            $scope.products = response.data;
        });
    };
    $scope.loadProduct();

    /**
     * CRUD sản phẩm
     */
    $scope.data = []; // Lưu danh sách thuộc tính tạm thời
    $scope.image = []; // Lưu danh sách hình ảnh tạm thời

    // Xem thông tin sản phẩm
    $scope.readProduct = function (product) {
        $http.get(API + 'product/' + product.id).then(function (response) {
            $scope.selected = response.data;
            CKEDITOR.instances.description.setData($scope.selected.description);
            CKEDITOR.instances.user_guide.setData($scope.selected.user_guide);
        });
    };

    $scope.options = {
        numeral: {
            numeral: true
        },
        code: {
            blocks: [1, 3, 3, 3, 3],
            delimiters: ['-']
        }
    };
});

$('#readProduct').on('show.bs.modal', function (event) {
    var modal = $(this);
    modal.find('.modal-title').text('Xem thông tin sản phẩm');
    modal.find('.modal-title').removeClass('w3-text-green');
    modal.find('.modal-title').addClass('w3-text-blue');
    modal.find('#name').attr('readOnly', true);
    modal.find('#code').attr('readOnly', true);
    CKEDITOR.instances.description.setReadOnly(true);
    CKEDITOR.instances.user_guide.setReadOnly(true);
    var myDropzone = Dropzone.forElement(".dropzone");
    myDropzone.removeAllFiles();
    modal.find('#category').attr('disabled', true);
    modal.find('#manufacturer').attr('disabled', true);
    modal.find('#unit').attr('disabled', true);
    modal.find('#web_price').attr('readOnly', true);
    modal.find('#min_inventory').attr('readOnly', true);
    modal.find('#max_inventory').attr('readOnly', true);
    modal.find('#warranty_period').attr('readOnly', true);
    modal.find('#return_period').attr('readOnly', true);
    modal.find('#weight').attr('readOnly', true);
    modal.find('#size').attr('readOnly', true);
    modal.find('#volume').attr('readOnly', true);
    modal.find('#addAttribute').attr('disabled', true);
    modal.find('#addImage').attr('disabled', true);
    modal.find('#submit').hide();
    modal.find('#updateProduct').show();
    modal.find('#updateProduct').click(function () {
        modal.find('.modal-title').text('Sửa thông tin sản phẩm');
        modal.find('.modal-title').removeClass('w3-text-blue');
        modal.find('.modal-title').addClass('w3-text-green');
        modal.find('#name').removeAttr('readOnly');
        modal.find('#code').removeAttr('readOnly');
        CKEDITOR.instances.description.setReadOnly(false);
        CKEDITOR.instances.user_guide.setReadOnly(false);
        modal.find('#user_guide').removeAttr('disabled');
        modal.find('#category').removeAttr('disabled');
        modal.find('#manufacturer').removeAttr('disabled');
        modal.find('#unit').removeAttr('disabled');
        modal.find('#web_price').removeAttr('readOnly');
        modal.find('#min_inventory').removeAttr('readOnly');
        modal.find('#max_inventory').removeAttr('readOnly');
        modal.find('#warranty_period').removeAttr('readOnly');
        modal.find('#return_period').removeAttr('readOnly');
        modal.find('#weight').removeAttr('readOnly');
        modal.find('#size').removeAttr('readOnly', true);
        modal.find('#volume').removeAttr('readOnly', true);
        modal.find('#addAttribute').removeAttr('disabled');
        modal.find('#addImage').removeAttr('disabled');
        modal.find('#updateProduct').hide();
        modal.find('#submit').show();
    });
});

$("#my_dropzone").dropzone({
    maxFilesize: 2,
    autoProcessQueue: false,
    addRemoveLinks: true
});

$("#my_dropzone02").dropzone({
    maxFilesize: 2,
    autoProcessQueue: false,
    addRemoveLinks: true,
});

$("#viewList").click(function () {
    $("#viewList").addClass('w3-blue-grey');
    $("#viewGrid").removeClass('w3-blue-grey');
    $("#grid").attr('hidden', true);
    $("#list").removeAttr('hidden');
});

$("#viewGrid").click(function () {
    $("#viewList").removeClass('w3-blue-grey');
    $("#viewGrid").addClass('w3-blue-grey');
    $("#list").attr('hidden', true);
    $("#grid").removeAttr('hidden');
});