<template>
    <BackGrCard>
      <div class="table">
        <TitleTable title="Лог пользователя" :subtitle="`от ${date_f.from} до ${date_f.until}`" @click="date_f_click = !date_f_click" class="pointer"/>
        <TableHeader class="set_width_table">
          <h_colum title="#"/>
          <h_colum title='Дата время'/>
          <h_colum title='Действие'  type_f='find' v-model="action_f"/>
          <h_colum title='Новые данные'/>
          <h_colum title='Старые данные'/>
          <h_colum title='Статус' />
        </TableHeader>
        <TableBody>
          <div v-for="(item, index) in part_payments" :key="item.id" class="row set_width_table" @click="pop_show(index)" >
            <div>{{ index + 1 + (part - 1)*this.part_items}}</div>
            <div class="content_left">{{ item.date_time }}</div>
            <div class="content_left">{{ item.action }}</div> 
            <div class="content_left">{{ item.new_data}} </div>
            <div class="content_left">{{ item.old_data}} </div>
            <div >{{ conv_status(item.succsess) }} </div>
          </div>
        </TableBody>
      </div>  
    </BackGrCard>
    <PopupOrder userMode :order="pop_order" v-model="pop_open"/>
  </template>
  
  <script>
  import { getData } from '@/servis/getData.js'
  import { EventBus } from '@/servis/EventBus'
  import {coutMaxPages, newPage} from '@/servis/pageControl.js'
  export default {
  name: 'TableUserLog',
  async mounted(){
  this.updateList()
  EventBus.on('pageTable:update', (page)=>{
    this.part = page
    this.part_payments = newPage(this.f_payments, page, this.part_items)
  })
  },
  data(){
  return{
    payments:'',
    part:'',
    part_items: 100,
    f_payments:'',
    part_payments:'',
    date_f:{
      until: this.getFromTodayString(),
      from:  '2024-01-01'
    },
    date_f_click: false,
    action_f:'',
    status_f:'',
    pop_order:{},
    pop_open:false,
  }
  },
  props:{
  user_id:String,
  },
  watch:{
  status_f(){
    this.filter();
  },
  action_f(){
    this.filter();
  },
  date_f:{
    handler(n_v,o_l){
      this.updateList()
    }, 
    deep: true
  }
  },
  methods:{
  async updateList(){
    let result = await getData('getData.php',{typeData:'userLog', user_id:this.user_id})
    if(!this.checkResult(result)) return false
    this.payments = await result.data
    this.filter();
  },
  async filter(){
    let result = []
    result.push(...this.payments)
    let status_f = this.status_f
    let action_f = this.action_f
    if(action_f!=''){
      result = result.filter(i=>i.action.indexOf(action_f)!=-1)
    }
  
  
    if(status_f!=''){
      if(status_f=='true') result = result.filter(i=>i.provader_status=='success')
      if(status_f=='false') result = result.filter(i=>i.provader_status=='fall'||i.provader_status=='false')
    }
    this.f_payments = result
    this.intPage()
  },
  checkResult(result){
    this.lading = false
    if (result.success) return true
    this.notFound = true
    return false
  },
  conv_val(val){
    if(val==''||val=='none') return '-'
    val = val.replace(/['"{}]+/g , '')
    return val
  },
  conv_status(val){
    if(val==''||val=='none'||val=='') return '-'
    if(val=='true') return 'succsess'
    if(val=='false') return 'fall'
    return val
  },
  intPage(){
    EventBus.emit('pageTable:maxPage', coutMaxPages(this.f_payments, this.part_items) )
    this.part = 1
    this.part_payments = newPage(this.f_payments, this.part, this.part_items)
  },
  op_f(name){
    EventBus.emit(`${name}:open`)
  },
  getFromTodayString(days=0){
    let today = new Date()
    let result = new Date(today.setDate(today.getDate() - days))
    return result.toISOString().split('T')[0]
  },
  pop_show(i){
    this.pop_open = true
    let order = this.part_payments[i]
    this.pop_order = order 
  }
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
  
  .set_width_table>:nth-child(1){
  width: 30px;
  }
  
  .set_width_table>:nth-child(2){
  min-width: 140px;
  }
  
  .set_width_table>:nth-child(3){
  min-width: 150px;
  width: 20%;
  }
  
  .set_width_table>:nth-child(4){
  min-width: 200px;
  width: 35%;
  }
  
  .set_width_table>:nth-child(5){
  min-width: 200px;
  width: 35%;
  }

  .set_width_table>:nth-child(6){
  min-width: 80px;
  }
  
  .pointer{
  cursor: pointer;
  }
  </style>