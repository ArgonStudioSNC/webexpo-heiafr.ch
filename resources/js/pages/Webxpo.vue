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

.blend {
    mix-blend-mode: multiply;
}

:focus {outline:none!important;}

.lds-facebook {
  display: inline-block;
  position: relative;
  width: 70px;
  height: 100px;
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
