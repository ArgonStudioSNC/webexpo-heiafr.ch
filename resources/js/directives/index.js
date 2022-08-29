/*
|-------------------------------------------------------------------------------
| directives/index.js
|-------------------------------------------------------------------------------
| Custom Vue3 directives
*/

const foundation = {
    mounted: (el) => {
        console.log("FOUNDATION INIT");
        el.foundation();
    },
    beforeUnmount: (el) => el.foundation.destroy()
}

export default {
    directives: {
        // enables v-foundation in template
        foundation
    }
}
