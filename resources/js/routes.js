export default [
    { path: '/dashboard', component: require('./components/Dashboard.vue').default },
    { path: '/profile', component: require('./components/Profile.vue').default },
    { path: '/developer', component: require('./components/Developer.vue').default },
    { path: '/users', component: require('./components/Users.vue').default },
    { path: '/complaints', component: require('./components/Complaint.vue').default },
    { path: '/site', component: require('./components/Site.vue').default },
    { path: '/department', component: require('./components/department/Department.vue').default },
    { path: '*', component: require('./components/NotFound.vue').default },
];
