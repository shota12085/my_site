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
        let html = `<div class='image-top' data-id = "${data.files.length}" data-name="${file.name}">
      <div class=' image-content'>
      <div class='image-list'>
      <img src=${image} width="120" height="100" >
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
    let dataDelete = $(imageDelete).data('id');
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
});
