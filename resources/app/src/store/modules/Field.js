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
    GET_LISTS: async (context, payload) => {
        return await api.Field.lists(payload)
    },
    GET_FILTER: async (context, payload) => {
        return await api.Field.filter(payload)
    },
    REMOVE: async (context, payload) => {
        return await api.Field.remove(payload)
    },
    SAVE: async (context, payload) => {
        return await api.Field.save(payload)
    },
    CHARS: async (context, payload) => {
        return await api.Field.chars(payload)
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
