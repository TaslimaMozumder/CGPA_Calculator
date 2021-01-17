<?php include_once('assets/php/database.php');
    if(!isset($_SESSION['login_id'])) {
        header('location: login.php');
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Course</title>
</head>
<body>
    <div class="center">
        <form action="" method="post">
            <p>Update Course</p>
            <input type="text" name="course_name" placeholder="Course name" required><br><br>
            <input type="text" name="course_credit" placeholder="Course credit" required><br><br>
            <input type="text" name="course_semester" placeholder="Course semester" required><br><br>
            <input type="text" name="course_grade" placeholder="Course grade" required><br><br>
            <button name="update_course_submit">Update Course</button><br>
        </form>

        <?php
            if(isset($_POST['update_course_submit'])) {
                $course_name = $_POST['course_name'];
                $course_credit = $_POST['course_credit'];
                $course_semester = $_POST['course_semester'];
                $course_grade = $_POST['course_grade'];
                $user = $_SESSION['login_id'];

                $sql = "UPDATE grades SET credit='$course_credit', semester='$course_semester', grade='$course_grade' WHERE course='$course_name'";
                if(!mysqli_query($conn, $sql)) {
                    echo "Course update failed";
                } else {
                    header('location: ./');
                }
                

                
            }
        ?>
    </div>
</body>
</html>