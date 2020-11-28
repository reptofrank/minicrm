<template>
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
</template>

<script>
import axios from 'axios'

export default {
    data() {
        return  {
            companies: []
        }
    },
    async created() {
        const response = await axios.get('/api/companies')
        this.companies = response.data.data
    },

    methods: {
        fetchCompanies() {
            fetch('/api/companies', {credentials: "same-origin"})
            .then(response => response.json())
            .then(companies => {
                console.log(this.companies)
                this.companies = [
                    {
                        name: 'Cravvings',
                        email: 'hello@cravvings.com',
                        url: 'cravvings.com'
                    }
                ]
            })
        }
    }
}
</script>