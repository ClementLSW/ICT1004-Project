 <?php if (isset($GLOBALS['valid']) && $GLOBALS['valid']) : ?>
<section role="main" id="section_container"  class="row w-100" >
    <article id="user_input_container" class="offset-sm-2 col-sm-8 my_container justify-content-center"> 
        <section id="final_page">
       
            <link rel="stylesheet" href="resources/css/userhome.css"></link>
            <section class="card1">
                <section id="header"><h1 id="carpark_placeholder">Park at : <span id="carpark_dynamic" class="dark_highlight"></span><?php echo $_POST['carparkName'] ?></h1></section>
                <p id="occupancy_placeholder">Carpark is <?php echo $_POST['occupancy'] ?> % full</p>
                <p class="title" id="starting_placeholder">From : <?php echo $_POST['startingName']?></p> 
                <p class="title" id="destination_placeholder">To : <?php echo $_POST['destinationName'] ?> , <?php echo $_POST['shopName']?></p>
                <button  type="button" id="history_copy" name="history_copy" value="copy" class="next_button btn btn-primary"><i class="fas fa-copy"></i>   Copy Google URL</button>
                <a  id="history_url_button" href="<?php echo $_POST['url'] ?>" target="_blank" class="next_button btn btn-primary"><i class="fas fa-map-marked"></i>   Get Directions</a>
                <a  id="history_home" href="/ICT1004-Project/home" class="next_button btn btn-primary">Home</a>
            </section>
       
        </section>
    </article>
</section>
 <?php else : ?>
            <!doctype html>
            <html lang="en">
            <head>
                <title>ParkNow</title>
                <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
            </head>
            <?php include '../views/404.php' ?>
            </html>
 <?php endif; ?>
        
      