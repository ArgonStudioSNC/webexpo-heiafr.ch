<style lang="scss">
@import '~@/abstracts/settings';
@import "/storage/fonts/HelveticaNeueLTStd/_HelveticaNeueLTStd.css";

.webxpo-header {
    img {
        margin: 1.25em;
        height: 3.5em;
        width: auto;
    }
}

.blend {
    mix-blend-mode: multiply;
}

</style>

<template>
    <div id="webxpo" class="webxpo">
        <header class="webxpo-header grid-container">
            <div class="grid-x align-justify align-middle">
                <div class="cell shrink">
                    <a href="https://www.heia-fr.ch/" target="_blank"><img src="/storage/media/logo/HEIA-FR.svg" alt="HEIA-FR"></a>
                </div>
                <div class="cell shrink">
                    <a href="http://www.jointmaster.ch/" target="_blank"><img src="/storage/media/logo/JMA.svg" style="height:2.5em;" alt="joint master of architecture"></a>
                </div>
                <div class="cell shrink">
                    <a href="https://www.hes-so.ch/" target="_blank"><img src="/storage/media/logo/HES-SO.svg" alt="HES·so"></a>
                </div>
            </div>
        </header>
        <div style="height:2rem;"></div>
        <router-view></router-view>
        <footer style="height: 4rem;"></footer>
    </div>
</template>

<script>
export default {

}
</script>
