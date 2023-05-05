<div class="col-xl-9 col-lg-9 col-md-12 col-sm-12 col-12">
    <div class="card">
        <div class="card-body p-0">
            <div class="invoice-container">
                <div class="invoice-header">

                    <!-- Row start -->
                    <div class="row gutters">
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                            <div class="custom-actions-btns mb-5">
                                <a href="#" class="btn btn-primary">
                                    <i class="icon-download"></i> Download
                                </a>
                                <a href="#" class="btn btn-info">
                                    <i class="icon-printer"></i> Print
                                </a>
                            
                                <form action="deposit" method="POST" enctype="multipart/form-data">


                                    <div class="row gutters" hidden>
                                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">

                                            <?php $obj->crfToken(); ?>
                                        </div>



                                    </div>





                                    <div class="row gutters">
                                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                            <div class="text-right">
                                                
                                                <button type="submit" id="closeInvoice" name="closeInvoice" class="btn btn-secondary">close</button>
                                            </div>
                                        </div>
                                    </div>

                                </form>

                            
                            </div>
                        </div>
                    </div>
                    <!-- Row end -->

                    <!-- Row start -->
                    <div class="row gutters">
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6">
                            <a href="index.html" class="invoice-logo">
                            <?php $obj->voidSession('invoice'); ?> Deposit Details
                            </a>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6">
                            <address class="text-right">
                            <?php $model->invoicDetails('description'); ?><br>
                            <?php $model->invoicDetails('coin_Type'); ?> | <?php $model->invoicDetails('coin_amount'); ?> | <?php $model->invoicDetails('status'); ?>
                            </address>
                        </div>
                    </div>
                    <!-- Row end -->

                    <!-- Row start -->
                    <div class="row gutters">
                        <div class="col-xl-9 col-lg-9 col-md-12 col-sm-12 col-12">
                            <div class="invoice-details">
                                <address>
                                    Investment Type<br>
                                    <?php $model->invoicDetails('category'); ?>
                                </address>
                            </div>
                        </div>
                        <div class="col-xl-3 col-lg-3 col-md-12 col-sm-12 col-12">
                            <div class="invoice-details">
                                <div class="invoice-num">
                                    <div>Invoice - #<?php $model->invoicDetails('invest_id'); ?></div>
                                    <div><?php $model->invoicDetails('date_created'); ?></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Row end -->

                </div>

                <div class="invoice-body">

                    <!-- Row start -->
                    <div class="row gutters">

                        <div class="col-lg-4 col-md-4 col-sm-12">
                            <div class="table-responsive">
                                <table class="table custom-table m-0">
                                    <thead>
                                        <tr>
                                            <th>QR Code</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>

                                                <p class="m-0 text-muted">
                                                    <?php $compo->userCryptoQr(); ?>
                                                </p>
                                            </td>

                                        </tr>

                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <div class="col-lg-8 col-md-8 col-sm-12">
                            <div class="table-responsive">
                                <table class="table custom-table m-0">
                                    <thead>
                                        <tr>

                                            <th>Deposit ID</th>
                                            <th>Status</th>
                                            <th><?php $model->invoicDetails('coin_type'); ?> Amount</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>

                                            <td><?php $model->invoicDetails('invest_id'); ?></td>
                                            <td><?php $model->invoicDetails('status'); ?></td>
                                            <td><?php $model->invoicDetails('coin_amount'); ?></td>
                                        </tr>

                                        <tr>

                                            <td colspan="2">
                                                <p>
                                                   Pay To Address<br>
                                                    <?php $obj->voidSession('d_address'); ?><br>
                                                    <br>
                                                </p>
                                                <!-- <h5 class="text-success"><strong>Grand Total</strong></h5> -->
                                            </td>
                                            <td>
                                                <p>
                                                    <!-- $5000.00<br>
                                                    $100.00<br> -->
                                                    <br>
                                                </p>
                                                <h5 class="text-success"><strong><?php echo $obj->xeSym($site->voidSite('currency')); ?><?php $obj->voidCal($obj->fmt($model->getInvoicDetails('amount'))); ?> <?php $obj->voidCal($site->currency); ?></strong></h5>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                    </div>
                    <!-- Row end -->

                </div>

                <div class="invoice-footer">
                    Thank you for your Business.
                </div>

            </div>
        </div>
    </div>
</div>