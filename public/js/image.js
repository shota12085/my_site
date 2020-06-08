$(function(){
  let data = new DataTransfer();
  
  let fileReader = new FileReader();

  let fileSet = document.querySelector('input[type=file]');
  $(fileSet).on('change', function(){
    files = $(fileSet).prop('files')[0];
    $.each(fileSet.files, function(i, file){
      data.items.add(file)
      fileSet.files = data.files
      fileReader.readAsDataURL(file);
      fileReader.onload = function(){
        let image = fileReader.result
        let html = `<div class='image-top'>
                      <div class=' image-content'>
                        <div class='image-list'>
                          <img src=${image} width="138.5" height="120" >
                        </div>
                      </div>
                      <div class='image-delete'>
                        <div class='image-delete__btn'>削除</div>
                      </div>
                    </div>`
      $(".image-up").append(html);
      
      }
    })
  })
  
  $(document).on("click", ".image-delete__btn", function(){
    let imageDelete =  $(this).parent().parent();
    let dataName = $(imageDelete).data('name');
    if(fileSet.files.length==1){
      $('input[type=file]').val(null)
      data.clearData();
      } else {
        $.each(fileSet.files, function(i,input){
          if(input.name == dataName){
            data.items.remove(i)
          }
        })
      }
      imageDelete.remove();
      fileSet.files = data.files
      
      let num = $(".image-top").length
      if(num==3){
        $(fileSet).show();
      }
  })

  $(document).on("change", "#form-image", function(){
    let Num = $(".image-top").length + 1
    if(Num==4){
      $(fileSet).hide();
    }
  });
  
  $(document).on('click',".form-delete",function(){
    let id = $(this).data('id');
    let del = $(this).parents('.image-top');
    $(del).remove();
    $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });
    $.ajax({
      url: "/photos/" + id,
      type: "POST",
      data: {"id":id,"_method": "DELETE"}
    });

    let num = $(".image-top").length
    let html = `<label class = "label-create" for="form-image">image</label>
                <input type="file" name="image[]" class = "form-image add-form" id="form-image" multiple="multiple">`

    if(num == 3){
      $("#form-append").append(html);

      let fileSet = document.querySelector('input[type=file]');
      $(fileSet).on('change', function(){
      files = $(fileSet).prop('files')[0];
      $.each(fileSet.files, function(i, file){
        data.items.add(file)
        fileSet.files = data.files
        fileReader.readAsDataURL(file);
        fileReader.onload = function(){
          let image = fileReader.result
          let html = `<div class='image-top'">
                        <div class=' image-content'>
                          <div class='image-list'>
                            <img src=${image} width="138.5" height="120" >
                          </div>
                        </div>
                        <div class='image-delete'>
                          <div class='add-btn'>削除</div>
                        </div>
                      </div>`
            $(".image-up").append(html);
          }
        })
      })
      $(document).on("click", ".add-btn", function(){
        let imageDelete =  $(this).parent().parent();
        let dataName = $(imageDelete).data('name');
        if(fileSet.files.length==1){
          $('input[type=file]').val(null)
          data.clearData();
          } else {
            $.each(fileSet.files, function(i,input){
              if(input.name == dataName){
                data.items.remove(i)
              }
            })
          }
          imageDelete.remove();
          fileSet.files = data.files
          
          let num = $(".image-top").length
          if(num==3){
            $(fileSet).show();
          }
      })
      $(document).on("change", "#form-image", function(){
        let Num = $(".image-top").length + 1
        if(Num==4){
          $(fileSet).hide();
        }
      });
    }
  });
})



$(function(){
  if(document.URL.match(/posts/)){
    const bigPic = document.getElementById('bigPic');
    const thumbs = document.getElementsByClassName('thumb');
    const modal = document.getElementById('modal');
    const modalImage = document.getElementById('modalImage');
    const close = document.getElementById('close')
    for(let thumb of thumbs) {
      thumb.addEventListener('mouseover', () => {
        bigPic.src = thumb.src;
      })
    }
    $(thumbs).on('click', function(){
      let dataName = $(this).data('name');
      modal.classList.remove('displayNone');
      modalImage.src = dataName;
    })
    
    close.addEventListener('click' , () => {
      modal.classList.add('displayNone');
    });
  }
})
  