/*
|-------------------------------------------------------------------------------
| VUEX store/index.js
|-------------------------------------------------------------------------------
| Builds the data store from all of the modules for the Rendersurfer app.
*/
import { createStore } from 'vuex'

/*
    Imports all of the modules used in the application to build the data store.
*/
import { filters } from '@/modules/filters.js'
import { projects } from '@/modules/projects.js'

export default createStore({
    modules: {
        filters,
        projects
    }
});
