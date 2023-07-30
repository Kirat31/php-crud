<?php
        
    //$student_name = $email = $phone = $address = $gender = $hobbies = $city = $name = "";
    if (isset($_POST['form']))
    {
        $student_name = $_REQUEST['name'];
        $email = $_REQUEST['email'];
        $phone = $_REQUEST['phone'];
        $address = $_REQUEST['address'];
        $gender = $_REQUEST['gender'];
        $hobbies = implode(',', $_REQUEST['hobbies']);     
        $city = $_REQUEST['city'];
        $name = $_FILES["uploadfile"]["name"];
echo 1;
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

        include('conn.php');
            
            $sql = "INSERT INTO info (name, email, phone, address, gender, hobbies, city, profile)
                    VALUES ('$student_name', '$email', '$phone', '$address', '$gender', '$hobbies', '$city', '$name')";
            
            if($conn->query($sql) === TRUE){
                $success = '<div class="alert alert-success" role="alert"> Student Entry Successful </div>';
            }
            else{
                echo "Error in connection".$conn->error();
            }
    }
?>
