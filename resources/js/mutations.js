export default {

    setIsAuthenticated(state, payload) {
        state.isAuthenticated = payload
    },
    saveUserData(state, payload) {
        state.userData = payload
    },

    saveCoinCapAssets(state, payload){
        state.coinCapAssets = payload
    },

    saveCoinMarketCapAssets(state, payload){
        state.coinMarketCapAssets = payload
    },
    saveGlobalMetrics(state, payload){
        state.globalMetrics = payload
    },
 
    setIsAuthenticated(state, payload) {

        state.isAuthenticated = payload

        // console.log('isAuthenticated: ', state.isAuthenticated)
    },


    setLoginSession(state, payload) {


        // console.log('customerInfo After SetLoginSession: ', state.customerInfo)



    },


}
