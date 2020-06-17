export default {

    getIsAuthenticated(state) {

    return state.isAuthenticated
},
    getUserData(state) {

    return state.userData
},

getCoinCapAssets(state){
    return state.coinCapAssets
},
getCoinMarketCapAssets(state){
    return state.coinMarketCapAssets
},

getChosenCurrency(state){
    return state.chosenCurrency
},
getGlobalMetrics(state){
    return state.globalMetrics
},
getCurrencies(state){
    return state.currencies
},

}
