<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../public/css/animations.css">  
    <link rel="stylesheet" href="../../public/css/main.css">  
    <link rel="stylesheet" href="../../public/css/admin.css">   
    <script src="../../public/scripts/patients_doctor.js"></script>  
    <title>Patients</title>
    <style>
        .popup{
            animation: transitionIn-Y-bottom 0.5s;
        }
        .sub-table{
            animation: transitionIn-Y-bottom 0.5s;
        }
</style>
</head>

<body>
    <div class="container">
        <?php include("../../views/partials/menu_doctor.php"); ?>
        <?php       
            $selecttype="My";
            $current="My patients Only";
        ?>
        <div class="dash-body">
            <table border="0" width="100%" style=" border-spacing: 0;margin:0;padding:0;margin-top:25px; ">
                <tr >
                    <td width="13%">
                    <a href="../../controllers/doctor/index_controller.php" ><button  class="login-btn btn-primary-soft btn btn-icon-back"  style="padding-top:11px;padding-bottom:11px;margin-left:20px;width:125px"><font class="tn-in-text">Back</font></button></a>
                    </td>
                    
                    <td width="80%">
                        <p style="font-size: 14px;color: rgb(119, 119, 119);padding: 0;margin: 0;text-align: right;">
                            Today's Date
                        </p>
                        <p class="heading-sub12" style="padding: 0;margin: 0;">
                            <?php 
                                echo date('Y-m-d');
                            ?>
                        </p>
                    </td>
                    <td width="10%">
                        <button  class="btn-label"  style="display: flex;justify-content: center;align-items: center;"><img src="../../public/img/calendar.svg" width="100%"></button>
                    </td>
                </tr>
                <tr>
                    <td colspan="4" style="padding-top:10px;">
                        <p class="heading-main12" style="margin-left: 45px;font-size:18px;color:rgb(49, 49, 49)"><?php echo $selecttype." Patients (".$data['patients']->num_rows.")"; ?></p>
                    </td>
                </tr>
                <tr>
                   <td colspan="4">
                       <center>
                        <div class="abc scroll">
                        <table width="93%" class="sub-table scrolldown"  style="border-spacing:0;">
                        <thead>
                        <tr>
                                <th class="table-headin">           
                                    Name
                                </th>
                                <th class="table-headin">
                                    Telephone
                                </th>
                                <th class="table-headin">
                                    Email
                                </th>
                                <th class="table-headin">
                                    Date of Birth
                                </th>
                                <th class="table-headin">
                                    Events
                                </tr>
                        </thead>
                        <tbody>
                            <?php
                                if($data['patients']->num_rows == 0){
                                    echo '<tr>
                                    <td colspan="4">
                                    <br><br><br><br>
                                    <center>
                                    <img src="../../public/img/notfound.svg" width="25%">   
                                    <br>
                                    <p class="heading-main12" style="margin-left: 45px;font-size:20px;color:rgb(49, 49, 49)">We  couldnt find anything related to your keywords !</p>
                                    <a class="non-style-link" href="patient.php"><button  class="login-btn btn-primary-soft btn"  style="display: flex;justify-content: center;align-items: center;margin-left:20px;">&nbsp; Show all Patients &nbsp;</font></button>
                                    </a>
                                    </center>
                                    <br><br><br><br>
                                    </td>
                                    </tr>';
                                }
                                
                                else{
                                    foreach($data['patients'] as $row){
                                        $pid=$row["pid"];
                                        $name=$row["pname"];
                                        $email=$row["pemail"];
                                        $dob=$row["pdob"];
                                        $tel=$row["ptel"];
                                        echo '<tr>
                                            <td> &nbsp;
                                                '.substr($name,0,35).'
                                            </td>
                                            <td>
                                                '.substr($tel,0,15).'
                                            </td>
                                            <td>
                                                '.substr($email,0,20).'
                                             </td>
                                            <td>
                                                '.substr($dob,0,10).'
                                            </td>
                                            <td >
                                            <div style="display:flex;justify-content: center;">
                                            <a href="?action=view&id='.$pid.'" class="non-style-link"><button  class="btn-primary-soft btn button-icon btn-view"  style="padding-left: 40px;padding-top: 12px;padding-bottom: 12px;margin-top: 10px;"><font class="tn-in-text">Medical history</font></button></a>
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