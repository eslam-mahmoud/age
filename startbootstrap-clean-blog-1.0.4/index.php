<?php
    function get_life_expectancy($country) {
        return 69;
    }
    function get_dates($dob, $country) {
        try {
            //get his date of birth
            $dob_opj = new DateTime(date("Y-m-d", strtotime($dob)));
            $now = new DateTime();
            //get how many days you lived
            $diff_dob = $now->diff($dob_opj)->days;
            
            //get the life expectancy by countries
            $life_expectancy = get_life_expectancy($country);
            $date = date('Y-m-d', strtotime(date("Y-m-d") .' -'.$life_expectancy.' years'));
            $life_expectancy = new DateTime($date);
            $diff_life = $now->diff($life_expectancy)->days;
            
            $result = array('days_lived'=>$diff_dob, 'life_expectancy'=>$diff_life);
            return $result;
        } catch (Exception $e) {
            var_dump($e);
        }
    }
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Clean Blog - Sample Post</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/clean-blog.min.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="http://maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href='http://fonts.googleapis.com/css?family=Lora:400,700,400italic,700italic' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css'>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <style type="text/css">
        .heart_img {
            margin: 1px;
        }
    </style>

</head>

<body>

    <!-- Navigation -->
    <nav class="navbar navbar-default navbar-custom navbar-fixed-top">
        <div class="container-fluid">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header page-scroll">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.html">Your Life in Weeks</a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-right">
                    <li>
                        <a href="index.html">Home</a>
                    </li>
                    <li>
                        <a href="about.html">About</a>
                    </li>
                    <li>
                        <a href="post.html">Sample Post</a>
                    </li>
                    <li>
                        <a href="contact.html">Contact</a>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>

    <!-- Page Header -->
    <!-- Set your background image for this header on the line below. -->
    <header class="intro-header" style="background-image: url('img/post-bg.jpg')">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
                    <div class="post-heading">
                        <h1>Your Life in Weeks</h1>
                        <!-- <h2 class="subheading">Inspired by Tim Urban TED talk</h2> -->
                        <!-- <span class="meta">Posted by <a href="#">Start Bootstrap</a> on August 24, 2014</span> -->
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- Post Content -->
    <article>
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
                    <form action="./index.php" method="post">
                        <h3>See your Life in Weeks</h3>
                        <div class="row control-group">
                            <div class="form-group col-xs-4 floating-label-form-group controls">
                                <label>Birthday</label>
                                <input value="<?php echo isset($_POST['birthday'])?$_POST['birthday']:''; ?>" type="text" class="form-control" placeholder="Birthday" id="birthday" name="birthday" required data-validation-required-message="Please enter your birthday.">
                                <p class="help-block text-danger"></p>
                            </div>
                            <div class="col-xs-1">
                            </div>
                            <div class="form-group col-xs-5 floating-label-form-group controls">
                                <label>Country</label>
                                <input value="<?php echo isset($_POST['country'])?$_POST['country']:''; ?>" type="text" class="form-control" placeholder="Country" id="country" name="country" required data-validation-required-message="Please enter your country.">
                                <p class="help-block text-danger"></p>
                            </div>
                            <div class="form-group col-xs-1">
                                <input type="submit" class="btn btn-default" value="Send" />
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="row">
                <?php 
                    if ($_POST) {
                        $result = get_dates($_POST['birthday'], $_POST['country']);
                        echo 'You already spend <b>'.round($result['days_lived']/$result['life_expectancy']*100,2).'%</b> of your life';
                        for ($i=0; $i < $result['life_expectancy']/7; $i++) {
                            if ($i < $result['days_lived']/7) echo '<img class="heart_img red_heart_img" src="./img/Heart_Red.png" />';
                            else echo '<img class="heart_img green_heart_img" src="./img/Heart_Green.png" />';
                        }
                    }
                ?>
                <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
                    <h3 class="subheading">Inspired by Tim Urban TED talk</h3>
                    <iframe width="100%" height="525" src="https://www.youtube.com/embed/arj7oStGLkU" frameborder="0" allowfullscreen></iframe>
                </div>
            </div>
        </div>
    </article>

    <hr>

    <!-- Footer -->
    <footer>
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
                    <ul class="list-inline text-center">
                        <li>
                            <a href="#">
                                <span class="fa-stack fa-lg">
                                    <i class="fa fa-circle fa-stack-2x"></i>
                                    <i class="fa fa-twitter fa-stack-1x fa-inverse"></i>
                                </span>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <span class="fa-stack fa-lg">
                                    <i class="fa fa-circle fa-stack-2x"></i>
                                    <i class="fa fa-facebook fa-stack-1x fa-inverse"></i>
                                </span>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <span class="fa-stack fa-lg">
                                    <i class="fa fa-circle fa-stack-2x"></i>
                                    <i class="fa fa-github fa-stack-1x fa-inverse"></i>
                                </span>
                            </a>
                        </li>
                    </ul>
                    <p class="copyright text-muted">Created with <span aria-hidden="true" class="glyphicon glyphicon-heart"></span> by <a target="_blank" href="http://eslam.me">Eslam Mahmoud</a></p>
                </div>
            </div>
        </div>
    </footer>

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="js/clean-blog.min.js"></script>

</body>

</html>
