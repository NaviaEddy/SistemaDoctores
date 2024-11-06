document.addEventListener('DOMContentLoaded', function() {
    const urlParams = new URLSearchParams(window.location.search);
    const action = urlParams.get('action');
    
    if (action) {
        if (action === 'drop') {
            const schdid = urlParams.get('id');
            const name = urlParams.get('name');
            showPopupDrop(schdid, name);
        }else if (action === 'view') {
            const schdid = urlParams.get('id');
            fetchScheduleDetails(schdid)
            .then(scheduleData => {
                return fetchPatientData(schdid)
                    .then(patientData => {
                        showPopupView(scheduleData, patientData);
                    });
            })
            .catch(error => console.error('Error fetching data:', error));
        }
    }

    function showPopupDrop(schdid, name) {
        const popupHtml = `
            <div id="popup1" class="overlay">
                <div class="popup">
                    <center>
                        <h2>Are you sure?</h2>
                        <a class="close" href="../../controllers/doctor/schedule_controller.php">&times;</a>
                        <div class="content">
                            You want to delete this record<br>(${name.substring(0,40)}).       
                        </div>
                        <div style="display: flex;justify-content: center;">
                        <a href="../../doctor/delete-session.php?id=${schdid}" class="non-style-link"><button  class="btn-primary btn"  style="display: flex;justify-content: center;align-items: center;margin:10px;padding:10px;"<font class="tn-in-text">&nbsp;Yes&nbsp;</font></button></a>&nbsp;&nbsp;&nbsp;
                        <a href="../../controllers/doctor/schedule_controller.php" class="non-style-link"><button  class="btn-primary btn"  style="display: flex;justify-content: center;align-items: center;margin:10px;padding:10px;"><font class="tn-in-text">&nbsp;&nbsp;No&nbsp;&nbsp;</font></button></a>
                        </div>
                    </center>
                </div>
            </div>
            `;
        document.body.insertAdjacentHTML('beforeend', popupHtml);
    }

    function fetchScheduleDetails(scheduleId) {
        return fetch(`http://localhost/Online-Doctor-Appointment-System/doctor/obtenerschedules.php?id=${scheduleId}`)
            .then(response => response.json())
            .catch(error => console.error('Error fetching schedule:', error));
    }

    // Función para obtener los pacientes registrados en la sesión
    function fetchPatientData(scheduleId) {
        return fetch(`http://localhost/Online-Doctor-Appointment-System/doctor/obtenerpatients.php?id=${scheduleId}`)
            .then(response => response.json())
            .catch(error => console.error('Error fetching patients:', error));
    }

    function showPopupView(schedule, patients) {
        let patientsHtml = '';

        if (patients.length === 0) {
            patientsHtml = `
                <tr>
                    <td colspan="7">
                        <br><br><br><br>
                        <center>
                            <img src="../../public/img/notfound.svg" width="25%">
                            <br>
                            <p class="heading-main12" style="font-size:20px;color:rgb(49, 49, 49)">
                                We couldn't find anything related to your keywords!
                            </p>
                            <a class="non-style-link" href="../../controllers/doctor/appointment_controller.php">
                                <button class="login-btn btn-primary-soft btn" style="margin-left:20px;">
                                    &nbsp; Show all Appointments &nbsp;
                                </button>
                            </a>
                        </center>
                        <br><br><br><br>
                    </td>
                </tr>`;
        } else {
            patients.forEach(patient => {
                patientsHtml += `
                    <tr style="text-align:center;">
                        <td>${patient.pid}</td>
                        <td style="font-weight:600;padding:25px">${patient.pname.substring(0, 25)}</td>
                        <td style="text-align:center;font-size:23px;font-weight:500; color: var(--btnnicetext);">
                            ${patient.apponum}
                        </td>
                        <td>${patient.ptel.substring(0, 25)}</td>
                    </tr>`;
            });
        }

        const popupHtml = `
            <div id="popup1" class="overlay">
                <div class="popup" style="width: 70%;">
                    <center>
                        <h2>View Details</h2>
                        <a class="close" href="../../controllers/doctor/schedule_controller.php">&times;</a>
                        <div class="content"></div>
                        <div class="abc scroll" style="display: flex; justify-content: center;">
                            <table width="80%" class="sub-table scrolldown add-doc-form-container" border="0">
                                <tr>
                                    <td>
                                        <p style="text-align: left; font-size: 25px; font-weight: 500;">View Details</p><br><br>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="label-td" colspan="2">
                                        <label for="name" class="form-label">Session Title:</label>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="label-td" colspan="2">${schedule.title}<br><br></td>
                                </tr>
                                <tr>
                                    <td class="label-td" colspan="2">
                                        <label for="Email" class="form-label">Doctor of this session:</label>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="label-td" colspan="2">${schedule.docname}<br><br></td>
                                </tr>
                                <tr>
                                    <td class="label-td" colspan="2">
                                        <label for="nic" class="form-label">Scheduled Date:</label>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="label-td" colspan="2">${schedule.scheduledate}<br><br></td>
                                </tr>
                                <tr>
                                    <td class="label-td" colspan="2">
                                        <label for="Tele" class="form-label">Scheduled Time:</label>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="label-td" colspan="2">${schedule.scheduletime}<br><br></td>
                                </tr>
                                <tr>
                                    <td class="label-td" colspan="2">
                                        <label for="spec" class="form-label">
                                            <b>Patients that Already registered for this session:</b> (${patients.length}/${schedule.nop})
                                        </label>
                                        <br><br>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="4">
                                        <center>
                                            <div class="abc scroll">
                                                <table width="100%" class="sub-table scrolldown" border="0">
                                                    <thead>
                                                        <tr>
                                                            <th>Patient ID</th>
                                                            <th>Patient Name</th>
                                                            <th>Appointment Number</th>
                                                            <th>Patient Telephone</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>${patientsHtml}</tbody>
                                                </table>
                                            </div>
                                        </center>
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
});

