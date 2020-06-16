<style lang="scss">
@import '~@/abstracts/settings';
@import '~@/abstracts/mixins';

.project-gallery {
    text-align: right;
    margin-top: 4rem;

    .project-card {
        .project-vignette {
            width: 100%;
            position: relative;
            margin-bottom: 61.19%;
            >div {
                object-fit: cover;
                position: absolute;
                top: 0;
                bottom: 0;
                left: 0;
                right: 0;
            }
        }

        .project-label {
            position: relative;
            z-index: 1;
            margin-top: -0.14em;
            margin-bottom: -0.09em;

            &::before{
                content: '';
                position: absolute;
                z-index: -1;
                left: 0;
                right: 0;
                top: 0.14em;
                bottom: 0.09em;
                background-color: $secondary-color;
            }
        }
    }
}

.heiafr-close-button {
    position: fixed;
    right: 20px;
    top: 2rem;
    @include breakpoint(medium) {
        top: 4rem;
    }

    button {
        cursor: pointer;
        svg {
            height: auto;
            width: 40px;
            @include breakpoint(medium) {
                width: 60px;
            }
        }
        @include breakpoint(medium) {
            top: 4rem;
        }
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
                <a class="cell project-card" v-for="project in projects" :key="project.id" data-toggle="projectModal" @click="selectedProject = project">
                    <div class="project-vignette">
                        <div><img :src="projectSrc(project, 'vignette/'+project.vignette_file, 'x600')" alt="vignette du projet"></div>
                    </div>
                    <h4 style="font-weight:bold;" class="project-label">
                        <div class="blend">{{ project.student.last_name }}<br>{{ project.student.first_name }}</div>
                    </h4>
                </a>
            </div>
        </div>
        <div class="full reveal" id="projectModal" ref="reveal" data-reveal>
            <ProjectDisplayComponent :project="selectedProject"></ProjectDisplayComponent>
            <div class="heiafr-close-button blend">
                <div class="grid-container">
                    <div class="grid-x align-right">
                        <div class="cell shrink">
                            <button data-close aria-label="Fermer le projet" type="button">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 61.32 61.32">
                                    <g><path class="times" d="M0,4.3,4.3,0,30.66,26.36,57,0l4.3,4.3L35,30.66,61.32,57,57,61.32,30.66,35,4.3,61.32,0,57,26.36,30.66Z"/></g>
                                </svg>
                            </button>
                        </div>
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
        $(this.$refs.reveal).on('open.zf.reveal', x => {
            //
        });

        $(this.$refs.reveal).on('closed.zf.reveal', x => {
            this.selectedProject = null;
        });

        this.mq = Foundation.MediaQuery.current;
        $(window).on('changed.zf.mediaquery', (event, newSize, oldSize) =>{
            this.mq = newSize;
        });
    },

    computed: {
        projects() {
            var degree = this.$route.params.degree;
            if (degree !== 'bachelor' && degree !== 'master') return null;

            let filters = this.$store.getters.getActiveFilters[degree]

            return this.filterProjects(this.getProjects(degree), filters);
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
    },
}
</script>
