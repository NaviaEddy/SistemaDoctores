document.addEventListener('DOMContentLoaded', function() {
    const urlParams = new URLSearchParams(window.location.search);
    const action = urlParams.get('action');
    
    if (action) {
        if (action === 'view') {
            const pid = urlParams.get('id');
            showPopupMedicalHistory(pid);
        }
    }

    function showPopupMedicalHistory(pid) {
        fetch(`http://localhost/Online-Doctor-Appointment-System/doctor/obtenerhistorial.php?id=${pid}`)
            .then(response => response.json())
            .then(data => {
                if (data.error) {
                    const errorPopupHtml = `
                        <div id="popup1" class="overlay">
                            <div class="popup">
                                <center>
                                    <a class="close" href="patient.php">&times;</a>
                                    <div class="content">
                                        <p>${data.error}</p>
                                    </div>
                                </center>
                                <br><br>
                            </div>
                        </div>
                    `;
                    document.body.insertAdjacentHTML('beforeend', errorPopupHtml);
                } else {
                    const popupHtml = `
                        <div id="popup1" class="overlay">
                            <div class="popup">
                                <center>
                                    <a class="close" href="../../controllers/doctor/patient_controller.php">&times;</a>
                                    <div class="content"></div>
                                    <div class="abc scroll" style="display: flex; justify-content: center;">
                                        <table class="sub-table scrolldown add-doc-form-container" style="width: 80%; margin: auto; border-collapse: collapse;">
                                            <tr>
                                                <td colspan="2" style="text-align: center; font-size: 25px; font-weight: 500; padding: 10px;">Medical History</td>
                                            </tr>
                                            <tr>
                                                <td class="label-td" style="font-weight: bold; padding: 10px;">Patient ID:</td>
                                                <td style="padding: 10px;">P-${data.pid}</td>
                                            </tr>
                                            <tr>
                                                <td class="label-td" style="font-weight: bold; padding: 10px;">Name:</td>
                                                <td style="padding: 10px;">${data.pname}</td>
                                            </tr>
                                            <tr>
                                                <td class="label-td" style="font-weight: bold; padding: 10px;">Email:</td>
                                                <td style="padding: 10px;">${data.pemail}</td>
                                            </tr>
                                            <tr>
                                                <td class="label-td" style="font-weight: bold; padding: 10px;">Telephone:</td>
                                                <td style="padding: 10px;">${data.ptel}</td>
                                            </tr>
                                            <tr>
                                                <td class="label-td" style="font-weight: bold; padding: 10px;">Address:</td>
                                                <td style="padding: 10px;">${data.paddress}</td>
                                            </tr>
                                            <tr>
                                                <td class="label-td" style="font-weight: bold; padding: 10px;">Date of Birth:</td>
                                                <td style="padding: 10px;">${data.pdob}</td>
                                            </tr>
                                            <tr>
                                                <td class="label-td" style="font-weight: bold; padding: 10px;">Allergies:</td>
                                                <td style="padding: 10px;">${data.allergies || 'N/A'}</td>
                                            </tr>
                                            <tr>
                                                <td class="label-td" style="font-weight: bold; padding: 10px;">Previous Conditions:</td>
                                                <td style="padding: 10px;">${data.previous_conditions || 'N/A'}</td>
                                            </tr>
                                            <tr>
                                                <td class="label-td" style="font-weight: bold; padding: 10px;">Current Medications:</td>
                                                <td style="padding: 10px;">${data.current_medications || 'N/A'}</td>
                                            </tr>
                                            <tr>
                                                <td class="label-td" style="font-weight: bold; padding: 10px;">Family History:</td>
                                                <td style="padding: 10px;">${data.family_history || 'N/A'}</td>
                                            </tr>
                                            <tr>
                                                <td class="label-td" style="font-weight: bold; padding: 10px;">Vaccinations:</td>
                                                <td style="padding: 10px;">${data.vaccinations || 'N/A'}</td>
                                            </tr>
                                            <tr>
                                                <td class="label-td" style="font-weight: bold; padding: 10px;">Last Visit Date:</td>
                                                <td style="padding: 10px;">${data.last_visit_date || 'N/A'}</td>
                                            </tr>
                                            <tr>
                                                <td colspan="2" style="text-align: center; padding: 10px;">
                                                    <a href="../../controllers/doctor/patient_controller.php">
                                                        <input type="button" value="OK" class="login-btn btn-primary-soft btn">
                                                    </a>
                                                    <a href="../../doctor/generate_pdf.php?id=${data.pid}">
                                                        <input type="button" value="Download PDF" class="login-btn btn-primary-soft btn" />
                                                    </a>
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                </center>
                                <br><br>
                            </div>
                        </div>
                    `;
                    document.body.insertAdjacentHTML('beforeend', popupHtml);
                }
            })
            .catch(error => {
                const errorPopupHtml = `
                    <div id="popup1" class="overlay">
                        <div class="popup">
                            <center>
                                <a class="close" href="patient.php">&times;</a>
                                <div class="content">
                                    <p>Error al cargar los datos.</p>
                                </div>
                            </center>
                            <br><br>
                        </div>
                    </div>
                `;
                document.body.insertAdjacentHTML('beforeend', errorPopupHtml);
                console.error('Error fetching patient details:', error);
            });
    }
});
