export default {

    namespaced: true,
    state: () => ({
        post: null
    }),
    getters: {
        getPost(state) {
            return state.post
        },
    },
    mutations: {
        SET_POST(state, payload) {
            state.user = payload
        }
    },
    actions: {
        async updatePost({commit}, payload) {

            const response = await axios.patch(
                `api / posts / ${this.state.user.id}`,
                {
                    payload
                },
                {
                    headers: {}
                }
            )
            if (response.status === 200) {
                commit('SET_POST', response.data)
            }
        }
    }
}
