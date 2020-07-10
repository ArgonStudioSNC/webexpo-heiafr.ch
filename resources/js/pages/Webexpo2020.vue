<style lang="scss">
@import '~@/abstracts/settings';
@import '~@/abstracts/mixins';
.webexpo-2020 {
    .webexpo-title {
        min-height: calc(100vh - 3.7em);
        @include breakpoint(medium) {
            min-height: calc(100vh - 4.5em);
        }
        padding-bottom: 2em;
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

.video-intro {
    $padding: 1.3em;
    width: calc(min(640px, 100vw) + 2 * #{$padding});
    height: calc(min(360px, 56.25vw) + 2 * #{$padding});
    position: fixed;
    z-index: 100;
    left: 2em;
    bottom: 3em;

    .background {
        height: 100%;
        width: 100%;
        background-color: $primary-color;
    }
    iframe {
        height: 100%;
        width: 100%;
        padding: $padding;
    }
    .close-player {
        cursor: pointer;
        width: $padding;
        height: auto;
        fill: $primary-color;
        position: absolute;
        right: 0;
        top: 0;
        @include transform(translateY(-110%));
    }
}
</style>

<template>
    <div class="webexpo-2020">
        <div class="webexpo-title grid-y align-center text-right">
            <h1 class="cell grid-container blend">HEIA-FR<br>architecture</h1>
            <h1 class="cell bg-color">
                <div class="grid-container blend"><a href="#gallery" v-smooth-scroll="{ duration: 300, updateHistory: false}">Travaux<br>Bachelor&nbsp;&amp;<br>Master 19I20</a></div>
            </h1>
            <h1 class="cell grid-container blend">Exposition<br>en ligne</h1>
        </div>
        <div id="gallery">
            <FilterMenuComponent></FilterMenuComponent>
            <ProjectGalleryComponent></ProjectGalleryComponent>
        </div>
        <div class="video-intro blend" v-show="showVideo">
            <div class="background"></div>
            <button class="close-player" @click="showVideo = false" aria-label="Fermer le lecteur vidéo" type="button">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 61.32 61.32">
                    <g><path class="times" d="M0,4.3,4.3,0,30.66,26.36,57,0l4.3,4.3L35,30.66,61.32,57,57,61.32,30.66,35,4.3,61.32,0,57,26.36,30.66Z"/></g>
                </svg>
            </button>
        </div>
        <div class="video-intro" v-if="showVideo">
            <iframe src="https://www.youtube-nocookie.com/embed/9mhCcoe5Czw" frameborder="0" allow="accelerometer; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
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

    data() {
        return {
            showVideo: false,
        }
    },

    created () {
        this.$store.dispatch( 'loadProjects', 2020);

        window.addEventListener('scroll', this.videoPopup);
        this.videoPopup;
    },

    destroyed () {
        window.removeEventListener('scroll', this.videoPopup);
    },

    methods: {
        videoPopup() {
            if (window.scrollY >= document.getElementById("gallery").offsetTop) {
                //this.showVideo = true;
                window.removeEventListener('scroll', this.videoPopup);
            }
        },
    },
}
</script>
