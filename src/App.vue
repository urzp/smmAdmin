<script setup>
import { RouterLink, RouterView } from 'vue-router'
</script>

<template>
  <router-view/>
</template>

<style lang="scss">
*{
  margin: 0;padding: 0;
}

body{
  background-color: #D2D2D4;
}

#app {

  @font-face {
    font-family: 'Play-Regular';
    src: local('Play-Regular'),
      url(assets/fonts/Play-Regular.ttf);
  }

  @font-face {
    font-family: 'Play-Bold';
    src: local('Play-Bold'),
      url(assets/fonts/Play-Bold.ttf);
  }

  @font-face {
    font-family: 'OpenGostTypeA';
    src: local('OpenGostTypeA'),
      url(assets/fonts/OpenGostTypeA.ttf);
  }

  @font-face {
    font-family: 'TildaSans';
    src: local('TildaSans'),
      url(assets/fonts/TildaSans-Regular.ttf);
  }

  @font-face {
    font-family: 'TildaSansBold';
    src: local('TildaSansBold'),
      url(assets/fonts/TildaSans-Bold.ttf);
  }

  font-family: Play-Regular, Arial, sans-serif;
  -webkit-font-smoothing: Play-Regular;
  -moz-osx-font-smoothing: Play-Regular;
  text-align: center;
  color: #0C151C;

}

input::-webkit-outer-spin-button, input::-webkit-inner-spin-button {
    -webkit-appearance: none;
    margin: 0; 
}

input[type='number'] {
    -moz-appearance: textfield;
}
</style>
