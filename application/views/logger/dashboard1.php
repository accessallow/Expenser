<div ng-controller="LogController">
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Add new link</h4>
                </div>
                <form action="<?php echo $add_entry_link; ?>" method="post" class="form-horizontal">
                    <div class="modal-body">
                        <div class="form-group" style="text-align: center;">
                            <label class="col-sm-2 control-label">Link</label>
                            <div class="col-sm-10">
                                <input type="text" 
                                       class="form-control" 
                                       required name="link"
                                       placeholder=""
                                       /> 
                            </div>
                        </div>
                        <div class="form-group" style="text-align: center;">
                            <label class="col-sm-2 control-label">Caption</label>
                            <div class="col-sm-10">
                                <input type="text" 
                                       class="form-control" 
                                       required name="info"
                                       placeholder=""
                                       /> 
                            </div>
                        </div>
                        <div class="form-group" style="text-align: center;">
                            <label class="col-sm-2 control-label">Chapter</label>
                            <div class="col-sm-10">
                                <select
                                    class="form-control"
                                    required name="chapter_id">

                                    <option ng-repeat="chapter in chapters" value="{{chapter.id}}">{{chapter.name}}</option>

                                </select>


                            </div>
                        </div>


                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                        <input type="submit" class="btn btn-success" value="Save"/>
                    </div>
                </form>
            </div>
        </div>


    </div>


    <div class="modal fade" id="addChapterModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Add new chapter</h4>
                </div>
                <form action="<?php echo $add_chapter_link; ?>" method="post" class="form-horizontal">
                    <div class="modal-body">
                        <div class="form-group" style="text-align: center;">
                            <label class="col-sm-3 control-label">Chapter name</label>
                            <div class="col-sm-9">
                                <input type="text" 
                                       class="form-control" 
                                       required name="chapter_name"
                                       placeholder=""
                                       /> 
                            </div>
                        </div>




                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                        <input type="submit" class="btn btn-success" value="Save"/>
                    </div>
                </form>
            </div>
        </div>


    </div>


    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">{{delete_caption}}</h4>
                    <input type="text" ng-model="delete_caption"/>
                </div>
                <form action="{{delete_link}}" method="post" class="form-horizontal">
                    <div class="modal-body">
                        <div class="form-group" style="text-align: center;">
                            <label class="col-sm-12 control-label">{{delete_message}}</label>               
                        </div>




                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                        <input type="submit" class="btn btn-danger" value="Delete"/>
                    </div>
                </form>
            </div>
        </div>


    </div>



    <?php if ($this->session->flashdata('message')) { ?>
        <div class="alert <?php echo $this->session->flashdata('alert_class'); ?>" role="alert">
            <span class="glyphicon <?php echo $this->session->flashdata('glyphicon_class'); ?>"></span>
            <strong><?php echo $this->session->flashdata('message'); ?></strong>
        </div>
    <?php } ?>

    <div class="row" ng-controller="LogController">
        <div  class="col-md-9">


            <table class="table table-hover table-compact table-striped table-bordered">
                <thead>
                    <tr>
                        <td>Entries : <?php echo $chapter_name; ?>
                            <a href="#" id="addNewEntry" class="btn btn-warning btn-xs pull-right">Add new</a> 

                            <a style="margin-right: 10px; " href="<?php echo site_url("Logger"); ?>"  class="btn btn-default btn-xs pull-right">All</a> </td>
                    </tr>
                </thead>
                <tbody>
                    <tr ng-repeat="log in logs| filter:chapter">
                        <td>
                            <a href="{{log.link}}" target="_blank" >{{log.info}}</a>
                            <span class="pull-right">
                                <a href="<?php echo $entry_edit_url; ?>/{{log.id}}" class="btn btn-xs btn-primary">E</a>
                                <a href="<?php echo $entry_delete_url; ?>/{{log.id}}" class="btn btn-xs btn-danger">D</a>
                            </span>
                        </td>

                    </tr>
                </tbody>
            </table>
        </div>
        <div class="col-md-3">
            <table class="table table-compact table-striped table-bordered">
                <thead>
                    <tr><td>Chapters 
                            <a href="#" class="btn btn-xs btn-warning pull-right" id="addChapter">+</a></td></tr>
                </thead>
                <tbody>
                    <tr ng-repeat="chapter in chapters" ng-class="{success:selectedRow(chapter.id)}">
                        <td><a href="<?php echo site_url('Logger'); ?>/index/{{chapter.id}}">{{chapter.name}}</a>
                            <span class="pull-right">
                                <a href="<?php echo $chapter_edit_url; ?>/{{chapter.id}}" class="btn btn-xs btn-primary">E</a>
                                <a href="<?php echo $chapter_delete_url; ?>/{{chapter.id}}" class="btn btn-xs btn-danger">D</a>
                            </span>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
<script>
    var app = angular.module('myapp', []);
    app.controller('LogController', ['$scope', '$http', function ($scope, $http) {


            $http.get('<?php echo $json_fetch_link; ?>').success(function (data) {
                $scope.logs = data;
            });

            $http.get('<?php echo $chapter_json_fetch_link; ?>').success(function (data) {
                $scope.chapters = data;
            });

            $scope.selectedRow = function (chapter_id) {
                myChapterId = <?php echo $chapter_id;?>;
                if(chapter_id==myChapterId){
                    return true;
                }else{
                    return false;
                }
            }
//airtel customer care bhopal          
//07554444121
        }]);

    app.controller('AddController', ['$scope', '$http', function ($scope, $http) {
            $http.get('<?php echo $chapter_json_fetch_link; ?>').success(function (data) {
                $scope.chapters = data;
            });
        }]);

    $(document).ready(function () {

        $("#addNewEntry").click(function () {
            $('#myModal').modal();
        });

        $("#addChapter").click(function () {
            $('#addChapterModal').modal();
        });

    });

</script>