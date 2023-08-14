<style lang="scss">
@import '@sass/_mixins';

.filter-menu {
    position: relative;

    .filter-header {
        margin-bottom: 0.25rem;
        @include breakpoint(large) {
            margin-bottom: 1rem;
        }
        opacity: 0.5;
        cursor: pointer;
        @include transition(opacity 0.1s ease-out);
        &.selected {
            opacity: 1;
            pointer-events: none;
            cursor: default;
        }
    }

    .lighten {
        opacity: 1;
        @include transition(opacity 0.1s ease-out);
        &-on {
            opacity: 0.5;
        }
    }

    button {
        cursor: pointer !important;
        pointer-events: auto !important;
        color: inherit;
        text-transform: inherit;
    }

    .filter-dropdown-container {
        position: absolute;
        top: 100%;
        right: 0;
    }

    .overlay-container {
        .overlay-content {
            &.sticky {
                z-index: 15 !important;
            }
        }
        .overlay-background {
            &.sticky {
                z-index: 10 !important;
            }
            &>div {
                isolation: isolate;
                position: absolute;
                z-index: 10 !important;
                height: 100vh;
                width: 100%;
                opacity: 0.8;
                background-color: $body-background;
            }
        }
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

    .data-text {
        text-align: left;
        padding-top: 1.2em;

        overflow-y: scroll;
        /* Hide scrollbar for IE, Edge and Firefox */
        -ms-overflow-style: none;  /* IE and Edge */
        scrollbar-width: none;  /* Firefox */
        /* Hide scrollbar for Chrome, Safari and Opera */
        &::-webkit-scrollbar {
            display: none;
        }
    }
}

</style>

<template>
    <div id="filter-menu" class="filter-menu" ref="filter-menu">
        <div class="overlay-container">
            <div style="position: abolute;">
                <div data-sticky-container>
                    <div class="overlay-background sticky" data-resize data-sticky data-sticky-on="small" data-top-anchor="filter-menu" data-margin-top="0" data-check-every="0">
                        <div class="fade-out" :class="{hidden: !tab}" @click="toggleDropdown(false)"></div>
                    </div>
                </div>
            </div>
            <div class="grid-container text-right">
                <div data-sticky-container>
                    <div class="overlay-content sticky blend" ref="headerSection" data-resize data-sticky data-sticky-on="small" data-top-anchor="filter-menu" data-margin-top="0" data-check-every="0">
                        <div style="height: 1.6rem"></div>
                        <h1>Travaux</h1>
                        <div class="grid-x align-right">
                            <div class="cell shrink" style="position:relative;">
                                <div class="filter-header" :class="{selected: pageDegree === 'bachelor'}">
                                    <router-link :to="{path: '/' + $store.getters.getYear + '/bachelor'}" @click.native="scrollToFilters(300)">
                                        <h1>Bachelor</h1>
                                        <div class="grid-x align-right">
                                            <button class="cell shrink lighten" :class="{'lighten-on': degree==='bachelor' && tab && tab !== Tabs.Data}" type="button" @click="scrollToFilters(300, toggleDropdown, 'bachelor', Tabs.Data)">
                                                <h3 style="font-weight: bold;">Donnee</h3>
                                            </button>
                                            <h3 class="cell shrink" style="font-weight: bold;">&nbsp;&nbsp;I&nbsp;&nbsp;</h3>
                                            <button class="cell shrink lighten" :class="{'lighten-on': degree==='bachelor' && tab && tab !== Tabs.Filters}" type="button" @click="scrollToFilters(300, toggleDropdown, 'bachelor', Tabs.Filters)">
                                                <h3 style="font-weight: bold;">Filtres</h3>
                                            </button>
                                        </div>
                                    </router-link>
                                </div>
                                <div class="filter-dropdown-container fade-out" :class="{hidden: !(degree === 'bachelor')}">
                                    <FilterDropDownComponent degree='bachelor' v-show="tab === Tabs.Filters"></FilterDropDownComponent>
                                    <h3 class="data-text" :style="{'max-height': `calc(100vh - ${headerSectionHeight}px)`}" v-show="tab === Tabs.Data"><span v-html="$t('filters.data-bachelor-'+$store.getters.getYear)"></span></h3>
                                </div>
                            </div>
                            <div class="cell shrink">
                                <div><h1>&nbsp;I&nbsp;</h1></div>
                            </div>
                            <div class="cell shrink" style="position:relative;">
                                <div class="filter-header" :class="{selected: pageDegree === 'master'}">
                                    <router-link :to= "{path: '/' + $store.getters.getYear + '/master'}" @click.native="scrollToFilters(300)">
                                        <h1>Master</h1>
                                        <div class="grid-x align-right">
                                            <button class="cell shrink lighten" :class="{'lighten-on': degree==='master' && tab && tab !== Tabs.Data}" type="button" @click="scrollToFilters(300, toggleDropdown, 'master', Tabs.Data)">
                                                <h3 style="font-weight: bold;">Donnee</h3>
                                            </button>
                                            <h3 class="cell shrink" style="font-weight: bold;">&nbsp;&nbsp;I&nbsp;&nbsp;</h3>
                                            <button class="cell shrink lighten" :class="{'lighten-on': degree==='master' && tab && tab !== Tabs.Filters}" type="button" @click="scrollToFilters(300, toggleDropdown, 'master', Tabs.Filters)">
                                                <h3 style="font-weight: bold;">Filtres</h3>
                                            </button>
                                        </div>
                                    </router-link>
                                </div>
                                <div class="filter-dropdown-container fade-out" :class="{hidden: !(degree === 'master')}">
                                    <FilterDropDownComponent degree='master' v-show="tab === Tabs.Filters"></FilterDropDownComponent>
                                    <h3 class="data-text" :style="{'max-height': `calc(100vh - ${headerSectionHeight}px)`}" v-show="tab === Tabs.Data"><span v-html="$t('filters.data-master-'+$store.getters.getYear)"></span></h3>
                                </div>
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

const Tabs= Object.freeze({Data: 1, Filters: 2});

export default {
    components: {
        FilterDropDownComponent,
    },

    data() {
        return {
            Tabs,
            degree: null,
            tab: null,
            headerSectionHeight: 0,
        }
    },

    created () {
        this.$store.dispatch( 'loadFilters' );
    },

    mounted() {
        this.setHeaderSectionHeight();
        window.addEventListener('resize', this.setHeaderSectionHeight);
    },

    destroyed() {
        window.removeEventListener('resize', this.setHeaderSectionHeight);
    },

    computed: {
        pageDegree() {
            var DEFAULT = 'bachelor';
            if (!this.$route.params.degree) return DEFAULT;
            this.degree = this.$route.params.degree;
            return this.$route.params.degree;
        },
    },

    methods: {
        toggleDropdown(degree, tab = null) {
            let _this = this;

            if (degree == false) close();
            else if (degree === this.degree && tab === this.tab) {
                close(); //select an opened tab = close it
            } else {
                this.degree = degree; this.tab = tab;

                //window.addEventListener('scroll', _this.eventHandler, {once: true});
                window.addEventListener('keydown', _this.eventHandler, {once: true});
            }

            function close () {
                _this.tab = null;
            }
        },

        eventHandler(e) {
            switch(e.type) {
                case 'scroll':
                    if (!window.location.hash || $(window.location.hash).offset() &&  $(window.location.hash).offset().top != $(window).scrollTop()) {
                        this.toggleDropdown(false);
                    }
                    break;
                case 'keydown':
                    if (e.keyCode=="27") this.toggleDropdown(false);
                    break;
                default:
            }
        },

        scrollToFilters(t, callback = null) {
            var offset = document.getElementById('gallery').offsetTop;
            var degree = arguments[2] ? arguments[2] : null;
            var tab = arguments[3] ? arguments[3] : null;
            if (window.scrollY < offset) {
                if (typeof callback == 'function') {
                    $('html, body').animate({scrollTop: offset}, t)
                    .promise().then(function() {
                        callback(degree, tab);
                    });
                } else {
                    $('html, body').animate({scrollTop: offset}, t);
                }
            } else if (typeof callback == 'function') callback(degree, tab);
        },

        setHeaderSectionHeight() {
            this.headerSectionHeight = this.$refs.headerSection.offsetHeight;
        },
    },
}
</script>
