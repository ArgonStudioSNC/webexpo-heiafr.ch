<style lang="scss">
@import '~@/abstracts/settings';
@import "/storage/fonts/TeXGyreHeros/_TeXGyreHeros.css";

.webxpo {
    background-color: $body-background;
}

.webxpo-header {
    margin-top: 0.5em;
    @include breakpoint(large) {
        margin-top: 1em;
    }
    .cell {
        height: 2.2em;
        display: flex;
        align-items: center;
        @include breakpoint(medium) {
            height: 3em;
        }
        @include breakpoint(xlarge) {
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

.blend {
    mix-blend-mode: multiply;
}

:focus {outline:none!important;}

</style>

<template>
    <div id="webxpo" class="webxpo">
        <header class="webxpo-header grid-container">
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
        </header>
        <router-view></router-view>
        <footer style="height: 4rem;"></footer>
    </div>
</template>

<script>
export default {

}
</script>
