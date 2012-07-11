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