        </main>
    </div>
    
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/popper.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/mdb.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/addons/datatables.min.js"></script>
    <script>
    $(document).ready(function () {
    
        $('.hide').on('click', function(){
            $('.admin-nav').toggleClass('hide-nav');
            $('.dtHorizontalVerticalExampleWrapper').toggleClass('max-view');
            $('.hamburger').toggleClass('show');
        });
        
        $('.hamburger').on('click', function(){
            $('.admin-nav').toggleClass('hide-nav');
            $('.dtHorizontalVerticalExampleWrapper').toggleClass('max-view');
            $('.hamburger').toggleClass('show');
        });

        <?php 
            $url = $this->uri->segment(2);

            if($url == "orders" || $url == "orderdetails"){
                echo "$('.accordion1').toggleClass('hide-accordion');
                    $('.fold-accordion1 .fa').toggleClass('fa-rotate-180');";
            }

            if($url == "itemsarchive" || $url == "ordersarchive" || $url == "orderdetailsarchive"){
                echo "$('.accordion2').toggleClass('hide-accordion');
                    $('.fold-accordion2 .fa').toggleClass('fa-rotate-180');";
            }

            if($url == "brands" || $url == "categories" || $url == "colors" || $url == "countries" || $url == "materials"){
                echo "$('.accordion3').toggleClass('hide-accordion');
                    $('.fold-accordion3 .fa').toggleClass('fa-rotate-180');";
            }
        ?>

        $('.fold-accordion').on('click', function(){
            var otherAccordion = $(this).next('.accordion').toggleClass('hide-accordion');
            $('.accordion').not(otherAccordion).removeClass('hide-accordion');
            var otherIcon = $(this).find($(".fa")).toggleClass('fa-rotate-180');
            $('.fold-accordion .fa').not(otherIcon).removeClass('fa-rotate-180');
        });

        $(".toggle-password").click(function() {
            $(this).toggleClass("fa-eye fa-eye-slash");
            var input = $($(this).attr("toggle"));
            
            if (input.attr("type") == "password") {
                input.attr("type", "text");
            } else {
                input.attr("type", "password");
            }
        });

        $(".invalid-username").hover(function(){
            $(".tooltip-username").css('visibility', 'visible');
        }, function(){
            $(".tooltip-username").css('visibility', 'hidden');
        });

        $(".invalid-username").focus(function(){
            $(".tooltip-username").css('visibility', 'visible');
        });

        $(".invalid-username").blur(function(){
            $(".tooltip-username").css('visibility', 'hidden');
        });

        $(".invalid-password").hover(function(){
            $(".tooltip-password").css('visibility', 'visible');
        }, function(){
            $(".tooltip-password").css('visibility', 'hidden');
        });

        $(".invalid-password").focus(function(){
            $(".tooltip-password").css('visibility', 'visible');
        });

        $(".invalid-password").blur(function(){
            $(".tooltip-password").css('visibility', 'hidden');
        });

    });
    </script>
</body>
</html>