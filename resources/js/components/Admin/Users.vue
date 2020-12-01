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
            <tr v-for="user in users" :key="user.name">
                <td>{{ user.name }}</td>
                <td>{{ user.email }}</td>
                <td>{{ user.url }}</td>
                <td><button v-on:click="deleteUser(user.id)">Delete</button></td>
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
        deleteUser(id) {
            console.log('delete user: ' + id)
        }
    }
}
</script>