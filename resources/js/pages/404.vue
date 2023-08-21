<style scoped lang="scss">

.not-found {
    height: 100vh;
        display: flex;
        justify-content: center;
        align-items: center;
        .not-found-message {
            color: get-color(purple23);
            a {
                color: get-color(purple23);
                text-decoration: underline;
            }
            .cell {
                @include breakpoint(small only) {
                    margin-top : 0.5625rem;
                    margin-bottom : 0.5625rem;
                }
            }
        }
}

</style>

<template>
    <div id="404" class="not-found grid-container">
        <div class="not-found-message grid-y text-center grid-margin-y">
            <h1 class="cell">404</h1>
            <h4 class="cell">Oups, la page que vous cherchez à atteindre n'existe pas</h4>
            <a class="cell" href="/">retour à l'exposition</a>
        </div>
    </div>
</template>

<script>
export default {
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
