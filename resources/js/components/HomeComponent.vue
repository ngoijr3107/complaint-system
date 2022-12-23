<template>
    <section class="content">
        <div class="container mt-5 p-3">
            <nav class="navbar navbar-light navbar-lg-expand bg-white">
                <div class="navbrand">
                    <img src="/images/logo.png" alt="Logo" height="60">
                </div>
            </nav>
            <hr style="color: #FF770A;">
            <div class="card shadow-sm">
                <div class="card-header">
                    <h3>We Listen</h3>
                </div>
                <div class="card-body">
                    <form @submit.prevent="createcomplaint()" class="pt-3">
                        <div class="row">
                            <div class="form-group col-lg-6">
                                <label>Full Name *</label>
                                <input v-model="form.fullname" type="text" name="fullname" class="form-control"
                                    :class="{ 'is-invalid': form.errors.has('fullname') }">
                                <has-error :form="form" field="fullname"></has-error>
                            </div>
                            <div class="form-group col-lg-6">
                                <label>Mobile *</label>
                                <input v-model="form.phone" type="text" name="phone" class="form-control"
                                    :class="{ 'is-invalid': form.errors.has('phone') }">
                                <has-error :form="form" field="phone"></has-error>
                            </div>
                            <div class="form-group col-lg-6">
                                <label>Site Location *</label>
                                <select class="form-control" v-model="form.site_id">
                                    <option value="">Select Site location</option>
                                    <option v-for="site in sites" :key="site.id" :value="site.id">{{ site.site_name }}
                                    </option>
                                </select>
                                <has-error :form="form" field="site_id"></has-error>
                            </div>
                            <div class="form-group col-lg-6">
                                <label>Department *</label>
                                <select class="form-control" v-model="form.category_id">
                                    <option value="">Select Department</option>
                                    <option v-for="category in categories" :key="category.id" :value="category.id">{{
                                            category.name
                                    }}</option>
                                </select>
                                <has-error :form="form" field="category_id"></has-error>
                            </div>
                            <div class="form-group col-lg-6">
                                <label>Complaint *</label>
                                <textarea v-model="form.complain" type="text" name="complain" class="form-control"
                                    :class="{ 'is-invalid': form.errors.has('complain') }"></textarea>
                                <has-error :form="form" field="complain"></has-error>
                                <!-- <span style="color: red; font-size: 13px;"><i>Maximum: 100 characters</i></span> -->
                            </div>
                            <div class="form-group col-lg-6">
                                <label>Suggestion</label>
                                <textarea v-model="form.suggestion" type="text" name="suggestion" class="form-control"
                                    :class="{ 'is-invalid': form.errors.has('suggestion') }"></textarea>
                                <has-error :form="form" field="suggestion"></has-error>
                            </div>
                            <div class="form-group col-lg-6">
                                <label>Likes</label>
                                <textarea v-model="form.like" type="text" name="like" class="form-control"
                                    :class="{ 'is-invalid': form.errors.has('like') }"></textarea>
                                <has-error :form="form" field="like"></has-error>
                            </div>
                        </div>
                        <button class="btn btn-success">Send</button>
                    </form>
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
        VueTagsInput,
    },
    data() {
        return {
            categories: {},
            sites: {},
            form: new Form({
                id: '',
                fullname: '',
                phone: '',
                category_id: '',
                site_id: '',
                complain: '',
                suggestion: '',
                like: '',
            }),
            categories: [],
            sites: [],
        }
    },
    methods: {
        loadCategories() {
            axios.get("/api/category/list").then(({ data }) => (this.categories = data.data));
        },
        loadSites() {
            axios.get('/api/site/list').then(({ data }) => (this.sites = data.data));
        },
        createcomplaint() {
            this.$Progress.start();

            this.form.post('/api/complain')
                .then((data) => {
                    if (data.data.success) {

                        Toast.fire({
                            icon: 'success',
                            title: data.data.message
                        });
                        this.$Progress.finish();
                        this.form.reset();
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

    },
    mounted() {
        this.loadCategories();
        this.loadSites();
    },
}
</script>
