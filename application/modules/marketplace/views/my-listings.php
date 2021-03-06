    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-12">
            <h2>My Listings</h2>
            <ol class="breadcrumb">
                <li><a href="/">Home</a></li>
                <li>Marketplace</li>
                <li class="active"><strong>My Listings</strong></li>
            </ol>
        </div>
    </div>

	<div class="wrapper wrapper-content animated fadeInRight">
    
    <?php 	$id = $this->session->userdata('members_id');
		$member = $this->member_model->get_where($id);
		if($member->membership < 2){
?>
    <div class="alert alert-danger">
    <p><i class="fa fa-warning"></i> Attention <?php echo $this->session->userdata('firstname');?>! Your account is <strong>Unverified</strong>. You will be unable to access the live platform until you have submitted <a class="alert-link" href="tradereference">two (2) trade references</a> to become a verified member.</p>
    </div>
<?php } else {?>
            <div class="alert alert-info">
                <p><i class="fa fa-warning"></i> Welcome to the <strong>GSM Marketplace v1.0a</strong>. Our marketplace is now live! If you have any issues or trouble using the marketplace please let us know by <a class="alert-link" href="support/submit_ticket">submitting a ticket</a> or if you have any ideas or feedback then <a class="alert-link" href="support/submit_ticket">let us know!</a></p>
            </div>

<?php } ?>
	<?php msg_alert(); ?>
		<div class="row">
			<div class="col-lg-12">
				<div class="ibox float-e-margins">
				<div class="ibox-title">
					<h5>Buying Requests (WTB)</h5>
                     <?php if($member->membership > 1){?>
                    <a href="marketplace/buy_listing/" class="pull-right btn btn-primary btn-xs" style="margin-right:8px"><i class="fa fa-plus"></i> Create WTB Listing</a>
                    <?php } ?>
				</div>
				<div class="ibox-content">
					<table class="table table-striped table-bordered table-hover selling_offers" >
                    <thead>
                    <tr>
                        <th>Status</th>
                        <th>Start Date</th>
                        <th>End Date</th>
                        <th>Make &amp; Model</th>
                        <th>Condition</th>
                        <th>Unit Price</th>
                        <th>QTY</th>
                        <th>Options</th>
                    </tr>
                    </thead>
                    <tbody>
<?php if(!empty($sell_offer)): $session_member_id = $this->session->userdata('members_id'); ?>
<?php foreach ($sell_offer as $value): $offer_count = offer_count($value->id); ?>
					<tr onclick="document.location = '<?php echo base_url().'marketplace/listing_detail/'.$value->id ?>';" style="cursor:pointer">
						<td class="text-center">
                            <?php require __DIR__."/snippets/get_status_of_the_listing.php" ?>
                        </td>
						<td><?php echo date('d-M, H:i', strtotime($value->schedule_date_time)); ?></td>
						<td><span <?php 
		$enddatetime = $value->listing_end_datetime;; 
		$current_date = date('d-m-Y H:i:s'); 
		$diff = abs(strtotime($current_date) - strtotime($enddatetime));
		$years   = floor($diff / (365*60*60*24)); 
		$months  = floor(($diff - $years * 365*60*60*24) / (30*60*60*24));  
		$days    = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));
		if($days <1){ echo "style='color:red!important'";}?>><?php echo date('d-M, H:i', strtotime($value->listing_end_datetime)); ?></span></td>
						<td><?php echo $value->product_make; ?> <?php echo $value->product_model; ?> <?php if ($value->device_capacity > 0) { ?><?php echo $value->device_capacity; ?><?php }?> <?php if ($value->spec > 0) { ?><?php echo $value->spec; ?><?php }?></td>
                        
        <td><?php echo $value->condition; ?></td>
        <td data-toggle="tooltip" data-placement="left" title="&pound; <?php echo get_currency(currency_class($value->currency), 'GBP', $value->unit_price); ?>,&euro; <?php echo get_currency(currency_class($value->currency), 'EUR', $value->unit_price); ?>,$ <?php echo get_currency(currency_class($value->currency), 'USD', $value->unit_price); ?>"><?php echo currency_class($value->currency); ?> <?php echo $value->unit_price; ?></td>
        <td <?php if ($value->qty_available == 0) { ?>style="color:red"<?php }?>><?php echo $value->qty_available; ?></td>
        <td class="text-center">

        <?php $listing_type = "buy_listing"; require __DIR__."/snippets/listing_options.php" ?>

        </td>
    </tr>
        
    <?php endforeach ?>
<?php endif; ?>
</tbody>
</table>
</div>
</div>
</div>
</div>   

<div class="row">
<div class="col-lg-12">
<div class="ibox float-e-margins">
<div class="ibox-title">
    <h5>Selling Offers (WTS)</h5>
                     <?php if($member->membership > 1){?>
    <a href="marketplace/sell_listing/" class="pull-right btn btn-primary btn-xs" style="margin-right:8px"><i class="fa fa-plus"></i> Create WTS Listing</a>
                    <?php } ?>
</div>
<div class="ibox-content">
<table class="table table-striped table-bordered table-hover buying_requests" >
<thead>
<tr>
    <th>Status</th>
    <th>Start Date</th>
    <th>End Date</th>
    <th>Make &amp; Model</th>
    <th>Condition</th>
    <th>Unit Price</th>
    <th>QTY</th>
    <th>Options</th>
</tr>
</thead>
<tbody>
 <?php if(!empty($buying_request)): ?>
    <?php foreach ($buying_request as $value):
     ?>
    <tr onclick="document.location = '<?php echo base_url().'marketplace/listing_detail/'.$value->id ?>';" style="cursor:pointer">
        <td class="text-center">
          <?php  
            $current_datetime = strtotime(date('d-m-Y H:i:s')); 
            $end_datetime = strtotime(date('d-m-Y H:i:s', strtotime($value->listing_end_datetime))); 
            $start_datetime = strtotime(date('d-m-Y H:i:s', strtotime($value->schedule_date_time))); 
           
            if($current_datetime > $end_datetime || $value->qty_available == 0){
                ?> <span class="label label-danger">Inactive</span><?php
            } elseif($current_datetime >= $start_datetime){?>
                <span class="label label-primary">Active</span>
       <?php }else{ if($value->scheduled_status){ ?>
                <span class="label label-success">Scheduled</span>
            <?php }}?>
        </td>
        <td><?php echo date('d-M, H:i', strtotime($value->created)); ?></td>
        
        
        <td><span <?php 
            $enddatetime = $value->listing_end_datetime;; 
            $current_date = date('d-m-Y H:i:s'); 
            $diff = abs(strtotime($current_date) - strtotime($enddatetime));
            $years   = floor($diff / (365*60*60*24)); 
            $months  = floor(($diff - $years * 365*60*60*24) / (30*60*60*24));  
            $days    = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));
            if($days <1){
              echo "style='color:red!important'";
            }
            ?>><?php echo date('d-M, H:i', strtotime($value->listing_end_datetime)); ?></span></td>
        <td><?php echo $value->product_make; ?> <?php echo $value->product_model; ?> <?php if ($value->device_capacity > 0) { ?><?php echo $value->device_capacity; ?><?php } ?> <?php if ($value->spec > 0) { ?><?php echo $value->spec; ?><?php }?></td>
        <td><?php echo $value->condition; ?></td>
        <td data-toggle="tooltip" data-placement="left" title="&pound; <?php echo get_currency(currency_class($value->currency), 'GBP', $value->unit_price); ?>,&euro; <?php echo get_currency(currency_class($value->currency), 'EUR', $value->unit_price); ?>,$ <?php echo get_currency(currency_class($value->currency), 'USD', $value->unit_price); ?>"><?php echo currency_class($value->currency); ?> <?php echo $value->unit_price; ?></td>
        <td <?php if ($value->qty_available == 0) { ?>style="color:red"<?php }?>><?php echo $value->qty_available; ?></td>
        <th class="text-center">

            <?php $listing_type = "sell_listing"; require __DIR__."/snippets/listing_options.php" ?>

        </th>
    </tr>
        
    <?php endforeach ?>
<?php endif; ?>
</tbody>
</table>
</div>
</div>
</div>     

</div> 
<?php /*

<div class="row">
<div class="col-lg-12">
<div class="ibox float-e-margins">
<div class="ibox-title">
    <h5>Saved Requests</h5>
</div>
<div class="ibox-content">
<table class="table table-striped table-bordered table-hover selling_offers" >
<thead>
<tr>
    <th>Listing Type</th>
    <th>MPN/ISBN</th>
    <th>Make &amp; Model</th>
    <th>Condition</th>
    <th>Color</th>
    <th>Unit Price</th>
    <th>QTY</th>
    <th>Options</th>
</tr>
</thead>
<tbody>
<?php if(!empty($saved_listing)): 
$session_member_id = $this->session->userdata('members_id'); ?>
    <?php foreach ($saved_listing as $value_save): ?>
     
    <tr>
        <td class="text-center">
         <?php if ($value_save->listing_type == 1): ?>
         <span class="label label-success">
            Buying Request
          </span>  
        <?php else: ?>  
        <span class="label label-warning">
           Selling Offers
        </span>   
        <?php endif ?> 
        </td>
        <td><?php echo $value_save->product_mpn_isbn; ?></td>
        <td><?php echo $value_save->product_make; ?> <?php echo $value_save->product_model; ?> </td>
        <td><?php echo $value_save->condition; ?></td>
        <td><?php echo $value_save->product_color; ?></td>
        <td data-toggle="tooltip" data-placement="left" title="&pound; <?php echo get_currency(currency_class($value_save->currency), 'GBP', $value_save->unit_price); ?>,&euro; <?php echo get_currency(currency_class($value_save->currency), 'EUR', $value_save->unit_price); ?>,$ <?php echo get_currency(currency_class($value_save->currency), 'USD', $value_save->unit_price); ?>"><?php echo currency_class($value_save->currency); ?> <?php echo $value_save->unit_price; ?></td>
        <td><?php echo $value_save->qty_available; ?></td>
        <th class="text-center">
        <?php 
        $date1 = strtotime(date('d-m-Y H:i:s', strtotime($value_save->listing_end_datetime))); 
        $date2 = strtotime(date('d-m-Y H:i:s')); 
         if($date1 > $date2){ ?>       
        
      <?php if ($value_save->listing_type == 1){ ?>    
      <a href="<?php echo base_url().'marketplace/buy_listing/'.$value_save->id.'/saved_listing'; ?>" class="btn btn-warning" style="font-size:10px"><i class="fa fa-paste"></i> Edit</a>
      <?php }else{ ?>
      <a href="<?php echo base_url().'marketplace/sell_listing/'.$value_save->id.'/saved_listing'; ?>" class="btn btn-warning" style="font-size:10px"><i class="fa fa-paste"></i> Edit</a>
      <?php } ?>
       <?php }else{?>
       <a class="btn btn-outline btn-danger" style="font-size:10px"><i class="fa fa-times"></i> Expired</a>
        <?php } ?>
       <a href="<?php echo base_url().'marketplace/listing_delete/'.$value_save->id; ?>" class="btn btn-danger" onclick="return confirm('Are your sure');" style="font-size:10px"><i class="fa fa-times"></i> Delete</a>
        </th>
    </tr>
        
    <?php endforeach ?>
<?php endif; ?>
</tbody>
</table>
</div>
</div>
</div>
</div>
*/ ?>
       
</div>


    <?php
    /**
     * Naveed: re-list-btn functionality
     *
     **/
    require_once __DIR__."/snippets/re-list-modal.php"
    ?>

<!-- Data Tables -->
<link href="public/main/template/core/css/plugins/dataTables/dataTables.bootstrap.css" rel="stylesheet">
<link href="public/main/template/core/css/plugins/dataTables/dataTables.responsive.css" rel="stylesheet">
<link href="public/main/template/core/css/plugins/dataTables/dataTables.tableTools.min.css" rel="stylesheet">
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
        $('.selling_offers').dataTable({
            responsive: true,
            "dom": 'T<"clear">lfrtip',
            "tableTools": {
                "sSwfPath": "public/main/template/core/js/plugins/dataTables/swf/copy_csv_xls_pdf.swf"
            }
        });
        $('.buying_requests').dataTable({
            responsive: true,
            "dom": 'T<"clear">lfrtip',
            "tableTools": {
                "sSwfPath": "public/main/template/core/js/plugins/dataTables/swf/copy_csv_xls_pdf.swf"
            }
        });
    });
</script>
    
<style>
body.DTTT_Print { background: #fff;}
.DTTT_Print #page-wrapper {margin: 0;background:#fff;}
button.DTTT_button, div.DTTT_button, a.DTTT_button {border: 1px solid #e7eaec;background: #fff;color: #676a6c;box-shadow: none;padding: 6px 8px;}
button.DTTT_button:hover, div.DTTT_button:hover, a.DTTT_button:hover {border: 1px solid #d2d2d2;background: #fff;color: #676a6c;box-shadow: none;padding: 6px 8px;}
.dataTables_filter label {margin-right: 5px;}
/*offer active class*/
#offer_status_accept{
background-color: #18a689;
border-color: #18a689;
color: #fff;
}
/*offer declined class*/
#offer_status_declined{
background-color: #ec4758;
border-color: #ec4758;
color: #fff;
}
</style>
<script src="public/admin/js/jquery.countdown.min.js"></script>
<script>
jQuery(document).ready(function($) {
    $('[data-countdown]').each(function() {
       var $this = $(this), finalDate = $(this).data('countdown');
       $this.countdown(finalDate, function(event) {
         $this.html(event.strftime('%Dd %Hh %Mm %Ss'));
       });
     });
    /**
    * Naveed: re-list-btn functionality
    *
    **/
    $(".re-list-btn").click(function () {
        $("#re_list_modal").find("form").attr( "action", $(this).data("action") );
//        alert("we'll show modal. don't worry.");
//        return false;
    });


});
 function get_buyers_offer(listing_id) {
    var list = listing_id;
       $.post('<?php echo base_url() ?>marketplace/get_buyers_offer', {listing_id: list}, function(data) {
           $('#buyers_list').html(data);
       });
    }
    function view_offer(listing_id) {
        var list = listing_id;
       $.post('<?php echo base_url() ?>marketplace/view_offer', {listing_id: list}, function(data) {
           $('#view_offer').html(data);
       });
    }
    function offer_status(listing_id, buyer_id) {
        var list = listing_id;
        var buyer_id = buyer_id;
       $.post('<?php echo base_url() ?>marketplace/offer_status', {listing_id: list, buyer_id: buyer_id}, function(data) {
           $('#offer_status_msg').html(data);
       });
    }
</script>
