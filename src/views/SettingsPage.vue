<template>
    <Header></Header>
    <MenuLeft selected="settings"></MenuLeft>
    <MainContent> 
      <SettingsFreePages :site="'smmnakrutka'"/>
      <SettingsFreePages :site="'youtikins'"/>
    </MainContent>
    <Toaster/>
  </template>

<script>
import { getData } from '@/servis/getData.js'
import { EventBus } from '@/servis/EventBus'
import Toaster from '@/components/UI/Toaster.vue'
export default {
  components: { Toaster },
  name: 'SettingsPage',
  
}
</script>

<style scoped>

  main{
    margin-top: 300px;
  }

  
</style>