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

        $(".toggle-password").click(function() {
            $(this).toggleClass("fa-eye fa-eye-slash");
            var input = $($(this).attr("toggle"));
            
            if (input.attr("type") == "password") {
                input.attr("type", "text");
            } else {
                input.attr("type", "password");
            }
        });

    });
    </script>
</body>
</html>