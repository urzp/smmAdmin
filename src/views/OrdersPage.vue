<template>
    <Header></Header>
    <MenuLeft selected="orders"></MenuLeft>
    <MainContent>
      <BackGrCard height="60px">
        <div class="buttons_wrap">
          <ButtonStd title="Незарегистрированные" width="250px" font_size="15px"></ButtonStd>
          <ButtonStd title="Зарегистрированные" width="250px" font_size="15px"></ButtonStd>
        </div>
      </BackGrCard>
      <BackGrCard>
        <div class="table">
          <TitleTable title="Заказы не зарегистрированных пользователей"/>
          <TableHeader class="set_width_table">
            <div>id</div>
            <div>Дата время</div>
            <div>Транзакция</div>
            <div>Email</div>
            <div>Кол-во</div>
            <div>Сумма</div>
            <div>url</div>
            <div>статус</div>
            <div>msg</div>
          </TableHeader>
          <TableBody>
            <div v-for="item in part_orders" :key="item.id" class="row set_width_table" >
              <div>{{ item.id }}</div>
              <div class="content_left">{{ item.datetime }}</div>
              <div>{{ item.transaction }}</div>
              <div class="content_left">{{ item.email }}</div>
              <div class="content_right">{{ item.quantity }}</div>
              <div class="content_right">{{ item.sum }} p.</div>
              <div class="content_left">{{ item.link }}</div>
              <div>{{ item.provader_status }}</div>
              <div class="content_left">{{ item.provader_msg }}</div>
            </div>
          </TableBody>
        </div>  
      </BackGrCard>
    </MainContent>
  </template>

<script>
import { getData } from '@/servis/getData.js'
export default {
  name: 'OrderPage',
  async mounted(){
    this.updateList()
  },
  data(){
    return{
      orders:'',
      part_orders:'',
    }
  },
  methods:{
    async updateList(){
      let result = await getData('getData.php',{typeData:'orders'})
      if(!this.checkResult(result)) return false
      this.orders = await result.data
      this.part_orders = this.orders.slice(0, 99)
    },
    checkResult(result){
      this.lading = false
      if (result.success) return true
      this.notFound = true
      return false
    },
  }
}
</script>

<style scoped>
  .buttons_wrap{
    display: flex;
    column-gap: 30px;
  }
</style>

<style lang="scss"  scoped>

  .set_width_table :nth-child(1){
    width: 30px;
  }

  .set_width_table :nth-child(2){
    min-width: 130px;
  }

  .set_width_table :nth-child(3){
    min-width: 80px;
  }

  .set_width_table :nth-child(4){
    min-width: 250px;
  }

  .set_width_table :nth-child(5){
    min-width: 50px;
  }

  .set_width_table :nth-child(6){
    min-width: 50px;
  }

  .set_width_table :nth-child(7){
    min-width: 200px;
    width: 30%;
  }

  .set_width_table :nth-child(8){
    min-width: 80px;
  }

  .set_width_table :nth-child(9){
    min-width: 150px;
  }


</style>