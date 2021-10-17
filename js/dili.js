function snackbar(mess){
  var x = document.getElementById("snackbar");
  x.innerHTML = mess;
  x.className = "show";
  setTimeout(function(){ x.className = x.className.replace("show", ""); }, 10000);
}

function sign(){
    var name = jQuery('#name').val();
    var phone = jQuery('#phone').val();
    var email = jQuery('#email1').val();
    var pass1 = jQuery('#pass1').val();
    var pass2 = jQuery('#pass2').val();
    var ref = jQuery('#ref').val();
    if(name =='' || email == '' || phone == '' || pass1 == '' || pass2 == ''){
        var error = "fields are empty";
        snackbar(error);
    }else{
        if(pass1.length < 6 || pass2.length < 6){
            var error = "passwords must be more that 5 characters";
            snackbar(error);
        }else{
         if(pass1 != pass2){
            var error = "passwords do not match";
            snackbar(error);
        }else{
            $.ajax({
               url:"register.php",
               method:"post",
               cache:false,
               dataType:"text",
               data:{register:1, name:name, email:email, pass:pass1, pass2:pass2, phone:phone, ref:ref},
               success:function (data) {
                if ($.trim(data)=="ok") {
                    var error = "Registeration success";
                    snackbar(error);
                    setTimeout(function () {window.location.replace('dashboard.php');},1000);
                }else{snackbar(data);}
            }
        });
        }
    }
}
}

function add_instruction(){
    var instruction = jQuery('#instruction').val();
    if(instruction ==''){
        var error = "some fields are empty";
        snackbar(error);
    }else{
     $.ajax({
        url:"process.php",
        method:"post",
        cache:false,
        dataType:"text",
        data:{instruction:1, rules:instruction},
        success:function (data) {
            if ($.trim(data)=="ok") {
                var error = "instructions have been successfully submitted";
                snackbar(error);
                setTimeout(function () {window.location.reload();},1000);
            }else{snackbar(data);}
        }
    });
    }
    }


function add_comprehension(){
    var comprehension = jQuery('#comprehension').val();
    if(comprehension ==''){
        var error = "some fields are empty";
        snackbar(error);
    }else{
     $.ajax({
        url:"process.php",
        method:"post",
        cache:false,
        dataType:"text",
        data:{comprehension:1, passage:comprehension},
        success:function (data) {
            if ($.trim(data)=="ok") {
                var error = "comprehension have been successfully submitted";
                snackbar(error);
                setTimeout(function () {window.location.reload();},1000);
            }else{snackbar(data);}
        }
    });
    }
    }

function add_questions(){
    var question = jQuery('#question').val();
    var option1 = jQuery('#answer1').val();
    var option2 = jQuery('#answer2').val();
    var option3 = jQuery('#answer3').val();
    var option5 = jQuery('#answer5').val();
    var code = jQuery('#question_code').val();
    if(question =='' || option1 == '' || option2 == '' || option3 == '' || option5 == ''){
        var error = "some fields are empty";
        snackbar(error);
    }else{
        if (code == '-select question code-' || code == '') {
            var error = "You need to select a question code";
        snackbar(error);
        }else if(code != '-select question code-' || code != ''){
     $.ajax({
        url:"process.php",
        method:"post",
        cache:false,
        dataType:"text",
        data:{ask:1, question:question, option1:option1, option2:option2, option3:option3, option5:option5, code:code},
        success:function (data) {
            if ($.trim(data)=="ok") {
                var error = "Questions have been successfully submitted";
                snackbar(error);
                setTimeout(function () {window.location.reload();},1000);
            }else{snackbar(data);}
        }
    });
    }
    }
}

function update_question_code(id){
    var question = jQuery('#code').val();
    if(code ==''){
        var error = "some fields are empty";
        snackbar(error);
    }else{
     $.ajax({
        url:"process.php",
        method:"post",
        cache:false,
        dataType:"text",
        data:{updateCode:1, code:code, id:id},
        success:function (data) {
            if ($.trim(data)=="ok") {
                var error = "Question code have been successfully edited";
                snackbar(error);
                setTimeout(function (){window.location.replace('code.php');},1000);
            }else{snackbar(data);}
        }
    });
 }
}

function update_questions(){
    var question = jQuery('#question').val();
    var option1 = jQuery('#answer1').val();
    var option2 = jQuery('#answer2').val();
    var option3 = jQuery('#answer3').val();
    var option4 = jQuery('#answer4').val();
    var option5 = jQuery('#answer5').val();
    if(question =='' || option1 == '' || option2 == '' || option3 == '' || option4 == '' || option5 == ''){
        var error = "some fields are empty";
        snackbar(error);
    }else{
     $.ajax({
        url:"process.php",
        method:"post",
        cache:false,
        dataType:"text",
        data:{update:1, question:question, option1:option1, option2:option2, option3:option3, option4:option4, option5:option5},
        success:function (data) {
            if ($.trim(data)=="ok") {
                var error = "Questions have been successfully edited";
                snackbar(error);
                setTimeout(function (){window.location.reload();},1000);
            }else{snackbar(data);}
        }
    });
 }
}
function delete_questions(){
    var question = jQuery('#question').val();
    var option1 = jQuery('#answer1').val();
    var option2 = jQuery('#answer2').val();
    var option3 = jQuery('#answer3').val();
    var option4 = jQuery('#answer4').val();
    var option5 = jQuery('#answer5').val();
    $.ajax({
        url:"process.php",
        method:"post",
        cache:false,
        dataType:"text",
        data:{delete:1, question:question, option1:option1, option2:option2, option3:option3, option4:option4, option5:option5},
        success:function (data) {
            if ($.trim(data)=="ok") {
                var error = "Questions have been successfully Deleted";
                snackbar(error);
                setTimeout(function (){window.location.replace('edit_questions.php');},1000);
            }else{snackbar(data);}
        }
    });
}
function submit_answer(number){
    var check = jQuery('#check').val();
    var quest = jQuery('#quest').val();
    $.ajax({
        url:"process.php",
        method:"post",
        cache:false,
        dataType:"text",
        data:{submit:number, check1:check, quest:quest},
        success:function (data) {
            if ($.trim(data)=="ok") {
                var error = "Loading result...";
                snackbar(error);
                setTimeout(function (){window.location.replace('edit_questions.php');},1000);
            }else{snackbar(data);}
        }
    });
}
function sendmess(){
    var name = jQuery('#name').val();
    var subject = jQuery('#subject').val();
    var message = jQuery('#message').val();
    if(name =='' || subject == '' || message == ''){
        var error = "some fields are empty";
        snackbar(error);
    }else{
     $.ajax({
        url:"../parsers/message.php",
        method:"post",
        cache:false,
        dataType:"text",
        data:{go:1, name:name, subject:subject, message:message},
        success:function (data) {
            if ($.trim(data)=="ok") {
                var error = "Message sent successfully";
                snackbar(error);
                setTimeout(function () {window.location.reload();},1000);
            }else{snackbar(data);}
        }
    });
 }
}

function cashout(){
    var bank = jQuery('#bank').val();
    var accnum = jQuery('#accnum').val();
    var amount = jQuery('#amount').val();
    if(bank =='' || accnum == '' || amount == ''){
        var error = "some fields are empty";
        snackbar(error);
    }else{
     $.ajax({
        url:"parsers/message.php",
        method:"post",
        cache:false,
        dataType:"text",
        data:{cash:1, bank:bank, accnum:accnum, amount:amount},
        success:function (data) {
            if ($.trim(data)=="ok") {
                var error = "Your request has been received and will be processed within the next 24hrs";
                snackbar(error);
                setTimeout(function () {window.location.reload();},1000);
            }else{snackbar(data);}
        }
    });
 }
}
function sendmess1(){
    var name = jQuery('#name').val();
    var subject = jQuery('#subject').val();
    var message = jQuery('#message').val();
    if(name =='' || subject == '' || message == ''){
        var error = "some fields are empty";
        snackbar(error);
    }else{
     $.ajax({
        url:"parsers/message.php",
        method:"post",
        cache:false,
        dataType:"text",
        data:{send:1, name:name, subject:subject, message:message},
        success:function (data) {
            if ($.trim(data)=="ok") {
                var error = "Message sent successfully";
                snackbar(error);
                setTimeout(function () {window.location.reload();},1000);
            }else{snackbar(data);}
        }
    });
 }
}

function updater(){
    var address = jQuery('#address').val();
    var state = jQuery('#state').val();
    var country = jQuery('#country').val();
    if(address =='' || state == '' || country == ''){
        var error = "fields are empty";
        snackbar(error);
    }else{
     $.ajax({
        url:"update_quantity.php",
        method:"post",
        cache:false,
        dataType:"text",
        data:{update_add:"1" ,address:address, state:state, country:country},
        success:function (data) {
            if ($.trim(data)=="ok") {
                var error = "Update success...";
                snackbar(error);
                setTimeout(function () {window.location.reload();},1000);
            }else{snackbar(data)}
        }
    });
 }
}

function log(){
    var email = jQuery('#email').val();
    var pass1 = jQuery('#pass3').val();
    $.ajax({
        url:"login_processor.php",
        method:"post",
        cache:false,
        dataType:"text",
        data:{log:1, email:email, pass:pass1},
        success:function (data) {
            if ($.trim(data)=="ok") {
                var error = "Welcome...";
                snackbar(error);
                setTimeout(function () {window.location.replace('dashboard.php');},1000);
            }else{snackbar(data)}
        }
    });
}

function logadmin(){
    var email = jQuery('#email').val();
    var pass1 = jQuery('#pass3').val();
    $.ajax({
        url:"../login_processor.php",
        method:"post",
        cache:false,
        dataType:"text",
        data:{email:email, pass:pass1, admin:1},
        success:function (data) {
            if ($.trim(data)=="ok") {
                var error = "Welcome...";
                snackbar(error);
                setTimeout(function () {window.location.replace('home.php');},1000);
            }else{snackbar(data)}
        }
    });
}

function update_details(){
    var phone = jQuery('#phone').val();
    var email = jQuery('#email').val();
    $.ajax({
        url:"register.php",
        method:"post",
        cache:false,
        dataType:"text",
        data:{update:1, email:email, phone:phone},
        success:function (data) {
            if ($.trim(data)=="ok") {
                var error = "Update success";
                snackbar(error);
                setTimeout(function () {window.location.reload();},1000);
            }else{snackbar(data)}
        }
    });
}
function update_details1(){
    var phone = jQuery('#phone').val();
    var email = jQuery('#email').val();
    var name = jQuery('#name').val();
    var balance = jQuery('#balance').val();
    var package = jQuery('#package').val();
    var ref = jQuery('#ref').val();
    var id = jQuery('#id').val();
    $.ajax({
        url:"../register.php",
        method:"post",
        cache:false,
        dataType:"text",
        data:{update_user:1, email:email, phone:phone, name:name, balance:balance, package:package, id:id, ref:ref},
        success:function (data) {
            if ($.trim(data)=="ok") {
                var error = "Update success";
                snackbar(error);
                setTimeout(function () {window.location.reload();},1000);
            }else{snackbar(data)}
        }
    });
}
function pay(type){
    var pack = type;
    if(type == 'silver'){
        var amount = 1000;
    }else if (type == 'gold') {
        var amount = 1500;
    }else if (type == 'diamond') {
        var amount = 2000;
    }
    $.ajax({
        url:"parsers/initialize2.php",
        method:"post",
        cache:false,
        dataType:"text",
        data:{update:1, pack:pack, amount:amount},
        success:function (data) {
            if ($.trim(data)=="ok") {
                var error = "Update success";
                snackbar(error);
                setTimeout(function () {window.location.reload();},1000);
            }else{snackbar(data)}
        }
    });
}
function changepass(){
    var pass1 = jQuery('#pass1').val();
    var pass2 = jQuery('#pass2').val();
    $.ajax({
        url:"register.php",
        method:"post",
        cache:false,
        dataType:"text",
        data:{changepass:1, pass:pass1, pass2:pass2},
        success:function (data) {
            if ($.trim(data)=="ok") {
                var error = "Password changed successfully";
                snackbar(error);
                setTimeout(function () {window.location.reload();},1000);
            }else{snackbar(data)}
        }
    });
}


$(document).ready(function () {
    $(document).on('click', '.cta', function () {
        $(this).toggleClass('active')
    })
});


$(document).ready(function(){
    $(".hamburger").click(function(){
        $('.sidebar-menu').removeClass("flowHide");  
        $(".sidebar-menu").toggleClass("full-side-bar");
        $('.nav-link-name').toggleClass('name-hide');        
    });
});





$(document).ready(function () {    
  $(".nav-link").hover(function () {           
      $('.sidebar-menu').removeClass("flowHide");  
      $(this).addClass('tax-active');

  }, function () {
      $('.sidebar-menu')
      .addClass("flowHide");
      $(this).removeClass('tax-active');

  });    
});