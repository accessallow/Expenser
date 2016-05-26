<?php
$type_array = array(
);
foreach ($categories as $c) {
    $type_array[$c->id] = $c->product_category_name;
}
?>





<br/>
<div ng-controller="ExpenseController">
    <div class="row well noprint">
        <div class="col-md-6">
            <h4><?php echo $label; ?>
                <?php
                if (isset($get_all_link)) {
                    echo $get_all_link;
                }
                ?>
            </h4>
            <p>
                <span class="badge">Today's total : Rs. <?php echo $todayTotal; ?></span>
                <span class="badge">All total : <?php echo $allTotal; ?></span>
        <!--        <span class="badge">Total cash : <?php //echo $total_cash;            ?></span>
                <span class="badge">Total cheque : <?php //echo $total_cheque;            ?></span>
                <span class="badge">Total pending : <?php //echo $total_pending;            ?></span>-->
            </p>
            <p>
                <?php foreach ($presets as $p) { ?>
                    <a href="#" ng-click="hitShortCut(<?php echo $p->id; ?>);" class="btn btn-sm btn-info"><?php echo $p->comment; ?>  <span class="badge"><?php echo $p->amount; ?></span></a>    
                <?php } ?>
            </p>
        </div>
        <div class="col-md-6" style="text-align: right;">
            <a class="btn btn-success btn-xs noprint"
               href="<?php echo $add_link; ?>">
                   <?php echo $addButtonLabel; ?>
            </a>
            <a class="btn btn-warning btn-xs noprint"
               href="<?php echo $analyze_link; ?>">
                   <?php echo $analyseButtonLabel; ?>
            </a>
        </div>
    </div>
    <div class="row" >
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h3 class="panel-title">Today's expenses
                
                <a href="<?php echo site_url('Expense\allEntries');?>" class="btn btn-xs btn-warning pull-right">All Expenses</a>
                </h3>
                
            </div>
            <div class="panel-body" >
                <ul class="expense_list">
                    <li ng-repeat="bill in bills">
                        <p class="price">{{bill.amount}}</p>
                        <p class="comment">{{bill.comment}}</p>
                        <p class="buttons">
                            <a href="<?php echo site_url('Expense/update/'); ?>/{{bill.id}}" class="btn btn-primary btn-xs"><i class="glyphicon glyphicon-edit"></i></a>
                            <a href="<?php echo site_url('Expense/delete/'); ?>/{{bill.id}}" class="btn btn-danger btn-xs"><i class="glyphicon glyphicon-remove"></i></a>
                        </p>
                    </li>
                </ul>
            </div>
        </div>
    </div>

   
<table 
        class="table table-hover table-striped table-bordered"
        id="mytable">

        <thead style="font-size: 0.8em;">
            <tr>
                <td>Bill id</td>
                <td>Amount</td>
                <td>Comment</td>
                <td>Date</td>
                <td>Type</td>
                <td class="noprint">Action</td>
            </tr>
        </thead>
    <!--    <tfoot>
            <tr class="noprint">
    
                <td>Bill id</td>
                <td>Amount</td>
                <td>Comment</td>
                <td>Date</td>
                <td>Type</td>
                <td class="noprint">Action</td>
            </tr>
        </tfoot>-->
        <tbody>
            <?php foreach ($bills as $b) { ?>
                <tr>

                    <td><?php echo $b->id; ?></td>
                    <td><?php echo $b->amount; ?></td>
                    <td><?php echo $b->comment; ?></td>
                    <td><?php echo $b->date; ?></td>
                    <td><?php echo $type_array[$b->tag]; ?></td>
                    <td class="noprint">
                        <a href="<?php echo site_url('Expense/update/' . $b->id); ?>" class="btn btn-primary btn-xs">Edit</a>
                        <a href="<?php echo site_url('Expense/delete/' . $b->id); ?>" class="btn btn-danger btn-xs">Delete</a>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>



</div>

<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script>
    var app = angular.module('myapp', []);
    app.controller('ExpenseController', ['$scope', '$http', function ($scope, $http) {
            $scope.getAllBills = function () {
                $http.get('<?php echo $todayExpenseFetchUrl; ?>').success(function (data) {
                    $scope.bills = data.bills;
                    $scope.weeks = data.weekReport;
                    console.log(data);
                });
            }
            $scope.getAllBills();

            
            
            $scope.drawChart = function(){
               
                var data = google.visualization.arrayToDataTable([
                    ['Week', 'Expenditure'],
                    ['4th Last Week', Number($scope.weeks.fourthLastWeek)],
                    ['3rd Last Week', Number($scope.weeks.thirdLastWeek)],
                    ['2nd Last Week', Number($scope.weeks.secLastWeek)],
                    ['Last Week', Number($scope.weeks.lastWeek)],
                    ['Current Week', Number($scope.weeks.currentWeek)]
                ]);

                var options = {
               
                    legend: {position: 'bottom'},
                    hAxis: {
                            title: 'Weeks'
                            },
                    vAxis: {
                             title: 'Expense'
                           }
                };

                var chart = new google.visualization.LineChart(document.getElementById('curve_chart'));

                chart.draw(data, options);
            }
            
            $scope.repaintChart = function(){
                google.charts.load('current', {'packages': ['corechart']});
                google.charts.setOnLoadCallback($scope.drawChart);
            }
            
            $scope.repaintChart();
            
            $scope.hitShortCut = function (shortcut_id) {
                $http.get('<?php echo $hitPresetUrl; ?>/' + shortcut_id).success(function (data) {
                    $scope.getAllBills();
                    $scope.drawChart();
                });
            }
        }]);
</script>




