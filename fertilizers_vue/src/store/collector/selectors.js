export const fetchItems = (store, full_name) => {
    const {dispatch} = store;
    dispatch('collector/fetchItems', full_name);
}

export const selectItems = (store) => {
    const {getters} = store;
    return getters['collector/items'];
}

export const removeItem = (store,id) => {
    const {dispatch} = store;
    dispatch('collector/removeItem', id);
}

export const selectItemsById = (store,id) => {
    const {getters} = store;
    return getters['collector/itemsByKey'][id] || {};
}

export const updateItem = (store, {id,photo,full_name,personal_characteristic,birth_year}) => {
    const {dispatch} = store;
    dispatch('collector/updateItem', {id,photo,full_name,personal_characteristic,birth_year});
}

export const addItem = (store, {photo,full_name,personal_characteristic,birth_year}) => {
    const {dispatch} = store;
    dispatch('collector/addItem', {photo,full_name,personal_characteristic,birth_year});
}