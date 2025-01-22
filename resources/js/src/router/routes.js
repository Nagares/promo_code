import Create from "../pages/Create.vue";
import Home from "../pages/Home.vue";

const routes = [
    {
        path: '/home',
        component: Home,
    },
    {
        path: '/admin/promos/create',
        component: Create,
    }
];
export default routes;
