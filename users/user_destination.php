<?php
error_reporting(1);
//turn off error reporting
?>
<?php if ($GLOBALS['valid']) : ?>
    <?php if($GLOBALS['debug']) {print('user_destination.php');} ?>
    <section class="justify-content-center row text_container">
        <?php if($_SESSION['username'] != NULL){
           echo '<h3 class="direction_text extra-bold">Great to see you again <span class="highlight">'. $_SESSION['username'].' </span>, Where would you like to go? <br></h3>';
        }
        else{
            echo '<h3 class="direction_text extra-bold">Hey there <span class="highlight">guest</span>, Where would you like to go? <br></h3>';
        }
        ?>
    </section>
    <form action="user_process.php" method="POST">
        <section class="w-100 container1 justify-content-center row">
            <div id="user_form" class="form-group ">
                <select class="user_input js-example-basic-single" id="destinationInput">
                    <?php
                    include '../connections.php';
                    if($GLOBALS['debug']) {print('connections is working');}
                    $connection = new connections();
                    $products = $connection->retrieve_all_data("carpark.location");
                    foreach ($products as $item) {
                    ?><option value="<?php echo strtolower($item['location_id']); ?>"><?php echo $item['location_name']; ?></option>
                    <?php
                    }
                    ?>
                </select>
            </div>
        </section>
        <section id="user_submit" class="w-100 container1 justify-content-center row">
            <button type="button" id="destination_submit" name="destination_submit" value="next" class="next_button btn btn-primary">Next</button>
        </section>
    </form>
<?php else : ?>
    <?php include '../views/404.php' ?>
<?php endif; ?>