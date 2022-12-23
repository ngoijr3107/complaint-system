<template>
    <section class="content">
        <div class="container-fluid">
            <div class="row ">
                <div class="col-12 col-sm-6 col-md-3">
                    <div class="info-box">
                        <span class="info-box-icon bg-danger elevation-1"><i class="far fa-comment-alt"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">Complaints</span>
                            <span class="info-box-number">
                                Total: {{ AllComplaints() }}
                                <!-- <small>%</small> -->
                            </span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                <!-- /.col -->
                <div class="col-12 col-sm-6 col-md-3">
                    <div class="info-box mb-3">
                        <span class="info-box-icon bg-success elevation-1"><i class="fa fa-users"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">Open Complaints</span>
                            <span class="info-box-number">
                                Total: {{ OpenComplaints() }}</span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                <!-- /.col -->

                <!-- fix for small devices only -->
                <div class="clearfix hidden-md-up"></div>

                <div class="col-12 col-sm-6 col-md-3">
                    <div class="info-box mb-3">
                        <span class="info-box-icon bg-info elevation-1"><i class="fas fa-list-ol"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">Closed Complaints</span>
                            <span class="info-box-number">Total: {{ ClosedComplaints() }}</span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                <!-- /.col -->
                <div class="col-12 col-sm-6 col-md-3">
                    <div class="info-box mb-3">
                        <span class="info-box-icon bg-warning elevation-1"><i class="far fa-compass"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">Sites</span>
                            <span class="info-box-number">Total: 10</span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->

        </div>
        <!--/. container-fluid -->
    </section>
</template>

<script>
import axios from 'axios'

export default {
    data() {
        return {
            complaints: { $complaints },
            OpenComplaints: { $OpenComplaints },
            ClosedComplaints: { $ClosedComplaints},
        }
    },
    methods: {
        AllComplaints() {
            axios.get('/api/all-complaints');
        },
        OpenComplaints() {
            axios.get('/api/open-complaints');
        },
        ClosedComplaints() {
            axios.get('/api/closed-complaints');
        }
    },
    mounted() {
        this.AllComplaints();
        this.OpenComplaints();
        this.ClosedComplaints();
    }
}
</script>
