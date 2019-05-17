<template>
  <v-form>
    <v-container grid-list-xl>
      <v-layout column>
        <template v-if="hasError">
          <v-alert
            :value="true"
            type="error">{{ error }}</v-alert>
        </template>
        <v-flex xs12>
          <v-textarea
            v-model="json"
            box="true"
            name="json"
            height="500px"
            label="JSON"></v-textarea>
        </v-flex>
        <hr>
        <v-flex xs12>
          <v-btn
            :disabled="hasError"
            @click="parse">
            Построить форму
          </v-btn>
        </v-flex>
      </v-layout>
    </v-container>
  </v-form>
</template>

<script>
  const JSON_PARSE_ERR = `Ошибка при компиляции JSON`;

  export default {
    data : () => ({
      json : null,
      error : null
    }),
    computed : {
      hasError () {
        return !!this.error;
      }
    },
    methods : {
      parse () {
        let that = this,
            json = null;

        try {
          json = JSON.parse(that.json);
        } catch (e) {
          return that.showError(JSON_PARSE_ERR);
        }

        return !!json && typeof json === 'object' ?
                this.$emit('insert-json', json) :
                this.showError(JSON_PARSE_ERR);
      },
      showError (err) {
        let that = this;
            that.error = err;
        return setTimeout(() => {that.error = null}, 5000);
      }
    }
  }
</script>