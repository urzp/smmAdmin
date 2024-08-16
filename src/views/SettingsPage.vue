<template>
    <Header></Header>
    <MenuLeft selected="settings"></MenuLeft>
    <MainContent>
      <BackGrCard height="500px">
        <TitleTable title="Настройки"></TitleTable>
      </BackGrCard>
    </MainContent>
  </template>

<script>

export default {
  name: 'SettingsPage'
}
</script>

<style scoped>

  main{
    margin-top: 300px;
  }

</style>