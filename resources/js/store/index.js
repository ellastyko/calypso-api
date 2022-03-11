import { createStore } from 'vuex'

import user from './modules/user'
import post from "./modules/post";
import categories from "./modules/categories";

export default new createStore({

    modules: {
        user,
        post,
        categories
    },
    strict: process.env.NODE_ENV !== 'production'
})
