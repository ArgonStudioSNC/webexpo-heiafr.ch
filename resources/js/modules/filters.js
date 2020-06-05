/*
|-------------------------------------------------------------------------------
| VUEX modules/filters.js
|-------------------------------------------------------------------------------
| The Vuex data store for the filtering of projects
*/
import STATE from "../mixins/loadingStates";
import FilterAPI from '../api/filter.js';

export const filters = {
    /*
    Defines the state being monitored for the module.
    */
    state: {
        filters: [],
        filtersLoadStatus: STATE.INIT,
    },

    /*
    Defines the actions used to retrieve the data.
    */
    actions: {
        /*
        Loads the filters from the API
        */
        loadFilters( { commit } ){
            commit( 'setFiltersLoadStatus', STATE.LOADING );
            FilterAPI.all()
            .then( function( response ){
                commit( 'setFilters', response.data);
                commit( 'setFiltersLoadStatus', STATE.LOADED );
            })
            .catch( function(){
                commit( 'setFilters', [] );
                commit( 'setFiltersLoadStatus', STATE.ERROR );
            });
        },
    },

    /*
    Defines the mutations used
    */
    mutations: {
        /*
        Sets the filters load status
        */
        setFiltersLoadStatus( state, status ){
            state.filtersLoadStatus = status;
        },

        /*
        Sets the filters
        */
        setFilters( state, filters){
            state.filters = filters;
        },
    },

    /*
    Defines the getters used by the module
    */
    getters: {
        /*
        Returns the filters load status.
        */
        getFiltersLoadStatus( state ){
            return state.filtersLoadStatus;
        },

        /*
        Returns the filters.
        */
        getFilters( state ){
            return state.filters;
        },
    },
}
