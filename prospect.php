<?php 
session_start();
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Sale Property</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="./css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <link href="./css/jquery-ui.min.css" rel="stylesheet" type="text/css"/>
        <script src="./js/jquery-1.11.1.min.js" type="text/javascript"></script>
        <script src="./js/bootstrap.min.js" type="text/javascript"></script>
        <script src="./js/validator.min.js" type="text/javascript"></script>
        <script src="./js/jquery.raty.min.js" type="text/javascript"></script>
        <script src="./js/jquery-ui.min.js" type="text/javascript"></script>
        <script src="./js/feedback.js" type="text/javascript"></script>
    <script>    
$(document).ready(function () {
    
$("#defaultTable").on("click", "td button", function () {
        var id = $(this).val();
        //alert(id);
        
        $.ajax({
            url: "./getProspectDetails.php",
            data: "id=" + id,
            type: "GET",
            cache: false,
            dataType: "JSON",
            success: function (data) {
                $('#defaultForm2 [name=prospect_id]').val(data.prospect_id);
                $('[name=action_date]').val(data.action_date);
                $('[name=buyer_name]').val(data.buyer_name);
                $('[name=buyer_mobile]').val(data.buyer_mobile);
                $('[name=buyer_email]').val(data.buyer_email);
                $('[name=project_name]').val(data.project_name);
                $('[name=site_visit]').val(data.site_visit);
                $('[name=buyer_knowledge]').val(data.buyer_knowledge);
                $('[name=buyer_interest]').val(data.buyer_interest);
                $('[name=followup_action]').val(data.followup_action);
                $('[name=dead_deal]').val(data.dead_deal);
                $('[name=deal_closed]').val(data.deal_closed);
                $('#myModal2').modal('show');  
                $('#defaultForm')[0].reset();
            },
            error: function (obj, textStatus, errorThrown) {
                console.log("Error " + textStatus + ": " + errorThrown);
            }
        });
    })

    
      $('#defaultForm2').validator().on('submit', function (e) {
        if (!e.isDefaultPrevented()) {
            e.preventDefault();
            $.ajax({
                url: "./doEditProspect.php",
                type: "POST",
                data: $('#defaultForm2').serialize(),
                dataType: "JSON",
                success: function (data) {
                    $('#myModal2').modal('hide');
                    location.reload();
                },
                error: function ()
                {
                    alert('Error adding data');
                }
            });
         }
    });



    $("#defaultForm2").on("click", ".btnDelete", function () {
        var id = $('[name=prospect_id]').val(); 
       //alert(id);
   
        $.ajax({
            url: "./deleteProspect.php",
            data: "id=" + id,
            type: "GET",
            cache: false,
            dataType: "JSON",
            success: function (data) {
                var r = confirm("confirm to delete?");
                if (r == true){
                    location.reload();
                }
                else {}

            },
            error: function (obj, textStatus, errorThrown) {
                console.log("Error " + textStatus + ": " + errorThrown);
            }
        
        });
    });
    
    
    
    
    })
    
    ;
    
       </script> 
    </head>
    
    <body>
        <?php
        include("navbar.php");
        include("dbFunctions.php");
        $arrResult = array();
        $arrResult2 = array();
         
        $querySelect = "SELECT * FROM prospect, project WHERE prospect.project_id = project.project_id AND agent_id = '{$_SESSION['agent_id']}'"; 
        $resultSelect = mysqli_query($link, $querySelect) or die(mysqli_error($link)); 
        while ($rowSelect = mysqli_fetch_assoc($resultSelect))
            {
                $arrResult[]=$rowSelect;
            }   
            
        $querySelect2 = "SELECT * FROM project, prospect, agent, company WHERE project.project_id = prospect.project_id AND prospect.agent_id = agent.agent_id AND agent.company_id = company.company_id  "; 
        $resultSelect2 = mysqli_query($link, $querySelect2) or die(mysqli_error($link)); 
        while ($rowSelect2 = mysqli_fetch_assoc($resultSelect2))
            {
                $arrResult2[]=$rowSelect2;
            }
        
        $querySelect3 = "SELECT * FROM project"; 
        $resultSelect3 = mysqli_query($link, $querySelect3) or die(mysqli_error($link)); 
        while ($rowSelect3 = mysqli_fetch_assoc($resultSelect3))
            {
                $arrResult3[]=$rowSelect3;
            }    
            
        ?>
        
<div class="container">
    
    <h2>Prospect
        
       <?php if ($_SESSION['role']=="agent") { ?>
        <button style="float:right;" type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">Add Prospect</button>
        <?php } ?></h2>
    
    <br><br>         
  
                    <table class="table table-hover" id="defaultTable">
                    
                    <?php if ($_SESSION['role']=="admin") {  ?> 
                    <thead>
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
                    </thead>
                    
                    <?php } else { ?>
                    
                     <thead>
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
                        </tr>
                    </thead>
                    
                    <?php } ?>
    
    <tbody>
                        <?php 
                        if ($_SESSION['role']=="agent") {
                             
                        for ($i=0 ; $i<count($arrResult); $i++){   ?>
                        <tr>
                        <td> <?php echo $arrResult[$i]['prospect_id']; ?> </td>
                        <td> <?php echo $arrResult[$i]['action_date']; ?></td>
                        <td> <?php echo $arrResult[$i]['buyer_name']; ?> </td>
                        <td> <?php echo $arrResult[$i]['buyer_mobile']; ?> </td>
                        <td> <?php echo $arrResult[$i]['buyer_email']; ?> </td>
                        <td> <?php echo $arrResult[$i]['project_name']; ?> </td>
                        <td> <?php echo $arrResult[$i]['site_visit']; ?> </td>
                        <td> <?php echo $arrResult[$i]['buyer_knowledge']; ?> </td>
                        <td> <?php echo $arrResult[$i]['buyer_interest']; ?> </td>
                        <td> <?php echo $arrResult[$i]['followup_action']; ?> </td>
                        <td> <?php echo $arrResult[$i]['dead_deal']; ?> </td>
                        
                        <td> <?php 
                        if ($arrResult[$i]['deal_closed'] == "0000-00-00"){
                        echo " " ; 
                        } else { echo $arrResult[$i]['deal_closed']; 
                        } ?> </td>
                        <td> <button  type="button" id="EditButton" class="btn btn-info btn-sm" value="<?php echo $arrResult[$i]['prospect_id']; ?>" data-toggle="modal" data-target="#myModal2" ><img src="img/edit.png" width="20px"></button></td>
                        
                        
                        </tr>
                        <?php }}
                            
                        else {
                                 
                        for ($i=0 ; $i<count($arrResult2); $i++){   ?>
                        <tr>
                            
                        <td> <?php echo $arrResult2[$i]['prospect_id']; ?> </td>
                        <td> <?php echo $arrResult2[$i]['action_date']; ?></td>
                        <td> <?php echo $arrResult2[$i]['buyer_name']; ?> </td>
                        <td> <?php echo $arrResult2[$i]['buyer_mobile']; ?> </td>
                        <td> <?php echo $arrResult2[$i]['buyer_email']; ?> </td>
                        <td> <?php echo $arrResult2[$i]['project_name']; ?> </td>
                        <td> <?php echo $arrResult2[$i]['site_visit']; ?> </td>
                        <td> <?php echo $arrResult2[$i]['buyer_knowledge']; ?> </td>
                        <td> <?php echo $arrResult2[$i]['buyer_interest']; ?> </td>
                        <td> <?php echo $arrResult2[$i]['followup_action']; ?> </td>
                        <td> <?php echo $arrResult2[$i]['dead_deal']; ?> </td>
                        
                        <td> <?php 
                        if ($arrResult2[$i]['deal_closed'] == "0000-00-00"){
                        echo " " ; 
                        } else { echo $arrResult2[$i]['deal_closed']; 
                        } ?> </td>
                        
                        <td> <?php echo $arrResult2[$i]['name']; ?> </td>
                        <td> <?php echo $arrResult2[$i]['company_name']; ?> </td>
 
                        <?php  
                        }}
                        ?>
                    </tbody>

  </table>
    
     <?php if ($_SESSION['role']=="admin") { ?>
        <div class = "table responsive">
            <div id ="live_data"></div>
            <form action ="excel.php" method="post">
                <p align="right"> 
                    <?php if ($arrResult2 == null) { ?>
                    <input type ="submit" name="export_excel" class="btn btn-success" disabled='true' value="Export to Excel"/>  
                    <?php } else { ?>
                    <input type ="submit" name="export_excel" class="btn btn-success" value="Export to Excel"/>
                    <?php } ?>
                </p>
            </form>  
        </div>
    <?php } ?>
</div>
        
        
        <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <center><h2 class="modal-title">Add Prospect</h2></center>
        </div>
        <div class="modal-body">
          
                
            <form id="defaultForm" class="form-horizontal" role="form" action="addProspect.php" method="post" data-toggle="validator">
                
                <div class="form-group">
                    <label class="control-label col-sm-3" for="action_date">Date of Visit/Call:</label>
                    <div class="col-sm-8">
                        <input type="date" class="form-control" id="action_date" name="action_date" 
                        required data-error="Date is required"/>
                        <div class="help-block with-errors"></div>
                    </div>
                </div>
                
                <br>
                
                <div class="form-group">
                    <label class="control-label col-sm-3">Project Name:</label>
                    <div class="col-sm-8" name="project_name">
                        
                    <select class="form-control" id="project_name" name="project_name" required>
                        <option value="">-- Please Select --</option>
                       <?php for ($i=0 ; $i<count($arrResult3); $i++){   ?>
                            <option value="<?php echo $arrResult3[$i]['project_id']; ?>"> 
                                <?php echo $arrResult3[$i]['project_name']; ?> </option>
                            <?php } ?>
                    </select>
                        <div class="help-block with-errors"></div>
                    </div>
                </div>
                
                <br>
                
                <div class="form-group">
                    <label class="control-label col-sm-3" for="buyer_name">Name of Buyer:</label>
                    <div class="col-sm-8">
                    <input type="text" class="form-control" id="buyer_name" name="buyer_name" 
                       required data-error="Username is required"/>
                    <div class="help-block with-errors"></div>
                    </div>
                </div>
                
                <br>
                
                <div class="form-group">
                    <label class="control-label col-sm-3" for="buyer_mobile">Contact Number:</label>
                    <div class="col-sm-8"> 
                        <input type="text" class="form-control" id="buyer_mobile" name="buyer_mobile"  
                               requried required data-error="Mobile number is required">
                        <div class="help-block with-errors"></div>
                    </div>
                </div>
                
                <br>
                
                <div class="form-group">
                    <label class="control-label col-sm-3" for="buyer_email">Email Address:</label>
                    <div class="col-sm-8"> 
                        <input type="text" class="form-control" id="buyer_email" name="buyer_email"  
                        <div class="help-block with-errors"></div>
                </div>
                
                <br>
                
                <div class="form-group">
                    <label class="control-label col-sm-3">Site Visit:</label>
                    <div class="col-sm-8" name="site_visit">
                        
                        <select class="form-control" id="site_visit" name="site_visit">
                        <option value="">-- Please Select --</option>
                        <option value="Yes">Yes</option>
                        <option value="No">No</option>
                    </select>
                        <div class="help-block with-errors"></div>
                    </div>
                </div>
                
                <br> 
                
                <div class="form-group">
                    <label class="control-label col-sm-3" for="buyer_knowledge">Buyer's Knowledge:</label>
                    <div class="col-sm-8"> 
                        <input type="text" class="form-control" id="buyer_knowledge" name="buyer_knowledge"/>
                        <div class="help-block with-errors"></div>
                    </div>
                </div>
                
                <br>
                
                <div class="form-group">
                    <label class="control-label col-sm-3" for="buyer_interest">Buyer's Interest & Rejection:</label>
                    <div class="col-sm-8"> 
                        <input type="text" class="form-control" id="buyer_interest" name="buyer_interest"/>
                        <div class="help-block with-errors"></div>
                    </div>
                </div>
                
                <br>
                
                <div class="form-group">
                    <label class="control-label col-sm-3" for="followup_action">Follow-up Actions:</label>
                    <div class="col-sm-8"> 
                        <input type="text" class="form-control" id="followup_action" name="followup_action"/>
                        <div class="help-block with-errors"></div>
                    </div>
                </div>
                
                <br>
                
                <div class="form-group">
                    <label class="control-label col-sm-3">Dead Deal:</label>
                    <div class="col-sm-8" name="dead_deal">
                        
                    <select class="form-control" id="dead_deal" name="dead_deal">
                        <option value="">-- Please Select --</option>
                        <option value="Yes">Yes</option>
                        <option value="No">No</option>
                    </select>
                        <div class="help-block with-errors"></div>
                    </div>
                </div>
                
                <br>
                
                <div class="form-group">
                    <label class="control-label col-sm-3" for="deal_closed">Deal Closed:</label>
                    <div class="col-sm-8">
                        <input type="date" class="form-control" id="deal_closed" name="deal_closed"/>
                        <div class="help-block with-errors"></div>
                    </div>
                </div>

                <br>
                
                        <div class="modal-footer"> <button type="submit" class="btn btn-primary">Add Prospect</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
           </form>
        </div>
      </div> 
    </div>
</div> 
        
                
    <div class="modal fade" id="myModal2" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <center><h2 class="modal-title">Edit Prospect information</h2></center>
        </div>
        <div class="modal-body">
            <p>
                
            <form id="defaultForm2" class="form-horizontal" role="form" action="#" method="post" data-toggle="validator">
                
                <input type="hidden" name="prospect_id" value=""> 
                
                <div class="form-group">
                    <label class="control-label col-sm-3" for="action_date">Date of Visit/Call:</label>
                    <div class="col-sm-8">
                        <input type="date" class="form-control" id="action_date" name="action_date" readonly>
                        <div class="help-block with-errors"></div>
                    </div>
                </div>
                
                <br>
                
                <div class="form-group">
                    <label class="control-label col-sm-3" for="project_name">Project Name:</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="project_name" name="project_name" readonly>
                    <div class="help-block with-errors"></div>
                    </div>
                </div>
                
                <br>
                
                <div class="form-group">
                    <label class="control-label col-sm-3" for="buyer_name">Name of Buyer:</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="buyer_name" name="buyer_name" readonly>
                    <div class="help-block with-errors"></div>
                    </div>
                </div>
                
                <br>
                
                <div class="form-group">
                    <label class="control-label col-sm-3" for="buyer_mobile">Contact Number:</label>
                    <div class="col-sm-8"> 
                        <input type="text" class="form-control" id="buyer_mobile" name="buyer_mobile"  
                               requried required data-error="Mobile number is required">
                        <div class="help-block with-errors"></div>
                    </div>
                </div>
                
                <br>
                
                <div class="form-group">
                    <label class="control-label col-sm-3" for="buyer_email">Email Address:</label>
                    <div class="col-sm-8"> 
                        <input type="text" class="form-control" id="buyer_email" name="buyer_email"  
                        <div class="help-block with-errors"></div>
                </div>
                    
                <br>
                
                <div class="form-group">
                    <label class="control-label col-sm-3">Site Visit:</label>
                    <div class="col-sm-8" name="site_visit">
                        
                    <select class="form-control" id="site_visit" name="site_visit"/>
                        
                        <option value="">-- Please Select --</option>
                        <option value="Yes">Yes</option>
                        <option value="No">No</option>
                    </select>
                        <div class="help-block with-errors"></div>
                    </div>
                </div>
                
                <br> 
                
                <div class="form-group">
                    <label class="control-label col-sm-3" for="buyer_knowledge">Buyer's Knowledge:</label>
                    <div class="col-sm-8"> 
                        <input type="text" class="form-control" id="buyer_knowledge" name="buyer_knowledge"/>
                        <div class="help-block with-errors"></div>
                    </div>
                </div>
                
                <br>
                
                <div class="form-group">
                    <label class="control-label col-sm-3" for="buyer_interest">Buyer's Interest & Rejection:</label>
                    <div class="col-sm-8"> 
                        <input type="text" class="form-control" id="buyer_interest" name="buyer_interest"/>
                        <div class="help-block with-errors"></div>
                    </div>
                </div>
                
                <br>
                
                <div class="form-group">
                    <label class="control-label col-sm-3" for="followup_action">Follow-up Actions:</label>
                    <div class="col-sm-8"> 
                        <input type="text" class="form-control" id="followup_action" name="followup_action"/>
                        <div class="help-block with-errors"></div>
                    </div>
                </div>
                
                <br>
                
                <div class="form-group">
                    <label class="control-label col-sm-3">Dead Deal:</label>
                    <div class="col-sm-8" name="dead_deal">
                        
                    <select class="form-control" id="dead_deal" name="dead_deal"/>
                        <option value="">-- Please Select --</option>
                        <option value="Yes">Yes</option>
                        <option value="No">No</option>
                    </select>
                        <div class="help-block with-errors"></div>
                    </div>
                </div>
                
                <br>
                
                <div class="form-group">
                    <label class="control-label col-sm-3" for="deal_closed">Deal Closed:</label>
                    <div class="col-sm-8">
                        <input type="date" class="form-control" id="deal_closed" name="deal_closed"/>
                        <div class="help-block with-errors"></div>
                    </div>
                </div>

            <br>
              
  <div class="modal-footer"> 
            <button type="submit"  class="btn btn-primary">Edit Prospect</button>
            <button type="button" name="deleteProject" class="btnDelete btn btn-danger">Delete Prospect</button>
        </div> </form>

      </div> 
    </div>
    </div>
        </div> 
    </body>
</html>