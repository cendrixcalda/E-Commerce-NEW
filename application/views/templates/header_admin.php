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
                <a href="<?php echo base_url(); ?>admin/dashboard" <?php if($this->uri->segment(2)==""){echo ' class="active"';}?><?php if($this->uri->segment(2)=="dashboard"){echo ' class="active"';}?> >Dashboard</a>
                <a href="<?php echo base_url(); ?>admin/inventory" <?php if($this->uri->segment(2)=="inventory"){echo ' class="active"';}?> >Inventory</a>
                <a class="fold-accordion fold-accordion1">Orders
                    <i class="fa fa-caret-down"></i>
                </a>
                <div class="accordion accordion1">
                    <a href="<?php echo base_url(); ?>admin/orders" <?php if($this->uri->segment(2)=="orders"){echo ' class="active"';}?> >Orders</a>
                    <a href="<?php echo base_url(); ?>admin/orderdetails" <?php if($this->uri->segment(2)=="orderdetails"){echo ' class="active"';}?> >Order Details</a>
                </div>
                
                <?php
                    if($accountType == "Administrator" || $accountType == "Super-Administrator"){
                        echo '<a class="fold-accordion fold-accordion2">Archives
                                <i class="fa fa-caret-down"></i>
                            </a>';

                        echo '<div class="accordion accordion2">
                                <a href="'.base_url().'admin/itemsarchive"';if($this->uri->segment(2)=="itemsarchive"){echo ' class="active"';} echo '" >Items Archive</a>
                                <a href="'.base_url().'admin/ordersarchive"';if($this->uri->segment(2)=="ordersarchive"){echo ' class="active"';} echo '" >Orders Archive</a>
                                <a href="'.base_url().'admin/orderdetailsarchive"';if($this->uri->segment(2)=="orderdetailsarchive"){echo ' class="active"';} echo '" >Order Details Archive</a>
                                <a href="'.base_url().'admin/customersarchive"';if($this->uri->segment(2)=="customersarchive"){echo ' class="active"';} echo '" >Customers Archive</a>
                            </div>';
                    }
                ?>
                <?php
                    if($accountType == "Administrator" || $accountType == "Super-Administrator"){
                        echo '<a href="'.base_url().'admin/customers"';if($this->uri->segment(2)=="customers"){echo ' class="active"';} echo '" >Customers</a>';
                    }
                ?>
                <?php
                    if($accountType == "Administrator" || $accountType == "Super-Administrator"){
                        echo '<a href="'.base_url().'admin/usermanagement"';if($this->uri->segment(2)=="usermanagement"){echo ' class="active"';} echo '" >User Management</a>';
                    }
                ?>
                <a class="fold-accordion fold-accordion3">Other
                    <i class="fa fa-caret-down"></i>
                </a>
 
                <div class="accordion accordion3">
                    <a href="<?php echo base_url(); ?>admin/brands" <?php if($this->uri->segment(2)=="brands"){echo ' class="active"';}?> >Brands</a>
                    <a href="<?php echo base_url(); ?>admin/categories" <?php if($this->uri->segment(2)=="categories"){echo ' class="active"';}?> >Categories</a>
                    <a href="<?php echo base_url(); ?>admin/colors" <?php if($this->uri->segment(2)=="colors"){echo ' class="active"';}?> >Colors</a>
                    <a href="<?php echo base_url(); ?>admin/countries" <?php if($this->uri->segment(2)=="countries"){echo ' class="active"';}?> >Countries</a>
                    <a href="<?php echo base_url(); ?>admin/materials" <?php if($this->uri->segment(2)=="materials"){echo ' class="active"';}?> >Materials</a>
                    <!-- <a href="<?php echo base_url(); ?>admin/sizes" <?php if($this->uri->segment(2)=="sizes"){echo ' class="active"';}?> >Sizes</a> -->
                </div>
                <a class="logout" href="<?php echo base_url(); ?>admin/logout">Logout</a>
            </div>
        </nav>
        <main class="admin-main">