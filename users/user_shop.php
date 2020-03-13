<section class="w-100 container1 justify-content-center row">
    <h3 class="direction_text extra-bold">Which <span class="highlight">Shop</span> would you like to visit?<br></h3>
</section>
<form action="user_process.php" method="POST">
    <section class="w-100 container1 justify-content-center row">
        <div id="shops_form" class="form-group ">
        <select class="user_input js-example-basic-single" id="shopInput">
              
            </select>
        </div>
    </section>
    <section id="user_submit" class="w-100 container1 justify-content-center row">
    <button type="button" id="shop_back" name="shop_back" value="back" class=" one_btn btn btn-primary">Back</button>
    <button type="button" id="shop_submit" name="shop_submit" value="next" class=" two_btn btn btn-primary">Search</button>
    </section>
</form>
<div id="txtHint"></div>