<template>
    <table class="table table-hovered">
        <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>URL</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>
                    <a href="#">Name</a>
                </td>
                <td>
                    <a href="#">Email</a>
                </td>
                <td>
                    <a href="#">Url</a>
                </td>
            </tr>
        </tbody>
    </table>
</template>

<script>
export default {
    data() {
        return  {
            companies: [],
            company: {
                name: '',
                url: '',
                logo: '',
                email: ''
            },
            pagination: {}
        }
    },
    created() {
        this.fetchCompanies();
    },

    methods: {
        fetchCompanies() {
            fetch('')
        }
    }
}
</script>