<template>
  <div class="main-layout" style="width:100%;float:left;">
    <admin-navbar v-if="user && user.admin"></admin-navbar>
    <navbar/>

    <div class="mt-4" style="width:100%;float:left;">
      <child/>
    </div>
  </div>
</template>

<script>
import { mapGetters } from 'vuex'
import Navbar from '~/components/Navbar'
import AdminNavbar from '~/components/admin_navbar'

export default {
  name: 'MainLayout',

  components: {
    Navbar,
    AdminNavbar
  },
  computed: mapGetters({
    user: 'auth/user'
  })
}
</script>
<style src="@fortawesome/fontawesome-free/css/all.css"></style>
