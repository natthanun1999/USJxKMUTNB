var doing = false;
var spin = [new Audio("../img/Slot-Games/sounds/spin.mp3"),new Audio("../img/Slot-Games/sounds/spin.mp3"),new Audio("../img/Slot-Games/sounds/spin.mp3"),new Audio("../img/Slot-Games/sounds/spin.mp3"),new Audio("../img/Slot-Games/sounds/spin.mp3"),new Audio("../img/Slot-Games/sounds/spin.mp3"),new Audio("../img/Slot-Games/sounds/spin.mp3")];
var coin = [new Audio("../img/Slot-Games/sounds/coin.mp3"),new Audio("../img/Slot-Games/sounds/coin.mp3"),new Audio("../img/Slot-Games/sounds/coin.mp3")]
var win = new Audio("../img/Slot-Games/sounds/win.mp3");
var lose = new Audio("../img/Slot-Games/sounds/lose.mp3");
var audio = false;
let status = document.getElementById("status");

function showNotification(mode) {
    //Coupon out of stock
    if (mode == 1) {
        Swal.fire({
            title: 'Unfortunately!',
            text: 'Sorry, Coupon was out of stock.',
            icon: 'error',
            confirmButtonText: 'Close',
            onClose: refresh
        });
    }

    //Winning
    if (mode == 2) {
        Swal.fire({
            title: 'Congratulation!',
            text: 'You got ' + window.couponDiscount + '% discount. | Coupon Code : ' + window.couponID,
            icon: 'success',
            confirmButtonText: 'Close',
            onClose: updateCoupon
        });
    }

    //Losing
    if (mode == 3) {
        Swal.fire({
            title: 'Game over!',
            text: 'Ah! You have lose this game T^T.',
            icon: 'error',
            confirmButtonText: 'Close',
            onClose: refresh
        });
    }
}

function updateCoupon() {
    var form = document.createElement('form');
    form.setAttribute('action', '../Back-end/Coupon-Edit.php');
    form.setAttribute('method', 'POST');
    form.setAttribute('id', 'CouponUpdate');

    var couponID = document.createElement('input');
    couponID.setAttribute('type', 'hidden');
    couponID.setAttribute('name', 'COUPON_ID');
    couponID.setAttribute('value', window.couponID);

    var couponDiscount = document.createElement('input');
    couponDiscount.setAttribute('type', 'hidden');
    couponDiscount.setAttribute('name', 'RATE');
    couponDiscount.setAttribute('value', window.couponDiscount);

    var status = document.createElement('input');
    status.setAttribute('type', 'hidden');
    status.setAttribute('name', 'STATUS');
    status.setAttribute('value', 'Idle');

    var userID = document.createElement('input');
    userID.setAttribute('type', 'hidden');
    userID.setAttribute('name', 'USER_ID');
    userID.setAttribute('value', window.userID);

    var ticketID = document.createElement('input');
    ticketID.setAttribute('type', 'hidden');
    ticketID.setAttribute('name', 'TICKET_ID');
    ticketID.setAttribute('value', '999999');

    form.appendChild(couponID);
    form.appendChild(couponDiscount);
    form.appendChild(status);
    form.appendChild(userID);
    form.appendChild(ticketID);

    document.getElementById('body').appendChild(form);

    window.CouponUpdate.submit();
}

function refresh() {
    window.location.replace('Slot.php');
}

function doSlot() {
    if (!window.isLogin) {
        modalShow('modal-wrapper');

        return null;
    }

    if (window.couponAmount <= 0)
    {
        showNotification(1);

        return null;
    }

    if (doing) {return null;}

    doing = true;

    var numChanges = randomInt(1, 4) * 7;
    var numberSlot1 = numChanges + randomInt(1, 7);
    var numberSlot2 = numChanges + 2 * 7 + randomInt(1, 7);
    var numberSlot3 = numChanges + 4 * 7 + randomInt(1, 7);

    var i1 = 0;
    var i2 = 0;
    var i3 = 0;
    var sound = 0;

    status.innerHTML = "SPINNING";

    slot1 = setInterval(spin1, 50);
    slot2 = setInterval(spin2, 50);
    slot3 = setInterval(spin3, 50);

    function spin1() {
        i1++;

        if (i1 >= numberSlot1) {
            coin[0].play();

            clearInterval(slot1);

            return null;
        }

        slotTile = document.getElementById("slot1");

        if (slotTile.className == "a7")
            slotTile.className = "a0";

        slotTile.className = "a" + (parseInt(slotTile.className.substring(1)) + 1);
    }

    function spin2() {
        i2++;

        if (i2 >= numberSlot2) {
            coin[1].play();

            clearInterval(slot2);

            return null;
        }

        slotTile = document.getElementById("slot2");

        if (slotTile.className == "a7")
            slotTile.className = "a0";

        slotTile.className = "a" + (parseInt(slotTile.className.substring(1)) + 1);
    }

    function spin3() {
        i3++;

        if (i3 >= numberSlot3) {
            coin[2].play();

            clearInterval(slot3);
            testWin();

            return null;
        }

        slotTile = document.getElementById("slot3");

        if (slotTile.className == "a7")
            slotTile.className = "a0";

        sound++;

        if (sound == spin.length)
            sound = 0;

        spin[sound].play();

        slotTile.className = "a" + (parseInt(slotTile.className.substring(1)) + 1);
    }
}

function testWin() {
    var slot1 = document.getElementById("slot1").className;
    var slot2 = document.getElementById("slot2").className;
    var slot3 = document.getElementById("slot3").className;

    if (((slot1 == slot2 && slot2 == slot3) ||
        (slot1 == slot2 && slot3 == "a7") ||
        (slot1 == slot3 && slot2 == "a7") ||
        (slot2 == slot3 && slot1 == "a7") ||
        (slot1 == slot2 && slot1 == "a7") ||
        (slot1 == slot3 && slot1 == "a7") ||
        (slot2 == slot3 && slot2 == "a7") ) && !(slot1 == slot2 && slot2 == slot3 && slot1 == "a7")) {
        status.innerHTML = "YOU WIN!";
        win.play();

        showNotification(2);
    }
    else {
        status.innerHTML = "YOU LOSE!";
        lose.play();

        showNotification(3);
    }

    doing = false;
}

function toggleAudio() {
    if (!audio) {
        audio = !audio;

        for (var x of spin)
            x.volume = 0.5;

        for (var x of coin)
            x.volume = 0.5;

        win.volume = 1.0;
        lose.volume = 1.0;
    }
    else {
        audio = !audio;

        for (var x of spin)
            x.volume = 0;

        for (var x of coin)
            x.volume = 0;

        win.volume = 0;
        lose.volume = 0;
    }

    document.getElementById("audio").src = "../img/Slot-Games/icons/audio"+(audio?"On":"Off")+".png";
}

function randomInt(min, max) {
    return Math.floor((Math.random() * (max - min + 1)) + min);
}