<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="author" content="Telepathic Soft">
        <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1, maximum-scale=1">
        <title><?= $title ?></title>

        <link rel="shortcut icon" href="<?php echo $url; ?>favicon.ico"  />

        <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap-glyphicons.css" rel="stylesheet">
        <link href="<?= $url ?>assets/css/bootstrap-admin.min.css" rel="stylesheet" type="text/css">
        <link href="<?= $url ?>assets/css/londinium-theme_admin.css" rel="stylesheet" type="text/css">
        <link href="<?= $url ?>assets/css/styles_admin.css" rel="stylesheet" type="text/css">
        <link href="<?= $url ?>assets/css/icons.css" rel="stylesheet" type="text/css">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
        <link href="<?= $url ?>assets/css/uploadfile.css"  rel="stylesheet"  type="text/css">
        <link href="<?= $url ?>assets/css/uploadfile.custom.css"  rel="stylesheet"  type="text/css">
        <link href="<?= $url ?>assets/css/weather_icons/css/weather-icons.css" rel="stylesheet">
        <link href="<?= $url ?>assets/css/weather_icons/css/weather-icons.min.css" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/tagmanager/3.0.2/tagmanager.min.css">
        <!--<link href="//fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&amp;subset=latin,cyrillic-ext" rel="stylesheet" type="text/css">-->
        <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">


        <script>
            //--- URL BASE ---//
            //LOCAL
            URL = '//localhost/pyme/';

            //SERVIDOR
//                URL = '//tsoft.bisoft.com.ar/';
        </script>

        <script src="//code.jquery.com/jquery.js"></script>
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>

        <script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script>
        <script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.2/jquery-ui.min.js"></script>

        <script type="text/javascript" src="<?= $url ?>assets/js/plugins/charts/sparkline.min.js"></script>
        <script type="text/javascript" src="<?= $url ?>assets/js/plugins/forms/uniform.min.js"></script>
        <script type="text/javascript" src="<?= $url ?>assets/js/plugins/forms/select2.min.js"></script>
        <script type="text/javascript" src="<?= $url ?>assets/js/plugins/forms/inputmask.js"></script>
        <script type="text/javascript" src="<?= $url ?>assets/js/plugins/forms/autosize.js"></script>
        <script type="text/javascript" src="<?= $url ?>assets/js/plugins/forms/inputlimit.min.js"></script>
        <script type="text/javascript" src="<?= $url ?>assets/js/plugins/forms/listbox.js"></script>
        <script type="text/javascript" src="<?= $url ?>assets/js/plugins/forms/multiselect.js"></script>
        <script type="text/javascript" src="<?= $url ?>assets/js/plugins/forms/validate.min.js"></script>
        <script type="text/javascript" src="<?= $url ?>assets/js/plugins/forms/tags.min.js"></script>
        <script type="text/javascript" src="<?= $url ?>assets/js/plugins/forms/switch.min.js"></script>
        <script type="text/javascript" src="<?= $url ?>assets/js/plugins/forms/uploader/plupload.full.min.js"></script>
        <script type="text/javascript" src="<?= $url ?>assets/js/plugins/forms/uploader/plupload.queue.min.js"></script>
        <script type="text/javascript" src="<?= $url ?>assets/js/plugins/forms/wysihtml5/wysihtml5.min.js"></script>
        <script type="text/javascript" src="<?= $url ?>assets/js/plugins/forms/wysihtml5/toolbar.js"></script>
        <script type="text/javascript" src="<?= $url ?>assets/js/plugins/interface/daterangepicker.js"></script>
        <script type="text/javascript" src="<?= $url ?>assets/js/plugins/interface/fancybox.min.js"></script>

<!-- <script type="text/javascript" src="<?= $url ?>assets/js/plugins/interface/moment.js"></script> -->
        <script src="//cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>

        <script type="text/javascript" src="<?= $url ?>assets/js/plugins/interface/jgrowl.min.js"></script>
        <script type="text/javascript" src="<?= $url ?>assets/js/plugins/interface/datatables.min.js"></script>
        <script type="text/javascript" src="<?= $url ?>assets/js/plugins/interface/colorpicker.js"></script>
        <script type="text/javascript" src="<?= $url ?>assets/js/plugins/interface/fullcalendar.min.js"></script>
        <script type="text/javascript" src="<?= $url ?>assets/js/plugins/interface/timepicker.min.js"></script>
        <script type="text/javascript" src="<?= $url ?>assets/js/plugins/charts/flot.js"></script>
        <script type="text/javascript" src="<?= $url ?>assets/js/plugins/charts/flot.pie.js"></script>
        <script type="text/javascript" src="<?= $url ?>assets/js/charts/full/pie.js"></script>

        <script type="text/javascript" src="<?= $url ?>assets/js/bootstrap.min.js"></script>
        <script type="text/javascript" src="<?= $url ?>assets/js/application.js"></script>

        <!-- DatePicker -->
        <link rel="stylesheet" type="text/css" href="<?= $url ?>assets/css/jquery.datetimepicker.css"/>
        <script type="text/javascript" src="<?= $url ?>assets/js/jquery.datetimepicker.js"></script>
        <script type="text/javascript" src="<?= $url ?>assets/js/build/jquery.datetimepicker.full.js"></script>   
        <script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/js/bootstrap-datepicker.min.js"></script> 

        <!-- Tag -->
        <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/tagmanager/3.0.2/tagmanager.min.js"></script>
        <script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.1/bootstrap3-typeahead.min.js"></script> 

        <!-- Upload Multiple Files -->
        <script type="text/javascript" src="<?= $url ?>assets/js/jquery.uploadfile.js"></script>
        <script type="text/javascript" src="<?= $url ?>assets/js/jquery.uploadfile.min.js"></script>

        <!-- Ck Editor-->
        <script type="text/javascript" src="<?= $url ?>assets/plugins/ckeditor/ckeditor.js"></script>
        <!-- Ck Finder-->
        <script type="text/javascript" src="<?= $url ?>assets/plugins/ckfinder/ckfinder.js"></script>

        <!-- Funciones -->
        <script type="text/javascript" src="<?= $url ?>assets/js/coreAdmin.js"></script>
        <script type="text/javascript" src="<?= $url ?>assets/js/coreAdminImportarXLS.js"></script>

        <!-- Include jQuery Validator plugin -->
        <script src="<?= $url ?>assets/js/validator.js"></script>

        <!-- Sweet Alert --> 
        <script type="text/javascript" src="<?= $url ?>assets/js/sweetalert2/sweetalert2.all.js"></script>

        <script>
            /*--- Evito Disable HTML correction - CKEDITOR ---*/
            CKEDITOR.config.allowedContent = true;
        </script>
        
    </head>

    <body>