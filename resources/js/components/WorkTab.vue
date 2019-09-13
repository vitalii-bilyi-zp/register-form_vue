<template>
    <div class="tab">
        <v-form>
            <v-text-field label="Company" v-model="post.company"></v-text-field>
            <v-text-field label="Position" v-model="post.position"></v-text-field>
            <v-textarea label="About Me" v-model="post.about"></v-textarea>
            <v-file-input label="Add Photo" v-model="post.photo" prepend-icon="" append-icon="attach_file" clearable clear-icon="clear"></v-file-input>
            <div class="navigate text-right">
                <v-btn color="primary" @click="$emit('goToNext', post)">Next</v-btn>
            </div>
        </v-form>

    </div>
</template>

<script>
    export default {
        name: "WorkTab",
        data() {
            return {
                post: {
                    company: null,
                    position: null,
                    about: null,
                    photo: null
                }
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
            this.loadFormData();
        },
        methods: {
            loadFormData() {
                Object.keys(this.post).forEach((key) => this.post[key] = this.member[key]);
            }
        }
    }
</script>
