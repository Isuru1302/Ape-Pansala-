<template>
    <div id="app" v-cloak>

      <top_bar/>
      <main_banner/>
      <nav_bar/>

      <div class="container contact-area mt-4"  uk-scrollspy="cls: uk-animation-fade; repeat: true;delay:200;">
        <div class="row">

          <div class="col-12 col-md-6 con1">

            <h2>Contact Us</h2>
            <p class="con1-address">

            </p>

            <p class="con1-email"></p>
          </div>

          <div class="col-12 col-md-12 con2">

            <form class="con2-mail" @submit.prevent="sendUserMessage" id="userMessage">

              <input type="text" name="name" placeholder="Full Name..." v-model="user_message.full_name" required>

              <input type="email" name="uemail" placeholder="Email..." v-model="user_message.user_email" required>

              <textarea placeholder="Message..." v-model="user_message.user_message" required></textarea>

              <input class="sub-btn" type="submit" name="submit" value="Send">

              <p id="successMessage" style="color: #0b75c9;font-weight: bold;display: none">We got your message. We will contact you soon! Thank you!!</p>
              <p id="errorMessage" style="color:red;font-weight: bold;display: none">We didn't get your message. Try again!!</p>

            </form>

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

      data(){
        return{
          user_message:{
            full_name:'',
            user_email:'',
            user_message:'',
            siteDetails:{
              facebook:'',
              email:'',
              instagram:'',
              twitter:'',
              youtube:'',
            },
          },
        }
      },

      created () {
        this.getDetails();
      },

      methods:{

        sendUserMessage(){
          this.$http.post('http://localhost:8000/api/newMessage',this.user_message)
          .then(function (response) {
            console.log(response)
            if(response.body.message==='sent'){
              $("#successMessage").css("display", "block");
              $("#errorMessage").css("display", "none");
              $('#userMessage')[0].reset();
            }else{
              $("#errorMessage").css("display", "block");
              $("#successMessage").css("display", "none");
            }

          });
        },

        getDetails()
        {
          this.$http.get('http://localhost:8000/api/getSiteDetails')
            .then(function (response) {
              this.siteDetails = response.body.details;
            })
        },
      }
    }
</script>

<style scoped>
  .contact-area{
    background: #eeeeee;
    padding: 4em;
    border-radius: 5px;
    border:1px solid #ddd;
  }

  .con1 h2{
    font-weight: 600;
    font-family: inherit;
    color: inherit;
  }

  .con1 p{
    color: #606060;
    font-weight: 600;
    font-size: 16px;
  }

  .con1 ul{
    margin-top: -1em;
  }

  .con1 ul li{
    padding: 0.5em;
    float: left;
    list-style: none;
  }

  .con2-mail{
    background: #ffffff;
    padding: 3em 2em;
  }

  .con2-mail input, .con2-mail textarea{
    width: 100%;
    background: #eeeeee;
    border:1px solid #eee;
    border-radius: 4px;
    font-style: italic;
    margin-bottom: 1em;
  }

  .con2-mail input{
    padding: 1em;

  }

  .con2-mail textarea{
    padding: 1em;
  }

  .sub-btn{
    background: #1aa3ff!important;
    color: #ffffff;
    font-weight: bold;
    font-size: 15px;
  }
</style>
