<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../public/css/animations.css">
    <link rel="stylesheet" href="../../public/css/main.css">
    <link rel="stylesheet" href="../../public/css/admin.css">
    <title>Dashboard</title>
    <style>
        .dashbord-tables {
            animation: transitionIn-Y-over 0.5s;
        }

        .filter-container {
            animation: transitionIn-Y-bottom 0.5s;
        }

        .sub-table,
        .anime {
            animation: transitionIn-Y-bottom 0.5s;
        }
    </style>
</head>

<body>
    <div class="container">

        <?php include('../../views/partials/menu_patient.php'); ?>

        <div class="dash-body" style="margin-top: 15px; padding: 0;">
            <table border="0" width="100%" style="border-spacing: 0; margin: 0; padding: 0;">
                <tr>
                    <td colspan="1" class="nav-bar" style="padding-left: 30px;">
                        <p style="font-size: 23px; font-weight: 600;">Home</p>
                    </td>
                    <td width="50%"></td>
                    <td width="25%" style="text-align: right;">
                        <p style="font-size: 14px; color: rgb(119, 119, 119); margin: 0;">Today's Date</p>
                        <p class="heading-sub12" style="margin: 0;">
                            <?php
                            date_default_timezone_set('Asia/Kolkata');
                            $today = date('Y-m-d');
                            echo $today;
                            ?>
                        </p>
                    </td>
                    <td width="10%">
                        <button class="btn-label" style="display: flex;justify-content: center;align-items: center;"><img src="../../public/img/calendar.svg" width="100%"></button>
                    </td>
                </tr>
                <tr>
                    <td colspan="4">
                        <center>
                            <table class="filter-container doctor-header patient-header" style="border: none; width: 95%; margin-top: 20px;" border="0">
                                <tr>
                                    <td>
                                        <h3>Welcome!</h3>
                                        <h1><?php echo $data['username']; ?>.</h1>
                                        <p>Haven't any idea about doctors? no problem let's jumping to
                                            <a href="doctors.php" class="non-style-link"><b>"All Doctors"</b></a> section or
                                            <a href="schedule.php" class="non-style-link"><b>"Sessions"</b> </a><br>
                                            Track your past and future appointments history.<br>Also find out the expected arrival time of your doctor or medical consultant.<br><br>
                                        </p>
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
                                                                <?php echo $data['futureAppointments']; ?>
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
                                                                <?php echo $data['todaySessions']; ?>
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

                                <td style="padding-left: 20px;">
                                    <p style="font-size: 20px; font-weight: 600;">Your Upcoming Booking</p>
                                    <center>
                                        <div class="abc scroll" style="height: 250px; overflow-y: auto; margin-left: -25px;">
                                            <table width="95%" class="sub-table scrolldown" border="0" >
                                                <thead>
                                                    <tr>
                                                        <th class="table-headin">Appoint. Number</th>
                                                        <th class="table-headin">Session Title</th>
                                                        <th class="table-headin">Doctor</th>
                                                        <th class="table-headin">Scheduled Date & Time</th>
                                                    </tr>
                                                </thead>
                                                <tbody style="text-align: center;">
                                                    <?php
                                                    if ($data['appointments']->num_rows == 0) {
                                                        echo '<tr>
                                                            <td colspan="4">
                                                                <br>
                                                                <center>
                                                                    <img src="../../public/img/notfound.svg" width="25%">
                                                                    <p class="heading-main12" style="font-size: 20px; color: rgb(49, 49, 49);">Nothing to show here!</p>
                                                                </center>
                                                                <br>
                                                            </td>
                                                        </tr>';
                                                    } else {
                                                        foreach ($data['appointments'] as $appointment) {
                                                            echo '<tr>
                                                        <td style="padding: 15px; font-size: 18px; font-weight: 600;">'
                                                                . $appointment['apponum'] .
                                                                '</td>
                                                        <td style="padding: 10px;">'
                                                                . substr($appointment['title'], 0, 30) .
                                                                '</td>
                                                        <td>'
                                                                . substr($appointment['docname'], 0, 20) .
                                                                '</td>
                                                        <td style="text-align: center;">'
                                                                . substr($appointment['scheduledate'], 0, 10) . ' ' . substr($appointment['scheduletime'], 0, 5) .
                                                                '</td>
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