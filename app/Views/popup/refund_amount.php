<!-- Modal -->
<div class="modal fade" id="refundcustomerAmount" tabindex="-1" role="dialog" aria-labelledby="refundcustomerAmountLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header border-bottom-0">
                <h5 class="modal-title" id="refundcustomerAmountLabel">Reference #<?= $transaction_detaild['xRefNum']; ?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <?php echo \Config\Services::validation()->listErrors() ?>
            <form action="javascript:void(0)" name="refund_customer_amount" id="refund_customer_amount" method="post" accept-charset="utf-8">
                <input type="hidden" name="refnumber" value="<?= encodeID($transaction_detaild['xRefNum']); ?>">
                <?= csrf_field() ?>

                <div class="modal-body" style="max-height: calc(100vh - 200px);overflow-y: auto;">

                    <div class="refundContain">

                        <div class="form-group row">
                            <div class="col-sm-4">Transaction Type: </div>
                            <div class="col-sm-8"><?= str_replace('CC:', '', $transaction_detaild['xCommand']); ?></div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-4">Original Charge: </div>
                            <div class="col-sm-8">$<?= $transaction_detaild['original']; ?></div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-4">Transaction Date: </div>
                            <div class="col-sm-8"><?= date("m/d/Y", strtotime($transaction_detaild['xEnteredDate'])); ?></div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-4">
                                <div class="form-check form-check-inline mt-2">
                                    <input class="form-check-input" type="radio" id="refundfull" name="refund" value="full" checked>
                                    <label class="form-check-label" for="inlineradio1">Full refund</label>
                                </div>
                            </div>
                            <div class="col-sm-8">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-dollar-sign"></i></span>
                                    </div>
                                    <input type="number" class="form-control refundfull" name="amountfull" readonly value="<?= $transaction_detaild['xAmount']; ?>">
                                    <span class="error" id="refundfull"></span>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-sm-4">
                                <div class="form-check form-check-inline mt-2">
                                    <input class="form-check-input" type="radio" id="refundpartial" name="refund" value="partial">
                                    <label class="form-check-label" for="inlineradio1">Partial refund</label>
                                </div>
                            </div>
                            <div class="col-sm-8">
                                <div class="input-group refundpartialclass">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-dollar-sign"></i></span>
                                    </div>
                                    <input type="number" class="form-control refundpartial" name="amountpartial" readonly>
                                </div>
                                <span class="error" id="amountpartial"></span>
                            </div>
                        </div>
                    </div>

                    <div>
                        <div class="form-group">
                            <label for="Description">Description</label>
                            <input type="text" class="form-control" id="Description" aria-describedby="DescriptionHelp" name="description">
                        </div>
                    </div>

                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    <button type="submit" id="submit" name="submit" value="submit" class="btn btn-primary submitRefund">Submit Refund</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    $('.refundpartial').on('blur', function() {

        $("#amountpartial").text('');
        $('.submitRefund').prop('disabled', false);

        var refundpartial_amount = parseFloat($(this).val());
        var exists_amount = parseFloat($('.refundfull').val());
        if (refundpartial_amount && exists_amount < refundpartial_amount) {
            $("#amountpartial").text("please enter less then total amount");
            $('.submitRefund').prop('disabled', true);
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


    if ($("#refund_customer_amount").length > 0) {

        $("#refund_customer_amount").validate({

            submitHandler: function(form) {

                var amount_type = $("input[type='radio']:checked").val();
                var myInput = $('.refund' + amount_type);

                var amount = parseFloat($('.refund' + amount_type).val());
                if (amount_type == 'partial') {
                    if (!amount || amount == '') {
                        $("#amountpartial").text("Please enter a amount");
                    } else {
                        $("#amountpartial").text('');
                    }
                }

                if ($('#amountpartial').text() !== '') {
                    form.preventDefault(); // Prevent form submission if there's an error
                }

                swal({
                    title: 'Refund Confirmation',
                    text: 'Are you sure you want to refund this amount?',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#F44336',
                    confirmButtonText: 'Refund',
                    cancelButtonText: 'Cancel'
                }).then((Delete) => {
                    if (Delete) {

                        addOverlay();

                        $.ajax({
                            url: "<?= base_url('index.php/refund_amount/' . $transaction_detaild['xCustom01']) ?>",
                            type: "POST",
                            data: $('#refund_customer_amount').serialize(),
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