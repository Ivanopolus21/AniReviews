<?php
    session_start();
    include_once('../php_connections/theme.php');
    global $icon;
    global $body_tag;
    include_once('../php_connections/template_connection.php');
    global $title;
    global $title;
    global $plot_rate;
    global $plot_description;
    global $humour_rate;
    global $humour_description;
    global $characters_rate;
    global $characters_description;
    global $characters_img;
    global $music_rate;
    global $music_description;
    global $animation_rate;
    global $animation_description;
    global $animation_gif;
    global $ending_rate;
    global $ending_description;
    global $total;
    global $recommended;
    global $afterwords;
    global $cite;
    global $poster;
    global $genre;
    global $more;
    global $comments;
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <link rel="icon" href="../kana_Icon.ico" type="image/x-icon">
    <link rel = 'stylesheet' href = '../template/template_style.css'>
    <script defer src = '../template/template.js'></script>
</head>
<?php echo $body_tag; ?>
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
        <li>
            <a href='index.php' >
                <h3>Main Page</h3>
            </a>
        </li>
        <li class = 'nav_border_bot'>
            <a href='rating.php'>
                <h3>Rating</h3>
            </a>
        </li>
    </ul>
</nav>

<div id="main-things">
    <header>
        <h1>
            <?php echo $title;  ?>
        </h1>
        <img src = '<?php echo $icon; ?>' id = 'switchIcon' alt = 'Theme switcher'>
    </header>
    <main>
      <ul>
          <li class = 'content' >
              <h2>Сюжет — <?php echo $plot_rate; ?>/10</h2>
              <hr class = 'horizontal_line'>
              <p><?php echo $plot_description; ?></p>
          </li>
          <li class = 'content'>
              <h2>Юмор — <?php echo $humour_rate; ?>/10</h2>
              <hr class = 'horizontal_line'>
              <p><?php echo $humour_description; ?></p>
          </li>
          <li class = 'content'>
              <h2>Персонажи — <?php echo $characters_rate; ?>/10</h2>
              <hr class = 'horizontal_line'>
                <p><?php echo $characters_description; ?></p>
              <div class = 'media_div'>
                  <img src = '<?php echo $characters_img; ?>' alt = '<?php echo $title; ?> characters' id = 'characters_poster'/>
              </div>
              <div class = 'pop-up-image'>
                  <span>&times;</span>
                  <img src = '<?php echo $characters_img; ?>' alt = '<?php echo $title; ?> characters'/>
              </div>
          </li>
          <li class = 'content'>
              <h2>Музыка — <?php echo $music_rate; ?>/10</h2>
              <hr class = 'horizontal_line'>
              <p><?php echo $music_description; ?></p>
          </li>
          <li class = 'content'>
              <h2>Рисовка — <?php echo $animation_rate; ?>/10</h2>
              <hr class = 'horizontal_line'>
              <p><?php echo $animation_description; ?></p>
              <div class = 'media_div'>
                  <img src = '<?php echo $animation_gif; ?>' alt = '<?php echo $title; ?> gif' id = 'animation_gif'>
              </div>
          </li>
          <li class = 'content' id = 'ending'>
              <h2>Концовка — <?php echo $ending_rate; ?>/10</h2>
              <hr class = 'horizontal_line'>
              <p><?php echo $ending_description; ?></p>
          </li>
          <li class = 'content'>
              <h2> Итого — <?php echo $total; ?>/10 </h2>
          </li>
      </ul>
        <div class = 'additional-things'>
            <p> <span class = 'same_titles'>Похожие аниме</span><span class="recommended">: <?php echo $recommended; ?> </span></p>
            <p class = 'afterwords'> <?php echo $afterwords; ?> </p>
            <cite> 🌟 <?php echo $cite; ?> </cite>
         </div>
        <div class="comments_form">
            <h2> Your opinion about "<?php echo $title; ?>":</h2>
            <?php if (isset($_SESSION['user'])): ?>
                <form method="post" class="form" id="form">
                    <button type="submit" name="submit" class="button opinion"> add a comment </button>
                    <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
                    <input type="hidden" name="name" value="<?php echo htmlspecialchars($_SESSION['user']); ?>">
                    <?php if (isset($_SESSION['comment_error'])) { ?>
                        <div id="php_comment_error">
                            <?php if (isset($_SESSION['comment_error'])) {
                                echo $_SESSION['comment_error'];
                                unset($_SESSION['comment_error']);
                            } ?>
                        </div>
                    <?php } ?>
                    <textarea name="comment" cols="100" rows="80" minlength="1" maxlength="5000" id="comment" class="comments_text" placeholder="Write here your comment (max length is 5000 symbols)"><?php echo (isset($_SESSION['comment_text'])) ? htmlspecialchars($_SESSION['comment_text']) : '';
                    unset($_SESSION['comment_text']); ?></textarea>
                </form>
            <?php else: ?>
                <p class="unlogged_message">You must be logged in to add a comment</p>
            <?php endif; ?>
        </div>

        <div class="all_comments">
            <h2 class="all_comment_header">Readers' comments about "<?php echo $title; ?>"</h2>
            <?php foreach ($comments as $comment): ?>
                <div class="comment">
                    <div class="username" title="your username"><?php echo $comment['username']; ?> </div>
                    <?php if (isset($_SESSION['user']) && $_SESSION['user'] == $comment['username'] || (isset($_SESSION["admin"]) && $_SESSION["admin"] == 1)) { ?>
                        <form method="post">
                            <input type="hidden" name="comment_id" value="<?php echo $comment['id']; ?>">
                            <button type = "submit" class="button delete" name = "delete" >DELETE</button >
                        </form>
                    <?php } ?>
                    <div class="opinion_comment"><?php echo htmlspecialchars($comment['comment_description']); ?></div>
                </div>

            <?php endforeach; ?>
        </div>
    </main>
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