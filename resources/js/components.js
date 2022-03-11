// File with imported components

/**
 * Pages
 */
import Main from './views/Home'

import LoginPage from './views/Auth/LoginPage'
import RegisterPage from './views/Auth/Register'
import ResetPasswordPage from "./views/Auth/PasswordReset";
import ForgotPasswordPage from "./views/Auth/ForgotPassword";

import ProfilePage from './views/User/Profile'
import Checkout from './views/Checkout/Checkout'
import Page404 from './views/Errors/Page404'
import UsersPage from "./views/User/UsersPage";

/**
 * Components
 */

export default {

    'home': Main,

        // Auth
        'login-page': LoginPage,
        'register-page': RegisterPage,
        'reset-password-page': ResetPasswordPage,
        'forgot-password-page': ForgotPasswordPage,

        'profile-page': ProfilePage,
        'users-page': UsersPage,

        'checkout': Checkout,

        'page404': Page404,
    }
