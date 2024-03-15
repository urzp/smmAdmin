<template>
    <div v-show="modelValue" class="popup_bg_screen" @click.stop="close">
        <div class="popup" @click.stop="">
            <div class="header">
                <div class="h_label">Поставщик:</div>
                <div class="h_content">#{{ pop_provider.id_old }}</div>
                <div class="close_btn" @click.stop="close">
                    <img src="@/assets/icons/filters/close.svg" alt="">
                </div>
            </div>
            <div class="body">
                <div class="provider_inf">
                    <div class="row id_prov">
                        <div class="inf_label">ID:</div>
                        <input type="number" v-model="pop_provider.id_old"   />
                    </div>
                    <div class="row">
                        <div class="inf_label">url:</div>
                        <input type="text" v-model="pop_provider.name">
                    </div>
                    <div class="row api_key">
                        <div class="inf_label">api_key:</div>
                        <input type="text" v-model="pop_provider.api_key">
                        <!-- <ButtonStd title="Проверить" @click="checkApy()" :height="'35px'" class="btn-right" :bg_color="'#D9D9D9'" :font_color="'#16354D'" :bg_color_hover="'#becddc'"/> -->
                    </div>
                    <div class="row buttons">
                        <ButtonStd title="Отменить" @click.stop="close" :height="'35px'" :bg_color="'#E4E5EA'" :bg_color_hover="'#E4E5EA'" :font_color="'#16354D'" :border="'1px solid #16354D' " />
                        <ButtonStd title="Сохранить" @click="saveData" :height="'35px'"/>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { getData } from '@/servis/getData.js'
import { EventBus } from '@/servis/EventBus'
    export default{
        name: 'PopupProvider',
        data(){
            return{
                pop_provider:{},
            }
        },
        props:{
            provider_id:String,
            modelValue:Boolean,
        },
        emits: ['update:save'],
        watch:{
            modelValue(new_val){
                if(new_val){
                    this.loadData()
                }
            }
        },
        methods:{
            async loadData(){
                if(this.provider_id == 'new'){
                    this.pop_provider = {
                        id:'new',
                        id_old:'',
                        name:'',
                        api_key:''
                    }
                    return false
                }
                let result = await getData('getData.php',{typeData:'provider', provider_id:this.provider_id})
                if(!this.checkResult(result)) return false
                this.pop_provider = await result.data[0]
            },
            async saveData(){
                let result = await getData('updateData.php',{typeData:'provider', data: this.pop_provider })
                if(!this.checkResult(result)) return false
                EventBus.emit('Provader:updateList')
                this.close()
            },
            checkResult(result){
                this.lading = false
                if (result.success) return true
                this.notFound = true
                return false
            },
            async checkApy(){
                let data = {
                    key: this.pop_provider.api_key,
                    action: 'balance'
                }
                let result  = fetch(this.pop_provider.name,{
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded'
                    },
                    body: new URLSearchParams(data).toString()
                })
            },
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
            height: 400px;
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
            justify-content: center;

            .row{
                margin-top: 10px;
                margin-bottom: 10px;
            }

            input{
                width: 95%;
                height: 35px;
                text-align: left;
                padding: 0px 20px;
                border: none;
                outline:none;
                background-color: #D9D9D9;
                color: #16354D;
                border-radius: 30px;
                font-size: 18px;
            }

            .id_prov input{
                width: 70px;
                padding: 0px;
                text-align: center;
            }

            // .api_key input{
            //     width: 70%;
            //     margin-right: 15px;
            // }

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

            .buttons{
                display: flex;
                column-gap: 10px;
                justify-content: flex-end;
            }
        }
    }
</style>