<style lang="scss">
@import '@sass/_mixins';

.project-gallery {
    text-align: right;
    margin-top: 4rem;

    padding-bottom: 2rem;
    @include breakpoint(large) {
        padding-bottom: 8rem;
    }

    .project-card {
        position: relative;
        @include breakpoint(small only) {
            margin-bottom: 1rem;
        }
        .project-vignette {
            width: 100%;
            position: relative;
            padding-bottom: 61.19%;
            opacity: 1;
            @include transition(opacity 0.1s ease-out);
            >div {
                position: absolute;
                top: 0;
                bottom: 0;
                left: 0;
                right: 0;
                img {
                    height: calc(100%);
                    width: 100%;
                    object-fit: cover;
                }
            }
        }

        .project-label-under {
            position: relative;
            z-index: 1;
            margin-top: -0.15em;
            margin-bottom: -0.125em;
            &::before{
                content: '';
                position: absolute;
                z-index: -1;
                left: 0;
                right: 0;
                top: 0.15em;
                bottom: 0.125em;
                background-color: $secondary-color;
            }
        }

        .project-label-over {
            display: flex;
            text-transform: none;
            position: absolute;
            top: 0;
            bottom: 0;
            left: 0;
            right: 0;
            align-items:center;
            justify-content:center;
            text-align:center;
            opacity: 0;
            @include transition(opacity 0.1s ease-out);
        }
    }
}
.fixed-close-button {
    pointer-events: none;
    position: fixed;
    top: 0;
    right: 0;
    left: 0;
}

.my-close-button {
    pointer-events: auto;
    height: auto;
    margin-right: 1.5rem;
    margin-top: 3rem;
    width: 40px;
    @include breakpoint(medium) {
        width: 60px;
    }
    svg {
        height: 100%;
        width: 100%;
    }

    .times {
        fill: $primary-color;
    }
}

</style>

<template>
    <div id="project-gallery" class="project-gallery">
        <div class="grid-container" :class="{'full': mq === 'small'}">
            <div class="grid-x grid-margin-x grid-margin-y medium-up-2 xlarge-up-3">
                <a class="cell project-card" v-for="project in projects" :key="project.id" data-open="projectReveal" @click="selectedProject = project">
                    <div class="project-vignette">
                        <div>
                            <img :src="projectSrc(project, 'vignette/'+project.vignette_file, '@600')" alt="Vignette du projet">
                        </div>
                    </div>
                    <div class="project-label">
                        <h4 style="font-weight:bold;" class="project-label-under">
                            <div class="blend">{{ normalize(project.student.last_name) }}<br>{{ normalize(project.student.first_name) }}</div>
                        </h4>
                        <h5 style="font-weight:bold;" class="project-label-over blend">
                            {{ normalize(project.student.last_name) }}<br>{{ normalize(project.student.first_name) }}
                        </h5>
                    </div>
                </a>
            </div>
        </div>
        <div class="full reveal" data-close-on-esc="false" data-multiple-opened="true" id="projectReveal" ref="projectReveal" data-reveal data-v-offset="0">
            <ProjectDisplayComponent :project="selectedProject"></ProjectDisplayComponent>
            <div class="grid-container fixed-close-button blend">
                <div class="grid-x align-right">
                    <div class="cell shrink">
                        <button class="my-close-button" data-close="projectReveal" aria-label="Fermer le projet" type="button">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 61.32 61.32">
                                <g><path class="times" d="M0,4.3,4.3,0,30.66,26.36,57,0l4.3,4.3L35,30.66,61.32,57,57,61.32,30.66,35,4.3,61.32,0,57,26.36,30.66Z"/></g>
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import ProjectDisplayComponent from './Display';
import { ProjectMixins } from '../../mixins/project';

export default {
    components: {
        ProjectDisplayComponent,
    },

    mixins: [ProjectMixins],

    data() {
        return {
            selectedProject: null,
            mq: 'small',
        }
    },

    mounted() {
        window.addEventListener('scroll', this.cardOpacityOnScroll, {
            passive: true
        });

        $(this.$refs.projectReveal).on('closed.zf.reveal', x => {
            this.selectedProject = null;
        });

        this.mq = Foundation.MediaQuery.current;
        $(window).on('changed.zf.mediaquery', (event, newSize, oldSize) =>{
            this.mq = newSize;
        });
    },

    destroyed() {
        window.removeEventListener('scroll', this.cardOpacityOnScroll);
    },

    computed: {
        projects() {
            var degree = this.$route.params.degree;
            if (degree !== 'bachelor' && degree !== 'master') return null;
            let filters = this.$store.getters.getActiveFilters[degree];
            return _.isEmpty(filters) ? this.getProjects(degree) : this.filterProjects(this.getProjects(degree), filters);
        },
    },

    methods: {
        projectSrc(project, resource, size=null) {
            var pathNodeJS = require('path');
            var path = ['/storage/projects', project.year, project.degree, project.student.uuid, resource].join('/');
            if (size) {
                var ext = pathNodeJS.extname(path);
                path = [pathNodeJS.dirname(path), size, pathNodeJS.basename(path, ext) + size + ext].join('/');
            }
            return path;
        },

        normalize(string){
            return string.normalize("NFD").replace(/[\u0300-\u036f]/g, "");
        },

        cardOpacityOnScroll() {
            var middle = window.innerHeight / 2;
            $('.project-card').each(function(index, el) {
                var cardY = el.getBoundingClientRect().y;
                var cardHeight = el.getBoundingClientRect().height;
                if(cardY < middle && cardY + cardHeight > middle) {
                    $(el).addClass('mobile-hover');
                } else {
                    $(el).removeClass('mobile-hover');
                }
            });
        }
    },
}
</script>
