<?= view('template/header') ?>
<script src='<?= base_url('/public/assets/js/jquery.inputmask.js') ?>'></script>

<?= view('template/sidebar') ?>

<!-- Main -->
<div class="l--main ">
    <div id="topOfPage"><span></span>
        <div class="l--content--grid">
            <div></div>
            <div class="transaction_history">

                <header class="header header--grid page_header">
                    <h5 class="header__title">
                        Client Information
                        <!-- Transaction History for <?= $customers['BillFirstName'] ?? '' ?> <?= $customers['BillLastName'] ?? ''; ?> (<?= $customers['CustomerId'] ?? '' ?>) -->
                    </h5>
                    <a href="javascript:history.back()" class="btn-sm btn btn-secondary"> <i class="fas fa-arrow-left"></i> Back</a>
                </header>
                <div class="clientInfo  d-md-none">
                    <h6><?php echo isset($customers['BillFirstName']) ? $customers['BillFirstName'] : '-' ?> <?php echo isset($customers['BillLastName']) ? $customers['BillLastName'] : '-' ?></h6>
                    <p>Email: <?php echo $customers['Email']; ?><br />
                        Client id: <?php echo $customers['CustomerId']; ?>
                        <?php if (!empty($customers['CustomerNumber'])) { ?>
                            <?php echo $customers['CustomerNumber'] ?>

                        <?php } ?>

                    </p>



                </div>

                <table id="exampled" class="table table-striped table-bordered nowrap d-none" style="width:100%">
                    <tbody>
                        <tr>
                            <th style="width: 160px;">Ref Number</th>
                            <td><?php echo $customers['RefNum']; ?></td>
                        </tr>

                        <tr>
                            <th>Revision</th>
                            <td><?php echo $customers['Revision']; ?></td>
                        </tr>



                        <?php if (!empty($customers['CustomerNotes'])) { ?>
                            <tr>
                                <th>Client Notes</th>
                                <td><?php echo $customers['CustomerNotes'] ?></td>
                            </tr>
                        <?php } ?>


                        <!-- <tr>
                            <th>Created Date</th>
                            <td><?php echo date("m/d/Y", strtotime($customers['CreatedDate']));; ?></td>
                        </tr> -->

                        <tr>
                            <th>Bill Company</th>
                            <td><?php echo isset($customers['BillCompany']) ? $customers['BillCompany'] : '-' ?></td>
                        </tr>
                        <?php if (!empty($customers['BillStreet'])) { ?>
                            <tr>
                                <th>Bill Street</th>
                                <td><?php echo $customers['BillStreet'] ?></td>
                            </tr>
                        <?php } ?>

                        <?php if (!empty($customers['BillStreet2'])) { ?>
                            <tr>
                                <th>Bill Street 2</th>
                                <td><?php echo $customers['BillStreet2'] ?></td>
                            </tr>
                        <?php } ?>

                        <?php if (!empty($customers['BillCity'])) { ?>
                            <tr>
                                <th>Bill City</th>
                                <td><?php echo $customers['BillCity'] ?></td>
                            </tr>
                        <?php } ?>

                        <?php if (!empty($customers['BillState'])) { ?>
                            <tr>
                                <th>Bill State</th>
                                <td><?php echo $customers['BillState'] ?></td>
                            </tr>
                        <?php } ?>

                        <?php if (!empty($customers['BillZip'])) { ?>
                            <tr>
                                <th>Bill Zip</th>
                                <td><?php echo $customers['BillZip'] ?></td>
                            </tr>
                        <?php } ?>

                        <?php if (!empty($customers['BillCountry'])) { ?>
                            <tr>
                                <th>Bill Country</th>
                                <td><?php echo $customers['BillCountry'] ?></td>
                            </tr>
                        <?php } ?>

                        <tr>
                            <th>Affiliate Referral Source</th>
                            <td><?php echo ($customers['CustomerCustom01']) ?? '-' ?></td>
                        </tr>
                    </tbody>
                </table>
                <div class="btnrow">

                    <a class="btn btn-info btn-sm sendpaymentrequestlink d-md-none" title="Send Email Payment Link Request" href="javascript:void(0)" data-customerid="<?php echo $customers['CustomerId']; ?>" data-firstname="<?php echo $customers['BillFirstName']; ?>" data-customer-email="<?php echo $customers['Email'] ?? ''; ?>" data-xKey="<?php echo $xKey; ?>" data-toggle="modal" data-target="#payCustomer"><i class="fas fa-paper-plane send-icon"></i> <span>Send Payment Link</span></a>

                    <button type="button" class="btn btn-primary btn-xs float-sm-right mb-3 createnewtransaction_btn" data-toggle="modal" data-target="#createnewtransaction">
                        <i class="fa fa-plus-circle"></i>
                        New Transaction
                    </button>
                    <a class="btn btn-warning btn-sm d-md-none" title="Edit Client" href="<?= base_url('index.php/edit-client/' . $customers['CustomerId']); ?>" data-toggle="tooltip" data-placement="top">
                        <i class="far fa-edit"></i> <span>Edit</span>
                    </a>



                    <button type="button" title="Delete Client " onclick="deletecustomer('<?= $customers['CustomerId'] ?>')" class="btn btn-danger btn-sm d-md-none" data-toggle="tooltip" data-placement="top"><i class="far fa-trash-alt"></i> <span>Delete </span></button>
                </div>

                <div class="table-responsive">
                    <h5 class="header__title">
                        History
                    </h5>
                    <table id="customerTransactionList" class="table table-striped table-bordered nowrap" style="width:100%">
                        <thead>
                            <tr>
                                <th></th>
                                <th>Reference No</th>
                                <th>Invoice No</th>
                                <th>Amount</th>
                                <th>Type</th>
                                <th>Invoice File</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if ($transactionList) {

                                foreach ($transactionList as $value) {

                                    $transaction_type = $value['type'];
                            ?>

                                    <tr data-id="<?= ($value['id']) ? $value['id'] : '' ?>">
                                        <td class=" <?= ($value['id'] ? 'details-control' : '') ?>"></td>
                                        <td class="mtdcol-6" data-name="Reference No"><?php echo $value['id']; ?></td>
                                        <td class="mtdcol-6" data-name="Invoice No"><?php echo $value['invoiceno']; ?></td>
                                        <td class="mtdcol-6" data-name="Amount"><?php echo '$' . $value['amount']; ?> <?= ($value['type'] == 'authonly' ? '<img src=' . base_url() . '/public/assets/images/auth.svg>' : '') ?></td>
                                        <td class="mtdcol-6" data-name="Type"><?= ($transaction_type == 'sale' ? 'Direct sale' : ($transaction_type == 'authonly' ? 'Pre Authorization' : ucfirst($transaction_type))); ?></td>
                                        <td class="mtdcol-6" data-name="Invoice File">
                                            <?php if ($value['invoice_file']) { ?>
                                                <a href="<?= base_url('index.php/downloads/' . $value['invoice_file']); ?>" target="_blank">
                                                    <!-- <i class="far fa-file fa-2x"></i> -->
                                                    <img width="20px" src='<?= base_url('/public/assets/images/invoice.svg'); ?>'>
                                                </a>
                                            <?php } ?>
                                        </td>
                                        <td class="mtdcol-6" data-name="Status"><?= ($value['status'] == 'Approved' ? '<span class="badge badge-success">Approved</span>' : '<span class="badge badge-warning"></span>'); ?></td>
                                        <td><?= (($value['status'] == 'Approved' && ($value['type'] == 'sale' || $value['type'] == 'capture') && $value['amount'] > 0 && $value['remaining_amount'] != 0) ? '<button class="btn btn-xs btn-primary btn-refund" onclick="return refundamount(' . $value['id'] . ')"><img width="20px" src=' . base_url() . '/public/assets/images/refund.svg> Refund</button>' : ($value['status'] == 'Approved' && $value['type'] == 'authonly' ? '<button class="btn btn-xs btn-primary" onclick="return captureamount(' . $value['id'] . ')">Capture</button>' : '')); ?></td>
                                    </tr>

                            <?php }
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

<!-- Modal -->
<div class="modal fade" id="createnewtransaction" tabindex="-1" role="dialog" aria-labelledby="createnewtransactionLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header border-bottom-0">
                <h5 class="modal-title" id="createnewtransactionLabel">Add a New Transaction</h5>
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
                        <div class="col-lg-4 col-md-6">
                            <div class="form-group">
                                <label for="firstName">First Name </label>
                                <input type="text" class="form-control" readonly name="firstName" value="<?php echo $customers['BillFirstName'] ?? '' ?>">
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6">
                            <div class="form-group">
                                <label for="lastName">Last Name </label>
                                <input type="text" class="form-control" readonly name="lastName" value="<?php echo $customers['BillLastName'] ?? '' ?>">
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6">
                            <div class="form-group">
                                <label for="company">Company </label>
                                <input type="text" class="form-control" readonly name="company" value="<?php echo $customers['BillCompany'] ?? '' ?>">
                            </div>
                        </div>

                        <div class="col-lg-4 col-md-6">
                            <div class="form-group">
                                <label for="address1">Address 1</label>
                                <input type="text" class="form-control" readonly name="address1" value="<?php echo $customers['BillState'] ?? '' ?>">
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6">
                            <div class="form-group">
                                <label for="address2">Address 2</label>
                                <input type="text" class="form-control" id="address2" readonly name="address2" value="<?php echo $customers['BillStreet2'] ?? '' ?>">
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6">
                            <div class="form-group">
                                <label for="city">City </label>
                                <input type="text" class="form-control" name="city" value="<?php echo $customers['BillCity'] ?? '' ?>" readonly>
                            </div>
                        </div>

                        <div class="col-lg-4 col-md-6">
                            <div class="form-group">
                                <label for="state">State</label>
                                <input type="text" class="form-control" readonly name="state" value="<?php echo $customers['BillState'] ?? '' ?>">
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6">
                            <div class="form-group">
                                <label for="zip">Zip</label>
                                <input type="number" class="form-control" readonly name="zip" value="<?php echo $customers['BillZip'] ?? '' ?>">
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6">
                            <div class="form-group">
                                <label for="phone">Phone Number</label>
                                <input type="number" class="form-control" readonly name="phone" value="<?php echo  $customers['Billmobile'] ?? '' ?>">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label for="description">Description</label>
                                <textarea rows="3" class="form-control" name="description" id="description" maxlength="800"></textarea>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label for="reference">Reference</label>
                                <input type="text" class="form-control" name="reference" id="reference" maxlength="200">
                            </div>
                        </div>
                    </div>
                    <br><br>
                    <hr>
                    <h5>Payment Information</h5>
                    <hr>
                    <div class="row">

                        <div class="col-lg-4 col-md-6">
                            <div class="form-group">
                                <label for="TransactionType">Transaction type <span class="require">*</span></label> <span class="info-icon" data-toggle="tooltip" data-placement="bottom" title="- Select Direct sale for instant payments - Pre Authorisation for  auth only transaction">i</span>
                                <select name="transactionType" id="transactionType" class="form-control" tabindex="-1">
                                    <option value="sale">Direct sale</option>
                                    <option value="authonly">Pre Authorization</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-lg-4 col-md-6">
                            <div class="form-group">
                                <label for="firstName">Amount <span class="require">*</span></label> <span class="info-icon" data-toggle="tooltip" data-placement="bottom" title="Enter total transaction amount">i</span>
                                <div class="input-group ">
                                    <span class="input-group-text">$</span>
                                    <input type="number" class="form-control" name="amount" placeholder="0.00" value="" id="tamount">
                                </div>
                            </div>
                        </div>
                    </div>
                    <br><br>

                    <div class="row">
                        <div class="col-lg-4 col-md-12">
                            <div class="form-group">
                                <label for="cardnumber" id="cardnumberLabel">Card Number <span class="require">*</span></label>
                                <input type="text" class="form-control input required" id="cardnumber" aria-describedby="cardnumberHelp" name="cardnumber">
                            </div>
                        </div>
                        <div class="col-lg-2 col-md-4">
                            <div class="form-group">
                                <label for="ccExpMonth" id="expLabel">MM <span class="require">*</span></label>
                                <Select class="form-control required" id="exp" name="ccExpMonth">
                                    <option selected hidden value></option>
                                    <option>01</option>
                                    <option>02</option>
                                    <option>03</option>
                                    <option>04</option>
                                    <option>05</option>
                                    <option>06</option>
                                    <option>07</option>
                                    <option>08</option>
                                    <option>09</option>
                                    <option>10</option>
                                    <option>11</option>
                                    <option>12</option>
                                </Select>
                            </div>
                        </div>
                        <div class="col-lg-2 col-md-4">
                            <div class="form-group">
                                <label for="ccExpYear" id="ccExpYearLabel">YY <span class="require">*</span></label>
                                <select class="form-control required" id="ccExpYear" name="ccExpYear">
                                    <option selected hidden value></option>
                                    <option>24</option>
                                    <option>25</option>
                                    <option>26</option>
                                    <option>27</option>
                                    <option>28</option>
                                    <option>29</option>
                                    <option>30</option>
                                    <option>31</option>
                                    <option>32</option>
                                    <option>33</option>
                                    <option>34</option>
                                    <option>35</option>
                                    <option>36</option>
                                    <option>37</option>
                                    <option>38</option>
                                    <option>39</option>
                                    <option>40</option>
                                    <option>41</option>
                                    <option>42</option>
                                    <option>43</option>
                                    <option>44</option>
                                    <option>45</option>
                                    <option>46</option>
                                    <option>47</option>
                                    <option>48</option>
                                    <option>49</option>
                                    <option>50</option>
                                    <option>51</option>
                                    <option>52</option>
                                    <option>53</option>
                                    <option>54</option>
                                    <option>55</option>
                                    <option>56</option>
                                    <option>57</option>
                                    <option>58</option>
                                    <option>59</option>
                                    <option>60</option>
                                    <option>61</option>
                                    <option>62</option>
                                    <option>63</option>
                                    <option>64</option>
                                    <option>65</option>
                                    <option>66</option>
                                    <option>67</option>
                                    <option>68</option>
                                    <option>69</option>
                                    <option>70</option>
                                    <option>71</option>
                                    <option>72</option>
                                    <option>73</option>
                                    <option>74</option>

                                </select>
                            </div>
                        </div>
                        <div class="col-lg-2 col-md-4">
                            <div class="form-group">
                                <label for="xCVV" id="xCVVLabel">CVV
                                    <span class="tooltip">
                                        i<span class="tooltiptext">
                                            CVV Is the 3 digit number on back of your Visa & MasterCard. On Amex it Is a 4 digit number in front of the card.
                                            <span class="tooltip_cards">
                                                <img src="https://secure-cdn.cardknox.com/content/themes/green/Icons/Other Cards cvv.png" class="tooltip_card" />
                                                <img src="https://secure-cdn.cardknox.com/content/themes/green/Icons/Amex cvv.png" class="tooltip_card tooltip_card-alt" />
                                            </span>
                                        </span>
                                    </span>
                                </label>
                                <input type="text" inputmode="numeric" autocomplete="off" id="xCVV" name="xCVV" maxlength="4" class="form-control input required" />
                            </div>
                        </div>
                    </div>
                    <br><br>
                    <h5>Invoice Information</h5>
                    <hr>
                    <div class="row">
                        <div class="col-lg-4 col-md-6">
                            <div class="form-group">
                                <label for="invoiceorderName">Invoice/Order Number</label> <span class="info-icon" data-toggle="tooltip" data-placement="bottom" title="Add invoice number details">i</span>
                                <input type="text" class="form-control" name="order_invoice_number" value="">
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6">
                            <div class="form-group">
                                <label for="fileInput">Attach Invoice Copy</label> <span class="info-icon" data-toggle="tooltip" data-placement="bottom" title="Allowed file type PDF,PNG,JPEG">i</span>
                                <div class="custom-file">
                                    <input type="file" class="form-control" name="innvoice_file" id="innvoice_file">
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="modal-footer border-top-0 d-flex justify-content-right">
                    <button type="submit" id="save" name="save" class="btn btn-primary">Process </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- refund modal popup -->
<div id="dynamicContentContainer"></div>

<?= view('template/footer') ?>

<link href="<?= base_url('public/assets/css/bootstrap.css'); ?>" rel="stylesheet">
<link href="<?= base_url('public/assets/css/dataTables.bootstrap4.min.css'); ?>" rel="stylesheet">
<link href="<?= base_url('public/assets/css/responsive.bootstrap4.min.css'); ?>" rel="stylesheet">
<link href="<?= base_url('public/assets/css/sweetalert2.min.css'); ?>" rel="stylesheet">


<script>
    $(document).ready(function() {
        var table = $('#customerTransactionList').DataTable();

        $('#customerTransactionList tbody').on('click', 'td.details-control', function() {

            var tr = $(this).closest('tr');
            var row = table.row(tr);

            if (row.child.isShown()) {
                // This row is already open - close it
                row.child.hide();
                tr.removeClass('shown');
            } else {
                // Open this row
                //row.child(format(row.data())).show();
                var rowData = row.data();
                var uniqueIdentifier = rowData[1];

                console.log(uniqueIdentifier);

                var childDataUrl = '<?= site_url('transaction_json/') ?>' + uniqueIdentifier;

                addOverlay();

                $.ajax({
                    url: childDataUrl,
                    method: 'GET',
                    success: function(data) {
                        // Update the child row content with the AJAX response
                        row.child(data).show();
                        tr.addClass('shown');
                    },
                    complete: removeOverlay,
                    error: function() {
                        console.error('Error loading child data via AJAX');
                    }
                });

            }
        });

    });
</script>

<script>
    function refundamount(refnumber) {
        addOverlay();
        // Make an AJAX request to fetch dynamic content
        $.ajax({
            url: '<?= site_url('popup/refund_amount') ?>/' + refnumber,
            method: 'GET',
            success: function(data) {
                // Update the content in the modal
                $('#dynamicContentContainer').html(data.html);
                // Show the modal
                $('#refundcustomerAmount').modal('show');
            },
            complete: removeOverlay
        });
    }

    function captureamount(refnumber) {
        addOverlay();
        // Make an AJAX request to fetch dynamic content
        $.ajax({
            url: '<?= site_url('popup/capture_amount') ?>/' + refnumber,
            method: 'GET',
            success: function(data) {
                // Update the content in the modal
                $('#dynamicContentContainer').html(data.html);
                // Show the modal
                $('#capturecustomerAmount').modal('show');
            },
            complete: removeOverlay
        });
    }
</script>

<script src="<?= base_url('public/assets/js/jquery.validate.js'); ?>"></script>
<script src="<?= base_url('public/assets/js/additional-methods.min.js'); ?>"></script>
<script src="<?= base_url('public/assets/js/sweetalert2.min.js'); ?>"></script>

<script>
    $('#cardnumber').inputmask("9{13,16}");
    $(document).ready(function() {
        // Add a custom validation method for positive numbers
        $.validator.addMethod('positive-number', function(value, element) {
            return Number(value) > 0;
        }, 'Please enter a number greater than 0.');
    });

    $('#amount').on('keyup', function() {
        var amount = $(this).val();
        if (amount.length > 0) {
            $('#save').text('Process: $' + amount);
        } else {
            $("#save").val(0);
        }
    });

    // Assuming #transactionType is a select element
    // $('#transactionType').change(function() {
    //     // Check if the selected value is 'authonly'
    //     if ($(this).val() === 'authonly') {
    //         $('#cardnumberLabel').append('<span class="require">*</span>');
    //         $('#expLabel').append('<span class="require">*</span>');
    //         $('#ccExpYearLabel').append('<span class="require">*</span>');
    //         $('#xCVVLabel').append('<span class="require">*</span>');
    //     } else {
    //         // Remove the <span> element if the value is not 'authonly'
    //         $('#cardnumberLabel .require').remove();
    //         $('#expLabel .require').remove();
    //         $('#ccExpYearLabel .require').remove();
    //         $('#xCVVLabel .require').remove();
    //     }
    // });
    if ($("#create_transaction_form").length > 0) {
        //     alert('adfads');
        // if($('#transactionType').val() === 'authonly'){
        //     alert('adfads');
        //     $("#cardnumberLabel").text('Card Number <span class="require">*</span>');
        // }

        $("#create_transaction_form").validate({
            rules: {
                transactionType: {
                    required: true
                },
                innvoice_file: {
                    extension: "png|jpg|jpeg|pdf"
                },
                cardnumber: {
                    // required: function(element) {
                    //     return $('#transactionType').val() === 'authonly';
                    // },
                    required: true,
                    creditcard: true,
                    minlength: 13,
                    maxlength: 16,
                },
                ccExpMonth: {
                    required: function(element) {
                        return $('#transactionType').val() === 'authonly';
                    },
                    required: true,
                },
                ccExpYear: {
                    required: function(element) {
                        return $('#transactionType').val() === 'authonly';
                    },
                    required: true,
                },
                xCVV: {
                    required: function(element) {
                        return $('#transactionType').val() === 'authonly';
                    },
                    required: true,
                    minlength: 3,
                    maxlength: 3,
                },
                amount: {
                    required: true,
                    'positive-number': true
                },
            },
            messages: {
                amount: {
                    required: "Please enter amount",
                    'positive-number': 'Please enter a number greater than 0.'
                },
                cardnumber: {
                    required: "Please enter valid card number",
                    creditcard: "Please enter a valid credit card number",
                    minlength: "Credit card number must be at least {0} digits",
                    maxlength: "Credit card number must not exceed {0} digits"
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
                swal({
                    title: 'Transaction Confirmation',
                    text: 'Confirm you wish to pre-authorize (or directly charge) the amount of ' + $("#tamount").val() + '.',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#F44336',
                    confirmButtonText: 'Confirm',
                    cancelButtonText: 'Cancel'
                }).then((Delete) => {
                    if (Delete) {
                        addOverlay();
                        $.ajax({
                            url: "<?= base_url('index.php/add-transaction') ?>",
                            type: "POST",
                            data: new FormData(form),
                            processData: false,
                            contentType: false,
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
                                        type: "success",
                                    }).then(okay => {
                                        if (okay) {
                                            window.location.href = "<?= base_url('index.php/client-transaction/' . $customers['CustomerId']) ?>";
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