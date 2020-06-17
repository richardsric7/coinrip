import Vue from 'vue'
import Vuex from 'vuex'
import * as constants from './constants'
import {baseUrl} from './constants';
import {secretKey} from './constants';
import createPersistedState from 'vuex-persistedstate'
import Cookies from 'js-cookie';
import {googleGeoCode} from "./constants";
import {googleKey} from "./constants";
import actions from './actions'
import state from './state'
import getters from './getters'
import mutations from './mutations'
Vue.use(Vuex)


const store = new Vuex.Store({
//State Start
    state: state,
    //State End

    plugins: [createPersistedState()],

//Getters Start
    getters: getters,
//Getters End

//Actions Start
    actions: actions,
//Actions End

//Mutations Start
    mutations: mutations,



})
export default store
