<!DOCTYPE html>
<html lang="en">
<head>
    
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>The worlds best B2B mobile phone trading platform, trade with anyone at a click of a button - GSMStockMarket.com</title>

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" type="text/css" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css" media="screen" />  

    <!-- Animation CSS -->
    <link rel="stylesheet" href="/public/main/template/frontend/css/animate.min.css"/>

    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css"/>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <!-- Custom styles -->  
    <link rel="stylesheet" type="text/css" href="/public/main/template/frontend/css/style.css" media="screen" />
    
    <!-- checkbox css -->
    <link href="/public/main/template/core/css/plugins/iCheck/custom.css" rel="stylesheet">
    
    <!-- Icons -->    
    <link href="/public/main/template/gsm/images/icons/favicon.png" rel="shortcut icon" type="image/x-icon" />
	<link href="/public/main/template/gsm/images/icons/apple-touch-icon-180x180.png" rel="apple-touch-icon" sizes="180x180" />
	<link href="/public/main/template/gsm/images/icons/icon-hires.png" rel="icon" sizes="192x192" />



</head>
<html>

<body>

<header>

    <div id="tiny-menu-wrapper">
    	<div class="container">
        <ul class="mini">
        	<li>
        	<a class="page-scroll" href="#contact">Contact <i class="glyphicon glyphicon-envelope"></i></a>
            </li>
        	<li>
        	<a href="https://secure.gsmstockmarket.com/login">Login <i class="glyphicon glyphicon-user"></i></a>
            </li>
        </ul>
        </div>
    </div><!-- /tiny-menu-wrapper -->
    
    <!-- Navigation -->
    <div id="nav-bar">
    <nav class="navbar navbar-default" role="navigation">
        <div class="container">
        	<div class="col-md-12">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="pull-left" href="#">
                    <img src="/public/main/template/gsm/images/gsm.png" height="76" width="251" alt="Navi GSM Logo" />
                </a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
			<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-right">
                    <li><a class="page-scroll" href="http://www.gsmstockmarket.com#services">About</a></li>
                   	<li><a data-toggle="modal" data-target="#intro" style="cursor:pointer">Video</a></li>
                    <li><a class="page-scroll" href="http://www.gsmstockmarket.com#events">Events</a></li>
                    <li><a class="page-scroll" href="#contact">Get in Touch</a></li>
                    <li><a href="https://secure.gsmstockmarket.com/join">Sign Up</a></li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
            </div>
        </div>
        <!-- /.container -->
    </nav>
    </div>
        
</header>


<?php
//echo '<pre>';
//print_r($country);
//exit;
//echo "<pre>";
//print_r($company);
//echo "</pre>";
?>





<div class="container">
<div class="space">
						  <?php
          $attributes = array('class' => 'form-horizontal validation');
          echo form_open('join/profileCreate', $attributes);
          ?>
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h2>Company Details</h2>
                </div>
                <div class="ibox-content">
                    <?php
                    $title = $this->session->flashdata('register_title');

                    if ($title == 'registered_not_activated' || $title == 'registered_activated') {

                        echo '<div class="alert alert-warning">' . $this->session->flashdata('message') . '</div>';
                    }

                    ?>

                    <div class="form-group"><label class="col-md-3 control-label">Company Name <span style="color:red">*</span></label>
						<div class="col-md-9">
                            <input type="text" class="form-control" name="company_name" placeholder="What is the name of your company?" required>
                            <div id="company_name_error" class="error_text"></div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-3 control-label">Company Number</label>
						<div class="col-md-9">
                            <input type="text" class="form-control" name="company_number" placeholder="Enter your company's registered number">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-3 col-md-4 control-label">VAT/Tax Number</label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" name="vat_tax" placeholder="Enter your VAT/Tax number e.g GB 0123 920">
                            <div id="tax_vat_error" class="error_text"></div>
                        </div>
                    </div>

                    <div class="hr-line-dashed"></div>

                    <div class="form-group">
                        <label class="col-md-3 control-label">Address Line 1 <span style="color:red">*</span></label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" name="address_line_1" placeholder="What street name does your company operate from?" required>
                            <div id="address_line_1_error" class="error_text"></div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-3 control-label">Address Line 2</label>

                        <div class="col-md-9">
                            <input type="text" class="form-control" name="address_line_2" placeholder="Enter any additional addres information">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-3 control-label">Town/City <span style="color:red">*</span></label>

                        <div class="col-md-9">
                            <input type="text" class="form-control" name="town_city" placeholder="What Town or City does your company operate from?" required>
                            <div id="town_city_error" class="error_text"></div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-3 control-label">County/State <span style="color:red">*</span></label>

                        <div class="col-md-9">
                            <input type="text" class="form-control" name="county" placeholder="What County/State does your company operate from?" required>
                            <div id="county_error" class="error_text"></div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-3 control-label">Postal/Zip Code</label>

                        <div class="col-md-9">
                            <input type="text" class="form-control" name="post_code" placeholder="If you have a Postal/Zip code please enter it here">
                        </div>
                    </div>

                    <div class="form-group"><label class="col-md-3 control-label">Country <span style="color:red">*</span></label>
                        <div class="col-md-9">
                            <?php
                            $this->load->module('country');
                            $this->country->select_country();
                            ?>
                            <div id="country_error" class="error_text"></div>
                        </div>
                    </div>
                    
                    <div class="form-group"><label class="col-md-3 control-label">Currency <span style="color:red">*</span></label>
                        <div class="col-md-3" style="padding-right:0">
                            <select class="form-control" name="currency">
                                <option value="GBP" selected>Sterling (GBP) &pound;</option>
                                <option value="USD">Dollar (USD) $</option>
                                <option value="EURO">Euro (EURO) &euro;</option>                                                                   
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-3 control-label">Landline Phone Number <span style="color:red">*</span></label>

                        <div class="col-md-3" style="padding-right:0">
                            <?php
                            $this->load->module('country');
                            $this->country->select_phone();
                            ?>
                            <div id="phone_number_error" class="error_text"></div>
                        </div>
                        <div class="col-md-6">
                            <input type="text" class="form-control" name="telephone_number" required>
                            <div id="telephone_number_error" class="error_text"></div>
                        </div>
                    </div>

                    <?php
                    //$other_business = explode(',', $company->other_business);
                    //$other_business1 = isset($other_business[0]) ? trim($other_business[0]) : '';
                    //$other_business2 = isset($other_business[1]) ? trim($other_business[1]) : '';

                    //                    echo "<pre>";
                    //                    print_r($company);
                    //                    echo "</pre>";
                    ?>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Business Sectors <span style="color:red">*</span><br/>
                            <small class="text-navy">Select up to 5</small>
                        </label>

                        <div class="col-md-4">
                            <div class="checkbox i-checks"><label>
                                    <input <?php echo (isset($company->business_sector_1) && ($company->business_sector_1 == 'New Mobiles (Sim Free)' || $company->business_sector_2 == 'New Mobiles (Sim Free)' || $company->business_sector_3 == 'New Mobiles (Sim Free)' || $other_business1 == 'New Mobiles (Sim Free)' || $other_business2 == 'New Mobiles (Sim Free)')) ? 'checked="checked"' : '' ?>
                                        type="checkbox" value="New Mobiles (Sim Free)" name="bsectors[]" id="bsectors1"
                                        class='business_cycle'> <i></i> New Mobiles (Sim Free) </label></div>
                            <div class="checkbox i-checks"><label>
                                    <input <?php echo (isset($company->business_sector_1) && ($company->business_sector_1 == 'New Mobiles (Network Stocks)' || $company->business_sector_2 == 'New Mobiles (Network Stocks)' || $company->business_sector_3 == 'New Mobiles (Network Stocks)' || $other_business1 == 'New Mobiles (Network Stocks)' || $other_business2 == 'New Mobiles (Network Stocks)')) ? 'checked="checked"' : '' ?>
                                        type="checkbox" value="New Mobiles (Network Stocks)" name="bsectors[]"
                                        id="bsectors2" class='business_cycle'> <i></i> New Mobiles (Network Stocks)
                                </label></div>
                            <div class="checkbox i-checks"><label>
                                    <input <?php echo (isset($company->business_sector_1) && ($company->business_sector_1 == '14 Day Mobiles' || $company->business_sector_2 == '14 Day Mobiles' || $company->business_sector_3 == '14 Day Mobiles' || $other_business1 == '14 Day Mobiles' || $other_business2 == '14 Day Mobiles')) ? 'checked="checked"' : '' ?>
                                        type="checkbox" value="14 Day Mobiles" name="bsectors[]" id="bsectors3"
                                        class='business_cycle'> <i></i> 14 Day Mobiles </label></div>
                            <div class="checkbox i-checks"><label>
                                    <input <?php echo (isset($company->business_sector_1) && ($company->business_sector_1 == 'Refurbished Mobiles' || $company->business_sector_2 == 'Refurbished Mobiles' || $company->business_sector_3 == 'Refurbished Mobiles' || $other_business1 == 'Refurbished Mobiles' || $other_business2 == 'Refurbished Mobiles')) ? 'checked="checked"' : '' ?>
                                        type="checkbox" value="Refurbished Mobiles" name="bsectors[]" id="bsectors4"
                                        class='business_cycle'> <i></i> Refurbished Mobiles </label></div>
                            <div class="checkbox i-checks"><label>
                                    <input <?php echo (isset($company->business_sector_1) && ($company->business_sector_1 == 'Used Mobiles' || $company->business_sector_2 == 'Used Mobiles' || $company->business_sector_3 == 'Used Mobiles' || $other_business1 == 'Used Mobiles' || $other_business2 == 'Used Mobiles')) ? 'checked="checked"' : '' ?>
                                        type="checkbox" value="Used Mobiles" name="bsectors[]" id="bsectors5"
                                        class='business_cycle'> <i></i> Used Mobiles </label></div>
                            <div class="checkbox i-checks"><label>
                                    <input <?php echo (isset($company->business_sector_1) && ($company->business_sector_1 == 'BER Mobiles' || $company->business_sector_2 == 'BER Mobiles' || $company->business_sector_3 == 'BER Mobiles' || $other_business1 == 'BER Mobiles' || $other_business2 == 'BER Mobiles')) ? 'checked="checked"' : '' ?>
                                        type="checkbox" value="BER Mobiles" name="bsectors[]" id="bsectors6"
                                        class='business_cycle'> <i></i> BER Mobiles </label></div>
                            <div class="checkbox i-checks"><label>
                                    <input <?php echo (isset($company->business_sector_1) && ($company->business_sector_1 == 'Mobile Accessories' || $company->business_sector_2 == 'Mobile Accessories' || $company->business_sector_3 == 'Mobile Accessories' || $other_business1 == 'Mobile Accessories' || $other_business2 == 'Mobile Accessories')) ? 'checked="checked"' : '' ?>
                                        type="checkbox" value="Mobile Accessories" name="bsectors[]" id="bsectors7"
                                        class='business_cycle'> <i></i> Mobile Accessories </label></div>
                            <div class="checkbox i-checks"><label>
                                    <input <?php echo (isset($company->business_sector_1) && ($company->business_sector_1 == 'Wearable Technology' || $company->business_sector_2 == 'Wearable Technology' || $company->business_sector_3 == 'Wearable Technology' || $other_business1 == 'Wearable Technology' || $other_business2 == 'Wearable Technology')) ? 'checked="checked"' : '' ?>
                                        type="checkbox" value="Wearable Technology" name="bsectors[]" id="bsectors8"
                                        class='business_cycle'> <i></i> Wearable Technology </label></div>
                            <div class="checkbox i-checks"><label>
                                    <input <?php echo (isset($company->business_sector_1) && ($company->business_sector_1 == 'Bluetooth Products' || $company->business_sector_2 == 'Bluetooth Products' || $company->business_sector_3 == 'Bluetooth Products' || $other_business1 == 'Bluetooth Products' || $other_business2 == 'Bluetooth Products')) ? 'checked="checked"' : '' ?>
                                        type="checkbox" value="Bluetooth Products" name="bsectors[]" id="bsectors9"
                                        class='business_cycle'> <i></i> Bluetooth Products </label></div>
                            <div class="checkbox i-checks"><label>
                                    <input <?php echo (isset($company->business_sector_1) && ($company->business_sector_1 == 'Mobile Spare Parts' || $company->business_sector_2 == 'Mobile Spare Parts' || $company->business_sector_3 == 'Mobile Spare Parts' || $other_business1 == 'Mobile Spare Parts' || $other_business2 == 'Mobile Spare Parts')) ? 'checked="checked"' : '' ?>
                                        type="checkbox" value="Mobile Spare Parts" name="bsectors[]" id="bsectors10"
                                        class='business_cycle'> <i></i> Mobile Spare Parts </label></div>
                            <div class="checkbox i-checks"><label>
                                    <input <?php echo (isset($company->business_sector_1) && ($company->business_sector_1 == 'Mobile Service and Repair Centre' || $company->business_sector_2 == 'Mobile Service and Repair Centre' || $company->business_sector_3 == 'Mobile Service and Repair Centre' || $other_business1 == 'Mobile Service and Repair Centre' || $other_business2 == 'Mobile Service and Repair Centre')) ? 'checked="checked"' : '' ?>
                                        type="checkbox" value="Mobile Service and Repair Centre" name="bsectors[]"
                                        id="bsectors11" class='business_cycle'> <i></i> Mobile Service and Repair Centre
                                </label></div>
                            <div class="checkbox i-checks"><label>
                                    <input <?php echo (isset($company->business_sector_1) && ($company->business_sector_1 == 'Network Operator' || $company->business_sector_2 == 'Network Operator' || $company->business_sector_3 == 'Network Operator' || $other_business1 == 'Network Operator' || $other_business2 == 'Network Operator')) ? 'checked="checked"' : '' ?>
                                        type="checkbox" value="Network Operator" name="bsectors[]" id="bsectors12"
                                        class='business_cycle'> <i></i> Network Operator </label></div>
                            <div class="checkbox i-checks"><label>
                                    <input <?php echo (isset($company->business_sector_1) && ($company->business_sector_1 == 'Freight Forwarding' || $company->business_sector_2 == 'Freight Forwarding' || $company->business_sector_3 == 'Freight Forwarding' || $other_business1 == 'Freight Forwarding' || $other_business2 == 'Freight Forwarding')) ? 'checked="checked"' : '' ?>
                                        type="checkbox" value="Freight Forwarding" name="bsectors[]" id="bsectors13"
                                        class='business_cycle'> <i></i> Freight Forwarding </label></div>
                            <div class="checkbox i-checks"><label>
                                    <input <?php echo (isset($company->business_sector_1) && ($company->business_sector_1 == 'Insurance' || $company->business_sector_2 == 'Insurance' || $company->business_sector_3 == 'Insurance' || $other_business1 == 'Insurance' || $other_business2 == 'Insurance')) ? 'checked="checked"' : '' ?>
                                        type="checkbox" value="Insurance" name="bsectors[]" id="bsectors14"
                                        class='business_cycle'> <i></i> Insurance </label></div>
                            <div class="checkbox i-checks"><label>
                                    <input <?php echo (isset($company->business_sector_1) && ($company->business_sector_1 == 'Tablets' || $company->business_sector_2 == 'Tablets' || $company->business_sector_3 == 'Tablets' || $other_business1 == 'Tablets' || $other_business2 == 'Tablets')) ? 'checked="checked"' : '' ?>
                                        type="checkbox" value="Tablets" name="bsectors[]" id="bsectors15"
                                        class='business_cycle'> <i></i> Tablets </label></div>
                            <div class="checkbox i-checks"><label>
                                    <input <?php echo (isset($company->business_sector_1) && ($company->business_sector_1 == 'Sim Cards' || $company->business_sector_2 == 'Sim Cards' || $company->business_sector_3 == 'Sim Cards' || $other_business1 == 'Sim Cards' || $other_business2 == 'Sim Cards')) ? 'checked="checked"' : '' ?>
                                        type="checkbox" value="Sim Cards" name="bsectors[]" id="bsectors16"
                                        class='business_cycle'> <i></i> Sim Cards </label></div>
                        </div>

                        <div class="col-md-4">
                            <div id="bsector_error" class="error_text"></div>
                            <div id="primary-business">

                                <?php
                                $SelectedBiz = array();
                                $SelectedBiz[] = '';
                                $SelectedBiz[] = '';
                                $SelectedBiz[] = '';
                                $SelectedBiz[] = '';
                                $SelectedBiz[] = '';
                                ?>
                                <label class="col-md-12">Primary Business <span style="color:red">*</span></label>

                                <select class="form-control m-b bsnssector" required="required" id="bprimary" name="bprimary" style="float:left" onchange="updateSelects1(this.value)">
                                    <?php
                                    if (isset($company->business_sector_1)) {
                                        foreach ($SelectedBiz As $SelectedBizOne) {
                                            ?>
                                            <option
                                                value="<?php echo $SelectedBizOne; ?>" <?php echo (isset($SelectedBizOne) && ($SelectedBizOne == $company->business_sector_1)) ? ' selected="selected"' : ''; ?> ><?php echo $SelectedBizOne; ?></option>
                                        <?php
                                        }
                                        ?>


                                    <?php } else { ?>
                                        <option value="">[Select One]</option>
                                    <?php } ?>
                                </select>


                            </div>

                            <div id="secondary-business">


                                <label class="col-md-12">Secondary Business <span style="color:red">*</span></label>
                                <select class="form-control m-b bsnssector" required="required" name="bsecondary" id="bsecondary"
                                        style="float:left"
                                        onchange="updateSelects2(this.value)">
                                    <?php
                                    if (isset($company->business_sector_2)) {
                                        foreach ($SelectedBiz As $SelectedBizOne) {
                                            ?>
                                            <option
                                                value="<?php echo $SelectedBizOne; ?>" <?php echo isset($SelectedBizOne) && ($SelectedBizOne == $company->business_sector_2) ? ' selected="selected"' : ''; ?> ><?php echo $SelectedBizOne; ?></option>
                                        <?php
                                        }
                                    } else {
                                        ?>
                                        <option value="">[Select One]</option>
                                    <?php } ?>
                                </select>


                            </div>

                            <div id="tertiary-business">
                                <label class="col-md-12">Tertiary Business <span style="color:red">*</span></label>
                                <select class="form-control m-b bsnssector" required="required" name="btertiary" id="btertiary"
                                        style="float:left"
                                        onchange="updateSelects3(this.value)">
                                    <?php
                                    if (isset($company->business_sector_3)) {
                                        foreach ($SelectedBiz As $SelectedBizOne) {
                                            ?>
                                            <option
                                                value="<?php echo $SelectedBizOne; ?>" <?php echo isset($SelectedBizOne) && ($SelectedBizOne == $company->business_sector_3) ? ' selected="selected"' : ''; ?> ><?php echo $SelectedBizOne; ?></option>

                                        <?php
                                        }
                                    } else {
                                        ?>
                                        <option value="">[Select One]</option>
                                    <?php } ?>
                                </select>
                            </div>


                            <small class="text-navy" id="selectMessage">Please make sure you select in order of actual
                                business relevance as this will affect search results and our dedicated account managers
                                will actively promote your business on your behalf with other suitable companies.
                            </small>
                        </div>
                    </div>


                    <input type="hidden" name="primary_sector" id="primary_sector" value=""/>
                    <input type="hidden" name="secondary_sector" id="secondary_sector" value=""/>
                    <input type="hidden" name="tertiary_sector" id="tertiary_sector" value=""/>

                    <div class="hr-line-dashed"></div>

                    <div class="form-group">
                        <label class="col-md-3 control-label">Website</label>

                        <div class="col-md-9">
                            <div class="input-group m-b"><span class="input-group-addon"><i
                                        class="fa fa-globe"></i></span>
                                <input type="text" class="form-control" name="website" type="url">
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-3 control-label">Skype</label>

                        <div class="col-md-9">
                            <div class="input-group m-b"><span class="input-group-addon"><i
                                        class="fa fa-skype"></i></span>
                                <input type="text" class="form-control" name="skype">
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-3 control-label">Facebook</label>

                        <div class="col-md-9">
                            <div class="input-group m-b"><span class="input-group-addon"><i class="fa fa-facebook"></i></span>
                                <input type="text" class="form-control" name="facebook">
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-3 control-label">Twitter</label>

                        <div class="col-md-9">
                            <div class="input-group m-b"><span class="input-group-addon"><i
                                        class="fa fa-twitter"></i></span>
                                <input type="text" class="form-control" name="twitter">
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-3 control-label">Linkedin</label>

                        <div class="col-md-9">
                            <div class="input-group m-b"><span class="input-group-addon"><i class="fa fa-linkedin"></i></span>
                                <input type="text" class="form-control" name="linkedin">
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-3 control-label">Google +</label>

                        <div class="col-md-9">
                            <div class="input-group m-b"><span class="input-group-addon"><i
                                        class="fa fa-google-plus"></i></span>
                                <input type="text" class="form-control" name="gplus">
                            </div>
                        </div>
                    </div>

                    <div class="hr-line-dashed"></div>


                    <div class="form-group">
                        <label class="col-md-3 col-md-4 control-label">Company Bio</label>

                        <div class="col-md-9">
                            <textarea class="form-control" name="company_profile" id="companybio" rows="5"></textarea>

                            <div id="charNum"></div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h2>Personal Details</h2>
                </div>
                <div class="ibox-content form-horizontal">
                    <div class="form-group"><label class="col-md-3 control-label">Title <span style="color:red">*</span></label>

                        <div class="col-md-2">
                            <select class="form-control" name="title">
                                <option value="Mr." selected>Mr.</option>
                                <option value="Mrs.">Mrs.</option>
                                <option value="Miss.">Miss.</option>
                                <option value="Ms.">Ms.</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-3 control-label">First Name <span style="color:red">*</span></label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" name="firstname" required>
                            <div id="firstname_error" class="error_text"></div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-3 control-label">Last Name <span style="color:red">*</span></label>
                        <div class="col-md-9">
                            <input type="text" name="lastname" class="form-control" required>
                            <div id="lastname_error" class="error_text"></div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-3 col-md-4 control-label">Company Role <span style="color:red">*</span></label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" name="company_role" required>
                            <div id="company_role_error" class="error_text"></div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-3 col-md-4 control-label" type="email">Email Address <span style="color:red">*</span></label>
                        <div class="col-md-9">
                            <input id="email" type="text" name="email" class="form-control" required>
                            <div id="email_error" class="error_text"></div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-3 col-md-4 control-label" type="email">Repeat Email <span
                                style="color:red">*</span></label>

                        <div class="col-md-9">
                            <input type="text" name="email_again" class="form-control" required>
                            <div id="email_again_error" class="error_text"></div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-3 control-label">Mobile Number</label>

                        <div class="col-md-3" style="padding-right:0">
                            <?php
                            $this->load->module('country');
                            $this->country->select_phone();
                            ?>
                        </div>
                        <div class="col-md-6">
                            <input type="text" class="form-control" name="mobile_number">
                        </div>


                    </div>

                    <div class="form-group">
                        <label class="col-md-3 col-md-4 control-label">Language <span style="color:red">*</span></label>

                        <div class="col-md-4">
                            <?php
                            $this->load->module('language');
                            $this->language->select();
                            ?>
                        </div>
                    </div>

                </div>

            </div>
        </div>

    </div>

    <div class="row" style="margin-bottom:30px">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">

                <div class="hr-line-dashed"></div>
                <div class="form-group">
                    <div class="col-md-6 col-md-offset-3">
                        <div class="checkbox i-checks"><input type="checkbox" value="terms" name="terms" id="terms" required><label style="margin:-30px 0 0 20px"> I Agree to the Terms and Conditions </label> <a href="http://www.gsmstockmarket.com/terms-and-conditions/" target="_blank" class="label label-primary">Read Terms</a></div>
                    </div>
                    <div class="col-md-3">
                        <input class="btn btn-primary pull-right" name="submit_form" type="submit" id="submit_form" value="Create Account"/>
                    </div>
                    <div class="col-md-9 col-md-offset-3">
                        <div id="terms_error" class="error_text"></div>
                    </div>
                </div>

            </div>

        </div>
    </div>

</div>
<!-- </div> /row -->
</form>

</div>
</div>



<section id="contact" class="gray-section contact">
    <div class="container">
        <div class="row m-b-lg">
            <div class="col-lg-12 text-center">
                <div class="navy-line"></div>
                <h1>Contact Us</h1>
                <p>Need help using our website or need more information?</p>
            </div>
        </div>
        <div class="row m-b-lg">
            <div class="col-lg-3 col-lg-offset-3">
                <address>
                    <strong><span class="navy">GSM Stock Market.com Limited</span></strong><br/>
                    83 Baker Street, London<br/>
                    W1U 6AG, United Kingdom.<br/>
                    <abbr title="Phone">UK:</abbr> +44 (0)871 204 0035<br />
                    <abbr title="Phone">INT:</abbr> +44 (0)207 048 0120
                </address>
            </div>
            <div class="col-lg-4">
                <p class="text-color">
                    Our support hours are 8am to 5pm GMT Monday to Friday.<br /><br />Our multilingual account managers are on hand to help you with any questions or queries you may have regarding our platform.
                </p>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12 text-center">
                <a href="mailto:support@gsmstockmarket.com" class="btn btn-primary">Get in touch</a>
                <p class="m-t-sm">
                    Or follow us on social media
                </p>
                <ul class="list-inline social-icon">
                    <li><a href="https://twitter.com/gsmstockmarket" target="_blank"><i class="fa fa-twitter"></i></a>
                    </li>
                    <li><a href="https://facebook.com/gsmstockmarket" target="_blank"><i class="fa fa-facebook"></i></a>
                    </li>
                    <li><a href="https://www.linkedin.com/company/gsmstockmarket-com" target="_blank"><i class="fa fa-linkedin"></i></a>
                    </li>
                    <li><a href="https://plus.google.com/115267224782612734999" target="_blank"><i class="fa fa-google-plus"></i></a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-8 col-lg-offset-2 text-center m-t-lg m-b-lg">
                <p><strong>&copy; 2015 GSM Stock Market.com Limited</strong><br/>Registered in England and Wales. Company No. 07458787</p>
            </div>
        </div>
    </div>
</section>





<style>
    /* INPUTS */
    .inline {
        display: inline-block !important;
    }

    .input-s-sm {
        width: 120px;
    }

    .input-s {
        width: 200px;
    }

    .input-s-lg {
        width: 250px;
    }

    .i-checks {
        padding-left: 0;
    }

    .form-control,
    .single-line {
        background-color: #FFFFFF;
        background-image: none;
        border: 1px solid #e5e6e7;
        border-radius: 1px;
        color: inherit;
        display: block;
        padding: 6px 12px;
        transition: border-color 0.15s ease-in-out 0s, box-shadow 0.15s ease-in-out 0s;
        width: 100%;
        font-size: 14px;
    }

    .form-control:focus,
    .single-line:focus {
        border-color: #1ab394;
    }

    .has-success .form-control {
        border-color: #1ab394;
    }

    .has-warning .form-control {
        border-color: #f8ac59;
    }

    .has-error .form-control {
        border-color: #ed5565;
    }

    .has-success .control-label {
        color: #1ab394;
    }

    .has-warning .control-label {
        color: #f8ac59;
    }

    .has-error .control-label {
        color: #ed5565;
    }

    .input-group-addon {
        background-color: #fff;
        border: 1px solid #E5E6E7;
        border-radius: 1px;
        color: inherit;
        font-size: 14px;
        font-weight: 400;
        line-height: 1;
        padding: 6px 12px;
        text-align: center;
    }

    .spinner-buttons.input-group-btn .btn-xs {
        line-height: 1.13;
    }

    .spinner-buttons.input-group-btn {
        width: 20%;
    }

    .noUi-connect {
        background: none repeat scroll 0 0 #1ab394;
        box-shadow: none;
    }

    .slider_red .noUi-connect {
        background: none repeat scroll 0 0 #ed5565;
        box-shadow: none;
    }

    /* LINE */
    .hr-line-dashed {
        border-top: 1px dashed #e7eaec;
        color: #ffffff;
        background-color: #ffffff;
        height: 1px;
        margin: 20px 0;
    }  body {background:white}
	
	.error_text, .error {color:#F00}
</style>
</body>

<div id="intro" class="modal fade">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span>
                </button>
                 <h4 class="modal-title">An introduction to the GSM Stock Market Platform</h4>

            </div>
            <div class="modal-body">
                <iframe id="videowrapper" src="" width="870" height="520" data-iframe-src="//youtube.com/embed/2MjKGcK7E2Q?autoplay=true" allowfullscreen></iframe>
                <script>
				$(function () {
					$('#intro').on('shown.bs.modal', function (e) {
						var src = $('#videowrapper').attr('data-iframe-src');
						$('#videowrapper').attr('src', src);
					});
				
					$('#intro').on('hidden.bs.modal', function (e) {
						$('#videowrapper').attr('src', '');
					});
				});
				</script>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

</html>

<!-- Latest compiled and minified JavaScript -->
<script src="//code.jquery.com/jquery-2.1.4.min.js" type="text/javascript"></script>
<script src="/public/main/template/core/js/plugins/pace/pace.min.js"></script> <!-- -->
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
<script src="/public/main/template/core/js/plugins/metisMenu/jquery.metisMenu.js"></script>
<script src="/public/main/template/core/js/plugins/slimscroll/jquery.slimscroll.min.js"></script>
<script src="/public/main/template/core/js/inspinia.js"></script>

<!-- iCheck -->
<script src="/public/main/template/core/js/plugins/iCheck/icheck.min.js"></script>
<script>
    $(document).ready(function () {
        $('.i-checks').iCheck({
            checkboxClass: 'icheckbox_square-green',
            radioClass: 'iradio_square-green',
        });
    });</script>

<script>
$(function () {
    $('#intro').on('shown.bs.modal', function (e) {
        var src = $('#videowrapper').attr('data-iframe-src');
        $('#videowrapper').attr('src', src);
    });

    $('#intro').on('hidden.bs.modal', function (e) {
        $('#videowrapper').attr('src', '');
    });
});
</script>

<!-- Jquery Validate -->
<script src="/public/main/template/core/js/plugins/validate/jquery.validate.min.js"></script>

<script>
//Valid Email
$.validator.addMethod("customemail", function(value, element) {
        return /^\w+([-+.']\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*$/.test(value);
    }, 
    "Make sure your email is spelt correctly!"
);
$.validator.addMethod(
  "phone",
  function(phone_number, element) {
    return this.optional(element) || /^\d{6,}$/.test(phone_number.replace(/\s/g, ''));
  },
    "Please enter a valid landline number (numbers only)"
);
    $(document).ready(function () {
        $(".validation").validate({
  rules: {
    company_name: "required",
    address_line_1: "required",
    town_city: "required",
    county: "required",
    country: "required",
    phone_number: "required",
    terms: "required",
	telephone_number: {required: true, phone: true},
	email: {required: true, customemail: true},
	email_again: { equalTo: "#email"},
	"bsectors[]": { 
                    required: true, 
                    minlength: 1 
            } 
  },
  messages: {
    company_name: "We need to know your company's name!",
    address_line_1: {
      required: "What is the street name your company operates from?",
	},
    town_city: {
      required: "What town or city does your company operate from?",
	},
    county: {
      required: "What county or state does your company operate from?",
	},
    country: {
      required: "What country does your company operate from?",
	},
    phone_number: {
      required: "Select a country code for your landline",
	},
    telephone_number: {
      required: "What is your landline number?",
	},
    email: {
      required: "We need to know your email. This will be your login ID",
	},
    email_again: {
      required: "Please repeat your email",
	},
    firstname: {
      required: "What is your first name?",
	},
    lastname: {
      required: "What is your last name?",
	},
    company_role: {
      required: "What is your role within the company?",
	},
    terms: {
      required: "You must read and agree to our terms and conditions before using the trading platform!",
	},
	"bsectors[]": { required: "You must select at least one (1) business sector."
    },
  },
  errorPlacement: function(error, element){
    if(element.attr("name") == "company_name"){
        error.appendTo($('#company_name_error'));
    }else{
        error.appendTo( element.parent().next() );
    }
    if(element.attr("name") == "address_line_1"){
        error.appendTo($('#address_line_1_error'));
    }else{
        error.appendTo( element.parent().next() );
    }
    if(element.attr("name") == "email"){
        error.appendTo($('#email_error'));
    }else{
        error.appendTo( element.parent().next() );
    }
    if(element.attr("name") == "email_again"){
        error.appendTo($('#email_again_error'));
    }else{
        error.appendTo( element.parent().next() );
    }
    if(element.attr("name") == "firstname"){
        error.appendTo($('#firstname_error'));
    }else{
        error.appendTo( element.parent().next() );
    }
    if(element.attr("name") == "lastname"){
        error.appendTo($('#lastname_error'));
    }else{
        error.appendTo( element.parent().next() );
    }
    if(element.attr("name") == "company_role"){
        error.appendTo($('#company_role_error'));
    }else{
        error.appendTo( element.parent().next() );
    }
    if(element.attr("name") == "town_city"){
        error.appendTo($('#town_city_error'));
    }else{
        error.appendTo( element.parent().next() );
    }
    if(element.attr("name") == "county"){
        error.appendTo($('#county_error'));
    }else{
        error.appendTo( element.parent().next() );
    }
    if(element.attr("name") == "country"){
        error.appendTo($('#country_error'));
    }else{
        error.appendTo( element.parent().next() );
    }
    if(element.attr("name") == "phone_number"){
        error.appendTo($('#phone_number_error'));
    }else{
        error.appendTo( element.parent().next() );
    }
    if(element.attr("name") == "telephone_number"){
        error.appendTo($('#telephone_number_error'));
    }else{
        error.appendTo( element.parent().next() );
    }
    if(element.attr("name") == "terms"){
        error.appendTo($('#terms_error'));
    }else{
        error.appendTo( element.parent().next() );
    }
    if(element.attr("name") == "bsectors[]"){
        error.appendTo($('#bsector_error'));
    }else{
        error.appendTo( element.parent().next() );
    }
}
});
    });
</script>

    <script type="text/javascript">

        //bprimary, bsecondary, btertiary
        $(document).ready(function () {

            appendOptions();

            $(document).on("change", "input[name='bsectors[]']", function () {

                if ($("input[name='bsectors[]']:checked").length > 5) {
                    $(this).attr("checked", false);
                    return;
                }

                $("#bprimary, #bsecondary, #btertiary").html('<option value="">[Select One]</option>');
                appendOptions();
            });

            $(document).on("change", ".bsnssector", function () {
                $(".bsnssector option").show();
                $(".bsnssector option:selected").each(function () {
                    if ($(this).val() != "")
                        $(".bsnssector").not(this).find("option[value='" + $(this).val() + "']").hide();
                });

            });

        });

        function appendOptions() {
            var counter = 0;
            $("input[name='bsectors[]']:checked").each(function () {

                $("#bprimary, #bsecondary, #btertiary").append($("<option></option>")
                    .attr("value", $(this).val())
                    .text($(this).val()));
                counter++;
            });

            if (counter == 1) {
                $("#bprimary option:eq(1)").attr("selected", true);
            }

        }
    </script>
    
    
    <script type="text/javascript" xmlns="http://www.w3.org/1999/html">

    var is_primary_set = false;
    $(document).ready(function () {

        var counter = getCheckedBoxesCount();
        toggleChecks(counter)
        <?php
        $primarybusiness = 'none';
        $secondarybusiness = 'none';
        $tertiarybusiness = 'none';




        if (isset($company->business_sector_1) && !empty($company->business_sector_1))
            $primarybusiness = 'block';
        ?>
        $('#primary-business').css("display", '<?php echo $primarybusiness; ?>');
        <?php
        if (isset($company->business_sector_2) && !empty($company->business_sector_2))
            $secondarybusiness = 'block';
        ?>
        $('#secondary-business').css("display", '<?php echo $secondarybusiness ?>');
        <?php
        if (isset($company->business_sector_3) && !empty($company->business_sector_3))
            $tertiarybusiness = 'block';
        ?>
        $('#tertiary-business').css("display", '<?php echo $tertiarybusiness ?>');
        $('#selectMessage').css("display", 'none');
    });
    function updateCode(value) {
        $("#phone_number").val(value);
        $("#mobile_phone").val(value);
    }

    function validate_info() {

        var total = getCheckedBoxesCount();
        if (total <= 0) {
            //console.log(total);
            alert('Please Select atleast one Business Sector');
            return false;
        }
        if (total == 1) {
            var primary = $('#bprimary').val(); // Get Value of Primary select box
            //console.log(total);
            if (primary == '') {
                alert('Please Select Primary Business Sector');
                return false;
            }
        }
        if (total == 2) {
            //console.log(total);
            var primary = $('#bprimary').val(); // Get Value of Primary select box
            var secondary = $('#bsecondary').val(); // Get Value of Secondary select box

            var error = '';
            var flag = true;
            if (primary == '') {
                error = 'Please Select Primary Business Sector \n';
                flag = false;
            }
            if (secondary == '') {
                error = error + 'Please Select Secondary Business Sector \n';
                flag = false;
            }
            if (flag == false) {
                alert(error);
            }
            return flag;
        }
        if (total == 3) {
            //console.log(total);
            var primary = $('#bprimary').val(); // Get Value of Primary select box
            var secondary = $('#bsecondary').val(); // Get Value of Secondary select box
            var tertiary = $('#btertiary').val(); // Get Value of Tertiary select box

            var error = '';
            var flag = true;
            if (primary == '') {
                error = 'Please Select Primary Business Sector \n';
                flag = false;
            }
            if (secondary == '') {
                error = error + 'Please Select Secondary Business Sector \n';
                flag = false;
            }
            if (tertiary == '') {
                error = error + 'Please Select Tertiary Business Sector \n';
                flag = false;
            }
            if (flag == false) {
                alert(error);
            }
            return flag;
        }
        if (total > 3) {
            //console.log(total);
            var primary = $('#bprimary').val(); // Get Value of Primary select box
            var secondary = $('#bsecondary').val(); // Get Value of Secondary select box
            var tertiary = $('#btertiary').val(); // Get Value of Tertiary select box

            var error = '';
            var flag = true;
            if (primary == '') {
                error = 'Please Select Primary Business Sector \n';
                flag = false;
            }
            if (secondary == '') {
                error = error + 'Please Select Secondary Business Sector \n';
                flag = false;
            }
            if (tertiary == '') {
                error = error + 'Please Select Tertiary Business Sector \n';
                flag = false;
            }
            if (flag == false) {
                alert(error);
            }
            return flag;
        }
        updateHiddens();
        return true;
    }


    function getCheckedBoxesCount() {
        var count = 1;
        var total = 0;
        while (count <= 16) {
            var chk = $('#bsectors' + count).prop("checked");
            if (chk == true) {
                total = total + 1;
            }
            count++;
        }
        return total;
    }


    function toggleChecks(counter) {
        // Function to disable or enable check boxes


        var count = 1;
        var ids = new Array();
        if (counter >= 5) {
            while (count <= 16) {
                var chk = $('#bsectors' + count).prop("checked");
                var id = $('#bsectors' + count).attr('id');
                if (chk == false) {
                    $('#bsectors' + count).iCheck('uncheck');
                    $('#bsectors' + count).iCheck('disable');
                }
                count++;
            }
        } else {
            while (count <= 16) {
                var chk = $('#bsectors' + count).prop("checked");
                var id = $('#bsectors' + count).attr('id');
                if (chk == false) {
                    $('#bsectors' + count).iCheck('uncheck');
                    $('#bsectors' + count).iCheck('enable');
                }
                count++;
            }
        }

    }

    function updateChecks(div_id) {

        var primary = $('#bprimary').val();
        var secondary = $('#bsecondary').val();
        var tertiary = $('#btertiary').val();
        var total_checked = getCheckedBoxesCount();
        var chk = $('#' + div_id).prop("checked"); // get state of current checkbox

        if (chk == false) {
            var total_checked = total_checked + 1;
        } else {
            var total_checked = total_checked - 1;
        }
        //console.log('Total Checked:'+total_checked);

        var count = 1;
        var ids = new Array();
        while (count <= 16) {
            var chk = $('#bsectors' + count).prop("checked");
            var id = $('#bsectors' + count).attr('id');
            if (chk == true) {
                if (id != div_id) {
                    ids[count] = id;
                }
            }
            count++;
        }


        var selectedValue = $('#' + div_id).val();
        var str = "<option value = ''>[SELECT ONE]</option>";
        if (selectedValue == primary) {
            $('#bprimary').empty().append(str);
            $('#bsecondary option[value="' + selectedValue + '"]').remove();
            $('#btertiary option[value="' + selectedValue + '"]').remove();
        }

        if (selectedValue == secondary) {
            $('#bsecondary').empty().append(str);
            $('#bprimary option[value="' + selectedValue + '"]').remove();
            $('#btertiary option[value="' + selectedValue + '"]').remove();
        }

        if (selectedValue == tertiary) {
            $('#btertiary').empty().append(str);
            $('#bprimary option[value="' + selectedValue + '"]').remove();
            $('#bsecondary option[value="' + selectedValue + '"]').remove();
        }

        $('#bprimary option[value="' + selectedValue + '"]').remove();
        $('#bsecondary option[value="' + selectedValue + '"]').remove();
        $('#btertiary option[value="' + selectedValue + '"]').remove();


        ids.forEach(function (entry) {

            var value = $('#' + entry).attr('value');
            var entry = $('#' + entry).attr('value');


            if (entry == primary) {
                var str1 = "<option value = '" + entry + "' selected='selected'>" + value + "</option>";
            } else {

                var str1 = "<option value = '" + entry + "'>" + value + "</option>";


            }
            if (entry != secondary && entry != tertiary) {
                $('#bprimary option[value="' + entry + '"]').remove();
                $('#bprimary').append(str1);
            }


            if (entry == secondary) {
                var str2 = "<option value = '" + entry + "' selected='selected'>" + value + "</option>";
            } else {

                var str2 = "<option value = '" + entry + "'>" + value + "</option>";
            }
            if (entry != primary && entry != tertiary) {

                $('#bsecondary option[value="' + entry + '"]').remove();
                $('#bsecondary').append(str2);
            }


            if (entry == tertiary) {
                var str3 = "<option value = '" + entry + "' selected='selected'>" + value + "</option>";
            } else {

                var str3 = "<option value = '" + entry + "'>" + value + "</option>";
            }

            if (entry != primary && entry != secondary) {

                $('#btertiary option[value="' + entry + '"]').remove();
                $('#btertiary').append(str3);
            }

        });
    }

    function updateSelects1(value) {

        var no_value = value; //	Value to be excluded from other selects

        var count = 1;
        var ids = new Array();
        while (count <= 16) {		// Get all checkboxes ids
            var chk = $('#bsectors' + count).prop("checked");
            var id = $('#bsectors' + count).attr('id');
            if (chk == true) {
                ids[count] = id;
            }
            count++;
        }

        var secondary = $('#bsecondary').val(); // Get Value of Secondary select box
        var tertiary = $('#btertiary').val(); // Get Value of Tertiary select box

        var str = "<option value = ''>[SELECT ONE]</option>";
        // Append Empty options to secondary and tertiary select boxes
        $('#bsecondary').empty().append(str);
        $('#btertiary').empty().append(str);
        ids.forEach(function (entry) {

            var value = $('#' + entry).attr('value'); // Get value of selected option box
            var entry = $('#' + entry).attr('value');
            if (entry != no_value) {
                if (entry == secondary) {
                    var str1 = "<option value = '" + entry + "' selected = 'selected'>" + value + "</option>";
                } else {
                    var str1 = "<option value = '" + entry + "'>" + value + "</option>";
                }
                if (entry != tertiary) {
                    $('#bsecondary').append(str1);
                }
                if (entry == tertiary) {
                    var str2 = "<option value = '" + entry + "' selected = 'selected'>" + value + "</option>";
                } else {
                    var str2 = "<option value = '" + entry + "'>" + value + "</option>";
                }
                if (entry != secondary) {
                    $('#btertiary').append(str2);
                }
            }
        });
        is_primary_set = true;
        updateHiddens();
    }

    function updateSelects2(value) {

        var no_value = value; //	Value to be excluded from other selects

        var count = 1;
        var ids = new Array();
        while (count <= 16) {
            var chk = $('#bsectors' + count).prop("checked");
            var id = $('#bsectors' + count).attr('id');
            if (chk == true) {
                ids[count] = id;
            }
            count++;
        }

        var primary = $('#bprimary').val();
        var tertiary = $('#btertiary').val();
        var str = "<option value = ''>[SELECT ONE]</option>";
        $('#bprimary').empty().append(str);
        $('#btertiary').empty().append(str);
        ids.forEach(function (entry) {
            var value = $('#' + entry).attr('value');
            var entry = $('#' + entry).attr('value');
            if (entry != no_value) {
                if (entry == primary) {
                    var str1 = "<option value = '" + entry + "' selected = 'selected'>" + value + "</option>";
                } else {
                    var str1 = "<option value = '" + entry + "'>" + value + "</option>";
                }
                if (entry != tertiary) {
                    $('#bprimary').append(str1);
                }
                if (entry == tertiary) {
                    var str2 = "<option value = '" + entry + "' selected = 'selected'>" + value + "</option>";
                } else {
                    var str2 = "<option value = '" + entry + "'>" + value + "</option>";
                }
                if (entry != primary) {
                    $('#btertiary').append(str2);
                }
            }
        });
        updateHiddens();
    }

    function updateSelects3(value) {

        var no_value = value; //	Value to be excluded from other selects

        var count = 1;
        var ids = new Array();
        while (count <= 16) {
            var chk = $('#bsectors' + count).prop("checked");
            var id = $('#bsectors' + count).attr('id');
            if (chk == true) {
                ids[count] = id;
            }
            count++;
        }

        var primary = $('#bprimary').val();
        var secondary = $('#bsecondary').val();
        var str = "<option value = ''>[SELECT ONE]</option>";
        $('#bprimary').empty().append(str);
        $('#bsecondary').empty().append(str);
        ids.forEach(function (entry) {
            var value = $('#' + entry).attr('value');
            var entry = $('#' + entry).attr('value');
            if (entry != no_value) {
                if (entry == primary) {
                    var str1 = "<option value = '" + entry + "' selected = 'selected'>" + value + "</option>";
                } else {
                    var str1 = "<option value = '" + entry + "'>" + value + "</option>";
                }
                if (entry != secondary) {
                    $('#bprimary').append(str1);
                }
                if (entry == secondary) {
                    var str2 = "<option value = '" + entry + "' selected = 'selected'>" + value + "</option>";
                } else {
                    var str2 = "<option value = '" + entry + "'>" + value + "</option>";
                }
                if (entry != primary) {
                    $('#bsecondary').append(str2);
                }
            }
        });
        updateHiddens();
    }

    function updateHiddens() {

        var primary = $('#bprimary').val();
        var secondary = $('#bsecondary').val();
        var tertiary = $('#btertiary').val();
        var value1 = $('#' + primary).attr('value');
        var value2 = $('#' + secondary).attr('value');
        var value3 = $('#' + tertiary).attr('value');
        //alert(value1 + value2 + value3);
        $('#primary_sector').val(value1);
        $('#secondary_sector').val(value2);
        $('#tertiary_sector').val(value3);
    }

    $(function () {

        $('.business_cycle').on('ifChecked', function (event) {		// If we just checked a checkbox

            var orig_counter = getCheckedBoxesCount(); // get total checkedboxes count
            toggleChecks(orig_counter); // disable or enable checkboxes if greater than 5
        });
        $('.business_cycle').on('ifUnchecked', function (event) {		// If we just unchecked a checkbox


            var orig_counter = getCheckedBoxesCount(); // get total checkedboxes count
            toggleChecks(orig_counter); // disable or enable checkboxes if greater than 5


            if (orig_counter <= 0) {
                is_primary_set = false; // If All checkboxes unchecked then primary should be reset if secondary is empty
            }
        });
        $('.business_cycle').on('ifClicked', function (event) {

            //var orig_counter = $('input[name="bsectors"]:checked').size();

            var orig_counter = getCheckedBoxesCount(); // get total checkedboxes count

            // get number of checked checkboxes

            var id = $(this).attr('id'); //	get ID of current checkbox
            var value = $(this).attr('value'); // get value of current checkbox
            var chk = $('#' + id).prop("checked"); // get state of current checkbox

            updateChecks(id); // update the selects

            if (chk == false) {
                var counter = orig_counter + 1;
            } else {
                var counter = orig_counter - 1;
            }

            var str = "<option value = '" + value + "'>" + value + "</option>"; // Create Option

            $('#bprimary option[value="' + value + '"]').remove();
            $('#bsecondary option[value="' + value + '"]').remove();
            $('#btertiary option[value="' + value + '"]').remove();


            if (counter < 1) {	// if No Checkbox is selected
                // Hide all Select boxes
                $('#primary-business').css("display", 'none');
                $('#secondary-business').css("display", 'none');
                $('#tertiary-business').css("display", 'none');
                $('#selectMessage').css("display", 'none');
            } else {
                if (counter == 1) {	// Only One Checkbox is selected
                    // Primary Select Box is displayed
                    $('#primary-business').css("display", 'block');
                    $('#secondary-business').css("display", 'none');
                    $('#tertiary-business').css("display", 'none');
                    $('#selectMessage').css("display", 'block');
                    var str_prime = "<option value = '" + value + "' selected = 'selected'>" + value + "</option>"; // Create Option for primary select box

                    if (chk == false) {	// If Checkbox is checked
                        $('#bprimary').append(str_prime); // Append the value to Primary Select box
                    } else {
                        $("#bprimary option[value='" + value + "']").remove(); // Remove the value from Primary Select box
                    }
                }
                else if (counter == 2) {	// 2 Checkboxes are selected
                    // Primary and Secondary select boxes are displayed
                    $('#primary-business').css("display", 'block');
                    $('#secondary-business').css("display", 'block');
                    $('#tertiary-business').css("display", 'none');
                    $('#selectMessage').css("display", 'block');
                    if (chk == false) {
                        // Append values to both Primary and Secondary select boxes
                        $('#bprimary').append(str);
                        $('#bsecondary').append(str);
                    } else {
                        // Remove values from both Primary and Secondary select boxes
                        $("#bprimary option[value='" + value + "']").remove();
                        $("#bsecondary option[value='" + value + "']").remove();
                    }

                }
                else if (counter == 3) {	// 3 Checkboxes are selected
                    // Primary, Secondary and Tertiary Select boxes are displayed
                    $('#primary-business').css("display", 'block');
                    $('#secondary-business').css("display", 'block');
                    $('#tertiary-business').css("display", 'block');
                    $('#selectMessage').css("display", 'block');
                    if (chk == false) {
                        // Append values to Primary, Secondary and Tertiary select boxes
                        $('#bprimary').append(str);
                        $('#bsecondary').append(str);
                        $('#btertiary').append(str);
                    } else {
                        // Remove values from Primary, Secondary and Tertiary select boxes
                        $("#bprimary option[value='" + value + "']").remove();
                        $("#bsecondary option[value='" + value + "']").remove();
                        $("#btertiary option[value='" + value + "']").remove();
                    }
                }
                else {	// More than 3 Checkboxes are selected
                    if (chk == false) {
                        // Append values to Primary, Secondary and Tertiary select boxes
                        $('#bprimary').append(str);
                        $('#bsecondary').append(str);
                        $('#btertiary').append(str);
                    } else {
                        // Remove values from Primary, Secondary and Tertiary select boxes
                        $("#bprimary option[value='" + value + "']").remove();
                        $("#bsecondary option[value='" + value + "']").remove();
                        $("#btertiary option[value='" + value + "']").remove();
                    }
                }
            }

        });
    });
</script>
