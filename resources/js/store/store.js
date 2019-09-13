import Vue from 'vue';
import Vuex from 'vuex';

Vue.use(Vuex);

const store = new Vuex.Store({
    state: {
        member: {
            firstname: null,
            lastname: null,
            birthdate: null,
            report: null,
            country_id: null,
            phone: null,
            email: null,
            company: null,
            position: null,
            about: null,
            photo: null
        },
        validationErrors: {},
    },
    mutations: {
        setValidationErrors(state, obj) {
           state.validationErrors = obj;
        },
        clearValidationErrors(state) {
            state.validationErrors = {};
        },
        updateMember(state, obj) {
            Object.keys(obj).forEach((key) => state.member[key] = obj[key]);
        },
        clearMember(state) {
            Object.keys(state.member).forEach((key) => state.member[key] = null);
        }
    },
    actions: {
        setValidationErrors({ commit }, payload) {
            commit("setValidationErrors", payload);
        },
        clearValidationErrors({ commit }) {
            commit("clearValidationErrors");
        },
        updateMember({ commit }, payload) {
            commit("updateMember", payload);
        },
        clearMember({ commit }) {
            commit("clearMember");
        }
    }
});

export default store;
