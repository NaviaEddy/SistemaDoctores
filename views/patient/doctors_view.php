<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../public/css/animations.css">
    <link rel="stylesheet" href="../../public/css/main.css">
    <link rel="stylesheet" href="../../public/css/admin.css">
    <link rel="stylesheet" href="../../public/css/popup.css">
    <script src="../../public/scripts/doctors_patient.js"></script>
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
                        <a href="doctors.php"><button class="login-btn btn-primary-soft btn btn-icon-back" style="padding-top:11px;padding-bottom:11px;margin-left:20px;width:125px">
                                <font class="tn-in-text">Back</font>
                            </button></a>
                    </td>
                    <td>
                        <form action="" method="post" class="header-search">
                            <input type="search" name="search" class="input-text header-searchbar" placeholder="Search Doctor name or Email" list="doctors">
                            <?php
                            echo '<datalist id="doctors">';
                            foreach ($data['doctors'] as $doctorc) {
                                echo "<option value='" . $doctorc['docname'] . "'><br/>";
                                echo "<option value='" . $doctorc['docemail'] . "'><br/>";
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
                            date_default_timezone_set('Asia/Kolkata');
                            $date = date('Y-m-d');
                            echo $date;
                            ?>
                        </p>
                    </td>
                    <td width="10%">
                        <button class="btn-label" style="display: flex;justify-content: center;align-items: center;"><img src="../../public/img/calendar.svg" width="100%"></button>
                    </td>
                </tr>
                <tr>
                    <td colspan="4" style="padding-top:10px;">
                        <p class="heading-main12" style="margin-left: 45px;font-size:18px;color:rgb(49, 49, 49)">All Doctors (<?php echo $data['doctorsCount'] ?>)</p>
                    </td>
                </tr>

                <?php
                if ($_POST) {
                    $keyword = $_POST["search"];

                    $sqlmain = "select * from doctor where docemail='$keyword' or docname='$keyword' or docname like '$keyword%' or docname like '%$keyword' or docname like '%$keyword%'";
                }
                ?>
                <tr>
                    <td colspan="4">
                        <center>
                            <div class="abc scroll">
                                <table width="93%" class="sub-table scrolldown" border="0">
                                    <thead>
                                        <tr>
                                            <th class="table-headin">
                                                Doctor Name
                                            </th>
                                            <th class="table-headin">
                                                Email
                                            </th>
                                            <th class="table-headin">
                                                Specialties
                                            </th>
                                            <th class="table-headin">
                                                Events
                                            <th>
                                        </tr>
                                    </thead>

                                    <tbody style="text-align: center;">
                                        <?php

                                        if ($data['doctorsCount'] == 0) {
                                            echo '<tr>
                                    <td colspan="4">
                                    <br><br><br><br>
                                    <center>
                                    <img src="../../public/img/notfound.svg" width="25%">   
                                    <br>
                                    <p class="heading-main12" style="margin-left: 45px;font-size:20px;color:rgb(49, 49, 49)">We  couldnt find anything related to your keywords !</p>
                                    <a class="non-style-link" href="doctors.php"><button  class="login-btn btn-primary-soft btn"  style="display: flex;justify-content: center;align-items: center;margin-left:20px;">&nbsp; Show all Doctors &nbsp;</font></button>
                                    </a>
                                    </center>
                                    <br><br><br><br>
                                    </td>
                                    </tr>';
                                        } else {
                                            foreach ($data['doctorsSpeciality'] as $row) {
                                                $docid = $row["docid"];
                                                $name = $row["docname"];
                                                $email = $row["docemail"];
                                                $spe = $row["sname"];
                                                $doctel = $row["doctel"];
                                                echo '<tr>
                                        <td>
                                            ' . substr($name, 0, 30) . '
                                        </td>
                                        <td>
                                            ' . substr($email, 0, 20) . '
                                        </td>
                                        <td>
                                            ' . substr($spe, 0, 20) . '
                                        </td>
                                        <td>
                                        <div style="display:flex;justify-content: center; gap: 10px;">
                                            <a href="?action=view&name=' . $name . '&email=' . $email . '&spe=' . $spe . '&tel=' . $doctel . '" class="non-style-link"><button  class="btn-primary-soft btn button-icon btn-view"  style="padding-left: 40px;padding-top: 12px;padding-bottom: 12px;margin-top: 10px;"><font class="tn-in-text">View</font></button></a>
                                       
                                            <a href="?action=reviews&id=' . $docid . '"  class="non-style-link"><button  class="btn-primary-soft btn button-icon menu-icon-review-active"  style="padding-left: 40px;padding-top: 12px;padding-bottom: 12px;margin-top: 10px;"><font class="tn-in-text">Reviews</font></button></a>
                                        </div>
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
        </div>

    </div>
</body>

</html>