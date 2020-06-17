import store from "./appstore";

let routes = [{
        path: '/',
        component: require('./components/LandingPageComponent').default
    },
    {
        path: '/login',
        component: require('./components/auth/LoginComponent').default
    },

    {
        path: '/logout',
        component: require('./components/auth/LoginComponent').default,
        beforeEnter: (to, from, next) => {
            //clear the login session
            store.dispatch('logoutUser').then(() => {
                next()
            })

        }
    },
    {
        path: '/pwdreset',
        component: require('./components/PasswordResetComponent').default,
        meta: {
            requiresAuth: false
        },
        //     beforeEnter: (to, from, next) => {
        //         // console.log('Password Reset dispatched')
        //         store.dispatch('pwdReset')
        //         next(false)
        // }
    },



    { path: '/dashboard', name: 'dashboard', component: require('./components/DashboardComponent').default,
        meta: {
            requiresAuth: true,
            requiresOTP: true
        },
         },


    {
        path: '*',
        component: require('./components/LandingPageComponent').default
    },

]

export default routes
