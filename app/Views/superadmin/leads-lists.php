<?= view('template/header') ?>

<?= view('template/sidebar') ?>


<!-- Main -->
<div class="l--main ">
    <div id="topOfPage"><span></span>
        <div class="l--content--grid">
            <div></div>
            <div class="">

                <header class="header header--grid d-flex justify-content-between align-items-center page_header">
                    <h5 class="header__title">
                        Leads Listing
                        <?= validation_list_errors() ?>
                    </h5>
                    <button type="button" class="btn btn-primary btn-xs float-sm-right " data-toggle="modal" data-target="#createMerchant">
                        <i class="fa fa-plus-circle">
                        </i>
                        Add Leads
                    </button>
                </header>


                <div class="table-responsive">
                    <table id="example_leads" class="table table-striped table-bordered nowrap" style="width:100%">
                        <thead>
                            <tr>
                                <th style="width: 50%;">Merchant name</th>
                                <th>First Name</th>
                                <th>Last Name</th>
                                <th>Title</th>
                                <th style="width: 30%;">Email</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $n = 1;
                            foreach ($leads as $row) { ?>
                                <tr>
                                    <td data-name="Merchant name"><?= $row['dba']; ?></td>
                                    <td class="mtdcol-6" data-name="First Name"><?= $row['firstname']; ?></td>
                                    <td class="mtdcol-6" data-name="Last Name"><?= $row['lastname']; ?></td>
                                    <td data-name="Title"><?= $row['title']; ?></td>

                                    <td data-name="Email"><?= $row['email']; ?></td>
                                    <td data-name="Status"><?= ($row['status'] == 0 ? 'New Lead' : 'test'); ?></td>
                                    <td>
                                        <button type="button" data-id="<?= $row['id']; ?>" data-email="<?= $row['email']; ?>" class="btn <?= ($row['mpa_form_email'] == 0 ? 'btn-success' : 'btn-warning'); ?> btn-sm float-sm sendformtoMerchantId" data-dbaname="<?= $row['dba']; ?>" data-toggle="modal" data-target="#sendformtoMerchant">
                                            <i class="far fa-envelope"> <?= ($row['mpa_form_email'] == 0 ? 'Send Application' : 'Resend Application'); ?> </i></button>

                                        <button type="button" onclick="deleteleads('<?= $row['id']; ?>')" class="btn btn-danger btn-sm" data-toggle="tooltip" data-placement="top" title="Delete Lead"><i class="far fa-trash-alt"></i> <span class="mbtntxt">Delete</span></button>

                                        <button type="button" data-merchantid="<?= $row['id']; ?>" class="btn <?= ($row['mpa_form_email'] == 0 ? 'btn-primary' : 'btn-primary'); ?> btn-sm float-sm updateformtoMerchantId" data-toggle="modal" data-target="#createMerchant" data-toggle="tooltip" data-placement="top" title="Edit Lead">
                                            <i class="fa fa-pencil-alt"></i> <span class="mbtntxt">Edit</span></button>
                                    </td>
                                </tr>
                            <?php $n++;
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
<div class="modal fade" id="updateformtoMerchant" tabindex="-1" role="dialog" aria-labelledby="updateformtoMerchantLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header border-bottom-0">
                <h5 class="modal-title" id="updateformtoMerchantLabel">Update Lead Email</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <?php echo \Config\Services::validation()->listErrors() ?>
            <form action="javascript:void(0)" name="update_merchant_lead_form" id="update_merchant_lead_form" method="post" accept-charset="utf-8">

                <input type="hidden" name="create_merchant" value=1></input>

                <?= csrf_field() ?>

                <div class="modal-body" style="max-height: calc(100vh - 200px);overflow-y: auto;">
                    <input type="hidden" id="dba_name" name="dba_name">
                    <input type="hidden" id="id" name="id">

                    <div class="row">
                        <div class="col-sm">
                            <div class="form-group">
                                <label for="email">Lead Email <span class="require">*</span> </label>
                                <input type="email" class="form-control" id="update_email" aria-describedby="emailHelp" name="email">
                                <span id="updateemailError" class="error-message" style="color: red;"></span>
                            </div>

                        </div>
                    </div>&nbsp;&nbsp;
                </div>
                <div class="modal-footer border-top-0 d-flex justify-content-right">
                    <button type="submit" id="email_to_merchant_form" name="email_to_merchant_form" value="email_to_merchant_form" class="btn btn-primary">Update</button>
                    <button type="submit" id="cancel" name="cancel" value="cancel" class="btn btn-danger" data-dismiss="modal" aria-label="Close">Cancel</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="sendformtoMerchant" tabindex="-1" role="dialog" aria-labelledby="sendformtoMerchantLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header border-bottom-0">
                <h5 class="modal-title" id="sendformtoMerchantLabel">Send Application to Merchant</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <?php echo \Config\Services::validation()->listErrors() ?>
            <form action="javascript:void(0)" name="send_merchant_lead_form" id="send_merchant_lead_form" method="post" accept-charset="utf-8">

                <input type="hidden" name="create_merchant" value=1></input>

                <?= csrf_field() ?>

                <div class="modal-body" style="max-height: calc(100vh - 200px);overflow-y: auto;">
                    <input type="hidden" id="dba_name" name="dba_name">
                    <input type="hidden" id="id" name="id">

                    <span class="font-weight-bold">Click the 'send' button to send the Application link to the merchant via the email below.</span>
                    <hr>

                    <div class="row">
                        <div class="col-sm">
                            <div class="form-group">
                                <label for="email">Merchant Email <span class="require">*</span> </label>
                                <input type="text" class="form-control" id="email" aria-describedby="emailHelp" name="email">
                            </div>

                        </div>
                    </div>&nbsp;&nbsp;
                </div>
                <div class="modal-footer border-top-0 d-flex justify-content-right">
                    <button type="submit" id="email_to_merchant_form" name="email_to_merchant_form" value="email_to_merchant_form" class="btn btn-primary"><i class="fa fa-envelope" aria-hidden="true"></i> Send</button>
                    <button type="submit" id="cancel" name="cancel" value="cancel" class="btn btn-danger" data-dismiss="modal" aria-label="Close">Cancel</button>
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
                <input type="hidden" id="merchant_id" name="merchant_id" value="0">

                <?= csrf_field() ?>

                <div class="modal-body" style="max-height: calc(100vh - 200px);overflow-y: auto;">
                    <h5><span class="label label-default">General Information</span></h5>
                    <hr>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="firstname">First Name<span class="require">*</span></label>
                                <input type="text" class="form-control" id="firstName" aria-describedby="firstnameHelp" name="firstName">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="lastName">Last Name<span class="require">*</span></label>
                                <input type="text" class="form-control" id="lastName" name="lastName">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="title">Title<span class="require">*</span></label>
                                <input type="text" class="form-control" id="title" aria-describedby="titleHelp" name="title">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="dbaName">Merchant Name or DBA<span class="require">*</span></label>
                                <input type="text" class="form-control" id="dbaName" aria-describedby="dbaHelp" name="dbaName">
                            </div>
                        </div>
                        <div class="col-md-6">

                            <div class="form-group">
                                <label for="ownerCellPhone">Phone Number<span class="require">*</span></label>
                                <input type="text" class="form-control" id="ownerCellPhone" data-inputmask-inputformat="999-999-9999" aria-describedby="ownerCellPhoneHelp" name="ownerCellPhone">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="agentEmail">Email<span class="require">*</span></label>
                                <input type="text" class="form-control" id="agentEmail" aria-describedby="emailHelp" name="agentEmail">
                                <span id="emailError" class="error-message" style="color: red;"></span>
                            </div>
                        </div>


                    </div>
                    <h5><span class="label label-default">Additional Business Information</span></h5>
                    <hr>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="corporatename">Formal Business Name</label>
                                <input type="text" class="form-control" id="corporatename" aria-describedby="corporatenameHelp" name="corporateName">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="website">Website:</label>
                                <input type="text" class="form-control" id="website" name="website">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="streetaddress">Street Address </label>
                                <input type="text" class="form-control" id="streetAddress" aria-describedby="streetaddressHelp" name="streetAddress">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="city">City</label>
                                <input type="text" class="form-control" id="city" aria-describedby="cityHelp" name="city">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="state">State </label>
                                <select id="state" name="state" class="input input--med input--select ">
                                    <option value="">Please Select</option>
                                    <option value="NJ">New Jersey</option>
                                    <option value="NY">New York</option>
                                    <option value="AL">Alabama</option>
                                    <option value="AK">Alaska</option>
                                    <option value="AZ">Arizona</option>
                                    <option value="AR">Arkansas</option>
                                    <option value="CA">California</option>
                                    <option value="CO">Colorado</option>
                                    <option value="CT">Connecticut</option>
                                    <option value="DE">Delaware</option>
                                    <option value="DC">District Of Columbia</option>
                                    <option value="FL">Florida</option>
                                    <option value="GA">Georgia</option>
                                    <option value="HI">Hawaii</option>
                                    <option value="ID">Idaho</option>
                                    <option value="IL">Illinois</option>
                                    <option value="IN">Indiana</option>
                                    <option value="IA">Iowa</option>
                                    <option value="KS">Kansas</option>
                                    <option value="KY">Kentucky</option>
                                    <option value="LA">Louisiana</option>
                                    <option value="ME">Maine</option>
                                    <option value="MD">Maryland</option>
                                    <option value="MA">Massachusetts</option>
                                    <option value="MI">Michigan</option>
                                    <option value="MN">Minnesota</option>
                                    <option value="MS">Mississippi</option>
                                    <option value="MO">Missouri</option>
                                    <option value="MT">Montana</option>
                                    <option value="NE">Nebraska</option>
                                    <option value="NV">Nevada</option>
                                    <option value="NH">New Hampshire</option>
                                    <option value="NJ">New Jersey</option>
                                    <option value="NM">New Mexico</option>
                                    <option value="NY">New York</option>
                                    <option value="NC">North Carolina</option>
                                    <option value="ND">North Dakota</option>
                                    <option value="OH">Ohio</option>
                                    <option value="OK">Oklahoma</option>
                                    <option value="OR">Oregon</option>
                                    <option value="PA">Pennsylvania</option>
                                    <option value="RI">Rhode Island</option>
                                    <option value="SC">South Carolina</option>
                                    <option value="SD">South Dakota</option>
                                    <option value="TN">Tennessee</option>
                                    <option value="TX">Texas</option>
                                    <option value="UT">Utah</option>
                                    <option value="VT">Vermont</option>
                                    <option value="VA">Virginia</option>
                                    <option value="WA">Washington</option>
                                    <option value="WV">West Virginia</option>
                                    <option value="WI">Wisconsin</option>
                                    <option value="WY">Wyoming</option>
                                </select>

                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="zip">Postal Code</label>
                                <input type="text" class="form-control" id="zip" aria-describedby="zipHelp" name="zip">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="country">Country </label>
                                <input type="text" class="form-control" readonly id="country" value="United States" aria-describedby="countryHelp" name="country">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="fax">Fax:</label>
                                <input type="text" class="form-control" id="fax" aria-describedby="faxHelp" name="fax">
                            </div>
                        </div>

                    </div>
                    <!-- <h5><span class="label label-default">Additional Contact Information</span></h5>
                    <hr>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="add_name">Name:</label>
                                <input type="text" class="form-control" id="add_name" aria-describedby="nameHelp" name="add_name">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="add_title">Title:</label>
                                <input type="text" class="form-control" id="add_title" name="add_title">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="add_phonenumber">Phone Number:</label>
                                <div class="input-group mb-3 form-group">
                                    <span class="input-group-text">+1</span>
                                    <input type="text" class="form-control" data-inputmask-inputformat="999-999-9999" id="add_phonenumber" aria-describedby="add_phonenumberHelp" name="add_phonenumber">
                                </div>
                            </div>
                        </div>
                    </div> -->
                </div>
                <div class="modal-footer border-top-0 d-flex justify-content-right">
                    <button type="submit" style="display: none;" id="email_to_merchant" name="email_to_merchant" value="email_to_merchant" class="btn btn-primary"><i class="fa fa-envelope" aria-hidden="true"></i> Email To Merchant</button>
                    <button type="submit" id="continue" name="continue" value="continue" class="btn btn-primary">Save</button>
                    <button type="submit" id="cancel" name="cancel" value="cancel" class="btn btn-danger" data-dismiss="modal" aria-label="Close">Cancel</button>
                </div>
            </form>
        </div>
    </div>
</div>




<?= view('template/footer') ?>
<script src='<?= base_url('/public/assets/js/jquery.inputmask.js') ?>'></script>
<script>
    new DataTable('#example_leads', {
        order: false
        // responsive: true
    });

    $(document).ready(function() {

        //$('#ownerCellPhone').inputmask("999-999-9999",{greedy: false});

        $('#createMerchant').on('hide.bs.modal', function() {
            $("#createMerchantLabel").text('New Lead');
            var form = $(this).find('form');
            form[0].reset(); // Reset the form
            form.validate().resetForm(); // Reset the validation messages
            $("#merchant_id").val(0);
        });
    });
</script>

<script>
    function deleteleads(itemId) {

        swal({
            title: 'Delete Confirmation',
            text: 'Are you sure you want to delete this lead?',
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
                    url: "<?= base_url('index.php/delete-leads/') ?>" + itemId,
                    type: "POST",
                    dataType: "json",
                    success: function(response) {

                        if (response.error === true) {

                            errors = response.message;

                            swal({
                                title: "Error!",
                                text: response.message,
                                type: "error"
                            }).then(okay => {
                                if (okay) {
                                    window.location.href = "<?= base_url('index.php/leads/'); ?>";
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
                                    window.location.href = "<?= base_url('index.php/leads/'); ?>";
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

    $(document).on("click", ".updateformtoMerchantId", function() {
        $(".modal-body input#email").prop('readonly', false);
    });

    $(document).on("click", ".sendformtoMerchantId", function() {
        var dbaname = $(this).data('dbaname');
        var email = $(this).data('email');
        var merchant_id = $(this).data('id');

        $(".modal-body input#dba_name").val(dbaname);
        $(".modal-body input#email").val(email);
        $(".modal-body input#email").prop('readonly', true);
        $(".modal-body input#id").val(merchant_id);
    });

    $(document).on("click", ".updateformtoMerchantId", function() {
        $("#createMerchantLabel").text('Update Lead');
        var merchant_id = $(this).data('merchantid');
        $("#merchant_id").val(merchant_id);

        $.ajax({
            url: "<?= base_url('index.php/lead/') ?>" + merchant_id,
            type: "GET",
            async: false,
            dataType: "json",
            success: function(response) {
                $(".modal-body input#firstName").val(response.firstname);
                $(".modal-body input#lastName").val(response.lastname);
                $(".modal-body input#title").val(response.title);
                $(".modal-body input#dbaName").val(response.dba);
                $(".modal-body input#ownerCellPhone").val(response.phone_number);
                $(".modal-body input#agentEmail").val(response.email);
                $(".modal-body input#corporatename").val(response.corporate_name);
                $(".modal-body input#website").val(response.website);
                $(".modal-body input#streetAddress").val(response.street_address);
                $(".modal-body input#city").val(response.city);
                $(".modal-body select#state").val(response.state).change();
                $(".modal-body input#zip").val(response.zip);
                $(".modal-body input#fax").val(response.fax);
            }
        });
    });
</script>

<script src="<?= base_url('public/assets/js/jquery.validate.js'); ?>"></script>
<script src="<?= base_url('public/assets/js/additional-methods.min.js'); ?>"></script>
<script src="<?= base_url('public/assets/js/sweetalert2.min.js'); ?>"></script>

<script>
    //$('#add_phonenumber').inputmask("999-999-9999");

    $.validator.addMethod("nospaces", function(value, element) {
        return value.indexOf('  ') === -1; // Check for double spaces
    }, "Double spaces are not allowed");

    $.validator.addMethod("nosinglespaces", function(value, element) {
        return value.indexOf(' ') === -1; // Check for double spaces
    }, "Double spaces are not allowed");

    if ($("#create_merchant_lead_form").length > 0) {
        $("#create_merchant_lead_form").validate({

            rules: {
                agentEmail: {
                    required: true,
                    nosinglespaces: true,
                    email: true,
                    remote: {
                        url: '<?= site_url('checkEmail') ?>',
                        type: "post",
                        data: {
                            email: function() {
                                return $("#agentEmail").val();
                            },
                            lead_id: function() {
                                return $("#merchant_id").val();
                            },
                        }
                    }
                },
                firstName: {
                    required: true,
                    nospaces: true
                },
                corporateName: {
                    nospaces: true
                },
                title: {
                    required: true,
                    nospaces: true
                },
                lastName: {
                    required: true,
                    nospaces: true
                },
                ownerCellPhone: {
                    required: true,
                    number: true,
                    nospaces: true,
                    minlength: 10,
                    maxlength: 14
                },
                add_phonenumber: {
                    nowhitespace: true,
                    number: true,
                    minlength: 10,
                    maxlength: 14
                },
                website: {
                    nowhitespace: true,
                    nospaces: true // Custom rule to disallow whitespace
                },
                dbaName: {
                    required: true,
                    nospaces: true
                },

            },
            messages: {
                agentEmail: {
                    remote: "Email already exists"
                },
                ownerCellPhone: {
                    number: 'Allow number only',
                    minlength: 'Enter at least 10 digits minimum number',
                    maxlength: 'Not allow more than 14 didgits',
                },
                add_phonenumber: {
                    number: 'Allow number only',
                    minlength: 'Enter at least 10 digits minimum number',
                    maxlength: 'Not allow more than 14 didgits',
                },
                website: {
                    nowhitespace: "Website cannot contain consecutive blank spaces",
                },
            },
            errorPlacement: function(error, element) {
                if (element.hasClass("form-control")) {
                    error.insertAfter(element.parent()); // Adjust error placement for input-group
                } else {
                    error.insertAfter(element);
                }
            },
            submitHandler: function(form) {

                // if ($('#emailError').text() !== '') {
                //     form.preventDefault(); // Prevent form submission if there's an error
                // }
                let msg = 'Are you sure you want to add this lead?';
                if ($("#merchant_id").val() != 0) {
                    msg = 'Are you sure you want to update this lead?';
                }
                swal({
                    title: 'Save Confirmation',
                    text: msg,
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
                            url: "<?= base_url('index.php/addmerchant') ?>",
                            type: "POST",
                            data: $('#create_merchant_lead_form').serialize(),
                            async: false,
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
                                        type: "success",
                                    }).then(okay => {
                                        if (okay) {
                                            window.location.href = "<?= base_url('index.php/leads/'); ?>";
                                        }
                                    });

                                }

                            },
                            error: function() {
                                // Handle error if needed
                                callback(false);
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


    if ($("#send_merchant_lead_form").length > 0) {

        $("#send_merchant_lead_form").validate({

            rules: {
                email: {
                    required: true,
                    email: true
                },
            },
            messages: {
                email: {
                    required: "email is required",
                },
            },
            submitHandler: function(form) {

                swal({
                    title: 'Send Email Confirmation',
                    text: 'Are you sure you want to send merchant registration form?',
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
                            url: "<?= base_url('index.php/send_form_to_merchant') ?>",
                            type: "POST",
                            data: $('#send_merchant_lead_form').serialize(),
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
                                            window.location.href = "<?= base_url('index.php/leads/'); ?>";
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


    if ($("#update_merchant_lead_form").length > 0) {

        $("#update_merchant_lead_form").validate({

            rules: {
                email: {
                    required: true,
                    email: true,
                    nosinglespaces: true,
                    remote: {
                        url: '<?= site_url('checkEmail') ?>',
                        type: "post",
                        data: {
                            email: function() {
                                return $("#update_email").val();
                            },
                            lead_id: function() {
                                return $("#id").val();
                            },
                        }
                    },

                },
            },
            messages: {
                email: {
                    required: "email is required",
                    remote: "Email already exists"
                },
            },
            submitHandler: function(form) {

                if ($('#updateemailError').text() !== '') {
                    form.preventDefault(); // Prevent form submission if there's an error
                }

                swal({
                    title: 'Update Confirmation',
                    text: 'Are you sure you want to update?',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#F44336',
                    confirmButtonText: 'Update',
                    cancelButtonText: 'Cancel'
                }).then((result) => {
                    if (result) {

                        addOverlay();

                        $.ajax({
                            url: "<?= base_url('index.php/update_form_to_merchant') ?>",
                            type: "POST",
                            data: $('#update_merchant_lead_form').serialize(),
                            dataType: "json",
                            success: function(response) {

                                if (response.error === true) {

                                    errors = response.message;

                                    // swal({
                                    //     position: "top-end",
                                    //     icon: "error",
                                    //     title: response.message,
                                    //     showConfirmButton: false,
                                    //     timer: 2000
                                    // });

                                    swal({
                                        title: "Error!",
                                        text: response.message,
                                        type: "error",
                                        timer: 2000
                                    });

                                }

                                if (response.success === true) {

                                    // swal({
                                    //     position: "top-end",
                                    //     icon: "success",
                                    //     title: response.message,
                                    //     showConfirmButton: false,
                                    //     timer: 2000
                                    // });

                                    swal({
                                        title: "Success!",
                                        text: response.message,
                                        type: "success",
                                    }).then(okay => {
                                        if (okay) {
                                            window.location.href = "<?= base_url('index.php/leads/'); ?>";
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