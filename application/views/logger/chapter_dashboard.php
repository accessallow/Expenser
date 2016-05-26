<?php if ($this->session->flashdata('message')) { ?>
    <div class="alert <?php echo $this->session->flashdata('alert_class'); ?>" role="alert">
        <span class="glyphicon <?php echo $this->session->flashdata('glyphicon_class'); ?>"></span>
        <strong><?php echo $this->session->flashdata('message'); ?></strong>
    </div>
<?php } ?>

<form action="<?php echo $form_submit_url?>" method="post">
    Chapter Name : <input type="text" name="chapter_name"/>
    <p></p>
    <input type="submit" class="btn btn-success"/>
    <a href="<?php echo $back_url;?>" class="btn btn-primary">Back</a>
</form>