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
                <?php
                    $accountType = $this->session->userdata('account_type');
                ?>
                <a class="hide"><i class="fas fa-arrow-left"></i></a>
                <a href="<?php echo base_url(); ?>admin/dashboard" <?php if($this->uri->segment(2)==""){echo ' class="active"';}?><?php if($this->uri->segment(2)=="dashboard"){echo ' class="active"';}?> ><i class="fas fa-chart-bar"></i>Dashboard</a>
                <a href="<?php echo base_url(); ?>admin/inventory" <?php if($this->uri->segment(2)=="inventory"){echo ' class="active"';}?> ><i class="fas fa-warehouse"></i>Inventory</a>
                <a class="fold-accordion fold-accordion1"><i class="fas fa-shopping-cart"></i>Orders
                    <i class="fa fa-caret-down"></i>
                </a>
                <div class="accordion accordion1">
                    <a href="<?php echo base_url(); ?>admin/orders" <?php if($this->uri->segment(2)=="orders"){echo ' class="active"';}?> ><i class="fas fa-shopping-cart"></i>Orders</a>
                    <a href="<?php echo base_url(); ?>admin/order_details" <?php if($this->uri->segment(2)=="order_details"){echo ' class="active"';}?> ><i class="fas fa-shopping-cart"></i>Order Details</a>
                </div>
                
                <?php
                    if($accountType == "Administrator" || $accountType == "Super-Administrator"){
                        echo '<a class="fold-accordion fold-accordion2"><i class="fas fa-archive"></i>Archives
                                <i class="fa fa-caret-down"></i>
                            </a>';

                        echo '<div class="accordion accordion2">
                                <a href="'.base_url().'admin/items_archive"';if($this->uri->segment(2)=="items_archive"){echo ' class="active"';} echo '" ><i class="fas fa-archive"></i>Items Archive</a>
                                <a href="'.base_url().'admin/orders_archive"';if($this->uri->segment(2)=="orders_archive"){echo ' class="active"';} echo '" ><i class="fas fa-archive"></i>Orders Archive</a>
                                <a href="'.base_url().'admin/order_details_archive"';if($this->uri->segment(2)=="order_details_archive"){echo ' class="active"';} echo '" ><i class="fas fa-archive"></i>Order Details Archive</a>
                                <a href="'.base_url().'admin/customers_archive"';if($this->uri->segment(2)=="customers_archive"){echo ' class="active"';} echo '" ><i class="fas fa-archive"></i>Customers Archive</a>
                            </div>';
                    }
                ?>
                <?php
                    if($accountType == "Administrator" || $accountType == "Super-Administrator"){
                        echo '<a href="'.base_url().'admin/customers"';if($this->uri->segment(2)=="customers"){echo ' class="active"';} echo '" ><i class="fas fa-user-tag"></i>Customers</a>';
                    }
                ?>
                <?php
                    if($accountType == "Administrator" || $accountType == "Super-Administrator"){
                        echo '<a href="'.base_url().'admin/user_management"';if($this->uri->segment(2)=="user_management"){echo ' class="active"';} echo '" ><i class="fas fa-user"></i>User Management</a>';
                    }
                ?>
                <a class="fold-accordion fold-accordion3"><i class="fas fa-ellipsis-h"></i>Other
                    <i class="fa fa-caret-down"></i>
                </a>
 
                <div class="accordion accordion3">
                    <a href="<?php echo base_url(); ?>admin/brands" <?php if($this->uri->segment(2)=="brands"){echo ' class="active"';}?> ><i class="fas fa-tags"></i>Brands</a>
                    <a href="<?php echo base_url(); ?>admin/categories" <?php if($this->uri->segment(2)=="categories"){echo ' class="active"';}?> ><i class="fas fa-th"></i>Categories</a>
                    <a href="<?php echo base_url(); ?>admin/colors" <?php if($this->uri->segment(2)=="colors"){echo ' class="active"';}?> ><i class="fas fa-palette"></i>Colors</a>
                    <a href="<?php echo base_url(); ?>admin/countries" <?php if($this->uri->segment(2)=="countries"){echo ' class="active"';}?> ><i class="fas fa-flag"></i>Countries</a>
                    <a href="<?php echo base_url(); ?>admin/materials" <?php if($this->uri->segment(2)=="materials"){echo ' class="active"';}?> ><i class="fas fa-tshirt"></i>Materials</a>
                    <!-- <a href="<?php echo base_url(); ?>admin/sizes" <?php if($this->uri->segment(2)=="sizes"){echo ' class="active"';}?> >Sizes</a> -->
                </div>
                <a class="logout" href="<?php echo base_url(); ?>admin/logout"><i class="fas fa-sign-out-alt"></i>Logout</a>
            </div>
        </nav>
        <main class="admin-main">