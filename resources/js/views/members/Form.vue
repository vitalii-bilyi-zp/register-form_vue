<template>
    <v-container class="fill-height" fluid>
        <v-row align="center" justify="center">
            <v-col cols="12" sm="12" md="8">
                <v-card class="elevation-12">
                    <v-card-title class="form-title">To participate in the conference, please fill out the form <a href="#" class="count">All members(0)</a></v-card-title>
                    <v-card-text>
                        <personal-tab @goToNext="goToNext" v-if="step === 0"></personal-tab>
                        <work-tab @goToNext="goToNext" v-if="step === 1"></work-tab>
                        <social-tab @submit="submit" v-if="step === 2"></social-tab>
                    </v-card-text>
                    <p>{{$store.state.member}}</p>
                </v-card>
            </v-col>
        </v-row>
    </v-container>
</template>

<script>
    import axios from 'axios';

    import PersonalTab from '@/js/components/PersonalTab';
    import WorkTab from '@/js/components/WorkTab';
    import SocialTab from '@/js/components/SocialTab';

    export default {
        components: {
            PersonalTab,
            WorkTab,
            SocialTab
        },
        data() {
            return {
                step: 0
            }
        },
        computed: {
            member() {
                return this.$store.state.member;
            }
        },
        created() {
            if (this.$cookie.get('currentStep')) {
                this.step = +this.$cookie.get('currentStep');
            }
            if (this.$cookie.get('memberId')) {
                this.loadMember(this.$cookie.get('memberId'));
            }
        },
        methods: {
            loadMember(id) {
                axios.get(`api/members/${id}`)
                    .then((response) => {
                        console.log(response);
                        this.storeData(response.data);
                    })
                    .catch(error => {
                        console.log(error.response);
                    });
            },
            // goToPrev() {
            //   this.step--;
            // },
            goToNext(post) {
                this.storeData(post);
                this.sendForm();
            },
            storeData(obj) {
                this.$store.dispatch("updateMember", obj);
            },
            sendForm() {
                let form = this.toFormData(this.member);
                let options = {
                    method: 'POST',
                    headers: { 'content-type': 'application/form-data' },
                    data: form,
                    url: '/api/members',
                };
                if(this.$cookie.get('memberId')) {
                    options.url += `/${this.$cookie.get('memberId')}`;
                }

                axios(options).then((response) => {
                        console.log(response);
                        if('memberId' in response.data) {
                            this.$cookie.set('memberId', response.data.memberId, 1);
                        }
                        this.$store.dispatch("clearValidationErrors");
                        this.showNextTab();
                    })
                    .catch(error => {
                        console.log(error.response);
                        if (error.response.status === 422) {
                            this.$store.dispatch("setValidationErrors", error.response.data.errors);
                        }
                    });
            },
            toFormData: function(obj) {
                return Object.keys(obj).reduce((formData, key) => {
                    if(obj[key]) {
                        formData.append(key, obj[key]);
                    }
                    return formData;
                }, new FormData());
            },
            showNextTab() {
                this.step++;
                this.$cookie.set('currentStep', this.step, 1);
            },
            submit() {
                this.$cookie.delete('memberId');
                this.$cookie.delete('currentStep');
                this.$store.dispatch("clearMember");
                this.step = 0;
            }
        }
    }
</script>

<style scoped>
    .form-title {
        background-color: #1976d2;
        font-size: 1.2rem;
        color: #fff;
        flex-direction: column;
        justify-content: center;
        text-align: center;
        word-break: break-word;
    }
    .count {
        color: #fff;
        font-size: 0.975rem;
        transition: opacity .15s ease-in-out;
    }
    .count:hover {
        opacity: 0.8;
    }
    .tab {
        padding-top: 1rem;
    }
</style>
