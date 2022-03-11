

export default {

    namespaced: true,
    state: () => ({
        user: null
    }),
    getters: {
        getUser(state) {
            return state.user
        },
    },
    mutations: {
        SET_USER(state, payload) {
            state.user = payload
        }
    },
    actions: {
        async updateUser({commit}, payload) {

            const response = await axios.patch(
                `api / users / ${this.state.user.id}`,
                {
                    payload
                },
                {
                    headers: {}
                }
            )
            if (response.status === 200) {
                commit('SET_PROFILE', response.data)
            }
        },
        async logout({commit}) {
            const response = await axios.get('/logout', {

            })
            if (response.status === 200) {
                commit('SET_PROFILE', null)
            }
        }
    }
}
