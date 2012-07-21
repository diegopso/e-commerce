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

$.fn.keyupValidation = function(regExp, classe){
    return $(this).each(function(){
        var $self = $(this);
        classe = classe || 'error';
        var $control = $self.parent().parent();
        $self.bind('keyup.validation', function(){
            if(!$self.val().match(regExp)){
                $control.addClass(classe);
            }else{
                $control.removeClass(classe);
            }
        }); 
    });
    
};

$.fn.submitValidation = function(requireds, modal, onSend){
    return $(this).each(function(){
       var self = $(this);
       self.bind('submit.validation', function(e){
            e.preventDefault();
            var erros = self.find('.error');
            var camposErrados = '';
            var camposObrigatorios = '';
            var ulErrados = undefined;
            var ulObrigatorios = undefined;
            var modalCorrecoes = $('<div></div>');

            if(erros.length > 0){
                erros.each(function(i, o){
                    camposErrados += '<li>'+ $(this).find('label').text() +'</li>';
                });

                ulErrados = $('<ul></ul>').append(camposErrados);
                modalCorrecoes.append('<span>Existem campos com valores incorretos:</span><br />', ulErrados);
            }
            $.each(requireds, function(i, o){
                var type = o.attr('type');
                switch(type){
                    case 'hidden':
                        type = 'text';
                    case 'text':
                        if(o.val() == ''){
                            camposObrigatorios += '<li>'+ o.parent().parent().find('label').text() +'</li>';
                        }
                        break;
                }

                ulObrigatorios = $('<ul></ul>').append(camposObrigatorios);
                modalCorrecoes.append('<span>Existem campos obrigatórios em branco:</span><br />', ulObrigatorios);
            });

            if(ulErrados || camposObrigatorios != ''){
                $(modal).modal({show:true}).find('.modal-body').empty().append(ulErrados).append(ulObrigatorios);
            }else{
                self.unbind('submit.validation').submit(onSend).submit();
            }
        }); 
    });
}

$(document).ready(function(){
    $(".tip").tooltip();
    
    window.setTimeout(function(){
        $('.flash-message').slideUp('fast');
    }, 5000);
    
    $('.dropdown-toggle+.dropdown-menu').find('a[data-value]').click(function(){
        var self = $(this);
        var dropMenu = self.parent().parent().parent();
        
        dropMenu.find('.dropdown-toggle span:eq(0)').text(self.text());
        dropMenu.find('.dropdown-toggle input[type="hidden"]').val(self.attr('data-value'));
    });
    
    $('a[data-toggle="slide"], button[data-toggle="slide"], input[data-toggle="slide"]').toggle(function(){
        var self = $(this);
        var href = self.attr('data-value');
        var i = self.find('i.icon-chevron-down');
        
        $(href).slideDown('fast');
        
        if(i){
            i.removeClass('icon-chevron-down').addClass('icon-chevron-up');
        }
    },
    function(){
        var self = $(this);
        var href = self.attr('data-value');
        var i = self.find('i.icon-chevron-up');
        
        $(href).slideUp('fast').clear();
        if(i){
            i.removeClass('icon-chevron-up').addClass('icon-chevron-down');
        }
    });
});