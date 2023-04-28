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
$municipality = $_POST['city'];
$sql= "SELECT * FROM REGISTRATION WHERE CITY = $municipality";
$resuslts = sqlsrv_query ($conn,$sql);
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <link rel="stylesheet" href="style.css">
        <meta charset="UTF-8">
        <meta name="viewport" conten="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie-edge">
        <title>City/Municipality List</title>
    </head>
<body>
    <table>border="3px" style =" width: 1000px; line-height: 20px;" "align=center"> 
        <thead>
            <tr>
                <th>FormID</th>
                <th>First_Name</th>
                <th>Middle_Name</th>
                <th>Last_Name</th>
                <th>House Number</th>
                <th>Street/Subdivision</th>
                <th>Barangay</th>
                <th>City/Municipality</th>
            </tr>
        </thead>
        <?php
            while($rows = sqlsrv_fetch_array($reults)){
                $fieldname1=$rows['FORMID'];
                $fieldname2=$rows['FIRST_NAME'];
                $fieldname3=$rows['MIDDLE_NAME'];
                $fieldname4=$rows['LAST_NAME'];
                $fieldname5=$rows['HOUSE_NUMBER'];
                $fieldname6=$rows['SUBD'];
                $fieldname7=$rows['BARANGAY'];
                $fieldname8=$rows['CITY'];
                
                echo '<tr>
                <td>' . $fieldname1 . '</td>
                <td>' . $fieldname2 . '</td>
                <td>' . $fieldname3 . '</td>
                <td>' . $fieldname4 . '</td>
                <td>' . $fieldname5 . '</td>
                <td>' . $fieldname6 . '</td>
                <td>' . $fieldname7 . '</td>
                <td>' . $fieldname8 . '</td>
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