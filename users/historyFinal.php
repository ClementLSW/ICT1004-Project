<link rel="stylesheet" href="resources/css/userhome.css"></link>
<section role="main" id="section_container"  class="row w-100" >
    <article id="user_input_container" class="offset-sm-2 col-sm-8 my_container justify-content-center"> 
        <section id="final_page">
        <?php if ($GLOBALS['valid']) : ?>
            <section class="card1">
                <section id="header"><h1 id="carpark_placeholder">Park at : <span id="carpark_dynamic" class="dark_highlight"></span><?php echo $_POST['carparkName'] ?></h1></section>
                <p id="occupancy_placeholder" alt="occupancy placeholder">Carpark is <?php echo $_POST['occupancy'] ?> % full</p>
                <p class="title" id="starting_placeholder">From : <?php echo $_POST['startingName']?></p> 
                <p class="title" id="destination_placeholder">To : <?php echo $_POST['destinationName'] ?> , <?php echo $_POST['shopName']?></p>
                <button  type="button" id="history_copy" name="history_copy" value="copy" class="next_button btn btn-primary"><a class="thisa"><i class="fas fa-copy"></i>   Copy Google URL</a></button>
                <button  type="button" id="history_open" name="history_open" value="open" class="next_button btn btn-primary"><a class="thisa" href="<?php echo $_POST['url'] ?>" target="_blank" id="history_url_button"><i class="fas fa-map-marked"></i>   Get Directions</a></button>
                <button  type="button" id="history_home" name="history_home" value="home" class="next_button btn btn-primary"><a class="thisa" href="/ICT1004-Project/home">Home</a></button>
            </section>
        <?php else : ?>
            <?php include '../views/404.php' ?>
        <?php endif; ?>
        </section>
    </article>
</section>

        
      