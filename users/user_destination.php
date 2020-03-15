<?php
error_reporting(0);
//turn off error reporting
?>
<?php if ($GLOBALS['valid']) : ?>
    <section class="justify-content-center row text_container">
        <h3 class="direction_text extra-bold">Great to see you <span class="highlight">#User</span>, Where would you like to go? <br></h3>
    </section>
    <form action="user_process.php" method="POST">
        <section class="w-100 container1 justify-content-center row">
            <div id="user_form" class="form-group ">
                <select class="user_input js-example-basic-single" id="destinationInput">
                    <?php
                    include '../connections.php';
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