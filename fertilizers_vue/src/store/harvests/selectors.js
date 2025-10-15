export const fetchItems = (store,collector_id) => {
    const {dispatch} = store;
    dispatch('harvests/fetchItems',collector_id);
}

export const selectItems = (store) => {
    const {getters} = store;
    return getters['harvests/items'];
}

export const removeItem = (store,id) => {
    const {dispatch} = store;
    dispatch('harvests/removeItem', id);
}

export const selectItemsById = (store,id) => {
    const {getters} = store;
    return getters['harvests/itemsByKey'][id] || {};
}

export const updateItem = (store, {id,harvest_date,collector_id,quantity,unit_of_measure}) => {
    const {dispatch} = store;
    dispatch('harvests/updateItem', {id,harvest_date,collector_id,quantity,unit_of_measure});
}

export const addItem = (store, {harvest_date,collector_id,quantity,unit_of_measure}) => {
    const {dispatch} = store;
    dispatch('harvests/addItem', {harvest_date,collector_id,quantity,unit_of_measure});
}