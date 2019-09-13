<template>
    <div class="tab text-center">
        <h3 class="social-title">Share it</h3>
        <div class="share-buttons">
            <!--Facebook-->
            <v-btn class="mx-2 btn_fb" dark large color="#3b5998">
                <v-icon small>fab fa-facebook-f</v-icon>
            </v-btn>
            <!--Twitter-->
            <v-btn class="mx-2 btn_tw" dark large color="#6cb7f0">
                <v-icon small>fab fa-twitter</v-icon>
            </v-btn>
            <!--Gmail-->
            <v-btn class="mx-2 btn_gmail" dark large color="#dd4b39">
                <v-icon small>fab fa-google</v-icon>
            </v-btn>
        </div>
        <div class="navigate text-right">
            <v-btn color="primary"@click="$emit('submit')">Done</v-btn>
        </div>
    </div>
</template>

<script>
    export default {
        name: "SocialTab"
    }
</script>

<style scoped>
    .social-title {
        font-size: 1.75rem;
        margin-bottom: .75rem;
        font-weight: 500;
        line-height: 1.2;
    }
    .btn_fb {
        background-color: #3b5998;
        color: #fff;
    }
    .btn_tw {
        background-color: #55acee;
        color: #fff;
    }
    .btn_gmail {
        background-color: #dd4b39;
        color: #fff;
    }
</style>
