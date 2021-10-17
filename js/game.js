(function(argument) {
    $(".game-btn").on('mouseenter', function(event) {
        $(this).addClass("animated shake");
    });
    $(".game-btn").on("webkitAnimationEnd mozAnimationEnd oAnimationEnd animationEnd", function(event) {
        $(this).removeClass("animated shake");
    });

    $('.modal').on('show.bs.modal', function(e) {
        $('.modal .modal-dialog').attr('class', 'modal-dialog  flipInX  animated');
    });
    $('.modal').on('hide.bs.modal', function(e) {
        $('.modal .modal-dialog').attr('class', 'modal-dialog  flipOutX  animated');
    });
    $('.modal').on('show.bs.modal', function(e) {
        $('.modal .modal-dialog').attr('class', 'modal-dialog  flipInX  animated');
    });
    $('.modal').on('hide.bs.modal', function(e) {
        $('.modal .modal-dialog').attr('class', 'modal-dialog  flipOutX  animated');
    });
})();

function someTimer(duration, display) {
    var timer = duration,
        minutes, seconds;
    setInterval(function() {
        minutes = parseInt(timer / 60, 10);
        seconds = parseInt(timer % 60, 10);

        minutes = minutes < 10 ? "0" + minutes : minutes;
        seconds = seconds < 10 ? "0" + seconds : seconds;

        display.textContent = minutes + ":" + seconds;

        if (--timer == 1) {
            // timer = duration;
            // clearInterval(someTimer);
            var game = sessionStorage.getItem("game_code");
            $.ajax({
                url: 'process.php',
                type: 'post',
                dataType: 'json',
                data: { cancel: 1, game: game, player: 'p1' },
                success: function(res) {
                    if (res.success) {
                        swal({
                            title: 'Time Up!',
                            text: 'Your waiting time is over...please retry or contact support',
                            icon: "success"
                        })
                        setTimeout(() => window.location.replace('dashboard.php'), 3000);
                    }
                }
            })
        }
    }, 1000);
}

var current = document.URL.split('/');
var len = current.length;




function setCookie(cname, cvalue, exdays) {
    var d = new Date();
    d.setTime(d.getTime() + (exdays * 24 * 60 * 60 * 1000));
    var expires = "expires=" + d.toUTCString();
    document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
}

function getCookie(cname) {
    var name = cname + "=";
    var decodedCookie = decodeURIComponent(document.cookie);
    var ca = decodedCookie.split(';');
    for (var i = 0; i < ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0) == ' ') {
            c = c.substring(1);
        }
        if (c.indexOf(name) == 0) {
            return c.substring(name.length, c.length);
        }
    }
    return "";
}

if (current[len - 1] == "start.php") {
    if (getCookie('currentGame') != '' || getCookie('currentGame') != undefined || getCookie('currentGame') != null) {
        var json = getCookie('currentGame') != ''?JSON.parse(getCookie('currentGame')):'';
        $.ajax({
            url: 'process.php',
            method: "post",
            cache: false,
            dataType: "json",
            data: { refresh: 1, game: json.game, player: json.player },
            success: function(res) {
                setCookie('currentGame', '', -1);
                console.log(res);
            }
        });
    }
}

var pairPlayer = (player, code = null) => {
    if (player == 'p1') {
        $.ajax({
            url: 'process.php',
            method: "post",
            cache: false,
            dataType: "json",
            data: { checkIfPlayerAdded: 1, code: code },
            success: function(res) {
                console.log(res);
                if (res.game.p2_stat == 'available') {
                    var p1_img = res.p1_data.picture == '' || res.p1_data.picture == null ? 'images/profile.png' : res.p1_data.picture;
                    var p2_img = res.p2_data.picture == '' || res.p2_data.picture == null ? 'images/profile.png' : res.p2_data.picture;
                    $('.load').html(`<div class="row justify-content-center p-3"><div class="col-md-8"><div class="row"><div class="col-md-5 text-center"><img src="${p1_img}" class="img-thumbnail rounded-circle img-p1"><p class="title-text txt-p1">You</p></div><div class="col-md-2 text-center"><div class="d-flex justify-content-center align-items-center h-100"><h1 class="title-text">vs</h1></div></div><div class="col-md-5 text-center"><img src="${p2_img}" class="img-thumbnail rounded-circle img-p2"><p class="title-text txt-p2">${res.p2_data.customername}</p></div><div class="col-md-12 text-center"><button class="btn btn-outline-primary" id="chatBtn">chat</button><button class="btn btn-outline-primary ready ml-1 mr-1" id="p1_${code}">I'm Ready</button><button class="btn btn-outline-danger cancel-p1">cancel</button></div></div></div></div>`);

                }

                if (res.game.p2_stat == 'waiting') {
                    pairPlayer('p1', code);
                }
            }
        });
    }
}

const API_publicKey = "FLWPUBK-3595b345ccba99e067e55137d0c21c57-X";


function payWithPaystack() {
    var form = new FormData(document.getElementById('amountSelection'));
    var data = form.get('gridRadios');
    var phone = form.get('phone');
    var email = form.get('email');
    var amount = data;
    data += '00';
    var ref = '' + Math.floor((Math.random() * 1000000000) + 1);
    var x = getpaidSetup({
         PBFPubKey: API_publicKey,
        customer_email: email,
        amount: amount,
        customer_phone: phone,
        currency: "NGN",
        txref: ref,
        meta: [{
            metaname: "flightID",
            metavalue: "AP1234"
        }],
        onclose: function() {},
        callback: function(response) {
            var txref = response.data.txRef; // collect txRef returned and pass to a                    server page to complete status check.
            console.log("This is the response returned after a charge", response);
            // console.log(data);
                $.ajax({
                url: 'process.php',
                method: "post",
                cache: false,
                dataType: "json",
                data: { paytoplay: 1, amount: amount, ref: ref, email: 'dndchallenge2020@gmail.com' },
                success: function(res) {
                    if (res.success) {
                        sessionStorage.setItem("game_code", res.game_code);
                        if (res.player == 'p1') {
                            var deets = { "player": "p1", "game": res.game_code };
                            setCookie('currentGame', JSON.stringify(deets), 1);
                            var img = res.user.picture == '' || res.user.picture == null ? 'images/profile.png' : res.user.picture;
                            $('.load').html(`<div class="row justify-content-center p-3"><div class="col-md-8"><div class="row"><div class="col-md-5 text-center"><img src="${img}" class="img-thumbnail rounded-circle img-p1"><p class="title-text txt-p1">You</p></div><div class="col-md-2 text-center"><div class="d-flex justify-content-center align-items-center h-100"><h1 class="title-text">vs</h1><div>Time left to match player <span id="time" class="title-text">00:00</span> minutes!</div></div></div><div class="col-md-5 text-center"><img src="images/loader1.gif"  class="img-fluid"><p class="title-text">Looking for player</p></div><div class="col-md-12 text-center"><button class="btn btn-outline-primary"  id="chatBtn">chat</button><button class="btn btn-outline-primary ready" disabled = "disabled"  id="p1_${res.game_code}">I'm Ready</button><button class="btn btn-outline-danger cancel-p1">cancel</button></div></div></div></div>`);
                            pairPlayer('p1', res.game_code);
                            sessionStorage.setItem("player", "p1");
                             var fiveMinutes = 60 * 10,
                                display = document.querySelector('#time');
                            someTimer(fiveMinutes, display);
                        }
                        if (res.player == 'p2') {
                            var deets = { "player": "p2", "game": res.game_code };
                            setCookie('currentGame', JSON.stringify(deets), 1);
                            var p1_img = res.p1_data.picture == '' || res.p1_data.picture == null ? 'images/profile.png' : res.p1_data.picture;
                            var p2_img = res.user.picture == '' || res.user.picture == null ? 'images/profile.png' : res.user.picture;
                            $('.load').html(`<div class="row justify-content-center p-3"><div class="col-md-8"><div class="row"><div class="col-md-5 text-center"><img src="${p1_img}" class="img-thumbnail rounded-circle"><p class="title-text">${res.p1_data.customername}</p></div><div class="col-md-2 text-center"><div class="d-flex justify-content-center align-items-center h-100"><h1 class="title-text">vs</h1></div></div><div class="col-md-5 text-center"><img src="${p2_img}" class="img-thumbnail rounded-circle img-p2"><p class="title-text txt-p2">You</p></div><div class="col-md-12 text-center"><button class="btn btn-outline-primary" id="chatBtn">chat</button><button class="btn btn-outline-primary ready ml-1 mr-1" id="p2_${res.game_code}">I'm Ready</button><button class="btn btn-outline-danger cancel-p2">cancel</button></div></div></div></div>`);
                            sessionStorage.setItem("player", "p2");
                            pairPlayer('p2', res.game_code);
                        }
                    }
                }
            });
        }
    });
}

// function payWithPaystack() {

//     FlutterwaveCheckout({
//         public_key: API_publicKey,
//         tx_ref: '' + Math.floor((Math.random() * 1000000000) + 1),
//         amount: amount,
//         currency: "NGN",
//         payment_options: "card, banktransfer, ussd, account",
//         customer: {
//             email: "santamichello@gmail.com",
//         },
//         callback: function(response) {
//             // console.log(data);
//             if (
//                 response.tx.chargeResponseCode == "00" ||
//                 response.tx.chargeResponseCode == "0"
//             ) {

//             } else {

//             }
//         },
//         customizations: {
//             title: "DnDChallenge",
//             description: "Payment for subcription",
//             logo: "https://dndchallenge.com/assets/img/logo1.png",
//         },
//     });
// }


// function payWithPaystack() {
//     var form = new FormData(document.getElementById('amountSelection'));
//     var data = form.get('gridRadios');
//     var amount = data;
//     data += '00';
//     var x = getpaidSetup({
//         PBFPubKey: API_publicKey,
//         amount: amount,
//         currency: "NGN",
//         customer_email: 'santamichello@gmail.com',
//         txref: '' + Math.floor((Math.random() * 1000000000) + 1),
//         meta: [{
//             metaname: "play",
//             metavalue: "subscription"
//         }],
//         callback: function(response) {
//             if (
//                 response.tx.chargeResponseCode == "00" ||
//                 response.tx.chargeResponseCode == "0"
//             ) {
//                 $.ajax({
//                     url: 'process.php',
//                     method: "post",
//                     cache: false,
//                     dataType: "json",
//                     data: { paytoplay: 1, amount: amount, ref: response.reference, email: 'santamichello@gmail.com' },
//                     success: function(res) {
//                         if (res.success) {
//                             sessionStorage.setItem("game_code", res.game_code);
//                             if (res.player == 'p1') {
//                                 var img = res.user.picture == '' || res.user.picture == null ? 'images/profile.png' : res.user.picture;
//                                 $('.load').html(`<div class="row justify-content-center p-3"><div class="col-md-8"><div class="row"><div class="col-md-5 text-center"><img src="${img}" class="img-thumbnail rounded-circle img-p1"><p class="title-text txt-p1">You</p></div><div class="col-md-2 text-center"><div class="d-flex justify-content-center align-items-center h-100"><h1 class="title-text">vs</h1></div></div><div class="col-md-5 text-center"><img src="images/loader1.gif"  class="img-fluid"><p class="title-text">Looking for player</p></div><div class="col-md-12 text-center"><button class="btn btn-outline-primary" id="chatBtn">chat</button><button class="btn btn-outline-primary ready" disabled = "disabled"  id="p1_${res.game_code}">I'm Ready</button><button class="btn btn-outline-danger cancel-p1">cancel</button></div></div></div></div>`);
//                                 pairPlayer('p1', res.game_code);
//                                 sessionStorage.setItem("player", "p1");
//                             }
//                             if (res.player == 'p2') {
//                                 var p1_img = res.p1_data.picture == '' || res.p1_data.picture == null ? 'images/profile.png' : res.p1_data.picture;
//                                 var p2_img = res.user.picture == '' || res.user.picture == null ? 'images/profile.png' : res.user.picture;
//                                 $('.load').html(`<div class="row justify-content-center p-3"><div class="col-md-8"><div class="row"><div class="col-md-5 text-center"><img src="${p1_img}" class="img-thumbnail rounded-circle"><p class="title-text">${res.p1_data.customername}</p></div><div class="col-md-2 text-center"><div class="d-flex justify-content-center align-items-center h-100"><h1 class="title-text">vs</h1></div></div><div class="col-md-5 text-center"><img src="${p2_img}" class="img-thumbnail rounded-circle img-p2"><p class="title-text txt-p2">You</p></div><div class="col-md-12 text-center"><button class="btn btn-outline-primary" id="chatBtn">chat</button><button class="btn btn-outline-primary ready ml-1 mr-1" id="p2_${res.game_code}">I'm Ready</button><button class="btn btn-outline-danger cancel-p2">cancel</button></div></div></div></div>`);
//                                 sessionStorage.setItem("player", "p2");
//                                 pairPlayer('p2', res.game_code);
//                             }
//                         }
//                     }
//                 });
//             } else {
//                 swal('sorry', 'payment didnt go through, please try other mediums', 'error');
//             }
//             x.close();
//         },
//         onClose: function() {
//             // alert('window closed');
//         }
//     });
// }

var updateGamesPlayed = (gme) => {
    var p1 = gme.player1;
    var p2 = gme.player2;
    var game = gme.question_type;
    $.ajax({
        url: 'process.php',
        method: "post",
        cache: false,
        dataType: "json",
        data: { updateGamesPlayed: 1, game: game, p1: p1, p2: p2 },
        success: function(res) {
            console.log(res);
        }
    });
}

function shuffle(array) {
    var currentIndex = array.length,
        temporaryValue, randomIndex;

    // While there remain elements to shuffle...
    while (0 !== currentIndex) {

        // Pick a remaining element...
        randomIndex = Math.floor(Math.random() * currentIndex);
        currentIndex -= 1;

        // And swap it with the current element.
        temporaryValue = array[currentIndex];
        array[currentIndex] = array[randomIndex];
        array[randomIndex] = temporaryValue;
    }

    return array;
}

var readyUser = (user, code) => {
    $.ajax({
        url: 'process.php',
        type: 'post',
        beforeSend: function() { $(`.ready`).html(`Waiting for opponent...`) },
        dataType: 'json',
        data: { readyUser: 1, code: code, user: user },
        success: function(res) {
            console.log(res);
            if (res.success) {
                if (res.data.p1_stat == 'ready' && res.data.p2_stat == 'ready') {
                    if (user == 'p1') {
                        updateGamesPlayed(res.data);
                    }
                    $(`.ready`).html('Starting Game...');
                    if (typeof Storage !== "undefined") {
                        $shuffld = shuffle(res.questions)
                        localStorage.setItem("question", JSON.stringify($shuffld));
                        setTimeout(() => { window.location.href = 'game.php' }, 5000);
                    } else {
                        alert('please use chrome browser');
                    }
                } else {
                    readyUser(user, code);
                }
            }
        }
    });
}

jQuery(document).ready(function($) {
    $(document).on('click', '.ready', function(event) {
        var id = $(this).attr('id');
        id = id.split('_');
        var user = id[0];
        var code = id[1];
        readyUser(user, code);
    });
});



var number = 0;
var num;
var total = 0;
var loadGame = () => {
    if (localStorage.getItem("question") !== null) {
        var game = JSON.parse(localStorage.getItem("question"));
        total = game.length;
        $('#question').html('').fadeOut('fast');
        $('#ans1').html('').fadeOut('fast');
        $('#ans2').html('').fadeOut('fast');
        $('#ans3').html('').fadeOut('fast');
        $('#ans4').html('').fadeOut('fast');
        setTimeout(function() {
            if (number < total) {
                var answers = [];
                num = number + 1;
                $('#question').html(`${num}. ${game[number].question}`).fadeIn('fast');
                game[number].answers.forEach((ans) => {
                    if (ans.qu_id == game[number].id) {
                        answers.push(ans);
                    }
                });
                answers = shuffle(answers);
                $('#ans1').html(`<div class="custom-control custom-radio"><input type="radio" id="customRadio1" name="answer" value="${answers[0].id}" class="custom-control-input"><label class="custom-control-label" for="customRadio1">${answers[0].ans}</label></div>`).fadeIn('fast');
                $('#ans2').html(`<div class="custom-control custom-radio"><input type="radio" id="customRadio2" name="answer" value="${answers[1].id}" class="custom-control-input"><label class="custom-control-label" for="customRadio2">${answers[1].ans}</label></div>`).fadeIn('fast');
                $('#ans3').html(`<div class="custom-control custom-radio"><input type="radio" id="customRadio3" name="answer" value="${answers[2].id}" class="custom-control-input"><label class="custom-control-label" for="customRadio3">${answers[2].ans}</label></div>`).fadeIn('fast');
                $('#ans4').html(`<div class="custom-control custom-radio"><input type="radio" id="customRadio4" name="answer" value="${answers[3].id}" class="custom-control-input"><label class="custom-control-label" for="customRadio4">${answers[3].ans}</label></div>`).fadeIn('fast');
            }
        }, 1000);
    }
}

$(document).ready(function($) {
    loadGame();
});

function getTimeRemaining(endtime) {
    const total = Date.parse(endtime) - Date.parse(new Date());
    const seconds = Math.floor((total / 1000) % 60);
    const minutes = Math.floor((total / 1000 / 60) % 60);
    const hours = Math.floor((total / (1000 * 60 * 60)) % 24);
    // const days = Math.floor(total / (1000 * 60 * 60 * 24));

    return {
        total,
        hours,
        minutes,
        seconds
    };
}

function initializeClock(id, endtime) {
    const clock = document.getElementById(id);
    // const daysSpan = clock.querySelector('.days');
    const hoursSpan = clock.querySelector('.hours');
    const minutesSpan = clock.querySelector('.minutes');
    const secondsSpan = clock.querySelector('.seconds');

    function updateClock() {
        const t = getTimeRemaining(endtime);

        // daysSpan.innerHTML = t.days;
        hoursSpan.innerHTML = ('0' + t.hours).slice(-2);
        minutesSpan.innerHTML = ('0' + t.minutes).slice(-2);
        secondsSpan.innerHTML = ('0' + t.seconds).slice(-2);

        if (t.total <= 0) {
            endTime();
        }
    }

    function endTime() {
        clearInterval(timeinterval);
        sessionStorage.setItem('currTime', '');
        // sessionStorage.setItem("game_code", '');
        $('.countDown').html('Time Up!');
        nextQuest();
    }

    updateClock();
    const timeinterval = setInterval(updateClock, 1000);
}

if (current[len - 1] == "start.php") {
    sessionStorage.setItem('currTime', '');
}
if (current[len - 1] == "game.php") {
    if (sessionStorage.getItem('currTime') == '' || sessionStorage.getItem('currTime') == null) {
        const deadline = new Date(Date.parse(new Date()) + 90 * 1000);
        sessionStorage.setItem('currTime', deadline);
    }
    console.log(sessionStorage.getItem('currTime'));
    initializeClock('clockdiv', sessionStorage.getItem('currTime'));
}

function updateScoreSheetnRecord(json) {
    $('.p1Score').html(json.p1_score);
    $('.p2Score').html(json.p2_score);
    $('.p1Time').html(json.p1_time);
    $('.p2Time').html(json.p2_time);
    console.log(json.p1_score, json.p2_score);
    if (json.p1_score > json.p2_score) {
        $('.p1Result').html('You Won').css({ 'color': 'green' });
        $('.p2Result').html('You Lost').css({ 'color': 'green' });
        var winner = 'p1';
    }
    if (json.p1_score < json.p2_score) {
        $('.p2Result').html('You Won');
        $('.p1Result').html('You Lost');
        var winner = 'p2';
    }

    if (json.p1_score == json.p2_score) {
        $('.p2Result').html('Draw');
        $('.p1Result').html('Draw');
        var winner = '';
    }
    $.ajax({
        url: 'process.php',
        type: 'POST',
        dataType: 'json',
        data: { updateScoreSheetnRecord: 1, winner: winner, code: json.game_code },
        success: function() {

        }
    })
}

function checkAgain(code) {
    $.ajax({
        url: 'process.php',
        type: 'POST',
        dataType: 'json',
        data: { getGameDetails: code },
        success: function(res) {
            if (res.p1_stat == 'completed' && res.p2_stat == 'completed') {
                var details = JSON.parse(sessionStorage.getItem('result'));
                details.game_details = res;
                sessionStorage.setItem('result', JSON.stringify(res));
                updateScoreSheetnRecord(res);
            } else {
                setTimeout(checkAgain, 2000, code);
            }
        }
    });
}

function tally() {
    var details = JSON.parse(sessionStorage.getItem('result'));
    $('.p1-pic').attr({ 'src': details.p1.picture });
    $('.p2-pic').attr({ 'src': details.p2.picture });
    $('.p1Name').html(details.p1.customername);
    $('.p2Name').html(details.p2.customername);
    if (details.game_details.p1_stat == 'completed') {
        $('.p1Time').html(details.game_details.p1_time);
        $('.p1Score').html(details.game_details.p1_score);
    }
    if (details.game_details.p2_stat == 'completed') {
        $('.p2Time').html(details.game_details.p2_time);
        $('.p2Score').html(details.game_details.p2_score);
    }
    if (details.game_details.p1_stat != 'completed' || details.game_details.p2_stat != 'completed') {
        if (details.game_details.p1_stat != 'completed') {
            $('.p1Score').html('still playing');
            $('.p1Time').html('still playing');
            checkAgain(details.game_details.game_code);
        }
        if (details.game_details.p2_stat != 'completed') {
            $('.p2Score').html('still playing');
            $('.p2Time').html('still playing');
            checkAgain(details.game_details.game_code);
        }
    }
    if (details.game_details.p1_stat == 'completed' && details.game_details.p2_stat == 'completed') {
        if (parseInt(details.game_details.p1_score) > parseInt(details.game_details.p2_score)) {
            $('.p1Result').html('You Won');
            $('.p2Result').html('You Lost');
        }
        if (parseInt(details.game_details.p1_score) < parseInt(details.game_details.p2_score)) {
            $('.p2Result').html('You Won');
            $('.p1Result').html('You Lost');
        }
        if (parseInt(details.game_details.p1_score) == parseInt(details.game_details.p2_score)) {
            $('.p2Result').html('Draw');
            $('.p1Result').html('Draw');
        }
    }
}

if (current[len - 1] == "result.php") {
    tally();
}

var answers = {};

var nextQuest = () => {
    if (number < total - 1 && sessionStorage.getItem('currTime') != '') {
        answers[num] = $('input[name = answer]:checked').val();
        number++;
        loadGame();
    } else {
        answers[num] = $('input[name = answer]:checked').val();
        var title = sessionStorage.getItem('currTime') != '' ? "Are you sure?" : "Time Up!!!";
        var text = sessionStorage.getItem('currTime') != '' ? "Once submitted, you cannot undo this action" : "Click ok to continue";
        var options = sessionStorage.getItem('currTime') != '' ? { title: title, text: title, icon: "warning", buttons: true, dangerMode: true } : { title: title, text: title, icon: "warning", buttons: true, dangerMode: true, closeOnClickOutside: false, cancel: { text: "Cancel", value: null, visible: false, className: "", closeModal: false, } };
        if ($('.sweetalert.visible').length > 0) {
            answers['checkForCorrectAns'] = 'check';
            // clearInterval(timeinterval);
            var timing = $('.hours').html() + ":" + $('.minutes').html() + ":" + $('.seconds').html();
            answers['game'] = sessionStorage.getItem("game_code");
            answers['timing'] = timing;
            answers['player'] = sessionStorage.getItem("player");
            var user = sessionStorage.getItem("player");
            $.ajax({
                url: 'process.php',
                type: 'POST',
                dataType: 'json',
                beforeSend: () => {
                    swal({ text: 'please wait while we calculate your score', icon: "images/loader.gif", buttons: false, closeOnClickOutside: false });
                    $('.swal-modal').css({ 'background-color': ' rgba(0,0,0,0)', "border": 'none' });
                    $('.swal-text').css({ 'color': ' rgba(244,244,244,1)', "border": 'none', 'font-family': "'gothic-game',sans-serif" });
                },
                data: answers,
                success: function(res) {
                    sessionStorage.setItem('result', JSON.stringify($res));
                    // repeater(res, user);
                    setTimeout(() => {
                        swal.close();
                        window.location.replace("result.php")
                    }, 2000);
                }
            });
        } else {
            swal(options)
                .then((willSubmit) => {
                    if (willSubmit) {
                        answers['checkForCorrectAns'] = 'check';
                        // clearInterval(timeinterval);
                        var timing = $('.hours').html() + ":" + $('.minutes').html() + ":" + $('.seconds').html();
                        answers['game'] = sessionStorage.getItem("game_code");
                        answers['timing'] = timing;
                        answers['player'] = sessionStorage.getItem("player");
                        var user = sessionStorage.getItem("player");
                        $.ajax({
                            url: 'process.php',
                            type: 'POST',
                            dataType: 'json',
                            beforeSend: () => {
                                swal({ text: 'please wait while we calculate your score', icon: "images/loader.gif", buttons: false, closeOnClickOutside: false });
                                $('.swal-modal').css({ 'background-color': ' rgba(0,0,0,0)', "border": 'none' });
                                $('.swal-text').css({ 'color': ' rgba(244,244,244,1)', "border": 'none', 'font-family': "'gothic-game',sans-serif" });
                            },
                            data: answers,
                            success: function(res) {
                                console.log(res);
                                swal.close();
                                sessionStorage.setItem('result', JSON.stringify(res));
                                // repeater(res, user);
                                setTimeout(() => { window.location.replace("result.php") }, 2000);
                            }
                        });
                    }
                });
        }
    }
}

var prvQuest = () => {
    if (number >= 1) {
        answers[num] = $('input[name = answer]').val();
        number--;
        loadGame();
    } else {
        swal({
                title: "Are you sure?",
                text: "You will forfeit your buy-in once you quit",
                icon: "warning",
                buttons: true,
                dangerMode: true
            })
            .then((willDelete) => {
                if (willDelete) {
                    localStorage.setItem("question", "");
                    window.location.replace("start.php");
                }
            })
    }
}

$(document).on('click', '.cancel-p2', function(event) {
    event.preventDefault();
    var game = sessionStorage.getItem("game_code");
    swal({
            title: 'You are about to cancel your current game',
            text: 'Do you wish to proceed?',
            icon: "warning",
            buttons: true,
            dangerMode: true
        })
        .then((willCancel) => {
            if (willCancel) {
                $.ajax({
                    url: 'process.php',
                    type: 'post',
                    dataType: 'json',
                    data: { cancel: 1, game: game, player: 'p2' },
                    success: function(res) {
                        if (res.success) {
                            swal({
                                title: 'Alright!',
                                text: 'You have successfully canceled the current game, your buy-in would be remitted to yourr e-wallet',
                                icon: "success"
                            })
                            setTimeout(() => window.location.replace('dashboard.php'), 2000)
                        }
                    }
                })
            }
        })
});

$(document).on('click', '.cancel-p1', function(event) {
    event.preventDefault();
    var game = sessionStorage.getItem("game_code");
    swal({
            title: 'You are about to cancel your current game',
            text: 'Do you wish to proceed?',
            icon: "warning",
            buttons: true,
            dangerMode: true
        })
        .then((willCancel) => {
            if (willCancel) {
                $.ajax({
                    url: 'process.php',
                    type: 'post',
                    dataType: 'json',
                    data: { cancel: 1, game: game, player: 'p1' },
                    success: function(res) {
                        if (res.success) {
                            swal({
                                title: 'Alright!',
                                text: 'You have successfully canceled the current game, your buy-in would be remitted to yourr e-wallet',
                                icon: "success"
                            })
                            setTimeout(()=>window.location.replace('dashboard.php'), 2000);
                            // $('.load').html(`<div class="row justify-content-center p-3"><div class="col-md-8"><div class="row"><div class="col-md-5 text-center"><img src="images/loader1.gif" class="img-thumbnail rounded-circle"><p class="title-text">Player left <br> Searching for another player...</p></div><div class="col-md-2 text-center"><div class="d-flex justify-content-center align-items-center h-100"><h1 class="title-text">vs</h1></div></div><div class="col-md-5 text-center"><img src="${p2_img}" class="img-thumbnail rounded-circle"><p class="title-text">${res.p2_data.customername}</p></div><div class="col-md-12 text-center"><button class="btn btn-outline-primary chatBtn" data-toggle="modal" id="chatP1" data-target="#exampleModalLongChat" data-backdrop="static" data-keyboard="false">Chat</button><button class="btn btn-outline-primary ready ml-1 mr-1" id="p1_${code}">I'm Ready</button><button class="btn btn-outline-danger cancel-p1">cancel</button></div></div></div></div>`);

                        }
                    }
                })
            }
        })
});

$(document).on('click', '.replay', function(event) {
    event.preventDefault();
    var game = sessionStorage.getItem("game_code");
    window.location.replace('start.php');
});

$(document).on('change', '.formControlRange', function(event) {
    event.preventDefault();
    // sessionStorage.setItem("game_code", '');
    // window.location.replace('start.php');
    console.log("done");
});

if (sessionStorage.getItem('user') != '') {
    if (sessionStorage.getItem('user') == 'p1') {
        sessionStorage.setItem('user', 'p2')
    } else {
        sessionStorage.setItem('user', 'p1')
    }
}

function formatAMPM(date) {
    var hours = date.getHours();
    var minutes = date.getMinutes();
    var ampm = hours >= 12 ? 'PM' : 'AM';
    hours = hours % 12;
    hours = hours ? hours : 12; // the hour '0' should be '12'
    minutes = minutes < 10 ? '0' + minutes : minutes;
    var strTime = hours + ':' + minutes + ' ' + ampm;
    return strTime;
}

var name = sessionStorage.getItem('game_code');
name = `${name}.html`;

function resetChat() {
    $("ul").empty();
    $.ajax({
        url: 'process.php',
        type: 'post',
        dataType: 'text',
        data: { deleteFile: 1, fileName: name },
        success: function(res) {
            $(".msgbars").html(res);
            $("ul").animate({ scrollTop: $("ul").height() }, 1000);
        }
    });
}
var beforeMess = 0;

function writeChat() {
    $.ajax({
        url: 'process.php',
        type: 'post',
        dataType: 'text',
        data: { getFile: 1, fileName: name },
        success: function(res) {
            var data = res.length;
            if (beforeMess < data) {
                $('#chatBtn').html('chat<span class="badge badge-danger">1</span>');
            }
            beforeMess = data;
            $(".msgbars").html(res);
            $("ul").animate({ scrollTop: $("ul").height() }, 1000);
            setTimeout(writeChat, 2000);
        }
    });
}

$(".mytext").on("keydown", function(e) {
    if (e.which == 13) {
        var text = $(this).val();
        var user = sessionStorage.getItem('player');
        if (text !== "") {
            $(this).val('');
            var date = formatAMPM(new Date());
            $.ajax({
                url: 'process.php',
                type: 'post',
                dataType: 'text',
                data: { writeToFile: text, date: date, user: user, filename: name },
                success: function(res) {
                    writeChat(name);
                }
            })
        }
    }
});

$('.sendBtn').click(function() {
    $('#chatBtn').html('chat');
    $(".mytext").trigger({ type: 'keydown', which: 13, keyCode: 13 });
})

$(document).on('click', '.endChat', function(event) {
    event.preventDefault();
    $.ajax({
        url: 'process.php',
        type: 'post',
        dataType: 'text',
        beforeSend: function() { $('#exampleModalLong').modal('hide') },
        data: { deleteFile: 1, fileName: name },
        success: function(res) {
            writeChat(name);
            $('#exampleModalLongChat').modal('hide');
            setTimeout(()=>$('#exampleModalLong').modal('show'), 500);
        }
    })
});

$(document).on('click', '#chatBtn', function(event) {
    // console.log('here');
    event.preventDefault();
    $('#exampleModalLong').modal('hide');
    setTimeout(()=>$('#exampleModalLongChat').modal({ backdrop: 'static', keyboard: true, show: true }), 500);
});

if (current[len - 1] == "start.php") {
    setTimeout(writeChat, 2000);
}