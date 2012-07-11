function clear_form_elements(ele) {

    $(ele).find(':input').each(function() {
        switch(this.type) {
            case 'password':
            case 'select-multiple':
            case 'select-one':
            case 'text':
            case 'textarea':
                $(this).val('');
                break;
            case 'checkbox':
            case 'radio':
                this.checked = false;
        }
    });

}

$.fn.clear = function(){
    $(this).find(':input').each(function() {
        switch(this.type) {
            case 'password':
                $(this).val('');
                break;
            case 'text':
                $(this).val('');
                break;
            case 'textarea':
                $(this).val('');
                break;
            case 'checkbox':
                this.checked = false;
                break;
            case 'radio':
                this.checked = false;
        }
    });
};