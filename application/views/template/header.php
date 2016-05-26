<!DOCTYPE html>
<html ng-app="myapp">
    <head>
        <meta charset="UTF-8">
        <title><?php echo MegaTitle; ?></title>
        <script src="<?php echo base_url(); ?>assets/jquery/jquery.min18.js"></script>
        <!--<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>-->
        <script src="<?php echo base_url(); ?>assets/searchable/jquery.searchabledropdown-1.0.8.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/angularjs/angular.min.js"></script>
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/bootstrap3/css/bootstrap.min.css" />
        <!--<link rel="stylesheet" href="<?php echo base_url(); ?>assets/bootstrap3/css/bootstrap-theme.min.css" />-->
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/mystyles/style.css" />
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/bootstrap3/css/bootstrap-datetimepicker.min.css" />
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/mystyles/print.css" media="print"/>
        <!-- DataTables CSS -->
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/DataTables-1.10.5/media/css/jquery.dataTables.css">



        <script type="text/javascript">
            $(document).ready(function () {
                $(".searchable").searchable();
            });
        </script>
    <body>
        <nav class="navbar navbar-default" role="navigation">
            <div class="container-fluid">
                <div class="navbar-header">
                    <a class="navbar-brand" href="#"><?php echo MegaTitle; ?></a>
                </div>
                <div class="collapse navbar-collapse">

                    <ul class="nav navbar-nav">

                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                Payment Bills
                                <b class="caret"></b>
                            </a>
                            <ul class="dropdown-menu">
                                <li><a accesskey="." href="<?php echo site_url() . '/Expense/dashboard'; ?>">Dashboard : .</a></li>

                                <li><a accesskey="/" href="<?php echo site_url() . '/Expense/add_new'; ?>">Add new Expense : /</a></li>

                                <li><a accesskey="p" href="<?php echo site_url(). '/ExpensePresets'; ?>">Presets <span class="badge pull-right">P</span></a></li>
                            </ul>
                        </li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                Categories
                                <b class="caret"></b>
                            </a>
                            <ul class="dropdown-menu">
                                <li><a accesskey="k" href="<?php echo site_url() . '/Product_category'; ?>">Dashboard -k</a></li>

                                <li><a accesskey="l" href="<?php echo site_url() . '/Product_category/add_new'; ?>">Add new -l</a></li>

                                
                            </ul>
                        </li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                Link Logs
                                <b class="caret"></b>
                            </a>
                            <ul class="dropdown-menu">
                                <li><a accesskey="i" href="<?php echo site_url('Logger'); ?>">Dashboard -k</a></li>



                            </ul>
                        </li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                Settings
                                <b class="caret"></b>
                            </a>
                            <ul class="dropdown-menu">

                                <li><a href="<?php echo site_url() . '/Expense/password'; ?>">Change password</a></li>
                                <li><a href="<?php echo site_url() . '/Front/logout'; ?>">Logout</a></li>


                            </ul>
                        </li>
                    </ul>



                </div>
            </div><!-- End of its container-fluid-->
        </nav>

        <div class="container">