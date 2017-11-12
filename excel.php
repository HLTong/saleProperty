<?php

$host = "localhost";
$username = "root";
$password = "";
$db = "sale_property1";
$link = mysqli_connect($host, $username, $password, $db);


$output = '';

if (isset($_POST["export_excel"])) 
{
    $sql = "SELECT * FROM project, prospect, agent, company WHERE project.project_id = prospect.project_id AND prospect.agent_id = agent.agent_id AND agent.company_id = company.company_id ORDER BY prospect_id DESC";
    $result = mysqli_query($link, $sql);
    if (mysqli_num_rows($result) > 0) 
    {
        header("Content-Type: application/xls");
        header("Content-Disposition:attachment; filename=Prospect.xls");
        echo "sep=;\n";
        echo "Prospect ID;Date Call/Visit;Buyer's Name;Contact No;Email;Project Name;Site Visit;Buyer's Knowledge;Buyer's Interest;Follow-up;Dead Deal;Deal Closed;Agent Name;Agent Company\n";

        
        /*$output .= "
            <table class = 'table table-bordered' bordered='1'>
                <tr>
                    <th>Prospect ID:</th>
                    <th>Date Call/Visit:</th>
                    <th>Buyer's Name:</th> 
                    <th>Contact No:</th>
                    <th>Email:</th>
                    <th>Project Name:</th>
                    <th>Site Visit:</th>
                    <th>Buyer's Knowledge:</th>
                    <th>Buyer's Interest:</th>
                    <th>Follow-Up:</th>
                    <th>Dead Deal:</th>
                    <th>Deal Closed:</th>
                    <th>Agent Name:</th>
                    <th>Agent Company:</th>
                </tr>
        ";*/
        
        while($row= mysqli_fetch_array($result))
        {
            echo $row['prospect_id'].";".$row['action_date'].';'.$row['buyer_name'].';'.$row['buyer_mobile'].';'.$row['buyer_email'].';'.$row['project_name'] . ';'.$row['site_visit'].';'.$row['buyer_knowledge'].';'.$row['buyer_interest'].';'.$row['followup_action'].';'.$row['dead_deal'].';';

            
                    if ($row['deal_closed'] == '0000-00-00'){
                        echo " ;" ; 
                        } else { echo $row['deal_closed'] . ';'; }


                    echo $row['name'].';'.$row['company_name'];

        }
        //$output .='</table>';
        
        //echo $output;
        
    }
    
    else {
        
    }
}
