<template>

</template>

<script>
import {mapActions} from "vuex";

export default {
    name: "Post",
    computed: {

    },
    methods: {
        ...mapActions('post', 'getPost'),

    }
}
</script>

<style scoped>

</style>
