<?= $this->extend(config('Auth')->views['layout']) ?>
<?= $this->section('main') ?>

<div id="app">
    <div>
        <div class="membership">

            <div class="membership--main">
                <div>
                    <?php if (session('message') !== null) : ?>
                        <div class="alert alert-success" role="alert"><?= session('message') ?></div>
                    <?php endif ?>

                    <form class="membership__form form" action="<?= url_to('register') ?>" method="post">
                        <?= csrf_field() ?>

                        <div class="membership__section">
                            <header class="membership_head"><img src="<?= base_url('public/assets/images/payme-logo.png'); ?>" class="membership__logo membership__logo--primary"></header>
                            <h2 class="membership__title">Register</h2>
                            <div class="membership--main__action spc--bottom--med">
                                <p>Already have a Merchant Portal account?</p>
                                <div class="flex--primary">
                                    <p>Use your existing credentials to &nbsp;</p>
                                    <a href="<?= base_url('index.php/login'); ?>" class="type--wgt--medium"> Log in.</a>
                                </div>
                            </div>

                            <!-- Email -->
                            <div class="membership__spacer"><label class="membership__label">Email</label>
                                <input type="email" class="form-control" id="floatingEmailInput" name="email" inputmode="email" autocomplete="email" placeholder="<?= lang('Auth.email') ?>" value="<?= old('email') ?>" required>
                            </div>

                            <div class="membership__spacer"><label class="membership__label"><?= lang('Auth.username') ?></label>
                                <input type="username" class="form-control" id="floatingUsernameInput" name="username" inputmode="username" autocomplete="username" placeholder="<?= lang('Auth.username') ?>" value="<?= old('username') ?>" required>
                            </div>

                            <div class="membership__spacer"><label class="membership__label"><?= lang('Auth.password') ?></label>

                                <input type="password" class="form-control" id="floatingPasswordInput" name="password" inputmode="text" autocomplete="new-password" placeholder="<?= lang('Auth.password') ?>" required>

                            </div>

                            <div class="membership__spacer"><label class="membership__label">Confirm Password</label>

                                <input type="password" class="form-control" id="floatingPasswordConfirmInput" name="password_confirm" inputmode="text" autocomplete="new-password" placeholder="Confirm Password" required>

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


                            <button type="submit" class="btn btn-primary btn-block btn--med membership__btn"><?= lang('Auth.register') ?></button>

                        </div>
                    </form>
                    <div class="membership__privacy">© Copyright 2024 PayMe.Limo</div>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>