<style lang="scss">
@import '~@/abstracts/settings';
@import "/storage/fonts/HelveticaNeueLTStd/_HelveticaNeueLTStd.css";

.webxpo-title {
    .bg-color {
        position: relative;
        &::before{
            content: '';
            position: absolute;
            z-index: -1;
            left: 0;
            right: 0;
            top: 0.087em;
            bottom: 0.062em;
            background-color: $secondary-color;
        }
    }
}

</style>

<template>
    <div class="webxpo-2020">
        <div class="webxpo-title text-right">
            <h1 class="grid-container blend">HEIA-FR<br>architecture</h1>
            <h1 class="bg-color">
                <div class="grid-container blend"><a href="#gallery" v-smooth-scroll="{ duration: 300}">Travaux<br>Bachelor&nbsp;&amp;<br>Master 19I20</a></div>
            </h1>
            <h1 class="grid-container blend">Exposition<br>en ligne</h1>
        </div>
        <div style="height: 8.75rem;"></div>
        <div id ="gallery" style="padding-top: 1.25em;">
            <FilterMenuComponent></FilterMenuComponent>
            <ProjectGalleryComponent></ProjectGalleryComponent>
        </div>
        <div style="height: 8.75rem;"></div>
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
