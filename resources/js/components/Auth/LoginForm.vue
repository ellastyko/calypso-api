<template>
    <form class="col-4" method="post" action="/login" @submit.prevent="handleSubmit">
        <csrf-token/>
        <div class="form-group">
            <label for="email">Email address</label>
            <input
                v-model="form.email"
                type="email"
                class="form-control"
                id="email"
                name="email"
                aria-describedby="emailHelp"
                placeholder="Enter email"
            >
            <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
        </div>
        <div class="form-group">
            <label for="password">Password</label>
            <input
                v-model="form.password"
                type="password"
                class="form-control"
                id="password"
                name="password"
                placeholder="Password"
            >
        </div>
        <div class="form-check">
            <input type="checkbox" class="form-check-input" id="remember">
            <label class="form-check-label" for="remember">Check me out</label>
        </div>
        <button
            type="submit"
            class="btn btn-primary"
        >
            Submit
        </button>
    </form>
</template>

<script>

import { email, minLength, required } from "@vuelidate/validators";
import useVuelidate from "@vuelidate/core";
import CsrfToken from "../CsrfToken";


export default {
    name: "LoginForm",
    components: {CsrfToken},
    setup () {
        return {
            v$: useVuelidate()
        }
    },
    data() {
        return {
            form: {
                name: '',
                surname: '',
                email: '',
                password: ''
            }
        }
    },
    validations() {
        return {
            form: {
                name: { },
                surname: { },
                email: { required, email },
                password: {
                    required,
                    minLength: minLength(6),
                    containsSpecial: value => !/[#?!@$%^&*-]/.test(value)
                }
            }
        }
    },
    mounted() {

    },
    methods: {

        handleSubmit(form) {

            // this.$v.formData.$touch()
            // if (!this.$v.formData.error === false)
            //     return 0
            //
            // if (this.terms != true)
            //     return 0

            setTimeout( () => form.target.submit(), 2000)


            // axios.post(`/api/auth/login`, this.form)
            //     .then(response => {
            //         console.log(response)
            //         console.log($cookies.keys())
            //     })
            //     .catch(error => {
            //         console.log(error.response)
            //     })

        }
    }
}
</script>

<style scoped>

</style>
