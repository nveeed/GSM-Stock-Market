  <?php
  
//  echo '<pre>';
//  print_r($requests);
//  exit;
  
  ?>
  <div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-12">
      <h2>Report Requests</h2>
          <ol class="breadcrumb">
          <li><a href="/">Home</a></li>
          <li>Credit Data</li>
          <li class="active"><strong>Report Requests</strong></li>
        </ol>
    </div>
  </div>

  <?php 
    echo $this->session->flashdata('confirm');
  ?>
 <div class="wrapper wrapper-content animated fadeInRight">
 
<?php 	$id = $this->session->userdata('members_id');
		$member = $this->member_model->get_where($id);
		if($member->membership < 2){
?>
    <div class="alert alert-danger">
    <p><i class="fa fa-warning"></i> Attention <?php echo $this->session->userdata('firstname');?>! Your account is <strong>Unverified</strong>. You will be unable to access the live platform until you have submitted <a class="alert-link" href="tradereference">two (2) trade references</a> to become a verified member.</p>
    </div>
<?php } ?>
  
                <div class="row">
                <div class="col-lg-12">
                <div class="ibox">
                    <div class="ibox-title">
                        <h5>Companies Requesting your Credit Information</h5>
                    </div>
                    <div class="ibox-content"> 
                            <?php 
                                if($request_count > 0){
                            ?>
                            <table class="table table-striped table-bordered table-hover dataTables-example" >
                                <thead>
                                    <tr>
                                        <th>Date Requested</th>
                                        <th>Company Name</th>
                                        <th>Country</th>
                                        <th>Terms</th>
                                        <th>Options</th>
                                    </tr>
                                </thead>                        
                                <tbody>
                                <?php foreach ($requests as $request) {?>
                                    <?php if($request->awaiting_approval != 'yes'){?>
                                    <tr>
                                        <td><?php echo $request->date ;?></td>
                                        <td><?php echo $this->company_model->get_where($this->member_model->get_where($request->requester_id)->company_id)->company_name ;?></td>
                                        <td><?php echo $this->country_model->get_where($this->company_model->get_where($this->member_model->get_where($request->requester_id)->company_id)->country)->country ;?></td>
                                        <?php if($request->request_type == 'both'){ ?>
                                            <td>My report in return</td>
                                        <?php } else {?>
                                            <td>Your report only</td>
                                        <?php } ?>

                                        <td class="text-center">
                                                <a href="creditdata/acceptRequest/<?php echo $request->id;?>/<?php echo $request->request_id;?>/<?php echo $request->requester_id;?>"><button class="btn btn-primary" style="font-size:10px"><i class="fa fa-check"></i> Accept</button></a> 
                                                <a href="creditdata/declineRequest/<?php echo $request->id;?>/<?php echo $request->request_id;?>/<?php echo $request->requester_id;?>"><button class="btn btn-danger" style="font-size:10px"><i class="fa fa-times"></i> Decline</button></a>
                                                <a href="member/profile/<?php echo $request->requester_id;?>"><button class="btn btn-success" style="font-size:10px"><i class="fa fa-user"></i> View Profile</button></a>
                                        </td>
                                    </tr>
                                    <?php } ?>
                                <?php } ?>
                                </tbody>
                            </table>
                            <?php } else {?>
                            <table class="table table-striped table-bordered table-hover" >
                                <thead>
                                    <tr>
                                        <th>Date Requested</th>
                                        <th>Company Name</th>
                                        <th>Country</th>
                                        <th>Terms</th>
                                        <th>Options</th>
                                    </tr>
                                </thead>                        
                                <tbody>
                                    <tr>
                                        <td colspan="6"> There are no credit request at present</td>
                                    </tr>
                                </tbody>
                            </table> 
                            <?php } ?>
                    </div>
                </div>
            </div>
        </div>          
 </div><!-- /Wrapper -->
 
 
 <?php /* STATIC FOR BRONZE - DIPO IGNORE
  <div class="wrapper wrapper-content animated fadeInRight">
  
                <div class="row">
                <div class="col-lg-12">
                <div class="ibox">
                    <div class="ibox-title">
                        <h5>Credit Reports Available</h5>
                    </div>
                    <div class="ibox-content">                        
                        <table class="table table-striped table-bordered table-hover dataTables-example" >
                        <thead>
                        <tr>
                            <th>Date Requested</th>
                            <th>Company Name</th>
                            <th>Country</th>
                            <th>Options</th>
                        </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>12 April 2015</td>
                                <td>GSMStockMarket.com Limited</td>
                                <td>United Kingdom</td>
                                <td class="text-center">
                                	<a target="_blank" class="label label-warning" href="">View Report</a> 
                                    <a target="_blank" class="label label-info" download href="">Download Report</a> 
                                    <a class="label label-primary" href="">View Profile</a>
                                </td>
                            </tr>
                        </tbody>
                    </table>                       
                    

                    </div>


                    
                    
                    
                </div>
            </div>
            </div>
          
 </div><!-- /Wrapper -->
 */ ?>
  

<!-- Data Tables -->
<link href="public/main/template/core/css/plugins/dataTables/dataTables.bootstrap.css" rel="stylesheet">
<link href="public/main/template/core/css/plugins/dataTables/dataTables.responsive.css" rel="stylesheet">
<link href="public/main/template/core/css/plugins/dataTables/dataTables.tableTools.min.css" rel="stylesheet">
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

<!-- Data Tables -->
<script type="text/javascript" src="public/main/template/core/js/plugins/dataTables/jquery.dataTables.js"></script>
<script type="text/javascript" src="public/main/template/core/js/plugins/dataTables/dataTables.bootstrap.js"></script>
<script type="text/javascript" src="public/main/template/core/js/plugins/dataTables/dataTables.responsive.js"></script>
<script type="text/javascript" src="public/main/template/core/js/plugins/dataTables/dataTables.tableTools.min.js"></script>


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
});
</script>