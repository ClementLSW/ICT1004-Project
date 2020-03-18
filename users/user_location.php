<?php
error_reporting(1);
//turn off error reporting
?>
<?php if ($GLOBALS['valid']) : ?>
    <section class="justify-content-center row text_container" >
        <h3 class="direction_text extra-bold">What is your <span class="highlight">starting</span> point<br></h3>
    </section>
    <form id="user_location_form">
        <div id="currentWindow"></div>
        <div id="searchWindow" style="height:100%; min-height: 600px; width:100%; margin-top: 4%" >
            <div id="map1" style="height:100%; min-height: 600px; width:auto"></div>
            <section id="user_submit" class="w-100  container1 justify-content-center row" style="margin-top: 2%"> 
                <button type="button" id="location_back" name="location_back" value="back" class=" one_btn btn btn-primary">Back</button>
                <button type="button" id="location_submit" name="location_submit" value="submit" class=" two_btn btn btn-primary">Submit</button>
            </section>
        </div>
    </form>
    <div id="txtHint"></div>

<?php else : ?>
    <?php include '../views/404.php' ?>
<?php endif; ?>
<?php 
    if($GLOBALS['localtesting']){
        $param = parse_ini_file($GLOBALS['root'] . '/../var/www/private/db-config.ini');
        $key = $param['googlekey'];
        echo '<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=' . $key . '&libraries=places"></script>';

    }else{
        echo '<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCmiOGqCQ_5z0FeMbuelO3H3kFPQC7JDPw&libraries=places"></script>';        
    }

   
?>
