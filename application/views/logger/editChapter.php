<h3>
    Edit Chapter
</h3>
<hr/>

<div ng-controller="RateController">
    <form class="form-horizontal" 
          data-parsley-validate role="form" 
          action="<?php echo $form_submit_url; ?>" method="POST">

       
            <input type="hidden" name="chapter_id" value="<?php echo $chapter->id; ?>"/>
        



        <div class="form-group">
            <label class="col-sm-2 control-label">Chapter name</label>
            <div class="col-sm-6">


                <input type="text"  
                       
                       value="<?php echo $chapter->name; ?>"
                       name="chapter_name"
                       class="form-control" 
                       required 
                       placeholder=""/> 

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
    
</script>