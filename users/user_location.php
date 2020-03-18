<?php
error_reporting(0);
//turn off error reporting
?>

<?php if ($GLOBALS['valid']) : ?>
    <section class="justify-content-center row text_container">
        <h3 class="direction_text extra-bold">Where would you be <span class="highlight">heading</span> from<br></h3>
    </section>
    <section >
        <div id="searchWindow" style="height:100%; min-height: 700px;" >
            <div id="map1" style="height:100%; min-height: 700px;"></div>
            <section id="user_submit" class="w-100  container1 justify-content-center row">
                <button type="button" id="location_back" name="location_back" value="back" class=" one_btn btn btn-primary">Back</button>
                <button type="button" id="location_submit" name="location_submit" value="submit" class=" two_btn btn btn-primary">Submit</button>
            </section>
        </div>
    </section>
    <div id="txtHint"></div>

<?php else : ?>
    <?php include '../views/404.php' ?>
<?php endif; ?>
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCmiOGqCQ_5z0FeMbuelO3H3kFPQC7JDPw&libraries=places"></script>