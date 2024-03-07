<template>
    <div class="menu_left">
        <div class="menu-list">
            <div class="menu-item" :class="{'active':selectedItem.users}" @click="$router.push('/users')">
                <img v-if="selectedItem.users" src="../../assets/icons/users_w.svg" alt="users">
                <img v-else  src="../../assets/icons/users_b.svg" alt="users">
                <div class="memu-item-lab">Пользователи</div>
            </div>
            <div class="menu-item"  :class="{'active':selectedItem.orders}" @click="$router.push('/orders')">
                <img v-if="selectedItem.orders" src="../../assets/icons/orders_w.svg" alt="users">
                <img v-else  src="../../assets/icons/orders_b.svg" alt="users">
                <div class="memu-item-lab">Заказы</div>
            </div>
            <div class="menu-item"  :class="{'active':selectedItem.provaders}" @click="$router.push('/provaders')">
                <img v-if="selectedItem.provaders" src="../../assets/icons/prov_w.svg" alt="users">
                <img v-else  src="../../assets/icons/prov_b.svg" alt="users">
                <div class="memu-item-lab">Поставщики</div>
            </div>
            <div class="menu-item"  :class="{'active':selectedItem.settings}" @click="$router.push('/settings')">
                <img v-if="selectedItem.settings" src="../../assets/icons/settings_w.svg" alt="users">
                <img v-else  src="../../assets/icons/settings_b.svg" alt="users">
                <div class="memu-item-lab">Поставщики</div>
            </div>
        </div>
    </div>
</template>


<script>
export default {
    name: 'MenuLeft',
    data(){
        return{

        }
    },
    props:{
        selected: String,
    },
    computed:{
        selectedItem(){
            let out ={
                users: false,
                orders: false,
                provaders: false,
                settings:false
            }
            out[this.selected] = true
            return out
        }
    },
}
</script>

<style lang="scss" scoped>
.menu_left{
    width: 250px;
    height: calc(100vh - 100px);
    background-color: #E4E5EA;
    box-shadow: 0 2px 2px #00000030;

    .menu-list{
        padding-top: 50px;
        padding-left: 20px;
        padding-right: 20px;
    }

    .menu-item{
        height: 34px;
        margin-bottom: 10px;
        display: flex;
        align-items: center;
        justify-content: flex-start;
        column-gap: 10px;
        cursor: pointer;

        img{
            margin-left: 15px;
        }
    }

    .active{
        background-color: #6B99C3;
        border-radius: 20px;
        font-family: 'Play-Bold';
        color: #fff;
    }
}
</style>
