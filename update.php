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
        <script src = "validation.js"></script>
        <title> Management </title>
        <style>
            .error{
                color: #FF0000;
            }
        </style>
    </head>
    
    <?php
        include('conn.php');

        $id = $_GET['id'];
        $sql ="SELECT * FROM info WHERE id='".$id."' ";
        $result = $conn->query($sql);
        $row = $result->fetch_assoc();
    
        //$id = $name = $email = $phone = $address = $profile = "";
    ?>
    <body class="bg-dark">
        <div class="container bg-light" style="width: 600px">
            <?php
                if ($_SERVER['REQUEST_METHOD']=='POST'){
                    $id = $_POST['id'];
                    $sname = $_POST['name'];
                    $email = $_POST['email'];
                    $phone = $_POST['phone'];
                    $city = $_POST['city'];
                    $gender = $_POST['gender'];
                    $hobbies = implode(',', $_POST['hobbies']);
                    $address = $_POST['address'];
                    
                    if(!empty($_FILES["profile"]["name"])){ 
                        unlink("upload/".$_POST['profile_hidden']);
                        $name = $_FILES["profile"]["name"];
                        $target_dir = "upload/";
                        $target_file = $target_dir . basename($_FILES["profile"]["name"]);

                        // Select file type
                        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
                        // Valid file extensions
                        $extensions_arr = array("jpg","jpeg","png","gif");
                        // Check extension
                        
                        if( in_array($imageFileType,$extensions_arr) ){
                             // Upload file
                            if(move_uploaded_file($_FILES['profile']['tmp_name'],$target_dir.$name)){              
                            }
                        }
                        else{
                            echo "Enter correct file type (jpg, jpeg, png, gif)";
                            exit();
                        }
                    }else{       
                         $name = $_POST['profile_hidden'];
                    }
                    //exit();
                    $s = "UPDATE info SET name='".$sname."', email='".$email."', phone='".$phone."', city='".$city."', gender='".$gender."', hobbies='".$hobbies."', address='".$address."', profile='".$name."' WHERE id='".$id."'";

                    if($conn->query($s) === TRUE){
                        //header("Location: display.php");
                        echo '<div class="alert alert-success" role="alert"> Student Info Updated </div>';;
                        exit;
                    }
                    else{
                        echo "Error".$conn->error();
                    }
                }
            ?>
            <br><br>
            <h1 class="text-center text-success">Update Entry</h1>
            <br><br>
            <p class="text text-success" id="form_success"> </p>  
            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST"  enctype="multipart/form-data" name="form" id="form">
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="name">Name</label><span class="text-danger">*</span>
                        <input type="text" class="form-control" placeholder="Name" name="name" value="<?php echo $row['name']; ?>" id="name" required>
                        <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                    </div>
                
                    <div class="form-group col-md-6">
                        <label for="phone">Phone</label><span class="text-danger">*</span>
                        <input type="tel" class="form-control" placeholder="Mobile No" name="phone" value="<?php echo $row['phone']; ?>" id="phone" required>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="email">Email</label><span class="text-danger">*</span>
                        <input type="email" class="form-control" placeholder="Email" name="email" value="<?php echo $row['email']; ?>" id="email" required>
                    </div>

                    <div class="form-group col-md-6">
                        <label for="city">City</label><span class="text-danger">*</span>
                        <select class="form-control" name="city" id="city">
                            <option value="Baroda" <?php if($row['city'] == 'Baroda') {echo "selected";} ?>>Baroda</option>
                            <option value="Ahmedabad" <?php if($row['city'] == 'Ahmedabad') {echo "selected";} ?>>Ahmedabad</option>
                            <option value="Surat" <?php if($row['city'] == 'Surat') {echo "selected";} ?>>Surat</option>
                            <option value="Anand" <?php if($row['city'] == 'Anand') {echo "selected";} ?>>Anand</option>
                        </select>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-6">
                        <p>Gender <span class="text-danger">*</span></p>
                        <div class="form-check form-check-inline">
                            <label class="form-check-label" for="male">
                                <input class="form-check-input" type="radio" name="gender" id="male" value="Male" <?php if($row['gender'] == 'Male') {echo "checked";} ?>> Male 
                            </label>
                        </div>
                        <div class="form-check form-check-inline"> 
                            <label class="form-check-label" for="female">
                                <input class="form-check-input" type="radio" name="gender" id="female" value="Female" <?php if($row['gender'] == 'Female') {echo "checked";} ?>> Female 
                            </label>
                        </div>
                        <div class="form-check form-check-inline">
                            <label class="form-check-label" for="other">
                                <input class="form-check-input" type="radio" name="gender" id="other" value="Other" <?php if($row['gender'] == 'Other') {echo "checked";} ?>> Other 
                            </label>
                        </div>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-6">
                        <p>Hobbies <span class="text-danger">*</span> </p>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" name="hobbies[]" id="reading" value="Reading" <?php if(in_array("Reading", explode(",",$row["hobbies"]))){ echo "checked"; }?>>
                            <label class="form-check-label" for="reading">Reading</label>
                        </div>

                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" name="hobbies[]" id="traveling" value="Traveling" <?php if(in_array("Traveling", explode(",",$row["hobbies"]))){ echo "checked"; }?>>
                            <label class="form-check-label" for="traveling">Traveling</label>
                        </div>

                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" name="hobbies[]" id="dancing" value="Dancing" <?php if(in_array("Dancing", explode(",",$row["hobbies"]))){ echo "checked"; }?>>
                            <label class="form-check-label" for="dancing">Dancing</label>
                        </div>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="inputAddress">Address</label><span class="text-danger">*</span>
                        <textarea class="form-control" rows="3" cols="70" name="address"><?php echo $row['address']; ?></textarea>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-6">     
                        <img src=upload\<?php echo "".$row["profile"].""; ?> style=" border: 5px solid #eee;box-shadow: 3px 4px 3px rgba(0, 0, 0, 0.3);width: 100px;height: 100px;" />
                    </div>
                </div>
                
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="inputImage">Profile</label><span class="text-danger">*</span>
                        <input type="file" accept="image/*" class="form-control-file" name="profile" value="">
                        <input type="hidden" class="form-control-file" name="profile_hidden" value="<?php echo $row['profile']; ?>">
                    </div>
                </div>
                <br><br>
                <input type="button" class="btn btn-primary" name="submit" id="submit" value="Update">
                <br><br>
            </form>
        </div>
    </body>
</html>