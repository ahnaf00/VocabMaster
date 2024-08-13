<?php
session_start();
$_user_id = $_SESSION['id'] ?? 0;
if ($_user_id) {
    header("Location:words.php");
    exit();
}

include_once "functions.php";
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Vocabulary Builder</title>

    <link rel="stylesheet" href="./assets/css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  </head>
  <body>
    <div class="container">
        <div class="row text-center">
            <h2 class="mt-3">Vocabularies</h2>
        </div>

        <div class="row d-flex text-center mt-5">
            <div class="loginRegister">
                <a href="" id="login" onclick="getLogin(event)">Login</a> | 
                <a href="" id="register" onclick="getRegistration(event)">Register</a>
            </div>
        </div>

        <div class="row d-flex justify-content-center mt-2">
            <div class="col-6" >
                <div class="card my-3 rounded-0 shadow">
                    <div class="card-body">
                        <h3 class="text-center my-3" id="title">Login</h3>
                        <?php 
                        
                        $status = $_GET['status']??0;

                        if($status)
                        {
                            ?>
                                <p class="my-3 text-danger"><?php echo getStatusMessage($status); ?></p>
                            <?php
                        }
                        
                        ?>
                        <form action="tasks.php" method="POST">
                            <div class="my-2">
                                <label for="email" class="form-label">Email address</label>
                                <input type="email" name="email" class="form-control rounded-0" placeholder="Type your email">
                            </div>
                            <div class="mb-2">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" name="password" class="form-control rounded-0" placeholder="Type Password">
                            </div>
                            <div class="mb-2 mt-3">
                                <input type="submit" class="btn btn-primary rounded-0" value="Submit">
                                <input type="hidden" id="action" name="action" value="login">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>




    <script src="./assets/js/script.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.slim.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>


  </body>
</html>