import api from './api'

export default{
    namespaced: true,
    state: {
        items: [],
    },

    getters: {
        items: state => state.items,
        itemsByKey: state => state.items.reduce((acc, cur) => {
            acc[cur.id] = cur;
            return acc;
        },{}),
    },
    mutations:{
        setItems(state, items) {
            state.items = items;
        },
        addItem(state, item) {
            state.items.push(item);
        },
        removeItem(state, idRemove) {
            state.items = state.items.filter(({ id }) => id !== idRemove);
        },

        updateItem(state, item) {
            const index = state.items.indexOf(item);
            state.items[index] = item;
        },
    },

    actions: {
        fetchItems: async ({ commit }, full_name) => {
            const response = await api.collector(full_name);
            const items = await response.json();
            commit('setItems', items);
        },
        removeItem: async ({ commit },id) => {
            const idRemove = await api.remove(id);
            commit('removeItem', idRemove);
        },
        addItem: async ({ commit }, {photo,full_name,personal_characteristic,birth_year} ) => {
            const item = await api.add({photo,full_name,personal_characteristic,birth_year});
            commit('addItem', item);
        },

        updateItem: async ({ commit }, {id,photo,full_name,personal_characteristic,birth_year}) => {
            console.log('try to update');
            const item = await api.update({id,photo,full_name,personal_characteristic,birth_year});
            commit('updateItem', item);
        }
    }
}