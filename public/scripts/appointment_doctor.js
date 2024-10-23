document.addEventListener('DOMContentLoaded', function() {
    const urlParams = new URLSearchParams(window.location.search);
    const action = urlParams.get('action');
    
    if (action) {
        if (action === 'drop') {
            const appoid = urlParams.get('id');
            const name = urlParams.get('name');
            const title = urlParams.get('sesssion');
            const apponum = urlParams.get('apponum');
            showPopupDrop(appoid, name, title, apponum);
        }
    }

    function showPopupDrop(appoid, name, title, apponum) {
        const popupHtml = `
            <div id="popup1" class="overlay">
                <div class="popup">
                    <center>
                        <h2>Are you sure?</h2>
                        <a class="close" href="appointment.php">&times;</a>
                        <div class="content">
                            You want to delete this record<br><br>
                            Patient Name: &nbsp;<b>${name.substring(0, 40)}</b><br>
                            Appointment number &nbsp; : <b>${apponum.substring(0, 40)}</b><br><br>
                        </div>
                        <div style="display: flex;justify-content: center;">
                        <a href="../../doctor/delete-appointment.php?id=${appoid}" class="non-style-link">
                            <button class="btn-primary btn" style="display: flex; justify-content: center; align-items: center; margin:10px; padding:10px;">
                                <font class="tn-in-text">&nbsp;Yes&nbsp;</font>
                            </button>
                        </a>&nbsp;&nbsp;&nbsp;
                        <a href="../../controllers/doctor/appointment_controller.php" class="non-style-link">
                            <button class="btn-primary btn" style="display: flex; justify-content: center; align-items: center; margin:10px; padding:10px;">
                                <font class="tn-in-text">&nbsp;&nbsp;No&nbsp;&nbsp;</font>
                            </button>
                        </a>
                        </div>
                    </center>
                </div>
            </div>
            `;
        document.body.insertAdjacentHTML('beforeend', popupHtml);
    }
});

