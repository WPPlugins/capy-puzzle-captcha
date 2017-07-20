<?php
/*
Plugin Name: Capy Puzzle CAPTCHA
Plugin URI: https://www.capy.me/
Description: Prevent spams with hassle free captcha.
Version: 1.0
Author: Capy Inc.
Author URI: https://www.capy.me/
License: GPL2
License URI:
*/

// Show

function capy_puzzle_captcha_show_login() {
    $captchakey = get_option('capy_puzzle_captcha_captchakey');
    include 'capy-puzzle-captcha-show-login.html.php';
}

add_action('login_form', 'capy_puzzle_captcha_show_login');

// Verify

function capy_puzzle_captcha_verify_login($user, $password) {
    require_once 'capy-puzzle-captcha-utilities.php';

    $privatekey = get_option('capy_puzzle_captcha_privatekey');
    $challengekey = $_REQUEST['capy_challengekey'];
    $answer = $_REQUEST['capy_answer'];
    $result = capy_puzzle_captcha_verify($privatekey, $challengekey, $answer);

    if ($result[0]) {
        return $user;
    } else {
        return new WP_Error('capy_puzzle_captcha_error', "<strong>{$result[1]}</strong>");
    }
}

add_filter('wp_authenticate_user', 'capy_puzzle_captcha_verify_login', 10, 2);

// Edit setting

function capy_puzzle_captcha_menu() {
    add_menu_page(
        'Capy Puzzle CAPTCHA',
        'Edit Capy Puzzle CAPTCHA',
        'administrator',
        'capy_puzzle_captcha',
        'capy_puzzle_captcha_edit_setting'
    );
}

add_action('admin_menu', 'capy_puzzle_captcha_menu');

function capy_puzzle_captcha_edit_setting() {
    if (isset($_POST['capy_puzzle_captcha_privatekey'])) {
        update_option('capy_puzzle_captcha_privatekey', $_POST['capy_puzzle_captcha_privatekey']);
    }
    if (isset($_POST['capy_puzzle_captcha_captchakey'])) {
        update_option('capy_puzzle_captcha_captchakey', $_POST['capy_puzzle_captcha_captchakey']);
    }
    $privatekey = get_option('capy_puzzle_captcha_privatekey');
    $captchakey = get_option('capy_puzzle_captcha_captchakey');
    include 'capy-puzzle-captcha-edit-setting.html.php';
}
?>
