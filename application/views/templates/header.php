<!DOCTYPE html>
<html lang="es">
<head>
    
    <meta charset="UTF-8">
    <meta name="viewport" content="initial-scale=1">    
    <meta http-equiv="cache-control" content="max-age=0" />
    <meta http-equiv="cache-control" content="no-cache" />
    <meta http-equiv="expires" content="0" />
    <meta http-equiv="expires" content="Tue, 01 Jan 1980 1:00:00 GMT" />
    <meta http-equiv="pragma" content="no-cache" />
    <link rel="search" 
          title="ReLife Cloud" 
          type="application/opensearchdescription+xml"
          href="https://relifecloud-nonodev96.c9users.io/opensearch.xml" />

    <title><?= !empty($title) ? $title : "Re-Life" ?></title>
    <!-- Favicon-->
    <link rel="icon" href="../../favicon.ico" type="image/x-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">

    <!-- Bootstrap Core Css -->
    <link href="/assets/plugins/bootstrap/css/bootstrap.css" rel="stylesheet">

    <!-- Waves Effect Css -->
    <link href="/assets/plugins/node-waves/waves.css" rel="stylesheet" />

    <!-- Animation Css -->
    <link href="/assets/plugins/animate-css/animate.css" rel="stylesheet" />

    <!-- Custom Css -->
    <link href="/assets/css/style.css" rel="stylesheet">
    
    <!-- AdminBSB Themes. You can choose a theme from css/themes instead of get all themes -->
    <link href="/assets/css/themes/all-themes.css" rel="stylesheet" />
    
    <?php if (!empty($module["dropzone_plugin"]) and $module["dropzone_plugin"] == true) { ?>
        
        <!-- Dropzone Css -->
        <link href="/assets/plugins/dropzone/dropzone.css" rel="stylesheet">
    
    <?php } ?>
    
    <?php if (!empty($module["database_table"]) and $module["database_table"] == true) { ?>
        
        <!-- Bootstrap DataTables Css -->
        <link href="/assets/plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css" rel="stylesheet">
    
    <?php } ?>
    
    <?php if (!empty($module["select_plugin"]) and $module["select_plugin"] == true) { ?>
    
        <!-- Bootstrap Select Css -->
        <link href="/assets/plugins/bootstrap-select/css/bootstrap-select.css" rel="stylesheet">
    
    <?php } ?>
    
    <?php if (!empty($module["lightgallery_plugin"]) and $module["lightgallery_plugin"] == true) { ?>
    
        <!-- Light Gallery Plugin Css -->
        <link href="/assets/plugins/light-gallery/css/lightgallery.css" rel="stylesheet">
    
    <?php } ?>
    
    <?php if (!empty($module["datetimepicker_plugin"]) and $module["datetimepicker_plugin"] == true) { ?>
    
        <!-- Bootstrap Material Datetime Picker Css -->
        <link href="/assets/plugins/bootstrap-material-datetimepicker/css/bootstrap-material-datetimepicker.css" rel="stylesheet" />
    
    <?php } ?>
    
    <?php if (!empty($module["editor_md"]) and $module["editor_md"] == true) { ?>
    
        <!-- Editor md Css -->
        <link rel="stylesheet" href="/assets/plugins/editor.md/css/editormd.css" />
    
    <?php } ?>
    
    <link href="/assets/css/my-style.css" rel="stylesheet" />
    

</head>
<body class="<?= !empty($body_class) ? $body_class : "theme-red" ?>">
   