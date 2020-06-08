/*
|-------------------------------------------------------------------------------
| VUEX modules/projects.js
|-------------------------------------------------------------------------------
| The Vuex data store for the projecting of projects
*/
import STATE from "../mixins/loadingState";
import ProjectAPI from '../api/project.js';

export const projects = {
    /*
    Defines the state being monitored for the module.
    */
    state: {
        year: null,
        projects: [],
        projectsLoadStatus: STATE.INIT,
    },

    /*
    Defines the actions used to retrieve the data.
    */
    actions: {
        /*
        Loads the projects from the API
        */
        loadProjects( { commit }, year ){
            commit( 'setYear', null );
            commit( 'setProjectsLoadStatus', STATE.LOADING );
            ProjectAPI.all(year)
            .then( function( response ){
                commit( 'setYear', year );
                commit( 'setProjects', response.data);
                commit( 'setProjectsLoadStatus', STATE.SUCCESS );
            })
            .catch( function(){
                commit( 'setProjects', [] );
                commit( 'setProjectsLoadStatus', STATE.ERROR );
            });
        },
    },

    /*
    Defines the mutations used
    */
    mutations: {
        /*
        Sets the projects load status
        */
        setProjectsLoadStatus( state, status ){
            state.projectsLoadStatus = status;
        },

        /*
        Sets the projects
        */
        setProjects( state, projects){
            state.projects = projects;
        },

        /*
        Sets the year
        */
        setYear( state, year){
            state.year = year;
        },
    },

    /*
    Defines the getters used by the module
    */
    getters: {
        /*
        Returns the projects load status.
        */
        getProjectsLoadStatus( state ){
            return state.projectsLoadStatus;
        },

        /*
        Returns the projects.
        */
        getProjects( state ){
            return state.projects;
        },

        /*
        Returns the year.
        */
        getYear( state ){
            return state.year;
        },
    },
}
