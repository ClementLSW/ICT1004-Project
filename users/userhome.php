<!-- Stylesheet  -->
<link rel="stylesheet" href="resources/css/userhome.css"></link>
<section role="main" class="bg">
    <article id="user_input_container" class="my_container justify-content-center"> 
        <h3 class="direction_text extra-bold">Great to see you <span class="highlight">#User</span>, Where would you like to go? <br></h3>
        <form id="user_form">
            <div class="form-group ">
                <select class="user_input js-example-basic-single" id="destinationInput">
                <?php
                       $products = array("Singapore Expo", "Suntec");
                       foreach($products as $item){
                        ?><option value="<?php echo strtolower($item);?>"><?php echo $item; ?></option>
                        <?php
                        }
                        ?>
                </select>
            </div>
        </form>
        <form id="user_submit" >
            <button type="button" class="next_button btn btn-primary">Next</button>
        </form>
    </article>

    <!-- <section id="direction_container" class="row justify-content-center">
        <article id="direction_header" class="w-100" my-auto>
            
        </article>
    </section> -->
    <!-- <section id="user_input_container" class="row">
        <div class="col-sm-2 empty_div"></div>
      
        <div class="col-sm-2 empty_div"></div>
    </section> -->

</section>

