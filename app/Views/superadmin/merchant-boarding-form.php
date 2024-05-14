<?= view('template/header') ?>
<script src=https://cdn.cardknox.com/ifields/2.15.2309.2601/ifields.min.js></script>
<?= view('template/sidebar') ?>


<!-- Main -->
<div class="l--main ">
<div id="topOfPage" ><span></span>
    <div class="l--content--grid">
        <div></div>
        <div class="">
            <header class="header header--grid">
                <!-- <div class="header__title text-center">Merchant Boarding Form</div> -->
                <div class=""></div>
            </header>

        </div>
    </div><span></span>

    <iframe id="agreement" class="agreement" width="100%" height="700" data-ifields-id="agreement" src="https://cdn.cardknox.com/ifields/2.15.2309.2601/agreement.htm"></iframe>
</div>
</div>


<!-- Main -->


<?= view('template/footer') ?>
<!-- <script src=https://cdn.cardknox.com/ifields/2.15.2309.2601/ifields.min.js></script> -->
<link href="<?= base_url('public/assets/css/bootstrap.css'); ?>" rel="stylesheet">
<link href="<?= base_url('public/assets/css/dataTables.bootstrap4.min.css'); ?>" rel="stylesheet">
<link href="<?= base_url('public/assets/css/responsive.bootstrap4.min.css'); ?>" rel="stylesheet">
<link href="<?= base_url('public/assets/css/sweetalert2.min.css'); ?>" rel="stylesheet">



<script>
    window.onload = function() {
        ckCustomerAgreement.enableAgreement({
            iframeField: 'agreement',
            xKey: 'testtechd661cb9bc55a4951813eb2bd84ee1711',
            autoAgree: true,
            callbackName: 'handleAgreementResponse'
        });
    };

    function handleAgreementResponse(response) {
        let msg = null;
        if (!response) {
            msg = "Failed to load token. No Response";
        } else if (response.status !== iStatus.success) {
            msg = "Failed to load token. " + response.statusText || "No Error description available";
        } else if (!response.token) {
            msg = "Failed to load token. No Token available";
        } else {
            msg = response.token;
        }
        setTimeout(() => {
            alert(msg)
        }, 10);
    }
</script>