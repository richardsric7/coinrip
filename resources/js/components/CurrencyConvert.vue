<template>
    <div>
        <modal name="convert"
               :adaptive="true"
               height="auto"
               :scrollable="true"
               @before-open="beforeOpenConvert"
               @before-close="beforeClose">
            <!--start vform-->
            <div class="col-sm-12" v-if="showModal">
                <div class="card">
                    <div class="card-header">
                        <h2>Currency Conversion</h2>
                    </div>
                    <div class="card-block">
                        <div class="row">
                        <div class="col-md-12">
                            <span><h2>
                                {{cu.s.symbol}}-USD <i class="fas fa-exchange-alt"></i> {{cu.s['symbol']}}-{{cu.c[0]}}
                            </h2></span>
                        </div>


                        <div class="col-md-12">
                            <span v-if="conversion.rateUsd < 2">{{conversion.currencySymbol? conversion.currencySymbol:conversion.symbol}}1.00{{cu.c[0]}} = {{conversion.rateUsd | currency('$',8)}} USD</span>
                            <span v-else>{{conversion.currencySymbol? conversion.currencySymbol:conversion.symbol}}1.00{{cu.c[0]}} = {{conversion.rateUsd | currency('$',2)}} USD</span>
                        </div>

                        <div class="col-md-12">
                            <span v-if="cu.s['priceUsd'] < 2">
                                1 {{cu.s.symbol}} = {{cu.s['priceUsd'] | currency('$',8)}} USD
                            </span>
                            <span v-else>
                                1 {{cu.s.symbol}} = {{cu.s['priceUsd'] | currency('$',2)}} USD
                            </span>
                          
                        </div>

                        <div class="col-md-12">
                         <span>1 {{cu.s.symbol}} = {{(cu.s['priceUsd']/conversion.rateUsd) |  currency(conversion.currencySymbol? conversion.currencySymbol:conversion.symbol,2)}} {{cu.c[0]}}</span>
                        </div>


                        <div class="col-md-12">
                            <button type="button" @click.prevent="hideConvert" class="btn btn-primary">Close</button>
                        </div>
                    </div>

                    </div>

                </div>
            </div>

            <!--end vform-->
        </modal>
    </div>

</template>

<script>
import { mapActions, mapGetters, mapMutations } from 'vuex'
    export default {
        data(){
            return {
                cu: null,
                conversion:null,
                showModal: false,
                data: [{"priceUsd":"6643.7960247882660328","time":1586995200000,"circulatingSupply":"18327262.0000000000000000","date":"2020-04-16T00:00:00.000Z"},{"priceUsd":"6646.4981634169260251","time":1587016800000,"circulatingSupply":"18327712.0000000000000000","date":"2020-04-16T06:00:00.000Z"},{"priceUsd":"7028.7246868470045093","time":1587038400000,"circulatingSupply":"18328200.0000000000000000","date":"2020-04-16T12:00:00.000Z"},{"priceUsd":"7012.8558462925602113","time":1587060000000,"circulatingSupply":"18328737.0000000000000000","date":"2020-04-16T18:00:00.000Z"},{"priceUsd":"7115.2023277063123838","time":1587081600000,"circulatingSupply":"18329200.0000000000000000","date":"2020-04-17T00:00:00.000Z"},{"priceUsd":"7079.4658872822906985","time":1587103200000,"circulatingSupply":"18329625.0000000000000000","date":"2020-04-17T06:00:00.000Z"},{"priceUsd":"7091.6800048635779326","time":1587124800000,"circulatingSupply":"18330000.0000000000000000","date":"2020-04-17T12:00:00.000Z"},{"priceUsd":"7052.3154072095059939","time":1587146400000,"circulatingSupply":"18330350.0000000000000000","date":"2020-04-17T18:00:00.000Z"},{"priceUsd":"7044.4005573152295454","time":1587168000000,"circulatingSupply":"18330762.0000000000000000","date":"2020-04-18T00:00:00.000Z"},{"priceUsd":"7114.4482593638173516","time":1587189600000,"circulatingSupply":"18331250.0000000000000000","date":"2020-04-18T06:00:00.000Z"},{"priceUsd":"7111.3607682103709688","time":1587211200000,"circulatingSupply":"18331737.0000000000000000","date":"2020-04-18T12:00:00.000Z"},{"priceUsd":"7201.8837928830828852","time":1587232800000,"circulatingSupply":"18332287.0000000000000000","date":"2020-04-18T18:00:00.000Z"},{"priceUsd":"7256.6978717671476464","time":1587254400000,"circulatingSupply":"18332775.0000000000000000","date":"2020-04-19T00:00:00.000Z"},{"priceUsd":"7141.9716708570285235","time":1587276000000,"circulatingSupply":"18333225.0000000000000000","date":"2020-04-19T06:00:00.000Z"},{"priceUsd":"7170.9853381945658079","time":1587297600000,"circulatingSupply":"18333600.0000000000000000","date":"2020-04-19T12:00:00.000Z"},{"priceUsd":"7165.7888000398233940","time":1587319200000,"circulatingSupply":"18334112.0000000000000000","date":"2020-04-19T18:00:00.000Z"},{"priceUsd":"7133.1576767874055998","time":1587340800000,"circulatingSupply":"18334662.0000000000000000","date":"2020-04-20T00:00:00.000Z"},{"priceUsd":"7187.8063940546746057","time":1587362400000,"circulatingSupply":"18335187.0000000000000000","date":"2020-04-20T06:00:00.000Z"},{"priceUsd":"6984.7853749717708231","time":1587384000000,"circulatingSupply":"18335612.0000000000000000","date":"2020-04-20T12:00:00.000Z"},{"priceUsd":"6883.7141828386075253","time":1587405600000,"circulatingSupply":"18336125.0000000000000000","date":"2020-04-20T18:00:00.000Z"},{"priceUsd":"6849.9982226600979313","time":1587427200000,"circulatingSupply":"18336650.0000000000000000","date":"2020-04-21T00:00:00.000Z"},{"priceUsd":"6900.5594765736982433","time":1587448800000,"circulatingSupply":"18337075.0000000000000000","date":"2020-04-21T06:00:00.000Z"},{"priceUsd":"6814.4644985592612458","time":1587470400000,"circulatingSupply":"18337500.0000000000000000","date":"2020-04-21T12:00:00.000Z"},{"priceUsd":"6905.2279006283866509","time":1587492000000,"circulatingSupply":"18338062.0000000000000000","date":"2020-04-21T18:00:00.000Z"},{"priceUsd":"6856.2759779171636013","time":1587513600000,"circulatingSupply":"18338487.0000000000000000","date":"2020-04-22T00:00:00.000Z"},{"priceUsd":"6915.5639155405823393","time":1587535200000,"circulatingSupply":"18339037.0000000000000000","date":"2020-04-22T06:00:00.000Z"},{"priceUsd":"6964.9111944503852508","time":1587556800000,"circulatingSupply":"18339550.0000000000000000","date":"2020-04-22T12:00:00.000Z"},{"priceUsd":"7091.2173076718522306","time":1587578400000,"circulatingSupply":"18339837.0000000000000000","date":"2020-04-22T18:00:00.000Z"}],

            }
        },
        methods: {

            async getConversion(c, s){
                await axios.get('/marketdata/convert?currency='+c[0] + '&symbol='+s.symbol)
                .then(({data}) => {
                    this.conversion = data.payload
                    // console.log(this.conversion)
                    this.showModal = true
                })
            },
            async getCoinCapRates(c, s){
                await axios.get('/marketdata/coincaprates?currency_id='+c[1])
                .then(({data}) => {
                    this.conversion = data.payload['data']
                    // console.log('CoinCapRates',this.conversion)
                    this.showModal = true
                })
            },

            hideConvert() {
                this.beforeClose()
                this.$modal.hide('convert');
            },
            beforeOpenConvert(event) {
                // console.log('Convert Recvd Data',event.params);
                this.cu = event.params
                // this.getConversion(this.cu.c, this.cu.s)
                this.getCoinCapRates(this.cu.c, this.cu.s)
                
            },
            beforeClose() {
                this.showModal = false
                this.cu = null
                this.conversion = null
            },

        },
                computed:{
            ...mapGetters({
                coinCapAssets: 'getCoinCapAssets',
                coinMarketCapAssets: 'getCoinMarketCapAssets',
                globalMetrics: 'getGlobalMetrics',
                currencies: 'getCurrencies',
                
            }),
            currencyName() {
     
        return this.$store.state.chosenCurrency
  
    },




        },
        mounted() {
            // console.log('Component mounted.')
        }
    }
</script>
<style scoped>
.card div{
    display: inline-flex;
    justify-content: center;
}
</style>