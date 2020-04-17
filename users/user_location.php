<?php
error_reporting(1);
//turn off error reporting
?>
<?php if ($GLOBALS['valid']) : ?>
        <section class="justify-content-center row text_container col" style="display:inline-block" id="header_text" >
            <h3 class="direction_text extra-bold">What is your <span class="highlight">starting</span> point<br></h3>
             <form id="user_location_form" class="row">
                <div id="searchWindow">
                    <div id="getCurrentLocationContainer"></div>
                     <button type="button" id="location_back" name="location_back" value="back" class=" one_btn btn btn-primary">Back</button>
                     <button type="button" id="location_submit" name="location_submit" value="submit" class=" two_btn btn btn-primary">Submit</button>
                </div>
            </form>
    </section>
<?php else : ?>
    <?php header( "Location: /ICT1004-Project/error" );?>
<?php endif; ?>
<?php 
    if($GLOBALS['localtesting']){
        $param = parse_ini_file($GLOBALS['root'] . '/../var/www/private/db-config.ini');
        $key = $param['googlekey'];
        echo '<script src="https://maps.googleapis.com/maps/api/js?key=' . $key . '&libraries=places"></script>';
    }else{
        echo '<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCncGfZT6_0wHA-b8bnAt1tcsyhgjE38m4&libraries=places"></script>';        
    }

   
?>
