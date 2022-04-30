<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <style>
    #ques {
        min-height: 433px;
    }
    </style>
    <title>iForum</title>
</head>

<body>
<?php include 'partials/_dbconnect.php'; ?>
    <?php include 'partials/_header.php'; ?>

    <?php 
    $id = $_GET['catid'];
    $sql =" SELECT * FROM `categories` WHERE category_id=$id ";
    $result = mysqli_query($conn, $sql);
    while($row = mysqli_fetch_assoc($result)){
        $catname = $row['category_name'];
        $catdesc = $row['category_description'];

    }
    ?>
    <?php
    $showAlert = false;
    $method = $_SERVER['REQUEST_METHOD'];
    if ( $method=='POST'){
            //insert into db 
            $th_title = $_POST['title'];
            $th_desc = $_POST['desc'];

            $th_title = str_replace("<",  "&lt;", $th_title);
            $th_title = str_replace(">", "&gt;", $th_title);

            $th_desc = str_replace("<",  "&lt;", $th_desc);
            $th_desc = str_replace(">", "&gt;", $th_desc);

            $sno = $_POST["sno"];
            $sql = " INSERT INTO `threads` ( `thread_title`, `thread_desc`, `thread_cat_id`, `thread_user_id`, `timestamp`)
             VALUES ( '$th_title', '$th_desc', '$id', '$sno', current_timestamp()) ";
            $result = mysqli_query($conn, $sql);
            $showAlert = true;
            if ($showAlert){
                echo '
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Success! </strong> Your thread has been added! please wait for community to respond 
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                ';
            }
        }
    ?>
    <div class="container my-4 py-2 pl-2 ps-2" id="ques">

        <div class="jumbotron mt-4 mb-4 bg-light py-4 pl-2 ps-2">
            <h1 class="display-4  ">Welcome to <?php echo $catname; ?> Forums </h1>
            <p class="lead"><?php echo $catdesc; ?></p>
            <hr class="my-4">
            <p>This is a peer to peer forum for sharing knowledge eith each other .</p>
            <a class="btn btn-success btn-lg" href="#" role="button">Learn more</a>
        </div>

    </div>
    <?php
    if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']==true){
    echo '<div class="container">
        <h1 class="mb-4">Start a Discussion</h1>
        <form action="'. $_SERVER['REQUEST_URI'] .'" method="post">
            <div class="mb-3">
                <label for="title" class="form-label">Thread Title </label>
                <input type="text" class="form-control" id="title" name="title" aria-describedby="title " required>
                <div id="title " class="form-text">Keep your title as crisp and short as possible.</div>
            </div>
            <input type="hidden" name="sno" value="'. $_SESSION['sno'] .'">

            <div class="mb-3">
                <label for="desc" class="form-label">Elaborate your concern </label>
                <textarea class="form-control" id="desc" name="desc" rows="3" required></textarea>
            </div>
            <button type="submit" class="btn btn-success">Submit</button>
        </form>
    </div>';
    }
    else{
        echo '<div class="container">
        <h1 class="mb-4">Start a Discussion</h1>
        <p class="lead">You are not logged in. Please login to be able to start a discussion.</p>
    </div>';
    }
    ?>
    <div class="container mb-5 ">
        <h1 class="mb-4">Browse Questions</h1>

        <?php 
        $id = $_GET['catid'];
        $sql =" SELECT * FROM `threads` WHERE thread_cat_id =$id ";
        $result = mysqli_query($conn, $sql);
        $noResult = true;
        while($row = mysqli_fetch_assoc($result)){
            $noResult = false;
            $id = $row['thread_id'];
            $title = $row['thread_title'];
            $desc = $row['thread_desc'];
            $thread_time = $row['timestamp'];
            $thread_user_id = $row['thread_user_id'];
            $sql2 = "SELECT user_email FROM `users` WHERE sno='$thread_user_id'";
            $result2 = mysqli_query($conn, $sql2);
            $row2 = mysqli_fetch_assoc($result2);
            
        // echo    '<div class="media my-3">
        //             <img src="images/udi.jpg" width="44px" alt="...">
        //             <div class="media-body">
        //             <p class="font-weight-bold my-0">Anonymous User at '. $thread_time .'</p>
        //             <h5 class="mt-0"> <a class="text-dark" href="thread.php?threadid='. $id .'">'. $title .'</a></h5>
        //             <p>'. $desc .'</p>
        //             </div>
        //         </div>';
        echo '<div class="container mt-5">
    <div class="row d-flex justify-content-center">
        <div class="col-md-8">
            <div class="headings d-flex justify-content-between align-items-center mb-3">
                <h4 class="mb-0">'. $title .'</h4>
                
            </div>
            <div class="card p-3">
                <div class="d-flex justify-content-between align-items-center">
                    <div class="user d-flex flex-row align-items-center">
                     <img src="https://i.imgur.com/hczKIze.jpg" width="30" class="user-img rounded-circle mr-2"> Asked by: 
                     <span><small class="font-weight-bold text-primary">'." ".  $row2['user_email'] .'</small> At '. $thread_time .'</span> </div>
                </div>
                <div class="action d-flex justify-content-between mt-2 align-items-center">
                    <div class="reply px-4"> <small><a class="text-dark" href="thread.php?threadid='. $id .'">'. $title .'</a></h5>
                    <p>'. $desc .'</p></small> </div>
                    <div class="icons align-items-center"> <i class="fa fa-star text-warning"></i> <i class="fa fa-check-circle-o check-icon"></i> </div>
                </div>
            </div>
            
</div>';
        }
        if($noResult){
            echo '<div class="jumbotron jumbotron-fluid">
            <div class="container bg-light">
              <h1 class="display-4">No Threads Found </h1>
              <p class="lead">Be the first person to ask the question.</p>
            </div>
          </div>' ;
        }
        ?>



    </div>
    <?php include 'partials/_footer.php'; ?>

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
    </script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    -->
</body>

</html>