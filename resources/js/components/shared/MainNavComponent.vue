<template>
  <nav class="main-header navbar navbar-expand-md navbar-light">
    <div class="container">
      <router-link to="/" class="navbar-brand">
        <div>CoinRip</div>
      </router-link>
      <!-- set progressbar -->
      <button
        class="navbar-toggler order-1"
        type="button"
        data-toggle="collapse"
        data-target="#navbarCollapse"
        aria-controls="navbarCollapse"
        aria-expanded="false"
        aria-label="Toggle navigation"
      >
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse order-3" id="navbarCollapse">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
          <li class="nav-item">
            <router-link to="/" class="nav-link">
              <span class=" text-bold">Coins</span>
            </router-link>
          </li>
                    <li class="nav-item">
            <router-link to="/" class="nav-link">
              <span class=" text-bold">Exchanges</span>
            </router-link>
          </li>
                    <li class="nav-item">
            <router-link to="/" class="nav-link">
              <span class=" text-bold">Charts</span>
            </router-link>
          </li>
                    <li class="nav-item">
            <router-link to="/" class="nav-link">
              <span class=" text-bold">API</span>
            </router-link>
          </li>
          <li class="nav-item" v-if="!isAuthenticated">
            <router-link to="/login" class="nav-link">
              <span class=" text-bold" >Admin Login</span>
            </router-link>
          </li>
          <li class="nav-item dropdown" v-if="isAuthenticated">
            <a
              id="dropdownSubMenu1"
              href="#"
              data-toggle="dropdown"
              aria-haspopup="true"
              aria-expanded="false"
              class="nav-link dropdown-toggle"
            >
              <span class=" text-bold">{{authName}}</span>
            </a>
            <ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow">
              <li v-if="isAuthenticated">
                <router-link to="/logout" class="dropdown-item">Logout</router-link>
              </li>
              <li class="dropdown-divider"></li>
              <li v-if="isAuthenticated">
                <router-link to="/dashboard" class="dropdown-item">Dashboard</router-link>
              </li>

              <li class="dropdown-divider"></li>
            </ul>
          </li>
        </ul>

        <!-- SEARCH FORM -->
      </div>

      <!-- Right navbar links -->

    </div>
  </nav>
</template>

<script>
import { mapActions, mapGetters, mapMutations } from "vuex";
export default {
  data() {
    return {
      form: new Form({

      }),
    };
  },

  methods: {

    changeCurrency(c){
      this.$store.state.chosenCurrency = c
    },
    logout() {
        // console.log('Logout starting')
      // Submit the form via a POST request
      this.form.post('/logout')
        .then(({ data }) => {
            console.log('logout sucessful')
             this.$store.dispatch('logoutUser', false)
            // console.log(data)
            })
        .catch(e => {
           console.log('Logout Failed!')
        })
    }
  },
  computed: {
    isAuthenticated() {
      return this.$store.state.isAuthenticated;
    },
    currencyName() {

        return this.$store.state.chosenCurrency

    },
    authName(){
      if(this.isAuthenticated === true){
        return this.userData.name
      }
      return 'Guest'
    },

    ...mapGetters({
      currencies: 'getCurrencies',
      userData: 'getUserData',
    })
  },
  mounted() {
    // console.log('menu nav mounted')
  },
  created() {
    //console.log('menu nav created')
          EventBus.$on("Logout", () => {
      // console.log("LogoutSignal Recieved!");
      pricesWs.close()
      this.$store.dispatch('logoutUser', false)
     Router.push('/login')
    });
          EventBus.$on("StopSocket", () => {
      // console.log("LogoutSignal Recieved!");
      // pricesWs.close()
              this.$store.state.websocketConnect = false
    });
  }
};
</script>
