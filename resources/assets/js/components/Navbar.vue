<template>
  <nav class="navbar navbar-expand-lg navbar-expand-md navbar-expand-sm navbar-light bg-white">
    <div class="container">
      <router-link to="/" class="navbar-brand brand-image">
        <img style="height:48px;" src="./../../images/mpo_white_600_200.png" />
      </router-link>
      <div id="navbarToggler" class="navbar-collapse">
        <ul class="navbar-nav ml-auto">
          <template>
            <li class="nav-item">
              <router-link :to="{ name: 'home' }" class="dropdown-item">Home</router-link>
            </li>
            <li class="nav-item">
              <router-link to="/market_analysis_form" class="dropdown-item">Market Analysis Forms</router-link>
            </li>
            <li class="nav-item">
              <router-link to="/contact_us" class="dropdown-item">Contact Us</router-link>
            </li>
            <li class="nav-item">
              <router-link to="/cart" class="dropdown-item">Cart</router-link>
            </li>
            <!-- Autenticated -->
            <li v-if="user" class="nav-item dropdown">
              <a class="nav-link dropdown-toggle text-dark"
                 href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <img :src="user.photo_url" class="rounded-circle profile-photo mr-1">
                {{ user.name }}
              </a>
              <div class="dropdown-menu">
                <router-link :to="{ name: 'myorders' }" class="dropdown-item">
                  <fa icon="cog" fixed-width/>
                  My Orders
                </router-link>

                <div class="dropdown-divider"/>
                <a href="#" class="dropdown-item" @click.prevent="logout">
                  <fa icon="sign-out-alt" fixed-width/>
                  {{ $t('logout') }}
                </a>
              </div>
            </li>
            <!-- Guest -->
            <li v-else class="nav-item">
              <router-link :to="{ name: 'login' }" class="dropdown-item pl-3" active-class="active">
                {{ $t('login') }}
              </router-link>
            </li>
          </template>
          
            <!-- <li class="nav-item">
              <router-link :to="{ name: 'register' }" class="dropdown-item pl-3" active-class="active">
                {{ $t('register') }}
              </router-link>
            </li> -->
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
  width: 1.5rem;
  height: 1.5rem;
  margin: -.375rem 0;
}
.container {
  width:100% !important;
  max-width:100% !important;
}
li {
  height: 40px;
  padding: 4px 8px !important;
}
a {
  height: 32px;
  line-height:32px;
  padding:0 4px;
}
.brand-image {
  height: 60px;
  position: absolute;
  left: 0;
  top: 0;
  padding: 6px;
  background-color: #fff !important;
  border-bottom-right-radius: 6px;
  z-index:10;
}
</style>
