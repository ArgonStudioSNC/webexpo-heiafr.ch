<style lang="scss">

.filter-button {
    .filter-button-checkbox {
        position: relative;
        svg {
            position: absolute;
            margin: auto;
            top:0;
            bottom: 0;
            right: 0;
            left: 0;
            width: 0.75em;
        }
        .times {
            fill: $primary-color;
        }
    }
}

</style>

<template>
    <button class="filter-button" type="button" @click="setFilter()">
        <div style="display:inline-block;"><h3>{{ filter.name }}</h3></div>
        <div class="filter-button-checkbox" style="display:inline-block;">
            <h3>__
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 61.32 61.32" v-show="active">
                    <g><path class="times" d="M0,4.3,4.3,0,30.66,26.36,57,0l4.3,4.3L35,30.66,61.32,57,57,61.32,30.66,35,4.3,61.32,0,57,26.36,30.66Z"/></g>
                </svg>
            </h3>
        </div>
    </button>
</template>

<script>

export default {
    props: {
        degree: {
            type: String,
            required: true,
        },
        category: {
            type: String,
            required: true,
        },
        filter: {
            type: Object,
            required: true,
        },
    },

    computed: {
        active() {
            let activeFilters = this.$store.getters.getActiveFilters[this.degree][this.category];
            if (!activeFilters) return false;
            return activeFilters.some(e => e.id === this.filter.id);
        },
    },

    methods: {
        setFilter() {
            //location.hash = '#gallery';
            this.$store.commit(this.active ? 'deactivateFilter' : 'activateFilter', {
                degree: this.$route.params.degree,
                key: this.category,
                value: this.filter,
            });
        },
    },
}
</script>
