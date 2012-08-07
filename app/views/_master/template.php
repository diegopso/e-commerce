<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <title>Coruja</title>
        <meta http-equiv="Content-Type" content="text/html; charset=<?= charset ?>" ></meta>
        <link rel="stylesheet" type="text/css" href="~/media/css/bootstrap.css"></link>
        <link rel="stylesheet" type="text/css" href="~//media/css/app.css"></link>
        
        
        <script type="text/javascript" src="~/media/js/jquery-1.7.2.min.js"></script>
        <script type="text/javascript" src="~/media/js/bootstrap.min.js"></script>
        <script type="text/javascript" src="~/media/js/helper.js"></script>
        
        <?= head ?>
    </head>
    <body>
        <div class="container">

            <!-- Menu -->
            <div class="navbar navbar-fixed-top">
                <div class="navbar-inner">
                    <div class="container">
                        <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </a>
                        <a class="brand" href="~/home">Coruja</a>
                        <div class="nav-collapse">
                            <ul class="nav">
                                <li class="active">
                                    <a href="~/home">Dashboard</a>
                                </li>
                                <li class="dropdown">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                        Loja
                                        <b class="caret"></b>
                                    </a>
                                    <ul class="dropdown-menu">
                                        <li>
                                            <a href="~/produtos">
                                                <i class="icon-th-large"></i>
                                                Produtos
                                            </a>
                                        </li>
                                        <li>
                                            <a href="~/categorias">
                                                <i class="icon-tags"></i>
                                                Categorias
                                            </a>
                                        </li>
                                        <li>
                                            <a href="~/pedidos">
                                                <i class="icon-shopping-cart"></i>
                                                Pedidos
                                            </a>
                                        </li>
                                        <li>
                                            <a href="~/promocoes">
                                                <i class="icon-gift"></i>
                                                Promoções
                                            </a>
                                        </li>
                                        <li>
                                            <a href="~/estoque">
                                                <i class="icon-th-list"></i>
                                                Estoque
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                                <?php if(Modules::is_set('conteudos')): ?>
                                <li class="">
                                    <a href="<?= site_url ?>conteudos">Conteúdos</a>
                                </li>
                                <?php endif; ?>
                                <li class="">
                                    <a href="~/home/relatorios">Relatórios</a>
                                </li>
                                <li class="">
                                    <a href="~/home/social">Social</a>
                                </li>
                                <li class="dropdown">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                        Layout
                                        <b class="caret"></b>
                                    </a>
                                    <ul class="dropdown-menu">
                                        <li>
                                            <a href="~/home/banners">
                                                <i class="icon-flag"></i>
                                                Banners
                                            </a>
                                        </li>
                                        <li>
                                            <a href="~/home/tema">
                                                <i class="icon-fullscreen"></i>
                                                Tema
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                            </ul>

                            <ul class="nav pull-right">
                                <li class="dropdown">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                        My store
                                        <b class="caret"></b>
                                    </a>
                                    <ul class="dropdown-menu">
                                        <li>
                                            <a href="~/home/banners">
                                                <i class="icon-off"></i>
                                                Sair
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                        </div><!-- /.nav-collapse -->
                    </div>
                </div><!-- /navbar-inner -->
            </div>
        </div>

        <div class="content container">
            <?= flash ?>
            <?= content ?>
        </div>

        <div class="footer">
            <div class="container">
                <div class="row">
                    <div class="span5">
                        <img src="~/app/wwwroot/media/img/coruja-logo.png" />
                    </div>
                    <div class="span2 offset1">
                        <h3>Span 2</h3>
                        <p>
                            <a href="#">Link</a>
                        </p>
                        <p>
                            <a href="#">Link</a>
                        </p>
                        <p>
                            <a href="#">Link</a>
                        </p>
                    </div>
                    <div class="span2">
                        <h3>Span 2</h3>
                        <p>
                            <a href="#">Link</a>
                        </p>
                        <p>
                            <a href="#">Link</a>
                        </p>
                        <p>
                            <a href="#">Link</a>
                        </p>
                    </div>
                    <div class="span2">
                        <h3>Span 2</h3>
                        <p>
                            <a href="#">Link</a>
                        </p>
                        <p>
                            <a href="#">Link</a>
                        </p>
                        <p>
                            <a href="#">Link</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>