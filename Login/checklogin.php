<?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST')
    {
        $email = $_POST['email'];
        $password = $_POST['password'];

        $con = mysqli_connect('localhost','root','','complaints');

        $sql = "SELECT * from cops WHERE Email='$email' and Password = '$password'";
        $result = $con->query($sql);

        if ($result->num_rows > 0)
        {
            session_start();
            $row = mysqli_fetch_array($result);
            if($row['Post']=="ASI")
            {
                    $_SESSION['email'] = $email;
                    $_SESSION['post'] = "ASI";
                echo '<script>
                window.location="../displaycomplaints.php";
                </script>';

            }
            else if($row['Post']=="SI")
            {
                $_SESSION['email'] = $email;
                $_SESSION['post'] = "SI";
                echo '<script>
                window.location="../si_dash.php";
                </script>';
            }
        }
        else
        {
            $message = "Wrong credentials";
            echo "<script type='text/javascript'>alert('$message');</script>";
            echo '<script>
            window.location="login.html";
            </script>';
        }
    }

 ?>
