<template>
    <div class="body-table">
        <slot/>
    </div>
</template>

<script>
export default{
    name: 'TableBody',
    props:{
        align:{
            type: String,
            default: "space-between",
        }
    }
} 
</script>

<style lang="scss"  scoped>
  .body-table{
    font-family: 'OpenGostTypeA';
    font-size: 18px;
    color:#253F54;
  }
  :deep(.row){
      display: flex;
      align-items: center;
      justify-content: v-bind(align);
      column-gap: 10px;
      div{
        overflow: hidden;
        white-space: nowrap;
      }
      .content_left{
        text-align: left;
        padding-left: 10px;
      }

      .content_right{
        text-align: right;
        padding-right: 10px;
      }

      .header-table.set_width_table div {
        text-align:center;
      }
    }
</style>