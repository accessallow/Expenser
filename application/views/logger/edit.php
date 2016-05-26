<h3>
    Edit Log Entry
</h3>
<hr/>

<div ng-controller="EditController">
    <form class="form-horizontal" 
          data-parsley-validate role="form" 
          action="<?php echo $form_submit_url; ?>" method="POST">


        <input type="hidden" name="id" value="<?php echo $log_entry->id; ?>"/>




        <div class="form-group" style="text-align: center;">
            <label class="col-sm-2 control-label">Link</label>
            <div class="col-sm-8">
                <input type="text" 
                       class="form-control" 
                       required name="link"
                       placeholder=""
                       value="<?php echo $log_entry->link;?>"
                       /> 
            </div>
        </div>
        <div class="form-group" style="text-align: center;">
            <label class="col-sm-2 control-label">Caption</label>
            <div class="col-sm-8">
                <input type="text" 
                       class="form-control" 
                       required name="info"
                       placeholder=""
                       value="<?php echo $log_entry->info;?>"
                       /> 
            </div>
        </div>
        <div class="form-group" style="text-align: center;">
            <label class="col-sm-2 control-label">Chapter</label>
            <div class="col-sm-6">
                <select
                    class="form-control"
                    required name="chapter_id"
                    ng-model="selectedChapter"
                    >
                    <?php foreach($chapters as $c){ ?>
                    <option value="<?php echo $c->id;?>"><?php echo $c->name;?></option>
                    <?php } ?>
                </select>


            </div>
        </div>


        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <input accesskey="s" type="submit" class="btn btn-success" value="Save"/>
                <input type="reset" class="btn" value="Clear"/>
                <a accesskey="c" href="<?php echo $back_url; ?>" class="btn btn-primary">Back</a>
            </div>
        </div>
    </form>
</div> <!--controller div-->

<script>
    var app = angular.module('myapp', []);
    app.controller('EditController', ['$scope', '$http', function ($scope, $http) {
            $http.get('<?php echo $chapter_json_fetch_link; ?>').success(function (data) {
                $scope.chapters = data;
                $scope.selectedChapter = '<?php echo $log_entry->chapter_id;?>';
            });
            
        }]);

</script>