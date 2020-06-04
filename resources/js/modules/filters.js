/*
|-------------------------------------------------------------------------------
| VUEX modules/filters.js
|-------------------------------------------------------------------------------
| The Vuex data store for the filtering of projets
*/

export const filters = {
    /*
    Defines the state being monitored for the module.
    */
    state: {
        degree: 'bachelor',
    },

    /*
    Defines the actions used to retrieve the data.
    */
    actions: {
        /*
        Sets the degree to Bachelor
        */
        setBachelor( { commit } ){
            commit( 'setDegree', 'bachelor');
        },

        /*
        Sets the degree to Master
        */
        setBachelor( { commit } ){
            commit( 'setDegree', 'master');
        },
    },

    /*
    Defines the mutations used
    */
    mutations: {
        /*
        Sets the degree filter
        */
        setDegree( state, val){
            state.degree = val;
        },
    },

    /*
    Defines the getters used by the module
    */
    getters: {
        /*
        Returns the degree
        */
        getDegree( state ){
            return state.degree;
        },
    },
}
