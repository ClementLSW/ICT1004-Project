<section class="w-100 justify-content-center row">
    <h3 class="direction_text extra-bold">Which <span class="highlight">Shop</span>, would you like to vist?<br></h3>
</section>
<form action="user_process.php" method="POST">
    <section class="w-100 justify-content-center row">
        <div id="user_form" class="form-group ">
        <select class="user_input js-example-basic-single" id="shopInput">
                <?php
                $products = array("Shop A", "Shop B");
                foreach ($products as $item) {
                ?><option value="<?php echo strtolower($item); ?>"><?php echo $item; ?></option>
                <?php
                }
                ?>
            </select>
        </div>
    </section>
    <section id="user_submit" class="w-100 justify-content-center row">
    <button type="button" id="shop_back" name="shop_back" value="back" class=" one_btn btn btn-primary">Back</button>
    <button type="button" id="shop_submit" name="shop_submit" value="next" class=" two_btn btn btn-primary">Search</button>
    </section>
</form>