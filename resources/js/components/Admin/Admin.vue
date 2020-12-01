<template>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    MiniCRM
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item hide-lg">
                            <router-link to="/admin" class="nav-link">Home</router-link>
                        </li>
                        <li class="nav-item hide-lg">
                            <router-link to="/admin/companies" class="nav-link">Companies</router-link>
                        </li>
                        <li class="nav-item hide-lg">
                            <router-link to="/admin/users" class="nav-link">users</router-link>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        <main>
            <aside class="side-nav">
                <div class="side-nav__content">
                    <nav class="side-nav__nav">
                        <ul class="side-nav__nav-list">
                            <li class="side-nav__nav-list-item">
                                <router-link to="/admin" class="side-nav__nav-link">Home</router-link>
                            </li>
                            <li class="side-nav__nav-list-item">
                                <router-link to="/admin/companies" class="side-nav__nav-link">Companies</router-link>
                            </li>
                            <li class="side-nav__nav-list-item">
                                <router-link to="/admin/users" class="side-nav__nav-link">Users</router-link>
                            </li>
                        </ul>
                    </nav>
                </div>
            </aside>
            <section class="content py-4">
                <router-view></router-view>
            </section>
        </main>
    </div>
</template>