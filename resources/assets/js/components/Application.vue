<template>
  <v-app id="inspire">
    <v-navigation-drawer
      v-model="drawer"
      fixed
      app>
      <v-list dense>
        <v-list-tile @click="">
          <v-list-tile-action>
            <v-icon>home</v-icon>
          </v-list-tile-action>
          <v-list-tile-content>
            <v-list-tile-title>Книги</v-list-tile-title>
          </v-list-tile-content>
        </v-list-tile>
      </v-list>
    </v-navigation-drawer>
    <v-toolbar color="indigo" dark fixed app>
      <v-toolbar-side-icon @click.stop="drawer = !drawer"></v-toolbar-side-icon>
      <v-toolbar-title>Конструктор форм</v-toolbar-title>
    </v-toolbar>
    <v-content>
      <v-container fluid fill-height>
        <v-layout
          justify-center
          align-center
        >
          <v-flex text-xs-center>
            <template v-if="!hasFormStruct">
              <!-- Form Builder -->
              <form-parser @insert-json="build"></form-parser>
              <!-- /Form Builder -->
            </template>
            <template v-else>
              <form-builder
                :items="form_struct"
                @remove-build-form="clearStruct"></form-builder>
            </template>
          </v-flex>
        </v-layout>
      </v-container>
    </v-content>
    <v-footer color="indigo" app>
      <span class="white--text">&copy; 2019</span>
    </v-footer>
  </v-app>
</template>

<script>
  import _ from 'lodash';
  import { mapState, mapActions } from 'vuex';
  import Transformater from '../utils/transformater';
  import FormParser from './FormParser';
  import FormBuilder from './FormBuilder';

  export default {
    data: () => ({
      drawer: null,
      form_struct : null
    }),
    computed : {
      hasFormStruct () {
        return !!this.form_struct;
      }
    },
    components : {
      FormParser,
      FormBuilder
    },
    methods : {
      build (json) {
        let _form = JSON.parse(
            JSON.stringify(json)
          ),
          tr, tree;
        // Vuex set
        this.$store.commit('setForm', _form);
        tr = new Transformater(json);
        tree = tr.tree();

        this.form_struct = tree;
      },
      clearStruct() {
        return this.form_struct = null;
      },
    }
  }
</script>