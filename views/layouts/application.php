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
        <link href="<?php echo WEBSITE ?>/design/stylesheets/style.css" rel="stylesheet" type="text/css" />
        
        <!--Scripts-->
        <script type='text/javascript' data-main='<?php echo PUBLIC_PATH.DS.'scripts'.DS.'boot' ?>'  src='<?php echo PUBLIC_PATH.DS.'scripts'.DS.'libs'.DS.'require.js' ?>' >
        </script>


    </head>
    
    <body>

        <header>
            <nav>
                <ul>
                    <li>
                        <a href="#index">Home</a>
                    </li>
                    <li>
                        <a href="#players">Players</a>
                    </li>
                    <li>
                        <a href="#player/1">Player-1</a>
                    </li>
                    <li>
                        <a href="#teams">Teams</a>
                    </li>
                    <li>
                        <a href="#matchs">Matchs</a>
                    </li>

                </ul>

            </nav>
        </header>

        <?php 
		
		if(file_exists(VIEW_PATH.DS.$route_app->controller.DS.$route_app->view.".php"))
			include(VIEW_PATH.DS.$route_app->controller.DS.$route_app->view.".php");
		?>
        
    </body>
</html>