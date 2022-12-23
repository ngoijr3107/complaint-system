<template>
    <section class="content">
        <div class="container-fluid">
            <div class="row ">
                <div class="col-md-4 col-lg-4 col-sm-12">
                    <div class="info-box">
                        <span class="info-box-icon bg-warning elevation-1"><i class="far fa-comment-alt"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">All Complaints</span>
                            <span class="info-box-number">
                                Total: {{ allComplaints }}
                                <!-- <small>%</small> -->
                            </span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                <!-- /.col -->
                <div class="col-md-4 col-lg-4 col-sm-12">
                    <div class="info-box mb-3">
                        <span class="info-box-icon bg-success elevation-1"><i class="far fa-comment-alt"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">Open Complaints</span>
                            <span class="info-box-number">
                                Total: {{ OpenComplaintList }}</span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                <!-- /.col -->

                <!-- fix for small devices only -->
                <div class="clearfix hidden-md-up"></div>

                <div class="col-md-4 col-lg-4 col-sm-12">
                    <div class="info-box mb-3">
                        <span class="info-box-icon bg-danger elevation-1"><i class="far fa-comment-alt"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">Closed Complaints</span>
                            <span class="info-box-number">Total: {{ ClosedComplaintList }}</span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->

            <div class="row">
                <div class="col-md-6 col-lg-6 col-sm-12">
                    <div class="card">
                        <div class="card-body">
                            <DepartmentComplaintChart></DepartmentComplaintChart>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 col-lg-6 col-sm-12">
                    <div class="card">
                        <div class="card-body">
                            <SiteComplaintChart></SiteComplaintChart>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.row -->

        </div>
        <!--/. container-fluid -->
    </section>
</template>

<script>
import axios from 'axios'
import VueApexCharts from 'vue-apexcharts';
import DepartmentComplaintChart from './DashboardCharts/DepartmentComplaintChart.vue';
import SiteComplaintChart from './DashboardCharts/SiteComplaintChart.vue';

export default {
    components: {
        VueApexCharts,
        DepartmentComplaintChart,
        SiteComplaintChart,
    },
    data() {
        return {
            allComplaints: [],
            OpenComplaintList: [],
            ClosedComplaintList: [],
        }
    },
    methods: {

        AllComplaints() {
            if (this.$gate.isAdminOrUser()) {
                axios.get('api/all-complaints').then(({ data }) => (this.allComplaints = data.data));
            }
        },
        OpenComplaints() {
            if (this.$gate.isAdminOrUser()) {
                axios.get('api/open-complaints').then(({ data }) => (this.OpenComplaintList = data.data));
            }
        },
        ClosedComplaints() {
            if (this.$gate.isAdminOrUser()) {
                axios.get('api/closed-complaints').then(({ data }) => (this.ClosedComplaintList = data.data));
            }
        }
    },
    mounted() {
        this.AllComplaints();
        this.OpenComplaints();
        this.ClosedComplaints();
    }
}
</script>
