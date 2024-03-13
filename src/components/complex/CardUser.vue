<template>
    <BackGrCard height="160px">
        <div class="wrap_group_level_1">
            <div class="groupe_1_level_1">
                <div class="row_inf">
                    <div class="colum">
                        <div class="label">id</div>
                        <div class="content">{{ user.id }}</div>
                    </div>
                    <div class="colum">
                        <div class="label">email</div>
                        <div class="content">{{ user.email }}</div>
                    </div>
                    <div class="colum">
                        <div class="label">Имя</div>
                        <div class="content">{{ ifNot(user.Name) }}</div>
                    </div>
                </div>
                <div class="buttons_wrap">
                    <ButtonStd title="Заказы" @click="selectTabel('orders')" width="220px" height="35px" font_size="16px"/>
                    <ButtonStd title="Баланс" @click="selectTabel('upbalans')" width="220px" height="35px"  font_size="16px"/>
                    <ButtonStd title="Лог" @click="selectTabel('log')" width="220px" height="35px"  font_size="16px"/>
                </div>
            </div>
            <div class="groupe_2_level_1">
                <div class="label">дата регистрации</div>
                <div class="content">{{ convetDate(user.registration) }}</div>  
                <div class="label">время входа</div>
                <div class="content">{{ convetIntDate(user.time_login) }}</div>             
            </div>
            <div class="groupe_3_level_1">
                <div class="label">баланс</div>
                <div class="content">{{ user.balans }} р</div>  
                <div class="label">телефон</div>
                <div class="content">{{ifNot(user.phone)}}</div>            
            </div>
        </div>
    </BackGrCard>
</template>

<script>
import { EventBus } from '@/servis/EventBus'
export default {
    name: 'CardUser',
    data(){
        return{
            
        }
    },
    props:{
        user:Object,
    },
    methods:{
        ifNot(val){
            if(!val||val=='') return '-'
            return val
        },
        convetDate(d){
            if(!d||d=='') return '-'
            return d.split(' ')[0]
        },
        convetIntDate(d){
            if(!d||d=='') return '-'
            let result = new Date(Number(d)*1000)
            return result.toLocaleString()
        },
        selectTabel(t){
            EventBus.emit('UserPageSelectTable',t)
        }
    }
}
</script>

<style lang="scss" scoped>
    .label{
        font-size: 18px;
        color:#A8A8A8;
    }
    .content{
        font-size: 24px;
        color:#0C151C;        
    }
    .wrap_group_level_1{
        display: flex;
        justify-content: space-between;
        column-gap: 15px;
    }
    .groupe_1_level_1{
        width: 700px;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        column-gap: 10px;
    }
    .row_inf{
        display: flex;
        justify-content: space-between;
    }
    .buttons_wrap{
        display: flex;
        justify-content: space-between;
    }
</style>