<template>
    <div>
<pie-chart :data="chartData"
prefix="$"
thousands=","
:round="2"
:library="chartOptions"
></pie-chart>
    </div>

</template>

<script>
import { mapActions, mapGetters, mapMutations } from 'vuex'
    export default {
        data(){
            return {
                chartData:{},
                historyData:[],
                chartOptions: {
    //   layout: {
    //     padding: {left: 10, right: 5, top: 5, bottom: 2}
    //   },
      scales: {

      }
    }

            }
        },
        methods: {

       getData(c) {

                   let mainarr = []
               
            _.forEach(_.take(this.coinCapAssets,5), (val, index) => {
                //  console.log('Each Value:', val.name, 'MARKET CAP', val.marketCapUsd)
         
            let carr = []
            carr.push(val.name, val.marketCapUsd)
            mainarr.push(carr)
        
      
        })
        this.chartData = mainarr
        // console.log('ChartData', this.chartData)
        // console.log('MainArr', mainarr)


             


  
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
        created(){
            this.getData(this.asset)
        },
        mounted() {
                

        }
    }
</script>
<style scoped>

</style>