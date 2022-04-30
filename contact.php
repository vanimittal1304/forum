<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <title>iForum</title>
</head>

<body>
<?php include 'partials/_dbconnect.php'; ?>
    <?php include 'partials/_header.php'; ?>
    <?php
            $showAlert = false;
            $method = $_SERVER['REQUEST_METHOD'];
            if ( $method=='POST'){
                    //insert into db 
                    //$sno = $_POST["con_id"];
                    $conname = $_POST["f_name"];
                    $consname = $_POST["s_name"];
                    $email = $_POST["email"];
                    $message = $_POST["message"];
                    $sql = " INSERT INTO `contacts` (`f_name`, `s_name`, `email`, `message`, `timestamp`)
                     VALUES ( '$conname', '$consname', '$email', '$message', current_timestamp()); ";
                    $result = mysqli_query($conn, $sql);
                    $showAlert = true;
                    if ($showAlert){
                        echo '
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <strong>Success! </strong> Your message has been sent! please wait for community to respond 
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        ';
                    }
                    
                }
            ?>

    <!--Form starts here -->
    
    <div class="container-fluid m-auto mt-md-5 bg-light">
        <div class="row ">
            <div
                class="col-md-6 box-shadow: rgba(0, 0, 0, 0.4) 0px 2px 4px, rgba(0, 0, 0, 0.3) 0px 7px 13px -3px, rgba(0, 0, 0, 0.2) 0px -3px 0px inset">
                <div class="mt-2 mb-5 text-center">
                    <h1 class="service_heading ">Contact Us</h1>
                </div>
                <?php
                if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']==true){
                 echo    
                '<form action="'. $_SERVER['REQUEST_URI'] .'" method="post">
                    <div class="name row g-3 ">
                        <div class="col">
                            <label for="f_name" class="form-label">First Name</label>
                            <input type="text" name = "f_name" class="form-control" placeholder="First name" aria-label="First name">
                        </div>
                        <div class="col">
                            <label for="s_name" class="form-label">Last Name</label>
                            <input type="text" name = "s_name" class="form-control" placeholder="Last name" aria-label="Last name">
                        </div>
                    </div>
                    <div class="email mb-3 mt-3">
                        <label for="email" class="form-label">Email address</label>
                        <input type="email" name="email" class="form-control" id="email" aria-describedby="emailHelp">
                        <div id="emailHelp" class="form-text">We\'ll never share your email with anyone else.</div>
                    </div>
                    <div class="message mb-3">
                        <label for="message" class="form-label">Message</label>
                        <input type="textarea" name = "message" class="form-control" id="message">
                    </div>
                    <div class="details mb-3">
                        <label for="details" class="form-label">Additional Details</label>
                        <textarea class="form-control" name="details" id="details" rows="3"></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary mb-3">Send Message</button>
                </form>';
                }
                else{
                    echo '<div class="container">
                    
                    <p class="lead">You are not logged in. Please login to be able to Contact Us.</p>
                </div>';
                }
                ?>
            </div>
            
            <div class="col-md-6">
                <h1 class="mt-5">How Can We Help?</h1>
                <p class="mt-4">
                    please select a topic below related to your inquiry. If you don't find what you need, fill out our
                    contact form.
                </p>
                <div class="accordion accordion-flush mt-4 mb-4" id="accordionFlushExample">
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="flush-headingOne">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#flush-collapseOne" aria-expanded="false"
                                aria-controls="flush-collapseOne">
                                Have a suggestion ?
                            </button>
                        </h2>
                        <div id="flush-collapseOne" class="accordion-collapse collapse"
                            aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                            <div class="accordion-body">Lorem ipsum dolor sit amet consectetur adipisicing elit. Necessitatibus quasi architecto, at non eos sapiente temporibus ea officia est accusantium?</div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="flush-headingTwo">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#flush-collapseTwo" aria-expanded="false"
                                aria-controls="flush-collapseTwo">
                                Want to join us?
                            </button>
                        </h2>
                        <div id="flush-collapseTwo" class="accordion-collapse collapse"
                            aria-labelledby="flush-headingTwo" data-bs-parent="#accordionFlushExample">
                            <div class="accordion-body">Lorem ipsum dolor sit amet consectetur adipisicing elit. Reiciendis doloremque molestias ratione laboriosam ea odit ducimus autem placeat, voluptatem similique facilis praesentium eligendi molestiae assumenda harum labore hic pariatur illo ad quisquam ipsam. Cumque deleniti, et porro consequatur voluptates dignissimos tempora laudantium, optio incidunt nihil exercitationem ex. Eaque, ullam exercitationem.</div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="flush-headingThree">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#flush-collapseThree" aria-expanded="false"
                                aria-controls="flush-collapseThree">
                                Become a partner
                            </button>
                        </h2>
                        <div id="flush-collapseThree" class="accordion-collapse collapse"
                            aria-labelledby="flush-headingThree" data-bs-parent="#accordionFlushExample">
                            <div class="accordion-body">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Itaque, ipsum excepturi. Quas ut eos tempora excepturi laboriosam, nam sit quidem cumque, minima consectetur consequuntur non unde nobis accusamus ducimus exercitationem!</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--Form starts here -->

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