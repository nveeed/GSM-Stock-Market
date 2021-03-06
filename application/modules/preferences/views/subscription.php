<?php

//echo '<pre>';
//echo $invoice;
//print_r($transaction);
//exit;
 $this->load->model('trial/trial_model', 'trial_model');

?>            <div class="row wrapper border-bottom white-bg page-heading">
                <div class="col-lg-10">
                    <h2>My Subcription</h2>
                    <ol class="breadcrumb">
                        <li>
                            <a href="/">Home</a>
                        </li>
                        <li>
                            Preferences
                        </li>
                        <li class="active">
                            <strong>My Subscription</strong>
                        </li>
                    </ol>
                </div>
                <div class="col-lg-2"> 

                </div>
            </div>
        <div class="wrapper wrapper-content  animated fadeInRight">
            <div class="row">
            <?php 
                echo $this->session->flashdata('confirm-transaction');
                echo $trade_confirm;
              ?>
            
                    <?php if($member->membership > 1) {?> 
                        
                    <div class="col-lg-12">
                        <div class="ibox">
                            <div class="ibox-title">
                                <h5>Current Subscription</h5>
                            </div>
                            <div class="ibox-content">
                            		<style>
                                                dl.full-width dt, dl.full-width dd {width:50%}
                                                dl.full-width dd {margin-left:51%}
                                        </style>
                                    <dl class="dl-horizontal full-width">
                                        <?php
                                            $ttcount = $this->trial_model->_custom_query_count("SELECT COUNT(*) AS count FROM trial WHERE member_id = '".$member->id."' AND status = 'free'");
                                            if($ttcount[0]->count > 0){
                                        ?>
                                            <dt>Current Subscription:</dt> <dd><?php echo $this->membership_model->get_where($member->membership)->membership?> Member (Free Trial)</dd>
                                        <?php } else {?>
                                            <dt>Current Subscription:</dt> <dd><?php echo $this->membership_model->get_where($member->membership)->membership?> Member</dd>                                        
                                        <?php }?>
                                        <dt>Join Date:</dt> <dd><?php echo $member->date; ?></dd>
                                    </dl>
                            </div>
                        </div>
                    </div>                    
                    
                    <?php } else {?>
                    
            		<div class="col-lg-6">                        
                        <div class="ibox">
                            <div class="ibox-title">
                            	<h5>Current Subscription</h5>
                            </div>
                            <div class="ibox-content element">
                            		<style>
                                                dl.full-width dt, dl.full-width dd {width:50%}
                                                dl.full-width dd {margin-left:51%}
                                        </style>
                                    <dl class="dl-horizontal full-width">
                                        <dt>Current Subscription:</dt> <dd> Bronze Member</dd>
                                        <dt>Join Date:</dt> <dd><?php echo $member->date; ?></dd>
                                    </dl>
                                        <?php
                                            if($member->date_activated < '2015-06-01'){
                                                $tcount = $this->trial_model->_custom_query_count("SELECT COUNT(*) AS count FROM trial WHERE member_id = '".$member->id."'");
                                                if($tcount[0]->count < 1){
                                        ?>
                                        <div class="text-center">
                                        <a href="trial/activate/<?php echo $member->id; ?>" class="btn btn-primary" style="font-size:2em;margin:0 auto">Activate Free 30 Day Trial Now</a>
                                        </div>
                                        <?php
                                                }
                                            }
                                        ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="ibox">
                            <div class="ibox-title">
                                <span class="label label-primary pull-right">Accout Eligible</span>                                
                                    <h5>Upgrade to Silver Membership</h5>                                
                            </div>
                            <div class="ibox-content text-center element">
                        	<label class="control-label">Subscription: </label>                            
                            <select id="selectMe" class="form-control" style="width:auto;display:inline-block">
                              <option value="option1_6">PayPal (6 Months)</option>
                              <option value="option1_12" selected>PayPal (1 Year)</option>
                              <option value="option2_6">Bank Transfer (6 Months)</option>
                              <option value="option2_12">Bank Transfer (1 Year)</option>
                              <option value="option3_6">Credit/Debit Card (6 Months)</option>
                              <option value="option3_12">Credit/Debit Card (1 Year)</option>
                            </select>
                            <button id="option1_6" class="payment_method btn btn-primary" data-toggle="modal" data-target="#payment_paypal_6" style="font-size:12px;margin-bottom:3px">Upgrade Now</button>
                            <button id="option1_12" class="payment_method btn btn-primary" data-toggle="modal" data-target="#payment_paypal_12" style="font-size:12px;margin-bottom:3px">Upgrade Now</button>
                            <button id="option2_6" class="payment_method btn btn-primary" data-toggle="modal" data-target="#payment_banktransfer_6" style="font-size:12px;margin-bottom:3px">Upgrade Now</button>
                            <button id="option2_12" class="payment_method btn btn-primary" data-toggle="modal" data-target="#payment_banktransfer_12" style="font-size:12px;margin-bottom:3px">Upgrade Now</button>
                            <button id="option3_6" class="payment_method btn btn-primary" data-toggle="modal" data-target="#payment_card_6" style="font-size:12px;margin-bottom:3px">Upgrade Now</button>
                            <button id="option3_12" class="payment_method btn btn-primary" data-toggle="modal" data-target="#payment_card_12" style="font-size:12px;margin-bottom:3px">Upgrade Now</button>
                            </div>
                        </div>
                    </div>
                    
                        
                        <?php }?>  
              </div>
            
            
            <?php if($member->membership > 4) { ?>
            <div class="row">
                <div class="col-lg-12">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5>Change your Plan</h5>
                        </div>
                        <div class="ibox-content">
                        <div class="row">
                        <div class="row db-padding-btm db-attached col-lg-10 col-lg-offset-1">
            <div class="col-sm-12 col-md-4 col-lg-4">
                <div class="db-wrapper">
                    <div class="db-pricing-eleven db-bk-color-one">
                        <div class="price">
                            FREE
                                <small>Limited Accounts</small>
                        </div>
                        <div class="type">
                            BRONZE
                        </div>
                        <ul>

                            <li><i class="glyphicon glyphicon-user"></i>Full Profile Editor</li>
                            <li><i class="glyphicon glyphicon-envelope"></i>Recieve Messages </li>
                            <li><i class="glyphicon glyphicon-barcode"></i>IMEI Services</li>
                            <li><i class="glyphicon glyphicon-ok"></i>Free Company Listing</li>
                        </ul>
                        <div class="pricing-footer">

                            <a href="#" class="btn db-button-color-square btn-lg">CURRENT</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-12 col-md-4 col-lg-4">
                 <div class="db-wrapper">
                <div class="db-pricing-eleven db-bk-color-two popular">
                    <div class="price">
                        <sup>&pound;</sup>1295
                                <small>per year</small>
                    </div>
                    <div class="type">
                        SILVER
                    </div>
                    <ul>

                        <li><i class="glyphicon glyphicon-print"></i>Bronze Access + </li>
                        <li><i class="glyphicon glyphicon-time"></i>Company Search </li>
                        <li><i class="glyphicon glyphicon-trash"></i>Address Book </li>
                        <li><i class="glyphicon glyphicon-trash"></i>Marketplace </li>
                        <li><i class="glyphicon glyphicon-trash"></i>Marketplace </li>
                    </ul>
                    <div class="pricing-footer">

                        <a href="<?php echo $base?>paypal/purchase/<?php echo $invoice; ?>/silver" class="btn db-button-color-square btn-lg">UPGRADE</a>
                    </div>
                </div>
                     </div>
            </div>
            <div class="col-sm-12 col-md-4 col-lg-4">
                 <div class="db-wrapper">
                <div class="db-pricing-eleven db-bk-color-three">
                    <div class="price">
                        <sup></sup>INVITE
                                <small>per year</small>
                    </div>
                    <div class="type">
                        GOLD
                    </div>
                    <ul>

                        <li><i class="glyphicon glyphicon-print"></i>30+ Accounts </li>
                        <li><i class="glyphicon glyphicon-time"></i>150+ Projects </li>
                        <li><i class="glyphicon glyphicon-trash"></i>Lead Required</li>
                        <li><i class="glyphicon glyphicon-ok"></i>Free Company Listing</li>
                    </ul>
                    <div class="pricing-footer">

                        <a href="#" class="btn db-button-color-square btn-lg">INVITE ONLY</a>
                    </div>
                </div>
                     </div>
            </div>

        </div>
        </div>
                        
                        
                        
                        
                        </div>
                    </div>
                </div>
            </div>
            <?php } ?>
            
            
            
            <div class="row">
                <div class="col-lg-12">
                <div class="ibox">
                    <div class="ibox-title">
                        <h5>Subscription Payments</h5>
                    </div>
                    <div class="ibox-content">
                    
                    <?php if($trans_count > 0) {?>
                        
                        <table class="table table-striped table-bordered table-hover dataTables-example" >
                        <thead>
                        <tr>
                            <th>Invoice No.</th>
                            <th>Invoice Date</th>
                            <th>Item</th>
                            <th>Total</th>
                            <th>Status</th>
                            <th>Options</th>
                        </tr>
                        </thead>
                        <tbody>
                        
                        <?php foreach($transaction as $trans) {?>
                            <tr>
                                <td><?php echo $trans->invoice;?></td>
                                <td><?php echo date('F j, Y', strtotime($trans->date));?></td>
                                <td><?php echo $trans->item;?></td>
                                <td><?php echo '&pound;'.number_format($trans->amount, 2,".",",");?></td>
                                <?php if($trans->status == 'completed') {?>
                                    <td style="text-align:center"><span class="label label-primary">Paid</span></td>
                                <?php } elseif($trans->status == 'not_completed') {?>
                                    <td style="text-align:center"><span class="label label-warning">Unpaid</span></td>
                                <?php } else {?>
                                    <td style="text-align:center"><span class="label label-danger">DECLINED</span></td>
                                <?php }?>    
                                <td style="text-align:center"><a href="transaction/invoice/<?php echo $trans->id;?>" class="btn btn-primary" style="font-size:10px">View Invoice</a></td>
                            </tr>
                        <?php }?>
                        </tbody>
                    </table>    
                    <?php } else {?>
                            
                    <table class="table table-striped table-bordered table-hover" >
                    <thead>
                    <tr>
                        <th>Invoice No.</th>
                        <th>Invoice Date</th>
                        <th>Item</th>
                        <th>Total</th>
                        <th>Status</th>
                        <th>Options</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>                        
                        <td colspan="6" align="center">There are no transactions at present.</td>
                    </tr>
                    
                    </tbody>
                    </table>
                    <?php }?>
                    
                    

                    </div>


                    
                    
                    
                </div>
            </div>
            </div>
            
            
            
        </div>
        
        
        
                            <div class="modal inmodal fade" id="payment_paypal_6" tabindex="-1" role="dialog"  aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                            <h4 class="modal-title">Payment Method: PayPal</h4>
                                            <small class="font-bold">Upgrade your GSMStockMarket.com account to <b>6 month</b> Silver membership @ £995.00</small>
                                        </div>
                                        <div class="modal-body">
                                            <p>You have selected <strong>PayPal</strong> as your form of payment.</p>
                                            <p>When you confirm your order you will be redirected to <strong>PayPal</strong> and will be able to make payment using your <strong>PayPal</strong> account.</p>
                                            <p>Once payment is complete you will be redirected back to our website.</p> 
                                            <p><strong style="color:red">Notice:</strong>You will still need to add two (2) trade references to your account and have them confirmed by GSMstockmarket before you have complete access.</p>  
                                        </div>

                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel Order</button>
                                            <a href="<?php echo $base?>paypal/purchase/<?php echo $invoice; ?>/silver-6" class="btn btn-primary">Confirm Purchase</a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="modal inmodal fade" id="payment_paypal_12" tabindex="-1" role="dialog"  aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                            <h4 class="modal-title">Payment Method: PayPal</h4>
                                            <small class="font-bold">Upgrade your GSMStockMarket.com account to <b>1 year</b> Silver membership @ £1795.00</small>
                                        </div>
                                        <div class="modal-body">
                                            <p>You have selected <strong>PayPal</strong> as your form of payment.</p>
                                            <p>When you confirm your order you will be redirected to <strong>PayPal</strong> and will be able to make payment using your <strong>PayPal</strong> account.</p>
                                            <p>Once payment is complete you will be redirected back to our website.</p>  
                                            <p><strong style="color:red">Notice:</strong>You will still need to add two (2) trade references to your account and have them confirmed by GSMstockmarket before you have complete access.</p> 
                                        </div>

                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel Order</button>
                                            <a href="<?php echo $base?>paypal/purchase/<?php echo $invoice; ?>/silver-12" class="btn btn-primary">Confirm Purchase</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
        
                            <div class="modal inmodal fade" id="payment_banktransfer_6" tabindex="-1" role="dialog"  aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                            <h4 class="modal-title">Payment Method: Bank Transfer</h4>
                                            <small class="font-bold">Upgrade your GSMStockMarket.com account to <b>6 month</b> Silver membership @ £995.00</small>
                                        </div>
                                        <div class="modal-body">
                                            <p>You have selected <strong>Bank Transfer</strong> as your form of payment.</p>
											<p>Once you click confirm purchase our system will send an email proforma invoice to your accounts email address with instructions on how to send your payment.<p/>
                                            <p>If you would like a printer friendly invoice you will be able to view and print the proforma invoice from within your account by going to <strong>Preferences > My Subscription</strong> and viewing the subscription history tab.</p>
                                            <h4 style="color:red;margin-top:20px">IMPORTANT!</h4>
                                            <p>- Make sure your payment is sent in the correct sum in &pound; (GBP)</p>
                                            <p>- Add the invoice number as reference to your payment to avoid delays</p>
                                            <p><strong style="color:red">Notice:</strong>You will still need to add two (2) trade references to your account and have them confirmed by GSMstockmarket before you have complete access.</p> 
                                        </div>

                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel Order</button>
                                            <a href="<?php echo $base?>transaction/banktransfer_gbp/<?php echo $invoice; ?>/silver-6" class="btn btn-primary">Confirm Purchase</a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="modal inmodal fade" id="payment_banktransfer_12" tabindex="-1" role="dialog"  aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                            <h4 class="modal-title">Payment Method: Bank Transfer</h4>
                                            <small class="font-bold">Upgrade your GSMStockMarket.com account to <b>1 year</b> Silver membership @ £1795.00</small>
                                        </div>
                                        <div class="modal-body">
                                            <p>You have selected <strong>Bank Transfer</strong> as your form of payment.</p>
											<p>Once you click confirm purchase our system will send an email proforma invoice to your accounts email address with instructions on how to send your payment.<p/>
                                            <p>If you would like a printer friendly invoice you will be able to view and print the proforma invoice from within your account by going to <strong>Preferences > My Subscription</strong> and viewing the subscription history tab.</p>
                                            <h4 style="color:red;margin-top:20px">IMPORTANT!</h4>
                                            <p>- Make sure your payment is sent in the correct sum in &pound; (GBP)</p>
                                            <p>- Add the invoice number as reference to your payment to avoid delays</p>
                                            <p><strong style="color:red">Notice:</strong>You will still need to add two (2) trade references to your account and have them confirmed by GSMstockmarket before you have complete access.</p>  
                                        </div>

                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel Order</button>
                                            <a href="<?php echo $base?>transaction/banktransfer_gbp/<?php echo $invoice; ?>/silver-12" class="btn btn-primary">Confirm Purchase</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="modal inmodal fade" id="payment_card_6" tabindex="-1" role="dialog"  aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                            <h4 class="modal-title">Payment Method: Credit/Debit Card</h4>
                                            <small class="font-bold">Upgrade your GSMStockMarket.com account to <b>6 month</b> Silver membership @ £995.00</small>
                                        </div>
                                        <div class="modal-body">
                                            <p>You have selected <strong>Credit/Debit Card</strong> as your form of payment.</p>
                                            <p>We use PayPal for our Credit/Debit Card transactions.</p>
                                            <p>Once you click confirm purchase you will be redirected to Paypal, you will not need a PayPal account to make the payment. Simply clicky on the pay with debit or credit card below the login area.</p>
                                            <p>Once payment is complete you will be redirected back to our website and you will have your new subscriber access when payment is accepted.</p>
                                            <p><strong style="color:red">Notice:</strong>You will still need to add two (2) trade references to your account and have them confirmed by GSMstockmarket before you have complete access.</p>  
                                            <p><img src="public/main/template/gsm/images/paypal_card.png" class="img-responsive" style="max-width:80%;margin-left:10%"/>
                                        </div>

                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel Order</button>
                                            <a href="<?php echo $base?>paypal/purchase/<?php echo $invoice; ?>/silver-6" class="btn btn-primary">Confirm Purchase</a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="modal inmodal fade" id="payment_card_12" tabindex="-1" role="dialog"  aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                            <h4 class="modal-title">Payment Method: Credit/Debit Card</h4>
                                            <small class="font-bold">Upgrade your GSMStockMarket.com account to <b>1 year</b> Silver membership @ £1795.00</small>
                                        </div>
                                        <div class="modal-body">
                                            <p>You have selected <strong>Credit/Debit Card</strong> as your form of payment.</p>
                                            <p>We use PayPal for our Credit/Debit Card transactions.</p>
                                            <p>Once you click confirm purchase you will be redirected to Paypal, you will not need a PayPal account to make the payment. Simply clicky on the pay with debit or credit card below the login area.</p>
                                            <p>Once payment is complete you will be redirected back to our website and you will have your new subscriber access when payment is accepted.</p>  
                                            <p><strong style="color:red">Notice:</strong>You will still need to add two (2) trade references to your account and have them confirmed by GSMstockmarket before you have complete access.</p>  
                                            <p><img src="public/main/template/gsm/images/paypal_card.png" class="img-responsive" style="max-width:80%;margin-left:10%"/>
                                        </div>

                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel Order</button>
                                            <a href="<?php echo $base?>paypal/purchase/<?php echo $invoice; ?>/silver-12" class="btn btn-primary">Confirm Purchase</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
        
        
        
        
        
        <style>
/*=============================================================
    Authour URL: www.designbootstrap.com
    
    http://www.designbootstrap.com/

    License: MIT     
========================================================  */

/*============================================================
BACKGROUND COLORS
============================================================*/
.db-bk-color-one {
    background-color: #A0895E;
}

.db-bk-color-two {
    background-color: #c0c0c0;
}

.db-bk-color-three {
    background-color: #DBDB70;
}

.db-bk-color-six {
    background-color: #F59B24;
}
/*============================================================
PRICING STYLES
==========================================================*/
.db-padding-btm {
    padding-bottom: 50px;
}
.db-button-color-square {
    color: #fff;
    background-color: rgba(0, 0, 0, 0.50);
    border: none;
    border-radius: 0px;
    -webkit-border-radius: 0px;
    -moz-border-radius: 0px;
}

    .db-button-color-square:hover {
        color: #fff;
        background-color: rgba(0, 0, 0, 0.50);
        border: none;
    }


.db-pricing-eleven {
    margin-bottom: 30px;
    margin-top: 50px;
    text-align: center;
    box-shadow: 0 0 5px rgba(0, 0, 0, .5);
    color: #fff;
    line-height: 30px;
}

    .db-pricing-eleven ul {
        list-style: none;
        margin: 0;
        text-align: center;
        padding-left: 0px;
    }

        .db-pricing-eleven ul li {
            padding-top: 20px;
            padding-bottom: 20px;
            cursor: pointer;
        }

            .db-pricing-eleven ul li i {
                margin-right: 5px;
            }


    .db-pricing-eleven .price {
        background-color: rgba(0, 0, 0, 0.5);
        padding: 40px 20px 20px 20px;
        font-size: 60px;
        font-weight: 900;
        color: #FFFFFF;
    }

        .db-pricing-eleven .price small {
            color: #B8B8B8;
            display: block;
            font-size: 12px;
            margin-top: 22px;
        }

    .db-pricing-eleven .type {
        background-color: #52E89E;
        padding: 50px 20px;
        font-weight: 900;
        text-transform: uppercase;
        font-size: 30px;
    }

    .db-pricing-eleven .pricing-footer {
        padding: 20px;
    }

.db-attached > .col-lg-4,
.db-attached > .col-lg-3,
.db-attached > .col-md-4,
.db-attached > .col-md-3,
.db-attached > .col-sm-4,
.db-attached > .col-sm-3 {
    padding-left: 0;
    padding-right: 0;
}

.db-pricing-eleven.popular {
    margin-top: 10px;
}

    .db-pricing-eleven.popular .price {
        padding-top: 80px;
    }
	</style>
    
    
    
<!-- Data Tables -->
<link href="public/main/template/core/css/plugins/dataTables/dataTables.bootstrap.css" rel="stylesheet">
<link href="public/main/template/core/css/plugins/dataTables/dataTables.responsive.css" rel="stylesheet">
<link href="public/main/template/core/css/plugins/dataTables/dataTables.tableTools.min.css" rel="stylesheet">

<!-- Multi Select -->
<link href="public/main/template/core/css/plugins/chosen/chosen.css" rel="stylesheet">

<!-- Data Tables -->
<script type="text/javascript" src="public/main/template/core/js/plugins/dataTables/jquery.dataTables.js"></script>
<script type="text/javascript" src="public/main/template/core/js/plugins/dataTables/dataTables.bootstrap.js"></script>
<script type="text/javascript" src="public/main/template/core/js/plugins/dataTables/dataTables.responsive.js"></script>
<script type="text/javascript" src="public/main/template/core/js/plugins/dataTables/dataTables.tableTools.min.js"></script>

<!-- Chosen -->
<script src="public/main/template/core/js/plugins/chosen/chosen.jquery.js"></script>


<!-- Page-Level Scripts -->
<script type="text/javascript">
$(document).ready(function() {
    $('.dataTables-example').dataTable({
        responsive: true,
        "dom": 'T<"clear">lfrtip',
        "tableTools": {
            "sSwfPath": "public/main/template/core/js/plugins/dataTables/swf/copy_csv_xls_pdf.swf"
        }
    });
	/* multi select */
	var config = {
        '.chosen-select'           : {search_contains:true},
        '.chosen-select-deselect'  : {allow_single_deselect:true},
        '.chosen-select-no-single' : {disable_search_threshold:10},
        '.chosen-select-no-results': {no_results_text:'Oops, nothing found!'},
        '.chosen-select-width'     : {width:"95%"}
    }
    for (var selector in config) {
        $(selector).chosen(config[selector]);
    }			

});
</script>
<style>
    body.DTTT_Print {
        background: #fff;

    }
    .DTTT_Print #page-wrapper {
        margin: 0;
        background:#fff;
    }

    button.DTTT_button, div.DTTT_button, a.DTTT_button {
        border: 1px solid #e7eaec;
        background: #fff;
        color: #676a6c;
        box-shadow: none;
        padding: 6px 8px;
    }
    button.DTTT_button:hover, div.DTTT_button:hover, a.DTTT_button:hover {
        border: 1px solid #d2d2d2;
        background: #fff;
        color: #676a6c;
        box-shadow: none;
        padding: 6px 8px;
    }

    .dataTables_filter label {
        margin-right: 5px;

    }
</style>

<script>
$(document).ready(function () {
  $('.payment_method').hide();
  $('#option1_12').show();
  $('#selectMe').change(function () {
    $('.payment_method').hide();
    $('#'+$(this).val()).show();
  })
});
</script>

<script type="text/javascript" src="public/main/template/gsm/js/jquery.matchHeight-min.js"></script>

<script type="text/javascript">
	$(function() {
    $('.element').matchHeight();
});
</script>