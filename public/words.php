<?php
session_start();

require_once "../classes/Database.php";
require_once "../classes/Vocabulary.php";
require_once "../public/functions.php";

$_user_id = $_SESSION['id']??0;
if(!$_user_id)
{
    header("Location:index.php");
    exit();
}

$db = new Database();
$vocabulary = new Vocabulary($db);
$words = [];

if(isset($_POST['submit']))
{
    $searchedText = $_POST['searchbox']??'';
    $words = $vocabulary->getWords($_user_id, $searchedText);
}
else
{
    $words = $vocabulary->getWords($_user_id);
}

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

        <div class="row">
            <div class="col-3">
                <div class="d-flex flex-column flex-shrink-0 p-3 bg-light">
                    <a href="/" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto link-dark text-decoration-none">
                        <svg class="bi me-2" width="40" height="32">
                            <use xlink:href="#bootstrap"></use>
                        </svg>
                        <span class="fs-4">Sidebar</span>
                    </a>
                    <hr>
                    <ul class="nav nav-pills flex-column mb-auto">
                        <li class="nav-item">
                            <a href="#" class="nav-link link-dark" name="allWordsBtn" id="allWordsBtn" aria-current="page">
                                <svg class="bi me-2" width="16" height="16">
                                    <use xlink:href="#allWordsBtn"></use>
                                </svg>
                                All Words
                            </a>
                        </li>
                        <li>
                            <a href="#" class="nav-link link-dark" name="addNewWordBtn" id="addNewWordBtn">
                                <svg class="bi me-2" width="16" height="16">
                                    <use xlink:href="#speedometer2"></use>
                                </svg>
                                Add New Word
                            </a>
                        </li>

                        <li>
                            <a href="./logout.php" class="nav-link link-dark">
                                <svg class="bi me-2" width="16" height="16">
                                    <use xlink:href="#table"></use>
                                </svg>
                                Logout
                            </a>
                        </li>
                    </ul>
                    <hr>

                </div>
            </div>

            <div class="col-9">
                <div class="row my-5 ">
                    <div class="d-flex justify-content-center">
                        <h3>My Vocabularies</h3>
                    </div>
                </div>
                <!-- All Words Starts -->
                <div class="card mt-5 rounded-1 shadow" id="allWordsForm">
                    <form action="" method="POST">
                        <div class="card-body">
                            <table class="table">
                                <tbody>
                                    <div class="d-flex justify-content-between my-3">
                                        <div>
                                            <select class="form-select rounded-1" id="filterDropdown">
                                                <option value="all" selected>All Words</option>
                                                <option value="A">A</option>
                                                <option value="B">B</option>
                                                <option value="C">C</option>
                                                <option value="D">D</option>
                                            </select>
                                        </div>

                                        <div class="d-flex">
                                            <input type="text" class="form-control rounded-1 mx-2" name="searchbox" placeholder="search">
                                            <!-- <button class="btn btn-primary rounded-1" name="submit" value="submit">search</button> -->
                                            <input type="submit" name="submit" class="btn btn-primary rounded-1" value="search">
                                        </div>
                                    </div>
                                    <hr>
                                    <thead>
                                        <tr>
                                            <th class="col-2">Word</th>
                                            <th class="col-8">Definition</th>
                                        </tr>
                                    </thead>


                                    <?php
                                         
                                        foreach ($words as $word) 
                                        {
                                            ?>
                                                <tr class="wordRow">
                                                    <td class="col-4"><?php echo $word['word']; ?></td>
                                                    <td class="col-8"><?php echo $word['meaning']; ?></td>
                                                </tr>
                                            <?php
                                        }
                                       
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </form>
                </div>
                <!-- All Words Ends -->

                <!-- Add New Word Starts -->
                <div class="card mt-5 rounded-1 shadow d-none" id="addNewWordForm">
                    <form action="tasks.php" method="POST">
                        <div class="card-body">
                            <div class="mb-3">
                                <label for="word" class="form-label">Word</label>
                                <input type="text" name="word" class="form-control rounded-1" id="word" placeholder="word..">
                            </div>

                            <div class="mb-3">
                                <label for="meaning" class="form-label">Meaning</label>
                                <textarea class="form-control rounded-1" name="meaning" id="meaning" rows="3" placeholder="meaning.."></textarea>
                            </div>

                            <div class="mb-3">
                                <input type="hidden" name="action" value="addWord">
                                <input type="submit" class="btn btn-primary rounded-0" value="submit">
                            </div>
                        </div>
                    </form>
                </div>
                <!-- Add New Word Ends -->
            </div>
        </div>
    </div>


    
    <script src="./assets/js/script.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.slim.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</body>

</html>