<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../public/css/animations.css">
    <link rel="stylesheet" href="../../public/css/main.css">
    <link rel="stylesheet" href="../../public/css/admin.css">
    <script src="../../public/scripts/appointment_patient.js"></script>
    <style>
        .popup {
            animation: transitionIn-Y-bottom 0.5s;
        }

        .sub-table {
            animation: transitionIn-Y-bottom 0.5s;
        }
    </style>
    <title>My Appointments</title>
</head>

<body>
    <div class="container">
        <?php include('../../views/partials/menu_patient.php'); ?>
        <div class="dash-body">
            <table border="0" width="100%" style=" border-spacing: 0;margin:0;padding:0;margin-top:25px; ">
                <tr>
                    <td width="13%">
                        <a href="../../controllers/patient/index_controller.php">
                            <button class="login-btn btn-primary-soft btn btn-icon-back" style="padding-top:11px;padding-bottom:11px;margin-left:20px;width:125px">
                                <font class="tn-in-text">Back</font>
                            </button>
                        </a>
                    </td>
                    <td>
                        <p style="font-size: 23px;padding-left:12px;font-weight: 600;">My Bookings history</p>
                    </td>
                    <td width="15%">
                        <p style="font-size: 14px;color: rgb(119, 119, 119);padding: 0;margin: 0;text-align: right;">
                            Today's Date
                        </p>
                        <p class="heading-sub12" style="padding: 0;margin: 0;">
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
                    <td colspan="4" style="padding-top:10px;width: 100%;">
                        <p class="heading-main12" style="margin-left: 45px;font-size:18px;color:rgb(49, 49, 49)">My Bookings (<?php echo $data['appointmentsCount'] ?>)</p>
                    </td>
                </tr>
                <tr>
                    <td colspan="4">
                        <center>
                            <div class="abc scroll">
                                <table width="93%" class="sub-table scrolldown" border="0" style="border:none">
                                    <tbody>
                                        <?php

                                        if ($data['appointments']->num_rows == 0) {
                                            echo '<tr>
                                    <td colspan="7">
                                    <br><br><br><br>
                                    <center>
                                    <img src="../../public/img/notfound.svg" width="25%">   
                                    <br>
                                    <p class="heading-main12" style="margin-left: 45px;font-size:20px;color:rgb(49, 49, 49)">We  couldnt find anything related to your keywords !</p>
                                    <a class="non-style-link" href="../../controllers/patient/appointment_controller.php"><button  class="login-btn btn-primary-soft btn"  style="display: flex;justify-content: center;align-items: center;margin-left:20px;">&nbsp; Show all Appointments &nbsp;</font></button>
                                    </a>
                                    </center>
                                    <br><br><br><br>
                                    </td>
                                    </tr>';
                                        } else {
                                            foreach ($data['appointments'] as $appointment) {
                                                $scheduleid = htmlspecialchars($appointment["scheduleid"]);
                                                $title = htmlspecialchars($appointment["title"]);
                                                $docname = htmlspecialchars($appointment["docname"]);
                                                $docid = htmlspecialchars($appointment["docid"]);
                                                $scheduledate = htmlspecialchars($appointment["scheduledate"]);
                                                $scheduletime = htmlspecialchars($appointment["scheduletime"]);
                                                $apponum = htmlspecialchars($appointment["apponum"]);
                                                $appodate = htmlspecialchars($appointment["appodate"]);
                                                $appoid = htmlspecialchars($appointment["appoid"]);

                                                echo '<td style="width: 25%;">
                                                <div class="dashboard-items search-items">
                                                    <div style="width:100%;">
                                                        <div class="h3-search">
                                                            Booking Date: ' . substr($appodate, 0, 30) . '<br>
                                                            Reference Number: OC-000-' . $appoid . '
                                                        </div>
                                                        <div class="h1-search">
                                                            ' . substr($title, 0, 21) . '<br>
                                                        </div>
                                                        <div class="h3-search">
                                                            Appointment Number:<div class="h1-search">0' . $apponum . '</div>
                                                        </div>
                                                        <div class="h3-search">
                                                            ' . substr($docname, 0, 30) . '
                                                        </div>    
                                                        <div class="h4-search">
                                                            Scheduled Date: ' . $scheduledate . '<br>Starts: <b>@' . substr($scheduletime, 0, 5) . '</b> (24h)
                                                        </div>
                                                        <br>
                                                        <a href="?action=drop&id=' . $appoid . '&docid=' . $docid . '&schid=' . $scheduleid .'&title=' . urlencode($title) . '&doc=' . urlencode($docname) . '">
                                                            <button class="login-btn btn-primary-soft btn" style="padding-top:11px;padding-bottom:11px;width:100%">
                                                                <font class="tn-in-text">Cancel Booking</font>
                                                            </button>
                                                        </a>
                                                    </div>           
                                                </div>
                                              </td>';
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
        </div>
    </div>
</body>

</html>