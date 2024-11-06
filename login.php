<?php /* Template Name: Login */ ?>

<?php global $login_errors;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $creds = array();
    $creds['user_login'] = $_POST['log'];
    $creds['user_password'] = $_POST['pwd'];
    $creds['remember'] = isset($_POST['remember']) ? true : false;

    $user = wp_signon($creds, false);

    if (is_wp_error($user)) {
        $login_errors = $user->get_error_message();
    } else {
        wp_redirect(home_url());
        exit;
    }
}

get_header(); ?>

<div class="hero_top hero_top_profil">
    <!-- logo -->
    <a href="http://localhost/sae301/">
        <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 48 48" fill="none">
            <path fill-rule="evenodd" clip-rule="evenodd" d="M28.174 18.7798L19.8297 27.125L16.6037 23.899L25.4816 15.0164L30.8453 15L48 32.1547L47.9051 32.2505H41.6446L28.174 18.7798ZM19.826 29.8511L28.1703 21.5068L31.3963 24.7319L22.5184 33.6154L17.1547 33.6309L0 16.4762L0.0948834 16.3813H6.35536L19.826 29.8511Z" fill="#ECE8E0"/>
        </svg>
    </a>
    <!-- menu icon -->
    <button class="hero_button" aria-controls="menu" @click="menuIsOpen = true">
        <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 32 32" fill="none">
            <path d="M4 9.33334H28" stroke="#ECE8E0" stroke-width="1.5" stroke-linecap="round"/>
            <path d="M4 16H28" stroke="#ECE8E0" stroke-width="1.5" stroke-linecap="round"/>
            <path d="M4 22.6667H28" stroke="#ECE8E0" stroke-width="1.5" stroke-linecap="round"/>
        </svg>
    </button>
</div>

<div class="main">
<h1>Connexion</h1>
    <div class="login-wrap">
    
        <?php if (!empty($login_errors)): ?>
            <div class="error">
                <p><?php echo $login_errors; ?></p>
            </div>
        <?php endif; ?>
        <form method="post" class="form-connexion">
            <p class="form-p">
                <label for="username" class="form-label">Nom dutilisateur ou Email</label>
                <input type="text" name="log" id="username" required class="form-input">
            </p>
            <p class="form-p">
                <label for="password" class="form-label">Mot de passe</label>
                <input type="password" name="pwd" id="password" required class="form-input">
            </p>
            <p class="form-check">
                <input type="checkbox" name="remember" id="remember" class="form-checkbox">
                <label for="remember" class="form-label">Se souvenir de moi</label>
            </p>
            <p class="form-p">
                <button type="submit" class="form-button">Connexion</button>
            </p>
        </form>
    </div>
</div>

<?php get_footer(); ?>
