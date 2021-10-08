<template>
  <div>
    <h1 class=" text-2xl">Create a brand new account</h1>

    <form
      @submit.prevent="handleSubmit"
      class=" w-4/12 mt-2 flex flex-col space-y-4"
    >
      <label>
        <p>Name</p>
        <input v-model="form.name" class=" w-full" type="text" />
        <p class=" text-red-500" v-if="errors.name">
          {{ errors.name.join(" ") }}
        </p>
      </label>

      <label>
        <p>username</p>
        <input v-model="form.username" class=" w-full" type="text" />
        <p class=" text-red-500" v-if="errors.username">
          {{ errors.username.join(" ") }}
        </p>
      </label>

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

      <label>
        <p>Confirm password</p>
        <input
          v-model="form.password_confirmation"
          class=" w-full"
          type="password"
        />
        <p class=" text-red-500" v-if="errors.password_confirmation">
          {{ errors.password_confirmation.join(" ") }}
        </p>
      </label>

      <button class=" w-max text-white bg-blue-500 py-2 px-4">Register</button>
    </form>

    <div class="mt-6">
      Already have an account?
      <nuxt-link class=" text-blue-500 underline" :to="{ name: 'auth-login' }"
        >login now</nuxt-link
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
        name: "",
        username: "",
        email: "",
        password: "",
        password_confirmation: ""
      }
    };
  },
  methods: {
    async handleSubmit() {
      this.errors = {};
      try {
        await this.$axios.$post("api/auth/register", this.form);

        this.$router.push({ name: "auth-login" });

        swal({
          title: "You have been registered successfully",
          icon: "success"
        });
      } catch (error) {
        if (error.response.status === 422) {
          this.errors = error?.response?.data?.errors;
        }
      }
    }
  }
};
</script>
