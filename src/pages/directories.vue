<template>

  <div id="app" v-cloak>

    <top_bar/>
    <main_banner/>
    <nav_bar/>
    <div class="container mt-5">

      <div id="directory-content " class="directory-content"  uk-scrollspy="cls: uk-animation-fade; repeat:true;">

        <div class="uk-margin" style="float: right">
          <form class="uk-search uk-search-default" @submit.prevent="">
            <a href="" class="uk-search-icon-flip" uk-search-icon></a>
            <input class="uk-search-input" type="search" id="searchWord" placeholder="Keyword..." @input="searchDirectory">
          </form>
        </div>

        <div class="div-category mr-2" style="float: right">
          <select class="uk-select" style="text-align: center" @input="selCategories" id="cate">
            <option value="">-- Category --</option>
            <option v-for="category in categories" :value="category">{{category}}</option>
          </select>
        </div>

        <div class="table-responsive">
          <table class="table dTable">
            <thead>
            <tr>
              <th  class="col-3">Name</th>
              <th  class="col-3">Address</th>
              <th  class="col-2">District</th>
              <th  class="col-2">Telephone</th>
              <th class="col-2">Category</th>
            </tr>
            </thead>

            <tbody>
            <tr v-if="searchKeyLength<1" v-for="directory in  directoryResults">
              <td>{{directory.name}}</td>
              <td>{{directory.address}}</td>
              <td>{{directory.district}}</td>
              <td>{{directory.telephone}}</td>
              <td>{{directory.category}}</td>
            </tr>

            <tr v-if="searchKeyLength>0" v-for="res in searchRes">
              <td>{{res.name}}</td>
              <td>{{res.address}}</td>
              <td>{{res.district}}</td>
              <td>{{res.telephone}}</td>
              <td>{{res.category}}</td>
            </tr>
            </tbody>

          </table>
        </div>
      </div>

    </div>

    <site_details/>
  </div>



</template>

<script>
  import Top_bar from "../components/topbar";
  import Main_banner from "../components/mainbanner";
  import Nav_bar from "../components/navbar";
  import site_Details from "../components/siteDetails";

  export default {
    components: {
      "top_bar":Top_bar,
      "main_banner":Main_banner,
      "nav_bar":Nav_bar,
      "site_details":site_Details
    },

    created () {
      this.getDirectory();
    },

    data() {
      return {
        directoryResults:[],
        searchKeyLength:0,
        searchRes:[],
        categories:['Rajamaha Vihara','Purana Vihara','General Temples','Meditation Centers','Aranya Senasana','Asapu','Dhamma Schools'],
      }
    },

    methods:{
      getDirectory(){
        this.$http.get('http://localhost:8000/api/getAllDirectories')
          .then(function (response) {
            this.directoryResults = response.body.directories;
          })
      },

      searchDirectory(){
        $('#cate').prop('selectedIndex',0);
        var value = $('#searchWord').val();
        this.searchKeyLength = value.length;

        if(value.length>0) {
          this.$http.get('http://localhost:8000/api/searchDirectory/' + value)
            .then(function (response) {
              this.searchRes = response.body.search;
            })
        }
      },

      selCategories(){
        $('#searchWord').val('');
        var value = $('#cate').find(":selected").val();
        this.searchKeyLength = value.length;

        this.$http.get('http://localhost:8000/api/searchDirectoryByCat/'+value)
          .then(function (response) {
            this.searchRes = response.body.search;
          })
      }
    }
  }
</script>

<style scoped>

.dTable thead tr th,.dTable tbody tr td{
  text-align: center;
}



</style>
