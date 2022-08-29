<style scoped lang="scss">

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
                background-color: $secondary-color;
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
                <div class="grid-container blend"><a href="#gallery" v-foundation data-smooth-scroll data-animation-duration='300' data-animation-easing='swing' data-offset="-25.6">Travaux<br>Bachelor&nbsp;&amp;<br>Master 19I20</a></div>
            </h1>
            <h1 class="cell grid-container blend">Exposition<br>en ligne</h1>
        </div>
        <div id="gallery">
            <FilterMenuComponent></FilterMenuComponent>
            <ProjectGalleryComponent></ProjectGalleryComponent>
        </div>
        <FooterComponent></FooterComponent>
        <YoutubePopupComponent></YoutubePopupComponent>
    </div>
</template>

<script>
import { useStore } from 'vuex';
import HeaderComponent from '@/components/global/Header.vue';
import FooterComponent from '@/components/global/Footer.vue';
import YoutubePopupComponent from '@/components/global/YoutubePopup.vue';
import FilterMenuComponent from '@/components/filters/Menu.vue';
import ProjectGalleryComponent from '@/components/projects/Gallery.vue';

export default {
    components: {
        HeaderComponent,
        FooterComponent,
        YoutubePopupComponent,
        FilterMenuComponent,
        ProjectGalleryComponent,
    },

    props: {
        degree: {
            type: String,
            default: 'bachelor'
        }
    },

    setup () {
        const store = useStore();

        store.dispatch( 'loadProjects', 2020);
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
