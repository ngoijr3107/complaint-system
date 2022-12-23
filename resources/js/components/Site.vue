<template>
  <section class="content">
    <div class="container-fluid">
        <div class="row">

          <div class="col-12">
        
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Sites List</h3>

                <div class="card-tools">
                  
                  <button type="button" class="btn btn-sm btn-success" data-toggle="modal" data-target="#addNew">
                      <i class="fa fa-plus-square"></i>
                      Add Site
                  </button>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0">
                <table class="table table-bordered table-hover">
                  <thead>
                    <tr>
                      <th>ID</th>
                      <th>Site name</th>
                      <th>Site region</th>
                      <th>Site mobile</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                     <tr v-for="site in sites.data" :key="site.id">

                      <td>{{site.id}}</td>
                      <td>{{site.site_name}}</td>
                      <td>{{site.site_region}}</td>
                      <td>{{site.site_mobile}}</td>
                      <td>
                      <a href="#" @click="editModal(site)">
                            <i class="fa fa-edit blue"></i>
                        </a>
                         <a href="#" @click="deleteSite(site.id)">
                            <i class="fa fa-trash red"></i></a>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
              <div class="card-footer">
                  <pagination :data="sites" @pagination-change-page="loadSites"></pagination>
              </div>
            </div>
            <!-- /.card -->
          </div>
        </div>

         <div v-if="!$gate.isAdmin()">
            <not-found></not-found>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="addNew" tabindex="-1" role="dialog" aria-labelledby="addNew" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Add New site</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <form @submit.prevent="editmode ? updateSite() : createSite()">
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Site name</label>
                            <input v-model="form.site_name" type="text" name="site_name"
                                class="form-control" :class="{ 'is-invalid': form.errors.has('site_name') }">
                            <has-error :form="form" field="site_name"></has-error>
                        </div>
                        <div class="form-group">
                            <label>Site region</label>
                            <input v-model="form.site_region" type="text" name="site_region"
                                class="form-control" :class="{ 'is-invalid': form.errors.has('site_region') }">
                            <has-error :form="form" field="site_region"></has-error>
                        </div>
                         <div class="form-group">
                            <label>Site mobile</label>
                            <input v-model="form.site_mobile" type="text" name="site_mobile"
                                class="form-control" :class="{ 'is-invalid': form.errors.has('site_mobile') }">
                            <has-error :form="form" field="site_mobile"></has-error>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button v-show="editmode" type="submit" class="btn btn-success">Update</button>
                        <button v-show="!editmode" type="submit" class="btn btn-success">Add</button>
                    </div>
                  </form>
                </div>
            </div>
        </div>
    </div>
  </section>
</template>

<script>
    export default {
        data () {
            return {
              editmode: false,
              sites : {},
              // Create a new form instance
              form: new Form({
                  id : '',
                  site_name: '',
                  site_region: '',
                  site_mobile: '',
              })
            }
        },
        methods: {

           loadSites(page = 1) {

                  this.$Progress.start();
                  
                  axios.get('/api/site?page=' + page).then(({ data }) => (this.sites = data.data));

                  this.$Progress.finish();
          },

          updateSite(){
                this.$Progress.start();
                this.form.put('/api/site/'+this.form.id)
                .then((response) => {
                    // success
                    $('#addNew').modal('hide');
                    Toast.fire({
                      icon: 'success',
                      title: response.data.message
                    });
                    this.$Progress.finish();
                        //  Fire.$emit('AfterCreate');

                    this.loadSites();
                })
                .catch(() => {
                    this.$Progress.fail();
                });

            },

            editModal(site){
                this.editmode = true;
                this.form.reset();
                $('#addNew').modal('show');
                this.form.fill(site);
            },

            deleteSite(id){
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Yes, delete!'
                    }).then((result) => {

                        // Send request to the server
                         if (result.value) {
                                this.form.delete('api/site/'+id).then(()=>{
                                        Swal.fire(
                                        'Deleted!',
                                        'Site has been deleted.',
                                        'success'
                                        );
                                    // Fire.$emit('AfterCreate');
                                    this.loadSites();
                                }).catch((data)=> {
                                  Swal.fire("Failed!", data.message, "warning");
                              });
                         }
                    })
            },

          
          createSite(){
              this.$Progress.start();

              this.form.post('api/site')
              .then((data)=>{
                  $('#addNew').modal('hide');

                  Toast.fire({
                        icon: 'success',
                        title: data.data.message
                    });
                  this.$Progress.finish();
                  this.loadSites();
                  this.form.reset();

              })
              .catch(()=>{

                  Toast.fire({
                      icon: 'error',
                      title: 'Some error occured! Please try again'
                  });
              })
          }

        },
        mounted() {
            
        },
        created() {
            this.$Progress.start();

            this.loadSites();

            this.$Progress.finish();
        }
    }
</script>
