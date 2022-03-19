<template>
    <section class="container">
        <div class="row justify-content-center">
            <p-autocomplete v-model="name" @complete="searchCountry($event)" field="name"/>
        </div>
    </section>
</template>

<script>
import LoginForm from "../../components/Auth/LoginForm";
import AutoComplete from 'primevue/autocomplete';

export default {

    name: "LoginPage",
    data() {
        return {
            name: '',

        }
    },
    components: {
        LoginForm,
        "p-autocomplete": AutoComplete
    },
    methods: {
        searchCountry() {
            console.log('here')
        }
    }
}
</script>

<style scoped>

</style>
