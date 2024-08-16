<template>
    <Header></Header>
    <MenuLeft selected="settings"></MenuLeft>
    <MainContent>
      <BackGrCard height="500px">
        <Title title="Настройки" style="margin-bottom: 20px;">
          <ButtonStd  title="Сохранить" @click="()=>{}"/>
        </Title>
        <BackGrCard height="200px" width="560px" bg_color="#FFFFFF" bg_color_hover="#FFFFFF" border_radius="15px">
          <Title title="Бесплатные заказы" text_size="18px"></Title>
          <div class="line"></div>
          <div class="item_config">
            <div class="name_config">Максимальное количество услуг</div>
            <input type="number">
          </div>
          <div class="item_config">
            <div class="name_config">Поставшик</div>
            <input type="number">
          </div>
          <div class="item_config">
            <div class="name_config">Ожидания повторного заказа по одной ссылке (ч)</div>
            <input type="number">
          </div>
        </BackGrCard>
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

  .line{
    width: 100%;
    margin-top: 10px;
    margin-bottom: 15px ;
    border: solid 1px #ddd
  }

  .item_config{
    text-align: left;
    color: #565656;
    font-size: 16px;
    margin-bottom: 5px;
    display: flex;
    justify-content: space-between;
  }

  .item_config input{
    width: 50px;
    text-align: center;
    border: none;
    background-color: #eff8ff;
    border-radius: 8px;
    padding: 0px 8px;
  }

</style>