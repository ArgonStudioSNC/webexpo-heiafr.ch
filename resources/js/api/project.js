import axios from 'axios';

/*
    Imports the RENDERSURFER API URL from the config.
*/
import { RENDERSURFER_CONFIG } from './config.js';

const client = axios.create({
    baseURL: RENDERSURFER_CONFIG.API_URL,
});

export default {
    /*
        GET     /api/v1/projects/{year}
    */
    all: function(year){
        return client.get(`projects/${year}`);
    },

}
