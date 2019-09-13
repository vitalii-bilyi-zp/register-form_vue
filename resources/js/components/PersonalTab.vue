<template>
    <div class="tab">
        <v-form>
            <v-text-field label="First Name" v-model="post.firstname" required :error="!!errors.firstname" :error-messages="errors.firstname"></v-text-field>
            <v-text-field label="Last Name" v-model="post.lastname" required :error="!!errors.lastname" :error-messages="errors.lastname"></v-text-field>

            <!-- birthdate input -->
            <v-menu
                v-model="menu"
                :close-on-content-click="false"
                :nudge-right="40"
                transition="scale-transition"
                offset-y
                min-width="290px"
            >
                <template v-slot:activator="{ on }">
                    <v-text-field
                        v-model="post.birthdate"
                        label="Birth Date"
                        append-icon="event"
                        readonly
                        v-on="on"
                        :error="!!errors.birthdate"
                        :error-messages="errors.birthdate"
                    ></v-text-field>
                </template>
                <v-date-picker v-model="post.birthdate" @input="menu = false" :max="new Date().toJSON()"></v-date-picker>
            </v-menu>
            <!--  -->

            <v-text-field label="Report Subject" v-model="post.report" required :error="!!errors.report" :error-messages="errors.report"></v-text-field>
            <v-select label="Country" v-model="post.country_id" :items="countries" item-value="id" item-text="name" required :error="!!errors.country_id" :error-messages="errors.country_id"></v-select>
            <v-text-field label="Phone" v-model="post.phone" v-mask="'+1 (###) ###-####'" required :error="!!errors.phone" :error-messages="errors.phone"></v-text-field>
            <v-text-field label="Email" v-model="post.email" required :error="!!errors.email" :error-messages="errors.email"></v-text-field>
            <div class="navigate text-right">
                <v-btn color="primary" @click="$emit('goToNext', post)">Next</v-btn>
            </div>
        </v-form>
    </div>
</template>

<script>
    import { mask } from 'vue-the-mask'

    export default {
        name: "PersonalTab",
        directives: {
            mask,
        },
        data() {
            return {
                menu: false,
                post: {
                    firstname: null,
                    lastname: null,
                    birthdate: null,
                    report: null,
                    country_id: null,
                    phone: null,
                    email: null
                },
                countries: [
                    {
                        id: 1,
                        name: 'United States'
                    },
                    {
                        id: 2,
                        name: 'Ukraine'
                    },
                ]
            }
        },
        computed: {
            member() {
                return this.$store.state.member;
            },
            errors() {
                return this.$store.state.validationErrors;
            }
        },
        created() {
            this.loadData();
        },
        methods: {
            loadData() {
                Object.keys(this.post).forEach((key) => this.post[key] = this.member[key]);
            }
        }
    }
</script>
