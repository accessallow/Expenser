<?php
if (isset($edit)) {
    $heading = "Edit expense entry";
} else {
    $heading = "Add new expense entry";
}
?>

<h3>
    <?php echo $heading; ?>
</h3>
<hr/>


<?php if ($this->session->flashdata('message')) { ?>
    <div class="alert <?php echo $this->session->flashdata('alert_class'); ?>" role="alert">
        <span class="glyphicon <?php echo $this->session->flashdata('glyphicon_class'); ?>"></span>
        <strong><?php echo $this->session->flashdata('message'); ?></strong>
    </div>
<?php } ?>


<div ng-controller="RateController">
    <form class="form-horizontal" 
          data-parsley-validate role="form" 
          action="<?php echo $form_submit_url; ?>" method="POST">

        <?php if (isset($edit)) { ?>
            <input type="hidden" name="entry_id" value="<?php echo $entry->id; ?>"/>
        <?php } ?>



        <div class="form-group">
            <label class="col-sm-2 control-label">Amount</label>
            <div class="col-sm-2">


                <input type="number"  

                       ng-model="myamount" 
                       name="amount"
                       class="form-control" 
                       required 
                       placeholder=""/> 

            </div>

        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label">Comment</label>
            <div class="col-sm-4">


                <input type="text"  


                       ng-model="mycomment" 
                       class="form-control" 
                       required
                       name="comment"
                       placeholder=""/> 

            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label">Expense Type</label>
            <div class="col-sm-4">


                <select required name="type" ng-model="mytype" class="searchable">
                    <option value="">Choose Type</option>
                    <?php foreach ($categories as $c) { ?>
                        <option value="<?php echo $c->id; ?>"><?php echo $c->product_category_name; ?></option>
                    <?php } ?>
                </select>





            </div>
        </div>

        <div class="form-group">
            <label class="col-sm-2 control-label">Date</label>

            <div class="col-sm-4">

                <div class='input-group date' id='datetimepicker1'>

                    <input type="text" 
                           required
                           ng-model="mydate"
                           data-date-format="YYYY-MM-DD"
                           class="form-control"
                           name="date" 
                           placeholder=""/> 

                    <span class="input-group-addon">
                        <span class="glyphicon glyphicon-calendar"></span>
                    </span>


                </div>

            </div>

        </div>




        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <input accesskey="s" type="submit" class="btn btn-success" value="Save"/>
                <input type="reset" class="btn" value="Clear"/>
                <a accesskey="c" href="<?php echo site_url() . '/Expense/dashboard'; ?>" class="btn btn-primary">Back</a>
            </div>
        </div>
    </form>
</div> <!--controller div-->

<script>
    var app = angular.module('myapp', []);
    app.controller('RateController', ['$scope', '$http', function ($scope, $http) {


<?php if (isset($edit)) { ?>
                $scope.entry_id = '<?php echo $entry->id; ?>';
                $scope.myamount = <?php echo $entry->amount; ?>;
                $scope.mycomment = '<?php echo $entry->comment; ?>';
                $scope.mytype = <?php echo $entry->tag; ?>;
                $scope.mydate = '<?php echo $entry->date; ?>';
                

<?php } else { ?>


<?php } ?>
        }]);
</script>