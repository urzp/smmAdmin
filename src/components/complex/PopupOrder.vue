<template>
    <div v-show="modelValue" class="popup_bg_screen" @click.stop="close">
        <div class="popup" @click.stop="">
            <div class="header">
                <div class="h_label">Заказ:</div>
                <div class="h_content">{{ pop_order.transaction }}</div>
                <div class="filter_close_btn" @click.stop="close">
                    <img src="@/assets/icons/filters/close.svg" alt="">
                </div>
            </div>
            <div class="body">
                <div class="title">
                    <div class="name_order">{{ pop_order.name_order }}</div>
                    <div class="sum_quntity">{{ pop_order.sum }} р.<br>{{ pop_order.quntity }}</div>
                </div>
                <div class="order_inf">
                    <div class="row"><div class="inf_label">email:</div><div class="inf_content">{{ pop_order.email }}</div></div>
                    <div class="row"><div class="inf_label">url:</div><div class="inf_content">{{ pop_order.url }}</div></div>
                </div>
                <div class="prov_data_inf">
                    <div class="prov_inf">
                        <div class="row"><div class="inf_label">Поставщик:</div><div class="inf_content">{{ pop_order.id_prov }}</div></div>
                        <div class="row"><div class="inf_label">status:</div><div class="inf_content">{{ pop_order.prov_status }}</div></div>
                        <div class="row"><div class="inf_label">message</div><div class="inf_content">{{ pop_order.prov_msg }}</div></div>
                    </div>
                    <div class="data_inf">
                        <div class="row"><div class="inf_label">Дата:</div><div class="inf_content">{{ pop_order.date }}</div></div>
                        <div class="row"><div class="inf_label">Время:</div><div class="inf_content">{{ pop_order.time }}</div></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default{
        name: 'PopupOrder',
        data(){
            return{
                transaction: "28933445",
                name_order: 'Подписчики Инстаграм лучшие HQ=18 sdsdsdsdsdsadadsdafadfefadvvdasvdadgadadsgasdgasdgadgasdg',
                sum: 100.95,
                quntity: 100,
                email: 'ermak80_pass@mail.ru',
                url: 'https://www.instagram.com/ermak80_pass?utm_source=qr&igsh=anJiMmdtcGtndTZs',
                id_prov: 5,
                prov_status: 'success',
                prov_msg: '"order":"345467662',
                date: '10-03-2024',
                time: '10:10:43',
                pop_order:{},
            }
        },
        props:{
            order:Object,
            modelValue:Boolean,
        },
        emits: ['update:modelValue'],
        watch:{
            order:{
            handler:function(order){
                this.pop_order = {
                    transaction: order.transaction,
                    name_order: order.products,
                    sum: order.sum,
                    quntity: order.quantity,
                    email: order.email,
                    url: order.link,
                    id_prov: order.id_provider,
                    prov_status: order.provader_status,
                    prov_msg: order.provader_msg,
                    datetime: order.datetime
                }
            },
            deep: true
            }
        },
        methods:{
            close(){
                this.show = false;
                this.$emit('update:modelValue', false)
            }
        }
    }
</script>

<style lang="scss" scoped>
    .popup_bg_screen{
        width: 100vw;
        height: 100vh;
        position: fixed;
        left: 0;
        top: 0;
        background-color: #16354dcc;

        .popup{
            margin: auto;
            margin-top: 200px;
            width: 1100px;
            height: 600px;
            border-radius: 10px;
            background-color: #E4E5EA;
        }

        .header{
            width: 100%;
            height: 65px;
            border-top-left-radius: 10px;
            border-top-right-radius: 10px;
            padding: 0 15px 0 40px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            background-color: #16354D;
            color: #fff;
            font-size: 24px;

            .filter_close_btn{
                width: 35px;
                height: 35px;
                img{
                    width: 100%;
                }
            }
        }

        .body{
            margin-left: 40px;
            margin-right: 40px;
            height: calc(100% - 65px);
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            .title{
                padding-top: 70px;
                display: flex;
                justify-content: space-between;
                color: #16354D;
                font-family: 'Play-Bold';
                font-size: 24px;

                .name_order{
                    max-width: 850px;
                    text-align: left;
                }
                .sum_quntity{
                    text-align: right
                }
            }

            .order_inf{
                font-size: 20px;
                color: #16354D;
                .row{
                    display: flex;

                    .inf_label{
                        width: 100px;
                        text-align: left;
                    }
                }
            }

            .prov_data_inf{
                margin-bottom: 30px;
                display: flex;
                align-items: flex-end;
                justify-content: space-between;
                font-size: 20px;
                color: #16354D;

                .prov_inf .row{
                    display: flex;

                    .inf_label{
                        width: 140px;
                        text-align: left;
                    }
                }

                .data_inf .row{
                    display: flex;

                    .inf_label{
                        width: 50px;
                        text-align: left;
                    }

                    .inf_content{
                        text-align: right;
                        width: 120px;
                    }
                }
            }
        }
    }
</style>