import Api from '/src/api/index.js';
class Harvests extends Api{
    harvest = (collector_id) => {
        if(collector_id) {
            return this.rest('/harvest/list_filtered.json',{
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({collector_id}),
            });
        }
        return this.rest("/harvest/list.json");
    }

    remove = (id) => this.rest('/harvest/delete', {
        method: 'POST',
        'Content-Type': 'application/json',
        body: JSON.stringify({id}),
    }).then(() => id);
    add = (harvest) => this.rest('/harvest/add', {
        method: 'POST',
        'Content-Type': 'application/json',
        body: JSON.stringify({harvest}),
    }).then(() => harvest);

    update = (harvest) => this.rest('/harvest/update', {
        method: 'POST',
        'Content-Type': 'application/json',
        body: JSON.stringify({harvest}),
    }).then(() => harvest);
}

export default new Harvests();