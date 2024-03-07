<template>
    <Header></Header>
    <MenuLeft selected="users"></MenuLeft>
    <MainContent>
      <BackGrCard>
        <div class="title">Пользователи</div>
      </BackGrCard>
    </MainContent>
  </template>

<script>
export default {
  name: 'UsersPage'
}
</script>

<style scoped>
  .title{
    font-size: 24px;
    text-align: left;
  }
</style>

