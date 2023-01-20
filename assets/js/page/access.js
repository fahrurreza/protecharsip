const App = {
  data() {
    return {
      loading : false,
      form : {
        slack : null,
        menu_id : null
      }
    }
  },
  methods:{
    getAccess: function(slack, menu_id){
      this.form.slack = slack
      this.form.menu_id = menu_id

      axios.post('api/create-access', this.form)
      .then(response => {
        if(response.status == 200){
          notifSuccess('Access diberikan')
        }else{
          notifError('Error')
        }
      })
      .catch(error => {
        notifError('Error')
      })
    }
  },

};
Vue.createApp(App).mount("#app");