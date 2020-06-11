<style lang="scss">
@import '~@/abstracts/settings';

.filter-dropdown {
    text-align: right;

    .filter-category {
        margin-top: 5rem;
        padding-bottom: 3rem;
    }
}

</style>

<template>
    <div class="filter-dropdown">
        <div class="filter-category" v-for="(cat, key) in filters" v-if="cat" track-by="key">
            <h3 style="font-weight: bold;">{{ $t('filters.' + key) }}</h3>
            <div class="grid-x align-right" v-for="el in cat">
                <div class="cell shrink"><h3>{{ el.name }}</h3></div>
                <div class="cell shrink"><h3>__</h3></div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: {
        filters: {
            type: Object,
            required: true,
        },
    },
}
</script>
