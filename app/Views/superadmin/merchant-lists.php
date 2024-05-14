<?= view('template/header') ?>

<?= view('template/sidebar') ?>


<!-- Main -->
<div class="l--main ">
    <div id="topOfPage"><span></span>
        <div class="l--content--grid">
            <div></div>
            <div class="">
                <header class="header header--grid">
                    <div class="header__title">Merchant Listing</div>
                    <div class="">&nbsp;</div>
                    <?= validation_list_errors() ?>
                    <div class="col-sm">

                        <button type="button" class="btn btn-primary btn-xs float-sm-right" data-toggle="modal" data-target="#createMerchant" style="display: none;">
                            <i class="fa fa-plus-circle">
                            </i>
                            Add Merchants
                        </button>

                    </div>
                </header>

                <div class="table-responsive">
                    <table id="example_merchant" class="table table-striped table-bordered nowrap" style="width:100%">
                        <thead>
                            <tr>
                                <th>Merchant Name</th>
                                <!-- <th>MID</th> -->
                                <th>Corporate Name</th>
                                <th>Status</th>
                                <!-- <th>Business Contact Name</th> -->
                                <th>Zip</th>
                                <th>Phone Number</th>
                                <th>Business Email</th>
                                <!-- <th>Transaction Key</th> -->
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $n = 1;
                            foreach ($metchant as $row) { ?>
                                <tr>
                                    <td data-name="Merchant Name"><?= ($row['DbaName'] ? $row['DbaName'] : $row['dba']); ?></td>
                                    <!-- <td><?= $row['CardknoxMid'] ?? '-'; ?></td> -->
                                    <td class="mhide" data-name="Corporate Name"><?= $row['CorporationName'] ?? $row['corporate_name']; ?></td>
                                    <td class="mtdcol-4" data-name="Status"><?= ($row['status'] == 0 ? '<span class="badge badge-primary">New Lead</span>' : ($row['status'] == 1 ? '<span class="badge badge-warning">ONBOARDED</span>' : '<span class="badge badge-success">APPROVED</span>')); ?></td>
                                    <!-- <td><?= ($row['add_contact_name'] ? $row['add_contact_name'] : '-'); ?></td> -->
                                    <td class="mtdcol-4" data-name="Zip"><?= ($row['zip'] ? $row['zip'] : '-'); ?></td>
                                    <td class="mtdcol-4" data-name="Phone Number"><?= ($row['phone_number'] ? $row['phone_number'] : '-'); ?></td>
                                    <td data-name="Business Email"><?= ($row['email'] ? $row['email'] : '-'); ?></td>
                                    <!-- <td class="text-truncate w200"><?= ($row['CardknoxKey'] ? $row['CardknoxKey'] : $row['key']); ?></td> -->
                                    <td>

                                        <a href="<?= base_url('index.php/merchant-details/' . $row['id']); ?>" class="btn btn-success btn-sm float-sm" title="Merchant Detail" data-tooltip="Merchant detail"><i class="far fa-eye"></i> <span class="mbtntxt">View</span></a>
                                        <button type="button" id="update_merchant_key" data-id="<?= $row['id']; ?>" data-mid="<?= $row['CardknoxMid'] ?? ''; ?>" data-processormid="<?= $row['ProcessorMid'] ?? ''; ?>" data-key="<?= ($row['CardknoxKey'] ? $row['CardknoxKey'] : $row['key']); ?>" name="update_merchant_key" class="btn btn-sm btn-primary update_merchant_key" data-toggle="modal" data-target="#updateMerchantKey" data-tooltip="Edit merchant information"><i class="fa fa-pencil-alt" aria-hidden="true"></i> <span class="mbtntxt">Edit</span></button>

                                        <?php if ($row['status'] == 1) {   ?>
                                            <button type="button" title="Send Login Credentials" onclick="sendlogindetail(<?= $row['id']; ?>)" class="btn btn-sm btn-warning btn-minw <?= (empty($row['CardknoxMid']) ? 'disabled not-active' : '') ?>">Share Credentials</button>
                                        <?php } ?>

                                        <?php if ($row['status'] == 2) {   ?>
                                            <button type="button" title="Share Login Credentials" class="btn btn-sm btn-primary shareCredential btn-minw <?= (empty($row['CardknoxMid']) ? 'disabled not-active' : '') ?>" data-toggle="modal" data-target="#shareCredential" data-id="<?= $row['id']; ?>" data-username="<?= $row['email']; ?>" data-password="<?= $row['signature_token']; ?>">Share Credentials</button>
                                        <?php } ?>

                                        </a>
                                    </td>
                                </tr>
                            <?php
                            } ?>

                        </tbody>
                    </table>
                </div>

            </div>

        </div><span></span>

    </div>
</div>
<!-- Main -->


<!-- Modal -->
<div class="modal fade" id="shareCredential" tabindex="-1" role="dialog" aria-labelledby="shareCredentialLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header border-bottom-0">
                <h5 class="modal-title" id="shareCredentialLabel">Share Credentials</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <?php echo \Config\Services::validation()->listErrors() ?>
            <form action="javascript:void(0)" method="post" accept-charset="utf-8">

                <input type="hidden" name="create_merchant" value=1></input>

                <?= csrf_field() ?>

                <div class="modal-body" style="max-height: calc(100vh - 200px);overflow-y: auto;">
                    <input type="hidden" id="id" name="id">
                    <div class="row">
                        <div class="col-sm" id="userDetails">
                            <div class="form-group">
                                <label for="key">Username: </label>
                                <p id="username"></p>
                            </div>
                            <div class="form-group">
                                <label for="key">Password: </label>
                                <p id="password"></p>
                            </div>

                        </div>
                    </div>
                </div>
                <hr>
                <div class="modal-footer border-top-0 d-flex justify-content-right">
                    <button type="button" title="Share Login Credential" id="sendlogindetail" class="btn btn-info btn-sm float-sm-left sendlogindetail">Email</button>

                    <button type="button" class="btn btn-sm btn-secondary copyButton" id="copyButton" data-clipboard-text="Copy me!">Copy</button>

                    <button type="button" title="Click to generate new password for this merchant. The previously generated password will become inactive once new password is generated." id="generatelogindetail" class="btn btn-sm btn-dark generatelogindetail">Regenerate</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="createMerchant" tabindex="-1" role="dialog" aria-labelledby="createMerchantLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header border-bottom-0">
                <h5 class="modal-title" id="createMerchantLabel">New Lead</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <?php echo \Config\Services::validation()->listErrors() ?>
            <form action="javascript:void(0)" name="create_merchant_lead_form" id="create_merchant_lead_form" method="post" accept-charset="utf-8">

                <input type="hidden" name="create_merchant" value=1></input>

                <?= csrf_field() ?>

                <div class="modal-body" style="max-height: calc(100vh - 200px);overflow-y: auto;">
                    <h5><span class="label label-default">General Information</span></h5>
                    <hr>

                    <div class="row">
                        <div class="col-sm">
                            <div class="form-group">
                                <label for="firstname">First Name </label>
                                <input type="text" class="form-control" id="firstName" aria-describedby="firstnameHelp" name="firstName">
                            </div>

                            <div class="form-group">
                                <label for="title">Title </label>
                                <input type="text" class="form-control" id="title" aria-describedby="titleHelp" name="title">
                            </div>

                            <div class="form-group">
                                <label for="ownerCellPhone">Phone Number </label>
                                <input type="text" class="form-control" id="ownerCellPhone" aria-describedby="ownerCellPhoneHelp" name="ownerCellPhone">
                            </div>

                        </div>

                        <div class="col-sm">
                            <div class="form-group">
                                <label for="lastName">Last Name</label>
                                <input type="text" class="form-control" id="lastName" name="lastName">
                            </div>

                            <div class="form-group">
                                <label for="dbaName">DBA<span class="require">*</span></label>
                                <input type="text" class="form-control" id="dbaName" aria-describedby="dbaHelp" name="dbaName">
                            </div>

                            <div class="form-group">
                                <label for="agentEmail">Email</label>
                                <input type="agentEmail" class="form-control" id="agentEmail" aria-describedby="emailHelp" name="agentEmail">
                            </div>

                        </div>
                    </div>&nbsp;&nbsp;

                    <h5><span class="label label-default">Additional Business Information</span></h5>
                    <hr>
                    <div class="row">
                        <div class="col-sm">
                            <div class="form-group">
                                <label for="corporatename">Corporate Name</label>
                                <input type="text" class="form-control" id="corporatename" aria-describedby="corporatenameHelp" name="corporateName">
                            </div>

                            <div class="form-group">
                                <label for="streetaddress">Street Address </label>
                                <input type="text" class="form-control" id="streetAddress" aria-describedby="streetaddressHelp" name="streetAddress">
                            </div>

                            <div class="form-group">
                                <label for="state">State </label>
                                <input type="text" class="form-control" id="state" aria-describedby="stateHelp" name="state">
                            </div>

                            <div class="form-group">
                                <label for="country">Country </label>
                                <input type="text" class="form-control" id="country" aria-describedby="countryHelp" name="country">
                            </div>

                        </div>

                        <div class="col-sm">
                            <div class="form-group">
                                <label for="website">Website:</label>
                                <input type="text" class="form-control" id="website" name="website">
                            </div>

                            <div class="form-group">
                                <label for="city">City</label>
                                <input type="text" class="form-control" id="city" aria-describedby="cityHelp" name="city">
                            </div>

                            <div class="form-group">
                                <label for="zip">ZIP</label>
                                <input type="text" class="form-control" id="zip" aria-describedby="zipHelp" name="zip">
                            </div>

                            <div class="form-group">
                                <label for="fax">Fax:</label>
                                <input type="text" class="form-control" id="fax" aria-describedby="faxHelp" name="fax">
                            </div>

                        </div>
                    </div>&nbsp;&nbsp;

                    <h5><span class="label label-default">Additional Contact Information</span></h5>
                    <hr>
                    <div class="row">
                        <div class="col-sm">
                            <div class="form-group">
                                <label for="add_name">Name:</label>
                                <input type="text" class="form-control" id="add_name" aria-describedby="nameHelp" name="add_name">
                            </div>

                            <div class="form-group">
                                <label for="add_phonenumber">Phone Number:</label>
                                <input type="text" class="form-control" id="add_phonenumber" aria-describedby="add_phonenumberHelp" name="add_phonenumber">
                            </div>

                        </div>

                        <div class="col-sm">
                            <div class="form-group">
                                <label for="add_title">Title:</label>
                                <input type="text" class="form-control" id="add_title" name="add_title">
                            </div>
                        </div>
                    </div>


                </div>
                <div class="modal-footer border-top-0 d-flex justify-content-right">
                    <button type="submit" style="display: none;" id="email_to_merchant" name="email_to_merchant" value="email_to_merchant" class="btn btn-primary"><i class="fa fa-envelope" aria-hidden="true"></i> Email To Merchant</button>
                    <button type="submit" id="continue" name="continue" value="continue" class="btn btn-primary">Save as Lead</button>
                </div>
            </form>
        </div>
    </div>
</div>


<!-- Modal -->
<div class="modal fade" id="updateMerchantKey" tabindex="-1" role="dialog" aria-labelledby="updateMerchantKeyLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header border-bottom-0">
                <h5 class="modal-title" id="updateMerchantKeyLabel">Update Merchant Information</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <?php echo \Config\Services::validation()->listErrors() ?>
            <form action="javascript:void(0)" name="update_merchant_key_form" id="update_merchant_key_form" method="post" accept-charset="utf-8">

                <input type="hidden" name="create_merchant" value=1></input>

                <?= csrf_field() ?>

                <div class="modal-body" style="max-height: calc(100vh - 200px);overflow-y: auto;">
                    <input type="hidden" id="id" name="id">
                    <hr>

                    <div class="row">
                        <div class="col-sm">
                            <div class="form-group">
                                <label for="key">Transaction Api Key <span class="require">*</span> </label>
                                <input type="text" class="form-control" id="key" aria-describedby="keyHelp" name="key">
                            </div>
                            <div class="form-group">
                                <label for="key">Cardknox Account Number <span class="require">*</span> </label>
                                <input type="text" class="form-control" id="mid" aria-describedby="keyHelp" name="mid">
                            </div>
                            <div class="form-group">
                                <label for="key">Merchant Id <span class="require">*</span> </label>
                                <input type="text" class="form-control" id="processormid" aria-describedby="keyHelp" name="processormid">
                            </div>
                        </div>
                    </div>&nbsp;&nbsp;
                </div>
                <div class="modal-footer border-top-0 d-flex justify-content-right">
                    <button type="submit" id="update_merchant_key" name="update_merchant_key" class="btn btn-primary"><i class="fa fa-envelope" aria-hidden="true"></i> Update</button>
                    <button type="submit" id="cancel" name="cancel" value="cancel" class="btn btn-danger" data-dismiss="modal" aria-label="Close">Cancel</button>
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
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>


<script>
    $(document).ready(function() {
        $('#copyButton').on('click', function() {
            // Get the values from the data attributes
            var username = $('#copyButton').data('username');
            var password = $('#copyButton').data('password');

            // Format the string to be copied
            var textToCopy = 'Username: ' + username + ',\nPassword: ' + password;

            // Use the Clipboard API to copy to clipboard
            navigator.clipboard.writeText(textToCopy)
                .then(function() {
                    console.log('Text copied to clipboard:', textToCopy);
                    // alert('Username and password copied to clipboard');
                })
                .catch(function(err) {
                    console.error('Unable to copy text to clipboard:', err);
                });
        });
    });

    new DataTable('#example_merchant', {
        order: false
        // responsive: true
    });

    $(document).on("click", ".shareCredential", function() {
        var username = $(this).data('username');
        var password = $(this).data('password');
        var merchant_id = $(this).data('id');
        $(".modal-body p#username").text(username);
        $(".modal-body p#password").text(password);
        $("#sendlogindetail").attr("data-merchantid", merchant_id);
        $("#generatelogindetail").attr("data-merchantid", merchant_id);
        $("#copyButton").attr("data-username", username);
        $("#copyButton").attr("data-password", password);

    });

    $(document).on("click", ".update_merchant_key", function() {
        $(".modal-body input#id").val('');
        $(".modal-body input#key").val('');
        $(".modal-body input#mid").val('');
        $(".modal-body input#processormid").val('');
        var itemId = $(this).data('id');
        $(".modal-body input#id").val(itemId);
        $(".modal-body input#key").val($(this).data('key'));
        $(".modal-body input#mid").val($(this).data('mid'));
        $(".modal-body input#processormid").val($(this).data('processormid'));

    });


    $(document).on("click", ".generatelogindetail", function() {
        var itemId = $(this).data('merchantid');
        swal({
            title: 'Generate Confirmation',
            text: 'Click to generate new password for this merchant. The previously generated password will become inactive once new password is generated.',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#F44336',
            confirmButtonText: 'Generate',
            cancelButtonText: 'Cancel'
        }).then((Delete) => {
            if (Delete) {

                addOverlay();

                $.ajax({
                    url: "<?= base_url('index.php/generate_logindetail') ?>",
                    type: "POST",
                    data: {
                        merchant_id: itemId
                    },
                    dataType: "json",
                    success: function(response) {

                        if (response.error === true) {

                            errors = response.message;

                            swal({
                                title: "Error!",
                                text: response.message,
                                type: "error",
                            }).then(okay => {
                                if (okay) {
                                    window.location.href = "<?= base_url('index.php/merchant-lists/'); ?>";
                                }
                            });

                        }

                        if (response.success === true) {


                            swal({
                                title: "Success!",
                                text: response.message,
                                type: "success",
                            }).then(okay => {
                                if (okay) {
                                    window.location.href = "<?= base_url('index.php/merchant-lists/'); ?>";
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
    });

    $(document).on("click", ".sendlogindetail", function() {
        var itemId = $(this).data('merchantid');
        swal({
            title: 'Send Login Credentials',
            text: 'Are you sure you want to send merchant login details?',
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
                    url: "<?= base_url('index.php/send_logindetail') ?>",
                    type: "POST",
                    data: {
                        merchant_id: itemId,
                    },
                    dataType: "json",
                    success: function(response) {
                        if (response.error === true) {
                            errors = response.message;
                            swal({
                                title: "Error!",
                                text: 'email not send',
                                type: "error"
                            }).then(okay => {
                                if (okay) {
                                    window.location.href = "<?= base_url('index.php/merchant-lists/'); ?>";
                                }
                            });
                        }
                        if (response.success === true) {
                            swal({
                                title: "Success!",
                                text: response.message,
                                type: "success"
                            }).then(okay => {
                                if (okay) {
                                    window.location.href = "<?= base_url('index.php/merchant-lists/'); ?>";
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

    });

    function sendlogindetail(itemId) {
        swal({
            title: 'Send Login Credentials',
            text: 'Are you sure you want to send merchant login details?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#F44336',
            confirmButtonText: 'Yes, send it!',
            cancelButtonText: 'Cancel'
        }).then((Delete) => {
            if (Delete) {
                addOverlay();
                $.ajax({
                    url: "<?= base_url('index.php/send_logindetail') ?>",
                    type: "POST",
                    data: {
                        merchant_id: itemId
                    },
                    dataType: "json",
                    success: function(response) {
                        if (response.error === true) {
                            errors = response.message;
                            swal({
                                title: "Error!",
                                text: 'email not send',
                                type: "error"
                            }).then(okay => {
                                if (okay) {
                                    window.location.href = "<?= base_url('index.php/merchant-lists/'); ?>";
                                }
                            });
                        }
                        if (response.success === true) {
                            swal({
                                title: "Success!",
                                text: response.message,
                                type: "success"
                            }).then(okay => {
                                if (okay) {
                                    window.location.href = "<?= base_url('index.php/merchant-lists/'); ?>";
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
</script>

<script src="<?= base_url('public/assets/js/jquery.validate.js'); ?>"></script>
<script src="<?= base_url('public/assets/js/additional-methods.min.js'); ?>"></script>
<script src="<?= base_url('public/assets/js/sweetalert2.min.js'); ?>"></script>

<script>
    if ($("#create_merchant_lead_form").length > 0) {
        $("#create_merchant_lead_form").validate({

            rules: {
                dbaName: {
                    required: true
                },
            },
            messages: {
                dbaName: {
                    required: "DBA is required",
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
                            url: "<?= base_url('index.php/addmerchant') ?>",
                            type: "POST",
                            data: $('#create_merchant_lead_form').serialize(),
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
                                        position: "top-end",
                                        icon: "success",
                                        title: response.message,
                                        showConfirmButton: false,
                                        timer: 2000
                                    });
                                    window.location.href = "<?= base_url('index.php/leads/') ?>";
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

    $.validator.addMethod("nospaces", function(value, element) {
        return value.indexOf('  ') === -1; // Check for double spaces
    }, "Double spaces are not allowed");

    if ($("#update_merchant_key_form").length > 0) {

        $("#update_merchant_key_form").validate({

            rules: {
                key: {
                    required: true,
                },
                mid: {
                    required: true,
                    nospaces: true,
                    minlength: 5,
                    maxlength: 5,
                    digits: true
                },
                processormid: {
                    required: true,
                    nospaces: true,
                    minlength: 12,
                    maxlength: 12,
                    digits: true
                },
            },
            messages: {
                key: {
                    required: "Transaction API Key is required.",
                },
                mid: {
                    required: "Cardknox account number is required",
                    minlength: "The minimum length for the Cardknox account number should be 5 characters.",
                    maxlength: "The Cardknox account number cannot exceed 5 characters.",
                },
                processormid: {
                    required: "Merchant ID is required",
                    minlength: "The minimum length for the merchant ID should be 12 characters.",
                    maxlength: "The merchant ID cannot exceed 12 characters.",
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
                            url: "<?= base_url('index.php/update_merchant_key') ?>",
                            type: "POST",
                            data: $('#update_merchant_key_form').serialize(),
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
                                            window.location.href = "<?= base_url('index.php/merchant-lists/'); ?>";
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