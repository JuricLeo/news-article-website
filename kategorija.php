<?php
    session_start();
    include 'connect.php';
    define('UPLPATH', 'images/');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>L'Obs - kategorija</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <header>
        <h1>L'OBS</h1>
        <nav>
            <a href="index.php">NASLOVNICA</a>
            <a href="kategorija.php?id=politika">POLITIKA</a>
            <a href="kategorija.php?id=nekretnine">NEKRETNINE</a>
            <a href="unos.php">UNOS</a>
            <?php
                if (isset($_SESSION['username']) && $_SESSION['level'] == 1) {
                    echo '<a href="administracija.php">ADMINISTRACIJA</a>';
                    echo '<a href="logout.php">ODJAVA</a>'; 
                } else if (isset($_SESSION['username']) && $_SESSION['level'] == 0) {
                    echo '<a href="logout.php">ODJAVA</a>';
                } else {
                    echo '<a href="login.php">PRIJAVA</a>';
                }
            ?>
        </nav>
    </header>

    <main>
        <?php

            $id = $_GET['id'];
            $query = "SELECT * FROM vijesti WHERE kategorija = $id";

        ?>

        <section>
            <h2><?php echo $id ?></h2>
            <div class="articles">
            <?php

                $query = "SELECT * FROM vijesti WHERE arhiva=0 AND kategorija='$id'";
                $result = mysqli_query($dbc, $query);

                while($row = mysqli_fetch_array($result)) {
                    echo '<article>';
                        echo '<img src="' . UPLPATH . $row['slika'] . '">';
                        echo '<div>';
                            echo '<h3>';
                                echo '<a href="clanak.php?id='.$row['id'].'">';
                                    echo $row['naslov'];
                                echo '</a>';
                            echo '</h3>';
                            echo '<p>';
                                echo "Napisano: " . $row['datum'];
                            echo '</p>';
                        echo '</div>';
                    echo '</article>';
                }
                
            ?>
            </div>
        </section>
    </main>
    
    <footer>
        <p>©L'Obs - Brandovi ili sadržaji na web stranici nouvelobs.com su pod zaštitom intelektualnog vlasništva</p>
    </footer>

</body>
</html>