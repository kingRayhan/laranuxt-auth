<template>
  <div>
    <h1 class=" text-2xl">To access your account login now</h1>

    <form
      @submit.prevent="handleSubmit"
      class=" w-4/12 mt-2 flex flex-col space-y-4"
    >
      <label>
        <p>Email</p>
        <input v-model="form.email" class=" w-full" type="email" />
        <p class=" text-red-500" v-if="errors.email">
          {{ errors.email.join(" ") }}
        </p>
      </label>

      <label>
        <p>Password</p>
        <input v-model="form.password" class=" w-full" type="password" />
        <p class=" text-red-500" v-if="errors.password">
          {{ errors.password.join(" ") }}
        </p>
      </label>

      <button class=" w-max text-white bg-blue-500 py-2 px-4">Login</button>
    </form>

    <div class="mt-6">
      Don't have any account
      <nuxt-link
        class=" text-blue-500 underline"
        :to="{ name: 'auth-register' }"
        >Register now</nuxt-link
      >
    </div>
  </div>
</template>

<script>
import swal from "sweetalert";
export default {
  data() {
    return {
      errors: {},
      form: {
        email: "",
        password: ""
      }
    };
  },
  methods: {
    async handleSubmit() {
      this.errors = {};
      try {
        // await this.$axios.$post("api/auth/login", this.form);
        await this.$auth.loginWith("local", { data: this.form });

        // this.$router.push({ name: "auth-login" });

        swal({
          title: "You have been registered logged in",
          icon: "success"
        });
      } catch (error) {
        if (error.response.status === 422) {
          this.errors = error?.response?.data?.errors;
          return;
        }

        // if (error.response.status === 401) {

        swal({
          title: error.response.data.message,
          icon: "error"
        });
      }
    }
  }
};
</script>
