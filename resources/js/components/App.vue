<template>
    <div>
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="/">
                    MiniCRM
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle Navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item" v-if="user.role === 'admin'">
                            <a class="nav-link" href="/admin">Dashboard</a>
                        </li>
                        <li class="nav-item" v-if="user.role === 'company'">
                            <router-link class="nav-link" to="/employees">Employees</router-link>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/logout" v-if="user.role">Logout</a>
                            <a class="nav-link" href="/login" v-else>Login</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            <div class="container">
                <router-view></router-view>
            </div>
        </main>
    </div>
</template>

<script>
import axios from 'axios'

export default {
    data() {
        return  {
            user: false,
        }
    },
    created() {
        this.checkUser()
    },

    methods: {
        checkUser() {
            axios.get(`/user`)
            .then(response => {
                // console.log(response.data)
                this.user = response.data
                // console.log(response.data)
            })
        }
    }
}
</script>