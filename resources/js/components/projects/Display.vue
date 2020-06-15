<style lang="scss">
@import '~@/abstracts/settings';

.project-display {
    text-transform: uppercase;

    .student-portrait {
        margin-right: auto;
        margin-left: auto;
        width: 210px;
        height: 260px;
        position: relative;
        >div {
            object-fit: cover;
            position: absolute;
            top: 0;
            bottom: 0;
            left: 0;
            right: 0;
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
                padding-top: 8rem;
                padding-bottom: 16rem;
            }
        }
        &-boards{
            max-width: 700px;
            margin-right: auto;
            margin-left: auto;
            &>div {
                padding-top: 8rem;
                padding-bottom: 8rem;
            }
        }
    }
}

</style>

<template>
    <div id="project-display" class="project-display" v-if="project">
        <div class="grid-container">
            <div class="grid-y align-center">
                <div class="cell">
                    <div class="student-portrait blend">
                        <div><img :src="studentSrc(project.student)" alt="Photo de l'étudiant"></div>
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
                    <a :href="projectSrc(project, 'book'+project.book_file)" download>
                        <font-awesome-icon :icon="['far', 'file-pdf']" size="3x"/>
                    </a>
                </div>
                <div class="cell project-text blend">
                    <b>{{ project.text }}</b>
                </div>
                <div class="cell project-images blend">
                    <div v-for="image in project.images_files">
                        <img :src="projectSrc(project, 'images/'+image, 'x1900')" alt="Image d'illustration">
                    </div>
                </div>
                <div class="cell project-boards">
                    <div v-for="board in project.boards_files">
                        <img :src="projectSrc(project, 'boards/'+board, 'x1900')" alt="Planche de dessin">
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: {
        project: {
            type: Object,
            default: null
        }
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
