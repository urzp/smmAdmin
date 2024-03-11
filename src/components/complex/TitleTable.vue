<template>
    <div class="title-table">
        <div class="label">{{ title }} <div class="subtitle">{{ subtitle }}</div></div>
        <PagePanel/>
    </div>
</template>

<script>
export default{
    name: 'TitleTable',
    props:{
        title: String,
        subtitle: String,
    }
}
</script>

<style lang="scss"  scoped>
  .title-table{
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 10px;
  }
  .label{
    font-size: 24px;
    text-align: left;
  }
  .subtitle{
    font-size: 18px;
    color: #959595;
  }
</style>