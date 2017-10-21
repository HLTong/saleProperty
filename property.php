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
            url: "http://localhost/sale_property1/getPropertyDetails.php",
            data: "id=" + id,
            type: "GET",
            cache: false,
            dataType: "JSON",
            success: function (data) {
                $('[name=property_id]').val(data.property_id);
                $('[name=block]').val(data.block);
                $('[name=unit]').val(data.unit);
                $('[name=street]').val(data.street);
                $('[name=description]').val(data.description);
                $('[name=target_sale_price]').val(data.target_sale_price);
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
                url: "http://localhost/sale_property1/doEditProperty.php",
                type: "POST",
                data: $('#defaultForm2').serialize(),
                dataType: "JSON",
                success: function (data) {
                    $('#myModal2').modal('hide');
                    $('#defaultForm')[0].reset();
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
        var id = $('[name=property_id]').val();
        

                
        $.ajax({
            url: "http://localhost/sale_property1/deleteProperty.php",
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
        $takenNumber =0;
        $id = $_GET['property_id']; //this is actually project id!!!
        $projectName = $_GET['projectName'];
        include("navbar.php");
        include("dbFunctions.php");
        
        $querySelect = "SELECT * FROM property,project where project.project_id = property.project_id and project.project_id = " . $id;
        $resultSelect = mysqli_query($link, $querySelect) or die(mysqli_error($link));
        
        while ($rowSelect = mysqli_fetch_assoc($resultSelect))
            {
            $arrResult[]=$rowSelect;
            }
		
		$querySelect1 = "SELECT image FROM project where project.project_id = " . $id;
        $resultSelect1 = mysqli_query($link, $querySelect1) or die(mysqli_error($link));
        
        while ($rowSelect1 = mysqli_fetch_assoc($resultSelect1))
            {
            $arrResult1[]=$rowSelect1;
            }
		
        ?>
        
<div class="container">
  <h2><?php echo $projectName; ?>
      
      
         <?php if ($_SESSION['role']=="admin") { ?>
        <button style="float:right;" type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">Add New Property</button>
        <?php } ?>
  </h2><br><br>
    
                <div class="row">
                <div class="col-sm-5"><img width='90%' src="img/<?php echo $arrResult1[0]['image']; ?>" class="img-rounded"/></div>
                <div class="col-sm-7">
    
      
  
  <table class="table table-hover" id="defaultTable">
    <thead>
      <tr>
        <th>Property ID</th>
        <th>Block</th>
        <th>Street Name</th>
        <th>Unit Number</th>
        <th>Target Sale Price</th>
        <th>Status</th>
      </tr>
    </thead>
    
    <tbody> 
       <?php if (isset($arrResult)) { ?> 
           <?php for ($i=0 ; $i<count($arrResult); $i++){   ?> 
        <tr>
        <?php if ($arrResult[$i]['property_status'] == "Available") { ?>
        <td><a href="propertyDetails.php?propertyID=<?php echo $arrResult[$i]['property_id']; ?>&projectName=<?php echo $projectName; ?>&projectID=<?php echo $id; ?>"><?php echo $arrResult[$i]['property_id']; ?> </a></td>
        <?php } else { ?>
        <td> <?php echo $arrResult[$i]['property_id']; ?> </td>
        <?php } ?>
        
        <td> <?php echo $arrResult[$i]['block']; ?>  </td>
        <td> <?php echo $arrResult[$i]['street']; ?> </td>
        <td> #<?php echo $arrResult[$i]['unit']; ?> </td>
        <td> $<?php echo $arrResult[$i]['target_sale_price']; ?> </td>
        
        <?php if($arrResult[$i]['property_status'] == "Available"){?>
            <td style="color:green;"> <?php echo $arrResult[$i]['property_status']; ?> </td> 
        <?php }else{ ?>
            <td style="color:red;"> <?php echo $arrResult[$i]['property_status']; ?> </td> 
            <?php $takenNumber+=1; }?>
        
        <?php if ($_SESSION['role']=="admin") { ?>
        <td> <button  type="button" class="btn btn-info btn-sm" value="<?php echo $arrResult[$i]['property_id']; ?>" data-toggle="modal" data-target="#myModal2" ><img src="img/edit.png" width="20px"></button></td>
        <?php } ?>
        </tr> 
       <?php } }
       else{
       ?> 
    </tbody>
    <?php }  ?> 
</table>   
                </div>  </div>
           
<div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <center><h2 class="modal-title">Add Property information</h2></center>
        </div>
        <div class="modal-body">
           
                
            <form id="defaultForm" class="form-horizontal" role="form" action="addProperty.php" method="post" data-toggle="validator" enctype="multipart/form-data">
            
            <input type="hidden" name="project_id" value="<?php echo $id; ?>" >    
            <input type="hidden" name="project_name" value="<?php echo $projectName; ?>" > 
            
            <div class="form-group">
                <label class="control-label col-sm-3" for="block">Block:</label>
                <div class="col-sm-8">
                <input type="text" class="form-control" id="block" name="block"/>
                <div class="help-block with-errors"></div>
                </div>
            </div>
                
            <div class="form-group">
                <label class="control-label col-sm-3" for="unit">Unit:</label>
                <div class="col-sm-8">
                <input type="text" class="form-control" id="unit" name="unit" 
                       required data-error="unit is required"/>
                <div class="help-block with-errors"></div>
                </div>
            </div>
                
            <div class="form-group">
                <label class="control-label col-sm-3" for="street">Street Name:</label>
                <div class="col-sm-8">
                <input type="text" class="form-control" id="street" name="street" 
                       required data-error="Street is required"/>
                <div class="help-block with-errors"></div>
                </div>
            </div>

            
            <div class="form-group">
                <label class="control-label col-sm-3" for="target_sale_price">Target Price:</label>
                <div class="col-sm-8">
                <input type="text" class="form-control" id="target_sale_price" name="target_sale_price" 
                       required data-error="Target Sale Price is required"/>
                <div class="help-block with-errors"></div>
                </div>
            </div>
            
            <div class="form-group">
                <label class="control-label col-sm-3" for="description">Description:</label>
                <div class="col-sm-8"><textarea rows="6" cols="10" class="form-control" id="description" name="description"/></textarea>
                <div class="help-block with-errors"></div>
                </div>
            </div>
                
               <div class="form-group">
                <label class="control-label col-sm-3" for="idImage">Picture:</label>
                <div class="col-sm-8">
                <input type="file" name="image" id="idImage" required/>
                </div>
            </div>
              
            <br>
                <div class="modal-footer"> <button type="submit" class="btn btn-primary">Add Property</button>
                 <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          
        </div>  
            </form>
        </div>
      </div>
    </div>
</div>
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
      <div class="modal fade" id="myModal2" role="dialog" >
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <center><h2 class="modal-title">Edit Property information</h2></center>
        </div>
        <div class="modal-body">
            
                
            <form id="defaultForm2" class="form-horizontal" role="form" action="#" method="post" data-toggle="validator" >
            
            <input type="hidden" name="property_id" value="" >    
            
            <div class="form-group">
                <label class="control-label col-sm-3" for="block">Block:</label>
                <div class="col-sm-8">
                <input type="text" class="form-control" id="block" name="block"/>
                <div class="help-block with-errors"></div>
                </div>
            </div>
                
            <div class="form-group">
                <label class="control-label col-sm-3" for="unit">Unit:</label>
                <div class="col-sm-8">
                <input type="text" class="form-control" id="unit" name="unit" 
                       required data-error="unit is required"/>
                <div class="help-block with-errors"></div>
                </div>
            </div>
                
            <div class="form-group">
                <label class="control-label col-sm-3" for="street">Street Name:</label>
                <div class="col-sm-8">
                <input type="text" class="form-control" id="street" name="street" 
                       required data-error="Street is required"/>
                <div class="help-block with-errors"></div>
                </div>
            </div>

            
            <div class="form-group">
                <label class="control-label col-sm-3" for="target_sale_price">Target Price:</label>
                <div class="col-sm-8">
                <input type="text" class="form-control" id="target_sale_price" name="target_sale_price" 
                       required data-error="Target Sale Price is required"/>
                <div class="help-block with-errors"></div>
                </div>
            </div>
            
            <div class="form-group">
                <label class="control-label col-sm-3" for="description">Description:</label>
                <div class="col-sm-8"><textarea rows="6" cols="10" class="form-control" id="description" name="description"/></textarea>
                <div class="help-block with-errors"></div>
                </div>
            </div>

              
            <br>
                <div class="modal-footer"> <button type="submit" class="btn btn-primary">Edit Property</button>
                 <button type="button" name="deleteProject" class="btnDelete btn btn-danger">Delete Property</button>
           
        </div>  
            </form>
        </div>
      </div>
    </div>
</div>  
        
        
        
        
        
        
        
        
        
        
        
        
        
</body>
</html>