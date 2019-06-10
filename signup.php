<?php

include_once 'inc/functions.php';
session_start();
$mysqli = mysqli_connect('localhost', 'root', '', 'test');
$string = generateRandomString();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $mysqli->real_escape_string($_POST['usernm']);
    $email = $mysqli->real_escape_string($_POST['email']);
    $password = crypt('keydoesnotexists',($_POST['password']));

    $_SESSION['username'] = $username;
    $_SESSION['email'] = $email;
    $_SESSION['token'] = $string;

    $sql = "insert into users(username, email, password) values('$username','$email','$password')";
    if (mysqli_query($mysqli,$sql) === true){
        $_SESSION['message'] = "Regestraion Successful, added details of user $username to the server.";
        header("location: index.php?signup=success&token=".$string);
    } else{
        $_SESSION['message']="could not connect to the server";
    }

}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Signup</title>
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
            margin: 17px;
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
            height: 45px;
            width: 30%;
            font-size: 1.6em;
            outline: none;
            background: yellowgreen;
            color: #fff;
            text-transform: uppercase;
            margin-top: 3%;
        }

        button:hover{
            background: #f1f2f3;
            color: black
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
            padding: 17px;
            border-radius: 6px;
        }

        input::placeholder {
            text-transform: uppercase;
        }
    </style>
</head>

<body>
    <h2>Signup for abc forum</h2>
    <hr>
    <form action="" method="post">

        <center>

            <table>
                <tr>
                    <td> <label>username</label></td>
                    <td class="inpt"> <input type="text" name="usernm" id="usernm" placeholder="enter username" required><br></td>
                </tr>
                <tr>
                    <td><label>Email</label></td>
                    <td class="inpt"><input type="email" name="email" id="email" placeholder="enter email" required><br></td>
                </tr>
                <tr>
                    <td> <label>password</label></td>
                    <td class="inpt"> <input type="password" name="password" id="p1" placeholder="enter password" required> <br></td>
                </tr>
                <tr>
                    <td> <label>re-type password</label></td>
                    <td class="inpt"> <input type="password" name="re-password" id="p2" placeholder="Retype Password" required> <br></td>
                </tr>
            </table>


            <button type="submit" name="submit" id="btn" onclick="validpass()">Signup</button>
            <br><br>
            <p>alredy have an account? <a href="login.php">login here</a></p>


        </center>
    </form>
    <script>
        function validpass() {

            var p1 = document.getElementById("p1").value
            var p2 = document.getElementById("p2").value
            var usernm = document.getElementById("usernm").value
            var email = document.getElementById("email").value


            if (email == null || email == "" || usernm == null || usernm == "" || p1 == null || p1 == "" || p1 == null || p1 == "") {
                alert("ALL FIELDS ARE REQUIRED!")
            } else {
                if (p1 == p2) {
                    if (p1.length < 8) {
                        alert("password must be atleast 8 chars long")
                    }
                } else {
                    alert("password do not match")
                }
            }
        }
    </script>
</body>

</html>