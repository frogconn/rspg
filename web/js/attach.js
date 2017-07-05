$(function(){
    var uploadButton = $('#photo-upload');
    var uploadingText = $('#uploading-text');
    var uploadingTextInterval;
    var filesList = $('#files-list');
    var deleteButton = $('.btn-delete-file');

    uploadButton.on('click', function(){
        $('#photo-file').trigger('click');
    });
    $('#photo-file').on('change', function(){

        var $this = $(this);
        var url = $(this).attr('urlto');
        uploadButton.addClass('disabled');
        uploadButton.html('<i class="fa fa-circle-o-notch fa-spin"></i> กำลังอัพโหลดไฟล์..');
        $('.files-error').hide();
        $('.files-error ul').html('');
        uploadingText.show();

        var uploaded = 0;
        var count = $($this.prop('files')).length;

        $.each($this.prop('files'), function(i, file){

            if(/^image\/(jpeg|png|gif)$/.test(file.type) || /^application\/(pdf)$/.test(file.type) )
            {

              if(file.size > 10485760){
                showErrorMessageUpload(file.name,'ขนาดไฟล์ต้องไม่เกิน 10M');
                if(++uploaded >= $this.prop('files').length)
                {
                    clearButtonUpload();
                }

              }else{

                var formData = new FormData();
                formData.append('AttachFiles[name]', file);

                $.ajax({
                      url : url,
                      type: "POST",
                      data : formData,
                      contentType: false,
                      cache: false,
                      processData:false,
                      dataType: 'json',
                      xhr: function(){
                          var xhr = $.ajaxSettings.xhr();
                          if (xhr.upload) {
                              xhr.upload.addEventListener('progress', function(event) {
                                  var percent = 0;
                                  var position = event.loaded || event.position;
                                  var total = event.total;
                                  if (event.lengthComputable) {
                                      percent = Math.ceil(position / total * 100);
                                  }

                                  if($('[data-name="'+file.name+'"]').length == 0){
                                    $('.upload-progress').prepend('<div class="progress"><div data-name="'+file.name+'" class="progress-bar progress-bar-success" role="progressbar" aria-valuemin="0" aria-valuemax="100" >'+file.name+' (<span class="percent-progress">'+percent+'</span>%)</div></div>');
                                    $('[data-name="'+file.name+'"]').css("width", + percent +"%");
                                  }else{
                                    $('[data-name="'+file.name+'"]').css("width", + percent +"%");
                                    $('[data-name="'+file.name+'"]').child('percent-progress').html(percent);
                                  }

                                  if(percent == 100){
                                    setTimeout(function(){
                                      $('[data-name="'+file.name+'"]').parent('.progress').remove();
                                    }, 700);

                                  }

                                  //showErrorMessageUpload(file.name,percent);
                                  //console.log(file);

                              }, true);
                          }
                          return xhr;
                      },
                      mimeType:"multipart/form-data"
                  }).done(function(response){
                      if(response.result === 'success'){
                        filesList.html(response.files_list);
                      }
                      if(++uploaded >= $this.prop('files').length)
                      {
                          clearButtonUpload();
                          clearProgressUpload();
                      }
                  });



              }


            }else {
                showErrorMessageUpload(file.name,'รูปแบบไฟล์ไม่ถูกต้อง');
                if(++uploaded >= $this.prop('files').length)
                {
                    clearButtonUpload();
                }
            }

        });

        if(count == 0){
          clearButtonUpload();
        }

    });

    function showErrorMessageUpload(name,message){
      $('.files-error').show();
      $('.files-error ul').prepend('<li><b>'+name+'</b> '+message+'</li>');
    }

    function clearButtonUpload(){
      uploadButton.removeClass('disabled');
      uploadButton.html('<i class="glyphicon glyphicon-folder-open"></i>&nbsp;&nbsp;เลือกไฟล์..');
    }

    function clearProgressUpload(){
      $('.upload-progress').html('');
    }

    $(document).on("click",".btn-delete-file",function() {
        var id = $(this).attr('data-id');
        var url = $(this).attr('data-url');
        if (confirm('คุณแน่ใจหรือไม่ที่จะลบรายการนี้?')) {
        $.ajax({
            url: url,
            dataType: 'json',
            data: {id : id},
            type: 'post',
            success: function(response){
                if(response.result === 'success'){
                  filesList.html(response.files_list);
                }
            }
        });
      }
    });

    var dots = 0;
    function dotsAnimation() {
        dots = ++dots % 4;
        $("span", uploadingText).html(Array(dots+1).join("."));
    }
});
