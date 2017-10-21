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
            url: "http://localhost/sale_property1/getProjectDetails.php",
            data: "id=" + id,
            type: "GET",
            cache: false,
            dataType: "JSON",
            success: function (data) {
                
                $('[name=project_id]').val(data.project_id);
                $('[name=name]').val(data.project_name);
                $('[name=start_date]').val(data.start_date);
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
                url: "http://localhost/sale_property1/doEditProject.php",
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
        var id = $('[name=project_id]').val();
        

                
        $.ajax({
            url: "http://localhost/sale_property1/deleteProject.php",
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
         $takenNumber=array();
        $querySelect = "SELECT * FROM project  ";
        $resultSelect = mysqli_query($link, $querySelect) or die(mysqli_error($link));
        
        
        
        while ($rowSelect = mysqli_fetch_assoc($resultSelect))
            {
            $arrResult[]=$rowSelect;
            }
            
        $arrResult1=[]; 
        $arrResult2=[];    
            
        ?>
        
<div class="container">
    <h2>Property Projects
        
       <?php if ($_SESSION['role']=="admin") { ?>
        <button style="float:right;" type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">Add New Project</button>
        <?php } ?></h2>
    
  <p>Raise your profile and be the preferred property agent of a particular project, estate or district, for potential buyers and sellers to go-to.</p><br>         
  
  <table id="defaultTable" class="table table-hover">
    <thead>
      <tr>
        <th>Project ID</th>
        <th>Project Name</th>
        <th>Start Date</th>
        <th>Sold (%)</th>
        <th>Status</th>
      </tr>
    </thead>
    
    <tbody>
        <?php for ($i=0 ; $i<count($arrResult); $i++){   ?>
        
        <?php
        $querySelect1 = "SELECT project.project_id , count(property.project_id) as 'number' from project LEFT JOIN property ON project.project_id = property.project_id where project.project_id=" . $arrResult[$i]['project_id'] . " group by project.project_id";
        $resultSelect1 = mysqli_query($link, $querySelect1) or die(mysqli_error($link));
        while ($rowSelect1 = mysqli_fetch_assoc($resultSelect1))
            {
                $arrResult1[]=$rowSelect1;
            }
    
       $querySelect2 = "SELECT project.project_id , count(property_id) as 'number' from project LEFT JOIN property ON property.project_id = project.project_id and property_status ='taken' where project.project_id = " . $arrResult[$i]['project_id'] . " group by project_id";
       $resultSelect2 = mysqli_query($link, $querySelect2) or die(mysqli_error($link));
        while ($rowSelect2 = mysqli_fetch_assoc($resultSelect2))
            {
                $arrResult2[]=$rowSelect2;
            }
         ?>
        
        <tr>  
        <td> <?php echo $arrResult[$i]['project_id']; ?> </td>
       
        <?php if ($arrResult1[$i]['number'] != 0) { ?>
            <?php if ((($arrResult2[$i]['number'] /$arrResult1[$i]['number'])*100) != "100.00") { ?>
                <td> <a href="property.php?property_id=<?php echo $arrResult[$i]['project_id']; ?>&projectName=<?php echo $arrResult[$i]['project_name']; ?>"> <?php echo $arrResult[$i]['project_name']; ?> </a> </td>
            <?php } else { ?>
                <td> <?php echo $arrResult[$i]['name']; ?> </td>
            <?php } ?>
        <?php } else { ?>  
                <td> <a href="property.php?property_id=<?php echo $arrResult[$i]['project_id']; ?>&projectName=<?php echo $arrResult[$i]['project_name']; ?>"> <?php echo $arrResult[$i]['project_name']; ?> </a> </td>
        <?php } ?>
                
        <td> <?php echo $arrResult[$i]['start_date']; ?> </td>

        <?php if ($arrResult1[$i]['number'] != 0) { ?>
            <td> <?php echo number_format((($arrResult2[$i]['number'] /$arrResult1[$i]['number'])*100) , 2) . '%'  ; ?> </td>
        <?php } else {  ?>
            <td> <?php echo "0.00%" ?> </td>
        <?php } ?>
        
        <?php if ($arrResult1[$i]['number'] != 0) { ?>
            <td> <?php if(number_format((($arrResult2[$i]['number'] /$arrResult1[$i]['number'])*100) , 2) == "100.00"){echo '<span style = "color:red"> Ended </span>';} else {echo '<span style = "color:green"> Active </span>';} ?> </td>
        <?php } else {  ?>
            <td> <?php echo '<span style = "color:green"> Active </span>' ?> </td>
        <?php } ?>
        
        <?php if ($_SESSION['role']=="admin") { ?>
            <td> <button  type="button" class="btn btn-info btn-sm" value="<?php echo $arrResult[$i]['project_id']; ?>" data-toggle="modal" data-target="#myModal2" ><img src="img/edit.png" width="20px"></button></td>
        <?php } ?>
        </tr>
        <?php } ?>
    </tbody>
  </table>
</div>
               
        
<div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <center><h2 class="modal-title">Add Project information</h2></center>
        </div>
        <div class="modal-body">
          
                
            <form id="defaultForm" class="form-horizontal" role="form" action="addProject.php" method="post" data-toggle="validator" enctype="multipart/form-data">
                
           <div class="form-group">
                <label class="control-label col-sm-3" for="name">Project Name:</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" id="name" name="name" 
                       required data-error="Project title is required"/>
                <div class="help-block with-errors"></div>
                </div>
            </div>
            
            <div class="form-group">
                <label class="control-label col-sm-3" for="start_date">Start Date:</label>
                <div class="col-sm-8">
                <input type="date" class="form-control" id="start_date" name="start_date" 
                       required data-error="Start date is required"/>
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
        
        
        <div class="modal-footer"> <button type="submit" class="btn btn-primary">Add Project</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
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
          <center><h2 class="modal-title">Edit Project information</h2></center>
        </div>
        <div class="modal-body">
            <p>
                
            <form id="defaultForm2" class="form-horizontal" role="form" action="#" method="post" data-toggle="validator">
                
                <input type="hidden" class="form-control" id="project_id" name="project_id" value=""> 
                
                <div class="form-group"> 
                    <label class="control-label col-sm-3" for="name">Project Name:</label>
                    <div class="col-sm-8"><div class="projectName"> 
                        <input type="text" class="form-control" id="name" name="name" required 
                               data-error="Project title is required" value="" >
                        <div class="help-block with-errors"></div>
                        </div></div>
                </div>
                
                <br>
               
                 <div class="form-group">
                <label class="control-label col-sm-3" for="start_date">Start Date:</label>
                <div class="col-sm-8">
                <input type="date" class="form-control" id="start_date" name="start_date" required 
                       data-error="Start date is required" >
                <div class="help-block with-errors"></div>
                </div>
            </div>
            <br>
              
  <div class="modal-footer"> 
                   <button type="submit"  class="btn btn-primary">Edit Project</button>
            <button type="button" name="deleteProject" class="btnDelete btn btn-danger">Delete Project</button>
        </div> </form>
       
            
       
 
        
      </div> 
    </div>
    </div></div>
        
        
        
    </body>
</html>