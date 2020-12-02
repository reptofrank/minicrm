<template>
    <div class="container-fluid">
        <h3>{{ company }}</h3>
        <table class="table table-hovered">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="employee in employees" :key="employee.name">
                    <td>{{ employee.name }}</td>
                    <td>{{ employee.email }}</td>
                    <td><button v-on:click="deleteEmployee(employee.id)" class="btn btn-danger">Delete</button></td>
                </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
import axios from 'axios'

export default {
    data() {
        return  {
            employees: [],
            company: ''
        }
    },
    async created() {
        const response = await axios.get('/api/employees')
        this.employees = response.data.data
        this.company = response.data.company
    },

    methods: {
        async deleteEmployee(event) {
            const response = await axios.get(`/api/employees/${id}`)
        }
    }
}
</script>