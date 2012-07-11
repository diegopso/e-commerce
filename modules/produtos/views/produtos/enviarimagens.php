<fieldset class="profile-fieldset">
    <div id="file-uploader-cover-picture">		
        <noscript>			
        <p>Por favor, ative o JavaScript para utilizar esta funcionalidade.</p>
        </noscript>         
    </div>
    
</fieldset>
<link rel="stylesheet" type="text/css" href="~/app/wwwroot/media/css/fileuploader.css"></link>
<script type="text/javascript" src="~/app/wwwroot/media/js/fileuploader.js"></script>
<script type="text/javascript">  
    $(document).ready(function(){
        var cover_picture_uploader_options = {
            name: 'cover-picture-uploader',
            elementId: 'file-uploader-cover-picture',
            onComplete: function(data){
               //pass
            },
            showMessage: function(message){
                //pass
            }
        };
        
        createUploader(cover_picture_uploader_options);
    });
    
    function createUploader(o){            
        var uploader = new qq.FileUploader({
            element: document.getElementById(o.elementId),
            action: '<?= site_url ?>Midia/AjaxUpload', 
            debug: false,
            name: o.name,
            onComplete: o.onComplete,
            showMessage: o.showMessage
        });           
    }   
</script> 