<style lang="scss">
@import '~@/abstracts/settings';

.filter-category {
    margin-top: 1.2em;
    padding-bottom: 0.2em;
}
</style>

<template>
    <div class="filter-dropdown">
        <h3>
            <div class="filter-category grid-y" v-for="(cat, key) in filters" v-if="cat" track-by="key">
                <div class="cell">
                    <div style="font-weight: bold;">{{ $t('filters.' + key) }}</div>
                </div>
                <div class="cell" v-for="el in cat" :key='el.name' track-by="el.name">
                    <FilterButtonComponent :degree="degree" :category="key" :filter="el"></FilterButtonComponent>
                </div>
            </div>
        </h3>
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
            }
            return filters;
        },
    },

    methods: {
        uniqueFilter(projects, filter) {
            if (!projects) return [];
            return _.sortBy(
                _.uniqBy(projects
                    .map(p => {
                        return p[filter];
                    }), 'id'), ['slug']);
                },
            },
}
</script>
