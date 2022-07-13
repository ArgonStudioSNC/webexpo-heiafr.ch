<style lang="scss">

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
                        <div v-if="$store.getters.getYear != 2020"><a href="/2020" target="_self">exposition 2020</a></div>
                        <div v-if="$store.getters.getYear != 2021"><a href="/2021" target="_self">exposition 2021</a></div>
                        <!-- <div v-if="$store.getters.getYear != 2021"><a href="/2021" target="_self">exposition 2021</a></div> -->
                    </div>
                </div>
                <div class="cell shrink">
                    <div class="copyright"><span>&copy {{date}} | Proudly made by</span>&nbsp;<a href='https://argonstudio.ch/' target='_blank' title="Argon Studio snc">Argon</a></div>
                </div>
            </div>
        </div>
    </footer>
</template>

<script>
export default {
    computed: {
        date() {
            return new Date().getFullYear();
        }
    },
}
</script>
