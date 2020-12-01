<template>
    <table class="table table-hovered">
        <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Role</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <tr v-for="user in users" :key="user.name" v-bind:data-id="user.id">
                <td>{{ user.name }}</td>
                <td>{{ user.email }}</td>
                <td>{{ user.role }}</td>
                <td><button v-on:click="deleteUser">Delete</button></td>
            </tr>
        </tbody>
    </table>
</template>

<script>
import axios from 'axios'

export default {
    data() {
        return  {
            users: []
        }
    },
    async created() {
        const response = await axios.get('/api/admin/users')
        this.users = response.data.data
    },

    methods: {
        async deleteUser(e) {
            console.log(e.target.closest('tr').dataset.id)
            // const res = confirm('Are you sure you want to delete this user?')
            // if(res) {
            //     const response = await axios.delete(`/api/admin/users/${id}`)
            //     if(response.status === 204) alert('user deleted successfully')
            // }
        }
    }
}
</script>