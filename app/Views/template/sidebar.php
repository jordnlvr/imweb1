<body>
    <div id="root">
        <div>
            <div class="">

                <header class="header--mobile">
                    <button type="button" class="btn btn--reset header--mobile__btn"><i class="icon icon--xsml icon--menu"></i></button>
                    <a href="javascript:void(0)" class="header--mobile__logo"></a>

                </header>

                <div class="l--aside ">
                    <div class="l--aside__header"><button type="button" class="btn btn--reset header--mobile__btn mobile_close_btn"><i class="icon icon--tiny icon--close-big--navigation"></i></button></div>

                    <div class="sidebar">
                        <div class="sidebar__header">
                            <a href="<?= base_url('/'); ?>" class="sidebar__header__image"></a>
                            <!-- <span class="sidebar__header__title">Partner Portal</span> -->
                            <h4 class="platformTitle"><?php echo (isset($_SESSION['user_role']) && $_SESSION['user_role'] == 'user') ? 'Partner Portal' : 'Merchant Portal'; ?></h4>
                        </div>

                        <div class="account__wrap">
                            <div class="account">
                                <i class="icon icon--xsml icon--user-alt align--v--neg--4 spc--right--xsml account__icon" style=""></i>
                                <div class="account__name">
                                    <span class="display--b type--breakword"><?php echo $_SESSION['login_user'] ?? ''; ?></span>
                                </div>
                                <a class="account__logout" data-tooltip="Logout" href="<?= base_url('index.php/logout'); ?>">
                                    <i class="icon icon--xsml icon--logout align--v--neg--4"></i>
                                </a>
                            </div>
                        </div>

                        <ul class="nav sidebar__nav__wrapper">
                            <?php if (isset($_SESSION['user_role']) && $_SESSION['user_role'] == 'user') {  ?>
                                <li class="nav__item">
                                    <a aria-current="page" class="nav__link <?= (service('uri')->getSegment(1) == 'leads') ? 'is-active' : '' ?>" href="<?= base_url('index.php/leads'); ?>">
                                        <i class="icon icon--xsml nav__icon nav__icon--users"></i>

                                        <span class="nav__link__text">Leads</span>
                                    </a>
                                </li>
                                <li class="nav__item">
                                    <a aria-current="page" class="nav__link <?= (service('uri')->getSegment(1) == 'merchant-lists' || service('uri')->getSegment(1) == 'merchant-details') ? 'is-active' : '' ?>" href="<?= base_url('index.php/merchant-lists'); ?>">
                                        <i class="icon icon--xsml nav__icon nav__icon--merchants"></i>
                                        <span class="nav__link__text">Merchant Listing</span>
                                    </a>
                                </li>
                            <?php } else { ?>
                                <li class="nav__item">
                                    <a aria-current="page" class="nav__link <?= (service('uri')->getSegment(1) == 'client-lists' || service('uri')->getSegment(1) == 'client-details' || service('uri')->getSegment(1) == 'edit-client' || service('uri')->getSegment(1) == 'client-transaction' ? 'is-active' : '') ?>" href="<?= base_url('index.php/client-lists'); ?>">
                                        <i class="icon icon--xsml nav__icon nav__icon--customers"></i>
                                        <span class="nav__link__text">Manage Client</span>
                                    </a>
                                </li>
                                <li class="nav__item">
                                    <a aria-current="page" class="nav__link <?= (service('uri')->getSegment(1) == 'transaction-lists') ? 'is-active' : '' ?>" href="<?= base_url('index.php/transaction-lists'); ?>">
                                        <i class="icon icon--xsml nav__icon nav__icon--transactions"></i>
                                        <span class="nav__link__text">Transactions History</span>
                                    </a>
                                </li>

                            <?php }  ?>

                            <li class="nav__item">
                                <a aria-current="page" class="nav__link <?= (service('uri')->getSegment(1) == 'update-profile' ? 'is-active' : '') ?>" href="<?= base_url('index.php/update-profile/' . auth()->user()->id); ?>">
                                    <i class="icon icon--xsml nav__icon nav__icon--customers"></i>
                                    <span class="nav__link__text">My Profile</span>
                                </a>
                            </li>

                        </ul>

                    </div>
                    <button type="button" class="btn btn--med btn--collapse datatooltip--collapse" onclick="toggleExpandCollapseSidebar()">
                        <i class="icon icon--sml icon--menu-collapse align--v--middle"></i> </button>

                </div>