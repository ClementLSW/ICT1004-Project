<?php
error_reporting(1);
//turn off error reporting
?>
<?php if ($GLOBALS['valid']) : ?>
    <section class="card1">
        <div id="header"><h3 id="carpark_placeholder">Park at : <span id="carpark_dynamic" class="dark_highlight">loading . . .</span></h3></div>
        <p id="occupancy_placeholder">Loading . . .</p>
        <p class="title" id="starting_placeholder">Loading . . .</p> 
        <p class="title" id="destination_placeholder">Loading . . .</p>
        <button  type="button" id="final_copy" name="final_copy" value="copy" class="next_button btn btn-primary"><i class="fas fa-copy"></i>Copy Google URL</button>
        <a href="#"  id="url_button" class="next_button btn btn-primary"><i class="fas fa-map-marked"></i>   Get Directions</a>
        <button  type="button" id="final_back" name="final_back" value="back" class="next_button btn btn-primary">Back</button>
    </section>
<?php else : ?>
    <?php header( "Location: /ICT1004-Project/error" );?>
<?php endif; ?>