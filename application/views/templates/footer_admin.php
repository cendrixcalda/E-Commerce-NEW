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
                echo "$('.accordion:nth-of-type(1)').toggleClass('hide-accordion');";
            }

            if($url == "archives" || $url == "orderarchives" || $url == "orderdetailsarchives"){
                echo "$('.accordion:nth-of-type(2)').toggleClass('hide-accordion');";
            }

            if($url == "brands" || $url == "categories" || $url == "colors" || $url == "countries" || $url == "materials"){
                echo "$('.accordion:nth-of-type(3)').toggleClass('hide-accordion');";
            }
        ?>

        $('.fold-accordion').on('click', function(){
            var otherAccordion = $(this).next('.accordion').toggleClass('hide-accordion');
            $('.accordion').not(otherAccordion).removeClass('hide-accordion');
            $(this).find($(".fa")).css('transition', '0s');
            var otherIcon = $(this).find($(".fa")).toggleClass('fa-rotate-180');
            $('.fold-accordion').find($(".fa")).not(otherIcon).removeClass('fa-rotate-180');
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