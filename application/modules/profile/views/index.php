<?php
//
//echo '<pre>';
//print_r($company_users);
//exit;
$this->load->model('membership/membership_model', 'membership_model');
$comp_member_count = count($company_users);

?>	
            
            <div class="row wrapper border-bottom white-bg page-heading">
                <div class="col-lg-10">
                    <h2>View Profile</h2>
                    <ol class="breadcrumb">
                        <li>
                            <a href="home">Home</a>
                        </li>
                        <li>
                            My Profile
                        </li>
                        <li class="active">
                            <strong>View Profile</strong>
                        </li>
                    </ol>
                </div><!-- /col-lg-10 -->
                <div class="col-lg-2"></div>
            </div>

<?php 	$id = $this->session->userdata('members_id');
		$member = $this->member_model->get_where($id);
		if($member->membership > 1){
?>
<?php } else { ?>
    <div class="alert alert-danger" style="margin:15px 15px -15px">
    <p><i class="fa fa-warning"></i> Attention <?php echo $this->session->userdata('firstname');?>! Your account is <strong>Unverified</strong>. You will be unable to access the live platform until you have submitted <a class="alert-link" href="tradereference">two (2) trade references</a> to become a verified member.</p>
    </div>
<?php } ?>
            
           <div class="row">
            <div class="col-lg-9">
                <div class="wrapper wrapper-content animated fadeInUp">
                    <div class="ibox">
                        <div class="ibox-content">
                        
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="m-b-md">
                                        <?php if($member_company->admin_member_id == $this->session->userdata('members_id')){?> 
                                            <a href="profile/edit_profile" class="btn btn-white btn-xs pull-right">Edit Profile</a>
                                        <?php }?>
                                            <div class="pull-right" style="margin-right: 5px;">
                                                <?php if($member_company->marketplace == 'active') {?>
                                            	<button type="button" class="btn btn-primary btn-xs" data-toggle="tooltip" data-placement="left" title="Your company has been verified by GSM Stock Market"><i class="fa fa-check"></i> Account Verified</button>
                                                <?php } else {?>
                                            	<a href="tradereference"><button type="button" class="btn btn-danger btn-xs" data-toggle="tooltip" data-placement="left" title="Your company has not yet supplied trade references or has been credited checked by GSM Stock Market"><i class="fa fa-times"></i> Unverified</button></a>
                                                <?php } ?>
                                            </div>
                                        <h2><?php echo $member_company->company_name;?></h2>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col-lg-6">
                            		<style>
										dl.full-width dt, dl.full-width dd {width:50%}
										dl.full-width dd {margin-left:51%}
									</style>
                                    
                              		<div class="m-r-md" style="text-align:center">
										<?php if(file_exists("public/main/template/gsm/images/company/".$member_company->id.".png")){?>
                                            <img src="public/main/template/gsm/images/company/<?php echo $member_company->id; ?>.png" class="img-responsive" style="margin:0 auto;max-height:150px">
                                        <?php } else {?>
                                            <img src="public/main/template/gsm/images/company/no_company.jpg" class="img-responsive" style="margin:0 auto;max-height:150px">
                                        <?php }?>
                            		</div>                                
                                        
                                    <dl class="dl-horizontal full-width" style="margin-top:20px">
                                        <dt>Company Number:</dt> 
                                        <dd><?php echo $member_company->company_number;?></dd>
                                        <dt>VAT/Tax Number:</dt> 
                                        <dd><?php echo $member_company->vat_tax;?></dd>
                                    </dl>  
                                                                      
                                    <dl class="dl-horizontal full-width">
                                        <dt>Address:</dt> <dd>  
                                            <?php echo $member_company->address_line_1;?><br/>
                                            <?php echo $member_company->address_line_2;?><br />
                                            <?php echo $member_company->town_city;?><br />
                                            <?php echo $member_company->county;?><br />
                                            <?php echo $member_company->post_code;?><br />
                                            <?php echo $this->country_model->get_where($member_company->country)->country;?></dd>
                                    </dl>
                                    
                                    <dl class="dl-horizontal full-width">                                    
                                        <dt>Phone Number:</dt>
                                        <dd>(<?php echo $this->country_model->get_where($member_company->dial_phone)->dial_code; ?>) <?php echo $member_company->phone_number?></dd>
                                    </dl>
                                    
                                    <dl class="dl-horizontal full-width">
                                        <dt>Primary Business:</dt>
                                        <dd><?php echo $member_company->business_sector_1;?></dd>
                                        <dt>Secondary Business:</dt>
                                        <dd><?php echo $member_company->business_sector_2;?></dd>
                                        <dt>Tertiary Business:</dt>
                                        <dd><?php echo $member_company->business_sector_3;?></dd>
                                        <dt>Other Activities:</dt>
                                        <dd><?php echo $member_company->other_business;?></dd>
                                    </dl>
                                    
                                </div>
                                <div class="col-lg-6" id="cluster_info">
                                	
                                    <dl class="dl-horizontal full-width" >
                                        <div style="margin-top:40px;text-align:center;margin-bottom:41px">
                                        <?php
                    
                                            $this->load->module('feedback');
                                            $this->feedback->member_feedback($member_info->id);
                                        
                                        ?>
                                        <div style="display:inline;height:65px;width:65px;padding:10px;margin-left:20px;"><i class="fa fa-star star-<?php echo $this->membership_model->get_where($member_info->membership)->membership;?>" class="star-" style="font-size:75px;vertical-align:top"></i></div>
                                    </div>
                                    
                                    <dl class="dl-horizontal full-width">
                                        <dt>Status:  </dt>
                                        <?php if($member_info->online_status == 'online') {?>
                                            <dd><span class="label label-primary">Online</span></dd>
                                        <?php } else { ?>
                                            <dd><span class="label label-danger">Offline</span></dd>
                                            <?php if($this->login_model->get_where_multiple('member_id', $member_info->id, 'logged', 'yes')) {?>
                                            <dt>Last Logged:  </dt>
                                            <dd><?php echo $this->login_model->get_where_multiple('member_id', $member_info->id, 'logged', 'yes')->date?></dd>
                                            <?php }?>
                                        <?php } ?>                                        
                                    </dl>
                                    
                                    <dl class="dl-horizontal full-width">
                                        <dt>Subscription:</dt> 
                                        <dd><?php echo $this->membership_model->get_where($member_info->membership)->membership;?> Member</dd>

                                        <dt>Member Since:</dt> <dd> <?php echo $member_info->date?></dd>
                                    </dl>
                                    
                                    <dl class="dl-horizontal full-width" >
                                        <dt>Facebook:</dt> 
                                        <dd> <?php echo $member_info->facebook?></dd>
                                        <dt>Twitter:</dt> 
                                        <dd> <?php echo $member_info->twitter?></dd>
                                        <dt>Google Plus:</dt>
                                        <dd> <?php echo $member_info->gplus?></dd>
                                        <dt>LinkedIn:</dt> 
                                        <dd> <?php echo $member_info->linkedin?></dd>
                                        <dt>Skype:</dt> 
                                        <dd> <?php echo $member_info->skype?></dd>
                                        
                                    </dl>
                                    
                                </div>
                                
                                <div class="col-lg-10 col-lg-offset-1">
                                    <h4>Company Bio</h4>
                                	<p style="margin-top:20px"><?php echo nl2br ($member_company->company_profile);?></p>
                                </div>
                                
                                
                            </div>
                            <div class="row m-t-sm">
                                <div class="col-lg-12">
                                <div class="panel blank-panel">
                                <div class="panel-heading">
                                    <div class="panel-options">
                                        <ul class="nav nav-tabs">
                                            <li class="active"><a href="#feedposts" data-toggle="tab">Feed Posts</a></li>
                                            <li class=""><a href="#feedback" data-toggle="tab">Feedback</a></li>
                                            <li class=""><a href="#selling-offers" data-toggle="tab">Selling Offers</a></li>
                                            <li class=""><a href="#buying-requests" data-toggle="tab">Buying Requests</a></li>
                                            <li class=""><a href="#credit-information" data-toggle="tab">Credit Info</a></li>
                                            <li class=""><a href="#events" data-toggle="tab">Events Attending</a></li>
                                            <?php if($comp_member_count > 1) {?>
                                                <li class=""><a href="#company_users" data-toggle="tab">Company Members</a></li>
                                            <?php } ?>
                                        </ul>
                                    </div>
                                </div>

                                <div class="panel-body">

                                <div class="tab-content">
                                <div class="tab-pane active" id="feedposts">
                                <?php
                                
                                    $this->load->module('feed');
                                    $this->feed->feed_list();
                                    $this->feed->post_feed();
                                ?>                                
                                </div>
                                
                                <div class="tab-pane" id="feedback">
                                <?php
                                
                                    $this->load->module('feedback');
                                    $this->feedback->feedback_list($this->session->userdata('members_id'));
                                ?>
                                </div>
                                
                                <div class="tab-pane no_sub" id="selling-offers">
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
                                        </tbody>
                                    </table>
                                </div>
                                <div class="tab-pane no_sub" id="buying-requests">
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
                                        </tbody>
                                    </table>
                                </div>
                                
                                <div class="tab-pane no_sub" id="credit-information">
                                    <div class="row">
                                        <div class="col-lg-12" style="text-align:center;margin:15px 0">
                                           <p>View your credit check information. Silver members and above only.</p>
                                        </div>
                                    </div>
                                	
                                </div>
                                    
                                <div class="tab-pane" id="events">
                                
                                    <?php
                                    
                                        $this->load->module('attending');
                                        $this->attending->attending_list($this->session->userdata('members_id'));
                                    ?>
                                    
                                </div>
                                    
                                <div class="tab-pane" id="company_users">
                                
                                   <?php

                                        foreach($company_users as $cu){
                                            if($cu->id != $this->session->userdata('members_id')){
                                    ?>

                                        <div class="feed-element">
                                            <a href="member/profile/<?php echo $cu->id; ?>" class="pull-left">
                <!--                                <img alt="image" class="img-circle" src="img/a1.jpg">-->
                                                <?php if(file_exists("public/main/template/gsm/images/members/".$cu->id.".png")){?>
                                                    <img alt="image" class="img-circle" src="<?php echo $base; ?>public/main/template/gsm/images/members/<?php echo $cu->id; ?>.png">
                                                <?php } else {?>
                                                    <img alt="image" class="img-circle" src="<?php echo $base; ?>public/main/template/gsm/images/members/no_profile.jpg">
                                                <?php }?>  
                                            </a>
                                            <div class="media-body">
                                                <b>Name:</b> <?php echo $this->member_model->get_where($cu->id)->title; ?> <?php echo $this->member_model->get_where($cu->id)->firstname; ?> <?php echo $this->member_model->get_where($cu->id)->lastname; ?>
                                                <br/>
                                                <b>Role:</b> <?php echo $this->member_model->get_where($cu->id)->role; ?>
                                                <br/>
                                                <b>Mobile:</b> <?php echo $this->member_model->get_where($cu->id)->mobile_number; ?>                                
                                            </div>
                                        </div>

                                    <?php
                                            }
                                            //echo $cu->id.'<br/>';
                                        }
                                    ?>
                                    
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
            <div class="col-lg-3">
                <div class="wrapper wrapper-content project-manager">
                    <h2>Company User</h2>
                    	<div class="m-r-md" style="text-align:center;margin-top:20px;margin-bottom:20px;">
                                                <?php if(file_exists("public/main/template/gsm/images/members/".$member_info->id.".png")){?>
                                                    <img alt="image" class="img-circle" style="width:30%" src="<?php echo $base; ?>public/main/template/gsm/images/members/<?php echo $member_info->id; ?>.png">
                                                <?php } else {?>
                                                    <img alt="image" class="img-circle" style="width:30%" src="<?php echo $base; ?>public/main/template/gsm/images/members/no_profile.jpg">
                                                <?php }?>  
                            		</div>
                                                                     
                                        
                                    <dl class="dl-horizontal full-width">
                                        <dt>Name:</dt> 
                                        <dd> <?php echo $member_info->title?> <?php echo $member_info->firstname?> <?php echo $member_info->lastname?></dd>
                                        <dt>Role:</dt> 
                                        <dd> <?php echo $member_info->role?></dd>
                                        <dt>Mobile Number:</dt> 
                                        <dd> <?php echo $member_info->mobile_number?></dd>
                                    </dl> 
                    
                </div>
            </div>
        </div>
        
        
        
        
        
                            <div class="modal inmodal fade" id="buycreditcheck" tabindex="-1" role="dialog"  aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                            <h4 class="modal-title">Credit Check</h4>
                                            <small class="font-bold">This transaction will generate a credit check for <?php echo $member_company->company_name; ?>.</small>
                                        </div>
                                        <div class="modal-body no_sub">
                                            <p>View company credit information. Unavailable</p>
                                        </div>

                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
                                            <button type="button" class="btn btn-primary">Confirm Purchase</button>
                                        </div>
                                    </div>
                                </div>
                            </div>        
                            
                            <div class="modal inmodal fade" id="report_user" tabindex="-1" role="dialog"  aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                            <h4 class="modal-title">Report this user!</h4>
                                            <small class="font-bold">Please fill in the form below to submit a report</small>
                                        </div>
                                        <div class="modal-body">
                                            <p><strong>Form to support service.</strong></p>
                                        </div>

                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
                                            <button type="button" class="btn btn-primary">Send Report</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
            
            
	<!-- Page Specific Scripts -->    
    
	<script src="public/main/template/core/js/plugins/jsKnob/jquery.knob.js"></script>
        
    <!-- Toastr script -->
    <script src="public/main/template/core/js/plugins/toastr/toastr.min.js"></script><!-- ALERTS -->
    
    <script type="text/javascript">
        $(function () {
                toastr.options = {
                    closeButton: false,
                    debug:false,
                    progressBar: false,
                    positionClass: 'toast-bottom-right',
                    onclick: null,
					showDuration: 400,
					hideDuration: 1000,
					timeOut: 7000,
					extendedTimeOut: 1000,
					showEasing: 'swing',
					hideEasing: 'linear',
					showMethod: 'fadeIn',
					hideMethod: 'fadeOut',
				};
            $('#contact_added').click(function (){
                toastr.success('This user has been added to your address book.', 'Contact Added');
            });
            $('#contact_removed').click(function (){
                toastr.error('This user has been removed from your address book.', 'Contact Removed');
            });
            $('#favourite_added').click(function (){
                toastr.success('This user has been added to your favourites.', 'Favourite Added');
            });
            $('#favourite_removed').click(function (){
                toastr.error('This user has been removed from your favourites.', 'Favourite Removed');
            });
            $('#blocked').click(function (){
                toastr.error('They are unable to communicate or see you in anyway on this website.', 'User Blocked!');
            });
            $('#unblocked').click(function (){
                toastr.success('You will now be visible to this user again and can communicate with them.', 'User Unblocked');
            });
            $('#conversation').click(function (){
                toastr.warning('Both users need to add each other as a contact before they can use GSM Messenger!', 'Chat Unavailable');
            });
        	$(".dial").knob();
        })
    </script>
    <script type="text/javascript">
		$(function() {
		if (window.location.hash.indexOf("reportuser/") !== -1) {
			$("#report_user").modal();
		}
		});
	</script>
            
            
            
            
            
        