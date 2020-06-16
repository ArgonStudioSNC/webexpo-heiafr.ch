<style lang="scss">
@import '~@/abstracts/settings';

.filter-category {
    margin-top: 2rem;
    padding-bottom: 1rem;
    @include breakpoint(large) {
        margin-top: 3rem;
        padding-bottom: 2rem;
    }
    @include breakpoint(xlarge) {
        margin-top: 5rem;
        padding-bottom: 3rem;
    }
}

</style>

<template>
    <div class="filter-dropdown">
        <div class="filter-category grid-y" v-for="(cat, key) in filters" v-if="cat" track-by="key">
            <div class="cell">
                <h3 style="font-weight: bold;">{{ $t('filters.' + key) }}</h3>
            </div>
            <div class="cell" v-for="el in cat">
                <FilterButtonComponent :degree="degree" :category="key" :filter="el"></FilterButtonComponent>
            </div>
        </div>
    </div>
</template>

<script>
import FilterButtonComponent from './Button';
import { ProjectMixins } from '../../mixins/project';

export default {
    components: {
        FilterButtonComponent,
    },

    mixins: [ProjectMixins],

    props: {
        degree: {
            type: String,
            required: true,
        },
    },

    computed: {
        filters() {
            var filters = {};
            var projects = this.getProjects(this.degree);

            if (this.degree === 'bachelor') {
                filters['workshop'] = this.uniqueFilter(projects, 'workshop');
                filters['site'] = this.uniqueFilter(projects, 'site');
            }
            else if (this.degree === 'master') {
                filters['professor'] = this.uniqueFilter(projects, 'professor');
                filters['site'] = this.uniqueFilter(projects, 'site');
            }
            return filters;
        },
    },

    methods: {
        uniqueFilter(projects, filter) {
            if (!projects) return [];
            return _.uniqBy(projects
            .map(p => {
                return p[filter];
            }), 'id')
            .sort((a, b) =>{
                return a.id - b.id;
            });
        },
    },
}
</script>
