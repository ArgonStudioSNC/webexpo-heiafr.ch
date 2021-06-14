<style lang="scss">

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

.footer {
    background-color: $secondary-color;
    padding-top: 1.5em;
    padding-bottom: 1.5em;
    line-height: normal;
    text-align: center;
    font-size: 12px;
    @include breakpoint(medium) {
        font-size: 14px;
    }
    @include breakpoint(large) {
        font-size: 16px;
    }

    a:hover {
        text-decoration: underline;
    }
    .links {
        margin-bottom: 1.5em;
    }
    .copyright {
        font-size: 12px;
        span {
            opacity: 0.6;
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
                                <img src="/storage/media/logo/JMA-Logo_standard.svg" alt="joint master of architecture">
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
                <div class="grid-y">
                    <div class="cell">
                        <div class="links">
                            liens vers :
                            <div><a href="https://www.heia-fr.ch/fr/formation/bachelor/architecture/" target="_blank">le site de la filière d'architecture bachelor de la HEIA-FR</a></div>
                            <div><a href="http://www.jointmaster.ch/" target="_blank">le site internet du joint master of architecture</a></div>
                            <div><a href="https://www.heia-fr.ch/" target="_blank">le site internet de la HEIA-FR</a></div>
                            <div><a href="https://www.hes-so.ch/" target="_blank">le site internet de la HES-SO</a></div>
                        </div>
                    </div>
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
    },

    mounted() {
        this.showBody();
    },

    methods: {
        showBody() {
            $('body').css('visibility', 'visible');
            $('body').css('overflow-y', 'auto');
        },
    },
}
</script>
