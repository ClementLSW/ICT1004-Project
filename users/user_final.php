<?php
error_reporting(1);
//turn off error reporting
?>
<?php if ($GLOBALS['valid']) : ?>

    <section class="card">
        <section id="header"><h1 id="carpark_placeholder">Park at : <span id="carpark_dynamic" class="dark_highlight">loading . . .</span></h1></section>
        <p id="occupancy_placeholder" alt="occupancy placeholder">Loading . . .</p>
        <p class="title" id="starting_placeholder">Loading . . .</p> 
        <p class="title" id="destination_placeholder">Loading . . .</p>
        <button  type="button" id="final_copy" name="final_copy" value="copy" class="next_button btn btn-primary"><a><i class="fas fa-copy"></i>   Copy Google URL</a></button>
        <button  type="button" id="final_open" name="final_open" value="open" class="next_button btn btn-primary"><a href="#" id="url_button"><i class="fas fa-map-marked"></i>   Get Directions</a></button>
        <button  type="button" id="final_back" name="final_back" value="back" class="next_button btn btn-primary">Back</button>
    </section>
<?php else : ?>
    <?php include '../views/404.php' ?>
<?php endif; ?>