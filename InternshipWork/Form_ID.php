<?php
$serverName = "LAPTOP-F0MIKJDM\SQLEXPRESS";
$connctionOptions = [
    "Database" => "DLSU",
    "Uid" => "",
    "PWD" =>  ""
];
$conn = sqlsrv_connect($serverName, $connctionOptions);
if ($conn == false){
    die(print_r(sqlsrv_errors(),true));
}
$FID = $_POST['Form_ID'];
$sql= "SELECT * FROM REGISTRATION WHERE FORMI = $FID";
$resuslts = sqlsrv_query ($conn,$sql);
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <link rel="stylesheet" href="style.css">
        <meta charset="UTF-8">
        <meta name="viewport" conten="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie-edge">
        <title>Complete List</title>
    </head>
    <body>
        <h1>Complete Vaccination List</h1>
        <table>border="3px" style =" width: 1000px; line-height: 20px;" "align=center">
            <thead>
                <tr>
                    <th>FormID</th>
                    <th>First_Name</th>
                    <th>Middle_Name</th>
                    <th>Last_Name</th>
                    <th>Birthday</th>
                    <th>House Number</th>
                    <th>Street/Subdivision</th>
                    <th>Barangay</th>
                    <th>City/Municipality</th>
                    <th>Mobile Number</th>
                    <th>Telephone Number</th>
                    <th>Email</th>
                    <th>Vaccination Status</th>
                    <th>Vaccinaton Brand</th>
                    <th>Date of 1st Dose</th>
                    <th>Date of 2nd Dose</th>
                    <th>Booster Status</th>
                    <th>Booster Times</th>
                    <th>First Booster</th>
                    <th>Date of 1st Booster</th>
                    <th>Second Booster</th>
                    <th>Date of 2nd Booster</th>
                </tr>
            </thead>
        <?php
            while($rows = sqlsrv_fetch_array($reults)){
                $fieldname1=$rows['FORMID'];
                $fieldname2=$rows['FIRST_NAME'];
                $fieldname3=$rows['MIDDLE_NAME'];
                $fieldname4=$rows['LAST_NAME'];
                $fieldname5=$rows['BIRTHDAY']->format('d/m/Y');
                $fieldname6=$rows['HOUSE_NUMBER'];
                $fieldname7=$rows['SUBD'];
                $fieldname8=$rows['BARANGAY'];
                $fieldname9=$rows['CITY'];
                $fieldname10=$rows['MOBILE_NO'];
                $fieldname11=$rows['LANDLINE_NO'];
                $fieldname12=$rows['EMAIL'];
                $fieldname13=$rows['VAC_STATUS'];
                $fieldname14=$rows['VAC_BRAND'];
                $fieldname15=$rows['FIRST_DOSE_DATE']->format('d/m/Y');
                $fieldname16=$rows['FSECOND_DOSE_DATE']->format('d/m/Y');
                $fieldname17=$rows['BOOST_STATUS'];
                $fieldname18=$rows['BOOST_TIMES'];
                $fieldname19=$rows['FIRST_BOOSTER'];
                $fieldname20=$rows['FIRST_BOOSTER_DATE']->format('d/m/Y');
                $fieldname21=$rows['SECOND_BOOSTER'];
                $fieldname22=$rows['SECOND_BOOSTER_DATE']->format('d/m/Y');

                echo '<tr>
                <td>' . $fieldname1 . '</td>
                <td>' . $fieldname2 . '</td>
                <td>' . $fieldname3 . '</td>
                <td>' . $fieldname4 . '</td>
                <td>' . $fieldname5 . '</td>
                <td>' . $fieldname6 . '</td>
                <td>' . $fieldname7 . '</td>
                <td>' . $fieldname8 . '</td>
                <td>' . $fieldname9 . '</td>
                <td>' . $fieldname10 . '</td>
                <td>' . $fieldname11 . '</td>
                <td>' . $fieldname12 . '</td>
                <td>' . $fieldname13 . '</td>
                <td>' . $fieldname14 . '</td>
                <td>' . $fieldname15 . '</td>
                <td>' . $fieldname16 . '</td>
                <td>' . $fieldname17 . '</td>
                <td>' . $fieldname18 . '</td>
                <td>' . $fieldname19 . '</td>
                <td>' . $fieldname20 . '</td>
                <td>' . $fieldname21 . '</td>
                <td>' . $fieldname22 . '</td>
                </tr>';
            }
            ?>
            </table>
            <br>
            <button onClick ="window.location.reload();" class="button1">Refresh Page</button>
            <button onClick ="returnpageeFunction()" class="button3">Return</button>
            <script>
                function returnpageeFunction(){
                    window.location.href ="Report Page.html"
                }
            </script>
    </body>