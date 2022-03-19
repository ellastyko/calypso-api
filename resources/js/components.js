// File with imported components

/**
 * Pages
 */
import HomePage from './views/Home/HomePage'

import LoginPage from './views/Auth/LoginPage'
import RegisterPage from './views/Auth/RegisterPage'
import ResetPasswordPage from "./views/Auth/PasswordResetPage";
import ForgotPasswordPage from "./views/Auth/ForgotPasswordPage";

import ProfilePage from './views/User/ProfilePage'
import Checkout from './views/Checkout/CheckoutPage'
import Page404 from './views/Errors/Page404'
import UsersPage from "./views/User/UsersListPage";
import PostsListPage from "./views/Post/PostsListPage";

/**
 * Components
 */
export default {

        'home-page': HomePage,

        // Auth
        'login-page': LoginPage,
        'register-page': RegisterPage,
        'reset-password-page': ResetPasswordPage,
        'forgot-password-page': ForgotPasswordPage,

        'profile-page': ProfilePage,
        'users-list-page': UsersPage,

        'posts-list-page': PostsListPage,

        'checkout-page': Checkout,

        'page404': Page404,
    }
