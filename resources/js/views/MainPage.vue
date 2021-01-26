<template>
  <div>
    <div class="text-center my-3">
      <router-link to="/create" class="btn btn-success"
        >Добавить питомца</router-link
      >
    </div>
    <b-form-input
      v-model="filter"
      type="search"
      id="filterInput"
      placeholder="Введите номер телефона для поиска..."
      class="my-3 mx-auto search-form text-center"
      autofocus="autofocus"
      v-mask="'+7 (###) ###-##-##'"
      maxlength="18"
    ></b-form-input>
    <template v-if="items && items.data.data && items.data.data.length > 0">
      <b-table striped hover :items="items.data.data" :key="items.data.data" :fields="fields">
      </b-table>
      <b-pagination
        v-model="current_page"
        :total-rows="items.data.meta.total"
        :per-page="items.data.meta.per_page"
        align="center"
      ></b-pagination>
    </template>
    <template v-else>
      <div class="text-center">Ничего не найдено</div>
    </template>
  </div>
</template>
<script>
const default_layout = "default";
const axios = require("axios").default;

export default {
  data() {
    return {
      items: "",
      filter: "",
      current_page: 1,
      fields: [
        { key: "breed", label: "Порода" },
        { key: "nickname", label: "Кличка" },
        { key: "age", label: "Возраст" },
        { key: "owner.full_name", label: "Владелец" },
        { key: "owner.phone", label: "Телефон" },
      ],
    };
  },
  methods: {
    async fetchItems() {
      this.items = await axios.get("/api/pet?page="+this.current_page);
    },
    async fetchSearchResults() {
      try {
        this.items = await axios.post("/api/pet/find", {
          phone: this.filter.replace(/[^0-9]/g, ""),
        });
      } catch (e) {
        if (e.response.status && e.response.status === 404) {
          this.items.data.data = [];
        }
      }
    },
  },
  async mounted() {
    this.fetchItems();
    window.addEventListener("keypress", function (event) {
      let filterField = document.getElementById("filterInput");
      filterField.focus();
    });
  },
  watch: {
    filter: {
      handler: function (value, prevValue) {
        if (value.length == 18) {
          this.fetchSearchResults();
        } else if (prevValue.length == 18 && value.length < 18) {
          this.fetchItems();
        }
      },
    },
    current_page: {
      handler: function () {
        this.fetchItems();
      },
    },
  },
};
</script>

<style scoped>
.search-form{
  width: 50%;
}
</style>