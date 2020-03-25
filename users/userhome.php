<link rel="stylesheet" href="resources/css/userhome.css"/>
<div role="main" id="section_container"  class="row w-100" >
    <div id="user_input_container" class="offset-sm-2 col-sm-8 my_container justify-content-center"> 
        <div id="destination_selection" style="display:none">
            <?php include 'user_destination.php' ?>
        </div >
        <div id="shop_selection" style="display:none">
            <?php include 'user_shop.php' ?>
        </div>
        <div id="starting_location" style="display:none">
            <?php if($_SESSION['username'] != NULL){
                $username = $_SESSION['username'];
            }?>
            <script> 
                var username = '<?php echo $username ?>'
            </script>
            <?php include 'user_location.php' ?>
        </div>
        <div id="summary_page" style="display:none">
            <?php include 'user_final.php' ?>
        </div>
    </div>
</div>



        
      