

import Vue from 'vue';
import Vuex from 'vuex';

Vue.use(Vuex);

export default new Vuex.Store({
    state: {
        cafes: [],
        restaurantes: [],
        hoteles: [],
    },
    mutations: {

       AGREGAR_CAFES(state, cafes){
           state.cafes = cafes;
       },

       AGREGAR_RESTAURANTES(state, restaurantes){
        state.restaurantes = restaurantes;
        },

        AGREGAR_HOTELES(state, hoteles){
            state.hoteles = hoteles;
        },



    }
});
