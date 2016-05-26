<div class="row">
    <div class="col-md-7">
       
    </div>
    <div class="col-md-5" style="text-align: right;">
        <a class="btn btn-success btn-xs" href="<?php echo site_url() . '/Product_category/add_new'; ?>">Add new category</a>
    </div>
</div>
<br/>

<?php if ($this->session->flashdata('message')) { ?>
    <div class="alert alert-success" role="alert">
        <span class="glyphicon glyphicon-ok"></span>
        <strong><?php echo $this->session->flashdata('message'); ?></strong>
    </div>
<?php } ?>
<?php
?>
<div class="row" ng-controller="CategoryController">
    <div class="col-md-5">
        <table class="table table-hover table-striped" id="catTable">
            <thead>
                <tr>
                    <td>Category</td>
                    <td>Action</td> 
                </tr>
            </thead>
            <tbody>
                <?php foreach ($categories as $c) { ?>
                    <tr>
                        <td>
                            <a href="<?php echo site_url(); ?>/Product?product_category_id=<?php echo $c->id; ?>">
                                <?php echo $c->product_category_name; ?>
                            </a>
                        </td>

                        <td style="text-align: right;">
                           
                            <a href="<?php echo site_url() . '/Product_category/edit/' . $c->id; ?>" class="btn  btn-primary btn-xs">Edit</a>
                            <a href="<?php echo site_url() . '/Product_category/delete/' . $c->id; ?>" class="btn  btn-danger btn-xs">Delete</a>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>

<script>
    var app = angular.module('myapp', []);
    app.controller('CategoryController', ['$scope', '$http', function ($scope, $http) {
            $http.get('<?php echo $json_fetch_link; ?>').success(function (data) {
                $scope.categories = data;
                console.log("Categories = \n" + data);
            });

        }]);
</script>