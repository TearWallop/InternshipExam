<!DOCTYPE html>
<html lang="en">
    <head>
        <link rel="stylesheet" href="style.css">
        <meta charset="UTF-8">
        <meta name="viewport" conten="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie-edge">
        <title>Registration Form</title>
    </head>

    <body>
        <?php
        //ErrorLog
        $firstnameError="";
        $middlenameError="";
        $lastnameError="";
        $birhtdayError="";
        $landlineError="";
        $mobileError="";
        $emailadError="";
        $errormsg="";
        $seconddoseError="";
        $firstboostError="";
        $secondboostError="";

            if ($_SERVER['REQUEST_METHOD'] == "POST"){

                $serverName = "LAPTOP-F0MIKJDM\SQLEXPRESS";
                $connctionOptions = [
                    "Database" => "DLSU",
                    "Uid" => "",
                    "PWD" =>  ""
                ];
                $conn = sqlsrv_connect($serverName, $connctionOptions);
                if ($conn == false)
                die(print_r(sqlsrv_errors(),true));

                if(empty($_POST['firstname'])){
                    $firstnameError= " [ERROR], First name missing";
                }else{
                    $firstname=$_POST ['firstname'];
                    if (!preg_match("/^[a-zA-Z-]')*$/", $firstname)){
                    $firstnameError = "Only alphabetical characters allowed";
                }
            }
                if(empty($_POST['middlename'])){
                $middlenameError= " [ERROR], Middle name missing";
                }else{
                $middletname=$_POST ['middlename'];
                if (!preg_match("/^[a-zA-Z-]')*$/", $middlename)){
                $middlenameError = "Only alphabetical characters allowed";
                }
            }
                if(empty($_POST['lastname'])){
                $lastnameError= " [ERROR], Last name missing";
                }else{
                $lastname=$_POST ['lastname'];
                if (!preg_match("/^[a-zA-Z-]')*$/", $lastname)){
                $lastnameError = "Only alphabetical characters allowed";
                }
            }
                if(empty($_POST['bday'])){
                $birthdayError= " [ERROR], Bithday date missing";
                }
                if(empty($_POST['mobile'])){
                    $mobileError= " [ERROR], Mobile number missing";
                    }else{
                    $mobileError=$_POST ['mobile'];
                    if (!preg_match("/^[0-9]')*$/", $mobilenum)){
                    $mobileError = "Only numerical characters allowed";
                    } else {
                        $mobilenum=$_POST ['mobile'];
                        if(strlen(mobilenum) !=11){
                            $mobileError = "You must type only 11 digits";
                        }else{
                            $psql= "SELECT * FROM REGISTRATION WHERE MOBILE_NO = '$mobilenum'";
                            $mp = sqlsrv_query($conn,$psql);
                            while($fmp = sqlsrv_fetch_array($mp)) {
                                if ($fmp['MOBILE_NO']) {
                                    $mobileError = "Mobile number is already registered, Please use anotther one";
                                   }
                                }
                            }
                        }
                    }
                if(empty($_POST['landline'])){
                    $landlineError= " [ERROR], Landline number missing";
                    }else{
                    $landlinenum=$_POST ['landline'];
                    if (!preg_match("/^[0-9]')*$/", $landlinenum)){
                    $landlineError = "Only numerical characters allowed";
                    } else {
                        $landlinenum=$_POST ['landline'];
                        if(strlen(landlinenum) !=7){
                            $lanndlineError = "You must type only 7 digits";
                        }else{
                            $lsql= "SELECT * FROM REGISTRATION WHERE LANDLINE_NO = '$landlinenum'";
                            $lp = sqlsrv_query($conn,$lsql);
                            while($flp = sqlsrv_fetch_array($lp)) {
                                if ($flp['LANDLINE_NO']) {
                                    $landlineError = "Ladline number is already registered, Please use anotther one";
                                   }
                                }
                            }
                        }
                    }
                
                if (empty($_POST['email'])){
                    $emailadError = "Please insert an email address";
                }else{
                    $email=$_POST['email'];
                    $esql = "SELECT * FROM REGISTRATION WHERE EMAIL = '$email'";
                    $ep = sqlsrv_query($conn, $esql);
                    while ($fep = sqlsrv_fetch_array($ep)){
                        if ($fep['EMAIL']) {
                            $emailadError = "Email already registered, please insert a new email address.";
                        }
                    }
                }
                    if (($_POST['seconddose']) <= ($_POST['firstdose'])) {
                        $seconddoseError = "2nd vaccination date cannot come before the 1st dose date"; 
                    }else{
                        $seconddosee=$_POST ['seconddose'];
                    }
                    if (($_POST['firstboosterdate']) <= ($_POST['secondose'])) {
                        $firstboostError = "1st booster vaccination date cannot come before the 2nd dose date"; 
                    }else{
                        $firstboostdate=$_POST ['firstboosterdate'];
                    }
                    if (($_POST['secondboosterdate']) <= ($_POST['firstboosterdate'])) {
                        $secondboostError = "2nd booster vaccination date cannot come before the 1st booster dose date"; 
                    }else{
                        $seconddode=$_POST ['secondboosterdate'];
                    }
            }   
        ?>
        <div class="header">
            <h1>Vaccine Form Registration</h1>
            <hr>
            <form id= "registration" action="<?php echo htmlspecialchars ($_SERVER["PHP_SELF"]);?>" method="POST">
        <h2>Personal Information</h2>
        <label for="firstname">First Name: </label><input type="text" id="firstname" name="firstname"><span class="error">* <?php echo $firstnameError; ?></span>
        <br>
        <br>
        <label for="middlename">Middle Name: </label><input type="text" id="middlename" name="middlename"><span class="error">* <?php echo $middlenameError; ?></span>
        <br>
        <br>
        <label for="lastname">Last Name: </label><input type="text" id="lastname" name="lastname"><span class="error">* <?php echo $lastnameError; ?></span>
        <br>
        <br>
        <label for="bday">Birthdate: </label><input type="date" id="bday" name="bday" min="1999-01-01" max="2023-12-31"><span class="error">* <?php echo $birthdayError; ?></span>

            <h2>Address</h2>
            <label for="housenumber">House Number: </label><input type="text" id="housenumber" name="housenumber">
            <label for="subd">Street/Subdivision: </label><input type="text" id="subd" name="subd">
            <label for="barangay">Barangay: </label><input type="text" id="barangay" name="barangay">
            <label for="city">City/Minicipality </label>
            <select name="city" id="city">
            <option value="CITY MUNICIPALITY">City/Minicipality </option>
            <option value="CITY MUNICIPALITY">Alfonso </option>
            <option value="CITY MUNICIPALITY">Bacoor </option>
            <option value="CITY MUNICIPALITY">Cavite City </option>
            <option value="CITY MUNICIPALITY">Dasmarinas </option>
            <option value="CITY MUNICIPALITY">General Trias </option>
            <option value="CITY MUNICIPALITY">Imus </option>
            <option value="CITY MUNICIPALITY">Indang </option>
            <option value="CITY MUNICIPALITY">Naic </option>
            <option value="CITY MUNICIPALITY">Silang </option>
            <option value="CITY MUNICIPALITY">Tagaytay </option>
            <option value="CITY MUNICIPALITY">Tanza </option>
            <option value="CITY MUNICIPALITY">Trece Martires </option>
            </select>
            <br>
            <br>
            <hr>
                <h2>Contact Details</h2>
                <label for="mobile">Mobile Number: </label><input type="text" id="mobile" name="mobile" placeholder="09xxxxxxxxxxx"><span class="error">* <?php echo $mobileError; ?></span>
                <br>
                <br>
                <label for="landline">Landline Number: </label><input type="text" id="landline" name="landline" placeholder="xxxxxxxxx"><span class="error">* <?php echo $landlineError; ?></span>
                <br>
                <br>
                <label for="email">E-Mail: </label><input type="text" id="email" name="email"><span class="error">* <?php echo $emailadError; ?></span>
                <br>
                <br>
                    <h2>Vaccine Details</h2>
                    <label><b>Are You Fully Vaccinated?</b></label>
                    <br>
                    <input type="radio" id="yes" name="vacquestion" value="yes"> <label for="yes">yes</label>
                    <br>
                    <input type="radio" id="no" name="vacquestion" value="no"> <label for="no">no</label>
            <p><b>If not SKIP the question and if vaccinated only once please fill the dtae of the first dose only</b></p>
            <label for="vacbrand"> Vaccine Brand: </label>
            <select name="vacbrand" id="course">
            <option value="NONE">N/A </option>
            <option value="ASTRAZENECA"> Astrazeneca </option>
            <option value="J&J">N/Johnson & Johnson </option>
            <option value="MODERNA">Moderna </option>
            <option value="PFIZER">Pfizer </option>
            <option value="SINOVAC">Sinovac </option>
            <option value="SPUTNIK">Sputnik </option>
            </select>
        <br>
        <br>
        <label for="firstdosedate">1st Dose Date: </label>
        <input type="date" id="firstdodedate" name="firstdosedate" min="2021-01-01" max="2023-12-31">
        <br>
        <br>
        <label for="seconddosedate">2nd Dose Date: </label>
        <input type="date" id="seconddosedate" name="seconddosedate" min="2021-01-01" max="2023-12-31"><span class="error">*<?php echo $seconddoseError;?></span>
        </span>
        <br>
        <br>
        <br>

    <h2>Booster Details</h2>
        <label><b>Did you get your Booster?</b></label>
        <br>
        <input type="radio" id="yes" name="booster" value="yes"><label for="yes">yes</label>
        <br>
        <input type="radio" id="no" name="booster" value="no"><label for="no">no</label>
        <br>
            <label><b>How many times?</b></label>
            <br>
            <input type="radio" id="nones" name="times" value="nones"><label for="nones">None</label>
            <br>
            <input type="radio" id="once" name="times" value="once"><label for="once">once</label>
            <br>
            <input type="radio" id="twice" name="times" value="twice"><label for="twice">twice</label>
            <br>
            <p><b>If you only did once please fill the first booster date</b></p>
                <label for="firstboostdate"><b>First Booster Date?</b></label>
                <input type="date" id="date" name="firstboostdate" min="2021-01-01" max="2023-12-31">
                <span class="error">*<?php echo $firstboostError;?></span>
                <label for="vacbrand"> 1st Booster Brand: </label>
                <select name="vacbrand1" id="vacbrand">
                <option value="NONE">N/A </option>
                <option value="ASTRAZENECA"> Astrazeneca </option>
                <option value="J&J">N/Johnson & Johnson </option>
                <option value="MODERNA">Moderna </option>
                <option value="PFIZER">Pfizer </option>
                <option value="SINOVAC">Sinovac </option>
            </select>
            <br>
            <br>
            <label for="secondboostdate">Second Booster Date?</label>
                <input type="date" id="date" name="secondboostdate" min="2021-01-01" max="2023-12-31">
                <span class="error">*<?php echo $secondboostError;?></span>
                <label for="vacbrand"> 2nd Booster Brand: </label>
                <select name="vacbrand2" id="vacbrand">
                <option value="NONE">N/A </option>
                <option value="ASTRAZENECA"> Astrazeneca </option>
                <option value="J&J">N/Johnson & Johnson </option>
                <option value="MODERNA">Moderna </option>
                <option value="PFIZER">Pfizer </option>
                <option value="SINOVAC">Sinovac </option>
            <input type="submit" id="submit" name="submit">
            <button onClick ="window.location.reload();" class="button1">Refresh Page</button>
            <button onClick ="returnpageeFunction()" class="button3">Return</button>
            <script>
                function returnpageeFunction(){
                    window.location.href ="Report Page.html"
                }
            </script>
        </div>
        <?php
            if(isset($_POST['submit'])) {
                if ($firstnameError-- && $middlenameError-- && $lastnameError-- && $birthdayError--&& $mobileError--&& $landlineError-- && $emailadError--){
                    $middlename=$_POST['middlename'];
                    $lastname=$_POST['lastanem'];
                    $bday=$_POST['bday'];
                    $housenumber=$_POST['housenumber'];
                    $subd=$_POST['subd'];
                    $barangay=$_POST['barangay'];
                    $municipality=$_POST['municipality'];
                    $mobilenum=$_POST['mobile'];
                    $landlinenum=$_POST['landline'];
                    $firstname=$_POST['firstname'];
                    $firstname=$_POST['firstname'];
                    $firstname=$_POST['firstname'];
                    $firstname=$_POST['firstname'];
                    $firstname=$_POST['firstname'];
                    $firstname=$_POST['firstname'];
                    $email=$_POST['email'];
                    $vacquestion=$_POST['vacquestion'];
                    $vacbrand=$_POST['vacbrand'];
                    $firstdose=$_POST['firstdose'];
                    $seconddose=$_POST['seconddode'];
                    $booster=$_POST['booster'];
                    $boosttimes=$_POST['times'];
                    $boostbrand1=$_POST['email'];
                    $firstboostdate=$_POST['firstboostdate'];
                    $boostbrand2=$_POST['boostbrand2'];
                    $secondboostdate=$_POST['secondboostdate'];

                    $sql = "INSERT INTO REGISTRATION(FIRST_NAME,MIDDLE_NAME,LAST_NAME,VAC_STATUS,VAC_BRAND,FIRST_DOSE_DATE,SECOND_DOSE_DATE,BOOST_STATUS,FIRST_BOOSTER,FIRST_BOOSTER_DATE,SECOND_BOOSTER,SECOND_BOOSTER_DATE,
                    BIRTHDAY,HOUSE_NUMBER,SUBD,BARANGAY,CITY,MOBILE_NO,LANDLINE_NO,EMAIL)
                VALUES('$firstname','$middlename','$lastname','$vacbrand','$vacquestion','$firstdode',''$seconddose','$booster','$boosttimes','$boostbrand1','$firstboostdate','$boostbrand2','$secondboostdate','$bday','$housenumber,''$subd','$barangay','$municipality','$mobilenum','$landlinenum','$email')";

                        $result = sqlsrv_query ($conn,$sql);
                        
                        if($result)
                            echo("Registration Successful");
                            else
                            echo("Error");
                    }
            }
            ?>
    </body>
    </html>
