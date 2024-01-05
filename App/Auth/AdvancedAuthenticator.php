<?php

namespace App\Auth;

use App\Core\IAuthenticator;
use App\Models\User;
use App\Auth;

/**
 * Class DummyAuthenticator
 * Basic implementation of user authentication
 * @package App\Auth
 */
class AdvancedAuthenticator implements IAuthenticator
{
    public const LOGIN = "admin";
    public const PASSWORD_HASH = '$2y$10$GRA8D27bvZZw8b85CAwRee9NH5nj4CQA6PDFMc90pN9Wi4VAWq3yq'; // admin
    public const USERNAME = "Admin";

    /**
     * DummyAuthenticator constructor
     */
    public function __construct()
    {
        session_start();
    }

    /**
     * Verify, if the user is in DB and has his password is correct
     * @param $login
     * @param $password
     * @return bool
     * @throws \Exception
     */
    public function login($login, $password): bool
    {
        $users = User::getAll();
        foreach ($users as $user) {
            if (password_verify($password, $user->getPassword())) {
                if ($user->getLogin() == $login) {
                    $_SESSION['user'] = $login;
                    return true;
                }
            }
        }
        return false;
    }

    /**
     * Logout the user
     */
    public function logout(): void
    {
        if (isset($_SESSION["user"])) {
            unset($_SESSION["user"]);
            session_destroy();
        }
    }

    /**
     * Get the name of the logged-in user
     * @return string
     */
    public function getLoggedUserName(): string
    {
        return isset($_SESSION['user']) ? $_SESSION['user'] : throw new \Exception("User not logged in");
    }

    /**
     * Get the context of the logged-in user
     * @return string
     */
    public function getLoggedUserContext(): mixed
    {
        return null;
    }

    /**
     * Return if the user is authenticated or not
     * @return bool
     */
    public function isLogged(): bool
    {
        return isset($_SESSION['user']) && $_SESSION['user'] != null;
    }

    /**
     * Return the id of the logged-in user
     * @return int
     * @throws \Exception
     */
    public function getLoggedUserId(): int
    {
        if (!$this->isLogged()) {
            return -1;
        } else {
            $login = $this->getLoggedUserName();
            $user = User::getAll('`login` like ?', [$login]);
            return $user[0]->getId();
        }
    }

    public function isAdmin(): bool
    {
        if (!$this->isLogged()) {
            return false;
        } else {
            $login = $this->getLoggedUserName();
            $user = User::getAll('`login` like ?', [$login]);
            if ($user[0]->getRole() == 'admin') {
                return true;
            }
            else {
                return false;
            }
        }
    }
}
