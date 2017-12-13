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
                
                $('#edit').click(function(){
                var id = $('#activity_id').val();  
                var status = $('#status').val();
                var r = confirm("confirm to Update status?");  
                
                if (r == true) {
                    
                    $.ajax({
                        
                        type: "GET",
                        url: "./doEditActivity.php",
                        data: "activity_id="+ id + "&status="+ status,
                        cache: false,
                        dataType: "JSON",
                        success: function (response) {
                            location.reload();        
                        },
                        
                        error: function (obj, textStatus, errorThrown) {
                            console.log("Error " + textStatus + ": " + errorThrown);
                        }    
                    });  
                } 
                
                else {
                } 
                });
            });
        </script>
    </head>
    
    <body>
        <?php

        $propertyID = $_GET['property_id'];
        include("./navbar.php");
        include("./dbFunctions.php");
        $arrResult2 = array();
        
        $querySelect = "SELECT * FROM property, project where project.project_id = property.project_id and property_id = " . $propertyID;
        $resultSelect = mysqli_query($link, $querySelect) or die(mysqli_error($link));     
        
        $querySelect2 = "SELECT * FROM activity where property_id = " . $propertyID;
        $resultSelect2 = mysqli_query($link, $querySelect2) or die(mysqli_error($link)); 
        
        while ($rowSelect2=mysqli_fetch_assoc($resultSelect2)){
            $arrResult2[]=$rowSelect2;
        }
        
        ?>

        <div class="container">
            <?php 
                while ($rowSelect=mysqli_fetch_assoc($resultSelect)){
                    $projectID = $rowSelect['project_id'];
                    $projectName = $rowSelect['project_name'];
                    $block = $rowSelect['block']; 
                    $street = $rowSelect['street']; 
                    $unit = $rowSelect['unit'];
                    $status = $rowSelect['property_status'];
                    $standard_price = $rowSelect['standard_price'];
                    $all_in_price = $rowSelect['all_in_price'];
                    $promo_price = $rowSelect['promo_price'];
                    $actual_price = $rowSelect['actual_sale_price'];
                    $price_scheme = $rowSelect['price_scheme'];
                    $payment_type = $rowSelect['payment_type'];
                    $other_payment = $rowSelect['other_payment'];
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
            <li><a data-toggle="tab" href="#menu3">Status Update</a></li>
            <?php } ?>
        </ul>
                
        <div class="tab-content">
        
        <div id="home" class="tab-pane fade in active">
        <h3>Property Details</h3>
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
        
        <br>Agent to upload Buyer's ID and Buyer's Booking Transaction Receipt
        <p>
        <br>
        <?php if ($_SESSION['role'] == "agent") { ?>
        <button type="button" style="float:right" class="btn btn-info btn-sm" data-toggle="modal" data-target="#myModal">Upload Document</button><br><br>
        <?php } ?>
        <table class="table table-bordered">
        <thead>
        <tr>
            <th>Document Title</th>
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
        <td><a href="file\<?php echo $arrResultDocument['url']; ?>" download>  <img src="img/file.jpg" width='20%' class="img-rounded"/>  </a></td>
         </tr>
  <?php } ?>
     
    </tbody>
  </table>
        
        <br>
        
        
    </div>
      
      
    <div id="menu2" class="tab-pane fade">
        <h3>Sale Price</h3>
      
        <br>
          <span class="glyphicon glyphicon-cloud"></span> <b>Standard Price (Unit Only): </b> Rupiah <?php echo $standard_price ?><br><br>
          <span class="glyphicon glyphicon-cloud"></span> <b>All-In Price (Include All Charges): </b> Rupiah <?php echo $all_in_price ?><br><br>
          <span class="glyphicon glyphicon-cloud"></span> <b>Promo Price (Include All Charges): </b> Rupiah <?php echo $promo_price ?><br><br>

        <blockquote class="blockquote blockquote-reverse">
            <h3 class="mb-0"><span class="glyphicon glyphicon-cloud"></span> Offer Price: Rupiah <?php echo $actual_price ?> </h3>
            <h4 class="mb-0"><span class="glyphicon glyphicon-cloud"></span> Price Scheme: <?php echo $price_scheme ?> </h4>
           
            <?php if ($payment_type == 'Others') { ?>
                <h4 class="mb-0"><span class="glyphicon glyphicon-cloud"></span> Payment Type: <?php echo $other_payment ?> </h4>
            <?php } else { ?>
                <h4 class="mb-0"><span class="glyphicon glyphicon-cloud"></span> Payment Type: <?php echo $payment_type ?> </h4>
            <?php } ?>
            
        </blockquote>
          
    </div>
      
      
      
    <div id="menu3" class="tab-pane fade">
        <h3>Status Update </h3>
        
           <?php for ($i=0 ; $i<count($arrResult2); $i++){   ?>

            <input type="hidden" class="form-control" id="activity_id" name="activity_id" value="<?php echo $arrResult2[$i]['activity_id']; ?>">
            <input type="hidden" class="form-control" id="status" name="status" value="<?php echo $arrResult2[$i]['status']; ?>">
        
       <?php if ($arrResult2[$i]['status'] == "Reserved"){ ?>
       <img src="img/1.png" style="float:left" width='60%' class="img-rounded"/>
           
           <?php } if ($arrResult2[$i]['status'] == "Reservation Approved"){ ?>
        <img src="img/2.png" style="float:left" width='60%' class="img-rounded"/>
       
                  <?php } if ($arrResult2[$i]['status'] == "Contract Signed And Submitted"){ ?>
        <img src="img/3.png" style="float:left" width='60%' class="img-rounded"/>
       <button type="button" style="float:right" class="btn btn-info btn-sm" data-toggle="modal" data-target="#myModal">Upload Document</button><br><br>
      
                  <?php } if ($arrResult2[$i]['status'] == "Sold"){ ?>
        <img src="img/4.png" style="float:left" width='60%' class="img-rounded"/>
                  <?php } ?>  
       
   
        <br><br>

        <blockquote class="blockquote blockquote-reverse">

        <h3 class="mb-0"><span class="glyphicon glyphicon-cloud"></span> Status:  <?php echo $arrResult2[$i]['status'] ?></h3>
        <footer class="blockquote-footer"><span class="glyphicon glyphicon-cloud"></span> This is your current Status</footer>

        </blockquote> 
   

        
        <?php if ($_SESSION['role']=="admin") { ?> 
        <?php } if ($arrResult2[$i]['status'] != "Sold")  { ?>
                <button style="float:right" type="button" id="edit" class="btn btn-default  btn-md">Update Activity Status</button>
        <?php }} ?>

        
 
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

            <button type="submit" class="btn btn-primary" >Upload Document</button>

          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button></div></form>
        
      </div>
      
    </div>
  </div>
        
        
        

   
        
        
        
        
        
    </body>
</html>