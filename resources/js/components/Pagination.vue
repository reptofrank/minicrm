<template>
    <nav aria-label="Page navigation example">
        <ul class="pagination">
            <li v-bind:class="{'page-item': true, disabled: !prev}">
                <a href="#" v-on:click.prevent="$emit('previous-page')" class="page-link">Previous</a>
            </li>
            
            <li v-bind:class="{'page-item': true, disabled: !next}">
                <a href="#" v-on:click.prevent="$emit('next-page')" class="page-link">Next</a>
            </li>
        </ul>
    </nav>
</template>

<script>
export default {
    data() {
        return {
            
        }
    },
    props: ['prev', 'next', 'current_page']
}
</script>