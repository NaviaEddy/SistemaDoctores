function submitForm() {
    // Retrieve input values
    const email = document.getElementById('newemail').value;
    const tele = document.getElementById('tele').value;
    const newpassword = document.getElementById('newpassword').value;
    const cpassword = document.getElementById('cpassword').value;

    // Prepare the data to send
    const formData = new FormData();
    formData.append('newemail', email);
    formData.append('tele', tele);
    formData.append('newpassword', newpassword);
    formData.append('cpassword', cpassword);

    fetch('http://localhost/Online-Doctor-Appointment-System/controllers/login/account_controller.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            window.location.href = data.redirect;
        } else {
            document.getElementById("error-pswd").innerText = data.message;
        }
    })
    .catch(error => {
        console.error("Error en la solicitud:", error);
        document.getElementById("error-pswd").innerText = "Error en el servidor, por favor intenta más tarde.";
    });
}