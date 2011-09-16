$(function(){
	$( ".date" ).datepicker();
    $("#addSpecification").click(function(){
    	var specCount =$(".specification").size()/2;
    	var version = 1;
    	if (specCount > 0) {
    		version = $("input[stores='version']").first().val();
    	}
    	$('#specifications').append('<div id="specification' + specCount + '"></div>'); 	
    	var newSpecVersion = '<input type="hidden" name="data[Specification][' + specCount + '][version]" value="' + version + '" stores="version" id="Specification' + specCount + 'Version">';
    	var newFieldLabel = '<label for="Specification' + specCount + 'Value">Component</label>';
    	var newValueLabel = '<label for="Specification' + specCount + 'Value">Description</label>';
    	var newField = '<input name="data[Specification][' + specCount + '][field]" class="specification" maxlength="100" type="text" id="Specification' + specCount + 'Field">';
    	var newValue = '<input name="data[Specification][' + specCount + '][value]" class="specification" maxlength="100" type="text" id="Specification' + specCount + 'Value">';
    	var remove = '<a href="javascript:void(0)" number="' + specCount + '" class="rm-spec">remove</a>';
    	$('#specification' + specCount).append(newSpecVersion, newFieldLabel, newField, newValueLabel, newValue, remove);
    });
    
    $("div").delegate('.rm-spec', 'click', function(){
    	var specNumber = $(this).attr('number');
    	$('#specification' + specNumber).remove();
    });
});



