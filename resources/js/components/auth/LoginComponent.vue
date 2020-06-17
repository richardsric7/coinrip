<template>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Login</div>

                <div class="card-body">
  <form @submit.prevent="login" @keydown="form.onKeydown($event)">
    <div class="form-group">
      <label>Email</label>
      <input v-model="form.email" type="text" name="email"
      required
        class="form-control" :class="{ 'is-invalid': form.errors.has('email') }">
      <has-error :form="form" field="email"></has-error>
    </div>

    <div class="form-group">
      <label>Password</label>
      <input v-model="form.password" type="password" name="password"
      required
        class="form-control" :class="{ 'is-invalid': form.errors.has('password') }">
      <has-error :form="form" field="password"></has-error>
    </div>

    <button :disabled="form.busy" type="submit" class="btn btn-primary">Log In</button>
  </form>
                </div>
            </div>
        </div>
    </div>
</div>
</template>

<script>
    export default {
        data () {
    return {
      // Create a new form instance
      form: new Form({
        email: '',
        password: '',
        remember: false
      })
    }
  },

  methods: {
    login () {
        console.log('Login starting')
      // Submit the form via a POST request
      this.form.post('/login')
        .then(({ data }) => {
            console.log('login sucessful')
            axios.get('/user')
            .then(({data}) => {
            this.$store.commit('saveUserData', data)
            this.$store.commit('setIsAuthenticated', true)
            Router.push('/dashboard')
            })
           })
        .catch(e => {
           console.log('Login Failed!')
        })
    }
  },
        mounted() {
            // console.log('Login Component mounted.')
            EventBus.$emit('StopSocket')
            this.$store.dispatch('logoutUser', false)
        }
    }
</script>
