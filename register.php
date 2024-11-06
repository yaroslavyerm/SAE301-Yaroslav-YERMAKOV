<?php
/* Template Name: Register */

global $register_errors;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = sanitize_user($_POST['username']);
    $first_name = sanitize_text_field($_POST['first_name']);
    $last_name = sanitize_text_field($_POST['last_name']);
    $email = sanitize_email($_POST['email']);
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    $accept_privacy_policy = isset($_POST['accept_privacy_policy']);

    if (!$accept_privacy_policy) {
        $register_errors = 'You must accept privacy policy.';
    } elseif (username_exists($username) || !validate_username($username)) {
        $register_errors = 'Username is invalid or already taken.';
    } elseif (!is_email($email) || email_exists($email)) {
        $register_errors = 'Email is invalid or already registered.';
    } elseif ($password !== $confirm_password) {
        $register_errors = 'Passwords do not match.';
    } else {
        $userdata = array(
            'user_login' => $username,
            'user_pass' => $password,
            'user_email' => $email,
            'first_name' => $first_name,
            'last_name' => $last_name,
            'role' => 'contributor'  // Assign the Contributor role
        );
        $user_id = wp_insert_user($userdata);
        
        if (is_wp_error($user_id)) {
            $register_errors = $user_id->get_error_message();
        } else {
            // Auto log in the new user
            wp_set_current_user($user_id);
            wp_set_auth_cookie($user_id);
            wp_redirect(home_url());
            exit;
        }
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
     <h1>Register</h1>
    <div class="login-wrap">
        <?php if (!empty($register_errors)): ?>
            <div class="error">
                <p><?php echo $register_errors; ?></p>
            </div>
        <?php endif; ?>
        <form method="post" class="form-connexion">
            <p class="form-p">
                <label for="username" class="form-label">Username</label>
                <input type="text" name="username" id="username" required class="form-input">
            </p>
            <p class="form-p">
                <label for="first_name" class="form-label">First Name</label>
                <input type="text" name="first_name" id="first_name" class="form-input">
            </p>
            <p class="form-p">
                <label for="last_name" class="form-label">Last Name</label>
                <input type="text" name="last_name" id="last_name" class="form-input">
            </p>
            <p class="form-p">
                <label for="email" class="form-label">Email</label>
                <input type="email" name="email" id="email" required class="form-input">
            </p>
            <p class="form-p">
                <label for="password" class="form-label">Password</label>
                <input type="password" name="password" id="password" required class="form-input">
            </p>
            <p class="form-p">
                <label for="confirm_password" class="form-label">Confirm Password</label>
                <input type="password" name="confirm_password" id="confirm_password" required class="form-input">
            </p>
            <p class="form-p">
                <input type="checkbox" name="accept_privacy_policy" id="accept_privacy_policy" required>
                <label for="accept_privacy_policy" class="form-label">I accept the <a href="http://localhost/sae301/politique-de-confidentialite">privacy policy</a></label>
            </p>
            <p class="form-p">
                <button type="submit" class="form-button">Register</button>
            </p>
        </form>
    </div>
</div>

<?php get_footer(); ?>
