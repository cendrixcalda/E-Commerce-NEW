<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>E-Commerce | Admin</title>
    <link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">
    <link href="<?php echo base_url(); ?>assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/css/mdb.min.css" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/style.css">
    <link href="<?php echo base_url(); ?>assets/css/addons/datatables.min.css" rel="stylesheet">
    
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery-3.4.1.min.js"></script>
</head>
<body>
    <div class="admin-body">
        <button class="fa fa-bars hamburger"></button>
        <nav class="admin-nav">
            <div class="navigation-admin">
                <a class="hide"><i class="fas fa-arrow-left"></i></a>
                <a href="<?php echo base_url(); ?>admin/dashboard" <?php if($this->uri->segment(2)==""){echo ' class="active"';}?><?php if($this->uri->segment(2)=="dashboard"){echo ' class="active"';}?> >Dashboard</a>
                <a href="<?php echo base_url(); ?>admin/inventory" <?php if($this->uri->segment(2)=="inventory"){echo ' class="active"';}?> >Inventory</a>
                <a href="<?php echo base_url(); ?>admin/usermanagement" <?php if($this->uri->segment(2)=="usermanagement"){echo ' class="active"';}?> >User Management</a>
                <a href="<?php echo base_url(); ?>admin/editfeatured" <?php if($this->uri->segment(2)=="editfeatured"){echo ' class="active"';}?> >Edit Featured Item</a>
            </div>
        </nav>
        <main class="admin-main">