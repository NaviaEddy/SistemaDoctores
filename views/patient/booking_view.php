<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../public/css/animations.css">
    <link rel="stylesheet" href="../../public/css/main.css">
    <link rel="stylesheet" href="../../public/css/admin.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/qrcodejs/1.0.0/qrcode.min.js"></script>
    <script src="../../public/scripts/booking_patient.js"></script>
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
        <div class="dash-body">
            <table border="0" width="100%" style=" border-spacing: 0;margin:0;padding:0;margin-top:25px; ">
                <tr>
                    <td width="13%">
                        <a href="schedule.php"><button class="login-btn btn-primary-soft btn btn-icon-back" style="padding-top:11px;padding-bottom:11px;margin-left:20px;width:125px">
                                <font class="tn-in-text">Back</font>
                            </button></a>
                    </td>
                    <td>
                        <form action="schedule.php" method="post" class="header-search">
                            <input type="search" name="search" class="input-text header-searchbar" placeholder="Search Doctor name or Email or Date (YYYY-MM-DD)" list="doctors">
                            <?php
                            echo '<datalist id="doctors">';
                            foreach ($doctors as $doctor) {
                                echo "<option value='" . $doctor['docname'] . "'><br/>";
                            }
                            echo ' </datalist>';
                            ?>
                            <input type="Submit" value="Search" class="login-btn btn-primary btn" style="padding-left: 25px;padding-right: 25px;padding-top: 10px;padding-bottom: 10px;">
                        </form>
                    </td>
                    <td width="15%">
                        <p style="font-size: 14px;color: rgb(119, 119, 119);padding: 0;margin: 0;text-align: right;">
                            Today's Date
                        </p>
                        <p class="heading-sub12" style="padding: 0;margin: 0;">
                            <?php
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
                            <div class="abc scroll">
                                <table width="100%" class="sub-table scrolldown" border="0" style="padding: 50px;border:none">
                                    <tbody>
                                        <?php
                                        // echo "<pre>";
                                        // print_r($data);
                                        // echo "</pre>";
                                        echo '
                                            <form action="../../patient/booking-complete.php" method="post">
                                                <input type="hidden" id="scheduleid" name="scheduleid" value="' . $data['SessionsId'][0]['scheduleid'] . '" >
                                                <input type="hidden" id="docid" name="docid" value="' . $data['SessionsId'][0]['docid'] . '" >
                                                <input type="hidden" id="apponum" name="apponum" value="' . $data['NumbAppointents'] . '" >
                                                <input type="hidden" name="date" value="' . $today . '" >
                                        ';

                                        echo '
                                            <td style="width: 50%;" rowspan="2">
                                                <div class="dashboard-items search-items">       
                                                    <div style="width:100%">
                                                        <div class="h1-search" style="font-size:25px;">
                                                            Session Details
                                                        </div>
                                                        <div class="h3-search" style="font-size:18px;line-height:30px">
                                                            Doctor name:  <br>' . $data['SessionsId'][0]['docname'] . '<br><br>
                                                            Doctor Email:  <br>' . $data['SessionsId'][0]['docemail'] . '<br> 
                                                        </div>
                                                        <div class="h3-search" style="font-size:18px;">
                                                            Session Title: ' . $data['SessionsId'][0]['title'] . '<br>
                                                            Session Scheduled Date: ' . $data['SessionsId'][0]['scheduledate'] . '<br>
                                                            Session Starts : ' . $data['SessionsId'][0]['scheduletime'] . '<br>
                                                            Doctor fee : <br>INR. 100.00<br>
                                                        </div>
                                                        <br>
                                                        <h3>Escanea el código QR para realizar el pago</h3>
                                                        <div id="qrcode">
                                                        </div>
                                                        <br>
                                                    </div>       
                                                </div>
                                            </td>  
                                            <td style="width: 25%;">
                                                <div class="dashboard-items search-items">     
                                                    <div style="width:100%;padding-top: 15px;padding-bottom: 15px;">
                                                        <div class="h1-search" style="font-size:20px;line-height: 35px;margin-left:8px;text-align:center;">
                                                            Your Appointment Number
                                                        </div>
                                                        <center>
                                                            <div class="dashboard-icons" style="margin-left: 0px;width:90%;font-size:70px;font-weight:800;text-align:center;color:var(--btnnictext);background-color: var(--btnice)">' . $data['NumbAppointents'] . '</div>
                                                        </center> 
                                                    </div><br>  
                                                    <br>
                                                    <br>
                                                </div>            
                                            </td>
                                        ';
                                        echo '
                                        <tr>
                                            <td style="display:flex;flex-direction:column;justify-content: center; gap: 10px;">
                                                <div id="spinner-container" style="display:none; justify-content: center; align-items: center; margin-bottom: 10px;">
                                                    <i id="spinner" class="fa fa-spinner fa-spin" style="font-size: 24px;"></i>
                                                    <i id="checkmark" class="fa fa-check" style="font-size: 24px; color: green; display: none;"></i>
                                                </div>
                                                <input type="button" id="verify-payment-btn" class="login-btn btn-primary btn" 
                                                    style="margin-left:10px;padding-left: 25px;padding-right: 25px;padding-top: 10px;padding-bottom: 10px;width:95%;text-align: center;" 
                                                    value="Verify Payment" 
                                                    onclick="verifyPayment()">
                                                <input type="submit" id="booknow-btn" class="login-btn btn-primary btn btn-book" 
                                                    style="opacity: 0.5; margin-left:10px;padding-left: 25px;padding-right: 25px;padding-top: 10px;padding-bottom: 10px;width:95%;text-align: center;" 
                                                    value="Book now" 
                                                    name="booknow" 
                                                    disabled>
                                            </td>
                                        </tr>
                                        </form>';
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