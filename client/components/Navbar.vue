<template>
  <div class=" flex justify-between items-center my-20">
    <nuxt-link to="/" class=" text-2xl font-semibold">
      Laranuxt Aut
    </nuxt-link>

    <!-- logo -->
    <nav class=" flex space-x-10">
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
  </div>
</template>
