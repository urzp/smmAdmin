<template>
    <Header></Header>
    <MenuLeft selected="provaders"></MenuLeft>
    <MainContent>
        <BackGrCard>
            <div class="table">
                <TitleTable title="Поставщики">
                  <ButtonStd v-if="isAdmin" title="Добавить" :height="'35px'" @click="new_provider"/>
                </TitleTable>
                <TableHeader class="set_width_table" :align="'flex-start'">
                    <h_colum title="#"/>
                    <h_colum title='id поставщика'/>
                    <h_colum v-if="isAdmin" title='url'/>
                    <h_colum v-if="isAdmin" title='api-key'/>
                    <h_colum title='баланс'/>
                    <h_colum title='валюта'/>
                </TableHeader>
                <TableBody :align="'flex-start'">
                    <div v-for="(item, index) in part_providers" :key="item.id" class="row set_width_table pointer" @click="pop_show(index)">
                        <div>{{ index + 1 + (part - 1)*this.part_items}}</div>
                        <div>{{ item.id_old }}</div>
                        <div v-if="isAdmin" class="content_left">{{ item.name }}</div>
                        <div v-if="isAdmin" class="content_left">{{ item.api_key }}</div>
                        <div class="content_right">{{ item.balans}}</div>
                        <div class="content_left">{{ item.currency }}</div>
                    </div>
                </TableBody>
            </div>
        </BackGrCard>
      <PopupProvider v-if="isAdmin" :provider_id = "pop_provider_id" v-model="pop_open"/>
    </MainContent>
</template>

<script>
import { getData } from '@/servis/getData.js'
import {coutMaxPages, newPage} from '@/servis/pageControl.js'
import { EventBus } from '@/servis/EventBus'
import { isAdmin } from '@/servis/islogget'
export default {
  name: 'ProvidersPage',
  async mounted(){
    this.isAdmin = await isAdmin()
    this.updateList()
    EventBus.on('pageTable:update', (page)=>{
      this.part = page
      this.part_providers = newPage(this.f_providers, page, this.part_items)
    })
    EventBus.on('Provader:updateList',this.updateList)
  },
  data(){
    return{
        isAdmin:false,
        providers:'',
        f_providers:'',
        part_items: 100,
        part:'',
        part_providers:'',
        pop_provider:'',
        pop_provider_id:'',
        pop_open:false,
    }
  },
  methods:{
    async updateList(){
      let result = await getData('getData.php',{typeData:'providers'})
      if(!this.checkResult(result)) return false
      this.providers = await result.data
      this.filter()
    },
    checkResult(result){
      this.lading = false
      if (result.success) return true
      this.notFound = true
      return false
    },
    filter(){
      this.f_providers = this.providers
      this.intPage()
    },
    intPage(){
      EventBus.emit('pageTable:maxPage', coutMaxPages(this.f_providers, this.part_items)) 
      this.part = 1
      this.part_providers = newPage(this.f_providers, this.part, this.part_items)
    },
    pop_show(i){
      if(!this.isAdmin) return
      this.pop_open = true
      this.pop_provider_id = this.part_providers[i].id
      this.pop_provider = this.part_providers[i]
    },
    new_provider(){
      this.pop_provider_id = 'new'
      this.pop_open = true
    }
  }

}
</script>


<style lang="scss"  scoped>

  .set_width_table>:nth-child(1){
    width: 30px;
  }

  .set_width_table>:nth-child(2){
    min-width: 80px;
  }

  .set_width_table>:nth-child(3){
    min-width: 250px;
  }

  .set_width_table>:nth-child(4){
    width: 50px;
  }

  .set_width_table>:nth-child(5){
    width: 150px;
  }

  .set_width_table>:nth-child(6){
    width: 60px;
  }

  .pointer{
    cursor: pointer;
    transition: 0.3s;
  }

  .pointer:hover{
    background-color: #6B99C3;
    color:#fff;
    transition: 0.3s;
  }
</style>