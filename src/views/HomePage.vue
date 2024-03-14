<template>
  <Header></Header>
  <MenuLeft selected="main"></MenuLeft>
  <MainContent>
    <div class="panel">
      <CardMain :data="usersProp"  @click="$router.push('/users')">
        <template v-slot:small_icon>
          <img src="@/assets/icons/card/user_l.svg" alt="" class="light">
          <img src="@/assets/icons/card/user_d.svg" alt="" class="dark">
        </template>
      </CardMain>
      <CardMain :data="OrdersProp"  @click="$router.push('/orders')">
        <template v-slot:small_icon>
          <img src="@/assets/icons/card/orders_l.svg" alt="" class="light">
          <img src="@/assets/icons/card/orders_d.svg" alt="" class="dark">
        </template>
      </CardMain>
      <CardMain :data="UsersOrdersProp" @click="$router.push('/orders/users')">
        <template v-slot:small_icon>
          <img src="@/assets/icons/card/order_users_l.svg" alt="" class="light">
          <img src="@/assets/icons/card/order_users_d.svg" alt="" class="dark">
        </template>
      </CardMain>
      <CardMain :data="ProvadersProp" :iconCentr="true" @click="$router.push('/provaders')">
        <template v-slot:big_icon>
          <img src="@/assets/icons/card/provader_l.svg" alt="" class="light">
          <img src="@/assets/icons/card/provader_d.svg" alt="" class="dark">         
        </template>
      </CardMain>
      <CardMain :data="settingsProp" :iconCentr="true" @click="$router.push('/settings')">
        <template v-slot:big_icon>
          <img src="@/assets/icons/card/settings_l.svg" alt="" class="light">
          <img src="@/assets/icons/card/settings_d.svg" alt="" class="dark">         
        </template>       
      </CardMain>
    </div>
  </MainContent>
</template>

<script>
import { getData } from '@/servis/getData.js'
export default {
  name: 'HomePage',
  async mounted(){
    this.updateData()
  },
  data(){
    return{
      usersProp:{
        title:'Пользователи',
        title_day_data: 'сутки',
        title_total_data: 'всего',
        day_data: "-",
        total_data: "-",
        graphic:[0,0,0,0,0,0,0],
      },
      OrdersProp:{
        title:'Oбщие заказы',
        title_day_data: 'сутки',
        title_total_data: 'всего',
        day_data: "-",
        total_data: "-",
        graphic:[0,0,0,0,0,0,0],
      },
      UsersOrdersProp:{
        title:'Заказы пользователей',
        title_day_data: 'сутки',
        title_total_data: 'всего',
        day_data: "-",
        total_data: "-",
        graphic:[0,0,0,0,0,0,0],
      },
      ProvadersProp:{
        title:'Постащики',
        title_day_data: '',
        title_total_data: 'всего',
        day_data: '',
        total_data: '-',
      },
      settingsProp:{
        title:'Настройки',
      },
    }
  },
  methods:{
    async updateData(){
      let result  = await getData('getData.php',{typeData:'dashBoard'})
      if(!this.checkResult(result)) return false
      this.adaptiveData(result.data)
    },
    checkResult(result){
      this.lading = false
      if (result.success) return true
      this.notFound = true
      return false
    },
    adaptiveData(data){
      this.usersProp.day_data = data.users.today
      this.usersProp.total_data = data.users.total
      this.usersProp.graphic = data.users.graphic

      this.OrdersProp.day_data = data.orders.today
      this.OrdersProp.total_data = data.orders.total
      this.OrdersProp.graphic = data.orders.graphic

      this.UsersOrdersProp.day_data = data.ordersUsers.today
      this.UsersOrdersProp.total_data = data.ordersUsers.total
      this.UsersOrdersProp.graphic = data.ordersUsers.graphic

      this.ProvadersProp.total_data = data.provader.total
    }
  },
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



