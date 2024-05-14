<?= view('template/header') ?>

<?= view('template/sidebar') ?>


<!-- Main -->
<div class="l--main ">
    <div id="topOfPage"><span></span>
        <div class="l--content--grid">
            <div></div>
            <div class="">
                <header class="header header--grid">
                    <div class="header__title">Transaction History</div>
                    <div class=""></div>
                    <div class="col-sm">
                        <!-- <button type="button" class="btn btn-success btn-sm float-sm-right" data-toggle="modal" data-target="#createCustomer">
                        <i class="fa fa-plus-circle"></i>
                        New transaction
                    </button> -->
                    </div>
                </header>

                <div class="table-responsive">
                    <table id="example" class="table table-striped table-bordered nowrap" style="width:100%">
                        <thead>
                            <tr>
                                <th>Reference Number:</th>
                                <th>Client Id</th>
                                <th>Amount</th>
                                <th>Card Details</th>
                                <th>Transaction Type</th>
                                <th>Date</th>
                                <th>Status</th>
                                <th>Message</th>
                        </thead>
                        <tbody>
                            <?php
                            if (isset($transactions) && !empty($transactions)) {
                                //echo '<pre>';
                                //print_r($transactions);
                                foreach ($transactions as $key => $value) {
                                    $xCommand = str_replace("CC:", "", $value['xCommand']);
                            ?>
                                    <tr>
                                        <td><?php echo $value['xRefNum']; ?></td>
                                        <td><a href="<?= base_url('index.php/client-details/' . $value['xCustom01']); ?>"><?php echo $value['xCustom01']; ?></a></td>
                                        <td class="<?= (($value['xResponseResult'] == 'Approved' && $value['xAmount'] < 0) ? 'negative-value' : ''); ?>"><?php echo '$' . $value['xAmount']; ?></td>
                                        <td><?php echo substr($value['xMaskedCardNumber'], -4); ?></td>
                                        <td><?= ($xCommand == 'Sale' ? 'Direct sale' : ($xCommand == 'AuthOnly' ? 'Pre Authorization' : $xCommand)); ?></td>
                                        <td><?php echo date("m/d/Y", strtotime($value['xEnteredDate'])); ?></td>
                                        <td>
                                            <?= ($value['xResponseResult'] == 'Approved' ? '<span class="badge badge-success">Approved</span>' : '<span class="badge badge-warning">Error</span>'); ?>
                                        </td>
                                        <td><?= $value['xResponseError']; ?></td>
                                    </tr>
                            <?php
                                }
                            }
                            ?>
                        </tbody>
                    </table>
                </div>

            </div>

        </div><span></span>

    </div>
</div>
<!-- Main -->
<?php
// echo '<pre>';
// print_r($transactions);
// exit;
?>
<!-- Modal -->
<div class="modal fade" id="createCustomer" tabindex="-1" role="dialog" aria-labelledby="createCustomerLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header border-bottom-0">
                <h5 class="modal-title" id="createCustomerLabel">Add New Transaction</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form action="javascript:void(0)" name="create_transaction_form" id="create_transaction_form" method="post" accept-charset="utf-8">
                <div class="modal-body">
                    <h5>Billing Information</h5>
                    <hr>
                    <div class="row">
                        <input type="hidden" name="CustomerId" value="<?php echo $customers['CustomerId'] ?? '' ?>">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="firstName">First Name </label>
                                <input type="text" class="form-control" name="firstName" value="<?php echo $customers['BillFirstName'] ?? '' ?>">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="lastName">Last Name </label>
                                <input type="text" class="form-control" name="lastName" value="<?php echo $customers['BillLastName'] ?? '' ?>">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="company">Company </label>
                                <input type="text" class="form-control" name="company" value="<?php echo $customers['BillCompany'] ?? '' ?>">
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="address1">Address</label>
                                <input type="text" class="form-control" name="address1" value="<?php echo $customers['BillState'] ?? '' ?>">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="city">City </label>
                                <input type="text" class="form-control" name="city" value="<?php echo $customers['BillCity'] ?? '' ?>">
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="state">State</label>
                                <input type="text" class="form-control" name="state" value="<?php echo $customers['BillState'] ?? '' ?>">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="zip">Zip</label>
                                <input type="text" class="form-control" name="zip" value="<?php echo $customers['BillZip'] ?? '' ?>">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="phone">Phone Number</label>
                                <input type="text" class="form-control" name="phone" value="<?php echo  $customers['Billmobile'] ?? '' ?>">
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="firstName">Amount <span class="require">*</span></label>
                                <input type="text" class="form-control" name="amount" placeholder="$0.00" value="">
                            </div>
                        </div>
                    </div>
                    <hr>
                    <h5>Payment Information</h5>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="firstName">Card Number <span class="require">*</span></label>
                                <input type="text" class="form-control" name="cardnumber" placeholder="xxxx xxxx xxxx xxxx">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="firstName">Exp Date <span class="require">*</span></label>
                                <input type="text" class="form-control" name="expiry" placeholder="MM/YY">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="firstName">CVV</label>
                                <input type="text" class="form-control" name="cvv" placeholder="xxx">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer border-top-0 d-flex justify-content-right">
                    <button type="submit" id="save" name="save" class="btn btn-danger">Process (Total $0.00)</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?= view('template/footer') ?>

<link href="<?= base_url('public/assets/css/bootstrap.css'); ?>" rel="stylesheet">
<link href="<?= base_url('public/assets/css/dataTables.bootstrap4.min.css'); ?>" rel="stylesheet">
<link href="<?= base_url('public/assets/css/responsive.bootstrap4.min.css'); ?>" rel="stylesheet">
<link href="<?= base_url('public/assets/css/sweetalert2.min.css'); ?>" rel="stylesheet">

<script src="<?= base_url('public/assets/js/jquery.validate.js'); ?>"></script>
<script src="<?= base_url('public/assets/js/additional-methods.min.js'); ?>"></script>
<script src="<?= base_url('public/assets/js/sweetalert2.min.js'); ?>"></script>

<script>
    if ($("#create_transaction_form").length > 0) {
        $("#create_transaction_form").validate({
            rules: {
                amount: {
                    required: true,
                },
                cardnumber: {
                    required: true,
                },
                expiry: {
                    required: true,
                },
            },
            messages: {
                amount: {
                    required: "A valid amount is required",
                },
                cardnumber: {
                    required: "Card Number is required",
                },
                expiry: {
                    required: "Exp Date is required",
                },

            },

            submitHandler: function(form) {
                // addOverlay();
                // $.ajax({
                //     url: "<?php echo base_url('index.php/add-transaction') ?>",
                //     type: "POST",
                //     data: $('#create_transaction_form').serialize(),
                //     dataType: "json",
                //     success: function(response) {
                //         setTimeout(function() {
                //             alert('Transaction create successfully')
                //             window.location.href = "<?php echo base_url('index.php/client-lists') ?>";
                //         }, 1000);
                //     },
                //     complete: removeOverlay
                // });
                // return false;
                swal({
                    title: 'Are you sure...?',
                    //text: "You want to continue...?",
                    type: 'warning',
                    showCancelButton: true,
                }).then((Delete) => {
                    if (Delete) {
                        addOverlay();
                        $.ajax({
                            url: "<?= base_url('index.php/add-transaction') ?>",
                            type: "POST",
                            data: $('#create_transaction_form').serialize(),
                            dataType: "json",
                            success: function(response) {
                                if (response.error === true) {
                                    errors = response.message;
                                    alert(errors);
                                    return false;
                                }
                                if (response.success === true) {
                                    swal({
                                        position: "top-end",
                                        icon: "success",
                                        title: response.message,
                                        showConfirmButton: false,
                                        timer: 1500
                                    });
                                    window.location.href = "<?= base_url('index.php/transaction-lists/') ?>";
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