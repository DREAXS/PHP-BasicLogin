<?php
session_start();

// Oturum kontrolü
if (!isset($_SESSION['adi'])) {
    header("Location: index.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Anasayfa</title>
    <style>
        body {
            font-family: Verdana, Geneva, sans-serif;
            background-color: #4f4f4f;
            color: #ffffff;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .container {
            text-align: center;
            max-width: 400px;
            margin: auto;
            padding: 20px;
        }
        .buton {
            background-color: #ffffff;
            color: black;
            border: none;
            padding: 10px 20px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin: 5px;
            cursor: pointer;
            border-radius: 5px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            transition: background-color 0.3s;
        }
        .buton:hover {
            background-color: #cdc1c5;
            color: black; /* Buton  yazı rengi */
            font-weight: bold;
            font-style: italic;
        }
        .textbox {
            border: 2px solid;
            border-radius: 4px;
            box-shadow: 3px 3px 3px #000;
            padding: 8px;
            margin-bottom: 10px;
            width: 100%;
            box-sizing: border-box; /* Kutu modelini düzgün hale getir */
        }
        fieldset {
            background-color: #708090;
            border: none;
            border-radius: 10px;
            box-shadow: 3px 3px 4px #000;
        }
        legend {
            color: #fff;
            font-size: 18px;
            font-weight: bold;
            margin-bottom: 10px;
        }
        .avatar {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            object-fit: cover;
            margin-bottom: 10px;
        }
        .logout-icon {
            vertical-align: middle;
            margin-right: 5px;
        }
        
    </style>
</head>
<body>
    <div class="container">
        <fieldset>
            <legend>Hoşgeldin <?php echo htmlspecialchars($_SESSION['adi']); ?></legend>
            <img src="" alt="Profil Fotoğrafı" class="avatar">
            <br><br>
            <b>Şifreniz: <?php echo htmlspecialchars($_SESSION['sifre']); ?></b><br><br>
            
            <form method="post">
                <input class="buton" type="submit" value="Çıkış Yap" name="cikis">
                <a href="profile.php" class="buton">Profil Düzenle</a>
            </form>
        </fieldset>
    </div>

    <?php 
    if (isset($_POST['cikis'])) {
        session_destroy();
        header("Location: index.php");
        exit; // Çıkış yapıldıktan sonra kodun devamını çalıştırmamak için exit kullanıyoruz.
    }
    ?>
</body>
</html>
