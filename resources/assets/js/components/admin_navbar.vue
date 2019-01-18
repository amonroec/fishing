<template>
  <nav style="background-color:#262626 !important;" class="navbar navbar-expand-lg"><div id="navbarToggler" class="collapse navbar-collapse">
        <ul class="navbar-nav ml-auto">
          <!-- Authenticated -->
          <!-- If Admin User -->
          <template v-if="user && user.admin === 1">
            <li class="nav-item">
              <router-link :to="{ name: 'admin' }" class="dropdown-item">Customer Admin</router-link>
            </li>
            <li class="nav-item">
              <router-link :to="{ name: 'forms_table' }" class="dropdown-item">Forms Table</router-link>
            </li>
            <li class="nav-item">
              <router-link :to="{ name: 'orders_table' }" class="dropdown-item">Orders</router-link>
            </li>
          </template>
        </ul>
      </div>
    </div>
  </nav>
</template>

<script>
import { mapGetters } from 'vuex'
import LocaleDropdown from './LocaleDropdown'

export default {
  components: {
    LocaleDropdown
  },

  data: () => ({
    appName: window.config.appName
  }),

  computed: mapGetters({
    user: 'auth/user'
  }),

  mounted: function () {
  	console.log(this.user)
  },

  methods: {
    async logout () {
      // Log out the user.
      await this.$store.dispatch('auth/logout')

      // Redirect to login.
      this.$router.push({ name: 'login' })
    }
  }
}
</script>

<style scoped>
.profile-photo {
  width: 2rem;
  height: 2rem;
  margin: -.375rem 0;
}
.container {
  width:100% !important;
  max-width:100% !important;
}
.dropdown-item {
  color: #efefef;
  font-size: .75rem;
}  
.dropdown-item:hover {
  background-color:#131313;
}
/*.dropdown {
  float: left;
  overflow: hidden;
}*/

/* Dropdown button */
.dDown .dropbtn {
  font-size: 16px; 
  border: none;
  outline: none;
  color: white;
  padding: 14px 16px;
  background-color: inherit;
  font-family: inherit; /* Important for vertical align on mobile phones */
  margin: 0; /* Important for vertical align on mobile phones */
}

/* Dropdown content (hidden by default) */
.dDown-content {
  display: none;
  position: absolute;
  background-color: #f9f9f9;
  min-width: 160px;
  box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
  z-index: 1;
  top: 40px;
}

/* Links inside the dropdown */
.dDown-content a {
  float: none;
  color: black;
  padding: 12px 16px;
  text-decoration: none;
  display: block;
  text-align: left;
}

/* Show the dropdown menu on hover */
.dDown:hover .dDown-content {
  display: block;
}
</style>
