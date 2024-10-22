document.addEventListener('DOMContentLoaded', function() {
    const docid = document.querySelector('input[name="docid"]').value;
    const scheduleid = document.querySelector('input[name="scheduleid"]').value;
    var paymentUrl = "https://simulated-payment.com?docid=" + docid + "&scheduleid=" + scheduleid;

    if (typeof paymentUrl !== 'undefined') {
        var qrcode = new QRCode(document.getElementById("qrcode"), {
            text: paymentUrl,
            width: 128, 
            height: 128 
        });
    } else {
        console.error("La URL de pago no está definida.");
    }
});


function verifyPayment() {
    const spinnerContainer = document.getElementById('spinner-container');
    const spinner = document.getElementById('spinner');
    const checkmark = document.getElementById('checkmark');
    spinnerContainer.style.display = 'flex';
    spinner.style.display = 'inline';
    checkmark.style.display = 'none';

    const scheduleid = document.querySelector('input[name="scheduleid"]').value;
    const apponum = document.querySelector('input[name="apponum"]').value;
    document.getElementById('verify-payment-btn').value = 'verifying...';
    setTimeout(() => {
        fetch('../../patient/verify-payment.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: `scheduleid=${scheduleid}&apponum=${apponum}`
        })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    spinner.style.display = 'none';
                    checkmark.style.display = 'inline';
                    document.getElementById('verify-payment-btn').disabled = true;
                    document.getElementById('verify-payment-btn').style.opacity = 0.7;
                    document.getElementById('verify-payment-btn').value = 'Payment verified';
                    document.getElementById('booknow-btn').disabled = false;
                    document.getElementById('booknow-btn').style.opacity = 1;
                } else {
                    alert('Payment verification failed. Please try again.');
                    spinnerContainer.style.display = 'none';
                }
            })
            .catch(error => {
                console.error('Error:', error);
                spinnerContainer.style.display = 'none';
            });
    }, 3000);
}
