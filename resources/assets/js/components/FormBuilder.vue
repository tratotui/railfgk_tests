<template>
  <v-form>
    <v-container grid-list-xl>
      <v-layout column>
        <template v-if="showConsole">
          <v-alert
            :value="true"
            type="info">Откройте консоль <b>[F12]</b></v-alert>
        </template>
        <form-comp
          v-for="comp in items"
          :key="comp.id"
          :struct="comp"></form-comp>
      </v-layout>
      <v-layout row wrap>
        <v-btn
          @click="showVuexForm">
          Показать значения формы
        </v-btn>
        <v-btn
          color="warning"
          @click="remove">
          Удалить форму
        </v-btn>
      </v-layout>
    </v-container>
  </v-form>
</template>

<script>
  import FormComp from './FormComp';

  export default {
    props : ['items'],

    components : {
      FormComp
    },

    data : () => ({
      showConsole : false
    }),
    computed : {

    },
    methods : {
      remove() {
        return this.$emit('remove-build-form');
      },
      showVuexForm() {
        let that = this;
        this.showConsole = true;

        setTimeout(() => {that.showConsole = false}, 10000)

        console.log(
          JSON.parse(
            JSON.stringify(this.$store.state.form)
          )
        );
      }
    }
  }
</script>