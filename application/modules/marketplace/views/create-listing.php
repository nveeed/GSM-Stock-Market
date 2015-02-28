<div class="row wrapper border-bottom white-bg page-heading">
<div class="col-lg-10">
    <h2></h2>
    <ol class="breadcrumb">
        <li>
            <a href="/">Home</a>
        </li>
        <li class="active">
            <strong>Edit Profile</strong>
        </li>
    </ol>
</div>
<div class="col-lg-2">

</div>
</div>


<div class="wrapper wrapper-content">

<div class="row">
<div class="col-lg-8">
    <div class="ibox float-e-margins">
<div class="ibox-title">
<h5>Listing Details</h5>
</div>
<div class="ibox-content">
<form class="validation form-horizontal">
     <div class="form-group"><label class="col-md-3 control-label">Schedule Listing</label>
          <div class="input-group date form_datetime col-md-9" data-date="<?php echo date('Y').'-'.date('m').'-'.date('d')?>" data-date-format="dd MM yyyy - HH:ii p" data-link-field="dtp_input1">
            <input class="form-control" size="16" type="text" value="" readonly>
            <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
            <span class="input-group-addon"><span class="glyphicon glyphicon-th"></span></span>
        </div>
        <input type="hidden" id="dtp_input1" value="" /><br/>
    </div>

	<div class="form-group"><label class="col-md-3 control-label">Listing Type</label>
        <div class="col-md-9">
        	<select class="form-control" >
            	<option disabled selected>Buying or Selling?</option>
            	<option>Buying Request</option>
            	<option>Selling Offer</option>
            </select>


        </div>
    </div>
    
    <div class="hr-line-dashed"></div>
    
	<div class="form-group"><label class="col-md-3 control-label">MPN/ISBN</label>
        <div class="col-md-8">
        	<input type="type" id="mpn1" list="mpn" class="form-control" placeholder="Auto fill the rest of the data if MPN/ISBN is found in the database" />
            <datalist id="mpn">
            <?php if(!empty($listing_attributes)){ 
                 foreach ($listing_attributes as $row) { ?>
                <option value="<?php echo $row->product_mpn_isbn; ?>"><?php echo $row->product_mpn_isbn; ?></option>
            	 <?php }} ?>

            </datalist>
        </div>
        <div  class="col-md-1 btn btn-warning" >Check</div>
    </div>
    
	<div class="form-group"><label class="col-md-3 control-label">Make</label>
        <div class="col-md-9">
        <input type="type" class="form-control" placeholder="Select Make" name="product_make"/>
        </div>
    </div>
    
	<div class="form-group"><label class="col-md-3 control-label">Model</label>
        <div class="col-md-9">
        	<input type="type" class="form-control" placeholder="When make is selected list models associated with make" name="product_model" />
        </div>
    </div>
    


	<div class="form-group"><label class="col-md-3 control-label">Product Type</label>
        <div class="col-md-9">
            <input type="type" class="form-control" placeholder="Product Type" name="product_type"/>
        </div>
    </div>

	<div class="form-group"><label class="col-md-3 control-label">Colour</label>
        <div class="col-md-9">
        	<input type="type" class="form-control" placeholder="Colour" name="product_color" />
        </div>
    </div>
    
    
    <div class="hr-line-dashed"></div>
	<div class="form-group"><label class="col-md-3 control-label">Condition</label>
        <div class="col-md-9">
        	<select class="form-control" >
            	<option disabled selected>Condition</option>
            	<option>New</option>
            	<option>Used</option>
            	<option>Refurbished</option>
            </select>
        </div>
    </div>
    <div class="form-group"><label class="col-md-3 control-label">Spec</label>
    <div class="col-md-9">
    	<select class="form-control" >
        	<option disabled selected>Spec</option>
        	<option>EU</option>
        	<option>UK</option>
        	<option>US</option>
        	<option>ASIA</option>
        </select>
    </div>
</div>    
    <div class="hr-line-dashed"></div>
    
	<div class="form-group"><label class="col-md-3 control-label">Currency</label>
        <div class="col-md-9">
        	<select class="form-control" >
            	<option disabled selected>Default (account preference defalut)</option>
            	<option>&pound; GBP</option>
            	<option>&euro; EUR</option>
            	<option>$ USD</option>
            </select>
        	<p class="small">Select the currency you wish this listing to be sold in.</p>
        </div>
    </div>
    

	<div class="form-group"><label class="col-md-3 control-label">Unit Price</label>
        <div class="col-md-9">
        	<input type="type" class="form-control" />
        </div>
    </div>
    
	<div class="form-group"><label class="col-md-3 control-label">Minimum Price</label>
        <div class="col-md-9">
        	<div class="input-group m-b"><span class="input-group-addon"> <input type="checkbox" /> </span> <input type="text" class="form-control" placeholder="only make typable when clicked"></div>
        	<p class="small">tick to enable. Any offers below this will be auto rejected, leave blank to allow any offers if ticked.</p>
        </div>
    </div>
    
	<div class="form-group"><label class="col-md-3 control-label">Allow Offers</label>
        <div class="col-md-9">
        	<div class="input-group m-b"><span class="input-group-addon"> <input type="checkbox" /> </span>
        	<select class="form-control" >
            	<option selected>default</option>
            	<option>4</option>
            	<option>5</option>
            	<option>6</option>
            	<option>7</option>
            	<option>8</option>
            	<option>9</option>
            	<option>10</option>
            </select></div>
        	<p class="small">Allow people to make offers and how many per 24 hour period. (default is 3)</p>
        </div>
    </div>
    
	<div class="form-group"><label class="col-md-3 control-label">Quantity Available</label>
        <div class="col-md-9">
        	<input type="type" class="form-control" />
        </div>
    </div>
    
	<div class="form-group"><label class="col-md-3 control-label">Min Order Quantity</label>
        <div class="col-md-9">
        	<div class="input-group m-b"><span class="input-group-addon"> <input type="checkbox" /> </span> <input type="text" class="form-control" placeholder="only make typable when clicked"></div>
        	<p class="small">Allow minimum order quantity else full quantity sale available only</p>
        </div>
    </div>
    
    <div class="hr-line-dashed"></div>
    
    <div class="form-group"><label class="col-md-3 control-label">Shipping Terms</label>
    <div class="col-md-9">
    	<select class="form-control" >
        	<option disabled selected>Select Terms</option>
        	<option>CIF</option>
        	<option>CIP</option>
        	<option>CPT</option>
        	<option>DAP</option>
        	<option>DAT</option>
        	<option>EXW</option>
        	<option>FCA</option>
        	<option>NDS</option>
        </select>
    </div>
</div>
    
    <div class="form-group"><label class="col-md-3 control-label">Courier</label>

        <div class="col-md-9">
        	<label class="checkbox-inline i-checks"><input type="checkbox" value="option1" id="inlineCheckbox1"> DHL </label>
            <label class="checkbox-inline i-checks"><input type="checkbox" value="option2" id="inlineCheckbox2"> FEDEX </label>
            <label class="checkbox-inline i-checks"><input type="checkbox" value="option3" id="inlineCheckbox3"> UPS </label>
            <label class="checkbox-inline i-checks"><input type="checkbox" value="option3" id="inlineCheckbox3"> OTHER </label>
        </div>
    </div>
    
    <div class="hr-line-dashed"></div>                                
    
	<div class="form-group"><label class="col-md-3 control-label">Product Description</label>
        <div class="col-md-9">
        	<textarea type="type" class="form-control" rows="5" id="product_desc" /></textarea>
        </div>
    </div>
    
    <div class="hr-line-dashed"></div>
    
	<div class="form-group"><label class="col-md-3 control-label">List Duration</label>
        <div class="col-md-9">
        	<select class="form-control" >
            	<option>1 Day</option>
            	<option>3 Days</option>
            	<option>5 Days</option>
            	<option selected>7 Days</option>
            	<option>10 Days</option>
            	<option>14 Days</option>
            </select>
        </div> 
    </div>	
    
	<div class="form-group"><label class="col-md-3 control-label">Terms &amp; Conditions</label>
        <div class="col-md-9"><input type="checkbox" class="checkbox-inline i-checks" /> I agree to the GSMStockMarket.com Limited Terms and Conditions
        </div>
    </div>
    
    <div class="form-group">
        <div class="col-md-9 col-md-offset-3">
            <button class="btn btn-white" type="submit">Cancel</button>
            <button class="btn btn-warning" type="submit">Save for later</button>
            <button class="btn btn-primary" type="submit">List Now</button>
        </div>
    </div>
                
  </form>
  </div>
 </div> 
</div>       
<div class="col-lg-4">
    <div class="ibox float-e-margins">
        <div class="ibox-title">
            <h5>Listing Pictures</h5>
        </div>
        <div class="ibox-content">
        <div class="row">
        	<div class="col-md-12" style="text-align:center">                                
                    <img src="public/main/template/gsm/images/members/no_profile.jpg" width="150" height="150">
        	</div>
        	<div class="col-md-12" style="text-align:center;margin-top:20px">
        	<div class="btn-group">
           		<label title="Upload image file" for="inputImage" class="btn btn-primary">
                	<input type="file" accept="image/*" name="file" class="hide">Upload new image</label>
                    <label class="btn btn-danger">Delete</label>
           	</div>
        	</div>
            <p class="small" style="text-align:center">You may have up to five (5) product images per listing.</p>
        </div>
        </div>

</div></div>        
       
</div>
</div>
            
    <!-- checkbox css -->
    <link href="public/main/template/core/css/plugins/iCheck/custom.css" rel="stylesheet">

    <!-- iCheck -->
    <script src="public/main/template/core/js/plugins/iCheck/icheck.min.js"></script>
        <script>
            $(document).ready(function () {
                $('.i-checks').iCheck({
                    checkboxClass: 'icheckbox_square-green',
                    radioClass: 'iradio_square-green',
                });
            });
    </script>

   <script>/**
 * Character counter and limiter plugin for textfield and textarea form elements
 * @author Sk8erPeter
 */ (function ($) {
    $.fn.characterCounter = function (params) {
        // merge default and user parameters
        params = $.extend({
            // define maximum characters
            maximumCharacters: 1000,
            // create typed character counter DOM element on the fly
            characterCounterNeeded: true,
            // create remaining character counter DOM element on the fly
            charactersRemainingNeeded: true,
            // chop text to the maximum characters
            chopText: false,
            // place character counter before input or textarea element
            positionBefore: false,
            // class for limit excess
            limitExceededClass: "character-counter-limit-exceeded",
            // suffix text for typed characters
            charactersTypedSuffix: " characters typed",
            // suffix text for remaining characters
            charactersRemainingSuffixText: " characters left",
            // whether to use the short format (e.g. 123/1000)
            shortFormat: false,
            // separator for the short format
            shortFormatSeparator: "/"
        }, params);

        // traverse all nodes
        this.each(function () {
            var $this = $(this),
                $pluginElementsWrapper,
                $characterCounterSpan,
                $charactersRemainingSpan;

            // return if the given element is not a textfield or textarea
            if (!$this.is("input[type=text]") && !$this.is("textarea")) {
                return this;
            }

            // create main parent div
            if (params.characterCounterNeeded || params.charactersRemainingNeeded) {
                // create the character counter element wrapper
                $pluginElementsWrapper = $('<div>', {
                    'class': 'character-counter-main-wrapper'
                });

                if (params.positionBefore) {
                    $pluginElementsWrapper.insertBefore($this);
                } else {
                    $pluginElementsWrapper.insertAfter($this);
                }
            }

            if (params.characterCounterNeeded) {
                $characterCounterSpan = $('<span>', {
                    'class': 'counter character-counter',
                        'text': 0
                });

                if (params.shortFormat) {
                    $characterCounterSpan.appendTo($pluginElementsWrapper);

                    var $shortFormatSeparatorSpan = $('<span>', {
                        'html': params.shortFormatSeparator
                    }).appendTo($pluginElementsWrapper);

                } else {
                    // create the character counter element wrapper
                    var $characterCounterWrapper = $('<div>', {
                        'class': 'character-counter-wrapper',
                            'html': params.charactersTypedSuffix
                    });

                    $characterCounterWrapper.prepend($characterCounterSpan);
                    $characterCounterWrapper.appendTo($pluginElementsWrapper);
                }
            }

            if (params.charactersRemainingNeeded) {

                $charactersRemainingSpan = $('<span>', {
                    'class': 'counter characters-remaining',
                        'text': params.maximumCharacters
                });

                if (params.shortFormat) {
                    $charactersRemainingSpan.appendTo($pluginElementsWrapper);
                } else {
                    // create the character counter element wrapper
                    var $charactersRemainingWrapper = $('<div>', {
                        'class': 'characters-remaining-wrapper',
                            'html': params.charactersRemainingSuffixText
                    });
                    $charactersRemainingWrapper.prepend($charactersRemainingSpan);
                    $charactersRemainingWrapper.appendTo($pluginElementsWrapper);
                }
            }

            $this.keyup(function () {

                var typedText = $this.val();
                var textLength = typedText.length;
                var charactersRemaining = params.maximumCharacters - textLength;

                // chop the text to the desired length
                if (charactersRemaining < 0 && params.chopText) {
                    $this.val(typedText.substr(0, params.maximumCharacters));
                    charactersRemaining = 0;
                    textLength = params.maximumCharacters;
                }

                if (params.characterCounterNeeded) {
                    $characterCounterSpan.text(textLength);
                }

                if (params.charactersRemainingNeeded) {
                    $charactersRemainingSpan.text(charactersRemaining);

                    if (charactersRemaining <= 0) {
                        if (!$charactersRemainingSpan.hasClass(params.limitExceededClass)) {
                            $charactersRemainingSpan.addClass(params.limitExceededClass);
                        }
                    } else {
                        $charactersRemainingSpan.removeClass(params.limitExceededClass);
                    }
                }
            });

        });

        // allow jQuery chaining
        return this;

    };
})(jQuery);

$(document).ready(function () {
    $('#product_desc').characterCounter({
        maximumCharacters: 500,
        characterCounterNeeded: false,
        chopText: true
    });

});
    </script>
    
    

    <!-- Jquery Validate -->
    <script src="public/main/template/core/js/plugins/validate/jquery.validate.min.js"></script>

      <script>
         $(document).ready(function(){

             $(".validation").validate({
                 rules: {
                     password: {
                         required: true,
                         minlength: 3
                     },
                     url: {
                         required: true,
                         url: true
                     },
                     number: {
                         required: true,
                         number: true
                     },
                     min: {
                         required: true,
                         minlength: 6
                     },
                     max: {
                         required: true,
                         maxlength: 4
                     }
                 }
             });
        });
</script>
<script>
   $(document).ready(function(){
     $("#mpn1").change(function(){
     var product_mpn_isbn = $(this).val(); 
        
        jQuery.post('<?php echo base_url()?>marketplace/get_attributes_info/',{product_mpn_isbn:product_mpn_isbn},
        function(data){   
                     
        if(data.STATUS=='true'){

            $('input[name="product_make"]').val(data.product_make);
            $('input[name="product_model"]').val(data.product_model);
            $('input[name="product_color"]').val(data.product_color);
            $('input[name="product_type"]').val(data.product_type);
           }       
          });
        });
     });
 </script>
<script type="text/javascript" src="public/admin/js/bootstrap-datetimepicker.js" charset="UTF-8"></script>

<script type="text/javascript" src="public/admin/js/bootstrap-datetimepicker.fr.js" charset="UTF-8"></script>

<script type="text/javascript">
    $('.form_datetime').datetimepicker({
        //language:  'fr',
        weekStart: 1,
        todayBtn:  1,
        autoclose: 1,
        todayHighlight: 1,
        startView: 2,
        forceParse: 0,
        showMeridian: 1
    });
    </script>