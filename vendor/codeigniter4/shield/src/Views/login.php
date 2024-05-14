<?= $this->extend(config('Auth')->views['layout']) ?>

<?= $this->section('title') ?><?= lang('Auth.login') ?> <?= $this->endSection() ?>

<?= $this->section('main') ?>

<div id="app">
    <div>
        <div class="membership">
            <header class="membership__header"><img src="<?= base_url('public/assets/images/PayMe.Limo.png'); ?>" class="membership__logo membership__logo--primary"></header>
            <div class="membership--main">
                <div>

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

                    <?php if (session('message') !== null) : ?>
                        <div class="alert alert-success" role="alert"><?= session('message') ?></div>
                    <?php endif ?>

                    <form class="membership__form form" action="<?= url_to('login') ?>" method="post">
                        <?= csrf_field() ?>

                        <div class="membership__section">
                            <h2 class="membership__title">Sign in to PayMe.Limo</h2>
                            <div class="membership__spacer"><label class="membership__label">Email</label>

                                <input type="email" class="input input--med" id="floatingEmailInput" name="email" inputmode="email" autocomplete="email" placeholder="<?= lang('Auth.email') ?>" value="<?= old('email') ?>" required>

                            </div>
                            <div class="membership__spacer">
                                <div class="group"><label class="membership__label pull">Password</label><a href="javascript:void(0)" class="anchor anchor--primary type--sml push">Forgot password?</a></div>
                                <div class="input--password">

                                    <input type="password" class="input input--med" id="floatingPasswordInput" name="password" inputmode="text" autocomplete="current-password" placeholder="<?= lang('Auth.password') ?>" required>

                                    <i class="icon icon--xsml icon--view align--v--neg--3" tabindex="-1"></i>

                                </div>
                            </div>

                            <!-- Remember me -->
                            <?php if (setting('Auth.sessionConfig')['allowRemembering']) : ?>
                                <div class="membership__spacer">
                                    <input type="checkbox" name="remember" class="input input--check input--check--sml" <?php if (old('remember')) : ?> checked<?php endif ?>>
                                    Remember me
                                </div>
                            <?php endif; ?>


                            <button type="submit" class="btn btn--primary btn--med membership__btn">Sign in</button>

                            <p class="membership--main__action"><span class="membership--main__label">Need a login?</span> <button type="button" class="btn type--wgt--medium">Create your password</button></p>
                        </div>
                    </form>
                    <div class="membership__privacy">© Copyright 2024 Cardknox - <a href="javascript:void(0)" class="membership__privacy__link">Privacy Policy</a></div>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>