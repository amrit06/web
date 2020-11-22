<div class="address_form">
    
    <div class="row10">
        <div class="col5">
            <div class="form_input_con">
                <div class="input_field_wrapper">
                    <i class="fas fa-house-user"></i>
                    <input type="text" name="homeno" placeholder="e.g. 96" value="<?php echo $args["homeno"] ?>" required/>
                </div>
                <span class="error"><?php echo $args_error["homeno"]; ?></span>
            </div>
        </div>

        <div class="col5">
            <div class="form_input_con">
                <div class="input_field_wrapper">
                    <i class="fas fa-house-user"></i>
                    <input type="text" name="streetname" placeholder="e.g. Kent st" value="<?php echo $args["streetname"] ?>" required/>
                </div>
                <span class="error"><?php echo $args_error["streetname"]; ?></span>
            </div>
        </div>
    </div>

    <div class="10">
        <div class="form_input_con">
            <div class="input_field_wrapper">
                <i class="fas fa-house-user"></i>
                <input type="text" name="suburb" placeholder="e.g. Minto" value="<?php echo $args["suburb"] ?>" required/>
            </div>
            <span class="error"><?php echo $args_error["suburb"]; ?></span>
        </div>
    </div>


    <div class="row10">
        <div class="form_input_con">
            <div class="input_field_wrapper">
                <label>Select State:</label>
                <select class="select" name="state" id="state" required>
                    <option value="" selected>Select State</option>
                    <option value="NSW">NSW</option>
                    <option value="QLD">QLD</option>
                    <option value="ACT">ACT</option>
                    <option value="VIC">VIC</option>
                    <option value="TAS">TAS</option>
                    <option value="WA">WA</option>
                    <option value="SA">SA</option>
                    <option value="NT">NT</option>
                </select>
                <br>
            </div>
            <span class="error"><?php echo $args_error["state"]; ?></span>
        </div>
    </div>


    <div class="row10">
        <div class="col5">
            <div class="form_input_con">
                <div class="input_field_wrapper">
                    <i class="fas fa-house-user"></i>
                    <input type="number" name="postcode" placeholder="e.g. 2566" value="<?php echo $args["postcode"] ?>" required/>
                </div>
                <span class="error"><?php echo $args_error["postcode"]; ?></span>
            </div>
        </div>

        <!--empty -->
        <div class="col5"> </div>
    </div>
</div>