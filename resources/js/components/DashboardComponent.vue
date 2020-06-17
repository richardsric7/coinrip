<template>
    <div class="container">
        <div class="row">
    <div class="col-md-6 p-3">
        <div class="col-md-12">
            <h3>Visitor's Chart</h3>
        </div>
        <div class="col-md-12" v-if="showTable">
            <geo-chart :data="getGeoData"></geo-chart>

        </div>
   </div>
    <div class="col-md-6 p-3">
        <div class="col-md-12">
            <h3>Visitor's Footprint</h3>
        </div>
        <div class="col-md-12">
<div class="table-responsive" v-if="showTable">
<table class="table table-hover">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Page</th>
      <th scope="col">Browser</th>
      <th scope="col">Device</th>
      <th scope="col">Platform</th>
      <th scope="col">Languages</th>
      <th scope="col">IPAddress</th>
      <th scope="col">Country</th>
      <th scope="col">City</th>
      <th scope="col">Longitude</th>
      <th scope="col">Latitude</th>
    </tr>
  </thead>
  <tbody>
    <tr v-for="(footprint, index) in footprints.footprints['data']" :key="index">
      <th>{{index + 1}}</th>
      <td>{{footprint.page_visited}}</td>
      <td>{{footprint.browser}}</td>
      <td>{{footprint.device}}</td>
      <td>{{footprint.platform}}</td>
      <td>{{footprint.languages}}</td>
      <td>{{footprint.ipaddress}}</td>
      <td>{{footprint.country}}</td>
      <td>{{footprint.city}}</td>
      <td>{{footprint.longitude}}</td>
      <td>{{footprint.latitude}}</td>
    </tr>

  </tbody>

</table>
    <pagination :data="footprints.footprints" @pagination-change-page="getResults"></pagination>
</div>
        </div>
   </div>
    </div>
        </div>

</template>

<script>
    export default {
        data(){
          return {
              footprints: null,
              showTable: false,
              geodata:[],
          }
        },
        methods:{
            getResults(page = 1) {
                // console.log('Fetching page:',page)
                axios.get('/footprint?page=' + page)
                    .then(({data}) => {
                        this.footprints = data;
                    });
            },

        },
        computed:{
            getGeoData(){
                let da = []
                _.forEach(this.footprints['country_visits'], (val) => {
                    let arr = []
                    arr.push(val.country, val.visits)
                    // console.log('Visits', val)
                    da.push(arr)
                })
                // console.log(da)
                return da

            },
        },

        created() {
            axios.get('/footprint')
            .then(({data})=> {
                this.footprints = data
                // console.log('footprints:', data)

                this.showTable = true
            })
            .catch(e => {
                if(e.response.status === 419 || e.response.status === 413){

                    EventBus.$emit('Logout')

                }
                // console.log('request failed for footprint',e)
            })
        },
        mounted() {
            // console.log('Dashboard Component mounted.')
            EventBus.$emit('StopSocket')
        }
    }
</script>
