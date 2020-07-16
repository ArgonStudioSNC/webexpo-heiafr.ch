<style lang="scss">
@import '~@/abstracts/settings';
@import '~@/abstracts/mixins';
.webexpo-2020 {
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
}

#gallery {
    min-height: calc(100vh + 1px);
}

.player-container {
    $padding: 1.3em;

    position: fixed;
    z-index: 100;
    left: 0;
    bottom: 0;

    width: 100%;
    padding-top: 56.25%;
    @include breakpoint(medium) {
        width: clamp(200px, 50%, 640px);
        padding-top: calc(clamp(200px, 50%, 640px) * 0.5625);
        left: 3.2em;
        bottom: 4.2em;
    }

    &>div {
        position: absolute;
        top: 0;
        bottom: 0;
        right: 0;
        left: 0;
    }

    .player-background {
        position: absolute;
        background-color: $primary-color;
        display: none;
        @include breakpoint(medium) {
            display: block;
            top: -$padding;
            bottom: -$padding;
            right: -$padding;
            left: -$padding;
        }
    }
    iframe {
        width: 100%;
        height: 100%;
    }
    .player-close-button {
        cursor: pointer;
        width: $padding;
        height: auto;
        fill: $primary-color;
        position: absolute;
        @include transform(translateY(-105%));
        right: 0.5rem;
        top: 0;
        @include breakpoint(medium) {
            right: -$padding;
            top: -$padding;
        }

    }
}
</style>

<template>
    <div class="webexpo-2020">
        <div class="webexpo-title grid-y align-center text-right">
            <h1 class="cell grid-container blend">HEIA-FR<br>architecture</h1>
            <h1 class="cell bg-color">
                <div class="grid-container blend"><a href="#gallery" data-smooth-scroll data-animation-duration='300' data-animation-easing='swing' data-offset="-25.6">Travaux<br>Bachelor&nbsp;&amp;<br>Master 19I20</a></div>
            </h1>
            <h1 class="cell grid-container blend">Exposition<br>en ligne</h1>
        </div>
        <div id="gallery">
            <FilterMenuComponent></FilterMenuComponent>
            <ProjectGalleryComponent></ProjectGalleryComponent>
        </div>
        <div class="player-container blend" v-show="playerShow && playerReady">
            <div class="player-background"></div>
            <button class="player-close-button" @click="closePlayer" aria-label="Fermer le lecteur vidéo" type="button">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 61.32 61.32">
                    <g><path class="times" d="M0,4.3,4.3,0,30.66,26.36,57,0l4.3,4.3L35,30.66,61.32,57,57,61.32,30.66,35,4.3,61.32,0,57,26.36,30.66Z"/></g>
                </svg>
            </button>
        </div>
        <div class="player-container" v-show="playerShow && playerReady">
            <div><youtube :video-id="videoId" :player-vars="playerVars" nocookie ref="youtube" @ready="playerReady = true"></youtube></div>
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
            videoId: 'M2xCwdB5Iac',
            playerVars: {
                autoplay: 0,
            },
            playerShow: false,
            playerReady: false,
        }
    },

    created() {
        this.$store.dispatch( 'loadProjects', 2020);
    },

    mounted() {
        window.addEventListener('scroll', this.videoPopup);
        this.videoPopup;
    },

    destroyed() {
        window.removeEventListener('scroll', this.videoPopup);
    },

    methods: {
        videoPopup() {
            if (window.scrollY >= document.getElementById("gallery").offsetTop - 50) {
                window.removeEventListener('scroll', this.videoPopup);
                this.playerShow = true;
            }
        },

        closePlayer() {
            this.playerShow = false;
            this.player.stopVideo();
        },
    },

    computed: {
        player() {
            return this.$refs.youtube.player;
        },
    },
}
</script>
