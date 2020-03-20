<?php
error_reporting(1);
//turn off error reporting
?>
<?php if ($GLOBALS['valid']) : ?>
    <section class="col card" style="padding-top: 3%; padding-bottom: 3%;background-color:#2a2a2a ">
        <section class="justify-content-center row text_container" id="final_header" >
        </section>
        <section id="user_location_form" class="row">
        <section class="justify-content-center row text_container" id="url_link">
            <button type="button" name="url_button" value="map" class="next_button btn btn-primary"><a style="color: white;"id="url_button">Open in Google Maps</a></button>
            <button type="button" name="save_preference" value="save" class="next_button btn btn-primary">Save Preference</button>
        </section>
                <section id="user_submit" class="w-100  container1 justify-content-center row" style="margin-top: 1%"> 
                    <button type="button" id="final_back" name="final_back" value="back" class="next_button btn btn-primary">Back</button>
                </section>
        </section>
    </section>
<?php else : ?>
    <?php include '../views/404.php' ?>
<?php endif; ?>