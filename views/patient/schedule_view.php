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
        <div class="dash-body">
            <table border="0" width="100%" style=" border-spacing: 0;margin:0;padding:0;margin-top:25px; ">
                <tr>
                    <td width="13%">
                        <a href="schedule.php"><button class="login-btn btn-primary-soft btn btn-icon-back" style="padding-top:11px;padding-bottom:11px;margin-left:20px;width:125px">
                                <font class="tn-in-text">Back</font>
                            </button></a>
                    </td>
                    <td>
                        <form action="" method="post" class="header-search">
                            <input type="search" name="search" class="input-text header-searchbar" placeholder="Search Doctor name or Email or Date (YYYY-MM-DD)" list="doctors" value="<?php //echo $insertkey 
                                                                                                                                                                                        ?>">&nbsp;&nbsp;
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
                            <?php echo $today;     ?>
                        </p>
                    </td>
                    <td width="10%">
                        <button class="btn-label" style="display: flex;justify-content: center;align-items: center;"><img src="../../public/img/calendar.svg" width="100%"></button>
                    </td>
                </tr>
                <tr>
                    <td colspan="4" style="padding-top:10px;width: 100%;">
                        <p class="heading-main12" style="margin-left: 45px;font-size:18px;color:rgb(49, 49, 49)"><?php echo "All Sessions" . "(" . $data['Sessions']->num_rows . ")"; ?> </p>
                        <!-- <p class="heading-main12" style="margin-left: 45px;font-size:22px;color:rgb(49, 49, 49)"><?php //echo $q . $insertkey . $q; 
                                                                                                                        ?> </p> -->
                    </td>
                </tr>
                <tr>
                    <td colspan="4">
                        <center>
                            <div class="abc scroll">
                                <table width="100%" class="sub-table scrolldown" border="0" style="padding: 50px;border:none">
                                    <tbody>
                                        <?php
                                        if ($data['Sessions']->num_rows == 0) {
                                            echo '<tr>
                                    <td colspan="4">
                                    <br><br><br><br>
                                    <center>
                                    <img src="../../public/img/notfound.svg" width="25%">        
                                    <br>
                                    <p class="heading-main12" style="margin-left: 45px;font-size:20px;color:rgb(49, 49, 49)">We  couldnt find anything related to your keywords !</p>
                                    <a class="non-style-link" href="schedule.php"><button  class="login-btn btn-primary-soft btn"  style="display: flex;justify-content: center;align-items: center;margin-left:20px;">&nbsp; Show all Sessions &nbsp;</font></button>
                                    </a>
                                    </center>
                                    <br><br><br><br>
                                    </td>
                                    </tr>';
                                        } else {
                                            $count = 0;
                                            foreach ($data['Sessions'] as $session) {
                                                if ($count % 3 == 0) {
                                                    echo "<tr>";
                                                }
                                                echo '
                                                <td style="width: 25%;">
                                                    <div class="dashboard-items search-items"> 
                                                        <div style="width:100%">
                                                            <div class="h1-search">' . substr($session['title'], 0, 21) . '</div><br>
                                                            <div class="h3-search">' . substr($session['docname'], 0, 30) . '</div>
                                                            <div class="h4-search">' . $session['scheduledate'] . '<br>Starts: <b>@' . substr($session['scheduletime'], 0, 5) . '</b> (24h)</div>
                                                            <br>
                                                            <a href="../../controllers/patient/booking_controller.php?id=' . $session['scheduleid'] . '">
                                                                <button class="login-btn btn-primary-soft btn" style="padding-top:11px;padding-bottom:11px;width:100%">
                                                                    <font class="tn-in-text">Book Now</font>
                                                                </button>
                                                            </a>
                                                        </div>
                                                    </div>
                                                </td>';

                                                $count++;
                                                if ($count % 3 == 0) {
                                                    echo "</tr>";
                                                }
                                            }
                                            if ($count % 3 != 0) {
                                                echo "</tr>";
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