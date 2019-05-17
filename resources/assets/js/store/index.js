import Vue from 'vue';
import Vuex from 'vuex';
import _ from 'lodash';

Vue.use(Vuex)

export default new Vuex.Store({
  state : {
    form : {}
  },
  mutations: {
    setForm (state, form) {
      state.form = form;
    },
    setFormCompVal(state, obj) {
      let comp = _.find(state.form, el => {
          return el.id == obj.cid;
      });
      return !!comp ? comp.val = obj.val : false;
    }
  }
});