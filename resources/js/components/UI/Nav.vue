<template>
    
</template>

<script>
export default {
    name: "Nav",
    methods: {
        async logout() {
            const response = await axios.get('/logout', {

            })
        }
    }
}
</script>

<style scoped>

</style>
