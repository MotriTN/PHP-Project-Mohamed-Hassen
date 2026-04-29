<?php

declare(strict_types=1);

class AuthController extends BaseController
{
    private UserManager $userManager;

    public function __construct()
    {
        $this->userManager = new UserManager();
    }

    /**
     * Display login form or process login POST.
     */
    public function login(): void
    {
        // If already logged in, redirect to home or dashboard
        if (isset($_SESSION['user_id'])) {
            $this->redirect('/projet2/Public/index.php');
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Sanitize inputs
            $email = filter_var($_POST['email'] ?? '', FILTER_SANITIZE_EMAIL);
            $password = $_POST['password'] ?? '';

            $user = $this->userManager->findByEmail($email);

            // Verify password against the stored hash
            if ($user && password_verify($password, $user->getPasswordHash())) {
                // Prevent Session Fixation attacks
                session_regenerate_id(true); 

                // Store critical, minimal data in session
                $_SESSION['user_id'] = $user->getId();
                $_SESSION['role'] = $user->getRole();
                $_SESSION['username'] = $user->getUsername();

                // Redirect to admin if admin, else home
                if ($user->getRole() === 'admin') {
                    $this->redirect('/projet2/Public/index.php/admin/index');
                } else {
                    $this->redirect('/projet2/Public/index.php');
                }
            } else {
                // Generic error message for security
                $error = "Invalid credentials.";
                $this->render('login', ['title' => 'Login', 'error' => $error]);
            }
        } else {
            $this->render('login', ['title' => 'Sign In - Nexus']);
        }
    }

    /**
     * Secure Logout.
     */
    public function logout(): void
    {
        // Unset all session variables
        $_SESSION = array();

        // Destroy the session cookie
        if (ini_get("session.use_cookies")) {
            $params = session_get_cookie_params();
            setcookie(session_name(), '', time() - 42000,
                $params["path"], $params["domain"],
                $params["secure"], $params["httponly"]
            );
        }

        session_destroy();
        $this->redirect('/projet2/Public/index.php');
    }
}
