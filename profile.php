<?php
session_start();
include('config.php');

?>
<!DOCTYPE html>
<html lang="en">

<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <link rel="icon" href="./assets/img/icon.png" type="image/png">
    <link rel="stylesheet" href="./assets/CSS/profile.css">   
</head>

<body>
    <div class="navbar-top">
        <div class="title">
            <h1>Profile</h1>
        </div>
    </div>
    <div class="sidenav">
        <div class="sidenav-url">
            <div class="url">
                <a href="#.php" class="active" onclick="showProfile()">Profile</a>
            </div>
            <div class="url">
                <a href="#" class="active" onclick="swapForms()">Edit</a>
            </div>
            <div class="url">
                <a href="index.php" class="active">Log Out</a>
            </div>
        </div>
    </div>
    <div class="main">
        <div class="view" id="div1">
            <h2>IDENTITY</h2>
            <div class="card">
                <div class="card-body">
                    <i class="fa fa-pen fa-xs edit"></i>
                    <table>
                        <tbody>
                            <?php
                            $email = $_SESSION['login_user'];
                            $query2 = "SELECT * FROM user1 WHERE mail='$email' ";
                            $query_run2 = mysqli_query($db, $query2);

                            if (mysqli_num_rows($query_run2) > 0) {
                                while ($student2 = mysqli_fetch_assoc($query_run2)) {
                                    ?>
                                    <tr>
                                        <td>Name</td>
                                        <td>:</td>
                                        <td><?= $student2['uname'] ?></td>
                                    </tr>
                                    <tr>
                                        <td>Email</td>
                                        <td>:</td>
                                        <td><?= $student2['mail'] ?></td>
                                    </tr>
                                    <tr>
                                        <td>Date Of Birth</td>
                                        <td>:</td>
                                        <td><?= $student2['dob'] ?></td>
                                    </tr>
                                    <tr>
                                        <td>Age</td>
                                        <td>:</td>
                                        <td><?= $student2['age'] ?></td>
                                    </tr>
                                    <tr>
                                        <td>Address</td>
                                        <td>:</td>
                                        <td><?= $student2['address'] ?></td>
                                    </tr>
                                    <tr>
                                        <td>Hobbies</td>
                                        <td>:</td>
                                        <td><?= $student2['hobbies'] ?></td>
                                    </tr>
                                    <tr>
                                        <td>Job</td>
                                        <td>:</td>
                                        <td><?= $student2['job'] ?></td>
                                    </tr>
                                    <tr>
                                        <td>Skill</td>
                                        <td>:</td>
                                        <td><?= $student2['skill'] ?></td>
                                    </tr>
                                <?php
                                }
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="hide" id="div2">
            <h2>EDIT</h2>
            <div class="card">
                <div class="card-body">
                    <i class="fa fa-pen fa-xs edit"></i>
                    <form id="reg" method="POST">
                        <table>
                            <tbody>                          
                                <div class="form-group">
                                <tr>
                                    <td><label >Date Of Birth</label></td>
                                    <td><input type="date" class="form-control"  name="dob" size="100" ></td>
                                </tr>
                                <tr>
                                    <td><label >Age</label></td>
                                    <td><input type="text" class="form-control"  name="age" ></td>
                                </tr>
                                <tr>
                                    <td><label >Address</label></td>
                                    <td><input type="text" class="form-control"  name="address"></td>
                                </tr>
                                <tr>
                                    <td><label >Hobbies</label></td>
                                    <td><input type="text" class="form-control"  name="hobbies" ></td>
                                </tr>
                                <tr>
                                    <td><label >Job</label></td>
                                    <td><input type="text" class="form-control"  name="job"></td>
                                </tr>
                                <tr>
                                    <td><label >Skill</label></td>
                                    <td><input type="text" class="form-control"  name="skill"></td>
                                </tr>
                            </div>
                            </tbody>
                        </table>
                        <input type="button" value="SUBMIT" class="btn btn-primary" onclick="submitForm()">
                    </form>
                </div>
            </div>
        </div>
    </div>


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="./assets/JS/profile.js"></script>
    <script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>


    <script>
        $(document).on('submit', '#reg', function(e) {
            e.preventDefault();

            var formData = new FormData(this);
            formData.append("save_reg", true);

            $.ajax({
                type: "POST",
                url: "profile_insert.php",
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    console.log(response);

                    var res = jQuery.parseJSON(response);
                    if (res.status == 422) {
                        $('#errorMessage').removeClass('d-none');
                        $('#errorMessage').text(res.message);

                    } else if (res.status == 200) {

                        $('#errorMessage').addClass('d-none');
                        $('#reg')[0].reset();

                        alertify.set('notifier', 'position', 'top-right');
                        alertify.success(res.message);

                        $('#user1').load(location.href + "#user1");

                    } else if (res.status == 500) {
                        $('#errorMessage').addClass('d-none');
                        $('#reg')[0].reset();
                        alertify.set('notifier', 'position', 'top-right');
                        alertify.success(res.message);
                    }
                }
            });
        });

    function submitForm() {
        var formData = new FormData(document.getElementById("reg"));
        formData.append("save_reg", true);
        $.ajax({
            type: "POST",
            url: "profile_insert.php",
            data: formData,
            processData: false,
            contentType: false,
            success: function (response) {
                console.log(response);
                window.location.href = "profile.php";
            }
        });
    }    
    </script>

</body>

</html>