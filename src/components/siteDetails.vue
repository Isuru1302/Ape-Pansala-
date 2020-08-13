<template>
    <div id="app">

      <div class="site-details mt-4 p-4" id="site-details">

        <div class="container-fluid">
          <div class="row">

            <div class="rw-1 col-12 col-sm-6 col-md-3">
              <h5>Resources</h5>
              <ul>
                <li><a href="">Learn Buddhism</a></li>
                <li><a href="">Practice Meditation</a></li>
                <li><a href="">Dhamma Articles</a></li>
                <li><a href="">Blog</a></li>
                <li><a href="">Downloads</a></li>
              </ul>
            </div>

            <div class="rw-2 col-12 col-sm-6 col-md-3">
              <h5>Services</h5>
              <ul>
                <li><a href="">Day Visits</a></li>
                <li><a href="">Overnight Visits</a></li>
                <li><a href="">Ordination as a Monk</a></li>
                <li><a href="">Ordination as a none</a></li>
                <li><a href="">Meditate in Ella</a></li>
              </ul>
            </div>

            <div class="rw-3 col-12 col-sm-6 col-md-3">
              <h5>Useful Links</h5>
              <ul>
                <li><a href="">Joyful Buddhist</a></li>
                <li><a href="">Main Monastery</a></li>
                <li><a href="">Worldwide branch</a></li>
                <li><a href="">Anagarika Nuns</a></li>
                <li><a href="">Colombo Dhamma friends</a></li>
              </ul>
            </div>

            <div class="rw-4 col-12 col-sm-6 col-md-3">
              <h5>Contact Info</h5>
              <ul >
                <li v-if="details.address"><i class="fa fa-map-marker" aria-hidden="true"></i>
                  &nbsp;{{details.address}}</li>
                <li><i class="fa fa-envelope-o" aria-hidden="true"></i>
                  &nbsp;<a :href="`mailto:${details.email}`">{{details.email}}</a></li>
                <li v-if="details.tp_number"><i class="fa fa-volume-control-phone" aria-hidden="true"></i>
                  &nbsp;{{details.tp_number}}</li>
              </ul>

            </div>

          </div>
        </div>

      </div>

      <div class="footer text-center">
        Copyright © 2020 by Isuru
      </div>


    </div>
</template>

<script>
  export default {

    data(){
      return{
        details:{
          address:'',
          email:'',
          tp_number:'',
        }
      }
    },

    created () {

      this.getDetails();

    },

    methods: {

      getDetails()
      {
        this.$http.get('http://localhost:8000/api/getSiteDetails')
          .then(function (response) {
            this.details = response.body.details;
          })
      }
    },
  }
</script>

<style scoped>
  .site-details{
    background-color: #1d68a7;
    color:#ffffff!important;
    border-bottom: 1px solid cornflowerblue;
  }

  .footer{
    color: #ffffff;
    line-height: 3em;
    height: 3em;
    background-color: #1d68a7;
  }

  .site-details h5{
    text-transform: uppercase;
    padding-left: 1em;
    font-weight: bold;
    color:#ffffff;
  }

  .site-details ul li{
    list-style: none;
    font-style: oblique;
    font-size: 15px;
  }

  .site-details ul li a{
    color: #ffffff;
    text-decoration: none;
    font-style: oblique;
    font-size: 15px;
  }

  .site-details ul li a:hover{
    color: lightblue;
  }

  @media screen and (max-width: 576px) {
    .site-details {
      text-align: center!important;
    }
  }
</style>
