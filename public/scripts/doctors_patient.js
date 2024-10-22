document.addEventListener('DOMContentLoaded', function () {
    const urlParams = new URLSearchParams(window.location.search);
    const action = urlParams.get('action');

    if (action) {
        if (action === 'view') {
            const docname = urlParams.get('name');
            const docemail = urlParams.get('email');
            const docspeciality = urlParams.get('spe');
            const docphone = urlParams.get('tel');
            showPopupView(docname, docemail, docspeciality, docphone);
        } else if (action === 'session') {
            const docname = urlParams.get('name');
            showPopupSessions(docname);
        }
    }

});

function showPopupView(docname, docemail, docspeciality, docphone) {
    const popupHtml = `
        <div id="popup1" class="overlay">
            <div class="popup">
                <center>
                    <h2></h2>
                    <a class="close" href="../../controllers/patient/doctors_controller.php">&times;</a>
                    <div class="content">
                        eDoc Web App<br>    
                    </div>
                    <div style="display: flex; justify-content: center;">
                        <table width="80%" class="sub-table scrolldown add-doc-form-container" border="0">
                            <tr>
                                <td>
                                    <p style="padding: 0; margin: 0; text-align: left; font-size: 25px; font-weight: 500;">View Details.</p><br><br>
                                </td>
                            </tr>
                            <tr>
                                <td class="label-td" colspan="2">
                                    <label for="name" class="form-label">Name: </label>
                                </td>
                            </tr>
                            <tr>
                                <td class="label-td" colspan="2">
                                    ${docname}<br><br>
                                </td>
                            </tr>
                            <tr>
                                <td class="label-td" colspan="2">
                                    <label for="Email" class="form-label">Email: </label>
                                </td>
                            </tr>
                            <tr>
                                <td class="label-td" colspan="2">
                                    ${docemail}<br><br>
                                </td>
                            </tr>
                            <tr>
                                <td class="label-td" colspan="2">
                                    <label for="Tele" class="form-label">Telephone: </label>
                                </td>
                            </tr>
                            <tr>
                                <td class="label-td" colspan="2">
                                    ${docphone}<br><br>
                                </td>
                            </tr>
                            <tr>
                                <td class="label-td" colspan="2">
                                    <label for="spec" class="form-label">Specialties: </label>   
                                </td>
                            </tr>
                            <tr>
                                <td class="label-td" colspan="2">
                                    ${docspeciality}<br><br>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <a href="../../controllers/patient/doctors_controller.php"><input type="button" value="OK" class="login-btn btn-primary-soft btn"></a>    
                                </td>
                            </tr>
                        </table>
                    </div>
                </center>
                <br><br>
            </div>
        </div>`;
    document.body.insertAdjacentHTML('beforeend', popupHtml);
}

function showPopupSessions(docname) {
    const popupHtml = `
        <div id="popup1" class="overlay">
            <div class="popup">
                <center>
                    <h2>Redirect to Doctors sessions?</h2>
                    <a class="close" href="../../controllers/patient/doctors_controller.php">&times;</a>
                    <div class="content">
                        You want to view all sessions by <br>(${docname.substring(0, 40)}).
                    </div>
                    <form action="../../controllers/patient/ScheduleController.php" method="post" style="display: flex">
                        <input type="hidden" name="search" value="${docname}">
                        <div style="display: flex; justify-content: center; margin-left: 45%; margin-top: 6%; margin-bottom: 6%;">
                            <input type="submit" value="Yes" class="btn-primary btn">
                        </div>
                    </form>
                </center>
            </div>
        </div>`;
        
    document.body.insertAdjacentHTML('beforeend', popupHtml);
}
