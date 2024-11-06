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

<div class="main">
     <h2>Register</h2>
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
