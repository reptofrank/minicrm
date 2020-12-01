<template>
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
                <td><button v-on:click="deleteEmployee(employee.id)">Delete</button></td>
            </tr>
        </tbody>
    </table>
</template>

<script>
import axios from 'axios'

export default {
    data() {
        return  {
            employees: []
        }
    },
    async created() {
        const response = await axios.get('/api/employees')
        console.log(response.data.data)
        this.employees = response.data.data
    },

    methods: {
        async deleteEmployee(event) {
            const response = await axios.get(`/api/employees/${id}`)
        }
    }
}
</script>