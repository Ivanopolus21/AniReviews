<?php
/**
 * Initialize variable that determine the appearance of the body element
 * @var $body_tag
 */
$body_tag = '<body>';
/**
 * Initialize variable that determine the icon that toggles the themes
 * @var $icon
 */
$icon = '../images/dark_theme.jpg';
/**
 * Determines the appearance of the body element and the theme toggle icon
 * based on the value of the "theme" cookie
 */
if (isset($_COOKIE['theme'])) {
    if ($_COOKIE['theme'] === 'dark') {
        $body_tag = '<body class="dark-theme">';
        $icon = '../images/light_theme.jpg';

    } elseif ($_COOKIE['theme'] === 'light') {
        $body_tag = '<body>';
        $icon = '../images/dark_theme.jpg';
    }
}