<template>
    <div>

<div class="row globalmetrics justify-content-center ">
    <div class="d-flex flex-row col-md-6">
<div class="col-md-4 p-3 flex-nowrap flex">
    <div class="d-flex justify-content-lg-center col-6 font-weight-bold">MARKET CAP</div>
    <div class="d-flex justify-content-lg-center col-6">${{globalMetrics.data['quote']['USD']['total_market_cap'] | number('0.00a')}}</div>
</div>
<div class="col-md-4 p-3 flex-nowrap flex">
        <div class="d-flex justify-content-lg-center col-6 font-weight-bold">TOTAL VOL</div>
    <div class="d-flex justify-content-lg-center col-6">${{globalMetrics.data['quote']['USD']['total_volume_24h'] | number('0.00a')}}</div>
</div>
<div class="col-md-4 p-3 flex-nowrap flex">
        <div class="d-flex justify-content-lg-center col-6 font-weight-bold">ASSETS</div>
    <div class="d-flex justify-content-lg-center col-6">{{globalMetrics.data['active_cryptocurrencies'] | number('0.00a')}}</div>
</div>
</div>
<div class="d-flex flex-row col-md-6">
<div class="col-md-4 p-3 flex-nowrap flex">
        <div class="d-flex justify-content-lg-center col-6 font-weight-bold">EXCHANGES</div>
    <div class="d-flex justify-content-lg-center col-6">{{globalMetrics.data['active_exchanges'] | number('0.00a')}}</div>
</div>
<div class="col-md-4 p-3 flex-nowrap flex">
        <div class="d-flex justify-content-lg-center col-6 font-weight-bold">MARKETS</div>
    <div class="d-flex justify-content-lg-center col-6">{{globalMetrics.data['active_market_pairs'] | number('0.00a')}}</div>
</div>
<div class="col-md-4 p-3 flex-nowrap flex">
        <div class="d-flex justify-content-lg-center col-6 font-weight-bold">BTC DOM INDEX</div>
    <div class="d-flex justify-content-lg-center col-6">{{globalMetrics.data['btc_dominance'] | percent(1)}}</div>
</div>
</div>
</div>

<table class="table table-hover">
  <thead class="font-weight-bold">

      <td :class="{sorted: icons['rank'][1]}" class=""><a @click="sortData('rank')" href="#">Rank</a></td>
      <td :class="{sorted: icons['name'][1]}"  class="pl-0"><a @click="sortData('name')" href="#">Name</a></td>
      <td :class="{sorted: icons['priceUsd'][1]}"  class="pl-0"><a @click="sortData('priceUsd')" href="#">Price</a></td>
      <td :class="{sorted: icons['marketCapUsd'][1]}"  class="tab pl-0"><a @click="sortData('marketCapUsd')" href="#">Market Cap</a></td>
      <td :class="{sorted: icons['vwap24Hr'][1]}"  class="desk"><a @click="sortData('vwap24Hr')" href="#">VWAP(24Hr)</a></td>
      <td :class="{sorted: icons['supply'][1]}"  class="desk"><a @click="sortData('supply')" href="#">Supply</a></td>
      <td :class="{sorted: icons['volumeUsd24Hr'][1]}"  class="tab"><a @click="sortData('volumeUsd24Hr')" href="#">Vol.(24Hr)</a></td>
      <td :class="{sorted: icons['changePercent24Hr'][1]}" ><a @click="sortData('changePercent24Hr')" href="#">Chg(24Hr)</a></td>
      <td class="tab">$(7d)</td>
      <td class="d-flex justify-content-start"><i class="fas fa-exchange-alt"></i></td>
  </thead>

  <tr class="p-0" v-for="(asset, index) in assets()" :key="index" :id="'row'+asset.id">

      <td class="p-0">{{asset.rank}}</td>
      <td class="p-0 justify-content-start">
          <div class="d-flex flex-row pl-0 col-a12 achartrow">
          <div class="col-3 p-0"><img :src="asset.logo"></div>
             <div class="col-8 namesymbol p-0">
             <div class="row name">{{asset.name}}
             </div>
              <div class="row symbol text-muted">{{asset.symbol}}</div>
             </div>
          </div>


          </td>
      <td class="pl-0 justify-content-start" :id="asset.id" v-if="parseFloat(asset.priceUsd) < 1">{{asset.priceUsd | currency('$',8)}}</td>
       <td class="pl-0 justify-content-start" :id="asset.id" v-else>{{asset.priceUsd | currency}}

       </td>
      <td class="tab pl-0">{{asset.marketCapUsd | currency}}</td>
      <td class="desk" v-if=" parseFloat(asset.vwap24Hr) < 1">{{asset.vwap24Hr | currency('$',8)}}</td>
      <td class="desk" v-else>{{asset.vwap24Hr | currency}}</td>
      <td class="desk">{{asset.supply | number('0.00a')}}</td>
      <td class="tab">{{asset.volumeUsd24Hr | currency}}</td>
      <td :style="getShade(asset.changePercent24Hr)">{{parseFloat(asset.changePercent24Hr)/100 | percent(2)}}</td>
      <td class="tab">
        <line-chart-component :asset="asset" v-if="asset.id"/>
      </td>
      <td>
                    <div class="dropdown" v-if="1">
            <a
              id="dropdownSubMenu1"
              href="#"
              data-toggle="dropdown"
              aria-haspopup="true"
              aria-expanded="false"
              class="dropdown-toggle"
            >
              <span class=" text-bold" style="font-size: larger">{{currencyName[0]}}</span>
            </a>
            <ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow">
              <li class="dropdown-divider"></li>
              <li v-for="(currency, index) in currencies" :key="index">
                <a href="#" @click="changeCurrency(currency, asset)" class="dropdown-item">{{currency[0]}}</a>
              </li>

            </ul>
                    </div>
      </td>
  </tr>
  <tbody>

  </tbody>
</table>

<convert-currency-component/>
    <hr>
<div class="d-flex flex-row justify-content-center">

    <h3>Top 5 Coins By Market Cap.</h3>
</div>
<div class="d-flex flex-row justify-content-center">
 <pie-chart-component/>
</div>
    </div>
</template>

<script>
 import { mapActions, mapGetters, mapMutations } from 'vuex'
import * as constants from './../constants'
export default {

    data() {
        return {
            showConvert: false,
            convertedValue: null,
            oldassets:[],
            orderBy: ['rank','asc'],
            icons:{
                rank: ['asc',true],
                name: ['asc',false],
                priceUsd: ['asc',false],
                marketCapUsd: ['asc',false],
                vwap24Hr: ['asc',false],
                supply: ['asc',false],
                volumeUsd24Hr: ['asc',false],
                changePercent24Hr: ['asc',false],
        }

        };
    },

    methods:{
    getCoinImage(s){
return constants.coinCapImageBase + s.toLowerCase() +'@2x.png'
    },
    getShade: (num) => {
  return parseFloat(num) > 0 ? "color:green;" : "color:red;";
    },

    changeCurrency(c, s) {
        // console.log('Currency Convertion for:', s, 'to', c)
  this.$modal.show('convert', {c, s});
},
processDataStream(msg){
             let prices = JSON.parse(msg.data)
        //   console.log('websocket data',prices)
          _.forEach(prices, (val, key) => {
            //   console.log('Socket Value:', val, key)
          let objkey = _.findKey(this.coinCapAssets,(o) => {
            //   console.log('Recevieved Key:', key)
              return o.id===key
          })
        //   console.log('Object Key:', objkey)
          if(objkey >= 0){

              this.$store.state.coinCapAssets[objkey]['priceUsd'] = val
//search oldassets
        let oldPrice = this.oldassets[key]
              if(oldPrice > 0){
                //   console.log('Old Price', oldPrice, 'New Price', val, 'OldPrice > New Price', oldPrice > val)
                  if(oldPrice > val){
                      document.getElementById('row'+key).classList.add('fadegreen')
                      document.getElementById(key).style.color = 'green'

                  } else {
                      document.getElementById('row'+key).classList.add('fadered')
                      document.getElementById(key).style.color = 'red'
                  }
                  setTimeout(function() {
                      document.getElementById('row'+key).classList.remove('fadegreen');
                      document.getElementById('row'+key).classList.remove('fadered');
                  }, 500);
              }
              //update the new price
              this.oldassets[key] = val

          }
        // console.log('Updated Value:', this.$store.state.coinCapAssets[objkey]['priceUsd'])
          })


// console.log('coincap store data',this.$store.state.coinCapAssets)
}
,
    sortData(col){
        //reset all sort icons
        // console.log('Sorting Result for', col, 'Current Data: OrderBy:', this.orderBy ,'Icon Data:',this.icons[col])
        this.icons['rank'][1] = false
        this.icons['name'][1] = false
        this.icons['priceUsd'][1] = false
        this.icons['marketCapUsd'][1] = false
        this.icons['vwap24Hr'][1] = false
        this.icons['supply'][1] = false
        this.icons['volumeUsd24Hr'][1] = false
        this.icons['changePercent24Hr'][1] = false

        let direction, icondir
        if(this.orderBy[0] == col){
            //if same column change sort order
           direction = (this.orderBy[1]=='asc') ? 'desc': 'asc'
           this.orderBy[1] = direction
            icondir = direction
            this.icons[col][0] = direction
            this.icons[col][1]= true

        } else {
            this.orderBy = [col, 'asc']
            this.icons[col][0]= 'asc'
            this.icons[col][1]= true
        }
        //  console.log('Updated Result for', col, 'Updated Data: OrderBy', this.orderBy ,'Icon Data:',this.icons)
    },
    assets(){

                var data = _.orderBy(_.map(this.coinCapAssets, (val)=>{
                    // console.log(val)

 return {
                    id: val.id,
                    rank: _.parseInt(val.rank),
                    symbol: val.symbol,
                    name: val.name,
                    supply: parseFloat(val.supply),
                    maxSupply: parseFloat(val.maxSupply),
                    marketCapUsd: parseFloat(val.marketCapUsd),
                    volumeUsd24Hr: parseFloat(val.volumeUsd24Hr),
                    priceUsd: parseFloat(val.priceUsd),
                    changePercent24Hr: parseFloat(val.changePercent24Hr),
                    vwap24Hr: parseFloat(val.vwap24Hr),
                    logo: this.getCoinImage(val.symbol),
                    }
                }), this.orderBy[0],this.orderBy[1])
                // console.log(data)
                return data
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

    created() {

        // this.$store.state.coinCapAssets = []
        this.$store.state.coinMarketCapAssets = []
        this.$store.dispatch('fetchAssets')
        // this.assets = this.$store.state.coinCapAssets

        setInterval(() => {
  this.$store.dispatch('fetchAssets')
}, constants.UPDATE_INTERVAL);



    },
    mounted(){
        // console.log('landing component mounted')
        this.$store.state.websocketConnect = true

    const pricesWs = new WebSocket('wss://ws.coincap.io/prices?assets=ALL')

     pricesWs.onmessage = (msg) => {
            if(this.$store.state.websocketConnect){
                this.processDataStream(msg)
            } else {
                pricesWs.close()
            }


            }



    }
};
</script>
<style scoped>
    .fadegreen {
        background-color: rgba(65, 238, 140, 0.22);
        transition: background-color 1s;
    }
    .fadered {
        background-color: rgba(255, 9, 15, 0.3);
        transition: background-color 2s;
    }
.sorted{
    font-style: italic;
    font-variant: small-caps;
}
.globalmetrics{
    background-color: bisque;
    /* justify-content: center; */

}
.flex{
    /* display:inline-block; */
    /* flex-wrap: nowrap; */
    white-space: nowrap;
    /* text-justify: distribute; */
}
.flex div{
    /* justify-content: center; */
}
.name{
margin-left: 5px;
margin-right:10px;
    padding: 0px;
display: flex;
vertical-align: top;
align-content: flex-start;
}

.symbol{
    margin-left: 5px;
    margin-right: 10px;
    padding: 0px;
display: flex;
vertical-align: top;
}
tr td{
    font-size: small;
    margin-left: 5px;
}

td img{
    width: 30px;
    /* margin-right: 5px; */
}

@media only screen and (max-width: 900px) {
  .desk {
      display: none;
  }
    .tab {
       display: none;
  }
}


@media only screen and (max-width: 1100px) {
  .desk {
    display: none;
  }

}

</style>
