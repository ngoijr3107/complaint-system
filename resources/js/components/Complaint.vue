<template>
  <section class="content">
    <div class="container-fluid">
      <div class="row">

        <div class="col-12">

          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Complaint List</h3>

              <div class="card-tools">
                <!-- <button @click.prevent="savePdf()" class="btn btn-secondary"><i class="fas fa-print"></i> Print</button> -->
              </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body table-responsive p-0">
              <table class="table table-responsive table-bordered table-hover">
                <thead>
                  <tr>
                    <th>ID</th>
                    <th>Customer Name</th>
                    <th>Customer Phone</th>
                    <th>Complaint</th>
                    <th>Site Location</th>
                    <th>Department</th>
                    <th>Date created</th>
                    <th>Date Closed</th>
                    <th>Status</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  <tr v-for="complaint in complaints.data" :key="complaints.id">

                    <td>{{ complaint.id }}</td>
                    <td>{{ complaint.fullname }}</td>
                    <td>{{ complaint.phone }}</td>
                    <td>{{ complaint.complain }}</td>
                    <td>{{ complaint.site.site_name }}</td>
                    <td>{{ complaint.category.name }}</td>
                    <td>{{ complaint.created_at }}</td>
                    <template>
                    <td v-if="complaint.status === 'Closed'">{{ complaint.updated_at }}</td>
                    <td v-else></td>
                    </template>
                    <template>
                      <td v-if="complaint.status === 'Open'">
                        <span class="badge bg-success">
                          {{ complaint.status }}
                        </span>
                      </td>
                      <td v-else>
                        <span class="badge bg-danger">{{ complaint.status }}</span>
                      </td>
                    </template>

                    <td>
                      <a class="btn btn-sm btn-info" href="#" @click="editModal(complaint)">
                        <i class="fa fa-eye"></i>
                      </a>
                      <template>
                        <a v-if="complaint.status === 'Open'" class="btn btn-sm btn-danger" href="#"
                          @click="deletecomplaint(complaint.id)">
                          Close
                        </a>
                      </template>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
            <!-- /.card-body -->
            <div class="card-footer">
              <pagination :data="complaints" @pagination-change-page="getResults"></pagination>
            </div>
          </div>
          <!-- /.card -->
        </div>
      </div>

      <!-- Modal -->
      <div class="modal fade" id="addNew" tabindex="-1" role="dialog" aria-labelledby="addNew" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h3 class="modal-title" v-show="!editmode">Complaint</h3>
              <h5 class="modal-title" v-show="editmode">Complaint details</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>

            <form @submit.prevent="editmode ? updatecomplaint() : createcomplaint()">
              <div class="modal-body">
                <div class="row">
                  <div class="form-group col-6">
                    <label>Customer Name</label>
                    <input v-model="form.fullname" type="text" name="fullname" class="form-control"
                      :class="{ 'is-invalid': form.errors.has('fullname') }" disabled>
                    <has-error :form="form" field="fullname"></has-error>
                  </div>
                  <div class="form-group col-6">
                    <label>Customer Phone</label>
                    <input v-model="form.phone" type="text" name="phone" class="form-control"
                      :class="{ 'is-invalid': form.errors.has('phone') }" disabled>
                    <has-error :form="form" field="phone"></has-error>
                  </div>
                  <div class="form-group col-6">
                    <label>Site Location</label>
                    <input v-model="form.site_id" type="text" name="site_id" class="form-control"
                      :class="{ 'is-invalid': form.errors.has('site_id') }" disabled>
                    <has-error :form="form" field="site_id"></has-error>
                  </div>
                  <div class="form-group col-6">
                    <label>Department</label>
                    <input v-model="form.category_id" type="text" name="category_id" value="complaint.category_id"
                      class="form-control" :class="{ 'is-invalid': form.errors.has('category_id') }" disabled>
                    <has-error :form="form" field="category_id"></has-error>
                  </div>
                  <div class="form-group col-6">
                    <label>Complaint</label>
                    <textarea rows="4" v-model="form.complain" type="text" name="complain" value="complaint.complain"
                      class="form-control" :class="{ 'is-invalid': form.errors.has('category_id') }"
                      disabled></textarea>
                    <has-error :form="form" field="complain"></has-error>
                  </div>
                  <div class="form-group col-6">
                    <label>Suggestion</label>
                    <textarea rows="4" v-model="form.suggestion" type="text" name="suggestion"
                      value="complaint.suggestion" class="form-control"
                      :class="{ 'is-invalid': form.errors.has('suggestion') }" disabled></textarea>
                    <has-error :form="form" field="suggestion"></has-error>
                  </div>
                  <div class="form-group col-6">
                    <label>Likes</label>
                    <textarea rows="4" v-model="form.like" type="text" name="like" value="complaint.like"
                      class="form-control" :class="{ 'is-invalid': form.errors.has('like') }" disabled></textarea>
                    <has-error :form="form" field="like"></has-error>
                  </div>
                </div>
                <hr>
                <div class="row">

                  <div class="form-group col-6">
                    <label>Add Comments</label>
                    <textarea v-model="form.comment" type="text" name="comment" class="form-control"
                      :class="{ 'is-invalid': form.errors.has('comment') }"></textarea>
                    <has-error :form="form" field="comment"></has-error>
                  </div>

                </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button v-show="editmode" type="submit" class="btn btn-success">Add Comment</button>
                <button v-show="!editmode" type="submit" class="btn btn-primary">Create</button>
              </div>
            </form>
          </div>
        </div>
      </div>

    </div>
  </section>
</template>

<script>
import VueTagsInput from '@johmun/vue-tags-input';
import axios from 'axios';

export default {
  components: {
  },
  data() {
    return {
      complaints: {},
      categories: {},
      sites: {},
      editmode: false,
      form: new Form({
        id: '',
        fullname: '',
        phone: '',
        site_id: '',
        category_id: '',
        name: '',
        site_name:'',
        complain: '',
        suggestion: '',
        like: '',
        status: '',
        comment: '',
      }),
      categories: [],
      sites: [],
    }
  },
  methods: {

    getResults(page = 1) {

      this.$Progress.start();

      axios.get('api/complain?page=' + page).then(({ data }) => (this.complaints = data.data));

      this.$Progress.finish();
    },
    loadcomplaints() {

      if (this.$gate.isAdminOrUser()) {
        axios.get('api/complain').then(({ data }) => (this.complaints = data.data));
      }
    },
    loadCategories() {
      if (this.$gate.isAdminOrUser()) {
        axios.get("/api/category/list").then(({ data }) => (this.categories = data.data));
      }
    },
    loadSites() {
      if (this.$gate.isAdminOrUser()) {
        axios.get('/api/site/list').then(({ data }) => (this.sites = data.data));
      }
    },
    editModal(complaint) {
      this.editmode = true;
      this.form.reset();
      $('#addNew').modal('show');
      this.form.fill(complaint);
    },
    newModal() {
      this.editmode = false;
      this.form.reset();
      $('#addNew').modal('show');
    },
    createcomplaint() {
      this.$Progress.start();

      this.form.post('api/complain')
        .then((data) => {
          if (data.data.success) {
            $('#addNew').modal('hide');

            Toast.fire({
              icon: 'success',
              title: data.data.message
            });
            this.$Progress.finish();
            this.loadcomplaints();

          } else {
            Toast.fire({
              icon: 'error',
              title: 'Some error occured! Please try again'
            });

            this.$Progress.failed();
          }
        })
        .catch(() => {

          Toast.fire({
            icon: 'error',
            title: 'Some error occured! Please try again'
          });
        })
    },
    updatecomplaint() {
      this.$Progress.start();
      // console.log('Editing data');
      this.form.put('api/complain/' + this.form.id)
        .then((response) => {
          // success
          $('#addNew').modal('hide');
          Toast.fire({
            icon: 'success',
            title: response.data.message
          });
          this.$Progress.finish();
          //  Fire.$emit('AfterCreate');

          this.loadcomplaints();
          this.loadCategories();
          this.loadSites();
        })
        .catch(() => {
          this.$Progress.fail();
        });

    },
    deletecomplaint(id) {
      Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Yes, close it!'
      }).then((result) => {

        // Send request to the server
        if (result.value) {
          this.form.delete('api/complain/' + id).then(() => {
            Swal.fire(
              'Closed!',
              'Complaint has been closed.',
              'success'
            );
            // Fire.$emit('AfterCreate');
            this.loadcomplaints();
          }).catch((data) => {
            Swal.fire("Failed!", data.message, "warning");
          });
        }
      })
    },

  },
  mounted() {
    this.loadcomplaints();
    this.loadCategories();
    this.loadSites();
  },
  created() {
    this.$Progress.start();

    this.loadcomplaints();
    this.loadCategories();
    this.loadSites();

    this.$Progress.finish();
  },

}
</script>
