<style lang="scss">
@import '~@/abstracts/settings';
@import "/storage/fonts/TeXGyreHeros/_TeXGyreHeros.css";
@import "/storage/fonts/HelveticaNeue/_HelveticaNeue.css";

.webexpo {
    background-color: $body-background;
}

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

@function headers-font-size($width-ratio, $mq) {
    $pad : map-get($grid-container-padding, $mq);
    @return calc((#{$width-ratio} / 100) * min(calc(#{$global-width} - #{$pad}), calc(100vw - #{$pad})));
}

h1 {
    //12
    font-size : clamp(27px, #{headers-font-size(9.1, "small")}, 12vh);
    @include breakpoint(medium) {
        font-size : clamp(27px, #{headers-font-size(9.1, "medium")}, 12vh);
    }
    @include breakpoint(large) {
        font-size : clamp(40px, #{headers-font-size(9.1, "large")}, 12vh);
    }
    @include breakpoint(xlarge) {
        font-size : clamp(50px, #{headers-font-size(9.1, "xlarge")}, 12vh);
    }
    @include breakpoint(xxlarge) {
        font-size : clamp(60px, #{headers-font-size(9.1, "xxlarge")}, 12vh);
    }
}

h3 {
    //3.6
    font-size : clamp(12px, #{headers-font-size(3, "small")}, 3.6vh);
    @include breakpoint(medium) {
        font-size : clamp(12px, #{headers-font-size(3, "medium")}, 3.6vh);
    }
    @include breakpoint(large) {
        font-size : clamp(12px, #{headers-font-size(3, "large")}, 3.6vh);
    }
    @include breakpoint(xlarge) {
        font-size : clamp(15px, #{headers-font-size(3, "xlarge")}, 3.6vh);
    }
    @include breakpoint(xxlarge) {
        font-size : clamp(18px, #{headers-font-size(3, "xxlarge")}, 3.6vh);
    }
}

.footer {
    //background-color: $secondary-color;
    .copyright {
        font-size: 12px;
        line-height: normal;
        text-align: center;
        span {
            opacity: 0.6;
        }
        a:hover {
            text-decoration: underline;
        }
    }
}

</style>

<template>
    <div id="webexpo" class="webexpo">
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
        <footer class="footer">
            <div class="grid-container blend">
                <div class="grid-y grid-margin-y" style="min-height: 3rem;">
                    <div class="cell auto"></div>
                    <div class="cell shrink">
                        <div class="copyright"><span>&copy {{date}} | Proudly made by</span>&nbsp;<a href='https://argonstudio.ch/' target='_blank' title="Argon Studio snc">Argon</a></div>
                    </div>
                </div>
            </div>
        </footer>
    </div>
</template>

<script>
export default {
    computed: {
        date() {
            return new Date().getFullYear();
        }
    }
}
</script>
