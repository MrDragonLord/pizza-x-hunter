import { defineStore } from 'pinia'

export const useCoreStore = defineStore('core', {
    state: () => {
        return {
            user: {},
            token: null,
        }
    },
})
