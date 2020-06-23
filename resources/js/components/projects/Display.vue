<style lang="scss">
@import '~@/abstracts/settings';

.project-display {
    text-transform: uppercase;

    .student-portrait {
        margin-right: auto;
        margin-left: auto;
        width: 210px;
        height: 260px;
        >img {
            object-fit: cover;
            width: 100%;
            height: 100%;
        }
    }

    .project {
        &-meta {
            margin-top: 1em;
            max-width: 900px;
            text-align: center;
            align-self: center;
        }
        &-pdf{
            margin-top: 1em;
            text-align: center;
        }
        &-text{
            margin-top: 2em;
            max-width: 535px;
            align-self: center;
        }
        &-images{
            margin-right: auto;
            margin-left: auto;
            &>div {
                padding-top: 2rem;
                padding-bottom: 4rem;
                @include breakpoint(xlarge) {
                    padding-top: 8rem;
                    padding-bottom: 16rem;
                }
            }
        }
        &-boards{
            max-width: 700px;
            margin-right: auto;
            margin-left: auto;
            &>div {
                padding-top: 2rem;
                padding-bottom: 2rem;
                @include breakpoint(xlarge) {
                    padding-top: 8rem;
                    padding-bottom: 8rem;
                }
            }
        }
    }
}
</style>

<template>
    <div id="project-display" class="project-display">
        <div v-if="project">
            <div class="grid-container">
                <div class="grid-y align-center">
                    <div class="cell">
                        <div class="student-portrait blend">
                            <img :src="studentSrc(project.student)" alt="Photo de l'étudiant">
                        </div>
                    </div>
                    <div class="cell project-meta blend">
                        <b>{{ project.title }}</b><br>
                        {{ project.lead }}<br><br>
                        <b>{{ $t('projects.student') }}</b><br>
                        {{ project.student.first_name }}&nbsp;{{ project.student.last_name }}<br><br>
                        <div v-if="project.professor">
                            <b>{{ $t('projects.professor') }}</b><br>
                            {{ project.professor.name }}<br><br>
                        </div>
                        <b>{{ $t('projects.experts') }}</b><br>
                        <div v-for="expert in project.experts">
                            {{ expert }}
                        </div>
                    </div>
                    <div class="cell project-pdf blend">
                        <a :href="projectSrc(project, 'book/'+project.book_file)" download>
                            <font-awesome-icon :icon="['far', 'file-pdf']" size="3x"/>
                        </a>
                    </div>
                    <div class="cell project-text blend">
                        <b>{{ project.text }}</b>
                    </div>
                </div>
            </div>
            <div class="grid-container" :class="{'full': mq === 'small'}">
                <div class="grid-y align-center">

                    <div class="cell project-images blend">
                        <div v-for="image in project.images_files">
                            <picture>
                                 <source media="(min-width:1200px)" :srcset="projectSrc(project, 'images/'+image, 'x2400')">
                                 <source media="(min-width:600px)" :srcset="projectSrc(project, 'images/'+image, 'x1200')">
                                 <source media="(min-width:0px)" :srcset="projectSrc(project, 'images/'+image, 'x600')">
                                 <img :src="projectSrc(project, 'images/'+image, 'x2400')" alt="Image d'illustration" data-open="viewerReveal" @click="imageUrl = projectSrc(project, 'images/'+image)">
                            </picture>
                        </div>
                    </div>
                    <div class="cell project-boards">
                        <div v-for="board in project.boards_files">
                            <picture>
                                 <source media="(min-width:600px)" :srcset="projectSrc(project, 'boards/'+board, 'x1200')">
                                 <source media="(min-width:0px)" :srcset="projectSrc(project, 'boards/'+board, 'x600')">
                                 <img :src="projectSrc(project, 'boards/'+board, 'x1200')" alt="Planche de dessin" data-open="viewerReveal" @click="imageUrl = projectSrc(project, 'boards/'+board)">
                            </picture>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="full reveal" data-close-on-esc="true" data-multiple-opened="true" id="viewerReveal" ref="viewerReveal" data-reveal>
            <ImageViewerComponent :url="imageUrl"></ImageViewerComponent>
            <div class="fixed-close-button blend">
                <div class="grid-x align-right">
                    <div class="cell shrink">
                        <button class="my-close-button" data-close="viewerReveal" aria-label="Fermer le viewer" type="button" style="margin-right:3rem;">
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
import ImageViewerComponent from '../global/ImageViewer';

export default {
    components: {
        ImageViewerComponent,
    },

    props: {
        project: {
            type: Object,
            default: null
        }
    },

    data() {
        return {
            imageUrl: null,
            mq: 'small',
        }
    },

    mounted() {
        $(this.$refs.viewerReveal).on('closed.zf.reveal', x => {
            this.imageUrl = null;
        });

        this.mq = Foundation.MediaQuery.current;
        $(window).on('changed.zf.mediaquery', (event, newSize, oldSize) =>{
            this.mq = newSize;
        });
    },

    methods: {
        studentSrc(student) {
            return ['/storage/students', student.uuid, 'portrait', student.portrait_file].join('/');
        },

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
