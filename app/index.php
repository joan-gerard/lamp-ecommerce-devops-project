<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="theme-color" content="#6366f1">

        <title>NovaMart — Tech Store</title>

        <link rel="icon" href="img/favicon.png" type="image/png" />
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="vendors/font-awesome/css/font-awesome.min.css">
        <link rel="stylesheet" href="vendors/wow-js/animate.css">
        <link href="css/style.css" rel="stylesheet">
    </head>
    <body>
        <header class="main_header_area">
            <nav class="navbar navbar-default navbar-fixed-top menu_bg" id="main_navbar">
                <div class="container-fluid searchForm">
                    <form action="#" class="row">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-search"></i></span>
                            <input type="search" name="search" class="form-control" placeholder="Search products…">
                            <span class="input-group-addon form_hide"><i class="fa fa-times"></i></span>
                        </div>
                    </form>
                </div>
                <div class="container">
                    <div class="row">
                        <div class="col-md-2 p0">
                            <div class="navbar-header">
                                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                                    <span class="sr-only">Toggle navigation</span>
                                    <span class="icon-bar"></span>
                                    <span class="icon-bar"></span>
                                    <span class="icon-bar"></span>
                                </button>
                                <a class="navbar-brand brand-text" href="index.php">
                                    <span class="brand-name">Nova<span>Mart</span></span>
                                </a>
                            </div>
                        </div>

                        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                            <div class="col-md-9 p0">
                                <ul class="nav navbar-nav main_nav">
                                    <li><a href="#product-list">Shop</a></li>
                                    <li><a href="#">Electronics</a></li>
                                    <li><a href="#">Wearables</a></li>
                                    <li><a href="#">Deals</a></li>
                                </ul>
                            </div>
                            <div class="col-md-1 p0">
                                <ul class="nav navbar-nav navbar-right">
                                    <li><a href="#" class="nav_searchFrom" aria-label="Search"><i class="fa fa-search"></i></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </nav>
        </header>

        <section class="slider_area row m0">
            <div class="slider_inner">
                <div class="camera_caption">
                    <span class="hero-badge wow fadeInUp animated">New arrivals every week</span>
                    <h2 class="wow fadeInUp animated" data-wow-delay="0.1s">Premium tech,<br>effortlessly delivered</h2>
                    <h5 class="wow fadeIn animated" data-wow-delay="0.25s">Curated gadgets and accessories from trusted brands — shipped fast, priced fairly.</h5>
                    <div class="hero-actions wow fadeIn animated" data-wow-delay="0.4s">
                        <a class="learn_mor" href="#product-list">Shop collection</a>
                        <a class="learn_mor learn_mor--ghost" href="#product-list">View deals</a>
                    </div>
                </div>
            </div>
        </section>

        <section class="features-bar">
            <div class="features-grid">
                <div class="feature">
                    <i class="fa fa-truck"></i>
                    <div>
                        <strong>Free shipping</strong>
                        <span>On orders over $50</span>
                    </div>
                </div>
                <div class="feature">
                    <i class="fa fa-shield"></i>
                    <div>
                        <strong>Secure checkout</strong>
                        <span>256-bit encryption</span>
                    </div>
                </div>
                <div class="feature">
                    <i class="fa fa-refresh"></i>
                    <div>
                        <strong>Easy returns</strong>
                        <span>30-day guarantee</span>
                    </div>
                </div>
            </div>
        </section>

        <section class="products-section row">
            <div class="section-header" id="product-list">
                <div class="check_tittle wow fadeInUp" data-wow-delay="0.2s">
                    <h4>Catalog</h4>
                    <h2>Featured products</h2>
                </div>
                <p class="section-meta wow fadeInUp" data-wow-delay="0.3s">Hand-picked items from our inventory. Prices and availability update in real time.</p>
            </div>
            <div class="it_works">
              <?php
                        function loadEnv($path) {
                            if (!file_exists($path)) {
                                return false;
                            }

                            $lines = file($path, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
                            foreach ($lines as $line) {
                                if (strpos(trim($line), '#') === 0) {
                                    continue;
                                }

                                list($name, $value) = explode('=', $line, 2);
                                putenv(trim($name) . '=' . trim($value));
                            }

                            return true;
                        }

                        loadEnv(__DIR__ . '/.env');

                        $dbHost = getenv('DB_HOST');
                        $dbUser = getenv('DB_USER');
                        $dbPassword = getenv('DB_PASSWORD');
                        $dbName = getenv('DB_NAME');

                        $link = mysqli_connect($dbHost, $dbUser, $dbPassword, $dbName);

                        if ($link) {
                        $res = mysqli_query($link, "select * from products;");
                        while ($row = mysqli_fetch_assoc($res)) { ?>

                <article class="product-card wow fadeInUp" data-wow-delay="0.1s">
                    <div class="product-card__media">
                        <?php echo '<img src="img/' . $row['ImageUrl'] . '" alt="' . htmlspecialchars($row['Name']) . '" loading="lazy">' ?>
                    </div>
                    <div class="product-info">
                        <h3 class="product-name"><a href="#"><?php echo $row['Name'] ?></a></h3>
                        <p class="product-desc">In stock · Free delivery available</p>
                        <div class="product-footer">
                            <span class="product-price">$<?php echo $row['Price'] ?></span>
                            <button type="button" class="product-btn">Add to cart</button>
                        </div>
                    </div>
                </article>

                <?php
                        }
                    }
                    else {
                ?>
                <div class="error-content">
                    <h1>Database connection error</h1>
                    <p>
                    <?php
                          echo mysqli_connect_errno() . ":" . mysqli_connect_error();
                    ?>
                    </p>
                </div>
                <?php
                    }
                  ?>
            </div>
        </section>

        <footer class="footer_area row">
            <div class="container custom-container">
                <div class="footer-grid">
                    <div class="footer-brand">
                        <span class="brand-name">Nova<span>Mart</span></span>
                        <p>Your destination for quality tech. Simple shopping, reliable service.</p>
                    </div>
                    <div class="footer-col">
                        <h5>Shop</h5>
                        <ul>
                            <li><a href="#">Electronics</a></li>
                            <li><a href="#">Wearables</a></li>
                            <li><a href="#">Accessories</a></li>
                            <li><a href="#">Deals</a></li>
                        </ul>
                    </div>
                    <div class="footer-col">
                        <h5>Support</h5>
                        <ul>
                            <li><a href="#">Help center</a></li>
                            <li><a href="#">Shipping info</a></li>
                            <li><a href="#">Returns</a></li>
                            <li><a href="#">Contact</a></li>
                        </ul>
                    </div>
                </div>
                <div class="copy_right_area">
                    <p class="copy_right">© <?php echo date('Y'); ?> NovaMart. All rights reserved.</p>
                </div>
            </div>
        </footer>

        <script src="js/jquery-1.12.4.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <script src="vendors/wow-js/wow.min.js"></script>
        <script src="js/theme.js"></script>
    </body>
</html>
