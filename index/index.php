<?php
    session_start();
    include_once('../php_connections/theme.php');
    global $icon;
    global $body_tag;
    include_once('../php_connections/index_connection.php');
    global $reversed_reviews;
    global $rows;
    global $num_per_page;
    global $conn;
?>


<!DOCTYPE html>
<html lang="ru">
  <head>
    <meta charset="utf-8">
    <link rel="icon" href="../zerotwo.ico" type="image/x-icon">
    <link rel="stylesheet" href="../main_page/style.css">
    <script defer src = '../main_page/main.js'></script>
    <title>AniReviews</title>
  </head>

  <?php echo $body_tag; ?>
    <div class="wrapper_body">
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
          <a href='rating.php' >
            <h3>Rating</h3>
          </a>
        </li>
      </ul>
    </nav>

    <main class="main">
      <div  class="top-items" >
        <h1> AniReviews</h1>
          <img src = '<?php echo $icon; ?>' id = 'switchIcon' alt = 'Theme switcher'>
<!--        <form>-->
<!--&lt;!&ndash;            <input type = 'button' name = 'Theme' class = 'themeSwitch' value = '        '>&ndash;&gt;-->
<!--&lt;!&ndash;            <input type="search" name="q" placeholder="Search for a review" class = 'search'>&ndash;&gt;-->
<!--&lt;!&ndash;            <input type="submit" value="Search" class = 'GObutton'>&ndash;&gt;-->
<!--        </form>-->
      </div>

        <?php
        foreach($reversed_reviews as $rows){
        ?>
      <div class = 'review'>
         <img src="<?php echo $rows['animation_gif']?>" alt = '<?php echo $rows['title']; ?> gif'>
        <div class="description">
          <a href = 'template.php?id=<?php echo $rows['id'] ?>'>
              <h2> <?php echo $rows['title']; ?> </h2>
          </a>
          <p> <?php echo $rows['preface'];?></p>
        </div>
      </div>
            <?php
        }
        ?>

        <?php
        $sql="SELECT*FROM `reviews`";
        $rs_result=mysqli_query($conn, $sql);
        $total_records=mysqli_num_rows($rs_result);
        $total_pages=ceil($total_records/$num_per_page);?>
        <div id = 'pages'>
        <?php for($i=1;$i<=$total_pages;$i++){
            echo " <a href ='index.php?page=".$i."' class='page_links'>".$i."</a> ";
        }
        ?>
        </div>
    </main>

    <footer>
        <div class = footer_container>
            <h2 id  = 'contact'>Contact me:</h2>
            <div id = 'sources'>
                <div class = 'socialMedia'>
                    <img src="../images/telegramicon.png" class = 'socialIcon' alt = 'Telegram icon'>
                    <a href ='https://t.me/ivanopolus21' title = 'My telegram' class ='medialink' target = '_blank'> Telegram</a><br>
                </div>
                <div class = 'socialMedia'>
                    <img src="../images/email_icon.jpg" class = 'socialIcon' alt = 'Email icon'>
                    <a href ='mailto:i.p.yeremenko@gmail.com' title = 'My mail' class ='medialink' target = '_blank'> E-mail</a> <br>
                </div>
                <div class = 'socialMedia'>
                    <img src="../images/discord_icon.jpg" class = 'socialIcon' alt = 'Discord icon'>
                    <a href ='https://discordapp.com/users/319395379114278912' title = 'My Discord' class ='medialink' target = '_blank'> Discord</a> <br>
                </div>
            </div>
        </div>
        <address>Ukraine</address>
    </footer>
   </div>
  </body>

</html>