<!-- IS SENDING A FORM -->
<?php
If(isset($_POST['url'])) {
    // VARIABLES
    $url = $_POST['url'];

    // VERIFICATION
    if(!filter_var($url, FILTER_VALIDATE_URL)) {
        // PAS UN LIEN
        header('location: ../?error=true&message=Adresse url non valide');
        exit();
    }
	
    // SHORTCUT
    $shortcut = crypt($url, time());

    // HAS BEEN ALREADY SEND ?
   /* try {
    $bdd=new PDO('mysql:host=localhost; dbname=bitly; charset=utf8', 'root', 'root');    
    } catch(Exception $e) {
        die('Error : ' .$e ->getMessage());
    }
    $req = $bdd->prepare('SELECT COUNT(*) AS x FROM links WHERE url = ?');
    $req->execute(array($url));

    while($result = $req->fetch()){
        if($result['x'] !=0){
            header('location: ../?error=true&message=Adresse déjà raccourcie');
        }
    }*/
    // SENDING
  
}
?>

<!DOCTYPE html>
	<html>
		<head>
			<meta charset="utf-8"> 
			<title>Raccourciceur d'URL</title>
            <link rel="stylesheet" type="text/css" href="default.css"/>
            <link rel="icon" type="image/png" href="pictures/favico.png"/>
		</head>

        <body>
          
            <!-- PRÉSENTATION -->
            <section id="hello">
                <!-- CONTAINER -->
                <div class="container">
                    <!-- HEADER -->
                    <header >
                        <img src = "pictures/logo.png" alt=""logo" id="logo"></img>
                    </header>
                    <h1>Une URL longue ? Raccourcicez là !</h1>
                        <h2>Largement meilleur et plus court que les autres</h2>
                        <form method= post action="index.php"> 
                            <input type="url" name="url" placeholder="coller le lien à raccourcir">
                            <input type=submit value="Raccourcir">
                        </form>
					        </div>
                        <?php if(isset($_GET["error"]) && isset($_GET["message"])) { ?>
                            <div id="result">
                                <b><?php echo htmlspecialchars($_GET["message"]); ?></b>        
                            </div>
                        <?php } ?>
                </div>
            </section>
            <!-- BRANDS -->
            <section id="brands">
                <!-- CONTAINER-->
                <div class="container">
                    <h3>Ces marques qui nous font confiance</h3>
                    <img src=pictures/1.png alt="1" class="picture"></img>
                    <img src=pictures/2.png alt="2" class="picture"></img>
                    <img src=pictures/3.png alt="3" class="picture"></img>
                    <img src=pictures/4.png alt="4" class="picture"></img>
                </div>      
            </section>
        </body>

        <footer>
            <img src="pictures/logo2.png" alt="logo" id="logo"></img>
            <p>2018 &copy; Bitly</>
            <p><a href="#">Contact</a> - <a href="#">A propos</a></p>
        </footer>