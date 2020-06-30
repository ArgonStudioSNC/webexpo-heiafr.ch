<style lang="scss">
@import '~@/abstracts/settings';
@import "/storage/fonts/TeXGyreHeros/_TeXGyreHeros.css";
@import "/storage/fonts/HelveticaNeue/_HelveticaNeue.css";

.webxpo {
    background-color: $body-background;
}

.webxpo-header {
    background-color: $body-background;
    position: relative;
    z-index: 10;
    padding-top: 0.5em;
    padding-bottom: 0.5em;
    @include breakpoint(large) {
        padding-top: 1em;
        padding-bottom: 1em;
    }
    .cell {
        height: 1.8em;
        display: flex;
        align-items: center;
        @include breakpoint(medium) {
            height: 3em;
        }
        @include breakpoint(xxlarge) {
            height: 3.5em;
        }
        .img-container {
            img {
                height: 100%;
                width: auto;
            }
            &.heia-fr {
                height: 100%;
            }
            &.jma {
                height: 70%;
            }
            &.hes-so {
                height: 50%;
                @include breakpoint(large) {
                    height: 100%;
                }
            }
        }
    }
}

h1 {
    font-size: min(9vw, 12vh);
    @include breakpoint(medium) {
        font-size: min(8vw, 12vh);
    }
    @include breakpoint(xlarge) {
        font-size: min(7vw, 12vh);
    }
    @include breakpoint(xxlarge) {
        font-size: min(6vw, 12vh);
    }
}

h3 {
    font-size: min(2.55vw, 3.4vh);
    @include breakpoint(medium) {
        font-size: min(2.2666vw, 3.4vh);
    }
    @include breakpoint(xlarge) {
        font-size: min(2vw, 3.4vh);
    }
    @include breakpoint(xxlarge) {
        font-size: min(1.7vw, 3.4vh);
    }
}
</style>

<template>
    <div id="webxpo" class="webxpo">
        <header class="webxpo-header">
            <div class="grid-container">
                <div class="grid-x grid-margin-x align-justify">
                    <div class="cell shrink">
                        <div class="img-container heia-fr">
                            <a href="https://www.heia-fr.ch/" target="_blank">
                                <img data-resize data-interchange="[/storage/media/logo/HEIA-FR_icon.svg, small], [/storage/media/logo/HEIA-FR.svg, large]" alt="HEIA-FR">
                            </a>
                        </div>
                    </div>
                    <div class="cell shrink">
                        <div class="img-container jma">
                            <a href="http://www.jointmaster.ch/" target="_blank">
                                <img src="/storage/media/logo/JMA.svg" alt="joint master of architecture">
                            </a>
                        </div>
                    </div>
                    <div class="cell shrink">
                        <div class="img-container hes-so">
                            <a href="https://www.hes-so.ch/" target="_blank">
                                <img data-resize data-interchange="[/storage/media/logo/HES-SO_icon.svg, small], [/storage/media/logo/HES-SO.svg, large]" alt="HES·so">
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </header>
        <router-view></router-view>
        <footer style="height: 4rem;"></footer>
    </div>
</template>

<script>
export default {

}
</script>
