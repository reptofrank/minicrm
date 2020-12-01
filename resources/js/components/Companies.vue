<template>
    <div class="container-fluid">
        <table class="table table-hovered">
        <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>URL</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <tr v-for="company in companies" :key="company.name">
                <td>{{ company.name }}</td>
                <td>{{ company.email }}</td>
                <td>{{ company.url }}</td>
                <td><router-link to="/employees">Employees</router-link></td>
            </tr>
        </tbody>
    </table>
    <nav aria-label="Page navigation example">
        <ul class="pagination">
            <li v-bind:class="{'page-item': true, disabled: !page.prev}">
                <a class="page-link">Previous</a>
            </li>
            
            <li v-bind:class="{'page-item': true, disabled: !page.next}">
                <a class="page-link">Next</a>
            </li>
        </ul>
    </nav>
    </div>
</template>

<script>
import axios from 'axios'

export default {
    data() {
        return  {
            companies: [],
            page: {},
            meta: {},
            base_url: '/companies'
        }
    },
    created() {
        this.fetchCompanies(this.$route.params.page)
    },

    methods: {
        async fetchCompanies(page = 1) {
            const response = await axios.get(`/api/companies?page=${page}`)
            this.page = response.data.links
            this.companies = response.data.data
        }
    }
}
</script>