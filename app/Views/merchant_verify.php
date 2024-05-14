<?= view('template/header') ?>

<script src=https://cdn.cardknox.com/ifields/2.15.2309.2601/ifields.min.js></script>

<script src='<?= base_url('/public/assets/js/jquery.inputmask.js') ?>'></script>

<div class="main-div mrform" id="mrform">

    <div class="mrform_head">
        <img src="<?= base_url() ?>/public/assets/images/payme-logo.png" alt="Company Logo" class="mrLogo">
    </div>

    <!-- Title -->
    <h2 class="text-center mb-2">Merchant Registration Form</h2>
    <div class="disTxt">Disclaimer: This application is provided through Fidelity Financial Services and uses strict security protocols to ensure the safety of the applicant's personal and business financial information. PayMe.Limo and its affiliates do not store and are unable to view banking or personal information provided herein.</div>

    <div class="printBtn">Print form<button class="btn" onclick="printForm()"><i class="icon icon--xsml icon--print align--v--middle"></i></button></div>


    <form action="javascript:void(0)" name="create_merchant_lead_form" id="create_merchant_lead_form" method="post" accept-charset="utf-8">

        <input type="hidden" name="create_merchant" value=1></input>
        <input type="hidden" name="token" id="token" value></input>

        <?= csrf_field() ?>

        <div class="modal-body">

            <div class="formContain ">
                <h5><span class="label label-default">Business Information</span></h5>
                <div class="row ">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="corporateName">Corporate Name <span class="require">*</span></label>
                            <input type="text" class="form-control" id="corporateName" aria-describedby="corporateNameHelp" name="corporateName" value="<?= ($dba_data->corporate_name ? $dba_data->corporate_name : $dba_data->dba); ?>">
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="dba">DBA<span class="require">*</span></label>
                            <input type="text" class="form-control" id="dba" name="dba" value="<?= $dba_data->dba; ?>">
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="businessPhone">Business Phone Number <span class="require">*</span></label>
                            <input type="text" class="form-control" data-inputmask-inputformat="999-999-9999" id="businessPhone" aria-describedby="businessPhoneHelp" name="businessPhone" value="<?= $dba_data->phone_number; ?>">
                            <small style="color:#495057">(Ex:800-555-1212)</small>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="businessEmail">Business Email<span class="require">*</span></label>
                            <input type="text" class="form-control" id="businessEmail" aria-describedby="dbaHelp" name="businessEmail" value="<?= $dba_data->email; ?>">
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="businessAddress_streetAddress">Business Address <span class="require">*</span></label>
                            <input type="text" class="form-control" id="businessAddress_streetAddress" aria-describedby="businessAddress_streetAddressHelp" name="businessAddress_streetAddress" value="<?= $dba_data->street_address; ?>">
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="businessAddress_city">City<span class="require">*</span></label>
                            <input type="text" class="form-control" id="businessAddress_city" aria-describedby="emailHelp" name="businessAddress_city" value="<?= $dba_data->city; ?>">
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="businessAddress_state">State<span class="require">*</span></label>
                            <select id="businessAddress_state" name="businessAddress_state" class="input input--med input--select ">
                                <option value="">Please Select</option>
                                <option value="NJ" <?= ($dba_data->state == 'NJ' ? 'selected' : '') ?>>New Jersey</option>
                                <option value="NY" <?= ($dba_data->state == 'NY' ? 'selected' : '') ?>>New York</option>
                                <option value="AL" <?= ($dba_data->state == 'AL' ? 'selected' : '') ?>>Alabama</option>
                                <option value="AK" <?= ($dba_data->state == 'AK' ? 'selected' : '') ?>>Alaska</option>
                                <option value="AZ" <?= ($dba_data->state == 'AZ' ? 'selected' : '') ?>>Arizona</option>
                                <option value="AR" <?= ($dba_data->state == 'AR' ? 'selected' : '') ?>>Arkansas</option>
                                <option value="CA" <?= ($dba_data->state == 'CA' ? 'selected' : '') ?>>California</option>
                                <option value="CO" <?= ($dba_data->state == 'CO' ? 'selected' : '') ?>>Colorado</option>
                                <option value="CT" <?= ($dba_data->state == 'CT' ? 'selected' : '') ?>>Connecticut</option>
                                <option value="DE" <?= ($dba_data->state == 'DE' ? 'selected' : '') ?>>Delaware</option>
                                <option value="DC" <?= ($dba_data->state == 'DC' ? 'selected' : '') ?>>District Of Columbia</option>
                                <option value="FL" <?= ($dba_data->state == 'FL' ? 'selected' : '') ?>>Florida</option>
                                <option value="GA" <?= ($dba_data->state == 'GA' ? 'selected' : '') ?>>Georgia</option>
                                <option value="HI" <?= ($dba_data->state == 'HI' ? 'selected' : '') ?>>Hawaii</option>
                                <option value="ID" <?= ($dba_data->state == 'ID' ? 'selected' : '') ?>>Idaho</option>
                                <option value="IL" <?= ($dba_data->state == 'IL' ? 'selected' : '') ?>>Illinois</option>
                                <option value="IN" <?= ($dba_data->state == 'IN' ? 'selected' : '') ?>>Indiana</option>
                                <option value="IA" <?= ($dba_data->state == 'IA' ? 'selected' : '') ?>>Iowa</option>
                                <option value="KS" <?= ($dba_data->state == 'KS' ? 'selected' : '') ?>>Kansas</option>
                                <option value="KY" <?= ($dba_data->state == 'KY' ? 'selected' : '') ?>>Kentucky</option>
                                <option value="LA" <?= ($dba_data->state == 'LA' ? 'selected' : '') ?>>Louisiana</option>
                                <option value="ME" <?= ($dba_data->state == 'ME' ? 'selected' : '') ?>>Maine</option>
                                <option value="MD" <?= ($dba_data->state == 'MD' ? 'selected' : '') ?>>Maryland</option>
                                <option value="MA" <?= ($dba_data->state == 'MA' ? 'selected' : '') ?>>Massachusetts</option>
                                <option value="MI" <?= ($dba_data->state == 'MI' ? 'selected' : '') ?>>Michigan</option>
                                <option value="MN" <?= ($dba_data->state == 'MN' ? 'selected' : '') ?>>Minnesota</option>
                                <option value="MS" <?= ($dba_data->state == 'MS' ? 'selected' : '') ?>>Mississippi</option>
                                <option value="MO" <?= ($dba_data->state == 'MO' ? 'selected' : '') ?>>Missouri</option>
                                <option value="MT" <?= ($dba_data->state == 'MT' ? 'selected' : '') ?>>Montana</option>
                                <option value="NE" <?= ($dba_data->state == 'NE' ? 'selected' : '') ?>>Nebraska</option>
                                <option value="NV" <?= ($dba_data->state == 'NV' ? 'selected' : '') ?>>Nevada</option>
                                <option value="NH" <?= ($dba_data->state == 'NH' ? 'selected' : '') ?>>New Hampshire</option>
                                <option value="NJ" <?= ($dba_data->state == 'NJ' ? 'selected' : '') ?>>New Jersey</option>
                                <option value="NM" <?= ($dba_data->state == 'NM' ? 'selected' : '') ?>>New Mexico</option>
                                <option value="NY" <?= ($dba_data->state == 'NY' ? 'selected' : '') ?>>New York</option>
                                <option value="NC" <?= ($dba_data->state == 'NC' ? 'selected' : '') ?>>North Carolina</option>
                                <option value="ND" <?= ($dba_data->state == 'ND' ? 'selected' : '') ?>>North Dakota</option>
                                <option value="OH" <?= ($dba_data->state == 'OH' ? 'selected' : '') ?>>Ohio</option>
                                <option value="OK" <?= ($dba_data->state == 'OK' ? 'selected' : '') ?>>Oklahoma</option>
                                <option value="OR" <?= ($dba_data->state == 'OR' ? 'selected' : '') ?>>Oregon</option>
                                <option value="PA" <?= ($dba_data->state == 'PA' ? 'selected' : '') ?>>Pennsylvania</option>
                                <option value="RI" <?= ($dba_data->state == 'RI' ? 'selected' : '') ?>>Rhode Island</option>
                                <option value="SC" <?= ($dba_data->state == 'SC' ? 'selected' : '') ?>>South Carolina</option>
                                <option value="SD" <?= ($dba_data->state == 'SD' ? 'selected' : '') ?>>South Dakota</option>
                                <option value="TN" <?= ($dba_data->state == 'TN' ? 'selected' : '') ?>>Tennessee</option>
                                <option value="TX" <?= ($dba_data->state == 'TX' ? 'selected' : '') ?>>Texas</option>
                                <option value="UT" <?= ($dba_data->state == 'UT' ? 'selected' : '') ?>>Utah</option>
                                <option value="VT" <?= ($dba_data->state == 'VT' ? 'selected' : '') ?>>Vermont</option>
                                <option value="VA" <?= ($dba_data->state == 'VA' ? 'selected' : '') ?>>Virginia</option>
                                <option value="WA" <?= ($dba_data->state == 'WA' ? 'selected' : '') ?>>Washington</option>
                                <option value="WV" <?= ($dba_data->state == 'WV' ? 'selected' : '') ?>>West Virginia</option>
                                <option value="WI" <?= ($dba_data->state == 'WI' ? 'selected' : '') ?>>Wisconsin</option>
                                <option value="WY" <?= ($dba_data->state == 'WY' ? 'selected' : '') ?>>Wyoming</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="businessAddress_zip">Postal Code<span class="require">*</span></label>
                            <input type="text" class="form-control" id="businessAddress_zip" aria-describedby="emailHelp" name="businessAddress_zip" value="<?= $dba_data->zip; ?>">
                            <small style="color:#495057">(Ex:12345)</small>
                        </div>
                    </div>
                </div>
            </div>
            <div class="formContain ">
                <h5><span class="label label-default">Banking Information</span></h5>
                <div class="row ">
                    <div class="col-sm-6">
                        <!-- <div class="form-group">
                            <label for="goodsOrServicesDescription">Goods/Services Sold<span class="require">*</span></label>
                            <input type="text" class="form-control" id="goodsOrServicesDescription" aria-describedby="goodsOrServicesDescriptionHelp" name="goodsOrServicesDescription">
                        </div> -->
                        <div class="form-group">
                            <label for="bankName">Bank Name<span class="require">*</span></label>
                            <input type="text" class="form-control" id="bankName" aria-describedby="bankNameHelp" name="bankName">
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="taxID">TaxID or EIN<span class="require">*</span></label>
                            <input type="text" class="form-control" id="taxID" aria-describedby="dbaHelp" name="taxID">
                            <small style="color:#495057">(Ex:123456789)</small>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="routingNumber">Bank Routing Number#<span class="require">*</span></label>
                            <input type="text" class="form-control" id="routingNumber" aria-describedby="routingNumberHelp" name="routingNumber">
                            <small style="color:#495057">(Ex:121122676)</small>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="accountNumber">Bank Account Number#<span class="require">*</span></label>
                            <input type="password" class="form-control" pattern="[0-9]{6,17}" id="accountNumber" name="accountNumber">
                            <small style="color:#495057">(Ex:898989898989)</small>
                        </div>
                    </div>
                </div>
            </div>

            <div class="formContain mb-0">
                <h5><span class="label label-default">Signer Information</span></h5>
                <div class="row ">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="firstName">Signer First Name:<span class="require">*</span></label>
                            <input type="text" class="form-control" id="firstName" aria-describedby="nameHelp" name="firstName" value="<?= $dba_data->firstname; ?>">
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="lastName">Signer Last Name<span class="require">*</span></label>
                            <input type="text" class="form-control" id="lastName" name="lastName" value="<?= $dba_data->lastname; ?>">
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="font-weight-bold mb-3">
                            <input type="checkbox" class="mr-1" id="sameAsAbove">
                            <label class="form-check-label" for="sameAsAbove">Same as Business Address</label>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="address_streetAddress">Signer Home Address<span class="require">*</span></label>
                            <input type="text" class="form-control" id="address_streetAddress" aria-describedby="address_streetAddressHelp" name="address_streetAddress">
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="address_city">City<span class="require">*</span></label>
                            <input type="text" class="form-control" id="address_city" name="address_city">
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="address_state">State<span class="require">*</span></label>
                            <select id="address_state" name="address_state" class="input input--med input--select ">
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
                            <label for="address_zip">ZIP<span class="require">*</span></label>
                            <input type="text" class="form-control" id="address_zip" name="address_zip">
                            <small style="color:#495057">(Ex.12345)</small>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="phoneNumber">Phone Number<span class="require">*</span></label>
                            <input type="text" class="form-control" data-inputmask-inputformat="999-999-9999" id="phoneNumber" aria-describedby="phoneNumberHelp" name="phoneNumber" value="<?= $dba_data->add_contact_phonenumber; ?>">
                            <small style="color:#495057">(Ex:800-555-1212)</small>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="cellPhoneNumber">Signer Cell Number<span class="require">*</span></label>
                            <input type="text" class="form-control" id="cellPhoneNumber" name="cellPhoneNumber" data-inputmask-inputformat="999-999-9999">
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="socialSecurityNumber">Social Security Number<span class="require">*</span></label>
                            <input type="password" class="form-control" id="socialSecurityNumber" aria-describedby="socialSecurityNumberHelp" name="socialSecurityNumber">
                            <small style="color:#495057">(Ex.115668989)</small>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="dateOfBirth">Date Of Birth<span class="require">*</span></label>
                            <input type="text" class="form-control" id="dateOfBirth" name="dateOfBirth">
                            <small style="color:#495057">(Ex.MM/DD/YYYY)</small>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <!-- Agreement -->
                        <iframe frameBorder="0" style="height: 610px;" id="agreement" class="agreement" width="100%" height="100%" data-ifields-id="agreement" src="https://cdn.cardknox.com/ifields/2.15.2309.2601/agreement.htm"></iframe>
                    </div>
                </div>
            </div>



        </div>
        <div class="modal-footer border-top-0 d-flex justify-content-right">
            <button type="submit" id="submit" name="submit" value="submit" class="btn btn-primary" disabled>Submit</button>
        </div>

    </form>
    <div id="form-errors"></div>
</div>



<?= view('template/footer') ?>
<link href="<?= base_url('public/assets/css/bootstrap.css'); ?>" rel="stylesheet">
<link href="<?= base_url('public/assets/css/dataTables.bootstrap4.min.css'); ?>" rel="stylesheet">
<link href="<?= base_url('public/assets/css/responsive.bootstrap4.min.css'); ?>" rel="stylesheet">
<script src="<?= base_url('public/assets/js/jquery.validate.js'); ?>"></script>
<script src="<?= base_url('public/assets/js/additional-methods.min.js'); ?>"></script>
<script src="<?= base_url('public/assets/js/sweetalert2.min.js'); ?>"></script>

<script>
    document.addEventListener("DOMContentLoaded", function(event) {

        ckCustomerAgreement.enableAgreement({
            iframeField: 'agreement',
            xKey: '<?php echo SUPERADMIN_API_KEY; ?>',
            autoAgree: true,
            callbackName: 'handleAgreementResponse'
        });

    });

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
            $('#token').val(response.token);
            $('#submit').prop('disabled', false);
        }

    }
</script>

<script>
    function printForm() {
        // Open a new window for printing
        var printWindow = window.open('', '_blank');

        // Get the HTML content of the form
        var formContent = document.getElementById('mrform').outerHTML;

        // Write the form content into the new window
        printWindow.document.write('<html><head><title>Print Form</title></head><body>');
        printWindow.document.write(formContent);
        printWindow.document.write('<link href="<?= base_url('public/assets/css/bootstrap.css'); ?>" rel="stylesheet">');
        printWindow.document.write('<link href="<?= base_url('public/assets/css/custom.css'); ?>" rel="stylesheet">');
        printWindow.document.write('</body></html>');

        // Close the document for printing
        printWindow.document.close();

        // Call the print function to print the form
        printWindow.print();
    }
    $('#businessPhone').inputmask("999-999-9999");
    $('#phoneNumber').inputmask("999-999-9999");
    $('#cellPhoneNumber').inputmask("999-999-9999");

    //$('#dateOfBirth').inputmask("99/99/9999");
    $('#dateOfBirth').datepicker({
        format: 'mm/dd/yyyy',
    });

    $('#socialSecurityNumber').inputmask("999999999");

    $('#businessAddress_zip,#address_zip').inputmask("99999");
    $('#taxID').inputmask("999999999");
    $('#routingNumber').inputmask("999999999");
    $('#accountNumber').inputmask("9{6,17}");
</script>
<script>
    $.validator.addMethod("nospaces", function(value, element) {
        return value.indexOf('  ') === -1; // Check for double spaces
    }, "Double spaces are not allowed");
    if ($("#create_merchant_lead_form").length > 0) {

        $("#create_merchant_lead_form").validate({

            rules: {
                corporateName: {
                    required: true,
                    nospaces: true,
                    pattern: /^[a-zA-Z0-9\s]*$/,
                },
                businessPhone: {
                    required: true
                },
                businessAddress_streetAddress: {
                    required: true,
                    nospaces: true
                },

                businessAddress_state: {
                    required: true
                },

                businessEmail: {
                    required: true,
                    email: true,
                    nospaces: true,
                    remote: {
                        url: '<?= site_url('checkEmailOnboarded') ?>',
                        type: "post",
                        data: {
                            email: function() {
                                return $("#businessEmail").val();
                            }
                        }
                    },
                },

                businessAddress_city: {
                    required: true,
                    nospaces: true
                },

                businessAddress_zip: {
                    required: true,
                    minlength: 5,
                    maxlength: 5,
                    digits: true
                },

                dba: {
                    required: true,
                    nospaces: true
                },
                firstName: {
                    required: true,
                    nospaces: true
                },

                // goodsOrServicesDescription: {
                //     required: true
                // },
                bankName: {
                    required: true,
                    nospaces: true
                },

                routingNumber: {
                    required: true,
                    minlength: 9,
                },

                taxID: {
                    required: true,
                    minlength: 9,
                    maxlength: 9,
                },

                accountNumber: {
                    required: true,
                    minlength: 6,
                    maxlength: 17,
                },

                address_streetAddress: {
                    required: true,
                    nospaces: true
                },

                address_state: {
                    required: true
                },

                phoneNumber: {
                    required: true
                },
                socialSecurityNumber: {
                    required: true
                },

                lastName: {
                    required: true,
                    nospaces: true
                },

                address_city: {
                    required: true,
                    nospaces: true
                },

                address_zip: {
                    required: true,
                    minlength: 5,
                    maxlength: 5,
                    digits: true
                },

                cellPhoneNumber: {
                    required: true
                },

                dateOfBirth: {
                    required: true,
                    date: true,
                }

            },
            messages: {
                corporateName: {
                    pattern: "Only alphanumeric characters and spaces are allowed",
                },                
                businessEmail: {

                    remote: "Business Email already exists"
                },
                dba: {
                    required: "DBA is required",
                }
            },
            submitHandler: function(form) {

                swal({
                    title: 'Registration Confirmation',
                    text: 'Are you sure you want to submit this form?',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#F44336',
                    confirmButtonText: 'Yes, submit it!',
                    cancelButtonText: 'Cancel'
                }).then((Delete) => {
                    if (Delete) {

                        addOverlay();

                        $.ajax({
                            url: "<?= base_url('index.php/submitgoapp') ?>",
                            type: "POST",
                            data: $('#create_merchant_lead_form').serialize(),
                            dataType: "json",
                            success: function(response) {

                                if (response.error === true) {

                                    errors = response.message;

                                    errorsHtml = '<div class="alert alert-danger"><ul>';

                                    var error_no = 0;

                                    $.each(errors, function(key, val) {
                                        errorsHtml += '<li>' + val + '</li>'; //showing only the first error.

                                        error_no++;
                                    });
                                    errorsHtml += '</ul></di>';
                                    $('#form-errors').html(errorsHtml);
                                    return false;

                                }

                                if (response.success === true) {
                                    swal({
                                        title: "Success!",
                                        text: response.message,
                                        type: "success"
                                    }).then(okay => {
                                        if (okay) {
                                            window.location.href = "<?= base_url(); ?>";
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

    $(document).ready(function() {
        // Function to copy address fields when "Same as above" checkbox is checked
        $('#sameAsAbove').change(function() {
            if ($(this).is(':checked')) {
                var business_add = $('#businessAddress_streetAddress').val();
                var businessAddress_city = $('#businessAddress_city').val();
                var businessAddress_state = $('#businessAddress_state').val();
                var businessAddress_zip = $('#businessAddress_zip').val();

                $('#address_streetAddress').val(business_add);
                $('#address_city').val(businessAddress_city);
                $('#address_state').val(businessAddress_state);
                $('#address_zip').val(businessAddress_zip);
            } else {
                $('#address_streetAddress').val('');
                $('#address_city').val('');
                $('#address_state').val('');
                $('#address_zip').val('');
            }
        });
    });
</script>

<style>
    body {
        font-family: Arial, sans-serif;
        background-color: #f8f9fa;
    }

    .container {
        max-width: 600px;
        margin: 0 auto;
        padding: 20px;
        background-color: #ffffff;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        margin-top: 50px;
        border-radius: 5px;
    }

    .form-group {
        margin-bottom: 20px;
    }

    .form-group label {
        font-weight: bold;
    }

    .form-group input {
        width: 100%;
        padding: 10px;
        box-sizing: border-box;
    }

    .custom-file-label::after {
        content: "Choose File";
    }

    .btn {
        padding: 10px 20px;
        font-size: 16px;
        text-decoration: none;
    }
</style>