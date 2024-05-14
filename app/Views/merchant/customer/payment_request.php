<?= view('template/header') ?>

<?= view('template/sidebar') ?>
<!-- Main -->

<div class="l--main ">
    <div id="topOfPage"><span></span>
        <div class="l--content--grid">
            <header class="header header--grid">
                <div class="header__title">Send Payment Request</div>
            </header>
            <div class="table-responsive">
                <div class="modal-body">
                    <h6>Transaction Details</h6>
                    <div class="row">
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="amount">Amount<span class="require">*</span></label>
                                <input type="number" class="form-control amount" id="amount" aria-describedby="amountHelp" placeholder="Amount" name="amount" value="">
                            </div>

                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="amount" class="block">&nbsp;</label>
                                <button class="btn btn-danger btn-sm generate_link" type="button" onclick="generateLink()">Generate Link</button>
                            </div>
                        </div>
                    </div>
                    <div class="generate">
                        <hr>
                        <h5>Share this payment link</h5>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <input type="text" class="form-control url" id="url" name="url" value="<?= base_url('index.php/send-payment-request/' . $customers['CustomerId'] . '/'); ?>" disabled>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <a class="btn btn-danger btn-sm sendpaymentrequest" id="copyButton" title="Copy" CustomerId="<?php echo $customers['CustomerId']; ?>">
                                        Copy
                                    </a>
                                    <a class="btn btn-danger btn-sm sendformtoCustomerId" title="Send payment request to email" CustomerId="<?php echo $customers['CustomerId']; ?>" data-toggle="modal" data-target="#sendformtoCustomer">
                                        Email
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
<!-- Main -->
<!-- Modal -->
<div class="modal fade" id="sendformtoCustomer" tabindex="-1" role="dialog" aria-labelledby="sendformtoCustomerLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header border-bottom-0">
                <h5 class="modal-title" id="sendformtoCustomerLabel">Share payment Form with client</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <?php echo \Config\Services::validation()->listErrors() ?>
            <form action="javascript:void(0)" name="send_customer_lead_form" id="send_customer_lead_form" method="post" accept-charset="utf-8">

                <input type="hidden" name="create_customer" value=1></input>

                <?= csrf_field() ?>

                <div class="modal-body" style="max-height: calc(100vh - 200px);overflow-y: auto;">
                    <input type="hidden" id="payment_url" name="payment_url">
                    <hr>

                    <div class="row">
                        <div class="col-sm">
                            <div class="form-group">
                                <label for="email">Client Email <span class="require">*</span> </label>
                                <input type="text" class="form-control" id="email" aria-describedby="emailHelp" name="email" value="<?= $customers['Email']; ?>">
                            </div>
                        </div>
                    </div>&nbsp;&nbsp;
                </div>
                <div class="modal-footer border-top-0 d-flex justify-content-right">
                    <button type="submit" id="email_to_customer_form" name="email_to_customer_form" value="email_to_customer_form" class="btn btn-primary"><i class="fa fa-envelope" aria-hidden="true"></i> send</button>
                    <button type="submit" id="cancel" name="cancel" value="cancel" class="btn btn-primary" data-dismiss="modal" aria-label="Close">cancel</button>
                </div>
            </form>
        </div>
    </div>
</div>
<?= view('template/footer') ?>
<script src="<?= base_url('public/assets/js/jquery.validate.js'); ?>"></script>
<script src="<?= base_url('public/assets/js/additional-methods.min.js'); ?>"></script>
<script src="<?= base_url('public/assets/js/sweetalert2.min.js'); ?>"></script>
<script src="https://cdn.jsdelivr.net/npm/clipboard@2.0.8/dist/clipboard.min.js"></script>
<script>
    // Copy link
    $('#copyButton').click(function() {
        // Get the value from the input field
        var inputValue = $('#url').val();
        // Here's an example using Clipboard.js:

        var clipboard = new ClipboardJS();

        clipboard.on('success', function(e) {
            console.log('Text copied to clipboard:', e.text);
        });

        var clipboard = new ClipboardJS('#copyButton', {
            text: function() {
                return inputValue;
            }
        });
    });


    $(".generate").hide();
    $(".generate_link").hide();
    var customerId = '<?php echo $customers['CustomerId']; ?>';
    var xKey = '<?php echo $xKey; ?>';
    var firstName = '<?php echo $customers['BillFirstName']; ?>';

    function base64_encode(str) {
        // Use btoa() for basic encoding
        return btoa(unescape(encodeURIComponent(str)));
    }


    // Display the link or perform further actions
    function generateLink() {
        var amount = $(".amount").val();
        $("#url").val('');
        var time = new Date().getTime();
        var url = base64_encode(customerId + '&' + xKey + '&' + firstName + '&' + amount + '&' + time);
        $("#url").val('<?= base_url('index.php/send-payment-request'); ?>/' + url);
        $("#payment_url").val($("#url").val());
        $(".generate").show();
    }

    $('#amount').on('keyup', function() {
        var amount = $(this).val();
        $(".generate").hide();
        $(".generate_link").hide();
        if (amount.length > 0) {
            $(".generate_link").show();
        }
    });

    if ($("#send_customer_lead_form").length > 0) {

        $("#send_customer_lead_form").validate({

            rules: {
                email: {
                    required: true
                },
            },
            messages: {
                email: {
                    required: "email is required",
                },
            },
            submitHandler: function(form) {
                swal({
                    title: 'Are you sure...?',
                    //text: "You want to continue...?",
                    type: 'warning',
                    showCancelButton: true,
                }).then((Delete) => {
                    if (Delete) {
                        addOverlay();
                        $.ajax({
                            url: "<?= base_url('index.php/send_payment_form_to_client') ?>",
                            type: "POST",
                            data: $('#send_customer_lead_form').serialize(),
                            dataType: "json",
                            success: function(response) {
                                if (response.error === true) {
                                    errors = response.message;
                                    $.each(errors, function(key, val) {
                                        $("input#" + key).after('<label id="' + key + '-error" class="error" for="' + key + '">' + val + '</label>');
                                    });
                                    return false;
                                }
                                if (response.success === true) {
                                    swal({
                                        title: "Success!",
                                        text: response.message,
                                        type: "success"
                                    }).then(okay => {
                                        if (okay) {
                                            window.location.href = "<?= base_url('index.php/client-lists/'); ?>";
                                        }
                                    });
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
    };
</script>