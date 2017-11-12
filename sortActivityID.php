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
$query = "SELECT * FROM project, property, activity, agent, company "
        . "WHERE project.project_id = property.project_id AND property.property_id = activity.property_id "
        . "AND activity.agent_id = agent.agent_id AND agent.company_id = company.company_id ORDER BY activity_id DESC";
$result = mysqli_query($link,$query);

while ($row =  mysqli_fetch_assoc($result)){
    $property[]=$row;
}

echo json_encode($property);

}?>
