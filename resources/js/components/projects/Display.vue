<style lang="scss">

.project-display {
    text-transform: uppercase;
    background-color: $body-background;

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
            white-space: normal;
        }
        &-images{
            margin-right: auto;
            margin-left: auto;
            padding-top: 2rem;
            padding-bottom: 4rem;
            @include breakpoint(xlarge) {
                padding-top: 8rem;
                padding-bottom: 16rem;
            }
        }
        &-boards{
            max-width: 700px;
            margin-right: auto;
            margin-left: auto;
            padding-top: 2rem;
            padding-bottom: 2rem;
            @include breakpoint(xlarge) {
                padding-top: 8rem;
                padding-bottom: 8rem;
            }
        }
    }
}

.my-close-button.little {
    width: 40px !important;
    @include breakpoint(medium) {
        margin-right: 3em;
    }
}

.my-download-button {
    color: $primary-color;
}

</style>

<template>
    <div id="project-display" class="project-display">
        <div v-if="project">
            <div class="grid-container">
                <div class="grid-y align-center">
                    <div class="cell">
                        <div class="student-portrait blend">
                            <img :src="studentSrc(project.student)" alt="Photo de l'étudiant·e" />
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
                        <div v-if="project.experts">
                            <b>{{ $t('projects.experts') }}</b><br>
                            <div v-for="expert in project.experts">
                                {{ expert }}
                            </div>
                        </div>
                    </div>
                    <div class="cell project-pdf blend">
                        <button class="my-download-button" v-on:click="openBooks(project, project.books_files)">
                            <font-awesome-icon :icon="['far', 'file-pdf']" size="3x"/>
                        </button>
                    </div>
                    <div class="cell project-text blend">
                        <b>{{ project.text }}</b>
                    </div>
                </div>
            </div>
            <div class="grid-container" :class="{'full': mq === 'small'}">
                <div class="grid-y text-center">
                    <div class="cell project-images blend" v-for="image in project.images_files">
                        <img :srcset="`${projectSrc(project, 'images/'+image, '@600')} 600w,
                        ${projectSrc(project, 'images/'+image, '@1200')} 1200w,
                        ${projectSrc(project, 'images/'+image, '@2400')} 2400w`"
                        sizes="(max-width: 600px) 600px,
                        (max-width: 1200px) 1200px,
                        (max-width: 2400px) 2400px"
                        :src="projectSrc(project, 'images/'+image)"
                        alt="Image d'illustration"
                        data-open="viewerReveal"
                        @click="imageUrl = projectSrc(project, 'images/'+image)" />
                    </div>
                    <div class="cell project-boards" v-for="board in project.boards_files">
                        <img :srcset="`${projectSrc(project, 'boards/'+board, '@600')} 600w, ${projectSrc(project, 'boards/'+board, '@1200')} 1200w`"
                        sizes="(max-width: 600px) 600px,
                        (max-width: 1200px) 1200px"
                        :src="projectSrc(project, 'boards/'+board)"
                        alt="Planche de dessin"
                        data-open="viewerReveal"
                        @click="imageUrl = projectSrc(project, 'boards/'+board)" />
                    </div>
                </div>
            </div>
        </div>
        <div class="full reveal" data-close-on-esc="true" data-multiple-opened="true" id="viewerReveal" ref="viewerReveal" data-reveal data-v-offset="0">
            <ImageViewerComponent :url="imageUrl"></ImageViewerComponent>
            <div class="fixed-close-button blend">
                <div class="grid-x align-right">
                    <div class="cell shrink">
                        <button class="my-close-button little" data-close="viewerReveal" aria-label="Fermer le viewer" type="button">
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
            if (!student.portrait_file) {
                return '/storage/students/placeholder/portrait/placeholder.jpg';
            }
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

        openBooks(project, resources) {
            var a = document.createElement("a");
            resources.forEach(pdfFile => {
                a.href = this.projectSrc(project, 'books/'+pdfFile);
                a.setAttribute("download", pdfFile);
                a.click();
            });
        },
    },
}
</script>
