<div class="menu">
    <table class="menu-container" border="0">
        <tr>
            <td style="padding:10px" colspan="2">
                <table border="0" class="profile-container">
                    <tr>
                        <td width="30%" style="padding-left:20px">
                            <img src="../../public/img/user.png" alt="" width="100%" style="border-radius:50%">
                        </td>
                        <td style="padding:0px;margin:0px;">
                            <p class="profile-title"><?php echo substr($data['username'], 0, 13)  ?>..</p>
                            <p class="profile-subtitle"><?php echo substr($data['useremail'], 0, 22)  ?></p>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <a href="../../logout.php"><input type="button" value="Log out" class="logout-btn btn-primary-soft btn"></a>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr class="menu-row">
            <td class="menu-btn menu-icon-home">
                <a href="../../controllers/patient/index_controller.php" class="non-style-link-menu ">
                    <div>
                        <p class="menu-text">Home</p>
                </a>
            </td>
        </tr>

        <tr class="menu-row">
            <td class="menu-btn menu-icon-doctor">
                <a href="../../controllers/patient/doctors_controller.php" class="non-style-link-menu">
                    <div>
                        <p class="menu-text">All Doctors</p>
                    </div>
                </a>
            </td>
        </tr>

        <tr class="menu-row">
            <td class="menu-btn menu-icon-session">
                <a href="../../controllers/patient/schedule_controller.php" class="non-style-link-menu">
                    <div>
                        <p class="menu-text">Scheduled Sessions</p>
                    </div>
                </a>
            </td>
        </tr>
        <tr class="menu-row">
            <td class="menu-btn menu-icon-appoinment  menu-icon-appoinment">
                <a href="../../controllers/patient/appointment_controller.php" class="non-style-link-menu">
                    <div>
                        <p class="menu-text">My Bookings</p>
                </a>
            </td>
        </tr>

        <!-- <tr class="menu-row">
            <td class="menu-btn menu-icon-settings">
                <a href="../../patient/settings.php" class="non-style-link-menu">
                    <div>
                        <p class="menu-text">Settings</p>
                    </div>
                </a>
            </td>
        </tr> -->
    </table>
</div>