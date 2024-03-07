<template>
    <div class="main-content">
      <div class="main-content-wrap"> 
        <slot />
      </div>
    </div>
</template>

<script>

export default {
  name: 'MainContent'
}
</script>


<style lang="scss" scoped>
  .main-content{
    float: left;
    width: calc(100% - 250px);
    height: calc(100vh - 100px);
    .main-content-wrap{
      margin: 20px;
    }
  }
</style>