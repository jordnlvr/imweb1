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

    <iframe style="border:0;" width="100%" height="100%" src="https://secure.cardknox.com/testkiranpcorporation"></iframe>

        <iframe style="border:0;" width="100%" height="100%" src="https://partner.cardknox.com/merchant/mpa?eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJuYW1laWQiOiIxOTE2MTYiLCJyb2xlIjoiTWVyY2hhbnQiLCJlbWFpbCI6InBhbmthakBpbnRlbGxpbWVkaWFuZXR3b3Jrcy5uZXQiLCJjZXJ0c2VyaWFsbnVtYmVyIjoiMzk5MDEiLCJhY3RvcnQiOiJ0ZWNoQGludGVsbGltZWRpYW5ldHdvcmtzLmNvbSIsInVuaXF1ZV9uYW1lIjoidGVjaCIsInVwbiI6IlJvdXRpbmdOdW1iZXJ8QWNjb3VudE51bWJlcnxCYW5rTmFtZXxTb2NpYWxTZWN1cml0eU51bWJlcnxEYXRlT2ZCaXJ0aHxGaXJzdE5hbWV8TGFzdE5hbWV8UGhvbmVOdW1iZXJ8QWRkcmVzc3xEQkF8QnVzaW5lc3NBZGRyZXNzfEJ1c2luZXNzRW1haWx8QnVzaW5lc3NQaG9uZXxDb3Jwb3JhdGVOYW1lfEdvb2RzT3JTZXJ2aWNlc0Rlc2NyaXB0aW9ufFRheElEIiwiaHR0cDovL3NjaGVtYXMueG1sc29hcC5vcmcvd3MvMjAwNS8wNS9pZGVudGl0eS9jbGFpbXMvc2lkIjoiIiwibmJmIjoxNzA1OTk0MzYzLCJleHAiOjE3MDg1ODYzNjMsImlhdCI6MTcwNTk5NDM2MywiaXNzIjoiUGFydG5lclBvcnRhbEFwaSIsImF1ZCI6IlBhcnRuZXJQb3J0YWwifQ.764pPuJ1QTY5BelUhX3OiPU2BbhqP1AhIyabv4MUVjU"></iframe>

        
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
            xKey: 'testtech5ffdce0056054fe7b69bb36654f262f4',
            autoAgree: true,
            callbackName: 'handleAgreementResponse'
        });
    };

    function handleAgreementResponse(response) {
        let msg = null;
        if (!response) {
            msg = "Failed to load token. No Response";
        } else if (response.status !== iStatus.success) {
            msg = "Failed to load token. "+response.statusText || "No Error description available";
        } else if (!response.token) {
            msg = "Failed to load token. No Token available";
        } else {
            msg = response.token;
        }
        setTimeout(() => {alert(msg)}, 10);
    }
</script>