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
    <title>Add New Course</title>
</head>
<body>
    <div class="center">
        <form action="" method="post">
            <p>Add New Course</p>
            <input type="text" name="course_name" placeholder="Course name" required><br><br>
            <input type="text" name="course_credit" placeholder="Course credit" required><br><br>
            <input type="text" name="course_semester" placeholder="Course semester" required><br><br>
            <input type="text" name="course_grade" placeholder="Course grade" required><br><br>
            <button name="add_course_submit">Add Course</button><br><br>
            <button><a href="update_course.php">Update Course</a></button><br>
        </form>

        <?php
            if(isset($_POST['add_course_submit'])) {
                $course_name = $_POST['course_name'];
                $course_credit = $_POST['course_credit'];
                $course_semester = $_POST['course_semester'];
                $course_grade = $_POST['course_grade'];
                $user = $_SESSION['login_id'];

                $searchCourse = "SELECT * FROM grades WHERE course = '$course_name' AND user = '$user'";
                $searchCourseResult = mysqli_query($conn, $searchCourse);
        
                if(mysqli_num_rows($searchCourseResult) > 0) {
                    echo "Course already exist";
                } else {
                    $sql = "INSERT INTO grades (user, course, credit, semester, grade) 
                    VALUES('$user', '$course_name', '$course_credit', '$course_semester', '$course_grade')";
                        
                    if(mysqli_query($conn, $sql)) {
                        header('location: index.php');
                    } else {
                        echo "Add Course Failed";
                    }
                }
                

                
            }
        ?>
    </div>
</body>
</html>