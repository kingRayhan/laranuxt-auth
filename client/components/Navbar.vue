<template>
  <div class=" flex justify-between items-center my-20">
    <nuxt-link to="/" class=" text-2xl font-semibold">
      Laranuxt Aut
    </nuxt-link>

    <!-- logo -->
    <nav class=" flex space-x-10" v-if="!$auth.loggedIn">
      <nuxt-link
        class=" font-bold text-base uppercase"
        :to="{ name: 'auth-login' }"
        >Login</nuxt-link
      >
      <nuxt-link
        class=" font-bold text-base uppercase"
        :to="{ name: 'auth-register' }"
        >Register</nuxt-link
      >
    </nav>

    <nav class=" flex space-x-10" v-else>
      <div class=" flex space-x-2 items-center">
        <img
          class=" w-10 h-10 rounded-full"
          :src="$auth.user.avatar"
          :alt="$auth.user.name"
        />
        <p class=" text-xl font-semibold">{{ $auth.user.name }}</p>
      </div>

      <button @click="$auth.logout()" class=" font-bold text-base uppercase">
        Logout
      </button>
    </nav>
  </div>
</template>
