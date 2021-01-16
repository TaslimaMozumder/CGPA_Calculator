<?php include_once('assets/php/database.php');
    if(!isset($_SESSION['login_id'])) {
        header('location: login.php');
    } else {
        $user_id = $_SESSION['login_id'];
    }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CGPA Calculator</title>
</head>
<body>
    <h1>Welcome <?php if(isset($_SESSION['name'])) echo $_SESSION['name']; ?></h1>
    <h5>ID: <?php if(isset($_SESSION['login_id'])) echo $_SESSION['login_id']; ?></h5>
    <button><a href="add_course.php">Add Course</a></button><br><br>
    <button><a href="assets/php/logout.php">Logout</a></button><br>

    <p>All grade and Current CGPA</p>
    <table>
        <thead>
            <tr>
                <td>Course</td>
                <td>Credit</td>
                <td>Semester</td>
                <td>Grade</td>
            </tr>
        </thead>
        <tbody>
            <?php
                $sql = "SELECT g.user, g.course, g.credit, g.semester, g.grade, s.grade, s.points
                FROM grades as g JOIN scale as s ON g.grade = s.grade
                WHERE g.user = '$user_id' ORDER BY g.semester ASC";

                $points = 0;
                $credits = 0;
                
                $result = mysqli_query($conn, $sql);
                if ($result && $result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        $course = $row["course"];
                        $credit = $row["credit"];
                        $semster = $row["semester"];
                        $grade = $row["grade"];
                        $credits += $credit;
                        $points += $credit * $row['points'];
                        ?>
                            <tr>
                                <td><?php echo $course; ?></td>
                                <td><?php echo $credit; ?></td>
                                <td><?php echo $semster; ?></td>
                                <td><?php echo $grade; ?></td>
                            </tr>
                        <?php
                    }
                }
            ?>
        </tbody>
        <tfoot>
            <tr>
                <td>Credits: <b><?php echo $credits; ?></b></td>
                <td>CGPA: <b><?php if($credits != 0) echo number_format(($points / $credits), 2, ".", ","); ?></b></td>

                
            </tr>
        </tfoot>
    </table>











</body>
</html>