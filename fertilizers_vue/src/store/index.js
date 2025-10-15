import {createStore} from 'vuex';
import collector from './collector';
import harvests from './harvests';
export default createStore(
    {
        modules: {
            collector,
            harvests,
        },
        state:{},
        mutations:{},
        actions:{},
    }
)