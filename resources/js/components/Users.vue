<template>
    <div class="container-fluid">
        <h3>Users</h3>
        <table class="table table-hovered">
            <thead>
                <tr>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="user in users" :key="user.email" v-bind:data-id="user.id">
                    <td>{{ user.email }}</td>
                    <td>{{ user.role }}</td>
                    <td><button v-on:click="deleteUser" class="btn btn-danger">Delete</button></td>
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
            users: []
        }
    },
    async created() {
        const response = await axios.get('/api/admin/users')
        console.log(response)
        this.users = response.data
    },

    methods: {
        async deleteUser(e) {
            const row = e.target.closest('tr');
            const id = row.dataset.id
            const res = confirm('Are you sure you want to delete this user?')
            if(res) {
                const response = await axios.delete(`/api/admin/users/${id}`)
                if(response.status === 204) {
                    row.style.display = 'none';
                    alert('user deleted successfully')
                }
            }
        }
    }
}
</script>