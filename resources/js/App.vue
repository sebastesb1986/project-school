<template>
    <NavigationNav v-if="authenticated"/>
    <router-view/>
</template>

<script>

import { mapGetters, mapActions } from 'vuex';
import NavigationNav from '@/components/NavigationNav.vue';

export default {
    components: { NavigationNav },
    computed: {

        ...mapGetters({

            authenticated: 'auth/authenticated',
            user: 'auth/user'

        })
    },
    methods: {

        ...mapActions({
            signOutAction: 'auth/signOut'
        }),

        signOut() {
            this.signOutAction().then(() => {

                //this.$toast.success("Has finalizado tu sesión");

                this.$router.replace({
                name: 'login'
                })

            })
        }

    }

}

</script>
