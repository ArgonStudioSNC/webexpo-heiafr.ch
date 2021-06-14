<style lang="scss">

.image-viewer {
    width: 100%;
    height: 100%;
    >img {
        object-fit: scale-down;
        width: 100%;
        height: 100%;
    }

    .lds-facebook {
        display: inline-block;
        width: 70px;
        height: 100px;
        margin: auto;
        position: absolute;
        top: 0;
        bottom: 0;
        right: 0;
        left: 0;
    }
    .lds-facebook div {
        display: inline-block;
        position: absolute;
        left: 10px;
        width: 10px;
        background: $primary-color;
        animation: lds-facebook 1.2s cubic-bezier(0, 0.5, 0.5, 1) infinite;
    }
    .lds-facebook div:nth-child(1) {
        left: 10px;
        animation-delay: -0.24s;
    }
    .lds-facebook div:nth-child(2) {
        left: 30px;
        animation-delay: -0.12s;
    }
    .lds-facebook div:nth-child(3) {
        left: 50px;
        animation-delay: 0;
    }
    @keyframes lds-facebook {
        0% {
            top: 5px;
            height: 90px;
        }
        50%, 100% {
            top: 30px;
            height: 40px;
        }
    }
}

</style>

<template>
    <div id="image-viewer" class="image-viewer">
        <img :src="url" alt="Image plein écran" v-show="loaded" @load="loaded=true">
        <div class="lds-facebook blend" v-if="!loaded"><div></div><div></div><div></div></div>
    </div>
</template>

<script>
export default {
    props: {
        url: {
            type: String,
            default: null
        }
    },

    watch: {
        url(val) {
            this.loaded = false;
        },
    },

    data() {
        return {
            loaded: false,
        }
    },
}
</script>
