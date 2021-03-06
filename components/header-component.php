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
                        <a href="inicio"><img src="images/home/logo-black-2.png" alt="<?php echo titulo; ?> Logo" /></a>
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
                                    <li><a href="recentes">Recentes</a></li> 
                                    <li><a href="recomendados">Recomendados</a></li> 
                                    <li><a href="">Exclusivos</a></li>
                                    <li><a href="">Tênis</a></li> 
                                </ul>
                            </li> 
                            <li><a href="genero/m">Masculino</a></li>
                            <li><a href="genero/f">Feminino</a></li>
                        </ul>
                    </div>
                </div>

                <div class="col-sm-3">
                    <div class="search_box pull-right">
                        <form method="POST" action="inicio">
                            <input 
                                type="text" 
                                value="<?php 
                                    echo isset($_POST['searchString']) && $_POST['typeSearch'] == 'productName'
                                        ? urldecode($_POST['searchString']) 
                                        : '';
                                ?>" 
                                name="searchString" 
                                placeholder="O que deseja?"
                            />
                            <button type="submit" class="btn btn-default"></button>

                            <input type="hidden" name="typeSearch" value="productName">
                        </form>

                        <?php website::website_pesquisa();?>
                    </div>
                </div>
            </div>
        </div>
    </div><!--/header-middle-->
</header><!--/header-->

<script>
    window.onload = setContactMessage();

    function setContactMessage() {
        const date = new Date();
        const currentHour = date.getHours();

        if (currentHour >= 5 && currentHour <= 11) {
            $('#contact-message').html('Bom dia')
        } else if (currentHour < 19) {
            $('#contact-message').html('Boa tarde')
        } else {
            $('#contact-message').html('Boa noite')
        }
    }
</script>
