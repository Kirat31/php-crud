<html>
    <head>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>  
        <script type="text/javascript">
            function delete_data(d){             
                var id = d;   
                if (confirm("Are you sure??") == true){   
                    var xmlhttp = new XMLHttpRequest();
                    xmlhttp.open("POST", "delete.php?id="+id, true)
                    xmlhttp.onreadystatechange = function() {
                        if (this.readyState === 4 && this.status === 200)
                        {
                            window.location.reload()
                            //$("tr?id="+id).hide();
                        }
                    }
                    xmlhttp.send();
                }
            }
        </script>
        <title> Std Management </title>
    </head>
    <body class="bg-light">
        <div class="container bg-light">
    
            <br> <br>
            <h1 class="text-center text-success">Student Data</h1>
            <p id="form_delete"></p>
            <a class="btn btn-success float-right" href="insert.php" role="button">Add Student</a><br><br>
            <table class="table" id="table">
                <?php
                    include ('conn.php');
                    $sql = "SELECT * FROM info";
                    $result = $conn->query($sql);
                ?>
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">Id</th>    
                        <th scope="col">Name</th>
                        <th scope="col">Email</th>
                        <th scope="col">Phone</th>
                        <th scope="col">City</th>
                        <th scope="col">Gender</th>
                        <th scope="col">Hobbies</th>
                        <th scope="col">Address</th>
                        <th scope="col">Profile</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>

                <?php 
                    if ($result->num_rows>0){
                ?>
                <tbody id="data_table">
                    <tr>
                        <?php
                            while($row = $result->fetch_assoc()){
                        ?>
                        <td><?php echo "".$row["id"].""; ?></td>
                        <td><?php echo "".$row["name"].""; ?></td>
                        <td><?php echo "".$row["email"].""; ?></td>
                        <td><?php echo "".$row["phone"].""; ?></td>
                        <td><?php echo "".$row["city"].""; ?></td>
                        <td><?php echo "".$row["gender"].""; ?></td>
                        <td><?php echo "".$row["hobbies"].""; ?></td>
                        <td><?php echo "".$row["address"].""; ?></td>
                        <td><img src=upload/<?php echo "".$row["profile"].""; ?> style=" border: 5px solid #eee;box: 3px 4px 3px rgba(0, 0, 0);width: 100px;height: 100px;" /></td>
                        <td>
                            <a href="update.php?id=<?php echo $row['id']; ?>" class="btn btn-primary">Edit</a>                       
                            <input type="button" class="btn btn-danger" name="delete" id="delete" onclick="delete_data(<?php echo $row['id']; ?>)" value="Delete">
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
                <?php } ?>
            </table>
            <br><br>   
        </div>
    </body>
</html>
        