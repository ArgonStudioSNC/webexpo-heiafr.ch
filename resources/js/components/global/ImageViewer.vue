<style lang="scss">
@import '@sass/abstracts/settings';

.image-viewer {
    width: 100%;
    height: 100%;
    >img {
        object-fit: scale-down;
        width: 100%;
        height: 100%;
    }

    .lds-facebook {
        margin: auto;
        position: absolute;
        top: 0;
        bottom: 0;
        right: 0;
        left: 0;
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
