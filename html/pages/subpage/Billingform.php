<div class="billing_wrapper">
    <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <div class="form_header">
            <h3>Payment Form:</h3>
        </div>
        <div class="block">
            <div class="row10">
                <label class="blocklabel">Accepted Card</label>
            </div>
            <div class="row10">
                <div class="icon-container">
                    <i class="fa fa-cc-visa" style="color:navy;"></i>
                    <i class="fa fa-cc-amex" style="color:blue;"></i>
                    <i class="fa fa-cc-mastercard" style="color:red;"></i>
                    <i class="fa fa-cc-discover" style="color:orange;"></i>
                </div>
            </div>
        </div>


        <div class="block">
            <div class="row10">
                <label class="blocklabel" for="name">Full Name on Card:</label>
            </div>
            <div class="row10">
                <input class="input_10_5 border2" type="text" name="name" placeholder="e.g. Amrit Kharel" value="<?php echo $name ?>" />
            </div>
            <div class="row10">
                <span class="error_10_1"><?php echo "Error"; ?></span>
            </div>
        </div>

        <div class="block">
            <div class="row10">
                <label class="blocklabel" for="cardnumber">Card Number:</label>
            </div>
            <div class="row10">
                <input class="input_2_5 border2" type="number" name="cardnumber1" placeholder="1111" value="<?php echo $cardnumber1 ?>" />
                <label class="mid_char">-</label>
                <input class="input_2_5 border2" type="number" name="cardnumber2" placeholder="1111" value="<?php echo $cardnumber2 ?>" />
                <label class="mid_char">-</label>
                <input class="input_2_5 border2" type="number" name="cardnumber3" placeholder="1111" value="<?php echo $cardnumber3 ?>" />
                <label class="mid_char">-</label>
                <input class="input_2_5 border2" type="number" name="cardnumber4" placeholder="1111" value="<?php echo $cardnumber4 ?>" />
            </div>
            <div class="row10">
                <span class="error_10_1"><?php echo "Error"; ?></span>
            </div>

        </div>

        <div class="block">
            <div class="row10">
                <label class="blocklabel" for="cardnumber">Expiry Date:</label>
            </div>
            <div class="row10">
                <input class="input_2_5 border2" type="number" name="expirymonth" placeholder="02" value="<?php echo $expirymonth ?>" />
                <label class="mid_char">/</label>
                <input class="input_2_5 border2" type="number" name="expiryyear" placeholder="2020" value="<?php echo $expiryyear ?>" />
            </div>
            <div class="row10">
                <span class="error_10_1"><?php echo "Error"; ?></span>
            </div>
        </div>

        <div class="block">
            <div class="row10">
                <label class="blocklabel" for="cardnumber">CVV:</label>
            </div>
            <div class="row10">
                <input class="input_5_5 border2" type="number" name="cvv" placeholder="e.g. 123" value="<?php echo $cvv ?>" />
            </div>
            <div class="row10">
                <span class="error_10_1"><?php echo "Error"; ?></span>
            </div>
        </div>

        <div class="block">
            <div class="row10">
                <button class="submit_10_5" id="submit" type="submit">Pay</button>
            </div>
        </div>

    </form>
</div>