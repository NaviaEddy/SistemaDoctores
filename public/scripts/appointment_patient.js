document.addEventListener('DOMContentLoaded', function() {
    const urlParams = new URLSearchParams(window.location.search);
    const action = urlParams.get('action');
    
    if (action) {
        if (action === 'drop') {
            const title = urlParams.get('title');
            const docname = urlParams.get('doc');
            const appoid = urlParams.get('id');
            const docid = urlParams.get('docid');
            const schid = urlParams.get('schid');
            showPopupDrop(title, docname, appoid, docid, schid);
        }else if(action === 'booking-added'){
            const idappnom = urlParams.get('id');
            showBookingAddedPopup(idappnom);
        }
    }

    function showPopupDrop(title, docname, appoid, docid, schid) {
        const popupHtml = `
            <div id="popup1" class="overlay">
                <div class="popup">
                    <center>
                        <h2>Are you sure?</h2>
                        <a class="close" href="../../controllers/patient/appointment_controller.php">&times;</a>
                        <div class="content">
                            You want to Cancel this Appointment?<br><br>
                            Session Name: <b>${title.substring(0, 40)}</b><br>
                            Doctor name : <b>${docname.substring(0, 40)}</b><br><br>    
                        </div>
                        <div style="display: flex;justify-content: center;">
                            <a href="../../patient/delete-appointment.php?id=${appoid}&docid=${docid}&schid=${schid}" class="non-style-link">
                                <button class="btn-primary btn" style="display: flex;justify-content: center;align-items: center;margin:10px;padding:10px;">
                                    <font class="tn-in-text">Yes</font>
                                </button>
                            </a>
                            <a href="../../controllers/patient/appointment_controller.php" class="non-style-link">
                                <button class="btn-primary btn" style="display: flex;justify-content: center;align-items: center;margin:10px;padding:10px;">
                                    <font class="tn-in-text">No</font>
                                </button>
                            </a>
                        </div>
                    </center>
                </div>
            </div>`;
        document.body.insertAdjacentHTML('beforeend', popupHtml);
    }

    function showBookingAddedPopup(idappnom){
        const popupHtml = `
            <div id="popup1" class="overlay">
                    <div class="popup">
                    <center>
                    <br><br>
                        <h2>Booking Successfully.</h2>
                        <a class="close" href="../../controllers/patient/appointment_controller.php">&times;</a>
                        <div class="content">
                            Your Appointment number is  ${idappnom} <br><br>       
                        </div>
                        <div style="display: flex;justify-content: center;">
                        <a href="../../controllers/patient/appointment_controller.php" class="non-style-link"><button  class="btn-primary btn"  style="display: flex;justify-content: center;align-items: center;margin:10px;padding:10px;"><font class="tn-in-text">OK</font></button></a>
                        <br><br><br><br>
                        </div>
                    </center>
            </div>`;
        document.body.insertAdjacentHTML('beforeend', popupHtml);
    }
});

