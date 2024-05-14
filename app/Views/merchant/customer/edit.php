<?= view('template/header') ?>

<?= view('template/sidebar') ?>
<!-- Main -->
<!-- Main -->
<div class="l--main ">
    <div id="topOfPage"><span></span>
        <div class="l--content--grid">
            <div></div>
            <div class="">
                <header class="header header--grid">
                    <div class="header__title">Manage Client</div>
                    <a href="javascript:history.back()" class="btn-sm btn btn-secondary"> <i class="fas fa-arrow-left"></i> Back</a>
                </header>
                <div class="">
                    <div class="row justify-content-md-center">
                        <div class="col-12">

                            <div class="card">
                                <div class="card-body">
                                    <p>Client ID: <?php echo $customers['CustomerId'] ?></p>
                                    <form action="javascript:void(0)" name="update_customer_form" id="update_customer_form" method="post" accept-charset="utf-8">
                                        <div class="">
                                            <input type="hidden" name="revision" id="revision" value="<?= $customers['Revision']; ?>">
                                            <input type="hidden" name="payment_method_id" id="payment_method_id" value="<?= $customers['DefaultPaymentMethodId']; ?>">
                                            <div class="row">
                                                <!-- <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="number">Client #</label>
                                                            <input type="text" class="form-control" id="number" aria-describedby="numberHelp" placeholder="Enter Client Number" name="number" value="<?php echo $customers['CustomerNumber'] ?? '' ?>">
                                                        </div>
                                                    </div> -->
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="email1">Email Address <span class="require">*</span></label>
                                                        <input type="email" class="form-control" id="email1" aria-describedby="emailHelp" placeholder="Enter email" name="email" value="<?php echo $customers['Email'] ?>">
                                                    </div>
                                                </div>

                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label for="note">Notes</label>
                                                        <textarea class="form-control" id="note" placeholder="Enter note here" name="note"><?php echo $customers['CustomerNotes'] ?? '' ?></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                            <hr>
                                            <h5>Billing Information</h5>
                                            <hr>
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="firstName">First Name <span class="require">*</span></label>
                                                        <input type="text" class="form-control" id="firstName" aria-describedby="firstNameHelp" placeholder="Enter  your first name" name="firstName" value="<?php echo $customers['BillFirstName'] ?? '' ?>">
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="lastName">Last Name </label>
                                                        <input type="text" class="form-control" id="lastName" aria-describedby="lastNameHelp" placeholder="Enter last name" name="lastName" value="<?php echo $customers['BillLastName'] ?? '' ?>">
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="company">Company</label>
                                                        <input type="text" class="form-control" id="company" aria-describedby="companyHelp" placeholder="Enter company name" name="company" value="<?php echo $customers['BillCompany'] ?? '' ?>">
                                                    </div>
                                                </div>

                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="address1">Address 1</label>
                                                        <input type="text" class="form-control" id="address1" aria-describedby="address1Help" placeholder="Enter address 1" name="address1" value="<?php echo $customers['BillStreet'] ?? '' ?>">
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="address2">Address 2</label>
                                                        <input type="text" class="form-control" id="address2" aria-describedby="address2Help" placeholder="Enter address 2" name="address2" value="<?php echo $customers['BillStreet2'] ?? '' ?>">
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="city">City </label>
                                                        <input type="text" class="form-control" id="city" aria-describedby="cityHelp" placeholder="Enter city name" name="city" value="<?php echo $customers['BillCity'] ?? '' ?>">
                                                    </div>
                                                </div>

                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="state">State</label>
                                                        <input type="text" class="form-control" id="state" aria-describedby="stateHelp" placeholder="Enter state" name="state" value="<?php echo $customers['BillState'] ?? '' ?>">
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="zip">Zip</label>
                                                        <input type="text" class="form-control" id="zip" aria-describedby="zipHelp" placeholder="Enter zip" name="zip" value="<?php echo $customers['BillZip'] ?? '' ?>">
                                                    </div>
                                                </div>
                                                <!-- <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="phone">Phone Number</label>
                                                            <input type="text" class="form-control" id="phone" aria-describedby="phoneHelp" placeholder="Enter number" name="phone" value="<?php echo  $customers['Billmobile'] ?? '' ?>">
                                                        </div>
                                                    </div> -->
                                            </div>
                                            <hr>
                                            <h5>Affiliate Information</h5>
                                            <hr>
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="referral_source">Affiliate Referral Source </label>
                                                        <input type="text" class="form-control" id="referral_source" aria-describedby="referralSourceHelp" name="referral_source" value="<?php echo $customers['CustomerCustom01'] ?? '' ?>" maxlength="256">
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
                    </div>

                </div>

            </div>

        </div><span></span>

    </div>
</div>
<!-- Main -->
<?= view('template/footer') ?>

<link href="<?= base_url('public/assets/css/bootstrap.css'); ?>" rel="stylesheet">
<link href="<?= base_url('public/assets/css/dataTables.bootstrap4.min.css'); ?>" rel="stylesheet">
<link href="<?= base_url('public/assets/css/responsive.bootstrap4.min.css'); ?>" rel="stylesheet">
<link href="<?= base_url('public/assets/css/sweetalert2.min.css'); ?>" rel="stylesheet">

<script>
    new DataTable('#example', {
        // responsive: true
    });
</script>

<script src="<?= base_url('public/assets/js/jquery.validate.js'); ?>"></script>
<script src="<?= base_url('public/assets/js/additional-methods.min.js'); ?>"></script>
<script src="<?= base_url('public/assets/js/sweetalert2.min.js'); ?>"></script>
<script src="<?= base_url('public/assets/js/jquery.inputmask.js'); ?>"></script>
<script>
    $('#zip').inputmask("99999");
    $.validator.addMethod("nospaces", function(value, element) {
        return value.indexOf('  ') === -1; // Check for double spaces
    }, "Double spaces are not allowed");
    if ($("#update_customer_form").length > 0) {
        $("#update_customer_form").validate({
            rules: {
                email: {
                    required: true,
                    maxlength: 50,
                    email: true,
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
                zip: {
                    minlength: 5,
                    maxlength: 5,
                    digits: true,
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
                },

            },

            submitHandler: function(form) {
                swal({
                    title: 'Update Confirmation',
                    text: 'Are you sure you want to update this client?',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#F44336',
                    confirmButtonText: 'Update',
                    cancelButtonText: 'Cancel'
                }).then((Delete) => {
                    if (Delete) {
                        addOverlay();
                        $.ajax({
                            url: "<?= base_url('index.php/edit-client/' . $customers['CustomerId']); ?>",
                            type: "POST",
                            data: $('#update_customer_form').serialize(),
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

    }
</script>