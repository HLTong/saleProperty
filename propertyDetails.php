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
            url: "./getConstructionDetails.php",
            data: "id=" + id,
            type: "GET",
            cache: false,
            dataType: "JSON",
            success: function (data) {
                $('#defaultForm2 [name=construction_id]').val(data.construction_id);
                $('[name=construction_status]').val(data.construction_status);
                $('[name=latest_handover]').val(data.latest_handover);
                $('[name=latest_construct_complete]').val(data.latest_construct_complete);
                $('[name=expect_handover]').val(data.expect_handover);
                $('[name=expect_construct_complete]').val(data.expect_construct_complete);
                $('#myModal3').modal('show');  
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
                url: "http://localhost/sale_property1/doEditConstruction.php",
                type: "POST",
                data: $('#defaultForm2').serialize(),
                dataType: "JSON",
                success: function (data) {
                    $('#myModal3').modal('hide');
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
        var id = $('[name=construction_id]').val(); 
       //alert(id);
   
        $.ajax({
            url: "./deleteConstruction.php",
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
    
function paymentOnchange(){
    var pay_type = document.getElementById('payment_type').value 
    if(pay_type == "Other")
        document.getElementById("new_textbox").style.display="block";
    else
        document.getElementById("new_textbox").style.display="none";
}
 </script>
        
        
        

    </head>
    
    <body>
        <?php
        $projectID = $_GET['projectID'];
        $projectName = $_GET['projectName'];
        $propertyID = $_GET['propertyID'];
        include("navbar.php");
        include("dbFunctions.php");
        $arrResult2 = array();
        
        $querySelect = "SELECT * FROM property where property_id = " . $propertyID;
        $resultSelect = mysqli_query($link, $querySelect) or die(mysqli_error($link));   
        
        $querySelect2 = "SELECT * FROM construction where property_id = " . $propertyID; 
        $resultSelect2 = mysqli_query($link, $querySelect2) or die(mysqli_error($link)); 
        while ($rowSelect2 = mysqli_fetch_assoc($resultSelect2))
            {
                $arrResult2[]=$rowSelect2;
            }   
        
        
        ?>
        

        <div class="container">
            <?php 
              while ($rowSelect=mysqli_fetch_assoc($resultSelect)){
                    $property = $rowSelect['property_id'];
                    $block = $rowSelect['block']; 
                    $street = $rowSelect['street']; 
                    $unit = $rowSelect['unit'];
                    $status = $rowSelect['property_status'];
                    $target_price = $rowSelect['target_sale_price'];
                    $actual_price = $rowSelect['actual_sale_price'];
                    $description = $rowSelect['description'];
            ?>
            
            <h3><?php echo $projectName . ": " .$street; ?></h3><br><br>
            <div class="row">
                <div class="col-sm-5"><img width='90%' src="img/<?php echo $rowSelect['property_image']; ?>" class="img-rounded"/></div>
                <div class="col-sm-7">
  
                    
                    
  <ul class="nav nav-tabs">
    <li class="active"><a data-toggle="tab" href="#home">Property Details</a></li>
    <li><a data-toggle="tab" href="#menu1">Property Documentation</a></li>
    <li><a data-toggle="tab" href="#menu2">Property Pricing</a></li>
    
    <?php if ($_SESSION['role'] == "admin") { ?>
    <li><a data-toggle="tab" href="#menu3">Construction</a></li>
    <?php } ?>
  </ul>

  <div class="tab-content">
    <div id="home" class="tab-pane fade in active">
        <h3>Property Details:</h3>
      <p>

          <br>
          <span class="glyphicon glyphicon-cloud"></span> <b>Project Name:</b> <?php echo $projectName ?><br><br>
          <?php if ($block != '') { ?>
          <span class="glyphicon glyphicon-cloud"></span> <b>Block:</b> <?php echo $block ?><br><br>
          <?php } ?>
         
          <span class="glyphicon glyphicon-cloud"></span> <b>Street:</b> <?php echo $street ?><br><br>
          <span class="glyphicon glyphicon-cloud"></span> <b>Unit No:</b> <?php echo $unit ?><br/><br/><br>
      
      <?php if ($description != '') { ?>    
      <h4><?php echo "Description:" ?></h4>
      <?php echo $description; ?>
      <?php } ?>
      </p>
    </div>
      
    <div id="menu1" class="tab-pane fade">
        <h3>Property Documentation</h3>
        
        <br>Agent to upload Buyer's ID
        <br>Agent to upload Buyer's Booking Transaction Receipt
        <p>
        <br>
        <?php if ($_SESSION['role'] == "agent") { ?>
        <button type="button" style="float:right" class="btn btn-info btn-sm" data-toggle="modal" data-target="#myModal">Upload Document</button><br><br>
        <?php } ?>
        <table class="table table-bordered">
        <thead>
        <tr>
            <th>Document Title </th>
            <th>Creation Date</th>
            <th>File</th>

                
           
        </tr>
        </thead>
        
<?php  
include("dbFunctions.php");

$queryDocument = "SELECT * FROM document where property_id= " .$propertyID ;
$resultDocument = mysqli_query($link, $queryDocument) or die(mysqli_error($link));

$howmany=mysqli_affected_rows($link);
?>        
    <tbody>
      
  <?php for ($i=0 ; $i<$howmany; $i++){ 
         $arrResultDocument=  mysqli_fetch_array($resultDocument);?>
        <tr><td><?php echo $arrResultDocument['title']; ?></td>
        <td><?php echo $arrResultDocument['creation_date']; ?></td>
        <td><a href="file\<?php echo $arrResultDocument['url']; ?>" download>  <img src="./img/file.jpg" width='15%' class="img-rounded"/>  </a></td>
         </tr>
  <?php } ?>
     
    </tbody>
  </table>
        
        <br>
        
        
    </div>
      
      
    <div id="menu2" class="tab-pane fade">
        <h3>Sale Price</h3>
       
        <blockquote class="blockquote blockquote-reverse">
            
            <h3 class="mb-0"><span class="glyphicon glyphicon-cloud"></span> Target Sale price: $ <?php echo $target_price ?></h3>
            <?php if ($_SESSION['role']=="admin") { ?>
            <footer class="blockquote-footer"><span class="glyphicon glyphicon-cloud"></span> Sale price: $ <?php echo $actual_price ?></footer>
            <?php } ?>
        
        </blockquote>
        
        <?php if ($_SESSION['role']=="agent") { ?>

        <form id="defaultForm" class="form-horizontal" role="form" action="./doPropertyDetails.php" method="post" data-toggle="validator">
               
            <input type="hidden" class="form-control" id="property_id" name="property_id" value="<?php echo $propertyID; ?>"> 
     
 

                
    
                
    <br>
    
<div class="form-group">
                <label class="control-label col-sm-3" for="actual_sale_price">Offer Price:</label>
                <div class="col-sm-9">
                <input type="text" class="form-control" id="actual_sale_price" name="actual_sale_price" 
                       required data-error="Offer Price is required"/>
                <div class="help-block with-errors"></div>
                </div>
            </div>
        
                    <div class="form-group">
                <label class="control-label col-sm-3">Payment Type:</label>
                <div class="col-sm-9" name="payment_type">
                        
                    <select class="form-control" id="payment_type" name="payment_type" onChange="paymentOnchange();" required>
                        <option value="">--Please Select--</option>
                        <option value="loan">Loan</option>
                        <option value="cash">Cash</option>
                        <option>Other</option>
                    </select>
                        <div class="help-block with-errors"></div>
                </div>
            </div>
    
    <div class="form-group">
                <label class="control-label col-sm-3" for="new_textbox">If Others, Please Specify:</label>
                <div class="col-sm-9">
               <input type="text" name="new_textbox" id="new_textbox" style="display:none;">
                <div class="help-block with-errors"></div>
                </div>
            </div>
    
    <div class="form-group">
                <label class="control-label col-sm-3" for="promotion">Promotion:</label>
                <div class="col-sm-9">
                <input type="text" class="form-control" id="promotion" name="promotion"/>
                <div class="help-block with-errors"></div>
                </div>
            </div>
    
    
                       
 
    
    <br>


 
   
    <div class="form-group"> 
        <div class="col-sm-offset-3 col-sm-10">
            <button type="submit" class="btn btn-primary">Add Activity</button>
        </div>
    </div>
        </form>
        <?php } ?>
    </div>
      
      
    <div id="menu3" class="tab-pane fade">
    <h3>Construction Status
    <?php if ($_SESSION['role']=="admin") { ?>
        <?php if ($arrResult2 != null) { ?>
            <button style="float:right;" type="button" class="btn btn-info btn-md" data-toggle="modal" data-target="#myModal2" disabled='true'>Add Construction Details</button>
        <?php } else { ?>
            <button style="float:right;" type="button" class="btn btn-info btn-md" data-toggle="modal" data-target="#myModal2">Add Construction Details</button>
    <?php }} ?></h3>
        
        <br><br> 
        <table class="table table-hover" id="defaultTable">
            <thead>
                <tr>
                    <th>Construction Status:</th>
                    <th>Latest Handover Date:</th>
                    <th>Latest Construction Complete:</th>
                    <th>Expected Handover Date:</th>
                    <th>Expected Construction Complete:</th>
                </tr>
            </thead>
            
            <tbody>
                 <?php for ($i=0 ; $i<count($arrResult2); $i++){   ?>
                        <tr>
                        <td> <?php echo $arrResult2[$i]['construction_status']; ?></td>
                        
                        <td> <?php 
                        if ($arrResult2[$i]['latest_handover'] == "0000-00-00"){
                        echo "-" ; 
                        } else { echo $arrResult2[$i]['latest_handover']; 
                        } ?> </td>
                        
                        <td> <?php 
                        if ($arrResult2[$i]['latest_construct_complete'] == "0000-00-00"){
                        echo "-" ; 
                        } else { echo $arrResult2[$i]['latest_construct_complete']; 
                        } ?> </td>
                        
                        <td> <?php 
                        if ($arrResult2[$i]['expect_handover'] == "0000-00-00"){
                        echo "-" ; 
                        } else { echo $arrResult2[$i]['expect_handover']; 
                        } ?> </td>
                        
                        <td> <?php 
                        if ($arrResult2[$i]['expect_construct_complete'] == "0000-00-00"){
                        echo "-" ; 
                        } else { echo $arrResult2[$i]['expect_construct_complete']; 
                        } ?> </td>
                        
                        <?php if ($_SESSION['role']=="admin") { ?>
                        <td> <button  type="button" id="EditButton" class="btn btn-info btn-sm" value="<?php echo $arrResult2[$i]['construction_id']; ?>" data-toggle="modal" data-target="#myModal3" ><img src="img/edit.png" width="20px"></button></td>
                        <?php } ?>
                        </tr>
                        <?php } ?>
            </tbody>
        </table>
        
        
          
    </div>
      
      

</div>
                </div>
            </div>  
                <?php } ?>
        </div>
        
        
        
        
        
        
        
        
       <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Upload Documentation</h4>
        </div>

                
<form id="UploadForm" class="form-horizontal" role="form" action="addDocument.php" method="post" data-toggle="validator" enctype="multipart/form-data">
            <div class="modal-body">
            
            <div class="row">
            <div class="col-sm-offset-1 col-sm-3"><p> <img src="img/upload.png" width='100px' class="img-rounded"/></p></div>
            <div class="col-sm-6">    
                <bR>
        <label >Upload Document</label>
        <br>
        <input type="text" name="title" id="title" placeholder="File Title name" required/><br><br>
        <input type="file" name="document" id="document" required/>
        <input type="hidden" name="property_id" id="property_id" value="<?php echo $propertyID; ?>" required/>  <br> 
        <input type="hidden" name="projectName" id="projectName" value="<?php echo $projectName; ?>" required/>  <br> 
        <input type="hidden" name="projectID" id="projectID" value="<?php echo $projectID; ?>" required/>  <br> 

        
                
                
            </div>
            </div>
        </div>
        <div class="modal-footer">

            <button type="submit" class="btn btn-primary">Upload Document</button>

          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button></div></form>
        
      </div>
      
    </div>
  </div>
        
        
                <div class="modal fade" id="myModal2" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <center><h2 class="modal-title">Add Construction Details</h2></center>
        </div>
        <div class="modal-body">
          
                
            <form id="defaultForm" class="form-horizontal" role="form" action="addConstruction.php" method="post" data-toggle="validator">
                
                <input type="hidden" name="property_id" value="<?php echo $propertyID; ?>" >
                
                <div class="form-group">
                    <label class="control-label col-sm-3">Construction Status:</label>
                    <div class="col-sm-8" name="construction_status">
                        
                        <select class="form-control" id="construction_status" name="construction_status" required>
                        <option value="">-- Please Select --</option>
                        <option value="Ready Stock">Ready Stock</option>
                        <option value="Indent">Indent</option>
                    </select>
                        <div class="help-block with-errors"></div>
                    </div>
                </div>
                
                <div class ="form-group">
                    <label class="control-label col-sm-3">Progress of Construction:</label>
                    <div class="col-sm-8" name="progress_status">
                        <input type="checkbox" value ="Foundation"/> Foundation <br>
                        <input type="checkbox" value ="Roof"/> Roof <br>
                        <input type="checkbox" value ="Handover"/> Handover <br>
                        <input type="checkbox" value ="Electricity"/> Electricity <br>
                        <input type="checkbox" value ="Drainage"/> Drainage <br>
                        <input type="checkbox" value ="IMB"/> IMB <br>
                        <input type="checkbox" value ="Certificate"/> Certificate 
                    <div class="help-block with-errors"></div>
                    </div>
                </div>
                    
                <div class="form-group">
                    <label class="control-label col-sm-3" for="latest_handover">Latest Handover Date:</label>
                    <div class="col-sm-8">
                        <input type="date" class="form-control" id="latest_handover" name="latest_handover"/>
                        <div class="help-block with-errors"></div>
                    </div>
                </div>

                <br>
                
                <div class="form-group">
                    <label class="control-label col-sm-3" for="latest_construct_complete">Latest Construct Complete:</label>
                    <div class="col-sm-8">
                        <input type="date" class="form-control" id="latest_construct_complete" name="latest_construct_complete"/>
                        <div class="help-block with-errors"></div>
                    </div>
                </div>

                <br>
                
                <div class="form-group">
                    <label class="control-label col-sm-3" for="expect_handover">Expected Handover:</label>
                    <div class="col-sm-8">
                        <input type="date" class="form-control" id="expect_handover" name="expect_handover"/>
                        <div class="help-block with-errors"></div>
                    </div>
                </div>

                <br>
                
                <div class="form-group">
                    <label class="control-label col-sm-3" for="expect_construct_complete">Expected Completion:</label>
                    <div class="col-sm-8">
                        <input type="date" class="form-control" id="expect_construct_complete" name="expect_construct_complete"/>
                        <div class="help-block with-errors"></div>
                    </div>
                </div>
                
                
                <div class="modal-footer"> <button type="submit" class="btn btn-primary">Add Construction</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
           </form>
        </div>
      </div> 
    </div>
</div> 
        
        
    <div class="modal fade" id="myModal3" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <center><h2 class="modal-title">Edit Construction Details</h2></center>
        </div>
        <div class="modal-body">
            <p>
                
            <form id="defaultForm2" class="form-horizontal" role="form" action="#" method="post" data-toggle="validator">
                
                <input type="hidden" name="construction_id" value=""> 
                
               <div class="form-group">
                    <label class="control-label col-sm-3">Construction Status:</label>
                    <div class="col-sm-8" name="construction_status">
                        
                        <select class="form-control" id="construction_status" name="construction_status" required>
                        <option value="">-- Please Select --</option>
                        <option value="Ready Stock">Ready Stock</option>
                        <option value="Indent">Indent</option>
                        <option value="Under Construction">Under Construction</option>
                        <option value="Handed Over">Handed Over</option>
                        
                    </select>
                        <div class="help-block with-errors"></div>
                    </div>
                </div>
                
                <br>
                
                <div class="form-group">
                    <label class="control-label col-sm-3" for="latest_handover">Latest Handover Date:</label>
                    <div class="col-sm-8">
                        <input type="date" class="form-control" id="latest_handover" name="latest_handover"/>
                        <div class="help-block with-errors"></div>
                    </div>
                </div>

                <br>
                
                <div class="form-group">
                    <label class="control-label col-sm-3" for="latest_construct_complete">Latest Construct Complete:</label>
                    <div class="col-sm-8">
                        <input type="date" class="form-control" id="latest_construct_complete" name="latest_construct_complete"/>
                        <div class="help-block with-errors"></div>
                    </div>
                </div>

                <br>
                
                <div class="form-group">
                    <label class="control-label col-sm-3" for="expect_handover">Expected Handover:</label>
                    <div class="col-sm-8">
                        <input type="date" class="form-control" id="expect_handover" name="expect_handover"/>
                        <div class="help-block with-errors"></div>
                    </div>
                </div>

                <br>
                
                <div class="form-group">
                    <label class="control-label col-sm-3" for="expect_construct_complete">Expected Completion:</label>
                    <div class="col-sm-8">
                        <input type="date" class="form-control" id="expect_construct_complete" name="expect_construct_complete"/>
                        <div class="help-block with-errors"></div>
                    </div>
                </div>

            <br>
              
  <div class="modal-footer"> 
            <button type="submit"  class="btn btn-primary">Edit Construction</button>
            <button type="button" name="deleteProject" class="btnDelete btn btn-danger">Delete Construction</button>
        </div> </form>

      </div> 
    </div>
    </div>
        </div> 
        
        

         
        
        
        
        
        
    </body>
</html>