<?php

namespace App\Controllers;

use App\Config\Configuration;
use App\Core\AControllerBase;
use App\Core\Responses\Response;
use App\Core\Responses\ViewResponse;
use App\Models\User;
use App\Helpers\AuthMessage;

/**
 * Class AuthController
 * Controller for authentication actions
 * @package App\Controllers
 */
class AuthController extends AControllerBase
{
    /**
     *
     * @return Response
     */
    public function index(): Response
    {
        return $this->redirect(Configuration::LOGIN_URL);
    }

    /**
     * Login a user
     * @return Response
     */
    public function login(): Response
    {
        $formData = $this->app->getRequest()->getPost();
        $logged = null;
        if (isset($formData['submit'])) {
            $logged = $this->app->getAuth()->login($formData['login'], $formData['password']);
            if ($logged) {
                $showMess = 1;
                return $this->redirect($this->url("home.index",['showMess' => $showMess]));
            }
        }

        $data = ($logged === false ? ['message' => 'Incorrect login or password !'] : []);
        return $this->html($data);
    }

    public function register(): Response
    {
        $formData = $this->app->getRequest()->getPost();
        $logged = null;
        if (isset($formData['submit'])) {
            $user = new User();
            if ($formData['password'] != $formData['password2']) {
                $data = ['message' => 'password does not match - please repeat your password correctly',
                    'login' => $formData['login'], 'email' => $formData['email']];
                return $this->html($data);
            }
            $allUsers = User::getAll();
            foreach ($allUsers as $existsUser) {
                if ($existsUser->getLogin() == $formData['login']) {
                    $data = ['message' => 'login already exist - please select different login', 'email' => $formData['email']];
                    return $this->html($data);
                }
            }
            $hash = password_hash($formData['password'], PASSWORD_DEFAULT);
            $user->setLogin($formData['login']);
            $user->setPassword($hash);
            $user->setEmail($formData['email']);
            $user->save();
            $showMess = 3;
            return $this->redirect($this->url("home.index",['showMess' => $showMess]));
        }
        return $this->html();
    }

    /**
     * Logout a user
     * @return ViewResponse
     */
    public function logout(): Response
    {
        $this->app->getAuth()->logout();
        $showMess = 2;
        return $this->redirect($this->url("home.index",['showMess' => $showMess]));
    }
}
