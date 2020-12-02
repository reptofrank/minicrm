<template>
    <div class="container-fluid">
        <h3>Companies</h3>
        <table class="table table-hovered">
        <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>URL</th>
            </tr>
        </thead>
        <tbody>
            <tr v-for="company in companies" :key="company.name">
                <td>{{ company.name }}</td>
                <td>{{ company.email }}</td>
                <td>{{ company.url }}</td>
            </tr>
        </tbody>
    </table>
    <pagination 
        v-bind:prev="page.prev"
        v-bind:next="page.next"
        v-bind:current_page="page.current_page"
        v-on:previous-page="previousPage"
        v-on:next-page="nextPage"
    ></pagination>
    </div>
</template>

<script>
import axios from 'axios';
import Pagination from './Pagination.vue';

export default {
    data() {
        return  {
            companies: [],
            page: {},
            base_url: '/companies'
        }
    },
    components: {
        pagination: Pagination
    },
    created() {
        this.fetchCompanies(this.$route.params.page)
    },

    methods: {
        async fetchCompanies(page = 1) {
            const response = await axios.get(`/api/companies?page=${page}`)
            let {next, prev, current_page} = {...response.data.links, ...response.data.meta}
            this.companies = response.data.data
            this.page = {next, prev, current_page}
        },
        previousPage(){
            if(this.page.prev) {
                this.fetchCompanies(this.page.current_page - 1)
            }
        },
        nextPage(){
            if(this.page.next) {
                this.fetchCompanies(this.page.current_page + 1)
            }
        }
    }
}
</script>