<form action="javascript:void(0)" name="create_transaction_form" id="create_transaction_form" method="post" accept-charset="utf-8" enctype='multipart/form-data'>
    <div class="modal-body">
        <h5>Transaction Information</h5>
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
            <div class="col-lg-4 col-md-12">
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

        <h5>Payment Information</h5>
        <hr>
        <div class="row">

            <div class="col-lg-4 col-md-6">
                <div class="form-group">
                    <label for="TransactionType">Transaction type <span class="require">*</span></label> <span class="info-icon" data-toggle="tooltip" data-placement="top" title data-original-title="- Select Direct sale for instant payments - Pre Authorisation for  auth only transaction">i</span>
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
                        <input type="number" class="form-control positive-number" name="amount" placeholder="0.00" value="" id="tamount">
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-4 col-md-12">
                <div class="form-group">
                    <label for="cardnumber" id="cardnumberLabel">Card Number <span class="require">*</span></label>
                    <input type="text" class="form-control input required" id="cardnumber1" aria-describedby="cardnumberHelp" name="cardnumber">
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
                        <span class="require">*</span></label>
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
                    <label for="invoiceorderName">Invoice/Order Number</label> <span class="info-icon" data-toggle="tooltip" data-placement="top" title="Add invoice number details">i</span>
                    <input type="text" class="form-control" name="order_invoice_number" value="">
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="form-group">
                    <label for="fileInput">Attach Invoice Copy</label> <span class="info-icon" data-toggle="tooltip" data-placement="top" title="Allowed file type PDF,PNG,JPEG">i</span>
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

<script src='<?= base_url('/public/assets/js/jquery.inputmask.js') ?>'></script>
<script>
    $('#cardnumber1').inputmask("9{13,16}");
    $(document).ready(function() {

        // Add a custom validation method for positive numbers
        $.validator.addMethod('positive-number', function(value, element) {
            return Number(value) > 0;
        }, 'Please enter a number greater than 0.');

        // Close the modal when clicking outside of it
        $('#createTransaction').on('click', function(e) {
            if (e.target === this) {
                $(this).modal('hide');
            }
        });
    });

    // Assuming #transactionType is a select element
    // $('#transactionType').change(function() {
    //     // Check if the selected value is 'authonly'
    //     if ($(this).val() === 'authonly') {
    //         $('#cardnumberLabel').append(' <span class="require">*</span>');
    //         $('#expLabel').append(' <span class="require">*</span>');
    //         $('#ccExpYearLabel').append(' <span class="require">*</span>');
    //         $('#xCVVLabel').append(' <span class="require">*</span>');
    //     } else {
    //         // Remove the <span> element if the value is not 'authonly'
    //         $('#cardnumberLabel .require').remove();
    //         $('#expLabel .require').remove();
    //         $('#ccExpYearLabel .require').remove();
    //         $('#xCVVLabel .require').remove();
    //     }
    // });



    if ($("#create_transaction_form").length > 0) {
        $("#create_transaction_form").validate({
            rules: {
                transactionType: {
                    required: true
                },
                innvoice_file: {
                    extension: "png|jpg|jpeg|pdf"
                },
                cardnumber: {
                    required: function(element) {
                        return $('#transactionType').val() === 'authonly';
                    },
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
                    'positive-number': 'Please enter a amount greater than 0.'
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