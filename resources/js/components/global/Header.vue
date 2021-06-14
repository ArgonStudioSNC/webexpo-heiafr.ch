<style lang="scss">

.webexpo-header {
    background-color: $body-background;
    position: relative;
    z-index: 10;
    padding-top: 1em;
    padding-bottom: 1em;
    .cell {
        height: 2.7em;
        display: flex;
        align-items: center;
        @include breakpoint(medium) {
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
                height: 60%;
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

</style>

<template>
    <header class="webexpo-header">
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
                            <img data-resize data-interchange="[/storage/media/logo/JMA-2021_icon.svg, small], [/storage/media/logo/JMA-2021.svg, large]" alt="joint master of architecture">
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
</template>

<script>
export default {

}
</script>
