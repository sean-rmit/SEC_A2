<?php
session_start();
// Include configuration file 
include_once 'config.php';

// Include database connection file 
include_once 'dbConnect.php';

if (isset($_GET["action"])) {
    if ($_GET["action"] == "delete") {
        foreach ($_SESSION["cart"] as $keys => $value) {
            if ($value["product_id"] == $_GET["id"]) {
                unset($_SESSION["cart"][$keys]);
            }
        }
    }
    else if ($_GET["action"] == "checkout") {
        foreach ($_SESSION["cart"] as $keys => $value) {
            $product_name = "";
            $product_name .= $value["item_name"];
        }
        $_SESSION["checkout_product_name"] = $product_name;
        $_SESSION["checkout_price"] = $_GET["hidden_total"];
        $_SESSION["checkout_number"] = "1";
        header("Location: checkout.php");
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Bootstrap E-Commerce Template</title>
    <!-- Bootstrap core CSS -->
    <link href="assets/css/bootstrap.css" rel="stylesheet">
    <!-- Fontawesome core CSS -->
    <link href="assets/css/font-awesome.min.css" rel="stylesheet" />
    <!--GOOGLE FONT -->
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
    <!--Slide Show Css -->
    <link href="assets/ItemSlider/css/main-style.css" rel="stylesheet" />
    <!-- custom CSS here -->
    <link href="assets/css/style.css" rel="stylesheet" />
</head>

<body>
    <nav class="navbar navbar-default" role="navigation">
        <div class="container-fluid">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#"><strong>ALICE'S</strong> E-Shop</a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">


                <ul class="nav navbar-nav navbar-right">
                    <li><a href="#">Track Order</a></li>
                    <li><a href="#">Login</a></li>
                    <li><a href="#">Signup</a></li>

                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">24x7 Support <b class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <li><a href="#"><strong>Call: </strong>+61-000-000-000</a></li>
                            <li><a href="#"><strong>Mail: </strong>info@aliceeshop.com</a></li>
                            <li class="divider"></li>
                            <li><a href="#"><strong>Address: </strong>
                                    <div>
                                        Melbourne,<br />
                                        VIC 3000, AUSTRALIA
                                    </div>
                                </a></li>
                        </ul>
                    </li>
                </ul>
                <form class="navbar-form navbar-right" role="search">
                    <div class="form-group">
                        <input type="text" placeholder="Enter Keyword Here ..." class="form-control">
                    </div>
                    &nbsp;
                    <button type="submit" class="btn btn-primary">Search</button>
                </form>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container-fluid -->
    </nav>
    <div class="container">

        <div class="row">

            <div class="col-md-9">
                <div>
                    <ol class="breadcrumb">

                        <li class="active">Computers</li>
                    </ol>
                </div>
                <!-- /.div -->
                <div class="row">
                    <div class="btn-group alg-right-pad">
                        <button type="button" class="btn btn-default"><strong>1235 </strong>items</button>
                        <div class="btn-group">
                            <button type="button" class="btn btn-danger dropdown-toggle" data-toggle="dropdown">
                                Sort Products &nbsp;
                                <span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu">
                                <li><a href="#">By Price Low</a></li>
                                <li class="divider"></li>
                                <li><a href="#">By Price High</a></li>
                                <li class="divider"></li>
                                <li><a href="#">By Popularity</a></li>
                                <li class="divider"></li>
                                <li><a href="#">By Reviews</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- /.row -->
                <div class="row">
                    <div style="clear: both"></div>
                    <h3 class="title2">Shopping Cart Details</h3>
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <tr>
                                <th width="30%">Product Image</th>
                                <th width="30%">Product Name</th>
                                <th width="10%">Quantity</th>
                                <th width="13%">Price Details</th>
                                <th width="10%">Total Price</th>
                                <th width="17%">Remove Item</th>
                            </tr>

                            <?php
                            if (!empty($_SESSION["cart"])) {
                                $total = 0;
                                foreach ($_SESSION["cart"] as $key => $value) {
                            ?>
                                    <tr>
                                        <td><img width="150" height="150" src="assets/img/<?php echo $value["product_image"]; ?>" /></td>
                                        <td><?php echo $value["item_name"]; ?></td>
                                        <td><?php echo $value["item_quantity"]; ?></td>
                                        <td>$ <?php echo $value["product_price"]; ?></td>
                                        <td>
                                            $ <?php echo number_format($value["item_quantity"] * $value["product_price"], 2); ?></td>
                                        <td><a href="Cart.php?action=delete&id=<?php echo $value["product_id"]; ?>"><span class="text-danger">Remove Item</span></a></td>

                                    </tr>
                                <?php
                                    $total = $total + ($value["item_quantity"] * $value["product_price"]);
                                }
                                ?>
                                <tr>
                                    <td colspan="3" align="right">Total</td>
                                    <th align="right">$ <?php echo number_format($total, 2); ?></th>
                                    <td></td>
                                </tr>
                            <?php
                            }
                            ?>

                        </table>
                        <div align="right">
                            <form method="post" action="cart.php?action=checkout">
                                <input type="hidden" name="hidden_total" value="<?php echo number_format($total, 2); ?>">
                                <input type="submit" name="add" style="margin-top: 5px;" class="btn btn-danger" value="Checkout Now">
                            </form>
                        </div>
                        <div class="form-group">
                            <a href="index.php">
                                << Continue Shopping</a> 
                        </div> 
                    </div> 
                </div> 
            </div> 
        </div> <!-- /.row -->

                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->
                </div>
                <!-- /.container -->


                <!--Footer -->
                <div class="col-md-12 footer-box">
                    <div class="col-md-4">
                        <strong>Our Location</strong>
                        <hr>
                        <p>
                            Swanston St, Melbourne,<br />
                            VIC 3000, Australia<br />
                            Call: +61-000-000-000<br>
                            Email: info@aliceeshop.com<br>
                        </p>

                        2020 www.aliceeshop.com | All Right Reserved
                    </div>

                </div>
                <hr>
            </div>
            <!-- /.col -->
            <div class="col-md-12 end-box ">
                &copy; 2020 | &nbsp; All Rights Reserved | &nbsp; www.aliceeshop.com | &nbsp; 24x7 support | &nbsp; Email us: info@aliceeshop.com
            </div>
            <!-- /.col -->
            <!--Footer end -->
            <!--Core JavaScript file  -->
            <script src="assets/js/jquery-1.10.2.js"></script>
            <!--bootstrap JavaScript file  -->
            <script src="assets/js/bootstrap.js"></script>
            <!--Slider JavaScript file  -->
            <script src="assets/ItemSlider/js/modernizr.custom.63321.js"></script>
            <script src="assets/ItemSlider/js/jquery.catslider.js"></script>
            <script>
                $(function() {

                    $('#mi-slider').catslider();

                });
            </script>
</body>

</html>