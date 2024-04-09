import { defineStore } from 'pinia'
import api from '~/api'

export const useUserStore = defineStore('user', {
    state: () => {
        return {
            user: {},
            token: null,
        }
    },
    actions: {
        saveToken(token) {
            this.token = token
            window.axios.defaults.headers.common['Authorization'] =
                'Bearer ' + token

            localStorage.setItem('api-token', token)
        },
        async fetchUser() {
            try {
                const { data } = await api.get('/user')

                this.user = data
            } catch (e) {
                //this.logOut()
            }
        },
        async logOut() {
            try {
                await api.post('/logout')
            } catch (e) {}

            localStorage.removeItem('api-token')
        },
    },
})
