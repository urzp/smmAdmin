<template>
    <div class="title-table">
        <div class="label">{{ title }}</div>
        <PagePanel/>
    </div>
</template>

<script>
export default{
    name: 'TitleTable',
    props:{
        title: String,
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
</style>