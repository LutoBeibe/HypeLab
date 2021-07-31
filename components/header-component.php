<header id="header"><!--header-->
    <div class="header_top"><!--header_top-->
        <div class="container">
            <div class="row">
                <div class="col-sm-6">
                    <?php website::website_navTop() ?>
                </div>
                <div class="col-sm-6">
                    <div class="shop-menu clearfix pull-right">
                        <ul class="nav navbar-nav">
                            <?php website::website_navLogin(); ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div><!--/header_top-->

    <div class="header-middle"><!--header-middle-->
        <div class="container">
            <div class="row">
                <div class="col-md-4 clearfix">
                    <div class="logo pull-left">
                        <a href="inicio"><img src="images/home/logo-secondary.png" alt="<?php echo titulo; ?> Logo" /></a>
                    </div>
                </div>
                <div class="clearfix">
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                    </div>
                    <div class="mainmenu pull-left">
                        <ul class="nav navbar-nav collapse navbar-collapse">
                            <li><a href="inicio">Página Inicial</a></li>
                            <li class="dropdown"><a href="#">Confira<i class="fa fa-angle-down"></i></a>
                                <ul role="menu" class="sub-menu">
                                    <li><a href="shop.html">Todos Produtos</a></li>
                                    <li><a href="product-details.html">Produtos Recentes</a></li> 
                                    <li><a href="product-details.html">Produtos Recomendados</a></li> 
                                    <li><a href="">Produtos Exclusivos</a></li>
                                    <li><a href="">Tênis</a></li>
                                </ul>
                            </li> 
                            <li><a href="">Masculino</a></li>
                            <li><a href="">Feminino</a></li>
                        </ul>
                    </div>
                </div>

                <div class="col-sm-3">
                    <div class="search_box pull-right">
                        <input type="text" placeholder="O que deseja?"/>
                    </div>
                </div>
            </div>
        </div>
    </div><!--/header-middle-->

    <!-- <div class="header-bottom">
        <div class="container">
            <div class="row">
                <div class="col-sm-9">
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                    </div>
                    <div class="mainmenu pull-left">
                        <ul class="nav navbar-nav collapse navbar-collapse">
                            <li><a href="inicio">Página Inicial</a></li>
                            <li class="dropdown"><a href="#">Confira<i class="fa fa-angle-down"></i></a>
                                <ul role="menu" class="sub-menu">
                                    <li><a href="shop.html">Todos Produtos</a></li>
                                    <li><a href="product-details.html">Product Recentes</a></li> 
                                    <li><a href="product-details.html">Product Recomendados</a></li> 
                                    <li><a href="checkout.html">Checkout</a></li> 
                                    <li><a href="cart.html">Cart</a></li> 
                                    <?php // website::website_navLogin(); ?> 
                                </ul>
                            </li> 
                            <li class="dropdown"><a href="#">Blog<i class="fa fa-angle-down"></i></a>
                                <ul role="menu" class="sub-menu">
                                    <li><a href="blog.html">Blog List</a></li>
                                    <li><a href="blog-single.html">Blog Single</a></li>
                                </ul>
                            </li> 
                            <li><a href="404.html">404</a></li>
                            <li><a href="contact-us.html">Contact</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="search_box pull-right">
                        <input type="text" placeholder="O que deseja?"/>
                    </div>
                </div>
            </div>
        </div>
    </div> -->
</header><!--/header-->