<link rel="stylesheet" href="resources/css/userhome.css"></link>
<section role="main" id="section_container"  class="row w-100" >
    <article id="user_input_container" class="offset-sm-2 col-sm-8 my_container justify-content-center"> 
        <section id="destination_selection" style="display:none">
            <?php include 'user_destination.php' ?>
        </section>
        <section id="shop_selection" style="display:none">
            <?php include 'user_shop.php' ?>
        </section>
        <section id="starting_location" style="display:none">
            <?php if($_SESSION['username'] != NULL){
                $username = $_SESSION['username'];
            }?>
            <script type="text/javascript"> 
                var username = '<?php echo $username ?>'
            </script>
            <?php include 'user_location.php' ?>
        </section>
        <section id="summary_page" style="display:none">
            <?php include 'user_final.php' ?>
        </section>
    </article>
</section>



        
      