<?php
$user = "";
$Course = "";

if(isset($_POST['submit'])){
    $user =    $_POST['Students'];
    if(!$user){
            $user = ' is not null';
        }else{
            $user = ' = '. $user;
    }
    $Course = $_POST['Course'];
    
    if(!$Course){
            $Course = ' is not null';
        }else{
            $Course = ' = '. $Course;
    }
}
$conn = mysqli_connect('127.0.0.1','root','','loginapp');
    if($conn){
        echo "";
    } else {
        die("failed");
    }
$query = "select * from user";

$result = mysqli_query($conn,$query);
if(!$result){
    die('Query Failed' . mysqli_error());
}
$query2 = "select * from course";

$result2 = mysqli_query($conn,$query2);
if(!$result){
    die('Query Failed' . mysqli_error());
}

$query3 = "select u.username,g.grade,c.courseName   
           from user as u 
                inner join grades as g on u.id = g.sid
                inner join course as c on c.id = g.cid
            where u.id $user and c.id $Course";
    
$result3 = mysqli_query($conn,$query3);
if(!$result3){
    die('Query Failed' . mysqli_error());
}
?>
<?php include "includes/header.php"; ?>
   <div class="container">
       <div class="wrapper">
           <h1>Simple Report</h1>
       </div>
       <form action="create_report2.php" method= "post">
       <div class="data">
           <select name="Students">
            <option value ="">Student</option>
             <?php
               while($row = mysqli_fetch_array($result)){
                   $rowsID1 = $row['id'];
                   $rowsData1 = $row['username'];
                ?>
                <option value="<?php echo $rowsID1; ?>"><?php echo $rowsData1; ?></option>
        
                <?php
                }    
                ?>  
            </select>
            <select  name="Course" >
            <option value="">Course</option>
            <?php
            while($row = mysqli_fetch_array($result2)){
                $rowsID2 = $row['id'];
                $rowsData2 = $row['courseName'];
                ?>
                <option value="<?php echo $rowsID2; ?>"><?php echo $rowsData2; ?></option>
            <?php
            }    
            ?>
           </select>
            
           <input type="submit" class="btn btn-primary" name="submit" value="Create">
           <table border="1" class="table">
              <tr>
                  <th>Student Name</th>
                  <th>Grade</th>
                  <th>Course</th>
              </tr>
              <tr>
                <?php
                while($row = mysqli_fetch_array($result3)){
                    $rowsID3 = $row['username'];
                    $rowsID4 = $row['grade'];
                    $rowsID5 = $row['courseName'];
                ?>
                <tr><td><?php echo $rowsID3; ?></td>
                    <td><?php echo $rowsID4; ?></td>
                    <td><?php echo $rowsID5; ?></td>
                </tr>   
                <?php
                }
                ?>
               </tr>
           </table>
        </div>
       </form>
   </div>
</body>
</html>