import axios from 'axios'

export default {

  namespaced: true,
  state: {

    token: null,
    user: null

  },

  getters: {

    authenticated (state) {

        return state.token && state.user;

    },
    user (state) {

        return state.user;

    }

  },

  mutations: {

    SET_TOKEN(state, token) {
        state.token = token;

    },
    SET_USER(state, data) {

        state.user = data;

    }

  },
  actions: {

    // Iniciar sesión
    async signIn ( {dispatch}, credentials) {

        let response = await axios.post('login', credentials);
        return dispatch('attempt', response.data.access_token);

    },

    // Obtener usuario logueado
    async attempt ( {commit, state}, token) {

        if(token){
            commit('SET_TOKEN', token);
        }

        if(!state.token){
            return
        }

        try{

            let response = await axios.get('auth/me');

            commit('SET_USER', response.data.logged_in);

        }
        catch (e){

            commit('SET_TOKEN', null);
            commit('SET_USER', null);

        }

    },

    // Cerrar sesión
    signOut ( {commit} ){

        return axios.post('auth/logout').then( ()=>{

            commit('SET_TOKEN', null);
            commit('SET_USER', null);

        })

    }


  },

}
