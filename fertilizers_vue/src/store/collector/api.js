import Api from '/src/api/index.js';
class Collector extends Api{
    collector = (full_name) => {
        if(full_name) {
            return this.rest('/collector/list_filtered.json',{
                method: 'POST',
                'Content-Type': 'application/json',
                body: JSON.stringify({full_name}),
            });
        }

        return this.rest("/collector/list.json");
    }


    add = (collector) => {
        const formData = new FormData();
        Object.keys(collector).forEach(key => {
            formData.append(key, collector[key]);
        });

        return this.rest('/collector/add-item', {
            method: 'POST',
            body: formData,
        }).then(res => res.json());
    }

    update = (collector) => {
        const formData = new FormData();
        Object.keys(collector).forEach(key => {
            formData.append(key, collector[key]);
        });

        return this.rest('/collector/update-item', {
            method: 'POST',
            body: formData,
        }).then(res => res.json());
    }

    remove = (id) => this.rest('/collector/delete-item', {
        method: 'POST',
        'Content-Type': 'application/json',
        body: JSON.stringify({id}),
    }).then(() => id);
}

export default new Collector();