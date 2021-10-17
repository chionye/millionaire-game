  function showPreview(objFileInput) {
    if (objFileInput.files[0]) {
      var fileReader = new FileReader();
      fileReader.onload = function (e) {
        jQuery("#targetLayer").html('<img src="'+e.target.result+'" width="200px" height="200px" class="upload-preview" />');
        jQuery("#targetLayer").css('opacity','0.7');
        jQuery(".icon-choose-image").css('opacity','0.5');
      }
      fileReader.readAsDataURL(objFileInput.files[0]);
    }
  }

  jQuery(document).ready(function (e) {
    jQuery("#uploadForm").on('submit',function(e) {
      e.preventDefault();
      var a  = new FormData(this);
      //console.log(a);
      jQuery.ajax({
        url: "upload.php",
        type: "POST",
        data:  new FormData(this),
        beforeSend: function(){jQuery("#body-overlay").show();},
        contentType: false,
        processData:false,
        success: function(data){
          if (jQuery.trim(data) == 'ok') {
            jQuery("#targetLayer").html('upload successful!!!');
            jQuery("#targetLayer").css('opacity','1');
            //console.log(data);
          }else{
            // swal('sorry',data, 'error');
            snackbar(data);
          }
          setInterval(function() {jQuery("#body-overlay").hide(); },500);
        }           
      });
    });
  });

  jQuery(document).ready(function (e) {
    jQuery("#uploadForm1").on('submit',function(e) {
      e.preventDefault();
      var a  = $('#genreselect').val();
      jQuery.ajax({
        url: "process.php",
        type: "POST",
        data:  {genre:a},
        success: function(data){
          if (jQuery.trim(data) == 'ok') {
            var error = "Genre added successfully";
            snackbar(error);
            setTimeout(function (){window.location.replace('publications.php')}, 2000);
          }else{
            snackbar(data);
          }
        }           
      });
    });
  });

  function sendmails(){
    var name = jQuery('#name').val();
    var email = jQuery('#email').val();
    var subject = jQuery('#subject').val();
    var message = jQuery('#message').val();
    if(name =='' || subject == '' || message == ''|| email==''){
      var error = "some fields are empty";
      snackbar(error);
    }else{
     $.ajax({
      url:"../mailer/mail3.php",
      method:"post",
      cache:false,
      dataType:"text",
      data:{sendmail:1, name:name, subject:subject, message:message, email:email},
      success:function (data) {
        if ($.trim(data)=="ok") {
          var error = "Mail was sent successfully";
          snackbar(error);
          setTimeout(function () {window.location.reload();},1000);
        }else{snackbar(data);}
      }
    });
   }
 }
 function updateBookDetails(id, genreselector){
  var title = jQuery('#title').val();
  var author = jQuery('#author').val();
  var genre1 = jQuery('#'+genreselector).val();
  var message = jQuery('#message').val();
  if(title =='' || author == '' || genre1 == ''){
    var error = "some fields are empty";
    snackbar(error);
  }else{
    console.log(genre1);
    $.ajax({
      url:"process.php",
      method:"post",
      cache:false,
      dataType:"text",
      data:{insertPub:1, title:title, author:author, genre1:genre1, id:id},
      success:function (data) {
        if ($.trim(data)=="ok") {
          var error = "Details Updated successfully";
          snackbar(error);
          setTimeout(function () {window.location.reload();},1000);
        }else{snackbar(data);}
      }
    });
  }
}

function deleteUser(id){
 $.ajax({
  url:"process.php",
  method:"post",
  cache:false,
  dataType:"text",
  data:{deleteUser:1, id:id},
  success:function (data) {
    if ($.trim(data)=="ok") {
      var error = "User deleted successfully";
      snackbar(error);
      setTimeout(function () {window.location.reload();},2000);
    }else{snackbar(data);}
  }
});
}

 function deleteCode(id){
 $.ajax({
  url:"process.php",
  method:"post",
  cache:false,
  dataType:"text",
  data:{deleteCode:1, id:id},
  success:function (data) {
    if ($.trim(data)=="ok") {
      var error = "Code deleted successfully";
      snackbar(error);
      setTimeout(function () {window.location.reload();},2000);
    }else{snackbar(data);}
  }
});
}

jQuery(document).ready(function($) {
  $(document).on('click', '.generate-code', function(event) {
    event.preventDefault();
    var d = new Date();
    var code = d.getTime()+d.getDate()+d.getMonth()+d.getFullYear();
     $.ajax({
      url:"process.php",
      method:"post",
      cache:false,
      dataType:"text",
      beforeSend:function(){
        $('.generate-code').html('generating...');
      },
      data:{addNewCode:1, code:code},
      success:function (data) {
        if ($.trim(data)=="ok") {
          var error = "Code successfully generated";
          snackbar(error);
          setTimeout(function () {window.location.reload();},2000);
        }else{snackbar(data);}
      }
    });
  });
});

function deleteGenre(id){
 $.ajax({
  url:"process.php",
  method:"post",
  cache:false,
  dataType:"text",
  data:{deleteGenre:1, id:id},
  success:function (data) {
    if ($.trim(data)=="ok") {
      var error = "User deleted successfully";
      snackbar(error);
      setTimeout(function () {window.location.reload();},2000);
    }else{snackbar(data);}
  }
});
}

  function deleteQuestion(id) {
      $.ajax({
          url: "process.php",
          method: "post",
          cache: false,
          dataType: "text",
          data: { deleteQuestion: 1, id: id },
          success: function(data) {
              if ($.trim(data) == "ok") {
                  var error = "Question deleted successfully";
                  snackbar(error);
                  setTimeout(function() { window.location.reload(); }, 2000);
              } else { snackbar(data); }
          }
      });
  }
  
  function deleteGame(id) {
      $.ajax({
          url: "process.php",
          method: "post",
          cache: false,
          dataType: "text",
          data: { deleteGame: 1, id: id },
          success: function(data) {
              if ($.trim(data) == "ok") {
                  var error = "Game deleted successfully";
                  snackbar(error);
                  setTimeout(function() { window.location.reload(); }, 2000);
              } else { snackbar(data); }
          }
      });
  }
  
  
function deleteBook(id){
 $.ajax({
  url:"process.php",
  method:"post",
  cache:false,
  dataType:"text",
  data:{deleteBook:1, id:id},
  success:function (data) {
    if ($.trim(data)=="ok") {
      var error = "Book deleted successfully";
      snackbar(error);
      setTimeout(function () {window.location.reload();},2000);
    }else{snackbar(data);}
  }
});
}

function updateGenre(id){
  var genre = $('#genre').val();
  $.ajax({
    url:"process.php",
    method:"post",
    cache:false,
    dataType:"text",
    data:{editGenre1:1, id:id, genr1:genre},
    success:function (data) {
      if ($.trim(data)=="ok") {
        var error = "Genre Updated Successfully";
        snackbar(error);
        setTimeout(function () {window.location.replace('publications.php');},2000);
      }else{snackbar(data);}
    }
  });
}
