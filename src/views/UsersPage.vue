<template>
    <Header></Header>
    <MenuLeft selected="users"></MenuLeft>
    <MainContent>
      <BackGrCard>
        <div class="table">
          <TitleTable title="Пользователи"/>
          <TableHeader class="set_width_table">
            <div>id</div>
            <div>Email</div>
            <div>Имя пользователя</div>
            <div>Телефон</div>
            <div>Баланс</div>
            <div>Дата рег.</div>
            <div>Дата лог.</div>
            <div>Заказов</div>
          </TableHeader>    
          <TableBody>
            <div v-for="item in users" :key="item.id" class="row set_width_table" >
              <div>{{ item.id }}</div>
              <div class="content_left">{{ item.email }}</div>
              <div class="content_left">{{ item.Name }}</div>
              <div>{{ item.phone }}</div>
              <div class="content_right">{{ item.balans  }} р.</div>
              <div>-</div>
              <div>{{ convetToDate(item.time_login) }}</div>
              <div>{{ orders_summ(item.orders, item.sum_orders) }}</div>
            </div>
          </TableBody>
        </div>
      </BackGrCard>
    </MainContent>
  </template>

<script>
import { getData } from '@/servis/getData.js'
export default {
  name: 'UsersPage',
  async mounted(){
    this.updateList()
  },
  data(){
    return{
      users:''
    }
  },
  methods:{
    async updateList(){
      let result = await getData('getData.php',{typeData:'users'})
      if(!this.checkResult(result)) return false
      this.users = await result.data
    },
    checkResult(result){
            this.lading = false
            if (result.success) return true
            this.notFound = true
            return false
    },
    convetToDate(t){
      if(t==0) return '-'
      let d = new Date(t*1000)
      return d.toLocaleString()
    },
    orders_summ(o,s){
      if(o==0) return '-'
      return `${o} / ${s} р`
    }
  }
}
</script>

<style lang="scss"  scoped>

  .set_width_table :nth-child(1){
    width: 30px;
  }

  .set_width_table :nth-child(2){
    min-width: 250px;
    width: 20%;
  }

  .set_width_table :nth-child(3){
    min-width: 200px;
    width: 10%;
  }

  .set_width_table :nth-child(4){
    min-width: 150px;
  }

  .set_width_table :nth-child(5){
    min-width: 100px;
  }

  .set_width_table :nth-child(6){
    min-width: 100px;
  }

  .set_width_table :nth-child(7){
    min-width: 130px;
  }

  .set_width_table :nth-child(8){
    min-width: 100px;
  }

  .content_left{
    text-align: left;
    padding-left: 10px;
  }

  .header-table.set_width_table div {
    text-align:center;
  }
</style>

