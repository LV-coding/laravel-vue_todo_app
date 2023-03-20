import { createRouter, createWebHistory } from 'vue-router'

const routes = [
    {
        path: '/',
        component: () => import ('./pages/MainPage.vue'),
        name: 'main'
    },
    {
        path: '/about',
        component: () => import ('./pages/AboutPage.vue'),
        name: 'about'
    },
    {
        path: '/user/login',
        component: () => import ('./pages/user/LoginPage.vue'),
        name: 'user.login'
    },
    {
        path: '/user/registration',
        component: () => import ('./pages/user/RegistrationPage.vue'),
        name: 'user.registration'
    },
    {
        path: '/tasks',
        component: () => import ('./pages/tasks/TaskListPage.vue'),
        name: 'task.tasklist'
    },
    {
        path: '/tasks/create',
        component: () => import ('./pages/tasks/TaskCreatePage.vue'),
        name: 'task.create'
    }
    // {
    //     path: '/tasks/:id',
    //     component: () => import ('./pages/tasks/TaskPage.vue'),
    //     name: 'task.task'
    // }
]

const router = createRouter({
    history: createWebHistory(),
    routes
})

router.beforeEach((to, from, next) => {
    const token = localStorage.getItem('x_xsrf_token')

    if(token) {
        if(to.name === 'user.registration' || to.name === 'user.login') {
            return next({
                name: 'main'
            })
        }
    } else if (to.name === 'task.tasklist' || to.name === 'task.task') {
        return next({
            name: 'user.login'
        })
    }

    next()
})

export default router
