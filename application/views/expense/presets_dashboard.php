<div ng-controller="PresetController">
    <div class="row well">
        <div class="col-md-12">
            <form class="form-inline">
                <input type="hidden" ng-model="id" value="{{id}}"/>
                <div class="form-group">
                    <label for="exampleInputEmail1">Amount</label>
                    <input ng-model="amount" type="number" class="form-control" id="exampleInputEmail1" placeholder="">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Comment</label>
                    <input ng-model="comment" type="text" class="form-control" id="exampleInputEmail1" placeholder="">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Expense Type</label>

                    <select required name="type" ng-model="tag" class="form-control">
                        <option value="">Choose Type</option>
                        <?php foreach ($categories as $c) { ?>
                            <option value="<?php echo $c->id; ?>"><?php echo $c->product_category_name; ?></option>
                        <?php } ?>
                    </select>
                </div>

                <button type="submit" id="saveButton" class="btn btn-success pull-right" ng-click="addAPreset();">Save</button>
                <button type="submit" id="updateButton" style="display: none;" class="btn btn-info pull-right" ng-click="updatePreset();">Update</button>
            </form>


        </div>
    </div>

    <div class="row well">
        <div class="col-md-12">
            <table class="table table-hover table-striped table-compact table-bordered">
                <thead><tr>
                        <td>Id</td>
                        <td>Amount</td>
                        <td>Comment</td>
                        <td>User</td>
                        <td>Tag</td>
                        <td>Action</td>
                    </tr>
                </thead>
                <tbody>
                    <tr ng-repeat="preset in presets| filter: m">
                        <td>{{preset.id}}</td>
                        <td>{{preset.amount}}</td>
                        <td>{{preset.comment}}</td>
                        <td>{{preset.user}}</td>
                        <td>{{preset.category_name}}</td>
                        <td>
                            <a href="#" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit" ng-click="selectForUpdate(preset.id, preset.amount, preset.comment, preset.tag);"></i></a>
                            <a href="#" class="btn btn-xs btn-danger"><i class="glyphicon glyphicon-remove" ng-click="deletePreset(preset.id);"></i></a>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
<script>
    var app = angular.module('myapp', []);
    app.controller('PresetController', ['$scope', '$http', function ($scope, $http) {

            $http.get('<?php echo $presets_fetch_url; ?>').success(function (data) {
                $scope.presets = data;
                console.log(data);
            });


            $scope.getAllPresets = function () {
                $http.get('<?php echo $presets_fetch_url; ?>').success(function (data) {
                    $scope.presets = data;
                    console.log(data);
                });
            }

            $scope.deletePreset = function (preset_id) {
                $http.get('<?php echo $preset_delete_url; ?>/' + preset_id).success(function (data) {
                    console.log("preset deleted = (id) = " + preset_id);
                    $scope.getAllPresets();
                });
            }

            $scope.addAPreset = function () {
                amount = $scope.amount;
                comment = $scope.comment;
                tag = $scope.tag;


                if (amount <= 0 || comment == null || tag == null) {
                    alert("Maa ki aankh");
                } else { //All set

                    $http({
                        method: 'POST',
                        url: "<?php echo $presets_add_post_url; ?>",
                        headers: {'Content-Type': 'application/x-www-form-urlencoded'},
                        transformRequest: function (obj) {
                            var str = [];
                            for (var p in obj)
                                str.push(encodeURIComponent(p) + "=" + encodeURIComponent(obj[p]));
                            return str.join("&");
                        },
                        data: {amount: $scope.amount, comment: $scope.comment, tag: $scope.tag}
                    }).success(function () {
                        $scope.getAllPresets();
                        $scope.amount = '';
                        $scope.comment = '';
                        $scope.tag = '';
                    });
                }
            }

            $scope.selectForUpdate = function (preset_id, amount, comment, tag) {
                $scope.amount = Number(amount);
                $scope.comment = comment;
                $scope.tag = tag;
                $scope.id = preset_id;

                $("#saveButton").hide();
                $("#updateButton").show();
                
            }

            $scope.updatePreset = function(){
                id = $scope.id;
                amount = $scope.amount;
                comment = $scope.comment;
                tag = $scope.tag;


                if (id == null || amount <= 0 || comment == null || tag == null) {
                    alert("Maa ki aankh");
                } else { //All set

                    $http({
                        method: 'POST',
                        url: "<?php echo $preset_update_url; ?>/" + id,
                        headers: {'Content-Type': 'application/x-www-form-urlencoded'},
                        transformRequest: function (obj) {
                            var str = [];
                            for (var p in obj)
                                str.push(encodeURIComponent(p) + "=" + encodeURIComponent(obj[p]));
                            return str.join("&");
                        },
                        data: {id: $scope.id, amount: $scope.amount, comment: $scope.comment, tag: $scope.tag}
                    }).success(function () {
                        $scope.getAllPresets();
                        $scope.amount = '';
                        $scope.comment = '';
                        $scope.tag = '';
                        $("#saveButton").show();
                        $("#updateButton").hide();
                        
                    });
                }
            }

        }]);
</script>