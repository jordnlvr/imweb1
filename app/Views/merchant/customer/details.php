<?= view('template/header') ?>

<?= view('template/sidebar') ?>

<!-- Main -->
<div class="l--main ">
    <div id="topOfPage"><span></span>
        <div class="l--content--grid">
            <div></div>
            <div class="">

                <header class="header header--grid  page_header">
                    <h5 class="header__title">
                        Client Details
                    </h5>
                    <a href="javascript:history.back()" class="btn-sm btn btn-secondary"> <i class="fas fa-arrow-left"></i> Back</a>
                </header>

                <table id="exampled" class="table table-striped table-bordered nowrap" style="width:100%">
                    <tbody>
                        <tr>
                            <th style="width: 160px;">Ref Number</th>
                            <td><?php echo $customers['RefNum']; ?></td>
                        </tr>
                        <tr>
                            <th>Client id</th>
                            <td><?php echo $customers['CustomerId']; ?></td>
                        </tr>
                        <tr>
                            <th>Revision</th>
                            <td><?php echo $customers['Revision']; ?></td>
                        </tr>

                        <?php if (!empty($customers['CustomerNumber'])) { ?>
                            <tr>
                                <th>Client Number</th>
                                <td><?php echo $customers['CustomerNumber'] ?></td>
                            </tr>
                        <?php } ?>

                        <?php if (!empty($customers['CustomerNotes'])) { ?>
                            <tr>
                                <th>Client Notes</th>
                                <td><?php echo $customers['CustomerNotes'] ?></td>
                            </tr>
                        <?php } ?>


                        <tr>
                            <th>Created Date</th>
                            <td><?php echo date("m/d/Y", strtotime($customers['CreatedDate']));; ?></td>
                        </tr>
                        <tr>
                            <th>Email</th>
                            <td><?php echo $customers['Email']; ?></td>
                        </tr>
                        <tr>
                            <th>Bill First Name</th>
                            <td><?php echo isset($customers['BillFirstName']) ? $customers['BillFirstName'] : '-' ?></td>
                        </tr>
                        <tr>
                            <th>Bill Last Name</th>
                            <td><?php echo isset($customers['BillLastName']) ? $customers['BillLastName'] : '-' ?></td>
                        </tr>
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
                            <td><?php echo ($customers['CustomerCustom01'])?? '-' ?></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?= view('template/footer') ?>