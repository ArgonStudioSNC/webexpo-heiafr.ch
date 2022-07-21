<style scoped lang="scss">
@import '~@sass/_mixins';

.webexpo {
    .webexpo-title {
        min-height: calc(100vh - 3.7em);
        @include breakpoint(medium) {
            min-height: calc(100vh - 4.5em);
        }
        //padding-bottom: 2em;
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
            }
        }
    }

    #gallery {
        min-height: calc(100vh + 1px);
    }
}

</style>

<template>
    <div id="webexpo" class="webexpo">
        <HeaderComponent></HeaderComponent>
        <div class="webexpo-title grid-y align-center text-right">
            <h1 class="cell grid-container blend">HEIA-FR<br>architecture</h1>
            <h1 class="cell bg-color">
                <div class="grid-container blend"><a href="#gallery" data-smooth-scroll data-animation-duration='300' data-animation-easing='swing' data-offset="-25.6">Travaux<br>Bachelor&nbsp;&amp;<br>Master 21I22</a></div>
            </h1>
            <h1 class="cell grid-container blend">Exposition<br>en ligne</h1>
        </div>
        <div id="gallery" class="">
            <FilterMenuComponent></FilterMenuComponent>
            <ProjectGalleryComponent></ProjectGalleryComponent>
        </div>
        <FooterComponent></FooterComponent>
    </div>
</template>

<script>
import HeaderComponent from '@js/components/global/Header';
import FooterComponent from '@js/components/global/Footer';
import FilterMenuComponent from '@js/components/filters/Menu';
import ProjectGalleryComponent from '@js/components/projects/Gallery';

export default {
    components: {
        HeaderComponent,
        FooterComponent,
        FilterMenuComponent,
        ProjectGalleryComponent,
    },

    props: {
        degree: {
            type: String,
            default: 'bachelor'
        }
    },

    created() {
        this.$store.dispatch( 'loadProjects', 2022);
        $('body').addClass('theme-2022');
    },

    mounted() {
        this.showBody();
    },

    methods: {
        showBody() {
            $('body').css('visibility', 'visible');
            $('body').css('overflow-y', 'auto');
        },
    },
}
</script>
