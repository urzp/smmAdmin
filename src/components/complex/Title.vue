<template>
    <div class="title">
        <div class="label">{{ title }} <div class="subtitle">{{ subtitle }}</div></div>
        <slot/>
        <PagePanel/>
    </div>
</template>

<script>
export default{
    name: 'Title',
    props:{
        title: String,
        subtitle: String,
        text_size:{
            type: String,
            default: '24px',
        },
    }
}
</script>

<style lang="scss"  scoped>
  .title{
    display: flex;
    justify-content: space-between;
    align-items: center;
  }
  .label{
    font-size: v-bind(text_size);
    text-align: left;
  }
  .subtitle{
    font-size: 18px;
    color: #959595;
  }
</style>