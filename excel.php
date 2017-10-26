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
        $output .= "
            <table class = 'table table-bordered' bordered='1'>
                <tr>
                    <th>Prospect ID:</th>
                    <th>Date Call/Visit:</th>
                    <th>Buyer's Name:</th> 
                    <th>Contact No:</th>
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
        ";
        
        while($row= mysqli_fetch_array($result))
        {
            $output .= "
                <tr>
                    <td> $row[prospect_id] </td>
                    <td> $row[action_date] </td>
                    <td> $row[buyer_name] </td>
                    <td> $row[buyer_mobile] </td>
                    <td> $row[project_name] </td>
                    <td> $row[site_visit] </td>
                    <td> $row[buyer_knowledge] </td>
                    <td> $row[buyer_interest] </td>
                    <td> $row[followup_action] </td>
                    <td> $row[dead_deal] </td>
                        

                     
                    <td> <?php if $row[deal_closed] == '0000-00-00'){
                        echo ' ' ; 
                        } else { echo $row[deal_closed] ?></td>


                    <td> $row[name] </td>
                    <td> $row[company_name] </td>
                </tr>
            ";
        }
        $output .='</table>';
        header("Content-Type: application/xls");
        header("Content-Disposition:attachment; filename=Prospect.xls");
        echo $output;
        
    }
    
    else {
        
    }
}
