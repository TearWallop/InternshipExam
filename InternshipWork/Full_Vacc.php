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

$VAC = $_POST['question1'];
if(($_POST['question1'] == 'Yes')){
    $sql= "SELECT * FROM REGISTRATION WHERE VAC_STATUS= '$VAC' AND BOOST_TIMES = 'None' ";
    $results = sqlsrv_query($onn,$sql);
}

if(($_POST['question1'] == 'Once')){
    $sql= "SELECT * FROM REGISTRATION WHERE BOOST_TIMES = '$VAC' ";
    $results = sqlsrv_query($onn,$sql);
}
if(($_POST['question1'] == 'tWICE')){
    $sql= "SELECT * FROM REGISTRATION WHERE BOOST_TIMES = '$VAC' ";
    $results = sqlsrv_query($onn,$sql);
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <link rel="stylesheet" href="style.css">
        <meta charset="UTF-8">
        <meta name="viewport" conten="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie-edge">
        <title>Vaccinated and Boostered</title>
    </head>
    <body>
        <h1>Registered Users List</h1>
        <table>border="3px" style =" width: 1000px; line-height: 20px;" "align=center">
            <thead>
                <tr>
                    <th>FormID</th>
                    <th>First_Name</th>
                    <th>Middle_Name</th>
                    <th>Last_Name</th>
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
                $fieldname5=$rows['VAC_STATUS'];
                $fieldname6=$rows['VAC_BRAND'];
                $fieldname7=$rows['FIRST_DOSE_DATE']->format('d/m/Y');
                $fieldname8=$rows['FSECOND_DOSE_DATE']->format('d/m/Y');
                $fieldname9=$rows['BOOST_STATUS'];
                $fieldname10=$rows['BOOST_TIMES'];
                $fieldname11=$rows['FIRST_BOOSTER'];
                $fieldname12=$rows['FIRST_BOOSTER_DATE']->format('d/m/Y');
                $fieldname13=$rows['SECOND_BOOSTER'];
                $fieldname14=$rows['SECOND_BOOSTER_DATE']->format('d/m/Y');

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
