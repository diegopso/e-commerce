<button class="btn" data-toggle="slide" data-value="#uploader">
    <i class="icon-chevron-down"></i>
    <span>Nova Imagem</span>
    <i class="icon-plus"></i>
</button>
<div id="uploader" style="display:none;">
    <fieldset class="profile-fieldset">
        <div id="file-uploader-picture">		
            <noscript>			
            <p>Por favor, ative o JavaScript para utilizar esta funcionalidade.</p>
            </noscript>         
        </div>
    </fieldset>
</div>
<link rel="stylesheet" type="text/css" href="~/app/wwwroot/media/css/fileuploader.css"></link>
<script type="text/javascript" src="~/app/wwwroot/media/js/fileuploader.js"></script>
<script type="text/javascript">  
    var site_url = <?php echo '"' . site_url . '"' ?>;
    $(document).ready(function(){
        var picture_uploader_options = {
            name: 'picture-uploader',
            elementId: 'file-uploader-picture',
            onComplete: function(indx, fileName, data){
               data = data.d;
               if(data.status == 'SUCCESS'){
                   $('.qq-upload-list').empty();
                   
                   var tr = $('<tr></tr>');
                   tr.append('<td>'+data.model.original_name+'</td>');
                   
                   var del = $('<button class="btn tip" onclick="return false;" title="Excluir"><i class="icon-trash"></i></button>').click(function(){
                       //pass
                   });
                   
                   var see = $('<a href="'+site_url+'uploads/' + data.model.basename + '.' + data.model.ext + '" target="_blank" class="btn tip" title="Visualizar"><i class="icon-eye-open"></i></a>');
                   
                   tr.append($('<td></td>').append(del, see));
                   $('#list-images tbody').append(tr);
               }else{
                   
               }
            },
            showMessage: function(message){
                //pass
            },
            allowedExtensions: [
                'jpg', 'jpeg', 'png'
            ]
        };
        createUploader(picture_uploader_options);
    });
    
    function createUploader(o){            
        var uploader = new qq.FileUploader({
            element: document.getElementById(o.elementId),
            action: site_url + "Midia/AjaxUpload", 
            debug: false,
            name: o.name,
            onComplete: o.onComplete,
            showMessage: o.showMessage
        });           
    }   
</script> 
<table id="list-images" class="table table-striped">
    <thead>
        <tr>
            <th>Nome</th>
            <th class="span2">Ações</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>Nome da Imagem</td>
            <td>
                <button class="btn tip" onclick="return false;" title="Excluir">
                    <i class="icon-trash"></i>
                </button>
                <a href="javascript:void(0);" target="_blank" class="btn tip" title="Visualizar">
                    <i class="icon-eye-open"></i>
                </a>
            </td>
        </tr>
    </tbody>
    <tfoot>
        <tr>
            <th>Nome</th>
            <th>Ações</th>
        </tr>
    </tfoot>
</table>
    