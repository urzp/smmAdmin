<template>
    <div class="page_panel">
    <ButtonPage img="goStart"/>
    <ButtonPage img="goLeft"/>
    <ButtonPage v-model="page"/>
    <ButtonPage img="goRight"/>
    <ButtonPage img="goEnd"/>
    </div>
</template>

<script>
export default {
  name: 'PagePanel',
  data(){
    return{
      page: '1',
    }
  }
}
</script>


<style scoped>
  .page_panel{
    display: flex;
    column-gap: 10px;
  }
</style>