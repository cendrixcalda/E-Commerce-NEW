<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>E-Commerce Website</title>
    <link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/style.css">
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"
    integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
</head>
<body>
    <nav>
        <div class="tools">
            <div class="search-bar">
                <input type="text" name="search" placeholder="Search">
                <i class="fas fa-search"></i>
            </div>
            <div class="other">
                <a href="#" class="icon-label-container">
                    <i class="fas fa-user"></i> Log In
                </a>
                <a href="#" class="icon-label-container">
                <i class="fas fa-shopping-cart"></i> Cart
                </a>
            </div>
        </div>
        <div class="navigation">
            <a href="<?php echo base_url(); ?>"  <?php if($this->uri->segment(1)==""){echo ' class="active"';}?> >Home</a>
            <a href="<?php echo base_url(); ?>shop/men"  <?php if($this->uri->segment(2)=="men"){echo ' class="active"';}?> >Men</a>
            <a href="<?php echo base_url(); ?>shop/women"  <?php if($this->uri->segment(2)=="women"){echo ' class="active"';}?> >Women</a>
        </div>
    </nav>
    