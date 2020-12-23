<?php
/**
 * Copyright (c) 2018.
 * Created by Jeremy-Percy Batten
 * Project Fiddly 2018
 */

?>
<?php require APPROOT . '/views/inc/header_login.php'; ?>
<div class="register">
    <div class="container">
        <div class="return">
            <a href="<?php echo URLROOT; ?>" class="return--link"><span class="icon--left mr-5"><i
                            class="fas fa-arrow-left"></i></span>Go back to home</a>
        </div>
        <div class="register__form">
            <div class="logo-box">
                <img class="logo-box__logo" src="<?php echo URLROOT; ?>/images/Logo/FIDDLY_LOGO_white.svg">
            </div>
            <nav>
                <ul class="navbar register__form__ul align-items-center justify-content-around">
                    <li class="nav-item">
                        <a class="register__form__links" href="<?php echo URLROOT; ?>/users/login">Login </a>
                    </li>
                    <li class="nav-item">
                        <a class="register__form__links register__form__links--active" href="<?php echo URLROOT; ?>/users/register">Register</a>
                    </li>
                </ul>
            </nav>
                <form class="mt-5" action="<?php echo URLROOT; ?>/users/register" method="post">
                    <div class="form-group">
                        <label for="name" hidden>Name: <sup>*</sup></label>
                        <input type="text" name="name" placeholder="Name" class="form-control form-control-lg <?php echo (!empty($data['name_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['name']; ?>">
                        <span class="invalid-feedback"><?php echo $data['name_err']; ?></span>
                    </div>
                    <div class="form-group">
                        <label for="email" hidden>Email: <sup>*</sup></label>
                        <input type="email" name="email" placeholder="Email" class="form-control form-control-lg <?php echo (!empty($data['email_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['email']; ?>">
                        <span class="invalid-feedback"><?php echo $data['email_err']; ?></span>
                    </div>
                    <div class="form-group">
                        <label for="password" hidden>Password: <sup>*</sup></label>
                        <input type="password" name="password" placeholder="Password" class="form-control form-control-lg <?php echo (!empty($data['password_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['password']; ?>">
                        <span class="invalid-feedback"><?php echo $data['password_err']; ?></span>
                    </div>
                    <div class="form-group">
                        <label for="confirm_password" hidden>Confirm Password: <sup>*</sup></label>
                        <input type="password" name="confirm_password" placeholder="Confirm password" class="form-control form-control-lg <?php echo (!empty($data['confirm_password_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['confirm_password']; ?>">
                        <span class="invalid-feedback"><?php echo $data['confirm_password_err']; ?></span>
                    </div>
                    <div class="text-center mt-5">
                        <button type="submit" value="Register" class="btn btn-lg btn--blue btn--round btn--wide">Submit</button>
                    </div>
                </form>
        </div>


    </div>
</div>
<?php require APPROOT . '/views/inc/footer_login.php'; ?>
