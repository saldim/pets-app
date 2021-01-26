<template>
  <div>
    <div v-if="!isSent">
      <form class="mt-5 col-md-6 mx-auto">
        <h3 class="text-center mx-2">Добавить питомца</h3>
         <b-alert show variant="danger" class="text-center" v-if="showAlert">Возникла ошибка. Пожалуйста проверьте, что поля заполнены корректно, и повторите попытку.</b-alert>
        <b-form-group id="input-group-1" label="ФИО:" label-for="input-1">
          <b-form-input
            id="input-1"
            v-model="fields.full_name"
            placeholder="Иванов Иван Иванович"
            required
          ></b-form-input>
        </b-form-group>
        <b-form-group
          id="input-group-2"
          label="Номер телефона:"
          label-for="input-2"
        >
          <b-form-input
            id="input-2"
            v-model="fields.phone"
            placeholder="+7 (000) 000-00-00"
            v-mask="'+7 (###) ###-##-##'"
            minlength=18
            maxlenhth=18
            required
          ></b-form-input>
        </b-form-group>
        <b-form-group id="input-group-3" label="Порода:" label-for="input-3">
          <b-form-input
            id="input-3"
            v-model="fields.breed"
            placeholder="Лабрадор"
            required
          ></b-form-input>
        </b-form-group>
        <b-form-group id="input-group-4" label="Кличка:" label-for="input-4">
          <b-form-input
            id="input-4"
            v-model="fields.nickname"
            placeholder="Йоко"
            required
          ></b-form-input>
        </b-form-group>
        <b-form-group id="input-group-5" label="Возраст:" label-for="input-5">
          <b-form-input
            id="input-5"
            type="number"
            min="0"
            v-model="fields.age"
            placeholder="3"
            required
          ></b-form-input>
        </b-form-group>
        <div class="mx-auto text-center w-100">
          <b-button type="button" variant="primary" @click="sendPet()"
            >Добавить</b-button
          >
          <router-link class="btn btn-danger" to="/">Отмена</router-link>
        </div>
      </form>
    </div>
    <div v-else>
      <h2 class="text-center mt-5">Питомец успешно добавлен!</h2>
      <div class="mt-3 text-center mx-auto">
        <b-button class="btn btn-success" @click="clearFields()">Добавить еще</b-button>
        <router-link class="btn btn-default" to="/">На главную</router-link>
      </div>
    </div>
  </div>
</template>
<script>
const axios = require("axios").default;

export default {
  computed: {},
  data() {
    return {
      isSent: false,
      showAlert: false,
      fields: {
        full_name: "",
        phone: "",
        breed: "",
        nickname: "",
        age: "",
      },
    };
  },
  methods: {
    async sendPet() {
      try {
        var response = await axios.post("/api/pet", {
          full_name: this.fields.full_name,
          phone: this.fields.phone.replace(/[^0-9]/g, ""),
          breed: this.fields.breed,
          nickname: this.fields.nickname,
          age: this.fields.age,
        });
      } catch (e) {
        this.showAlert = true;
      }
      console.log(response);
      if (response.status === 201) {
        this.isSent = true;
        this.showAlert = false;
      }
    },
    clearFields() {
      this.isSent = false;
      this.showAlert = false;
      this.fields = {
        full_name: "",
        phone: "",
        breed: "",
        nickname: "",
        age: "",
      };
    },
  },
};
</script>
