<?= $this->extend(config('Auth')->views['layout']) ?>

<?= $this->section('title') ?><?= lang('Forgot your password?') ?> <?= $this->endSection() ?>

<?= $this->section('main') ?>

<div id="app">
    <div>
        <div class="membership">

            <div class="membership--main">
                <div>
                    <?php if (session('message') !== null) : ?>
                        <div class="alert alert-success" role="alert"><?= session('message') ?></div>
                    <?php endif ?>

                    <form action="javascript:void(0)" name="forgot_password_form" id="forgot_password_form" method="post" accept-charset="utf-8">
                        <?= csrf_field() ?>

                        <div class="membership__section">
                            <div class="membership_head">
                                <img src="<?= base_url('public/assets/images/payme-logo.png'); ?>" class="membership__logo membership__logo--primary">
                            </div>
                            <h2 class="membership__title">Forgot your password?</h2>
                            <p class="mb-4">Enter email address and we'll email you instructions on how to reset your password</p>
                            <div class="membership__spacer">
                                <label class="membership__label">Email Address</label>
                                <input type="email" class="form-control email" id="floatingEmailInput" name="email" inputmode="email" autocomplete="email" placeholder="<?= lang('Auth.email') ?>" value="<?= old('email') ?>" required>
                            </div>

                            <?php if (session('error') !== null) : ?>
                                <div class="alert alert-danger" role="alert"><?= session('error') ?></div>
                            <?php elseif (session('errors') !== null) : ?>
                                <div class="alert alert-danger" role="alert">
                                    <?php if (is_array(session('errors'))) : ?>
                                        <?php foreach (session('errors') as $error) : ?>
                                            <?= $error ?>
                                            <br>
                                        <?php endforeach ?>
                                    <?php else : ?>
                                        <?= session('errors') ?>
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
    .membership__logo {
        width: 220px;
    }

    .membership {
        background: transparent !important;
    }

    .membership--main__action {
        margin-bottom: 5px;
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
</style>

<link href="<?= base_url('public/assets/css/sweetalert2.min.css'); ?>" rel="stylesheet">
<link href="<?= base_url('public/assets/css/custom.css'); ?>" rel="stylesheet">


<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script src="<?= base_url('public/assets/js/jquery.validate.js'); ?>"></script>
<script src="<?= base_url('public/assets/js/additional-methods.min.js'); ?>"></script>
<script src="<?= base_url('public/assets/js/sweetalert2.min.js'); ?>"></script>
<script src="<?= base_url('public/assets/js/custom.js'); ?>"></script>
<script type="text/javascript">
    var SITE_IMG = '<?= base_url(); ?>';
</script>

<script>
    if ($("#forgot_password_form").length > 0) {
        $("#forgot_password_form").validate({

            submitHandler: function(form) {
                var email = $('#floatingEmailInput').val();
                var url = '<?= site_url('view-reset-password/') ?>' + email;
                swal({
                    title: 'Forget Password',
                    text: 'Are you sure you want to reset password?',
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
                            url: "<?= base_url('index.php/forgot-password') ?>",
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
                                    window.location.href = url;
                                    $('#targetElement').html(response.html);
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
<?= $this->endSection() ?>