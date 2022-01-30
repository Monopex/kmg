<template>
  <v-app>
    <v-main>
      <notifications group="all" />
      <router-view/>
    </v-main>
  </v-app>
</template>

<script>

export default {
  name: 'App',

  data: () => ({
    //
  }),
};
</script>
