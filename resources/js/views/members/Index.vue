<template>
    <v-container class="fill-height" fluid>
        <v-row align="center" justify="center">
            <v-col cols="12" sm="12" md="8">
                <v-simple-table class="table_members">
                    <thead class="thead_dark">
                        <tr>
                            <th>Member</th>
                            <th>Full name</th>
                            <th>Report subject</th>
                            <th>Email</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-if="!members.data.length">
                            <td colspan="5">Members list is empty</td>
                        </tr>
                        <tr v-else v-for="member in members.data" :key="member.id">
                            <td class="pt-2 pb-2">
                                <v-avatar class="member-photo">
                                    <img v-if="member.photo" :src="member.photo" alt="member photo">
                                    <v-icon v-else dark x-large>account_circle</v-icon>
                                </v-avatar
                            ></td>
                            <td>{{ member.firstname + ' ' + member.lastname }}</td>
                            <td>{{ member.report }}</td>
                            <td><a :href="'mailto:' + member.email">{{ member.email }}</a></td>
                        </tr>
                    </tbody>
                </v-simple-table>

                <vue-pagination  :pagination="members" @paginate="loadMembers()" :offset="4"></vue-pagination>

            </v-col>
        </v-row>
    </v-container>
</template>
<script>
    import axios from 'axios';

    import VuePagination from '@/js/components/Pagination.vue';

    export default {
        components: {
            VuePagination,
        },
        data () {
            return {
                members: {
                    data: [],
                    total: 0,
                    per_page: 2,
                    from: 1,
                    to: 0,
                    current_page: 1
                },
                offset: 4,
            }
        },
        created() {
            this.loadMembers();
        },
        methods: {
            loadMembers() {
                axios.get(`/api/members?page=${this.members.current_page}`)
                    .then((response) => {
                        console.log(response);
                        this.members = response.data;
                    })
                    .catch(error => {
                        console.log(error.response);
                    });
            }
        }
    }
</script>

<style scoped>
    .table_members th {
        font-size: 1rem;
    }
    .table_members th, .table_members td {
        text-align: center;
        word-break: break-word;
    }
    .thead_dark th {
        color: #fff!important;
        background-color: #343a40;
        border-color: #454d55;
    }
    .member-photo {
        width: 90px!important;
        height: 90px!important;
        border: .25rem solid #efefef;
        background-color: #1976d2;
        overflow: hidden;
    }
    .member-photo img {
        width: 100%;
        height: auto;
        min-height: 100%;
    }
</style>
