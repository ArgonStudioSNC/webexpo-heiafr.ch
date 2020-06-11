<style lang="scss">
@import '~@/abstracts/settings';
@import '~@/abstracts/mixins';

.filter-menu {
    position: relative;

    a {
        opacity: 0.5;
        cursor: pointer;
        @include transition(opacity 0.1s ease-out);
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

    .filter-dropdown-container {
        position:absolute;
        z-index: 100;
        top:100%;
        left: 0;
        right:0;
    }

    .overlay {
        opacity: 0.8;
        position: fixed;
        z-index: 10;
        top: 0;
        left: 0;
        height: 100%;
        width: 100%;
        background-color: $body-background;
    }

    .overlay-content {
        position: relative;
        z-index: 15;
    }

    .fade-out {
        visibility: visible;
        @include transition(visibility 0s linear, opacity 0.1s ease-out);
        &.hidden {
            visibility: hidden !important;
            opacity: 0 !important;
            @include transition(visibility 0s linear 0.3s, opacity 0.1s ease-out);
        }
    }
}

</style>

<template>
    <div id="filter-menu" class="filter-menu" ref="filter-menu">
        <div class="overlay fade-out" :class="{hidden: !dropdownOpen}" @click="toggleDropdown(false)"></div>
        <div class="overlay-content grid-container blend text-right">
            <div data-sticky-container>
                <div class="sticky" data-sticky data-top-anchor="filter-menu" data-margin-top="1.25" data-check-every="0">
                    <h1>Travaux</h1>
                    <div class="grid-x align-right">
                        <div class="cell shrink" style="position:relative;">
                            <router-link :class="{selected: degree === 'bachelor'}" :to= "{path: '/' + $store.getters.getYear + '/bachelor'}" @click.native="scrollToFilters(300)">
                                <h1>Bachelor</h1>
                                <button type="button" @click="scrollToFilters(300, toggleDropdown, 'bachelor')"><h3 style="font-weight: bold;">Filtres</h3></button>
                            </router-link>
                            <div class="filter-dropdown-container fade-out" :class="{hidden: !(dropdownOpen && degree === 'bachelor')}">
                                <FilterDropDownComponent :filters="bachelorFilters"></FilterDropDownComponent>
                            </div>
                        </div>
                        <div class="cell shrink">
                            <div><h1>&nbsp;I&nbsp;</h1></div>
                        </div>
                        <div class="cell shrink" style="position:relative;">
                            <router-link :class="{selected: degree === 'master'}" :to= "{path: '/' + $store.getters.getYear + '/master'}" @click.native="scrollToFilters(300)">
                                <h1>Master</h1>
                                <button type="button" @click="scrollToFilters(300, toggleDropdown, 'master')"><h3 style="font-weight: bold;">Filtres</h3></button>
                            </router-link>
                            <div class="filter-dropdown-container fade-out" :class="{hidden: !(dropdownOpen && degree === 'master')}">
                                <FilterDropDownComponent :filters="masterFilters"></FilterDropDownComponent>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import FilterDropDownComponent from './DropDown';
import { ProjectMixins } from '../../mixins/project';

import vueSmoothScroll from 'vue2-smooth-scroll';

export default {
    components: {
        FilterDropDownComponent,
    },

    mixins: [ProjectMixins],

    data() {
        return {
            dropdownOpen: false,
        }
    },

    created () {
        this.$store.dispatch( 'loadFilters' );
    },

    computed: {
        degree() {
            var DEFAULT = 'bachelor';
            if (!this.$route.params.degree) return DEFAULT;
            return this.$route.params.degree;
        },

        bachelorFilters() {
            var filters = {};
            filters['workshops'] = this.uniqueFilter(this.bachelorProjects, 'workshop');
            filters['sites'] = this.uniqueFilter(this.bachelorProjects, 'site');
            return filters;
        },

        masterFilters() {
            var filters = {};
            filters['professors'] = this.uniqueFilter(this.masterProjects, 'professor');
            filters['sites'] = this.uniqueFilter(this.masterProjects, 'site');
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

        toggleDropdown(value) {
            let _this = this;
            if (this.dropdownOpen) {
                switch (value) {
                    case false:
                    case this.degree:
                        close();
                        break;
                    default:
                        open();
                }
            } else {
                if (value !== false) open();
            }

            function open() {
                _this.dropdownOpen = true;
                window.addEventListener('scroll', _this.eventHandler, {once: true});
                window.addEventListener('keydown', _this.eventHandler, {once: true});
            }
            function close () {
                _this.dropdownOpen = false;
            }
        },

        eventHandler(e) {
            switch(e.type) {
                case 'scroll':
                    this.toggleDropdown(false);
                    break;
                case 'keydown':
                    if (e.keyCode=="27") this.toggleDropdown(false);
                    break;
                default:
            }
        },

        scrollToFilters(t, callback = null) {
            var offset = document.getElementById('gallery').offsetTop;
            var degree = arguments[2];
            if (window.scrollY < offset) {
                if (typeof callback == 'function') {
                    $('html, body').animate({scrollTop: offset}, t)
                    .promise().then(function() {
                        callback(degree);
                    });
                } else {
                    $('html, body').animate({scrollTop: offset}, t);
                }
            } else if (typeof callback == 'function') callback(degree);
        },
    },
}
</script>
