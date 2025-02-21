<template>
    <div class="main-content">
      <div class="main-content-wrap" :class="{flex}"> 
        <slot />
      </div>
    </div>
</template>

<script>

export default {
  name: 'MainContent',
  props:{
    flex:{
      type:Boolean,
      default:false,
    }
  }
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

    .main-content-wrap.flex{
      display: flex;
      column-gap: 20px;
    }
  }
  @media (max-width: 1499.98px) {
    .main-content{
      width: 100%;
    }
  }
  @media (max-width: 1210px) {
    .main-content-wrap{
      margin: 0px!important;
    }
  }
</style>