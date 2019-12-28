jQuery('table[data-form="deleteForm"]').on('click', '.form-delete', function(e){
    e.preventDefault();
    var $form=jQuery(this);
    jQuery('#confirm').modal({ backdrop: 'static', keyboard: false })
    .on('click', '#delete-btn', function(){
        $form.submit();
    });
});

jQuery('#multi_check').click(function(){
    if (jQuery("#multi_check").is(':checked')) {
        jQuery("input[type=checkbox]").each(function () {
            jQuery(this).attr("checked", true);
        });
    } else {
        jQuery("input[type=checkbox]").each(function () {
            jQuery(this).attr("checked", false);
        });
    } 
});


jQuery('.btn-multiple-ids').click(function(){ 
    var allVals = [];  
    jQuery("input:checkbox[name=single_check]:checked").each(function(){
        allVals.push(jQuery(this).val());
    });
    
    var update_type = jQuery(this).attr('id');
    jQuery('#'+update_type+'_multiple_ids').val(allVals);
    var $form = jQuery('#form-'+update_type+'-multiple-ids');

    if(update_type=='delete') {
        jQuery('#confirm').modal({ backdrop: 'static', keyboard: false })
            .on('click', '#delete-btn', function(){
            $form.submit();
        });
    } else {
        $form.submit(); 
    }
    
});