import { createRouter, createWebHistory } from 'vue-router'
import routes from './routes'
import { useUserStore } from '~/store/user'

const router = createRouter({
    history: createWebHistory(),
    routes,
})

router.beforeEach((to, _, next) => {
    const userStore = useUserStore()
    if (to.matched.some(record => record.meta.auth) && !!!userStore.user) {
        userStore
            .fetchUser()
            .then(() => next())
            .catch(() => next({ name: 'dashboard.login' }))
    } else if (
        to.matched.some(record => record.meta.guest) &&
        !!!userStore.user
    ) {
        userStore
            .fetchUser()
            .then(() => {
                next({ name: 'dashboard' })
            })
            .catch(() => next())
    } else {
        next()
    }
})

export default router
