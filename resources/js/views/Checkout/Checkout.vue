<template>
    <div>
        Checkout
    </div>
</template>

<script>
import { mapActions, mapGetters, mapMutations } from 'vuex'

export default {

    name: 'Checkout',
    components: { },
    mounted() {

    },
    filters: {  },
    computed: {
        ...mapGetters(['profile/getProfile']),
    },
    data() {
        return {

        }
    },
    methods: {

    }
}
</script>

<style scoped lang="scss">

</style>
