import { baseUrl, googleGeoCode, googleKey, secretKey } from "./constants";
var axiosX = require("axios");

export default {

fetchAssets(context){
    //set header or remove
    return axios.get('/marketdata/marketassets')
    .then(({data}) => {
        // console.log('Fetched Assets:',data.payload)
        context.commit("saveCoinCapAssets", data.payload['coincap']['data'])
        // console.log(context.state.coinCapAssets)
        context.commit("saveCoinMarketCapAssets", data.payload['coinmarketcap'])
        // console.log(context.state.coinMarketCapAssets)
        context.commit("saveGlobalMetrics", data.payload['globalmetrics'])
        // console.log(context.state.globalMetrics)
    
    })
    .catch(e => {
        throw e;
    });
},

    logoutUser(context) {
        axios.post('/logout')
        .then(({data})=>{
        context.commit("setIsAuthenticated", false)
        context.commit("saveUserData", null)
        Swal.fire({
            position: 'top-end',
            icon: 'success',
            title: 'Signed out successfully!',
            showConfirmButton: false,
            timer: 2000,
            toast: true
        });
        })
        .catch((e)=>{
            console.log('logoutfailed')
        })

    //     context.commit("setCustomerGPSLocation", {});

    //     context.commit("setRestaurants", []);

    //     context.commit("setRestaurantSearchTag", "");

    //     context.commit("setCustomerAddress", "");
    //     context.commit("setIsAuthenticated", false);
    //     context.commit("setLoginSession", {});
    //     context.commit("setLoginSMData", {});
    //     context.commit("saveCustomerWallet", {});
    //     context.commit("saveCartList", []);
    //     context.commit("setBookedID", "");
    //     context.commit("setRestaurantReviews", []);
    //     context.commit("setFoodMenu", []);
    //     context.commit("setRestaurant", {});

    //     context.commit("setSmRegistrationUpdateForm", {});

    },


    Dummy(context, payload) {
        return context
            .dispatch("fetchAccessCode")
            .then(() => {
                axios.defaults.headers.common["Access-Code"] =
                    context.state.accessCode.code;
                return axios
                    .post(baseUrl + "customer/wallet", {
                        country_name: _.get(payload, "country_name", "Nigeria"),
                        customer_id: context.getters.getCustomerID
                    })
                    .then(response => {
                        if (response.data.status === "success") {
                            //commit wallet values
                            context.commit("saveCustomerWallet", {
                                edpoints: _.get(response.data, "edpoints", 0),
                                loyalty_points: _.get(
                                    response.data,
                                    "loyalty_points",
                                    0
                                )
                            });
                            return {
                                status: "success"
                            };
                        } else {
                            return {
                                status: "fail"
                            };
                        }
                    })
                    .catch(e => {
                        throw e;
                    });
            })
            .catch(e => {
                // console.log('access code exception: ', e)

                throw e;
            });
    },

};
