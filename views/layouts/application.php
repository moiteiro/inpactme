<!DOCTYPE html>
<html>
    <head>	
        <title>Soccer Startup Championship</title>
        
        <meta name="author" content="Bruno Moiteiro">
        <meta http-equiv="content-language" content="pt-br">
        
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <meta name="description" content="" /> 
        <meta name="keywords" content="" /> 
        
        <!--Com essa tag nada será indexado-->
        <meta name="robots" content="noindex,nofollow">
        
        <!--Styles-->
            <!--Skeleton-->
        <link href="<?php echo WEBSITE ?>/design/stylesheets/base.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo WEBSITE ?>/design/stylesheets/skeleton.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo WEBSITE ?>/design/stylesheets/layout.css" rel="stylesheet" type="text/css" />

            <!--Application-->
        <link href="<?php echo WEBSITE ?>/design/stylesheets/style.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo WEBSITE ?>/design/stylesheets/chosen.css" rel="stylesheet" type="text/css" />

        
        <!--Scripts-->
        <script type='text/javascript' data-main='<?php echo PUBLIC_PATH.DS.'scripts'.DS.'boot' ?>'  src='<?php echo PUBLIC_PATH.DS.'scripts'.DS.'libs'.DS.'require.js' ?>' >
        </script>


    </head>
    
    <body>
        <div id='wrapper'>
            <header >
                <div id='logo_wrapper'>
                    
                </div>

                <nav id='menu'>
                    <ul class='container'>
                        <li >
                            <a href="#clubs" id='menu-item-clubs'>Clubs</a>
                        </li>
                        <li >
                            <a href="#players" id='menu-item-players' >Players</a>
                        </li>
                        <li >
                            <a href="#matches" id='menu-item-matches' >Matches</a>
                        </li>

                    </ul>

                </nav>
            </header>

            <div class='container'>
            <?php 
    		
    		if(file_exists(VIEW_PATH.DS.$route_app->controller.DS.$route_app->view.".php"))
    			include(VIEW_PATH.DS.$route_app->controller.DS.$route_app->view.".php");
    		?>
            </div>
        </div>
    </body>
</html>