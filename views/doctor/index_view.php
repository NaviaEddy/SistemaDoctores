<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../public/css/animations.css">
    <link rel="stylesheet" href="../../public/css/main.css">
    <link rel="stylesheet" href="../../public/css/admin.css">
    <title>Doctor Dashboard</title>
    <style>
        .dashbord-tables,
        .doctor-heade {
            animation: transitionIn-Y-over 0.5s;
        }

        .filter-container {
            animation: transitionIn-Y-bottom 0.5s;
        }

        .sub-table,
        #anim {
            animation: transitionIn-Y-bottom 0.5s;
        }

        .doctor-heade {
            animation: transitionIn-Y-over 0.5s;
        }
    </style>
</head>

<body>
    <div class="container">
        <?php include("../../views/partials/menu_doctor.php"); ?>

        <div class="dash-body">
            <table border="0" width="100%" style=" border-spacing: 0;margin:0;padding:0;margin-top:25px;">
                <tr>
                    <td colspan="1" class="nav-bar">
                        <p style="font-size: 23px;padding-left:12px;font-weight: 600;margin-left:20px;">Dashboard</p>
                    </td>
                    <td width="25%"></td>
                    <td width="15%">
                        <p style="font-size: 14px;color: rgb(119, 119, 119);padding: 0;margin: 0;text-align: right;">
                            Today's Date
                        </p>
                        <p class="heading-sub12" style="padding: 0;margin: 0;">
                            <?php echo $today; ?>
                        </p>
                    </td>
                    <td width="10%">
                        <button class="btn-label" style="display: flex;justify-content: center;align-items: center;">
                            <img src="../../public/img/calendar.svg" width="100%">
                        </button>
                    </td>
                </tr>
                <tr>
                    <td colspan="4">
                        <center>
                            <table class="filter-container doctor-header" style="border: none;width:95%" border="0">
                                <tr>
                                    <td>
                                        <h3>Welcome!</h3>
                                        <h1><?php echo $data['username']; ?>.</h1>
                                        <p>Thanks for joining with us. We are always trying to get you a complete service.<br>
                                            You can view your daily schedule, Reach Patients Appointment at home!<br><br>
                                        </p>
                                        <a href="../../controllers/doctor/appointment_controller.php" class="non-style-link">
                                            <button class="btn-primary btn" style="width:30%">View My Appointments</button>
                                        </a>
                                        <br><br>
                                    </td>
                                </tr>
                            </table>
                        </center>
                    </td>
                </tr>
                <tr>
                    <td colspan="4">
                        <table border="0" width="100%">
                            <tr>
                            <td width="52%">
                                    <center>
                                        <table class="filter-container" style="border: none;" border="0">
                                            <tr>
                                                <td colspan="4">
                                                    <p style="font-size: 20px; font-weight: 600; padding-left: 12px;">Status</p>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="width: 25%;">
                                                    <div class="dashboard-items" style="padding: 20px; margin: auto; width: 95%; display: flex; align-items: center; justify-content: space-between;">
                                                        <div>
                                                            <div class="h1-dashboard">
                                                                <?php echo $data['doctorCount']; ?>
                                                            </div>
                                                            <div class="h3-dashboard" style="font-size: 15px;">
                                                                <br>
                                                                All Doctors
                                                            </div>
                                                        </div>
                                                        <div class="btn-icon-back dashboard-icons" style="background-image: url('../../public/img/icons/doctors-hover.svg'); width: 50px; height: 50px; background-size: auto; background-repeat: no-repeat;"></div>
                                                    </div>
                                                </td>
                                                <td style="width: 25%;">
                                                    <div class="dashboard-items" style="padding: 20px; margin: auto; width: 95%; display: flex; align-items: center; justify-content: space-between;">
                                                        <div>
                                                            <div class="h1-dashboard">
                                                                <?php echo $data['patientCount']; ?>
                                                            </div>
                                                            <div class="h3-dashboard" style="font-size: 15px;">
                                                                <br>
                                                                All Patients
                                                            </div>
                                                        </div>
                                                        <div class="btn-icon-back dashboard-icons" style="background-image: url('../../public/img/icons/patients-hover.svg'); width: 50px; height: 50px; background-size: auto; background-repeat: no-repeat;"></div>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="width: 25%;">
                                                    <div class="dashboard-items" style="padding: 20px; margin: auto; width: 95%; display: flex; align-items: center; justify-content: space-between;">
                                                        <div>
                                                            <div class="h1-dashboard">
                                                                <?php echo $data['appointmentCount']; ?>
                                                            </div>
                                                            <div class="h3-dashboard" style="font-size: 15px;">
                                                                <br>
                                                                New Bookings
                                                            </div>
                                                        </div>
                                                        <div class="btn-icon-back dashboard-icons" style="background-image: url('../../public/img/icons/book-hover.svg'); width: 50px; height: 50px; background-size: auto; background-repeat: no-repeat;"></div>
                                                    </div>
                                                </td>
                                                <td style="width: 25%;">
                                                    <div class="dashboard-items" style="padding: 20px; margin: auto; width: 95%; display: flex; align-items: center; justify-content: space-between;">
                                                        <div>
                                                            <div class="h1-dashboard">
                                                                <?php echo $data['scheduleCount']; ?>
                                                            </div>
                                                            <div class="h3-dashboard" style="font-size: 15px;">
                                                                <br>
                                                                Today's Sessions
                                                            </div>
                                                        </div>
                                                        <div class="btn-icon-back dashboard-icons" style="background-image: url('../../public/img/icons/session-iceblue.svg'); width: 50px; height: 50px; background-size: auto; background-repeat: no-repeat;"></div>
                                                    </div>
                                                </td>
                                            </tr>
                                        </table>
                                    </center>
                                </td>
                                
                                <td width="50%">
                                    <p id="anim" style="font-size: 20px;font-weight:600;padding-left: 40px;">Your Up Coming Sessions until Next week</p>
                                    <center>
                                        <div class="abc scroll" style="height: 250px;padding: 0;margin: 0;">
                                            <table width="85%" class="sub-table scrolldown" border="0">
                                                <thead>
                                                    <tr>
                                                        <th class="table-headin">
                                                            Session Title
                                                        </th>
                                                        <th class="table-headin">
                                                            Sheduled Date
                                                        </th>
                                                        <th class="table-headin">
                                                            Time
                                                        </th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    if ($data['upcomingSessions']->num_rows == 0) {
                                                        echo '<tr>
                                                    <td colspan="4">
                                                    <br><br><br><br>
                                                    <center>
                                                    <img src="../../public/img/notfound.svg" width="25%">
                                                    <br>
                                                    <p class="heading-main12" style="margin-left: 45px;font-size:20px;color:rgb(49, 49, 49)">We  couldnt find anything related to your keywords !</p>
                                                    <a class="non-style-link" href="../../controllers/doctor/schedule_controller.php"><button  class="login-btn btn-primary-soft btn"  style="display: flex;justify-content: center;align-items: center;margin-left:20px;">&nbsp; Show all Sessions &nbsp;</font></button>
                                                    </a>
                                                    </center>
                                                    <br><br><br><br>
                                                    </td>
                                                    </tr>';
                                                    } else {
                                                        foreach ($data['upcomingSessions'] as $row) {
                                                            echo '<tr>
                                                            <td style="padding:20px;"> &nbsp;
                                                                ' . substr($row['title'], 0, 30). '
                                                            </td>
                                                            <td style="padding:20px;font-size:13px;">
                                                                ' . substr($row['scheduledate'], 0, 10) . '
                                                            </td>
                                                            <td style="text-align:center;">
                                                                ' . substr($row['scheduletime'], 0, 5) . '
                                                            </td>
                                                            </tr>';
                                                        }
                                                    }
                                                    ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </center>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
        </div>
    </div>
</body>

</html>