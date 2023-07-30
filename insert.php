<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script src = "https://cdn.jsdelivr.net/npm/jquery-validation@1.19.2/dist/jquery.validate.min.js" > </script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/additional-methods.min.js"></script>
        <script src = "ajax-validations.js"></script>
        <title>Student Management</title>
        <style>
            .error{
                color: #FF0000;
            }
        </style>
    </head>
    <body class= "bg-dark">
        <div class="container bg-light" style="width: 600px">
            <?php  
                $student_name = $email = $phone = $address = $gender = $hobbies = $city = $name = "";
                if($_SERVER['REQUEST_METHOD']=='POST')
                {
                    $student_name = $_POST['name'];
                    $email = $_POST['email'];
                    $phone = $_POST['phone'];
                    $address = $_POST['address'];
                    $gender = $_POST['gender'];
                    $hobbies = implode(',', $_POST['hobbies']);     
                    $city = $_POST['city'];
                    $name = $_FILES["uploadfile"]["name"];
  
                    //$name = '';
                    $target_dir = "upload/";
                    $target_file = $target_dir . basename($_FILES["uploadfile"]["name"]);
  
                    // Select file type
                    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
                    // Valid file extensions
                    $extensions_arr = array("jpg","jpeg","png","gif");
  
                    // Check extension
                    if( in_array($imageFileType,$extensions_arr) ){
                        // Upload file
                        if(move_uploaded_file($_FILES['uploadfile']['tmp_name'],$target_dir.$name)){
                              
                        }
                    }
                    else{
                        echo "Enter correct file type (jpg, jpeg, png, gif)";
                        exit();
                    }
      
            ?>
            
                <?php
                    include('conn.php');  
                    $sql = "INSERT INTO info (name, email, phone, address, gender, hobbies, city, profile)
                        VALUES ('$student_name', '$email', '$phone', '$address', '$gender', '$hobbies', '$city', '$name')";
              
                    if($conn->query($sql) === TRUE){
                        echo '<div class="alert alert-success" role="alert"> Student Entry Successful </div>';
                        exit;
                    }
                    else{
                        echo "Error in connection".$conn->error();
                    }
                }
                ?> 
                <p class="text text-success" id="form_success"> </p>     
                <br>
                <h1 class="text-center text-dark">Student Info Form</h1>
                <br><br>
           

                <a href="display.php" class="btn btn-primary float-right" onclick=display()>List of Students</a>
                <br><br>
                <form  method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>" enctype="multipart/form-data" name="form" id="form" >
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="name">Name</label><span class="required text-danger">*</span>
                            <input type="text" class="form-control" placeholder="Name" name="name" id="name" minlength="3" required>                       
                        </div>
                    
                        <div class="form-group col-md-6">
                            <label for="email">Email</label> <span class="text-danger">*</span>
                            <input type="email" class="form-control" name= "email"placeholder="Email" id="email" required>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="phone">Phone</label> <span class="text-danger">*</span>
                            <input type="tel" class="form-control"  placeholder="Phone" name="phone" id="phone"  required>
                        </div>

                        <div class="form-group col-md-6">
                            <label for="city">City</label> <span class="text-danger">*</span>
                            <select class="form-control" name="city" id="city">
                                <option value="">--select--</option>
                                <option value="Baroda">Baroda</option>
                                <option value="Ahmedabad">Ahmedabad</option>
                                <option value="Surat">Surat</option>
                                <option value="Anand">Anand</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-row">                    
                        <div class="form-group col-md-6">
                            <p>Gender <span class=" text-danger">*</span></p>
                            <div class="form-check form-check-inline">  
                                <label class="form-check-label" for="male"> 
                                    <input class="form-check-input" type="radio" name="gender" id="gender-male" value="Male">Male 
                                </label>
                            </div>
                            <div class="form-check form-check-inline">   
                                <label class="form-check-label" for="female"> 
                                    <input class="form-check-input" type="radio" name="gender" id="gender-female" value="Female"> Female 
                                </label>
                            </div>
                            <div class="form-check form-check-inline"> 
                                <label class="form-check-label" for="other">
                                    <input class="form-check-input" type="radio" name="gender" id="gender-other" value="Other"> Other 
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="form-row">                  
                        <div class="form-group col-md-6">
                        <p>Hobbies <span class="text-danger">*</span></p>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" name="hobbies[]" id="read" value="Reading">
                                <label class="form-check-label" for="reading">Reading</label>
                            </div>

                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" name="hobbies[]" id="travel" value="Traveling">
                                <label class="form-check-label" for="traveling">Traveling</label>
                            </div>

                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" name="hobbies[]" id="dance" value="Dancing">
                                <label class="form-check-label" for="dancing">Dancing</label>
                            </div>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label for="address">Address</label><span class="text-danger">*</span>
                            <textarea class="form-control" rows="3" cols="50" name="address" id="address" required></textarea>
                        </div>
                    </div>
                    <div class="form-row-center">
                        <div class="form-group">
                            <label for="profile">Profile</label> <span class="text-danger">*</span>
                            <input type="file" accept="image/*" class="form-control-file" name="uploadfile" id="profile" required>
                        </div>
                </div>
                <br><br>
                <input type="button" class="btn btn-success" name="submit" id="submit" value="Submit">
                <br>              
            </form> 
        </div> 
    </body>
    
</html>
