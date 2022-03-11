<template>
    <section class="container ">
        <div class="row justify-content-center">
            <RegisterForm/>
        </div>
    </section>
</template>

<script>
import RegisterForm from "../../components/Auth/RegisterForm";

export default {

    name: "Register",
    components: {
        RegisterForm
    },
}
</script>

<style scoped>

</style>
