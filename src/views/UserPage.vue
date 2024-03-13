<template>
    <Header></Header>
    <MenuLeft selected="users"></MenuLeft>
    <MainContent>
        <CardUser :user="user"/>
        <TableUserOrders v-if="selectTable=='orders'" :user_id="user_id"/>
        <TableUserUpBalans v-if="selectTable=='upbalans'" :user_id="user_id"/>
        <TableUserLog v-if="selectTable=='log'" :user_id="user_id"/>
    </MainContent>
</template>

<script>
import { getData } from '@/servis/getData.js'
import { EventBus } from '@/servis/EventBus'
export default {
  name: 'UserPage',
  async mounted(){
    await this.getUser()
    EventBus.on('UserPageSelectTable',(table)=>{this.selectTable=table})
  },
  data(){
    return{
      user_id:this.$route.params.userId,
      user:{},
      orders:{},
      balans:{},
      selectTable:'orders'
    }
  },
  methods:{
    async getUser(){
      let result  = await getData('getData.php',{typeData:'user', user_id: this.user_id})
      if(!this.checkResult(result)) return false
      this.user = await result.data
    },
    checkResult(result){
      this.lading = false
      if (result.success) return true
      this.notFound = true
      return false
    }
  }
}
</script>

