<?= view('template/header') ?>

<script src=https://cdn.cardknox.com/ifields/2.15.2309.2601/ifields.min.js></script>
<script src='<?= base_url('/public/assets/js/jquery.inputmask.js') ?>'></script>

<div class="container">
    <div class="text-center">
        <img src="https://dev.payme.limo/public/assets/images/payme-logo.png" width="255px" alt="Site Logo" class="site-logo">
    </div>
    <div class="row justify-content-md-center mt-4">
        <div class="col-12">
            <!-- <h1>IntelliMedia Networks Inc DEV </h1> -->
            <div class="content">
                <form action="javascript:void(0)" id="process_cc_form" method="post">
                    <input type="hidden" value="<?= $url; ?>" name="payment_link">
                    <div class="modal-body">
                        <div class="card billInfo">
                            <div class="card-body">
                                <h5 class="heading">Billing Information</h5>
                                <div class="billHead">
                                    <div class="billAmount">
                                        <h6>Order/Invoice: </h6>
                                        <h5 class="text-center"> <?= ($order_invoice_number ? $order_invoice_number : ''); ?></h5>
                                    </div>
                                    <div class="billAmount">
                                        <h6>Transaction Amount: </h6>
                                        <h5 class="text-center"> $<?php echo $amount; ?></h5>
                                    </div>
                                </div>
                                <hr>
                                <input type="hidden" name="order_invoice_number" id="order_invoice_number" value="<?= ($order_invoice_number ? $order_invoice_number : ''); ?>">
                                <input type="hidden" name="xKey" value="<?= $xKey; ?>">
                                <input type="hidden" name="CustomerId" value="<?= $CustomerId; ?>">
                                <input type="hidden" name="url" value="<?= $url; ?>">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="name">Name <span class="require">*</span></label>
                                            <input type="text" class="form-control" id="name" name="firstName" value="<?php echo $customers['BillFirstName'] ?? '' ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="street">Street</label>
                                            <input type="text" class="form-control" id="street" name="address1" value="<?php echo $customers['BillStreet'] ?? '' ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="city">City </label>
                                            <input type="text" class="form-control" id="city" name="city" value="<?php echo $customers['BillCity'] ?? '' ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="state">State</label>
                                            <input type="text" class="form-control" id="state" name="state" value="<?php echo $customers['BillState'] ?? '' ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="zip">Zip</label>
                                            <input type="number" class="form-control" id="zip" name="zip" value="<?php echo $customers['BillZip'] ?? '' ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="phone">Phone Number</label>
                                            <input type="number" class="form-control" id="phone" name="phone" value="<?php echo  $customers['Billmobile'] ?? '' ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="email">Email</label>
                                            <input type="text" class="form-control" id="email" name="email" value="<?php echo  $customers['Email'] ?? '' ?>">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card payInfo">
                            <div class="card-body">
                                <div class="grid_item">
                                    <h5 class="heading">Payment Information</h5>
                                    <span class="right cards ccField">
                                        <img class="" src="https://secure-cdn.cardknox.com/content/themes/green/Icons/visa.png" width="34" id="visa" alt="Visa" />
                                        <img class="" src="https://secure-cdn.cardknox.com/content/themes/green/Icons/master.png" width="34" id="mc" alt="MasterCard" />
                                        <img class="" src="https://secure-cdn.cardknox.com/content/themes/green/Icons/discover.png" width="34" id="disc" alt="Discover" />
                                        <img class="" src="https://secure-cdn.cardknox.com/content/themes/green/Icons/amex.png" width="34" id="amex" alt="American Express" />
                                    </span>
                                    <input type="hidden" name="pt" value="CC" />
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="xCardNum">Card Number <span class="require">*</span></label>
                                            <input type="text" class="form-control input required" id="xCardNum" aria-describedby="xCardNumHelp" name="xCardNum">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="ccExpMonth">MM <span class="require">*</span></label>
                                            <Select class="form-control input required" id="exp" name="ccExpMonth">
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
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="ccExpYear">YY <span class="require">*</span></label>
                                            <select class="form-control input required" id="ccExpYear" name="ccExpYear">
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
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="xCVV">CVV <span class="require">*</span>
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
                                    <div class="col-md-12">
                                        <button id="formS" type="submit" class="formSub btn btn-warning btn-block">
                                            <span Class="totalLbl" id="totalLbl"> Process Payment </span>
                                            <span class="amountMain">
                                                (<span id="totalCur">$</span><span id="totalAmount"><?php echo $amount; ?></span>)
                                            </span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer border-top-0 d-flex justify-content-right">
                        
                    </div>
                    <div class="text-center">
                        <span class="sidebar__copyright">
                            <i class="icon icon--xsml icon--copyright"></i>
                            <span class="sidebar__copytext">© Copyright <?= date('Y') ?></span>
                            <span class="sidebar__copydash">PayMe.Limo</span>
                        </span>
                    </div>
                </form>
            </div>
        </div>
    </div>  
</div>
<script src="<?= base_url('public/assets/js/jquery.validate.js'); ?>"></script>
<script src="<?= base_url('public/assets/js/additional-methods.min.js'); ?>"></script>
<script src="<?= base_url('public/assets/js/sweetalert2.min.js'); ?>"></script>
<script>
    $('#xCardNum').inputmask("9999999999999999");
</script>
<script>
    if ($("#process_cc_form").length > 0) {
        $("#process_cc_form").validate({
            rules: {
                xCardNum: {
                    required: true,
                    creditcard: true,
                    minlength: 16,
                    maxlength: 16,
                },
                xCVV: {
                    required: true,
                    minlength: 3,
                    maxlength: 3,
                },
                firstName: {
                    required: true,
                },
            },
            messages: {
                firstName: {
                    required: "Please enter name",
                },
                xCardNum: {
                    required: "Please enter valid card number",
                    creditcard: "Please enter a valid credit card number",
                    minlength: "Credit card number must be at least {0} digits",
                    maxlength: "Credit card number must not exceed {0} digits"
                },
            },

            submitHandler: function(form) {
                swal({
                    title: 'Payment Confirmation',
                    text: 'Are you sure you want to pay this amount?',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#F44336',
                    confirmButtonText: 'Yes, Pay it!',
                    cancelButtonText: 'Cancel'
                }).then((Delete) => {
                    if (Delete) {
                        addOverlay();
                        $.ajax({
                            url: "<?= base_url('index.php/add-transaction-with-link') ?>",
                            type: "POST",
                            data: $('#process_cc_form').serialize(),
                            dataType: "json",
                            success: function(response) {
                                if (response.error === true) {
                                    swal({
                                        position: "top-end",
                                        icon: "errors",
                                        title: response.message,
                                        showConfirmButton: true,
                                        timer: 1500
                                    });
                                }
                                if (response.success === true) {
                                    swal({
                                        position: "top-end",
                                        icon: "success",
                                        title: response.message,
                                        showConfirmButton: false,
                                        timer: 1500
                                    });
                                    // alert(response.message);
                                    window.location.href = "<?= base_url('index.php/thank-you/') ?>";
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