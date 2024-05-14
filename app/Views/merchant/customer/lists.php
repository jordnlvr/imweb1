<?= view('template/header') ?>

<?= view('template/sidebar') ?>


<!-- Main -->
<div class="l--main ">
    <div id="topOfPage"><span></span>
        <div class="l--content--grid">
            <div></div>
            <div class="manage-client">

                <header class="header header--grid page_header">
                    <h5 class="header__title">Manage Client
                    </h5>
                    <button type="button" class="btn btn-primary btn-xs float-sm-right" data-toggle="modal" data-target="#createCustomer">
                        <i class="fa fa-plus-circle"></i>
                        New Client
                    </button>
                </header>

                <div class="table-responsive">
                    <table id="example" class="table table-striped table-bordered nowrap" style="width:100%">
                        <thead>
                            <tr>
                                <th>Client ID</th>
                                <!-- <th>Bill Company</th> -->
                                <th>Bill First Name</th>
                                <th>Bill Last Name</th>
                                <!-- <th>Created Date</th> -->
                                <!-- <th>Revision</th> -->
                                <th>Email</th>
                                <th>Affiliate Source</th>
                                <th>Action</th>
                                <th>Transaction</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if (isset($customers) && !empty($customers)) {
                                foreach ($customers as $key => $value) {
                            ?>
                                    <tr>
                                        <td class="mhide" data-name="Client ID"><?php echo $value['CustomerId']; ?></td>
                                        <!-- <td><?php echo $value['BillCompany'] ?? ''; ?></td> -->
                                        <td class="mTdInline fname"><?php echo $value['BillFirstName']; ?></td>
                                        <td class="mTdInline pl-1 lname"><?php echo $value['BillLastName'] ?? ''; ?></td>
                                        <!-- <td><?php echo $value['CreatedDate']; ?></td> -->
                                        <!-- <td><?php echo $value['Revision']; ?></td> -->
                                        <td class="mhide" data-name="Email"><?php echo $value['Email'] ?? ''; ?></td>
                                        <td class="mhide wrapTd" data-name="Affiliate Source"><?php echo $value['CustomerCustom01'] ?? ''; ?></td>
                                        <td class="actionBtn">
                                            <!-- <a class="btn btn-success btn-sm" title="View Client" href="<?= base_url('index.php/client-details/' . $value['CustomerId']); ?>" data-toggle="tooltip" data-placement="top">
                                                <i class="fa fa-eye"></i> <span class="mbtntxt">View </span>                                                
                                            </a> -->
                                            <a class="btn btn-success btn-sm" title="View Client" href="<?= base_url('index.php/client-transaction/' . $value['CustomerId']); ?>" data-toggle="tooltip" data-placement="top">
                                                <i class="fa fa-eye"></i> <span class="mbtntxt">View </span>
                                            </a>


                                            <a class="btn btn-warning btn-sm" title="Edit Client" href="<?= base_url('index.php/edit-client/' . $value['CustomerId']); ?>" data-toggle="tooltip" data-placement="top">
                                                <i class="far fa-edit"></i> <span class="mbtntxt">Edit</span>
                                            </a>
                                            <button type="button" title="Delete Client" onclick="deletecustomer('<?= $value['CustomerId'] ?>')" class="btn btn-danger btn-sm" data-toggle="tooltip" data-placement="top"><i class="far fa-trash-alt"></i> <span class="mbtntxt">Delete </span></button>
                                        </td>
                                        <td class="transBtn">
                                            <!-- <a class="btn btn-primary btn-sm sendpaymentrequestlink" title="Send payment request" href="<?= base_url('index.php/payment-request/' . $value['CustomerId']); ?>" CustomerId="<?php echo $value['CustomerId']; ?>" data-toggle="modal" data-target="#payCustomer" data-CustomerId="<?php echo $value['CustomerId']; ?>">
                                                Pay
                                            </a> -->

                                            <button type="button" class="btn btn-success btn-sm mhide" data-toggle="modal" data-target="#createTransaction" onclick="createtransaction('<?= $value['CustomerId'] ?>');" data-placement="top" title="New Transaction"><i class="fas fa-plus"></i><span class="mbtntxt">New Transaction</span></button>

                                            <a class="btn btn-info btn-sm sendpaymentrequestlink" title="Send Email Payment Link Request" href="javascript:void(0)" data-customerid="<?php echo $value['CustomerId']; ?>" data-firstname="<?php echo $value['BillFirstName']; ?>" data-customer-email="<?php echo $value['Email'] ?? ''; ?>" data-xKey="<?php echo $xKey; ?>" data-toggle="modal" data-target="#payCustomer"><i class="fas fa-paper-plane send-icon"></i> <span class="mbtntxt">Send Payment Link</span>
                                            </a>

                                            <a class="btn btn-danger btn-sm" title="Transaction history" href="<?= base_url('index.php/client-transaction/' . $value['CustomerId']); ?>" data-toggle="tooltip" data-placement="top"><i class="fas fa-history transaction-history-icon"></i> <span class="mbtntxt">Transaction</span></a>
                                        </td>
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

<!-- Modal -->
<div class="modal fade" id="createCustomer" tabindex="-1" role="dialog" aria-labelledby="createCustomerLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header border-bottom-0">
                <h5 class="modal-title" id="createCustomerLabel">Add a New Client</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form action="javascript:void(0)" name="create_customer_form" id="create_customer_form" method="post" accept-charset="utf-8">
                <div class="modal-body">

                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="email1">Email Address <span class="require">*</span></label>
                                <input type="text" class="form-control" id="email1" aria-describedby="emailHelp" placeholder="Enter Email" name="email" value="">

                            </div>
                            <span id="emailError" class="error-message" style="color: red;"></span>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="note">Notes </label>
                                <textarea class="form-control" id="note" placeholder="Enter note here" name="note"></textarea>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <h5>Billing Information <span class="info-icon" data-toggle="tooltip" data-placement="bottom" title="The billing information entered will be utilized for all your transactions and invoices.">i</span></h5>
                    <hr>
                    <div class="row">

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="firstName">First Name <span class="require">*</span></label>
                                <input type="text" class="form-control" id="firstName" aria-describedby="firstNameHelp" placeholder="Enter first name" name="firstName" value="">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="lastName">Last Name <span class="require">*</span></label>
                                <input type="text" class="form-control" id="lastName" aria-describedby="lastNameHelp" placeholder="Enter last name" name="lastName" value="">
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="company">Company</label>
                                <input type="text" class="form-control" id="company" aria-describedby="companyHelp" placeholder="Enter company name" name="company" value="">
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="address1">Address 1</label>
                                <input type="text" class="form-control" id="address1" aria-describedby="address1Help" placeholder="Enter address 1" name="address1" value="">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="address2">Address 2</label>
                                <input type="text" class="form-control" id="address2" aria-describedby="address2Help" placeholder="Enter address 2" name="address2" value="">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="city">City </label>
                                <input type="text" class="form-control" id="city" aria-describedby="cityHelp" placeholder="Enter city name" name="city" value="">
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="state">State</label>
                                <input type="text" class="form-control" id="state" aria-describedby="stateHelp" placeholder="Enter state" name="state" value="">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="zip">Zip</label>
                                <input type="text" class="form-control" id="zip" aria-describedby="zipHelp" placeholder="Enter zip" name="zip" value="">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="phone">Phone Number</label>
                                <input type="text" class="form-control" id="phone" aria-describedby="phoneHelp" placeholder="Enter number" name="phone" value="" data-inputmask-inputformat="999-999-9999">
                            </div>
                        </div>
                    </div>
                    <hr>
                    <h5>Affiliate Information </h5>
                    <hr>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="referral_source">Affiliate Referral Source</label>
                                <input type="text" class="form-control" id="referral_source" aria-describedby="referralSourceHelp" name="referral_source" value="" maxlength="256">
                                <span class="inputTxt">(Max Character : 256)</span>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="modal-footer border-top-0 d-flex justify-content-right">
                    <button type="submit" id="save" name="save" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>


<!-- Modal -->
<div class="modal fade" id="payCustomer" tabindex="-1" role="dialog" aria-labelledby="payCustomerLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header border-bottom-0">
                <h5 class="modal-title" id="createCustomerLabel">Send Email Payment Link Request</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <input type="hidden" name="id" id="id" value>
                <input type="hidden" name="customer_email" id="customer_email" value>
                <input type="hidden" name="firstname" id="firstname" value>
                <div class="row">
                    <div class="col-lg-3 col-lg-12">

                        <span class="font-weight-bold">Generating a payment link will enable you to send a payment page link to your client and collect payment from their end through direct sale transaction.</span>

                        <hr>

                        <div class="form-group">
                            <label for="amount">Amount<span class="require">*</span></label> <span class="info-icon" data-toggle="tooltip" data-placement="bottom" title="Enter total transaction amount">i</span>
                            <div class="input-group mb-3 form-group">
                                <span class="input-group-text">$</span>
                                <input type="number" class="form-control amount" id="amount" aria-describedby="amountHelp" placeholder="Amount" name="amount" value="">
                            </div>
                            <span id="amountError" class="error-amount-message" style="color: red;"></span>
                        </div>
                    </div>
                    <div class="col-lg-3 col-lg-12">
                        <div class="form-group">
                            <label for="amount">Order Invoice Number</label> <span class="info-icon" data-toggle="tooltip" data-placement="bottom" title="Add invoice number details">i</span>
                            <input type="number" class="form-control" id="order_invoice_number" aria-describedby="order_invoice_numberHelp" placeholder="Order Invoice Number" name="order_invoice_number" value="">
                        </div>
                    </div>
                    <div class="col-lg-3 col-lg-12">
                        <div class="form-group">
                            <label for="amount" class="block">&nbsp;</label>
                            <button class="btn btn-primary btn-sm generate_link" type="button" onclick="generateLink()">Generate Link</button>
                        </div>
                    </div>
                </div>
                <div class="generate">
                    <hr>
                    <h5>Share this payment link</h5>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <input type="text" class="form-control url" id="url" name="url" value='asfsafsafvgwfgwefg' readonly>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">

                                <button class="btn btn-danger btn-sm sendpaymentrequest" id="copyButton" data-clipboard-text="Copy me!">Copy</button>
                                <button type="button" onclick="sendpaymentlinktoemail()" data-email='' title="Send payment request to email" class="btn btn-danger btn-sm">Email</button>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>

    </div>
</div>

<!-- Create New Transaction -->
<!-- Modal -->
<div class="modal fade" id="createTransaction" tabindex="-1" role="dialog" aria-labelledby="createTransactionLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header border-bottom-0">
                <h5 class="modal-title" id="createTransactionLabel">Add New Transaction</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="ajaxContent"></div>
        </div>
    </div>
</div>

<div id="dynamicContentContainer"></div>



<?= view('template/footer') ?>

<script src="<?= base_url('public/assets/js/jquery.validate.js'); ?>"></script>
<script src="<?= base_url('public/assets/js/additional-methods.min.js'); ?>"></script>
<script src="<?= base_url('public/assets/js/sweetalert2.min.js'); ?>"></script>
<script src="<?= base_url('public/assets/js/jquery.inputmask.js'); ?>"></script>

<script>
    $(document).ready(function() {
        $('#createCustomer').on('hide.bs.modal', function() {
            var form = $(this).find('form');
            form[0].reset(); // Reset the form
            form.validate().resetForm(); // Reset the validation messages
        });
    });

    $('#phone').inputmask("999-999-9999");
    $('#zip').inputmask("99999");

    function createtransaction(customerid) {
        addOverlay();
        $('#createTransaction').modal({
            backdrop: 'static', // Prevent closing on click outside
            keyboard: false // Prevent closing with the keyboard
        });
        // Make an AJAX request to fetch dynamic content
        $.ajax({
            url: '<?= site_url('popup/new_transaction') ?>/' + customerid,
            method: 'POST',
            success: function(data) {
                // Update the content in the modal
                $('#ajaxContent').html(data.html);
                // Show the modal
            },
            complete: removeOverlay
        });
    }

    function deletecustomer(itemId) {

        swal({
            title: 'Delete Confirmation',
            text: 'Are you sure you want to delete this client?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#F44336',
            confirmButtonText: 'Delete',
            cancelButtonText: 'Cancel'
        }).then((Delete) => {
            if (Delete) {

                addOverlay();

                $.ajax({
                    url: "<?= base_url('index.php/delete-client/') ?>" + itemId,
                    type: "POST",
                    dataType: "json",
                    success: function(response) {

                        if (response.error === true) {

                            errors = response.message;

                            swal({
                                title: "Error!",
                                text: "Client not delete",
                                type: "error",
                                icon: "error",
                                //timer: 2000
                            });

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

    $(document).ready(function() {
        $('#copyButton').on('click', function() {
            // Get the input element
            var input = document.getElementById('url');

            // Check if the select method is available
            if (input && typeof input.select === 'function') {
                // Select the text in the input field
                input.select();
                input.setSelectionRange(0, 99999); // For mobile devices

                try {
                    // Copy the selected text to the clipboard
                    document.execCommand('copy');
                    //console.log('Text copied to clipboard:', input.value);
                } catch (err) {
                    //console.error('Unable to copy text to clipboard:', err);
                }
            } else {
                console.error('input.select is not a function or input element not found.');
            }
        });
    });


    function sendpaymentlinktoemail() {


        swal({
            title: 'Send Confirmation',
            text: 'Are you sure you want to send this payment link?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#F44336',
            confirmButtonText: 'Send',
            cancelButtonText: 'Cancel'
        }).then((Delete) => {
            if (Delete) {

                addOverlay();

                $.ajax({
                    url: "<?= base_url('index.php/send_payment_form_to_client') ?>",
                    type: "POST",
                    data: {
                        payment_url: document.getElementById('url').value,
                        email: document.getElementById('customer_email').value,
                        id: document.getElementById('id').value
                    },
                    dataType: "json",
                    success: function(response) {

                        if (response.error === true) {

                            errors = response.message;

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


    $(".generate").hide();
    $(".generate_link").hide();
    //var customerId = '';
    var xKey = '<?php echo $xKey; ?>';
    //var firstName = '';

    function base64_encode(str) {
        // Use btoa() for basic encoding
        return btoa(unescape(encodeURIComponent(str)));
    }


    // Display the link or perform further actions
    function generateLink() {
        var customerId = $("#id").val();
        var firstName = $("#firstname").val();

        var amount = $(".amount").val();
        var order_invoice_number = $("#order_invoice_number").val();

        $("#url").val('');
        var time = new Date().getTime();

        var url = base64_encode(customerId + '&' + xKey + '&' + firstName + '&' + amount + '&' + order_invoice_number + '&' + time);

        $("#url").val('<?= base_url('index.php/send-payment-request'); ?>/' + url);

        $('.sendpaymentrequest').attr('data-clipboard-text', '<?= base_url('index.php/send-payment-request'); ?>/' + url);

        $("#payment_url").val($("#url").val());
        $(".generate").show();
    }

    $('#amount').on('keyup', function() {
        var amount = $(this).val();
        $(".generate").hide();
        $(".generate_link").hide();
        if (amount > 0) {
            if (amount > 999) {
                $("#amountError").text('Enter a Amount Between $1 to $1000');
            } else {
                $(".generate_link").show();
                $("#amountError").text('');
            }
        }
    });
</script>








...............
<script src="<?= base_url('public/assets/js/jquery.validate.js'); ?>"></script>
<script src="<?= base_url('public/assets/js/additional-methods.min.js'); ?>"></script>
<script src="<?= base_url('public/assets/js/sweetalert2.min.js'); ?>"></script>
<script>
    $(document).on("click", ".sendpaymentrequestlink", function() {

        $("#payCustomer input[type='number']").val('');
        $("#payCustomer input[type='text']").val('');

        var CustomerId = $(this).data('customerid');
        var firstname = $(this).data('firstname');
        var customer_email = $(this).data('customer-email');

        $(".modal-body input#id").val(CustomerId);
        $(".modal-body input#firstname").val(firstname);
        $(".modal-body input#customer_email").val(customer_email);
    });

    $.validator.addMethod("nospaces", function(value, element) {
        return value.indexOf('  ') === -1; // Check for double spaces
    }, "Double spaces are not allowed");

    if ($("#create_customer_form").length > 0) {
        $("#create_customer_form").validate({
            rules: {
                email: {
                    required: true,
                    maxlength: 50,
                    email: true,
                    nospaces: true
                },
                zip: {
                    minlength: 5,
                    maxlength: 5,
                    digits: true,
                    nospaces: true
                },

                firstName: {
                    required: true,
                    nospaces: true
                },
                lastName: {
                    required: true,
                    nospaces: true
                },
                note: {
                    nospaces: true
                },
                company: {
                    nospaces: true
                },
                address1: {
                    nospaces: true
                },
                address2: {
                    nospaces: true
                },
                city: {
                    nospaces: true
                },
                state: {
                    nospaces: true
                },
            },
            messages: {
                email: {
                    required: "Please enter valid email",
                    email: "Please enter valid email",
                    maxlength: "The email name should less than or equal to 50 characters",
                },
                firstName: {
                    required: "Please enter first name",
                    nospaces: 'Enter first name'
                },
                lastName: {
                    required: "Please enter last name",
                    nospaces: 'Enter last name'
                },

            },

            submitHandler: function(form) {

                swal({
                    title: 'Save Confirmation',
                    text: 'Are you sure you want to add this client?',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#F44336',
                    confirmButtonText: 'Save',
                    cancelButtonText: 'Cancel'
                }).then((Delete) => {
                    if (Delete) {
                        addOverlay();
                        $.ajax({
                            url: "<?= base_url('index.php/add-client') ?>",
                            type: "POST",
                            data: $('#create_customer_form').serialize(),
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
                                            window.location.href = "<?= base_url('index.php/client-lists/') ?>";
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

    }
</script>