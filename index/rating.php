<?php
    include_once('../php_connections/rating_connection.php');
    include_once('../php_connections/theme.php');
    global $icon;
    global $body_tag;
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../zerotwo.ico" type="image/x-icon">
    <link rel="stylesheet" href='../rating/rating.css'>
    <script defer src = '../main_page/main.js'></script>
    <link rel="icon" href="../kana_Icon.ico" type="image/x-icon">
    <title>Rating</title>
</head>
<?php echo $body_tag; ?>
    <header>
        <div id = 'top-items'>
            <h1> Rating for all reviews! </h1>
            <img src = '<?php echo $icon; ?>' id = 'switchIcon' alt = 'Theme switcher'>
            <!-- <a href ='/Main_page/index.php'><img src = '/images/zenitsu_home_trans.png' id ='homebutton' alt = 'Zenitsu home button'></a> -->
        </div>
    </header>
    <nav>
        <ul>
            <?php if( isset($_SESSION['user']) && !empty($_SESSION['user']) )
            {
                ?>
                <li class = 'nav_border_top'>
                    <a href='../php_connections/logout.php'>

                        <h3>Log out<br>
                            (<?php if( isset($_SESSION['user']) && !empty($_SESSION['user']) )
                            { echo $_SESSION['user']; }?>)</h3>
                    </a>
                </li>
            <?php }else{ ?>
                <li class = 'nav_border_top'>
                    <a href='login.php'>
                        <h3>Log in</h3>
                    </a>
                </li>
            <?php } ?>
          <li class = 'nav_border_bot'>
            <a href='index.php' >
              <h3>Main Page</h3>
            </a>
          </li>
        </ul>
    </nav>
    <div class = 'centered-main-table'>
        <table class = 'list-table'>

            <tbody>
                <tr class = 'list-table-header'>
                    <th class = 'header-title number'>N</th>
                    <th class = 'header-title image'>Image</th>
                    <th class = 'header-title name'>Name</th>
                    <th class = 'header-title rate'>Rate</th>
                    <th class = 'header-title genre'>Genres</th>
                    <th class = 'header-title more'>More</th>
                </tr>
            </tbody>

            <?php global $result; global $rows;
                while($rows = mysqli_fetch_assoc($result)){
                    ?>
                    <tbody class = 'list-item'>
                    <tr class = 'list-table-data'>
                        <td class = 'data number'><?php echo $rows['id']; ?></td>
                        <td class = 'data image'> <a href ='template.php?id=<?php echo $rows['id'];?>'><img src = '<?php echo $rows['poster']; ?>' title = '<?php echo $rows['title']; ?>' class = 'mini-title-image' alt='<?php echo $rows['title']; ?> poster' ></a></td>
                        <td class = 'data name'> <a href ="template.php?id=<?php echo $rows['id'];?>" title = 'Review'> <?php echo $rows['title']?> </a> </td>
                        <td class = 'data rate'> <?php echo $rows['total']?>/10 </td>
                        <td class = 'data genre'> <?php echo $rows['genre']?></td>
                        <td class = 'data more'> <?php echo $rows['more']?> </td>
                    </tr>
                    </tbody>
            <?php
                }
                ?>
        </table>
    </div>
    <footer>
        <div class = footer_container>
            <h2 id  = 'contact'>Contact me:</h2>
            <div id = 'sources'>
                <div class = 'socialMedia'>
                    <img src="../images/telegramicon.png" class = 'socialIcon' alt = 'Telegram icon'>
                    <a href ='https://t.me/ivanopolus21' title = 'My telegram' class ='medialink'> Telegram</a><br>
                </div>
                <div class = 'socialMedia'>
                    <img src="../images/email_icon.jpg" class = 'socialIcon' alt = 'Email icon'>
                    <a href ='mailto:i.p.yeremenko@gmail.com' title = 'My mail' class ='medialink'> E-mail</a> <br>
                </div>
                <div class = 'socialMedia'>
                    <img src="../images/discord_icon.jpg" class = 'socialIcon' alt = 'Discord icon'>
                    <a href ='https://discordapp.com/users/319395379114278912' title = 'My Discord' class ='medialink'> Discord</a> <br>
                </div>
            </div>
        </div>
        <address>Ukraine</address>
    </footer>
</body>
</html>