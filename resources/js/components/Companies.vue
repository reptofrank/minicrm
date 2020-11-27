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
            <tr v-for="company in companies" :key="company.name">
                <td>{{ company.name }}</td>
                <td>{{ company.email }}</td>
                <td>{{ company.url }}</td>
            </tr>
        </tbody>
    </table>
</template>

<script>
export default {
    data() {
        return  {
            companies: []
        }
    },
    created() {
        this.fetchCompanies();
    },

    methods: {
        fetchCompanies() {
            // fetch('/api/companies', {credentials: "same-origin"})
            // .then(response => response.json())
            // .then(companies => {
            //     console.log(this.companies)
            //     this.companies = [
            //         {
            //             name: 'Cravvings',
            //             email: 'hello@cravvings.com',
            //             url: 'cravvings.com'
            //         }
            //     ]
            // })
            this.companies = [
                    {
                        name: 'Cravvings',
                        email: 'hello@cravvings.com',
                        url: 'cravvings.com'
                    }
                ]
        }
    }
}
</script>