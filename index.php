<?php
// IF RECEIVED SHORTCUT
if(isset($_GET['q'])){

    // VARIABLE
    $shortcut = htmlspecialchars($_GET['q']);

    // IS A SHORTCUT
    $bdd = new PDO('mysql:host=localhost; dbname=bitly; charset=utf8', 'root', 'root'); 
    
    $req = $bdd->prepare('SELECT COUNT(*) AS x FROM links WHERE shortcut = ?');
    $req->execute(array($shortcut));

    while($result = $req->fetch()){  // tant qu'il y a une nouvelle ligne, affiche la moi dan sma variables result
        if($result['x'] !=1){
            header('location: ./?error=true&message=Adresse url non connue');
            (exit);
        }
    }
}

// REDIRECTION - A revoir, erreur
/* $req = $bdd->prepare('SELECT * FROM links WHERE shortcut = ?');
$req->execute(array($shortcut));

while($result = $req->fetch()){

    header('location: '.$result['url']);
    exit();
} */

// IS SENDING A FORM
if(isset($_POST['url'])) {

    // VARIABLE
    $url = $_POST['url'];

    // VERIFICATION
    if(!filter_var($url, FILTER_VALIDATE_URL)) {
        // NOT A LINK 
        header('location: ./?error=true&message=Adresse url non valide'); 
        exit();
    }
	
    // SHORTCUT
    $shortcut = crypt($url, rand());

    // HAS BEEN ALREADY SEND ?
   try {
    $bdd = new PDO('mysql:host=localhost; dbname=bitly; charset=utf8', 'root', 'root');    
    } catch(Exception $e) {
        die('Error : '.$e ->getMessage());
    }
    $req = $bdd->prepare('SELECT COUNT(*) AS x FROM links WHERE url = ?');
    $req->execute(array($url));

    while($result = $req->fetch()){
        if($result['x'] !=0){
            header('location: ./?error=true&message=Adresse déjà raccourcie');
            exit();
        }
    }

    // SENDING
    $req = $bdd->prepare('INSERT INTO links(url,shortcut) VALUES(?,?)');
    $req->execute(array($url, $shortcut));

    header('location: ./?short='.$shortcut);
    exit();
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

                    <h1>Une URL longue ? Raccourcissez là !</h1>

                        <h2>Largement meilleur et plus court que les autres</h2>

                        <form method= post action="index.php"> 
                            <input type="url" name="url" placeholder="coller le lien à raccourcir">
                            <input type=submit value="Raccourcir">
                        </form>

                        <!-- return error message or short url -->
                        <?php if(isset($_GET["error"]) && isset($_GET["message"])) { ?>
                            <div class="result">
                                <b><?php echo htmlspecialchars($_GET["message"]); ?></b>        
                            </div>
                        <?php } else if(isset($_GET['short'])) { ?>
                            <div class="result">
                                <b>URL raccourci :</b>
                                http://localhost/?q=<?php echo htmlspecialchars($_GET["short"]); ?>       
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