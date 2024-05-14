<?= $this->extend(config('Auth')->views['layout']) ?>

<?= $this->section('title') ?> Set a New Password <?= $this->endSection() ?>

<?= $this->section('main') ?>
<div id="app">
    <div>
        <div class="membership">

            <div class="membership--main">
                <div>
                    <form class="membership__form form" action="javascript:void(0)" name="forget_password_form" id="forget_password_form" method="post" accept-charset="utf-8">
                        <?= csrf_field() ?>
                        <div class="membership__section">
                            <div class="membership_head">
                                <img src="<?= base_url('public/assets/images/payme-logo.png'); ?>" class="membership__logo membership__logo--primary" style="width: 255px;">
                            </div>
                            <h2 class="membership__title">Set a New Password</h2>

                            <?php if (isset($success_message)) : ?>
                                <div class="alert alert-success"><?= $success_message ?></div>
                            <?php endif; ?>
                            <div class="membership__spacer">
                                <label class="membership__label">Email Address</label>
                                <input type="email" class="input input--med" id="floatingEmailInput" name="email" inputmode="email" autocomplete="email" placeholder="<?= lang('Auth.email') ?>" value="<?= $email ?>" readonly required>
                            </div>
                            <div class="membership__spacer">
                                <label class="membership__label">Enter Verification Code</label>
                                <input type="text" class="form-control" id="otp" placeholder="Enter Verification Code" name="otp">
                            </div>

                            <div class="membership__spacer">
                                <label class="membership__label">New Password</label>
                                <div class="input-group mb-3">
                                    <input class="form-control password" id="floatingPasswordInput" class="block mt-1 w-full" type="password" name="password" inputmode="text" autocomplete="new-password" placeholder="<?= lang('Auth.password') ?>" required />
                                    <span class="input-group-text togglePassword" id="">
                                        <i data-feather="eye" style="cursor: pointer"></i>
                                    </span>
                                </div>
                            </div>

                            <div class="membership__spacer">
                                <label class="membership__label">Confirm Password</label>
                                <div class="input-group mb-3">
                                    <input class="form-control password_confirm" id="floatingPasswordConfirmInput" class="block mt-1 w-full" type="password" name="password_confirm" inputmode="text" autocomplete="new-password" placeholder="<?= lang('Auth.passwordConfirm') ?>" required />
                                    <span class="input-group-text togglePassword1" id="">
                                        <i data-feather="eye" style="cursor: pointer"></i>
                                    </span>
                                </div>
                            </div>

                            <?php
                            if (isset($error) && $error !== null) : ?>
                                <div class="alert alert-danger" role="alert"><?= $error ?></div>
                            <?php elseif (isset($errors) && $errors !== null) : ?>
                                <div class="alert alert-danger" role="alert">
                                    <?php if (is_array($errors)) : ?>
                                        <?php foreach ($errors as $error) : ?>
                                            <?= $error ?>
                                            <br>
                                        <?php endforeach ?>
                                    <?php else : ?>
                                        <?= $errors ?>
                                    <?php endif ?>
                                </div>
                            <?php endif ?>


                            <button type="submit" class="btn btn--primary btn--med membership__btn">Reset Password</button>
                            <p class="membership--main__action"><span class="membership--main__label">Do you have an account?</span>
                                <a href="<?= base_url('index.php/login'); ?>" class=" type--wgt--medium">Log in</a>
                            </p>


                        </div>
                    </form>
                    <div class="membership__privacy">© Copyright 2024 PayMe.Limo</div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .error {
        color: red;
    }
</style>
<link href="<?= base_url('public/assets/css/sweetalert2.min.css'); ?>" rel="stylesheet">
<link href="<?= base_url('public/assets/css/custom.css'); ?>" rel="stylesheet">


<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script src="<?= base_url('public/assets/js/jquery.validate.js'); ?>"></script>
<script src="<?= base_url('public/assets/js/sweetalert2.min.js'); ?>"></script>
<script src="<?= base_url('public/assets/js/custom.js'); ?>"></script>
<script type="text/javascript">
    var SITE_IMG = '<?= base_url(); ?>';
</script>

<script src='<?= base_url('/public/assets/js/jquery.inputmask.js') ?>'></script>
<script>
    $('#otp').inputmask("999999");
    if ($("#forget_password_form").length > 0) {
        $("#forget_password_form").validate({
            rules: {
                email: {
                    required: true
                },
                otp: {
                    required: true,
                    minlength: 6,
                    maxlength: 6,
                },
                password: {
                    required: true,
                },
                password_confirm: {
                    required: true,
                },
            },
            messages: {
                otp: {
                    required: "Please enter valid otp",
                    minlength: "Otp must be at least {0} digits",
                    maxlength: "Otp must not exceed {0} digits"
                },

            },
            errorPlacement: function(error, element) {
                if (element.hasClass("form-control")) {
                    error.insertAfter(element.parent()); // Adjust error placement for input-group
                } else {
                    error.insertAfter(element);
                }
            },

            submitHandler: function(form) {
                swal({
                    title: 'Reset Password',
                    text: 'Are you sure you want to reset your password?',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#F44336',
                    confirmButtonText: 'Yes, proceed',
                    cancelButtonText: 'Cancel'
                }).then((Delete) => {
                    if (Delete) {
                        addOverlay();
                        $.ajax({
                            url: "<?= base_url('index.php/reset-password') ?>",
                            type: "POST",
                            data: new FormData(form),
                            processData: false,
                            contentType: false,
                            success: function(response) {

                                if (response.error === true) {
                                    errors = response.message;
                                    swal({
                                        position: "top-end",
                                        icon: "error",
                                        title: errors,
                                        showConfirmButton: false,
                                        timer: 1500
                                    });
                                }
                                if (response.success === true) {
                                    swal({
                                        position: "top-end",
                                        icon: "success",
                                        title: response.message,
                                        showConfirmButton: false,
                                        timer: 1500
                                    });
                                    window.location.href = "<?= base_url('index.php/login') ?>";
                                }
                            },
                            complete: removeOverlay
                        });
                        return false;
                    } else {
                        swal.close();
                    }
                });
            }
        })
    }
</script>
<style>
    .membership__logo {
        width: 220px;
    }

    .membership {
        background: transparent !important;
    }

    @media (min-width: 75em) {
        .membership__title {
            margin-bottom: 15px;
            font-size: 1.5rem;
            line-height: 1.6rem;
        }

        .membership__btn {
            margin-bottom: 5px;
        }

        .membership__section {
            padding: 30px 60px;
        }
    }

    .membership--main__action {
        margin-bottom: 0px;
    }
</style>


<?= $this->endSection() ?>