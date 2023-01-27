const App = {
  data() {
    return {
      loading : false,
      show: false,
      submit : true,
      items : [],
      entriesOption : [{'value' : 10},{'value' : 25},{'value' : 50}, {'value' : 100}],
      table : {
        column : 'label',
        keyword : '',
        perPage : 10,
        pageSelect : 1,
        name : 'Menu',
        id : null
      },
      meta : [],
      buttonPage : [],
      form:{
        id : null,
        type : null,
        parent_id : 0,
        label : null,
        link : null,
        icon : null,
        short_order : null,
        status: null,
      },
      hasError : {
        label : false,
        link : false,
        status: false,
        type: false,
      },
      error: {
        type : false,
        parent_id : false,
        label : false,
        link : false,
        icon : false,
        short_order : false,
        status: false,
      },
    }
  },
  methods:{
    //TABLE FUNCTION
    pageButton: function(data){
      const page = {}
      if(data > 5 && (data - 5) >  1){
        if(this.table.pageSelect > 5 && this.table.pageSelect > 5 && this.table.pageSelect < (data - 3)){
          page[0] = {'page' : 1}
          page[1] = {'page' : '...'}
          page[2] = {'page' : this.table.pageSelect}
          page[3] = {'page' : '...'}
          page[4] = {'page' : data}

          return page;
        }else if(this.table.pageSelect == data){
          page[0] = {'page' : 1}
          page[1] = {'page' : '...'}
          for (let i = 2; i < 6; i++) {
            page[i]= {'page' : i+(data - 5)};
          }
          return page;
        }else if(this.table.pageSelect >= (data - 3) && this.table.pageSelect < data){
          page[0] = {'page' : 1}
          page[1] = {'page' : '...'}
          for (let i = 2; i < 6; i++) {
            page[i]= {'page' : i+(data - 5)};
          }
          return page;
        }else{
          for (let i = 0; i < 5; i++) {
            page[i]= {'page' : i+1};
          }
          page[5] = {'page' : '...'}
          page[6] = {'page' : data}
          return page;
        }
      }else{
        for (let i = 0; i < this.meta.last_page; i++) {
          page[i]= {'page' : i+1};
        }
        return page;
      }
    },

    entries: function(){
      this.table.pageSelect = 1
      this.getData(this.table)
    },

    search: function(column){
      this.table.pageSelect = null
      this.table.column = column
      var value = document.getElementById(column).value
      this.table.keyword = value

      this.getData(this.table)
    },

    page: function(data){
      this.table.pageSelect = data
      this.getData(this.table)
    },
    
    nextPage: function(){
      if(this.table.pageSelect < this.meta.last_page)
      {
        this.table.pageSelect++
        this.getData(this.table)
      }
    },

    backPage: function(){
      if(this.table.pageSelect > 1)
      {
        this.table.pageSelect--
        this.getData(this.table)
      }
    },
    //TABLE FUNCTION END

    //FORM FUNCTION
    resetForm: function () {
      this.submit = true, 
      this.form.id = null,
      this.form.type = null,
      this.form.parent_id = 0,
      this.form.label = null,
      this.form.link = null,
      this.form.icon = null,
      this.form.short_order = null,
      this.form.status = null
    },

    cancelForm: function(){
      this.show = false
      this.submit = true
      this.resetForm()
    },
    
    openForm: function(){
      this.show = true
    },

    closeForm: function(){
      this.show = false
    },
    //END FORM FUNCTION

    //CRUD FUNCTION
    getData: function(data){
      axios.post('api/get-menu', data)
         .then(response => {
            if(response.status == 200){
              this.items = response.data.data
              this.meta = response.data.meta
              let page = {};
              for (let i = 0; i < this.meta.last_page; i++) {
                page[i]= {'page' : i+1};
              }
              this.buttonPage = page
            }else{
              notifError('Error')
            }
         })
         .catch(error => {
            notifError('Error')
         })
    },
    
    createData:function(e) {
      this.loading = true
      this.error = []
      this.hasError = []
      e.preventDefault()
      if(!this.form.type) {
        this.loading = false
        this.error.type = "type is required";
        this.hasError.type = true;
        
      }
      else if(!this.form.label) {
        this.loading = false
        this.error.label = "Label is required";
        this.hasError.label = true;
      }
      else if(!this.form.link) {
        this.loading = false
        this.error.link= "Link is required";
        this.hasError.link = true;
      }
      else if(!this.form.status) {
        this.loading = false
        this.error.status= "Status is required";
        this.hasError.status = true;
      } else {
        this.loading = true
        axios
        .post('api/create-menu', this.form)
        .then(response => {
          if(response.status == 200){
            this.loading = false
            this.items = response.data.data
            this.meta = response.data.meta
            let page = {};
            for (let i = 0; i < this.meta.last_page; i++) {
              page[i]= {'page' : i+1};
            }
            this.buttonPage = page
            this.resetForm()
            notifSuccess('Data berhasil disimpan')
          }else{
            this.loading = false
            notifError('Data not found')
          }
        })
        .catch(error => {
          this.loading = false
          console.log(error)
          this.errored = true
          notifError('Somethingelse')
        })
      }
    },

    editData: function(data){
      this.show = true
      this.table.id = data
      this.submit = false
      axios.post('api/show-menu', this.table).then(response => {
        if(response.status == 200){
          this.loading = false
          this.form.id = response.data.id
          this.form.type = response.data.type
          this.form.parent_id = response.data.parent_id
          this.form.label = response.data.label
          this.form.link = response.data.route
          this.form.icon = response.data.icon
          this.form.short_order = response.data.short_order
          this.form.status = response.data.status

        }else{
          notifError('Data not found')
        }
      })
      .catch(error => {
          notifError('Somethink else')
      })
    },

    updateData: function(data){
      this.loading = true
      axios.post('api/update-menu', this.form).then(response => {
        if(response.status == 200){
          this.loading = false
          this.items = response.data.data
          this.meta = response.data.meta
          let page = {};
          for (let i = 0; i < this.meta.last_page; i++) {
            page[i]= {'page' : i+1};
          }
          this.buttonPage = page
          this.resetForm()
          this.show = false
          notifSuccess('Data berhasil diupdate')
        }else{
          this.loading = false
          notifError('Data gagal diupdate')
        }
      })
      .catch(error => {
          this.loading = false
          notifError('Somethink else')
      })
    },

    deleteData: function(data){
      this.table.id = data
      Swal.fire({
        title: 'Apakah kamu yakin?',
        text: "Data ini akan di hapus dan tidak dapat dikembalikan!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
      }).then((result) => {
        if (result.isConfirmed) {
          axios.post('api/delete-menu', this.table).then(response => {
              if(response.status == 200){
                this.items = response.data.data
                this.buttonPage = this.pageButton(this.meta.last_page)
                this.resetForm()
                this.show = false
                notifSuccess('Data berhasil dihapus')
              }else{
                notifError('Data gagal dihapus')
              }
          })
          .catch(error => {
              notifError('Somethink else')
          })
        }
      })
    },
  },

  mounted() {
    this.getData(this.table)
  }
};
Vue.createApp(App).mount("#app");