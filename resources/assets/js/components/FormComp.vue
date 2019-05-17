<template>
  <div class="wrapper__comp">
    <template v-if="hasChildren">
      <h4>{{ struct.name }}</h4>
      <v-flex>
        <form-comp
            v-for="item in struct.items"
            :key="item.id"
            :struct="item"></form-comp>
      </v-flex>
    </template>
    <template v-else>
      <component
        :is="vuetifyCompType"
        :rules="vuetifyCompRules"
        :label="struct.name"
        :value="struct.val"
        :name="struct.code"
        @change="change"></component>
    </template>
  </div>
</template>

<script>
  import { mapState, mapActions } from 'vuex';

  const VALIDATE = 'validate';
  const NUMBER = 'num';
  const STRING = 'string';
  const NUMBER_RE = /^(\d+)$/;
  const STRING_RE = /^([А-Яа-яA-Za-z]+)$/;

  export default {
    name : 'form-comp',
    props : ['struct'],
    data : () => ({

    }),
    computed : {
      vuetifyCompType () {
        let v_type = '';
        switch (this.struct.type) {
          case "group":
            v_type = 'v-container';
            break;
          case "input":
            v_type = 'v-text-field';
            break;
        }
        return v_type;
      },
      vuetifyCompRules () {
        let rules = [];

        if (!this.struct.hasOwnProperty(VALIDATE)) {
          return rules;
        }

        rules.push(v => !!v || `Поле [${this.struct.name}] обязательно.`);

        /**
         * Примитивные проверки
         */
        if (this.struct[VALIDATE] == NUMBER) {
          rules.push(v => NUMBER_RE.test(v) || `Поле [${this.struct.name}] должно быть числом.`);
        }

        if (this.struct[VALIDATE] == STRING) {
          rules.push(v => STRING_RE.test(v) || `Поле [${this.struct.name}] должно быть строкой.`);
        }
        return rules;
      },
      hasChildren () {
        return !!this.struct.items &&
                !!this.struct.items.length;
      }
    },
    methods : {
      change(val) {
        this.$store.commit(
          'setFormCompVal',
          {cid : this.struct.id, val: val}
        );
      }
    }
  }
</script>