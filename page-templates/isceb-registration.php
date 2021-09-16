<?php






/* THIS IS NOT BEING USED*/







/**
 * Template Name: Register Page
 *
 * Template for displaying a page without sidebar even if a sidebar widget is published.
 * Based on colorlib-reg5
 * @package UnderStrap
 */

// Exit if accessed directly.
defined('ABSPATH') || exit;


global $wpdb, $user_ID;
if ($user_ID) {
    wp_redirect(home_url());
    exit;
}

wp_enqueue_style("formStyle", get_template_directory_uri() . '/css/mainForm.css');

get_header();

$container = get_theme_mod('understrap_container_type');

?>



<body>

    <div class="page-wrapper bg-gra-03 p-t-45 p-b-50">
        <div class="wrapper wrapper--w790">
            <div class="card card-5" style="border:0; border-radius:10px">
                <div class="card-heading">
                    <h2 class="title">Registration Form</h2>
                </div>
                <div class="errorMessageRegistration">This is an error</div>
                <div class="card-body">

                    <form method="POST" action="<?php echo esc_url(admin_url('admin-post.php')); ?>" id="iscebRegistrationForm">

                        <input type="hidden" name="action" value="isceb_new_user_registration">
                        <div class="tab">
                            <h4 class="formPartTitle">Personal information</h4>
                            <div class="form-row">

                                <div class="name">Username</div>
                                <div class="value">
                                    <div class="input-group-desc">
                                        <input class="input--style-5" type="text" name="uername" required="required">
                                    </div>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="name">Personal Email</div>
                                <div class="value">
                                    <div class="input-group">
                                        <input class="input--style-5" type="email" name="email" required="required">
                                    </div>
                                </div>
                            </div>
                           
                            <div class="form-row m-b-55">

                                <div class="name">Password</div>
                                <div class="value">
                                    <div class="row row-space">
                                        <div class="col">
                                            <div class="input-group-desc">
                                            <input type="password" class="input--style-5" id="password" name="password" required="required" autocomplete="new-password" minlength="6">
                                            <label class="label--desc">Min. 6 Characters</label>
                                            </div>
                                        </div>
                                        <div class="col lastname">
                                            <div class="input-group-desc">
                                            <input type="password" id="passwordConfirm" class="input--style-5" name="passwordCheck" required="required" minlength="6">
                                                <label class="label--desc">Confirm password</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- <div class="form-row m-b-55">

                                <div class="name">Name</div>
                                <div class="value">
                                    <div class="row row-space">
                                        <div class="col">
                                            <div class="input-group-desc">
                                                <input class="input--style-5" type="text" name="first_name" required="required">
                                                <label class="label--desc">first name</label>
                                            </div>
                                        </div>
                                        <div class="col lastname">
                                            <div class="input-group-desc">
                                                <input class="input--style-5" type="text" name="last_name" required="required">
                                                <label class="label--desc">last name</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div> -->
                            <div class="form-row">
                                <div class="name">R-number</div>
                                <div class="value">
                                    <div class="input-group-desc">
                                        <input class="input--style-5" type="text" name="rnumber" required="required" pattern="^[Rr][0-9]{7}$">
                                        <label class="label--desc">Eg: RXXXXXXX</label>
                                    </div>
                                </div>
                            </div>

                            <!-- <div class="form-row m-b-55">
                                <div class="name">Phone</div>
                                <div class="value">
                                    <div class="row row-refine">
                                        <div class="col">
                                            <div class="input-group-desc">
                                                <input class="input--style-5" type="text" name="phone" required="required">
                                                <label class="label--desc">Phone Number</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div> -->
                            
                            <!-- <div class="form-row p-t-20">
                            <label class="label label--block">Are you an existing customer?</label>
                            <div class="p-t-15">
                                <label class="radio-container m-r-55">Yes
                                    <input type="radio" checked="checked" name="exist">
                                    <span class="checkmark"></span>
                                </label>
                                <label class="radio-container">No
                                    <input type="radio" name="exist">
                                    <span class="checkmark"></span>
                                </label>
                            </div>
                        </div> -->
                        </div>
                        <div class="tab">
                            <h4 class="formPartTitle">Personal information new<h4>
                                    <div class="form-row">

                                        <div class="name">Username</div>
                                        <div class="value">
                                            <div class="row row-space">
                                                <div class="col">
                                                    <div class="input-group-desc">
                                                        <input class="input--style-5" type="text" name="username" required="required">
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-row m-b-55">

                                        <div class="name">Name</div>
                                        <div class="value">
                                            <div class="row row-space">
                                                <div class="col">
                                                    <div class="input-group-desc">
                                                        <input class="input--style-5" type="text" name="first_name" required="required">
                                                        <label class="label--desc">first name</label>
                                                    </div>
                                                </div>
                                                <div class="col lastname">
                                                    <div class="input-group-desc">
                                                        <input class="input--style-5" type="text" name="last_name" required="required">
                                                        <label class="label--desc">last name</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="name">R-number</div>
                                        <div class="value">
                                            <div class="input-group-desc">
                                                <input class="input--style-5" type="text" name="rnumber" required="required" pattern="^[Rr][0-9]{7}$">
                                                <label class="label--desc">Eg: RXXXXXXX</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="name">Personal Email</div>
                                        <div class="value">
                                            <div class="input-group">
                                                <input class="input--style-5" type="email" name="email" required="required">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-row m-b-55">
                                        <div class="name">Phone</div>
                                        <div class="value">
                                            <div class="row row-refine">
                                                <div class="col">
                                                    <div class="input-group-desc">
                                                        <input class="input--style-5" type="text" name="phone" required="required">
                                                        <label class="label--desc">Phone Number</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="name">Program</div>
                                        <div class="value">
                                            <div class="input-group">
                                                <div class="rs-select2 js-select-simple select--no-search">
                                                    <select name="program" required="required">
                                                        <!-- First value needs to be empty to make sure required works -->
                                                        <option value="" disabled="disabled" selected="selected">Choose program</option>
                                                        <option>Business Administration</option>
                                                        <option>Business Engineering</option>
                                                        <option>MIBEM</option>
                                                    </select>
                                                    <div class="select-dropdown"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="name">Phase</div>
                                        <div class="value">
                                            <div class="input-group">
                                                <div class="rs-select2 js-select-simple select--no-search">
                                                    <select name="phase" required="required">
                                                        <option value="" disabled="disabled" selected="selected">Choose phase</option>
                                                        <option>1st Bachelor</option>
                                                        <option>2nd Bachelor</option>
                                                        <option>3rd Bachelor</option>
                                                        <option>Prep</option>
                                                        <option>Bridging</option>
                                                        <option>Master</option>
                                                    </select>
                                                    <div class="select-dropdown"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- <div class="form-row p-t-20">
                            <label class="label label--block">Are you an existing customer?</label>
                            <div class="p-t-15">
                                <label class="radio-container m-r-55">Yes
                                    <input type="radio" checked="checked" name="exist">
                                    <span class="checkmark"></span>
                                </label>
                                <label class="radio-container">No
                                    <input type="radio" name="exist">
                                    <span class="checkmark"></span>
                                </label>
                            </div>
                        </div> -->
                        </div>
                        <div>
                            <!-- <button class="btn btn-primary" type="submit">Register</button> -->
                            <div style="float:right;">
                                <button class="btn btn-secondary" type="button" id="prevBtn" onclick="nextPrev(-1)">Previous</button>
                                <button class="btn btn-primary" type="button" id="nextBtn" onclick="nextPrev(1)">Next</button>
                            </div>
                        </div>
                        <input type="hidden" name="isceb_csrf" value="<?php echo wp_create_nonce('isceb-csrf') ?>">

                    </form>
                </div>
            </div>
        </div>
    </div>



</body><!-- This templates was made by Colorlib (https://colorlib.com) -->



<?php
wp_enqueue_script("formRegistrationScript", get_template_directory_uri() . '/js/formRegistration.js');
get_footer();
