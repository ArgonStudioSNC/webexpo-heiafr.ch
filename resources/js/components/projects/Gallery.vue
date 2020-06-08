<style lang="scss">
@import '~@/abstracts/settings';

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

</style>

<template>
    <div id="project-gallery" class="project-gallery">
        <div class="grid-container">
            <div class="grid-x grid-margin-x grid-margin-y medium-up-2 large-up-3">
                <div class="cell project-card" v-for="project in filtredProjects" :key="project.id">
                    <div class="project-vignette">
                        <div><img :src="thumbnailPath(project, 600)"></div>
                    </div>
                    <h4 style="font-weight:bold;" class="project-label">
                        <div class="blend">{{ project.student.last_name }}<br>{{ project.student.first_name }}</div>
                    </h4>
                </div>
            </div>
        </div>
        <ProjectRevealComponent></ProjectRevealComponent>
    </div>
</template>

<script>
import ProjectRevealComponent from './Reveal';
import { ProjectMixins } from '../../mixins/Project';

export default {
    components: {
        ProjectRevealComponent,
    },

    mixins: [ProjectMixins],

    computed: {
        projects() {
            return this.$store.getters.getProjects.data;
        }
    },
}
</script>
