<style lang="scss">
@import '~@/abstracts/settings';
@import '~@/abstracts/mixins';

.filter-menu {
    a {
        opacity: 0.5;
        cursor: pointer;
        @include transition(opacity 0.3s);
        &.selected {
            opacity: 1;
            pointer-events: none;
            cursor: default;
        }
    }

    button {
        cursor: pointer !important;
        pointer-events: auto !important;
        color: inherit;
        text-transform: inherit;
    }
}

</style>

<template>
    <div id="filter-menu" class="filter-menu">
        <div class="grid-container" data-sticky-container>
            <div class="sticky text-right blend" data-sticky data-top-anchor="filter-menu" data-margin-top="1.25" data-check-every="0">
                <h1>Travaux</h1>
                <div class="grid-x align-right">
                    <div class="cell shrink">
                        <router-link :class="{selected: !masterSelected}" :to="{ name: 'webxpo-2020', params: { degree: 'bachelor' }}">
                            <h1>Bachelor</h1>
                            <button type="button"><h3 style="font-weight: bold;">Filtres</h3></button>
                        </router-link>
                    </div>
                    <div class="cell shrink">
                        <div><h1>&nbsp;I&nbsp;</h1></div>
                    </div>
                    <div class="cell shrink">
                        <router-link :class="{selected: masterSelected}" :to="{ name: 'webxpo-2020', params: { degree: 'master' }}">
                            <h1>Master</h1>
                            <button type="button"><h3 style="font-weight: bold;">Filtres</h3></button>
                        </router-link>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    created () {
        this.$store.dispatch( 'loadFilters' );
    },

    computed: {
        masterSelected() {
            return this.$route.params.degree === 'master';
        }
    }
}
</script>
