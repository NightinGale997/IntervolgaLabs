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
            state.items = state.items.filter(({id}) => id !== idRemove);
        },

        updateItem(state, item) {
            const index = state.items.indexOf(item);
            state.items[index] = item;
        },
    },

    actions: {
        fetchItems: async ({ commit },collector_id) => {
            const response = await api.harvest(collector_id);
            const items = await response.json();
            commit('setItems', items);
        },
        removeItem: async ({ commit },id) => {
            const idRemovedItem = await api.remove(id);
            commit('removeItem', idRemovedItem);
        },

        addItem: async ({ commit }, {harvest_date,collector_id,quantity,unit_of_measure} ) => {
            const item = await api.add({harvest_date,collector_id,quantity,unit_of_measure});
            commit('addItem', item);
        },

        updateItem: async ({ commit }, {id,harvest_date,collector_id,quantity,unit_of_measure}) => {
            const item = await api.update({id,harvest_date,collector_id,quantity,unit_of_measure});
            commit('updateItem', item);
        }

    }

}