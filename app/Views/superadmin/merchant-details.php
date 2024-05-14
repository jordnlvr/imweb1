<?= view('template/header') ?>

<?= view('template/sidebar') ?>

<!-- Main -->
<div class="l--main ">
    <div id="topOfPage"><span></span>
        <div class="l--content--grid">
            <div class="">
                <header class="header header--grid d-flex justify-content-between align-items-center page_header">
                    <h5 class="header__title">
                        Merchant Details : <?= $merchant_detail->dba; ?>
                    </h5>
                    <a href="<?= base_url('index.php/merchant-lists'); ?>" class="btn-sm btn btn-secondary"> <i class="fas fa-arrow-left"></i> Back</a>
                </header>
                <div class="mt-2">
                    <div class="card mb-4">
                        <div class="card-body">
                            <h5 class="card-title">General Information</h5>
                            <div class="">
                                <table class="table table-striped table-bordered nowrap">
                                    <tbody>
                                        <tr>
                                            <th scope="row" style="width:150px">First Name</th>
                                            <td><?= $merchant_detail->firstname; ?></td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Last Name</th>
                                            <td><?= $merchant_detail->lastname; ?></td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Phone Number</th>
                                            <td><?= $merchant_detail->phone_number; ?></td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Title</th>
                                            <td><?= $merchant_detail->title; ?></td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Merchant</th>
                                            <td><?= $merchant_detail->dba; ?></td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Email</th>
                                            <td><?= $merchant_detail->email; ?></td>
                                        </tr>
                                        <!-- Add more address details as needed -->
                                    </tbody>
                                </table>
                                <!-- Add more personal details as needed -->
                            </div>
                        </div>
                    </div>
                    <div class="card mb-4">
                        <div class="card-body">
                            <h5 class="card-title">Additional Business Information</h5>
                            <div class="">
                                <table class="table table-striped table-bordered nowrap">
                                    <tbody>
                                        <tr>
                                            <th scope="row" style="width:150px">Corporate Name</th>
                                            <td><?= $merchant_detail->corporate_name; ?></td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Website</th>
                                            <td><?= $merchant_detail->website; ?></td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Street Address</th>
                                            <td><?= $merchant_detail->street_address; ?></td>
                                        </tr>
                                        <tr>
                                            <th scope="row">City</th>
                                            <td><?= $merchant_detail->city; ?></td>
                                        </tr>
                                        <tr>
                                            <th scope="row">State</th>
                                            <td><?= $merchant_detail->state; ?></td>
                                        </tr>
                                        <tr>
                                            <th scope="row">ZIP</th>
                                            <td><?= $merchant_detail->zip; ?></td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Country</th>
                                            <td><?= $merchant_detail->country; ?></td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Fax</th>
                                            <td><?= $merchant_detail->fax; ?></td>
                                        </tr>
                                        <!-- Add more address details as needed -->
                                    </tbody>
                                </table>
                                <!-- Add more address details as needed -->
                            </div>
                        </div>
                    </div>
                    <div class="card mb-4">
                        <div class="card-body">
                            <h5 class="card-title">Additional Contact Information</h5>
                            <div class="">
                                <table class="table table-striped table-bordered nowrap">
                                    <tbody>
                                        <tr>
                                            <th scope="row" style="width:150px">Street</th>
                                            <td><?= $merchant_detail->street_address; ?></td>
                                        </tr>
                                        <tr>
                                            <th scope="row">City</th>
                                            <td><?= $merchant_detail->city; ?></td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Country</th>
                                            <td><?= $merchant_detail->country; ?></td>
                                        </tr>
                                        <!-- Add more address details as needed -->
                                    </tbody>
                                </table>
                                <!-- Add more address details as needed -->
                            </div>
                        </div>
                    </div>
                    <div class="card mb-4">
                        <div class="card-body">
                            <h5 class="card-title">Tech Information</h5>
                            <div class="">
                                <table class="table table-striped table-bordered nowrap">
                                    <tbody>
                                        <tr>
                                            <th scope="row" style="width:150px">Transaction key</th>
                                            <td><?= ($merchant_detail->CardknoxKey ? $merchant_detail->CardknoxKey : $merchant_detail->key); ?></td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Cardknox Account Number</th>
                                            <td><?= ($merchant_detail->CardknoxMid ? $merchant_detail->CardknoxMid : '-'); ?></td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Merchant ID</th>
                                            <td><?= ($merchant_detail->ProcessorMid ? $merchant_detail->ProcessorMid : '-'); ?></td>
                                        </tr>
                                        <!-- Add more address details as needed -->
                                    </tbody>
                                </table>
                                <!-- Add more address details as needed -->
                            </div>
                        </div>
                    </div>
                    <!-- Additional sections can be added below -->
                </div>
            </div>
        </div>
    </div>
</div>
<?= view('template/footer') ?>