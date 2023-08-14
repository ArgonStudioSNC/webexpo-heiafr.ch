<style lang="scss">
@import '@sass/_mixins';

.player-container {
    $padding: 1.2em;

    position: fixed;
    z-index: 100;
    left: 0;
    bottom: 0;

    width: 100%;
    padding-top: 56.25%;
    @include breakpoint(medium) {
        left: 2em;
        bottom: 2em;
        width: 360px;
        padding-top: calc(360px * 0.5625);
    }
    @include breakpoint(large) {
        width: 520px;
        padding-top: calc(520px * 0.5625);
    }
    @include breakpoint(xlarge) {
        left: 3.2em;
        bottom: 4.2em;
    }
    @include breakpoint(xxlarge) {
        width: 640px;
        padding-top: calc(640px * 0.5625);
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
    <div class="youtube-popup">
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
export default {
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
