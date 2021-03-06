<?php 
echo $this->session->flashdata('confirm-login'); 
echo $this->session->flashdata('confirm-delete');
echo $this->session->flashdata('confirm');

?>
<?php                                        
$this->load->module('feedback');
$overall = $this->feedback->overallScore($this->session->userdata('members_id'));
?>
<div class="wrapper wrapper-content">
<?php if( $terms == 'no' ) {?>
<div class="alert alert-warning" style="margin-bottom:25px;">
The terms and conditions have been updated. Please can you confirm that you have read and acknowledged the <a class="alert-link" href="legal/terms_conditions">Terms &amp; Conditions</a> before you can proceed with using this website.
</div>
<?php } ?>
<?php
if($member->membership < 2){
?>
    <div class="alert alert-danger">
    <p><i class="fa fa-warning"></i> Attention <?php echo $this->session->userdata('firstname');?>! Your account is <strong>Unverified</strong>. You will be unable to access the live platform until you have submitted <a class="alert-link" href="tradereference">two (2) trade references</a> to become a verified member.</p>
    </div>
<div class="row">

<div class="col-lg-3">
<div class="ibox float-e-margins no_sub">
<div class="ibox-title" style=";background:none">
<span class="label label-success pull-right">Monthly</span>
<h5>My Sales</h5>
</div>
<div class="ibox-content" style=";background:none">
<h1 class="no-margins">£102,564</h1>
<div class="stat-percent font-bold text-success">23% <i class="fa fa-level-up"></i></div>
<small>Total income</small>
</div>
</div>
</div>

<div class="col-lg-3">
<div class="ibox float-e-margins no_sub">
<div class="ibox-title" style=";background:none">
<span class="label label-success pull-right">Monthly</span>
<h5>My Purchases</h5>
</div>
<div class="ibox-content" style=";background:none">
<h1 class="no-margins">£74,828</h1>
<div class="stat-percent font-bold text-info">20% <i class="fa fa-level-up"></i></div>
<small>My Purchases</small>
</div>
</div>
</div>

<div class="col-lg-3">
<div class="ibox float-e-margins no_sub">
<div class="ibox-title" style="background:none">
<span class="label label-success pull-right">Monthly</span>
<h5>My Profile Visits</h5>
</div>
<div class="ibox-content" style="min-height:89px;background:none">
<h1 class="no-margins">74</h1>
<div class="stat-percent font-bold text-navy">24% <i class="fa fa-level-up"></i></div>
<small>New visits</small>
</div>
</div>
</div>

<div class="col-lg-3">
<div class="ibox float-e-margins no_sub">
<div class="ibox-title" style="background:none">
    <span class="label label-primary pull-right">Good Standing</span>
    <h5>My Rating</h5>
</div>
<div class="ibox-content" style="min-height:89px;padding:0 20px;text-align:center;background:none">
    <div class="m-r-md inline">                                            
        <input type="text" value="94" class="dial m-r" data-fgColor="#1AB394" data-width="85" data-height="85" data-angleOffset=-125 data-angleArc=250 readonly/>
    </div>
</div>
</div>                     
</div>
</div>



<div class="row">
<div class="col-lg-12">
<div class="ibox float-e-margins no_sub">
<div class="ibox-title" style="background:none">
<h5>Orders</h5>
<div class="pull-right">
    <div class="btn-group">
        <?php

        foreach ( $durationsArray as $key => $value ){
            $active = $durationStr == $key ? "active" : "";
            echo "<a href='./?duration=$key' class='btn btn-xs btn-white $active'>$key</a>";
        }

        ?>
<!--        <a href="./?duration=Monthly" class="btn btn-xs btn-white active">Monthly</a>-->
<!--        <a  class="btn btn-xs btn-white">Quarterly</a>-->
<!--        <a  class="btn btn-xs btn-white">Semi-Annually</a>-->
<!--        <a  class="btn btn-xs btn-white">Annual</a>-->
<!--        <a  class="btn btn-xs btn-white">Lifetime</a>-->
    </div>
</div>
</div>
<div class="ibox-content" style="background:none">
<div class="row">
<div class="col-lg-9">
    <div class="flot-chart">
        <div class="flot-chart-content" id="flot-dashboard-chart"></div>
    </div>
</div>
<div class="col-lg-3">
    <ul class="stat-list">
        <li>
            <h2 class="no-margins">98</h2>
            <small>Total sales orders in period</small>
            <div class="stat-percent">48% <i class="fa fa-level-up text-navy"></i></div>
            <div class="progress progress-mini">
                <div style="width: 48%;" class="progress-bar"></div>
            </div>
        </li>
        <li>
            <h2 class="no-margins ">72</h2>
            <small>Orders in last month</small>
            <div class="stat-percent">60% <i class="fa fa-level-down text-navy"></i></div>
            <div class="progress progress-mini">
                <div style="width: 60%;" class="progress-bar"></div>
            </div>
        </li>
        <li>
            <h2 class="no-margins ">102,564</h2>
            <small>Monthly income from orders</small>
            <div class="stat-percent">96% <i class="fa fa-bolt text-navy"></i></div>
            <div class="progress progress-mini">
                <div style="width: 96%;" class="progress-bar"></div>
            </div>
        </li>
        </ul>
    </div>
</div>
</div>

</div>
</div>
</div>


<div class="row">

<?php

//$this->load->module('mailbox');
//$this->mailbox->mail_recent(10);

?>
<div id="status"></div>

<div class="col-lg-8">

<div class="ibox float-e-margins no_sub">
    <div class="ibox-title" style="background:none">
        <h5>Buying Requests</h5>
        <div class="ibox-tools">
            <a class="collapse-link">
                <i class="fa fa-chevron-up"></i>
            </a>
            <a class="close-link">
                <i class="fa fa-times"></i>
            </a>
        </div>
    </div>
    <div class="ibox-content" style="background:none">
        <table class="table table-hover no-margins">
            <thead>
            <tr>
                <th class="mobihide">Make &amp; Model</th>
                <th>Unit Price</th>
                <th class="mobihide">Qty</th>
                <th>Status</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td class="mobihide">Samsung Galaxy S4 (i9505)</td>
                <td>GBP 194.00</td>
                <td class="mobihide">325</td>
                <td><span class="label label-info">7 Offers</span></td>
            </tr>
            <tr>
                <td class="mobihide">Samsung Galaxy S4 Mini (i9515)</td>
                <td>GBP 117.00</td>
                <td class="mobihide">219</td>
                <td><span class="label label-info">3 Offers</span></td>
            </tr>
            <tr>
                <td class="mobihide">Samsung Galaxy S5 (i9600)</td>
                <td>GBP 245.00</td>
                <td class="mobihide">95</td>
                <td><span class="label label-info">1 Offers</span></td>
            </tr>
            <tr>
                <td class="mobihide">Apple iPhone 5C 16GB</td>
                <td>GBP 250.00</td>
                <td class="mobihide">216</td>
                <td><span class="label label-primary">Active</span></td>
            </tr>
            <tr>
                <td class="mobihide">Apple iPhone 5 64GB</td>
                <td>GBP 24.00</td>
                <td class="mobihide">100</td>
                <td><span class="label label-primary">Active</span></td>
            </tr>
            <tr>
                <td class="mobihide">Apple iPhone 6 16GB</td>
                <td>GBP 454.00</td>
                <td class="mobihide">46</td>
                <td><span class="label label-primary">Active</span></td>
            </tr>
            <tr>
                <td class="mobihide">BlackBerry 9720</td>
                <td>GBP 74.00</td>
                <td class="mobihide">34</td>
                <td><span class="label label-primary">Active</span></td>
            </tr>
            <tr>
                <td class="mobihide">Motorla Nexus 6 32GB</td>
                <td>GBP 355.00</td>
                <td class="mobihide">23</td>
                <td><span class="label label-danger">Ended</span></td>
            </tr>
            </tbody>
        </table>
    </div>
</div>

<div class="ibox float-e-margins no_sub">
    <div class="ibox-title" style="background:none">
        <h5>Selling Offers</h5>
        <div class="ibox-tools">
            <a class="collapse-link">
                <i class="fa fa-chevron-up"></i>
            </a>
            <a class="close-link">
                <i class="fa fa-times"></i>
            </a>
        </div>
    </div>
    <div class="ibox-content" style="background:none">
        <table class="table table-hover no-margins">
            <thead>
            <tr>
                <th class="mobihide">Make &amp; Model</th>
                <th>Unit Price</th>
                <th class="mobihide">Qty</th>
                <th>Status</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td class="mobihide">Samsung Note 3 (N9000)</td>
                <td>GBP 285.00</td>
                <td class="mobihide">91</td>
                <td><span class="label label-info">4 Offers</span></td>
            </tr>
            <tr>
                <td class="mobihide">Amazon Fire Phone</td>
                <td>GBP 115.00</td>
                <td class="mobihide">400</td>
                <td><span class="label label-info">2 Offers</span></td>
            </tr>
            <tr>
                <td class="mobihide">BlackBerry 9810</td>
                <td>GBP 95.00</td>
                <td class="mobihide">200</td>
                <td><span class="label label-primary">Active</span></td>
            </tr>
            <tr>
                <td class="mobihide">BlackBerry Q10</td>
                <td>GBP 127.00</td>
                <td class="mobihide">100</td>
                <td><span class="label label-primary">Active</span></td>
            </tr>
            <tr>
                <td class="mobihide">BlackBerry Z30</td>
                <td>GBP 165.00</td>
                <td class="mobihide">74</td>
                <td><span class="label label-primary">Active</span></td>
            </tr>
            <tr>
                <td class="mobihide">Sony Z3 Compact</td>
                <td>GBP 230</td>
                <td class="mobihide">60</td>
                <td><span class="label label-danger">Ended</span></td>
            </tr>
            <tr>
                <td class="mobihide">Samsung P3110 Tab</td>
                <td>GBP 56</td>
                <td class="mobihide">10</td>
                <td><span class="label label-danger">Ended</span></td>
            </tr>
            <tr>
                <td class="mobihide">Samsung Galaxy S3 (i9300)</td>
                <td>GBP 106.00</td>
                <td class="mobihide">45</td>
                <td><span class="label label-danger">Ended</span></td>
            </tr>
            </tbody>
        </table>
    </div>
</div>

<div class="ibox float-e-margins no_sub">
    <div class="ibox-title" style="background:none">
        <h5>Watch List</h5>
        <div class="ibox-tools">
            <a class="collapse-link">
                <i class="fa fa-chevron-up"></i>
            </a>
            <a class="close-link">
                <i class="fa fa-times"></i>
            </a>
        </div>
    </div>
    <div class="ibox-content" style="background:none">
        <table class="table table-hover no-margins">
            <thead>
            <tr>
                <th class="mobihide">Make &amp; Model</th>
                <th>Unit Price</th>
                <th class="mobihide">Qty</th>
                <th>Status</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td class="mobihide">Apple iPhone 5 64GB</td>
                <td>GBP 24.00</td>
                <td class="mobihide">100</td>
                <td><span class="label label-primary">Active</span></td>
            </tr>
            <tr>
                <td class="mobihide">Apple iPhone 6 16GB</td>
                <td>GBP 454.00</td>
                <td class="mobihide">46</td>
                <td><span class="label label-primary">Active</span></td>
            </tr>
            <tr>
                <td class="mobihide">BlackBerry 9720</td>
                <td>GBP 74.00</td>
                <td class="mobihide">34</td>
                <td><span class="label label-primary">Active</span></td>
            </tr>
            <tr>
                <td class="mobihide">Motorla Nexus 6 32GB</td>
                <td>GBP 355.00</td>
                <td class="mobihide">23</td>
                <td><span class="label label-primary">Active</span></td>
            </tr>
            <tr>
                <td class="mobihide">BlackBerry Z30</td>
                <td>GBP 165.00</td>
                <td class="mobihide">74</td>
                <td><span class="label label-primary">Active</span></td>
            </tr>
            <tr>
                <td class="mobihide">Sony Z3 Compact</td>
                <td>GBP 230</td>
                <td class="mobihide">60</td>
                <td><span class="label label-danger">Ended</span></td>
            </tr>
            <tr>
                <td class="mobihide">Samsung P3110 Tab</td>
                <td>GBP 56</td>
                <td class="mobihide">10</td>
                <td><span class="label label-danger">Ended</span></td>
            </tr>
            <tr>
                <td class="mobihide">Samsung Galaxy S3 (i9300)</td>
                <td>GBP 106.00</td>
                <td class="mobihide">45</td>
                <td><span class="label label-danger">Ended</span></td>
            </tr>
            </tbody>
        </table>
    </div>
</div>
</div>



</div>
</div>

<script>
$(document).ready(function() {
$(".dial").knob();
$('.chart').easyPieChart({
barColor: '#f8ac59',
//                scaleColor: false,
scaleLength: 5,
lineWidth: 4,
size: 80
});

$('.chart2').easyPieChart({
barColor: '#1c84c6',
//                scaleColor: false,
scaleLength: 5,
lineWidth: 4,
size: 80
});

var data2 = [
[gd(2012, 1, 1), 7], [gd(2012, 1, 2), 6], [gd(2012, 1, 3), 4], [gd(2012, 1, 4), 8],
[gd(2012, 1, 5), 9], [gd(2012, 1, 6), 7], [gd(2012, 1, 7), 5], [gd(2012, 1, 8), 4],
[gd(2012, 1, 9), 7], [gd(2012, 1, 10), 8], [gd(2012, 1, 11), 9], [gd(2012, 1, 12), 6],
[gd(2012, 1, 13), 4], [gd(2012, 1, 14), 5], [gd(2012, 1, 15), 11], [gd(2012, 1, 16), 8],
[gd(2012, 1, 17), 8], [gd(2012, 1, 18), 11], [gd(2012, 1, 19), 11], [gd(2012, 1, 20), 6],
[gd(2012, 1, 21), 6], [gd(2012, 1, 22), 8], [gd(2012, 1, 23), 11], [gd(2012, 1, 24), 13],
[gd(2012, 1, 25), 7], [gd(2012, 1, 26), 9], [gd(2012, 1, 27), 9], [gd(2012, 1, 28), 8],
[gd(2012, 1, 29), 5], [gd(2012, 1, 30), 8], [gd(2012, 1, 31), 25]
];

var data3 = [
[gd(2012, 1, 1), 800], [gd(2012, 1, 2), 500], [gd(2012, 1, 3), 600], [gd(2012, 1, 4), 700],
[gd(2012, 1, 5), 500], [gd(2012, 1, 6), 456], [gd(2012, 1, 7), 800], [gd(2012, 1, 8), 589],
[gd(2012, 1, 9), 467], [gd(2012, 1, 10), 876], [gd(2012, 1, 11), 689], [gd(2012, 1, 12), 700],
[gd(2012, 1, 13), 500], [gd(2012, 1, 14), 600], [gd(2012, 1, 15), 700], [gd(2012, 1, 16), 786],
[gd(2012, 1, 17), 345], [gd(2012, 1, 18), 888], [gd(2012, 1, 19), 888], [gd(2012, 1, 20), 888],
[gd(2012, 1, 21), 987], [gd(2012, 1, 22), 444], [gd(2012, 1, 23), 999], [gd(2012, 1, 24), 567],
[gd(2012, 1, 25), 786], [gd(2012, 1, 26), 666], [gd(2012, 1, 27), 888], [gd(2012, 1, 28), 900],
[gd(2012, 1, 29), 178], [gd(2012, 1, 30), 555], [gd(2012, 1, 31), 993]
];


var dataset = [
{
label: "Number of orders",
data: data3,
color: "#1ab394",
bars: {
show: true,
align: "center",
barWidth: 24 * 60 * 60 * 600,
lineWidth:0
}

}, {
label: "Payments",
data: data2,
yaxis: 2,
color: "#464f88",
lines: {
lineWidth:1,
show: true,
fill: true,
fillColor: {
colors: [{
opacity: 0.2
}, {
opacity: 0.2
}]
}
},
splines: {
show: false,
tension: 0.6,
lineWidth: 1,
fill: 0.1
},
}
];


var options = {
xaxis: {
mode: "time",
tickSize: [3, "day"],
tickLength: 0,
axisLabel: "Date",
axisLabelUseCanvas: true,
axisLabelFontSizePixels: 12,
axisLabelFontFamily: 'Arial',
axisLabelPadding: 10,
color: "#d5d5d5"
},
yaxes: [{
position: "left",
max: 1070,
color: "#d5d5d5",
axisLabelUseCanvas: true,
axisLabelFontSizePixels: 12,
axisLabelFontFamily: 'Arial',
axisLabelPadding: 3
}, {
position: "right",
clolor: "#d5d5d5",
axisLabelUseCanvas: true,
axisLabelFontSizePixels: 12,
axisLabelFontFamily: ' Arial',
axisLabelPadding: 67
}
],
legend: {
noColumns: 1,
labelBoxBorderColor: "#000000",
position: "nw"
},
grid: {
hoverable: false,
borderWidth: 0
}
};

function gd(year, month, day) {
return new Date(year, month - 1, day).getTime();
}

var previousPoint = null, previousLabel = null;

$.plot($("#flot-dashboard-chart"), dataset, options);

var mapData = {
"US": 298,
"SA": 200,
"DE": 220,
"FR": 540,
"CN": 120,
"AU": 760,
"BR": 550,
"IN": 200,
"GB": 120,
};
});
</script>

<?php } else {?>
<div class="row">
<?php 
$member_id = $member->id;

$this->session->set_userdata('curent_currency',$member->currency);

function getClassAttrForDiv($value){
    switch (true)
    {
        case $value < 0:
            return "danger";
            break;
        case $value > 0:
            return "success";
            break;
        default:
            return "info";
            break;
    }
}

function getClassAttrForArrow($value){
    switch (true)
    {
        case $value < 0:
            return "fa fa-level-down";
            break;
        case $value > 0:
            return "fa fa-level-up";
            break;
        default:
            return "fa fa-minus-square";
            break;
    }
}

?>
<div class="col-lg-3">

<div class="ibox float-e-margins">
<div class="ibox-title">
<span class="label label-success pull-right"><?=$durationStr?></span>
<h5>My Sales</h5>
</div>
<div class="ibox-content no_sub">
    <h1 class="no-margins">
        <?php echo $current_currency;
         echo $total_sales_price;
     ?> </h1>
<div class="stat-percent font-bold text-<?=getClassAttrForDiv($percent_sale_progress)?>"><?=$percent_sale_progress?>% <i class="<?=getClassAttrForArrow($percent_sale_progress)?>"></i></div>
<small>Total income</small>
</div>
</div>
</div>
<div class="col-lg-3">
<div class="ibox float-e-margins">
<div class="ibox-title">
<span class="label label-success pull-right"><?=$durationStr?></span>
<h5>My Purchases</h5>
</div>
<div class="ibox-content no_sub">
<h1 class="no-margins"><?php echo $current_currency; if(!empty($total_purchase_price)){ echo $total_purchase_price; }else{ echo '0'; } ?> </h1>
<div class="stat-percent font-bold text-info"><?=$percent_purchase_progress?>% <i class="<?=getClassAttrForArrow($percent_purchase_progress)?>"></i></div>
<small>My Purchases</small>
</div>
</div>
</div>
<div class="col-lg-3">
<div class="ibox float-e-margins">
<div class="ibox-title"> 
<!-- <a href="#"><span class="label label-success pull-right">Yearly</span></a> -->
<a href="#"><span class="label label-success pull-right"><?=$durationStr?></span></a>
<!-- <a href="#"><span class="label label-success pull-right">Daily</span></a> -->
<h5>My Profile Visits</h5>
</div>
<!--                            <div class="ibox-content" style="min-height:89px">
<h1 class="no-margins">0</h1>
<div class="stat-percent font-bold">0% <i class="fa fa-level-up"></i></div>
<small>New visits</small>
</div>-->
<?php
//$this->load->module('viewed');
//$this->viewed->view_month();
echo $profileViewsMarkup;

?>
</div>
</div>
<?php if($overall > 0) {?>
<div class="col-lg-3">
<?php if($overall >= 95){ ?>

<div class="ibox float-e-margins">
<div class="ibox-title">
    <span class="label label-success pull-right">Excellent Standing</span>
    <h5>My Rating</h5>
</div>
<div class="ibox-content" style="min-height:89px;padding:0 20px;text-align:center">
    <div class="m-r-md inline">                                            
            <input type="text" value="<?php echo $overall; ?>" class="dial m-r" data-fgColor="#1c84c6" data-width="85" data-height="85" data-angleOffset=-125 data-angleArc=250 readonly/>
    </div>
</div>
</div>

<?php } elseif($overall <= 94 && $overall >= 80) {?>

<div class="ibox float-e-margins">
<div class="ibox-title">
    <span class="label label-primary pull-right">Good Standing</span>
    <h5>My Rating</h5>
</div>
<div class="ibox-content" style="min-height:89px;padding:0 20px;text-align:center">
    <div class="m-r-md inline">                                            
            <input type="text" value="<?php echo $overall; ?>" class="dial m-r" data-fgColor="#1AB394" data-width="85" data-height="85" data-angleOffset=-125 data-angleArc=250 readonly/>
    </div>
</div>
</div>

<?php } elseif($overall <= 79 && $overall >= 51) { ?>

<div class="ibox float-e-margins">
<div class="ibox-title">
    <span class="label label-warning pull-right">Average Standing</span>
    <h5>My Rating</h5>
</div>
<div class="ibox-content" style="min-height:89px;padding:0 20px;text-align:center">
    <div class="m-r-md inline">                                            
            <input type="text" value="<?php echo $overall; ?>" class="dial m-r" data-fgColor="#f8ac59" data-width="85" data-height="85" data-angleOffset=-125 data-angleArc=250 readonly/>
    </div>
</div>
</div>

<?php } else {?>

<div class="ibox float-e-margins">
<div class="ibox-title">
    <span class="label label-danger pull-right">Poor Standing</span>
    <h5>My Rating</h5>
</div>
<div class="ibox-content" style="min-height:89px;padding:0 20px;text-align:center">
    <div class="m-r-md inline">                                            
        <input type="text" value="<?php echo $overall; ?>" class="dial m-r" data-fgColor="#ed5565" data-width="85" data-height="85" data-angleOffset=-125 data-angleArc=250 readonly/>
    </div>
</div>
</div>

<?php }?>                        
</div>
<?php } else {?>

<div class="col-lg-3">
<div class="ibox float-e-margins">
<div class="ibox-title">
    <span class="label pull-right">No Rating</span>
    <h5>My Rating</h5>
</div>
<div class="ibox-content" style="min-height:89px;padding:0 20px;text-align:center">
    <div class="m-r-md inline">                                            
        <input type="text" value="0" class="dial m-r" data-fgColor="#AAA" data-width="85" data-height="85" data-angleOffset=-125 data-angleArc=250 readonly/>
    </div>
</div>
</div>
</div>    

<?php }?>
</div>
<div class="row">
<div class="col-lg-12">
<div class="ibox float-e-margins">
<div class="ibox-title">
<h5>Orders</h5>
<div class="pull-right">
    <div class="btn-group">
        <?php

        foreach ( $durationsArray as $key => $value ){
            $active = ($durationStr == $key) ? "active" : "";
            echo "<a href='./?duration=$key' class='btn btn-xs btn-white $active'>$key</a>";
        }

        ?>
    </div>
</div>
</div>
<div class="ibox-content">
<div class="row">
<div class="col-lg-9">
    <div class="flot-chart">
        <div class="flot-chart-content" id="flot-dashboard-chart"></div>
    </div>
</div>
<div class="col-lg-3">
    <ul class="stat-list">
        <li>
            <h2 class="no-margins"><?=$ordersInPeriod?></h2>
            <small>Total sales orders in the period</small>
            <div class="stat-percent"><?=$ordersProgressInPeriod?>% <i class="<?=getClassAttrForArrow($ordersProgressInPeriod)?> text-navy"></i></div>
            <div class="progress progress-mini">
                <div style="width: <?=$ordersProgressInPeriod?>%;" class="progress-bar"></div>
            </div>
        </li>
        <li>
            <h2 class="no-margins "><?=$ordersInLastMonth?></h2>
            <small>Orders in last Month</small>
            <div class="stat-percent"><?=$ordersProgressInLastMonth?>% <i class="<?=getClassAttrForArrow($ordersProgressInLastMonth)?> text-navy"></i></div>
            <div class="progress progress-mini">
                <div style="width: <?=$ordersProgressInLastMonth?>%;" class="progress-bar"></div>
            </div>
        </li>
        <li>
            <h2 class="no-margins "><?=$monthlyIncome?></h2>
            <small>Monthly income from orders</small>
            <div class="stat-percent"><?=$percent_monthly_sale_progress?>% <i class="<?=getClassAttrForArrow($percent_monthly_sale_progress)?> text-navy"></i></div>
            <div class="progress progress-mini">
                <div style="width: <?=$percent_monthly_sale_progress?>%;" class="progress-bar"></div>
            </div>
        </li>
        </ul>
    </div>
</div>
</div>

</div>
</div>
</div>


<div class="row">

<?php

//$this->load->module('mailbox');
//$this->mailbox->mail_recent(10);

?>
<div id="status"></div>

 <div class="col-lg-8">
              <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>Buying Requests</h5>
            </div>
            <div class="ibox-content">
                <table class="table table-hover no-margins">
                    <thead>
                    <tr>
                        <th class="mobihide">Make</th>
                        <th>Model</th>
                        <th>Unit Price</th>
                        <th class="mobihide">Qty</th>
                        <th>Status</th>
                    </tr>
                    </thead>
                    <tbody>
                         <?php if(!empty($buying_requests)){ foreach ($buying_requests as  $buy_value) { ?> 
                        <tr>   
                        <td><?php if(!empty($buy_value->product_make)){ echo $buy_value->product_make; } ?></td>
                        <td><?php if(!empty($buy_value->product_model)){ echo $buy_value->product_model; } ?></td>
                        <td><?php if(!empty($buy_value->unit_price)){  echo currency_class($buy_value->currency);  echo $buy_value->unit_price; } ?></td>
                        <td><?php if(!empty($buy_value->qty_available)){ echo $buy_value->qty_available; } ?></td>
                        <td>
                         <?php $offer_count = offer_count($buy_value->id); ?>
                            <?php if($buy_value->member_id == $member_id){?>
                            <span class="label label-info">
                             <?php echo $offer_count; ?>Offers 
                            </span>
                            <?php } else{
                            echo"<span class='label label-warning'>Offers Sent</sapn>";
                            }?>
                        </td>
                        </tr>
                        <?php } } ?>
                    </tbody>
                </table>
            </div>
        </div>
        
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>Selling Offers</h5>
            </div>
            <div class="ibox-content">
                <table class="table table-hover no-margins">
                    <thead>
                    <tr>
                        <th class="mobihide">Make</th>
                        <th>Model</th>
                        <th>Unit Price</th>
                        <th class="mobihide">Qty</th>
                        <th>Status</th>
                    </tr>
                    </thead>
                    <tbody>
                        <?php if(!empty($selling_offers)){ foreach ($selling_offers as  $sell_value) { ?> 
                        <tr>   
                        <td><?php if(!empty($sell_value->product_make)){ echo $sell_value->product_make; } ?></td>
                        <td><?php if(!empty($sell_value->product_model)){ echo $sell_value->product_model; } ?></td>
                        <td><?php if(!empty($sell_value->unit_price)){ echo currency_class($sell_value->currency); echo $sell_value->unit_price; } ?></td>
                        <td><?php if(!empty($sell_value->qty_available)){ echo $sell_value->qty_available; } ?></td>
                        <td>
                            <?php $offer_count = offer_count($sell_value->id); ?>
                            <?php if($sell_value->member_id==$member_id){?>
                            <span class="label label-info">
                             <?php echo $offer_count; ?>Offers 
                            </span>
                            <?php } else{
                            echo"<span class='label label-warning'>Offers Sent</sapn>";
                            }?>

                        </td>
                        </tr>
                        <?php } } ?>
                    </tbody>
                </table>
            </div>
        </div>
        
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>Watch List</h5>
            </div>
            <div class="ibox-content">
                <table class="table table-hover no-margins">
                    <thead>
                    <tr>
                        <th class="mobihide">Make</th>
                        <th>Model</th>
                        <th>Unit Price</th>
                        <th class="mobihide">Qty</th>
                        <th>Status</th>
                    </tr>
                    </thead>
                    <tbody> 
                    <?php  if(!empty($watch_listing)){ foreach ($watch_listing as  $value) { ?> 
                    <tr>   
                         <td><?php if(!empty($value->product_make)){ echo $value->product_make; } ?></td>
                          <td><?php if(!empty($value->product_model)){ echo $value->product_model; } ?></td>
                          <td><?php if(!empty($value->unit_price)){ echo currency_class($value->currency); echo $value->unit_price; } ?></td>
                           <td><?php if(!empty($value->qty_available)){ echo $value->qty_available; } ?></td>
                           <td>
                               <?php  
                            $current_datetime = strtotime(date('d-m-Y H:i:s')); 
                            $end_datetime = strtotime(date('d-m-Y H:i:s', strtotime($value->listing_end_datetime))); 
                            $start_datetime = strtotime(date('d-m-Y H:i:s', strtotime($value->schedule_date_time))); 

                            if($current_datetime > $end_datetime){
                            ?> <span class="label label-danger">Ended</span><?php
                            } elseif($current_datetime >= $start_datetime){?>
                            <span class="label label-primary">Active</span>
                            <?php }else{ if($value->scheduled_status){ ?>
                            <span class="label label-success">Scheduled</span>
                            <?php }}?>

                           </td>

                    </tr>
                    <?php } } ?>
                    </tbody>
                </table>
            </div>
        </div>
        </div>
        
</div>
</div>

<script>
$(document).ready(function() {
$(".dial").knob();
var data2 = [
];

var data3 = [
];


var dataset = [
{
label: "Number of orders",
data: data3,
color: "#1ab394",
bars: {
show: true,
align: "center",
barWidth: 24 * 60 * 60 * 600,
lineWidth:0
}

}, {
label: "Payments",
data: data2,
yaxis: 2,
color: "#464f88",
lines: {
lineWidth:1,
show: true,
fill: true,
fillColor: {
colors: [{
opacity: 0.2
}, {
opacity: 0.2
}]
}
},
splines: {
show: false,
tension: 0.6,
lineWidth: 1,
fill: 0.1
},
}
];


var options = {
xaxis: {
mode: "time",
tickSize: [3, "day"],
tickLength: 0,
axisLabel: "Date",
axisLabelUseCanvas: true,
axisLabelFontSizePixels: 12,
axisLabelFontFamily: 'Arial',
axisLabelPadding: 10,
color: "#d5d5d5"
},
yaxes: [{
position: "left",
max: 1070,
color: "#d5d5d5",
axisLabelUseCanvas: true,
axisLabelFontSizePixels: 12,
axisLabelFontFamily: 'Arial',
axisLabelPadding: 3
}, {
position: "right",
clolor: "#d5d5d5",
axisLabelUseCanvas: true,
axisLabelFontSizePixels: 12,
axisLabelFontFamily: ' Arial',
axisLabelPadding: 67
}
],
legend: {
noColumns: 1,
labelBoxBorderColor: "#000000",
position: "nw"
},
grid: {
hoverable: false,
borderWidth: 0
}
};

function gd(year, month, day) {
return new Date(year, month - 1, day).getTime();
}

var previousPoint = null, previousLabel = null;

$.plot($("#flot-dashboard-chart"), dataset, options);

var mapData = {
"US": 298,
"SA": 200,
"DE": 220,
"FR": 540,
"CN": 120,
"AU": 760,
"BR": 550,
"IN": 200,
"GB": 120,
};
});
</script>
<?php }?>

<!-- Page Specific Scripts -->
<!-- Flot -->
<script src="public/main/template/core/js/plugins/flot/jquery.flot.js"></script>
<script src="public/main/template/core/js/plugins/flot/jquery.flot.tooltip.min.js"></script>
<script src="public/main/template/core/js/plugins/flot/jquery.flot.spline.js"></script>
<script src="public/main/template/core/js/plugins/flot/jquery.flot.resize.js"></script>
<script src="public/main/template/core/js/plugins/flot/jquery.flot.pie.js"></script>
<script src="public/main/template/core/js/plugins/flot/jquery.flot.symbol.js"></script>
<script src="public/main/template/core/js/plugins/flot/jquery.flot.time.js"></script>
<!-- jQuery UI -->
<script src="public/main/template/core/js/plugins/jquery-ui/jquery-ui.min.js"></script>

<!-- EayPIE -->
<script src="public/main/template/core/js/plugins/easypiechart/jquery.easypiechart.js"></script>

<script src="public/main/template/core/js/plugins/jsKnob/jquery.knob.js"></script>

<script type="text/javascript">

$(function() {

    getStatus();
    // Graph Implementation
    var barWidth = 0.3*24*60*60*1000;

    var saleOrders = {
        data: [],
        label: "Sale Orders",
        color: '#00bb96',
        bars: {
            align: "left",
            fill: true,
            fillColor: "#00bb96"
        }
    };

    var purchaseOrders = {
        data: [],
        label: "Purchase Orders",
        color: '#454488',
        bars: {
            align: "right",
            fill: true,
            fillColor: "#454488"
        }
    };

    <?php
    // get Data
    if( !empty($graphSalesOrders) ){
        foreach ( $graphSalesOrders as $key => $obj ){
            echo "saleOrders.data.push([".($obj->time*1000)." , {$obj->orders}]);";
        }
    }

    if( !empty($graphPurchaseOrders) ){
        foreach ( $graphPurchaseOrders as $key => $obj ){
            echo "purchaseOrders.data.push([".($obj->time*1000)." , {$obj->orders}]);";
        }
    }

    // x-axis min / max values
    $xAxisMin = 0;
    $xAxisMax = 0;
    $validDurations = $durationsArray;
    if(isset( $validDurations['Lifetime'] )) { unset( $validDurations['Lifetime'] ); }
    if( array_key_exists( $durationStr, $validDurations ) ){
        $xAxisMin = ( time() - $durationsArray[$durationStr] * 24 * 60 * 60 ) * 1000;
        $xAxisMax = time() * 1000;
    }

     ?>

    var data = [ saleOrders, purchaseOrders ];
    console.log(data);
    var options = {
        xaxis: {
            mode: "time",
            timeformat: "%b %d",
            autoscaleMargin: 1,
            tickLength : 0,
            <?= $xAxisMin ? "min: $xAxisMin," : ""; ?>
            <?= $xAxisMax ? "max: $xAxisMax," : ""; ?>
        },
        yaxis: {
            tickSize: 1,
            tickDecimals: 0
        },
        series: {
            bars: {
                show: true,
                barWidth: barWidth
            }
        },
        grid: {
            borderWidth: 0
        },
        legend: {
            position: 'nw'
        }
    };
    $("#flot-dashboard-chart").plot( data, options );

});

function getStatus() { 
    $('#status').load('<?php echo $base;?>mailbox/mail_recent/10');
    setTimeout("getStatus()",10000);
}

</script>