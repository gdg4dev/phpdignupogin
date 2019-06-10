<?php
session_start();
$mysqli = mysqli_connect('localhost', 'root', '', 'test');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $username = $mysqli->real_escape_string($_POST['username']);
    $password = crypt('keydoesnotexists', ($_POST['password']));

    $_SESSION['passworddd'] = $password;
    $_SESSION['username'] = $username;

    $sql = "select * from users where username = '$username' and password = '$password' limit 1";
    $mysqli = mysqli_query($mysqli,$sql);

    while ($row = mysqli_fetch_assoc($mysqli)) {

        $retrive_username = $row['username'];
        $retrive_password = $row['password'];

        if ($username == $retrive_username && $password == $retrive_password) {
            
            header("location: index.php");
        } else {
            $_SESSION['message'] = "could not connect";
            $erralert = $_SESSION['message'];
            echo " <script>alert('$erralert');</script>";
            Error;
        }
        
    }
    
}

?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>login</title>
    <style>
        @import url('https://fonts.googleapis.com/css?family=Raleway&display=swap');

        body {
            font-family: 'Raleway', sans-serif;
            display: flex;
            text-transform: uppercase;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            background: url('https://images.unsplash.com/photo-1526749837599-b4eba9fd855e?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=1050&q=80');
            background-size: cover;
        }

        form {
            margin-top: 30px;
            width: 50%;
            border: 3px solid grey;
            border-radius: 14px;
            padding: 40px;
            background: rgba(245, 222, 179, .8);
            padding-bottom: 1%;
        }

        form:hover {
            box-shadow: 3px 3px 2px grey;
        }

        input {
            margin: 20px;
            border: 1px solid grey;
            outline: none;
            height: 25px;
            width: 90%;
            padding: 8px 15px;
            border-radius: 7px;
            font-family: monospace;
            font-size: 20px
        }

        input:focus {
            border: 2px dashed grey;
            border-radius: 25px;
        }

        button {
            border: none;
            border-radius: 25px;
            height: 50px;
            width: 30%;
            font-size: 1.6em;
            outline: none;
            background: yellowgreen;
            color: #fff;
            text-transform: uppercase;
            margin-top: 3%;
        }

        button:hover {
            box-shadow: 2px 2px 1px yellowgreen;
            margin-top: 3.2%;

        }

        a {
            margin-top: 40px;
        }

        hr {
            width: 30%;
            background: violet;
            height: 3px;
            border: none;
        }

        .inpt {
            width: 80%;
        }

        label {
            font-weight: bold;
        }

        h2 {
            color: white;
            text-transform: uppercase;
            background: rgba(245, 222, 179, .6);
            padding: 20px;
            border-radius: 6px;
        }

        input::placeholder {
            text-transform: uppercase;
        }
    </style>
</head>

<body>
    <h2>Login for abc forum</h2>
    <hr>
    <form action="" method="post">

        <center>

            <table>

                <tr>
                    <td><label>Username</label></td>
                    <td class="inpt"><input type="text" name="username" id="username" placeholder="enter username" required><br></td>
                </tr>
                <tr>
                    <td> <label>password</label></td>
                    <td class="inpt"> <input type="password" name="password" id="p1" placeholder="enter password" required> <br></td>
                </tr>

            </table>


            <button type="submit" name="submit" id="btn" onclick="validpass()">Login</button>
            <br><br>
            <p>Don't have an account? <a href="signup.php">signup here</a></p>

        </center>
    </form>
    <script>
        function validpass() {

            var p1 = document.getElementById("p1").value
            var email = document.getElementById("username").value


            if (email == null || email == "" || p1 == null || p1 == "") {
                alert("ALL FIELDS ARE REQUIRED!")
            }
        }

        
    </script>
</body>

</html>