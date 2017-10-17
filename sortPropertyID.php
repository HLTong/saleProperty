<?php
session_start();

$host = "localhost";
$username = "root";
$password = "";
$db = "sale_property1";
$link = mysqli_connect($host, $username, $password, $db);

if ($_SESSION['role']=="admin") {

$property = Array();
//SQL query returns multiple database records
$query = "Select * FROM activity, agent, company WHERE agent.agent_id = activity.agent_id "
                . "AND agent.company_id = company.company_id ORDER BY property_id";
$result = mysqli_query($link,$query);

while ($row =  mysqli_fetch_assoc($result)){
    $property[]=$row;
}

echo json_encode($property);

}?>
