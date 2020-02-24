const cards = document.querySelectorAll('.memory-card');

let hasFlippedCard = false;
let lockBoard = false;
let firstCard, secondCard;
let life = 3;
document.getElementById("life").innerHTML = "Life : " + life;

function flipCard() {
    if (lockBoard) return;
    if (this === firstCard) return;
    if (!window.isLogin) {
        modalShow('modal-wrapper');

        return null;
    }

    if (window.couponAmount <= 0)
    {
        showNotification(1);

        return null;
    }
    this.classList.add('flip');

    if (!hasFlippedCard) {
        hasFlippedCard = true;
        firstCard = this;

        return;
    }

    secondCard = this;

    checkForMatch();
}

function checkForMatch() {
    let isMatch = firstCard.dataset.framework === secondCard.dataset.framework;
    life--;
    document.getElementById("life").innerHTML = "Life : " + life;
    isMatch ? disableCards() : unflipCards();
    if(isMatch)
        showNotification(2);
    else if(life == 0)
        showNotification(3);
}

function disableCards() {
    firstCard.removeEventListener('click', flipCard);
    secondCard.removeEventListener('click', flipCard);

    resetBoard();
}

function unflipCards() {
    lockBoard = true;

    setTimeout(() => {
        firstCard.classList.remove('flip');
        secondCard.classList.remove('flip');

        resetBoard();
    }, 900);
}

function resetBoard() {
    [hasFlippedCard, lockBoard] = [false, false];
    [firstCard, secondCard] = [null, null];
}

(function shuffle() {
    cards.forEach(card => {
        let randomPos = Math.floor(Math.random() * 12);
        card.style.order = randomPos;
    });
})();

cards.forEach(card => card.addEventListener('click', flipCard));

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
    window.location.replace('Flip-that-field!.php');
}