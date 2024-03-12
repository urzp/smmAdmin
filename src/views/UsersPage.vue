<template>
    <Header></Header>
    <MenuLeft selected="users"></MenuLeft>
    <MainContent>
      <BackGrCard>
        <div class="table">
          <TitleTable title="Пользователи"/>
          <TableHeader class="set_width_table">
            <h_colum title='#' />
            <h_colum title='Email' type_f='find' v-model="f_hands.email"/>
            <h_colum title='Имя пользователя' type_f='find' v-model="f_hands.name"/>
            <h_colum title='Телефон' type_f='find' v-model="f_hands.phone"/>
            <h_colum title='Баланс' type_f='true_false' v-model="f_hands.sum" l_true="вверх" l_false="вниз"/>
            <h_colum title='Дата рег.' type_f='true_false' v-model="f_hands.date_reg" l_true="вверх" l_false="вниз"/>
            <h_colum title='Дата лог.' type_f='true_false' v-model="f_hands.date_log" l_true="вверх" l_false="вниз"/>
            <h_colum title='Заказов' type_f='true_false' v-model="f_hands.sum_ord" l_true="вверх" l_false="вниз" f_left/>
          </TableHeader>    
          <TableBody>
            <div v-for="(item, index ) in part_users" :key="item.id" class="row set_width_table pointer" @click="$router.push(`/users/${item.id}`)">
              <div>{{ index + 1 + (part - 1)*100 }}</div>
              <div class="content_left">{{ item.email }}</div>
              <div class="content_left">{{ item.Name }}</div>
              <div>{{ item.phone }}</div>
              <div class="content_right">{{ item.balans  }} р.</div>
              <div>{{ ifNull(item.registration) }}</div>
              <div>{{ convetToDate(item.time_login) }}</div>
              <div class="content_right">{{ orders_summ(item.orders, item.sum_orders) }}</div>
            </div>
          </TableBody>
        </div>
      </BackGrCard>
    </MainContent>
  </template>

<script>
import { getData } from '@/servis/getData.js'
import {coutMaxPages, newPage} from '@/servis/pageControl.js'
import { EventBus } from '@/servis/EventBus'
export default {
  name: 'UsersPage',
  async mounted(){
    this.updateList()
    EventBus.on('pageTable:update', (page)=>{
      this.part = page
      this.part_users = newPage(this.f_users, page, this.part_items)
    })
  },
  data(){
    return{
      users:'',
      f_users:'',
      part_items: 100,
      part:'',
      part_users:'',
      f_hands:{
        email:'',
        name:'',
        phone:'',
        date_reg:'',
        date_log:'',
        sum:'',
        sum_ord:'',
      }
    }
  },
  watch:{
    f_hands:{
      handler(n_v,o_v){
        this.filter();
      }, 
      deep: true  
    }
  },
  methods:{
    async updateList(){
      let result = await getData('getData.php',{typeData:'users'})
      if(!this.checkResult(result)) return false
      this.users = await result.data
      this.filter();
    },
    checkResult(result){
            this.lading = false
            if (result.success) return true
            this.notFound = true
            return false
    },
    async filter(){
      let result = []
      result.push(...this.users)
      this.f_users = result
      this.intPage()
      let email_f = this.f_hands.email
      let name_f  = this.f_hands.name
      let phone_f  = this.f_hands.phone
      let date_reg_f = this.f_hands.date_reg
      let date_log_f = this.f_hands.date_log
      let sum_f  = this.f_hands.sum
      let sum_ord_f = this.f_hands.sum_ord
      if(email_f!=''){
        result = result.filter(i=>i.email.indexOf(email_f)!=-1)
      }
      if(name_f!=''){
        result = result.filter(i=>i.Name.indexOf(name_f)!=-1)
      }
      if(phone_f!=''){
        result = result.filter(i=>i.phone.replace(/[-() ]+/g , '').indexOf(phone_f)!=-1)
      }
      if(sum_f!=''){
        result = result.sort((a,b)=>{
          let res;
          a = Number(a.balans)
          b = Number(b.balans)
          if(a > b) res = 1;
          if(a == b) res = 0;
          if(a < b) res = -1;
          if(sum_f == 'false') res = res*(-1)
          return res
        }) 
      }
      if(sum_ord_f!=''){
        result = result.sort((a,b)=>{
          let res;
          a = Number(a.sum_orders)
          b = Number(b.sum_orders)
          if(a > b) res = 1;
          if(a == b) res = 0;
          if(a < b) res = -1;
          if(sum_ord_f == 'false') res = res*(-1)
          return res
        })         
      }
      if(date_log_f!=''){
        result = result.sort((a,b)=>{
          let res;
          a = Number(a.time_login)
          b = Number(b.time_login)
          if(a > b) res = 1;
          if(a == b) res = 0;
          if(a < b) res = -1;
          if(date_log_f == 'false') res = res*(-1)
          return res
        })    
      }
      if(date_reg_f!=''){
        result = result.sort((a,b)=>{
          let res;
          a = new Date(a.registration)
          b = new Date(b.registration)
          if(a > b) res = 1;
          if(a == b) res = 0;
          if(a < b) res = -1;
          if(date_reg_f == 'false') res = res*(-1)
          return res
        })    
      }
      this.f_users = result
      this.intPage()
    },
    intPage(){
      EventBus.emit('pageTable:maxPage', coutMaxPages(this.f_users, this.part_items) )
      this.part = 1
      this.part_users = newPage(this.f_users, this.part, this.part_items)
    },
    ifNull(val){
      if(!val||val=='') return '-'
      return val
    },
    convetToDate(t){
      if(t==0||!t) return '-'
      let d = new Date(t*1000)
      return d.toLocaleString()
    },
    orders_summ(o,s){
      if(o==0) return '-'
      //return `${o} / ${s} р`
      return `${s} р`
    }
  }
}
</script>

<style lang="scss"  scoped>

  .set_width_table>:nth-child(1){
    width: 30px;
  }

  .set_width_table>:nth-child(2){
    min-width: 230px;
    width: 20%;
  }

  .set_width_table>:nth-child(3){
    min-width: 180px;
    width: 10%;
  }

  .set_width_table>:nth-child(4){
    min-width: 130px;
  }

  .set_width_table>:nth-child(5){
    min-width: 80px;
  }

  .set_width_table>:nth-child(6){
    min-width: 130px;
  }

  .set_width_table>:nth-child(7){
    min-width: 130px;
  }

  .set_width_table>:nth-child(8){
    min-width: 100px;
  }

  .content_left{
    text-align: left;
    padding-left: 10px;
  }

  .header-table.set_width_table div {
    text-align:center;
  }

  .pointer{
    cursor: pointer;
  }
</style>

