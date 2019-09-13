<template>
    <v-app id="inspire">
        <v-content>
            <div>
                <h1>Vue Router Demo App</h1>
                <p>
                    <router-link :to="{ name: 'members.form' }">Register</router-link> |
                    <router-link :to="{ name: 'members.index' }">Members</router-link>
                </p>
                <div class="container">
                    <router-view></router-view>
                </div>
            </div>
        </v-content>
    </v-app>
</template>
<script>
    export default {
        name: 'App'
    }
</script>
