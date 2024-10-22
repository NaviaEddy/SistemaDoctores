<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../public/css/animations.css">  
    <link rel="stylesheet" href="../../public/css/main.css">  
    <link rel="stylesheet" href="../../public/css/signup.css">
    <script src="../../public/scripts/create_account_login.js"></script>   
    <title>Create Account</title>
    <style>
        .container{
            animation: transitionIn-X 0.5s;
        }
    </style>
</head>
<body>
<center>
        <div class="container">
            <table border="0" style="width: 69%;">
                <tr>
                    <td colspan="2">
                        <p class="header-text">Let's Get Started</p>
                        <p class="sub-text">It's Okey, Now Create User Account.</p>
                    </td>
                </tr>
                <tr>
                    <td class="label-td" colspan="2">
                        <label for="newemail" class="form-label">Email: </label>
                    </td>
                </tr>
                <tr>
                    <td class="label-td" colspan="2">
                        <input type="email" id="newemail" class="input-text" placeholder="Email Address" required>
                    </td>               
                </tr>
                <tr>
                    <td class="label-td" colspan="2">
                        <label for="tele" class="form-label">Mobile Number: </label>
                    </td>
                </tr>
                <tr>
                    <td class="label-td" colspan="2">
                        <input type="tel" id="tele" class="input-text" placeholder="ex: +91 0000000000">
                    </td>
                </tr>
                <tr>
                    <td class="label-td" colspan="2">
                        <label for="newpassword" class="form-label">Create New Password: </label>
                    </td>
                </tr>
                <tr>
                    <td class="label-td" colspan="2">
                        <input type="password" id="newpassword" class="input-text" placeholder="New Password" required>
                    </td>
                </tr>
                <tr>
                    <td class="label-td" colspan="2">
                        <label for="cpassword" class="form-label">Confirm Password: </label>
                    </td>
                </tr>
                <tr>
                    <td class="label-td" colspan="2">
                        <input type="password" id="cpassword" class="input-text" placeholder="Confirm Password" required>
                    </td>
                </tr>
                <tr> 
                    <td colspan="2">
                        <label for="promter" class="form-label" style="color:rgb(255, 62, 62);text-align:center;" id="error-pswd"></label>
                    </td>
                </tr> 
                <tr>
                    <td>
                        <button type="reset" class="login-btn btn-primary-soft btn">Reset</button>
                    </td>
                    <td>
                        <button type="button" onclick="submitForm()" class="login-btn btn-primary btn">Sign Up</button>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <br>
                        <label class="sub-text" style="font-weight: 280;">Already have an account&#63; </label>
                        <a href="../../controllers/login/login_controller.php" class="hover-link1 non-style-link">Login</a>
                        <br><br><br>
                    </td>
                </tr>
            </table>
        </div>
    </center>
</body>
</html>
