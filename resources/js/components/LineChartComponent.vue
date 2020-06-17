<template>
    <div>
<line-chart :data="chartData" width="100px" height="60px" :min="null" :legend="false"
:library="chartOptions"
:dataset="{pointRadius:0,
    pointBorderWidth:0,
    
    }"
></line-chart>
    </div>

</template>

<script>
import { mapActions, mapGetters, mapMutations } from 'vuex'
    export default {
        props:['asset'],
        data(){
            return {
                chartData:{},
                historyData:[],
                chartOptions: {
    //   layout: {
    //     padding: {left: 10, right: 5, top: 5, bottom: 2}
    //   },

      scales: {
        xAxes: [{
          display: false // this hides the x-axis
        }],
        yAxes: [{
          display: false // this hides the y-axis
        }]
      }
    }

            }
        },
        methods: {

       getData(c) {
        //    console.log('URL: ','marketdata/coincapassethistory?currency_id='+c.id)
               axios.get('marketdata/coincapassethistory?currency_id='+c.id)
               .then(({data}) => {
                   this.historyData = data.payload.data
                //    console.log('Response Data', data.payload.data)
                   let mainarr = []
               
            _.forEach(this.historyData, (val, index) => {
                // console.log('Each Value:', val, 'TIMESTAMP', val.date, 'PRICEUSD', val.priceUsd, 'STRINGIFY', JSON.stringify(val))
         
            let carr = []
            carr.push(val.date, val.priceUsd)
            mainarr.push(carr)
        
      
        })
        this.chartData = mainarr
        // console.log('ChartData',c.id, this.chartData)
        // console.log('MainArr', mainarr)

               })
             


  
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