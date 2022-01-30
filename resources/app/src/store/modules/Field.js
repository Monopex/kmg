import api from '@/api'

const name = 'Field'

const namespaced = true

const state = {

}

const getters = {
    STATE: state => {
        return state
    }
}

const mutations = {

}

const actions = {
    GET_LISTS: async (context) => {
        return await api.Field.lists()
    },
}

export default {
    name,
    namespaced,
    state,
    getters,
    mutations,
    actions
}
