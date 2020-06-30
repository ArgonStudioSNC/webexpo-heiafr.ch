<style lang="scss">
@import '~@/abstracts/settings';
.webxpo-2020 {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    .webxpo-title {
        min-height: 100vh;
        .bg-color {
            position: relative;
            &::before{
                content: '';
                position: absolute;
                isolation: isolate;
                left: 0;
                right: 0;
                top: 0.083em;
                bottom: 0.067em;
                background-color: $secondary-color;
            }
        }
    }
}

#gallery {
    min-height: calc(100vh + 1px);
}
</style>

<template>
    <div class="webxpo-2020">
        <div class="webxpo-title grid-y align-center text-right">
            <h1 class="cell grid-container blend">HEIA-FR<br>architecture</h1>
            <h1 class="cell bg-color">
                <div class="grid-container blend"><a href="#gallery" v-smooth-scroll="{ duration: 300}">Travaux<br>Bachelor&nbsp;&amp;<br>Master 19I20</a></div>
            </h1>
            <h1 class="cell grid-container blend">Exposition<br>en ligne</h1>
        </div>
        <div id="gallery" style="padding-top: 1.2rem;">
            <FilterMenuComponent></FilterMenuComponent>
            <ProjectGalleryComponent></ProjectGalleryComponent>
        </div>
    </div>
</template>

<script>
import FilterMenuComponent from '../components/filters/Menu';
import ProjectGalleryComponent from '../components/projects/Gallery';

export default {
    components: {
        FilterMenuComponent,
        ProjectGalleryComponent,
    },

    props: {
        degree: {
            type: String,
            default: 'bachelor'
        }
    },

    created () {
        this.$store.dispatch( 'loadProjects', 2020);
    },
}
</script>
