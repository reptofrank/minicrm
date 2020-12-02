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
            users: [],
            page: {}
        }
    },
    async created() {
        this.fetchUsers()
    },
    components: {
        pagination: Pagination
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
        },
        async fetchUsers(page = 1){
            const response = await axios.get(`/api/admin/users?page=${page}`)
            let {next, prev, current_page} = {...response.data.links, ...response.data.meta}
            this.users = response.data.data
            this.page = {next, prev, current_page}
        },
        previousPage(){
            if(this.page.prev) {
                this.fetchUsers(this.page.current_page - 1)
            }
        },
        nextPage(){
            if(this.page.next) {
                this.fetchUsers(this.page.current_page + 1)
            }
        }
    }
}
</script>