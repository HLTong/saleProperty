<?php 
session_start();
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Sale Property</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <link href="css/jquery-ui.min.css" rel="stylesheet" type="text/css"/>
        <script src="js/jquery-1.11.1.min.js" type="text/javascript"></script>
        <script src="js/bootstrap.min.js" type="text/javascript"></script>
        <script src="js/validator.min.js" type="text/javascript"></script>
        <script src="js/jquery.raty.min.js" type="text/javascript"></script>
        <script src="js/jquery-ui.min.js" type="text/javascript"></script>
        <script src="js/feedback.js" type="text/javascript"></script>
    <script>    
$(document).ready(function () {
    
$("#defaultTable").on("click", "td button", function () {
        var id = $(this).val();
        $.ajax({
            url: "http://localhost/sale_property1/getProspectDetails.php",
            data: "id=" + id,
            type: "GET",
            cache: false,
            dataType: "JSON",
            success: function (data) {
                $('[name=prospect_id]').val(data.prospect_id);
                $('[name=actionDate]').val(data.action_date);
                $('[name=buyer]').val(data.buyer_name);
                $('[name=mobile]').val(data.buyer_mobile);
                $('[name=projectName]').val(data.project_name);
                $('[name=site]').val(data.site_visit);
                $('[name=knowledge]').val(data.buyer_knowledge);
                $('[name=interest]').val(data.buyer_interest);
                $('[name=followUp]').val(data.followup_action);
                $('[name=deal]').val(data.dead_deal);
                $('[name=dealclosed]').val(data.deal_closed);
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
                url: "http://localhost/sale_property1/doEditProspect.php",
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
        

                
        $.ajax({
            url: "http://localhost/sale_property1/deleteProspect.php",
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
         
        $querySelect = "SELECT * FROM prospect WHERE agent_id = '{$_SESSION['agent_id']}'"; 
        $resultSelect = mysqli_query($link, $querySelect) or die(mysqli_error($link)); 
        while ($rowSelect = mysqli_fetch_assoc($resultSelect))
            {
                $arrResult[]=$rowSelect;
            }   
            
        $querySelect2 = "SELECT * FROM prospect, agent, company WHERE agent.agent_id = prospect.agent_id AND agent.company_id = company.company_id  "; 
        $resultSelect2 = mysqli_query($link, $querySelect2) or die(mysqli_error($link)); 
        while ($rowSelect2 = mysqli_fetch_assoc($resultSelect2))
            {
                $arrResult2[]=$rowSelect2;
            }
        ?>
        
<div class="container">
    
    <h2>Prospect
        
       <?php if ($_SESSION['role']=="agent") { ?>
        <button style="float:right;" type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">Add Prospect</button>
        <?php } ?></h2>
    
    <br><br>         
  
                    <table class="table table-hover">
                    
                    <?php if ($_SESSION['role']=="admin") {  ?> 
                    <thead>
                    <tr>
                        <th>Prospect ID:</th>
                        <th>Date Call/Visit:</th>
                        <th>Buyer's Name:</th> 
                        <th>Contact No:</th>
                        <th>Project Name:</th>
                        <th>Site Visit:</th>
                        <th>Knowledge:</th>
                        <th>Interest:</th>
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
                         <th>Project Name:</th>
                        <th>Site Visit:</th>
                        <th>Knowledge:</th>
                        <th>Interest:</th>
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
       <?php $x =0;?>
                        <tr>
                        <td> <?php echo $arrResult[$i]['prospect_id']; ?> </td>
                        <td> <?php echo $arrResult[$i]['action_date']; ?></td>
                        <td> <?php echo $arrResult[$i]['buyer_name']; ?> </td>
                        <td> <?php echo $arrResult[$i]['buyer_mobile']; ?> </td>
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
                        <?php
                               $x = $i?>
                        <td> <button  type="button" class="btn btn-info btn-sm" value="<?php echo $arrResult[$i]['prospect_id']; ?>" data-toggle="modal" data-target="#myModal2" ><img src="img/edit.png" width="20px"></button></td>
                        
                        
                        </tr>
                        <?php }}
                            
                        else {
                                 
                        for ($i=0 ; $i<count($arrResult2); $i++){   ?>
                        <tr>
                            
                        <td> <?php echo $arrResult2[$i]['prospect_id']; ?> </td>
                        <td> <?php echo $arrResult2[$i]['action_date']; ?></td>
                        <td> <?php echo $arrResult2[$i]['buyer_name']; ?> </td>
                        <td> <?php echo $arrResult2[$i]['buyer_mobile']; ?> </td>
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
                    <label class="control-label col-sm-3" for="actionDate">Date of Visit/Call:</label>
                    <div class="col-sm-8">
                        <input type="date" class="form-control" id="actionDate" name="actionDate" 
                        required data-error="Date is required"/>
                        <div class="help-block with-errors"></div>
                    </div>
                </div>
                
                <br>
                
                <div class="form-group">
                    <label class="control-label col-sm-3">Project Name:</label>
                    <div class="col-sm-8" name="projectName">
                        
                    <select class="form-control" id="projectName" name="projectName" required>
                        <option value="">-- Please Select --</option>
                        <option value="ABC">ABC</option>
                        <option value="DEF">DEF</option>
                    </select>
                        <div class="help-block with-errors"></div>
                    </div>
                </div>
                
                <br>
                
                <div class="form-group">
                    <label class="control-label col-sm-3" for="buyer">Name of Buyer:</label>
                    <div class="col-sm-8">
                    <input type="text" class="form-control" id="buyer" name="buyer" 
                       required data-error="Username is required"/>
                    <div class="help-block with-errors"></div>
                    </div>
                </div>
                
                <br>
                
                <div class="form-group">
                    <label class="control-label col-sm-3" for="mobile">Contact Number:</label>
                    <div class="col-sm-8"> 
                        <input type="text" class="form-control" id="mobile" name="mobile"  
                               requried required data-error="Mobile number is required"/>
                        <div class="help-block with-errors"></div>
                    </div>
                </div>
                
                <br>
                
                <div class="form-group">
                    <label class="control-label col-sm-3">Site Visit:</label>
                    <div class="col-sm-8" name="site">
                        
                    <select class="form-control" id="site" name="site">
                        <option value="">-- Please Select --</option>
                        <option value="Yes">Yes</option>
                        <option value="No">No</option>
                    </select>
                        <div class="help-block with-errors"></div>
                    </div>
                </div>
                
                <br> 
                
                <div class="form-group">
                    <label class="control-label col-sm-3" for="knowledge">Buyer's Knowledge:</label>
                    <div class="col-sm-8"> 
                        <input type="text" class="form-control" id="knowledge" name="knowledge"/>
                        <div class="help-block with-errors"></div>
                    </div>
                </div>
                
                <br>
                
                <div class="form-group">
                    <label class="control-label col-sm-3" for="interest">Buyer's Interest & Rejection:</label>
                    <div class="col-sm-8"> 
                        <input type="text" class="form-control" id="interest" name="interest"/>
                        <div class="help-block with-errors"></div>
                    </div>
                </div>
                
                <br>
                
                <div class="form-group">
                    <label class="control-label col-sm-3" for="followUp">Follow-up Actions:</label>
                    <div class="col-sm-8"> 
                        <input type="text" class="form-control" id="followUp" name="followUp"/>
                        <div class="help-block with-errors"></div>
                    </div>
                </div>
                
                <br>
                
                <div class="form-group">
                    <label class="control-label col-sm-3">Dead Deal:</label>
                    <div class="col-sm-8" name="deal">
                        
                    <select class="form-control" id="deal" name="deal">
                        <option value="">-- Please Select --</option>
                        <option value="Yes">Yes</option>
                        <option value="No">No</option>
                    </select>
                        <div class="help-block with-errors"></div>
                    </div>
                </div>
                
                <br>
                
                <div class="form-group">
                    <label class="control-label col-sm-3" for="dealClosed">Deal Closed:</label>
                    <div class="col-sm-8">
                        <input type="date" class="form-control" id="dealClosed" name="dealClosed"/>
                        <div class="help-block with-errors"></div>
                    </div>
                </div>

                <br>
                
                <div class="form-group"> 
                    <div class="col-sm-offset-3 col-sm-8">
                        <button type="submit" class="btn btn-primary">Add Prospect</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
        </div>
        </form>
      </div> 
    </div>
</div> 
        </div>
        
                
        <div class="modal fade" id="myModal2" role="dialog">
<?php 


?>
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
                
                <input type="hidden" class="form-control" id="prospect_id" name="prospect_id" value=""> 
                
                
                <div class="form-group">
                    <label class="control-label col-sm-3" for="actionDate">Date of Visit/Call:</label>
                    <div class="col-sm-8">
                        <input type="date" class="form-control" id="actionDate" name="actionDate" 
                        required data-error="Date is required" value="<?php echo $arrResult2[$x]['action_date']; ?>">
                        <div class="help-block with-errors"></div>
                    </div>
                </div>
                
                <br>
                
                <div class="form-group">
                    <label class="control-label col-sm-3">Project Name:</label>
                    <div class="col-sm-8" name="projectName">
                        
                    <select class="form-control" id="projectName" name="projectName" required>
                        <option value="">-- Please Select --</option>
                        <option value=" <?php echo $arrResult2[0]['project_name']; ?>"> <?php echo $arrResult2[0]['project_name']; ?></option>
                        <option value="DEF">DEF</option>
                    </select>
                        <div class="help-block with-errors"></div>
                    </div>
                </div>
                
                <br>
                
                <div class="form-group">
                    <label class="control-label col-sm-3" for="buyer">Name of Buyer:</label>
                    <div class="col-sm-8">
                    <input type="text" class="form-control" id="buyer" name="buyer" 
                       required data-error="Username is required" value="<?php echo $arrResult2[0]['buyer_name']; ?>">
                    <div class="help-block with-errors"></div>
                    </div>
                </div>
                
                <br>
                
                <div class="form-group">
                    <label class="control-label col-sm-3" for="mobile">Contact Number:</label>
                    <div class="col-sm-8"> 
                        <input type="text" class="form-control" id="mobile" name="mobile"  
                               requried required data-error="Mobile number is required" value="<?php echo $arrResult2[0]['buyer_mobile']; ?>">
                        <div class="help-block with-errors"></div>
                    </div>
                </div>
                
                <br>
                
                <div class="form-group">
                    <label class="control-label col-sm-3">Site Visit:</label>
                    <div class="col-sm-8" name="site">
                        
                    <select class="form-control" id="site" name="site">
                        
                        <option value="<?php echo $arrResult[0]['site_visit']; ?>">-- Please Select --</option>
                        <option value="Yes">Yes</option>
                        <option value="No">No</option>
                    </select>
                        <div class="help-block with-errors"></div>
                    </div>
                </div>
                
                <br> 
                
                <div class="form-group">
                    <label class="control-label col-sm-3" for="knowledge">Buyer's Knowledge:</label>
                    <div class="col-sm-8"> 
                        <input type="text" class="form-control" id="knowledge" name="knowledge" value="<?php echo $arrResult[0]['buyer_knowledge']; ?>">
                        <div class="help-block with-errors"></div>
                    </div>
                </div>
                
                <br>
                
                <div class="form-group">
                    <label class="control-label col-sm-3" for="interest">Buyer's Interest & Rejection:</label>
                    <div class="col-sm-8"> 
                        <input type="text" class="form-control" id="interest" name="interest" value="<?php echo $arrResult[0]['buyer_interest']; ?>">
                        <div class="help-block with-errors"></div>
                    </div>
                </div>
                
                <br>
                
                <div class="form-group">
                    <label class="control-label col-sm-3" for="followUp">Follow-up Actions:</label>
                    <div class="col-sm-8"> 
                        <input type="text" class="form-control" id="followUp" name="followUp" value="<?php echo $arrResult[0]['followup_action']; ?>">
                        <div class="help-block with-errors"></div>
                    </div>
                </div>
                
                <br>
                
                <div class="form-group">
                    <label class="control-label col-sm-3">Dead Deal:</label>
                    <div class="col-sm-8" name="deal">
                        
                    <select class="form-control" id="deal" name="deal">
                        <option value="">-- Please Select --</option>
                        <option value="Yes">Yes</option>
                        <option value="No">No</option>
                    </select>
                        <div class="help-block with-errors"></div>
                    </div>
                </div>
                
                <br>
                
                <div class="form-group">
                    <label class="control-label col-sm-3" for="dealClosed">Deal Closed:</label>
                    <div class="col-sm-8">
                        <input type="date" class="form-control" id="dealClosed" name="dealClosed"/>
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