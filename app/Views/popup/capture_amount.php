<!-- Modal -->
<div class="modal fade" id="capturecustomerAmount" tabindex="-1" role="dialog" aria-labelledby="capturecustomerAmountLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header border-bottom-0">
                <h5 class="modal-title" id="capturecustomerAmountLabel">Capture</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <?php echo \Config\Services::validation()->listErrors() ?>
            <form action="javascript:void(0)" name="capture_customer_amount" id="capture_customer_amount" method="post" accept-charset="utf-8">
                <input type="hidden" name="refnumber" value="<?= encodeID($transaction_detaild['xRefNum']); ?>">
                <?= csrf_field() ?>

                <div class="modal-body" style="max-height: calc(100vh - 200px);overflow-y: auto;">

                    <div class="refundContain">

                        <div class="form-group row">
                            <div class="col-sm-4">Transaction Type: </div>
                            <div class="col-sm-8"><?= ($transaction_detaild['xCommand'] == 'CC:AuthOnly' ? '<img src=' . base_url() . '/public/assets/images/auth.svg>' : str_replace("CC:","",$transaction_detaild['xCommand'])) ?></div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-4">Original Charge: </div>
                            <div class="col-sm-8">$<?= $transaction_detaild['original']; ?></div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-4">
                                <div class="form-check form-check-inline mt-2">
                                    <label class="form-check-label" for="inlineradio1">Amount</label>
                                </div>
                            </div>
                            <div class="col-sm-8">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-dollar-sign"></i></span>
                                    </div>
                                    <input type="number" class="form-control" id="charge" name="amountfull" value="<?= $transaction_detaild['original']; ?>">
                                    <span class="error" id="chargeError"></span>
                                </div>
                            </div>
                        </div>


                    </div>

                </div>
                <div class="modal-footer">
                    <button type="submit" id="submit" name="submit" value="submit" class="btn btn-primary submitcapture">Capture</button>    
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    $('#charge').on('blur', function() {

        $("#chargeError").text('');
        $('.submitcapture').prop('disabled', false);


        var charge_value = 0;
        var total_val = 0;

        charge_value = $('#charge').val();


        if (charge_value === "") {
            $("#chargeError").text("amount textbox is required");
            $('.submitcapture').prop('disabled', true);
        } else {

            var numeric_charge_value = parseFloat(charge_value) || 0;
            total_val = numeric_charge_value;
            $('#charge').val(total_val);
        }

    });

    $(document).ready(function() {
        $('input[name="refund"]').on('change', function() {

            $("#amountpartial").text('');

            var inputValue = $(this).val();
            var myInput = $('.refund' + inputValue);

            var amount = $('.refund' + inputValue).val();
            if (inputValue == 'full') {
                myInput.prop('readonly', true);
                $('.refundpartial').val('');
                $('.refundpartial').prop('readonly', true);
            } else {
                myInput.prop('disabled', false);
                myInput.prop('readonly', false);
            }

            if (amount.length > 0) {
                $('.submitRefund').prop('disabled', false);
            } else {
                $('.submitRefund').prop('disabled', true);
            }
        });


        $('.refundpartial').on('input', function() {
            var inputValue = $(this).val();
            var myButton = $('.submitRefund');

            if (inputValue.trim() !== '') {
                myButton.prop('disabled', false);
            } else {
                myButton.prop('disabled', true);
            }
        });

    });


    if ($("#capture_customer_amount").length > 0) {

        $("#capture_customer_amount").validate({

            submitHandler: function(form) {

                if ($('#chargeError').text() !== '') {
                    form.preventDefault(); // Prevent form submission if there's an error
                }

                swal({
                    title: 'Amount Confirmation',
                    text: 'Are you sure you want to paid this amount?',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#F44336',
                    confirmButtonText: 'Confirm',
                    cancelButtonText: 'Cancel',
                    customClass: ".btn btn-sm"
                }).then((Delete) => {
                    if (Delete) {

                        addOverlay();

                        $.ajax({
                            url: "<?= base_url('index.php/capture_amount/' . $transaction_detaild['xCustom01']) ?>",
                            type: "POST",
                            data: $('#capture_customer_amount').serialize(),
                            dataType: "json",
                            success: function(response) {

                                if (response.error === true) {

                                    swal({
                                        title: "Error!",
                                        text: response.message,
                                        type: "error",
                                        icon: "error",
                                        //timer: 2000
                                    });

                                }

                                if (response.success === true) {

                                    swal({
                                        title: "Success!",
                                        text: response.message,
                                        type: "success",
                                    }).then(okay => {
                                        if (okay) {
                                            window.location.href = "<?= base_url('index.php/client-transaction/') ?>" + response.customerid;
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