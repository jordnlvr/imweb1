<?= $this->extend(config('Auth')->views['layout']) ?>

<?= $this->section('title') ?><?= lang('Auth.login') ?> <?= $this->endSection() ?>

<?= $this->section('main') ?>

<div id="app">
    <div>
        <div class="membership">
            <div class="membership--main">
                <div>

                    <form class="membership__form form" action="<?= url_to('login') ?>" method="post">
                        <?= csrf_field() ?>

                        <div class="membership__section">
                            <div class="membership_head">
                                <img src="<?= base_url('public/assets/images/payme-logo.png'); ?>" class="membership__logo membership__logo--primary">
                            </div>
                            <h2 class="membership__title">Sign in</h2>
                            <?php if (isset($success_message)) : ?>
                                <div class="alert alert-success"><?= $success_message ?></div>
                            <?php endif; ?>
                            <div class="membership__spacer">
                                <label class="membership__label">Email</label>
                                <input type="email" class="form-control" id="floatingEmailInput" name="email" inputmode="email" autocomplete="email" placeholder="<?= lang('Auth.email') ?>" value="<?= old('email') ?>" required>
                            </div>
                            <div class="membership__spacer">
                                <label class="form-label">Password</label>
                                <div class="input-group mb-3">
                                    <input class="form-control password" id="password" class="block mt-1 w-full" type="password" name="password" required placeholder="<?= lang('Auth.password') ?>" />
                                    <span class="input-group-text togglePassword" id="">
                                        <i data-feather="eye" style="cursor: pointer"></i>
                                    </span>
                                </div>

                                <div class="group"><label class="membership__label pull"></label><a href="<?= base_url('index.php/forgot-password'); ?>" class="anchor anchor--primary type--sml push">Forgot password?</a></div>
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


                            <button type="submit" class="btn btn--primary btn--med membership__btn">Sign in</button>
                            <!-- <p class="membership--main__action"><span class="membership--main__label">Need a login?</span>
                                <a href="<?= base_url('index.php/register'); ?>" class=" type--wgt--medium">Sign up</a>
                            </p> -->


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