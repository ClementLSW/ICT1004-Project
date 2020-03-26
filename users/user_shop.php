<?php
error_reporting(0);
//turn off error reporting
?>
<?php if ($GLOBALS['valid']) : ?>
    <section class="justify-content-center row text_container">
        <h3 class="direction_text extra-bold">Which <span class="highlight">Shop</span>, would you like to vist?<br></h3>
        <div id="shops_form" class="w-100 container1 justify-content-center form-group row">
                <select  class="user_input js-example-basic-single" id="shopInput">

                </select>
            <button type="button" id="shop_back" name="shop_back" value="back" class=" one_btn btn btn-primary">Back</button>
            <button type="button" id="shop_submit" name="shop_submit" value="next" class=" two_btn btn btn-primary">Next</button>
        </div>
     </section>

<?php else : ?>
    <?php header( "Location: /ICT1004-Project/error" );?>
<?php endif; ?>