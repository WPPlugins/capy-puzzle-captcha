<div class="wrap">
    <h2>Capy Puzzle CAPTCHA</h2>
    <p>Before you use this plugin, you need to sign up for capy.me.<br /><a href="https://www.capy.me/signup/">Capy - Sign up</a></p>
    <p>Please get your private key and a capthca key which you want to use.</>
    <form action="" method="post">
        <table class="form-table">
            <tr>
                <th><label for="capy_puzzle_captcha_privatekey">Your Private Key</label></th>
                <td><input type='text' id="capy_puzzle_captcha_privatekey" name='capy_puzzle_captcha_privatekey' value="<?php echo isset($privatekey) ? $privatekey : '' ?>" /></td>
            </tr>
            <tr>
                <th><label for="capy_puzzle_captcha_captchakey">Puzzle CAPTCHA Key</label></th>
                <td><input type='text' id="capy_puzzle_captcha_captchakey" name='capy_puzzle_captcha_captchakey' value="<?php echo isset($captchakey) ? $captchakey : '' ?>" /></td>
            </tr>
        </table>
        <p><input type='submit' class="button-primary" value="Save" /></p>
    </form>
</div>
