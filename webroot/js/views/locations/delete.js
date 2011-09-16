$(function(){
    $('#newLocation').hide();
    $("input[name='data[Location][delete_action]']").change(function(){
        if ($("input[name='data[Location][delete_action]']:checked").val() == 'relocate') {
        	$('#newLocation').show();
        }
        else if ($("input[name='data[Location][delete_action]']:checked").val() == 'delete') {
        	$('#newLocation').hide();
        }
    });
});



