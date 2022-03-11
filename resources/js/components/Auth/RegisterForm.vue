<template>
    <form class="col-4">
        <div class="form-group">
            <label for="email">Email address</label>
            <input
                v-model="form.email"
                type="email"
                class="form-control"
                id="email"
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
                placeholder="Password"
            >
        </div>
        <div class="form-group">
            <label for="password_confirmation">Repeat Password</label>
            <input
                v-model="form.password_confirmation"
                type="password"
                class="form-control"
                id="password_confirmation"
                placeholder="Password"
            >
        </div>
        <div class="form-check">
            <input type="checkbox" class="form-check-input" id="remember">
            <label class="form-check-label" for="remember">Check me out</label>
        </div>
        <button
            @submit.prevent="handleSubmit"
            type="submit"
            class="btn btn-primary"
        >
            Submit
        </button>
    </form>
</template>

<script>
import useVuelidate from '@vuelidate/core'
import { required, email, sameAs, minLength } from '@vuelidate/validators'

export default {

    name: "RegisterForm",
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
                password: '',
                password_confirmation: '',
            },
            terms: false
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
                },
                password_confirmation: {
                    sameAsPassword: sameAs('password')
                },
            }
        }
    },
    methods: {

        handleSubmit() {

            // this.$v.formData.$touch()
            // if (!this.$v.formData.error === false)
            //     return 0
            //
            // if (this.terms != true)
            //     return 0

            axios.post(`/register`, this.form)
                .then(response => {

                    console.log(response)
                })
                .catch(error => {

                })

        }
    }
}
</script>

<style scoped>

</style>
