const App = {
  data() {
    return {
      loading : false,
      show: false,
      submit : true,
      items : [],
      entriesOption : [{'value' : 10},{'value' : 25},{'value' : 50}, {'value' : 100}],
      table : {
        column : 'nama_lengkap',
        keyword : '',
        perPage : 10,
        pageSelect : 1,
        name : 'Instruktur',
        id : null
      },
      meta : [],
      buttonPage : [],
      form:{
        id : null,
        nama_lengkap : null,
        tempat_lahir : null,
        tanggal_lahir : null,
        sex : null,
        keahlian : null,
        nomor_sk : null,
        status: null,
      },
      hasError : {
        nama_lengkap : false,
        tempat_lahir : false,
        tanggal_lahir : false,
        sex : false,
        keahlian : false,
        nomor_sk : false,
        status: false,
      },
      error: {
        nama_lengkap : false,
        tempat_lahir : false,
        tanggal_lahir : false,
        sex : false,
        keahlian : false,
        nomor_sk : false,
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
      this.form.nama_lengkap = null,
      this.form.tempat_lahir = null,
      this.form.tanggal_lahir = null,
      this.form.sex = null,
      this.form.keahlian = null,
      this.form.nomor_sk = null,
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
      axios.post('api/get-instruktur', data)
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
      if(!this.form.nama_lengkap) {
        this.loading = false
        this.error.nama_lengkap = "Nama Lengkap is required";
        this.hasError.nama_lengkap = true;
        
      }
      else if(!this.form.tempat_lahir) {
        this.loading = false
        this.error.tanggal_lahir = "Tanggal Lahir is required";
        this.hasError.tanggal_lahir = true;
      }
      else if(!this.form.tanggal_lahir) {
        this.loading = false
        this.error.tanggal_lahir = "Tanggal Lahir is required";
        this.hasError.tanggal_lahir = true;
      }
      else if(!this.form.sex) {
        this.loading = false
        this.error.sex= "Jenis Kelamin is required";
        this.hasError.sex = true;
      }
      else if(!this.form.keahlian) {
        this.loading = false
        this.error.keahlian= "Bidang keahlian is required";
        this.hasError.keahlian = true;
      }
      else if(!this.form.nomor_sk) {
        this.loading = false
        this.error.nomor_sk= "Nomor SK is required";
        this.hasError.nomor_sk = true;
      }
      else if(!this.form.status) {
        this.loading = false
        this.error.status= "Status is required";
        this.hasError.status = true;
      } else {
        this.loading = true
        axios
        .post('api/create-instruktur', this.form)
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
      axios.post('api/show-instruktur', this.table).then(response => {
        if(response.status == 200){
          this.loading = false
          this.form.id = response.data.id
          this.form.nama_lengkap = response.data.nama_lengkap
          this.form.tempat_lahir = response.data.tempat_lahir
          this.form.tanggal_lahir = response.data.tanggal_lahir
          this.form.sex = response.data.sex
          this.form.keahlian = response.data.bidang_keahlian
          this.form.nomor_sk = response.data.nomor_sk
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
      axios.post('api/update-instruktur', this.form).then(response => {
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
        keahlian: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
      }).then((result) => {
        if (result.isConfirmed) {
          axios.post('api/delete-instruktur', this.table).then(response => {
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