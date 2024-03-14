<template>
    <div v-show="modelValue" class="popup_bg_screen" @click.stop="close">
        <div class="popup" @click.stop="">
            <div class="header">
                <div class="h_label">Поставщик:</div>
                <div class="h_content">#{{ pop_provider.id }}</div>
                <div class="close_btn" @click.stop="close">
                    <img src="@/assets/icons/filters/close.svg" alt="">
                </div>
            </div>
            <div class="body">
                <div class="title">
                    <div class="name_provider"></div>
                    <div class="sum_quntity"></div>
                </div>
                <div class="provider_inf">
                    <div class="row"><div class="inf_label">url:</div><div class="inf_content">{{ pop_provider.url }}</div></div>
                    <div class="row"><div class="inf_label">api_key:</div><div class="inf_content">{{ pop_provider.api_key }}</div></div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default{
        name: 'PopupProvider',
        data(){
            return{
                pop_provider:{},
            }
        },
        props:{
            provider:Object,
            modelValue:Boolean,
            userMode:{
                type:Boolean,
                default: false,
            }
        },
        emits: ['update:modelValue'],
        watch:{
            provider:{
            handler:function(provider){
                this.pop_provider = {
                    id: provider.id,
                    id_old: provider.id_old,
                    url: provider.url,
                    apy_key: provider.apy_key,
                }
                if(this.userMode){
                    this.pop_provider.transaction =  provider.trnsaction
                    this.pop_provider.user_email = provider.user_email
                    this.pop_provider.user_id = provider.id_user
                    this.pop_provider.email = provider.form_email
                    this.pop_provider.url = provider.form_link
                }
                for (let key in this.pop_provider){
                    this.pop_provider[key] = this.ifEmpty( this.pop_provider[key])
                };
            },
            deep: true
            }
        },
        methods:{
            close(){
                this.show = false;
                this.$emit('update:modelValue', false)
            },
            clearSumbols(st){
                return st.replace(/['"{}]+/g , '')
            },
            ifEmpty(val){
                if(val=='') val='-'
                return val
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

            .close_btn{
                width: 35px;
                height: 35px;
                cursor: pointer;
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

                .name_provider{
                    max-width: 850px;
                    text-align: left;
                }
                .sum_quntity{
                    text-align: right
                }
            }

            .provider_inf{
                font-size: 20px;
                color: #16354D;
                .row{
                    display: flex;

                    .inf_label{
                        width: 100px;
                        text-align: left;
                    }
                }
                .user{
                    cursor: pointer;
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