<template>
  <Header></Header>
  <MenuLeft></MenuLeft>
  <MainContent>
    <div class="panel">
      <CardMain :data="usersProp">
        <template v-slot:small_icon>
          <img src="@/assets/icons/card/user_l.svg" alt="" class="light">
          <img src="@/assets/icons/card/user_d.svg" alt="" class="dark">
        </template>
      </CardMain>
      <CardMain :data="OrdersProp">
        <template v-slot:small_icon>
          <img src="@/assets/icons/card/orders_l.svg" alt="" class="light">
          <img src="@/assets/icons/card/orders_d.svg" alt="" class="dark">
        </template>
      </CardMain>
      <CardMain :data="UsersOrdersProp">
        <template v-slot:small_icon>
          <img src="@/assets/icons/card/order_users_l.svg" alt="" class="light">
          <img src="@/assets/icons/card/order_users_d.svg" alt="" class="dark">
        </template>
      </CardMain>
      <CardMain :data="ProvadersProp" :iconCentr="true">
        <template v-slot:big_icon>
          <img src="@/assets/icons/card/provader_d.svg" alt="" class="light">
          <img src="@/assets/icons/card/provader_l.svg" alt="" class="dark">         
        </template>
      </CardMain>
      <CardMain :iconCentr="true"/>
    </div>
  </MainContent>
</template>

<script>

export default {
  name: 'HomePage',
  data(){
    return{
      usersProp:{
        title:'Пользователи',
        title_day_data: 'сутки',
        title_total_data: 'всего',
        day_data: 145,
        total_data: 1200,
        graphic:[423,445,212,344,223,444,255],
      },
      OrdersProp:{
        title:'Oбщие заказы',
        title_day_data: 'сутки',
        title_total_data: 'всего',
        day_data: 145,
        total_data: 1200,
        graphic:[223,345,212,124,223,234,255],
      },
      UsersOrdersProp:{
        title:'Заказы пользователей',
        title_day_data: 'сутки',
        title_total_data: 'всего',
        day_data: 145,
        total_data: 1200,
      },
      ProvadersProp:{
        title:'Постащики',
        title_day_data: '',
        title_total_data: 'всего',
        day_data: '',
        total_data: 1200,
      },
    }
  }
}
</script>

<style lang="scss" scoped>
  .panel{
    display: flex;
    flex-wrap: wrap;
    gap: 20px;
    justify-content: flex-start;
  }


</style>



