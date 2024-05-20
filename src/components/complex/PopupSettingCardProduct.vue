<template>
    <div v-show="modelValue" class="popup_bg_screen" @click.stop="thisClose">
        <div class="popup" >
            <div class="close_btn" @click.stop="closePopup">
                    <img src="@/assets/icons/filters/close.svg" alt="">
            </div>
            <div class="content_wrap">
                <div class="card">
                    <div class="icon" :style="{'background-image': 'url('+card.img+')'}"></div>
                    <div class="title">{{ card.title }}</div>
                    <div class="discription">{{ card.description }}</div>
                    <div class="price">{{ card.price_title }}</div>
                    <div class="button"><div class="icon_btn"></div>НАСТРОИТЬ</div>
                </div>
                <div class="settings">
                    <div class="title_settings">Настройка сервиса</div>
                    <div class="servis_content_wrap">
                        <div class="form_content">
                            <div class="provider_form">
                                <div class="title_field_form">Провайдер:</div>
                                <div class="provider_field" @click="list_provider_open=!list_provider_open">
                                    <div class="icon_btn_list_provider" ><img src="@/assets/icons/btn_list.svg" alt=""></div>
                                    <div v-if="!!selectedProvider" class="content_provider">
                                        <div class="id_provider_selected">{{ selectedProvider.id_old }}</div>
                                        <div class="name_provider_selected">{{ selectedProvider.name}}</div>
                                    </div>
                                </div>
                                <div class="list_providers_wrap">
                                    <div class="list_providers" :class="{close:!list_provider_open}">
                                        <div v-for="(item) in providers" :key="item.id" class="row_provider" @click="selectProvider(item.id_old)">
                                            <div class="id_provider">{{ item.id_old }}</div>
                                            <div class="name_provider">{{ item.name }}</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="id_sevis_and_type_form">
                                <div class="id_sevis_form">
                                    <div class="title_field_form">ID servis:</div>
                                    <input class="id_sevis_field" type="text" v-model="id_servis">
                                </div>
                                <div class="id_type_form">
                                    <div class="title_field_form">Type:</div>
                                    <input class="id_sevis_field" type="text" v-model="type_servis">
                                </div>
                            </div>
                            <div class="settings_form">
                                <div class="title_field_form">Параметры:</div>
                                <div class="settings_field">
                                    <div class="settings_field_header">
                                        <img class="icon_setting_add" src="@/assets/icons/btn_add.svg" alt="" @click="addParams()">
                                        <div class="header_colum header_colum_1">Название</div>
                                        <div class="header_colum header_colum_2">Значение</div>
                                    </div>
                                    <div class="settings_fields_content">
                                        <div v-for="(item, index) in card_params" :key="item.id" class="setting_field_row">
                                            <img class="icon_setting_delete" src="@/assets/icons/btn_delete.svg" alt="" @click="deletePrams(index)">
                                            <input class="colum header_colum_1" type="text" :value="item.name" @input="event => setParams( event.target.value, 'name' , index ) " >
                                            <input class="colum header_colum_2" type="text" :value="item.value" @input="event => setParams( event.target.value, 'value' , index ) " >
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
<!-- --------------------- TEST Panel------------------------------------------- -->
                        <div class="form_test_buttons">
                            <div class="form_test">
                                <div class="title_test_form">Тест настроек</div>
                                <div class="main_test_settings">
                                    <div class="setting_wrap">
                                        <div class="test_name_setting">Провайдер:</div>
                                        <div class="test_value_settings">{{ selectedProvider?selectedProvider.id:'-' }}</div>
                                    </div>
                                    <div class="setting_wrap">
                                        <div class="test_name_setting">id servis:</div>
                                        <div class="test_value_settings">{{ id_servis }}</div>
                                    </div>
                                </div>
                                <div v-if="card_params.length > 0" class="subtitle_test_form">Параметры:</div>
                                <div class="params_test_settings">
                                    <div v-for="(item) in card_params"  :key="item.id" class="setting_wrap" >
                                        <div class="test_name_setting">{{ item.name }}:</div>
                                        <div class="test_value_settings">{{ item.value }}</div>
                                    </div>                                    
                                </div>
                                <div class="subtitle_test_form subtitle_test_form_user">
                                    <img class="icon_setting_add" src="@/assets/icons/btn_add.svg" alt="" @click="addTestParams()">
                                    Параметры клиента:
                                </div>
                                <div class="params_test_settings_user">
                                    <div v-for="(item, index) in for_test_params"  :key="item.id" class="setting_wrap" >
                                        <img v-if="index!=1&&index!=0" class="icon_setting_delete" src="@/assets/icons/btn_delete.svg" alt="" @click="deleteTestPrams(index)">
                                            <div class="wrap_test_params">
                                                <input class="prams_for_test prams_for_test_name" type="text" :value="item.name" @input="event => setTestParams( event.target.value, 'name' , index ) " >
                                                <input class="prams_for_test prams_for_test_name_vlaue" type="text" :value="item.value" @input="event => setTestParams( event.target.value, 'value' , index ) " >
                                            </div>    
                                    </div>                                    
                                </div>
                                <div v-if="showResult" class="result_test">
                                    <div class="subtitle_test_form subtitle_test_form_user">Ответ</div>
                                    <div class="setting_wrap">
                                        <div class="test_name_setting">Статус:</div>
                                        <div class="test_value_settings">{{ resultTest.status }}</div>
                                    </div>
                                    <div class="setting_wrap">
                                        <div class="test_name_setting">Сообщение:</div>
                                    </div>
                                    <div class="setting_wrap">
                                        <div class="test_value_settings result_message">{{ resultTest.message }}</div>
                                    </div>
                                </div>
                            </div>
                            <div class="form_buttons">
                                <div class="test_btn" @click="runTest()" >ТЕСТ</div>
                                <div class="save_btn" @click="saveSettings()">СОХРАНИТЬ</div>
                            </div>
                        </div>
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
    name: 'PopupSettingCardProduct',
    async mounted(){
        this.updateList()
        EventBus.on('test:result', (result)=>{
            this.updateResult(result)
        })
    },
    data(){
        return{
            pop_order:{},
            providers:'',
            list_provider_open: false,
            selectedProvider:'',
            id_servis:'',
            type_servis:'',
            card_params:'',
            card_params_to_delete:[],
            resultTest:'',
            showResult:false,
            for_test_params:[
                {
                 id:0,
                 name:'post-link',
                 value:'www.exsample.com'   
                },
                {
                id:1,
                name:'quantity',
                value: 10
                },
            ],
            
            
        }
    },
    props:{
        card:Object,
        modelValue:Boolean, //open_close
    },
    emits: ['update:modelValue'],
    watch:{
        modelValue(){
            this.updateSelectProvider(this.card.id_provider)
            this.update_id_servis()
            this.update_type_servis()
            this.update_card_params()
        }
    },
    methods:{
        closePopup(){
            this.$emit('update:modelValue', false)
            this.list_provider_open = false
            this.showResult = false
        },
        async updateList(){
            let result = await getData('getData.php',{typeData:'providers'})
            if(!this.checkResult(result)) return false
            this.providers = await result.data
        },
        checkResult(result){
            this.lading = false
            if (result.success) return true
            this.notFound = true
            return false
        },
        updateSelectProvider(id_provider){
            this.selectedProvider = this.providers.find(item => item.id_old == id_provider);
        },
        update_id_servis(){
            this.id_servis = this.card.id_servis
        },
        update_type_servis(){
            this.type_servis = this.card.type
        },
        update_card_params(){
            this.card_params = []
            this.card.params.forEach( (el) => {
                let new_el = {...el}
                this.card_params.push(new_el)
            });
        },
        selectProvider(id_old){
            this.updateSelectProvider(id_old)
            this.card.id_provider = id_old;
            this.list_provider_open = false
        },
        setParams(val, type, index){
            if(type == 'name') this.card_params[index].name = val
            if(type == 'value') this.card_params[index].value = val
        },
        addParams(){
            let newParam ={
                id: 'new',
                id_card: this.card.id,
                name: 'name',
                value: 'value'
            }
            this.card_params.push(newParam)
        },
        deletePrams(index){
            this.card_params_to_delete.push(this.card_params[index].id)
            this.card_params.splice(index,1)
        },
        async saveSettings(){
            let data = {}
            data.id = this.card.id
            data.id_provider = this.card.id_provider
            data.type = this.type_servis
            data.id_servis = this.id_servis
            data.params = await this.card_params
            data.card_params_to_delete = this.card_params_to_delete
            let result = await getData('updateData.php',{typeData:'cardProduct', data})
            if(!this.checkResult(result)) return false
            EventBus.emit('cardProduct:saved')
            this.closePopup();
        },
        addTestParams(){
            let id = this.for_test_params.length
            let newParam ={
                id,
                id_card: this.card.id,
                name: 'name',
                value: 'value'
            }
            this.for_test_params.push(newParam)
        },
        setTestParams(val, type, index){
            if(type == 'name') this.for_test_params[index].name = val
            if(type == 'value') this.for_test_params[index].value = val
        },
        deleteTestPrams(index){
            this.for_test_params.splice(index,1)
        },
        async _runTest(){
            let data = {}
            this.for_test_params.forEach(item=>{
                data[item.name]=item.value
            })
            this.card_params.forEach(item=>{
                data[item.name]=item.value
            })
            let result = await getData('getData.php', {typeData:'testReqProvider', id_old_provider:this.card.id_provider , data })
        },
        async runTest(){
            // $_POST["api_k"] = 0234$567DAs
            // $_POST['paymentsystem']
            // $_POST['payment']

            // $_POST['type']
            // $_POST['comments']
            // $POST['prodavec_id']
            // $_POST['service']
            // $_POST['post-link']
            // $_POST['quantity']
             //let payment = '{\"orderid\":\"test\",\"products\":[\"Реакции Телеграм: Сердце=4.72\"],\"amount\":\"100\"}'
            
            let url = "https://smmbackmy.ru/php/outcom_payment.php"

            //let url = 'https://smmbackmy.ru/php_admin/test.php'
            let quntity = this.for_test_params.find((el)=>{ return el.name == 'quantity' }).value
            let amount = Number(this.card.price)*quntity

            let paymentObj = {
                orderid: 'testing',
                products: [this.card.title],
                amount: amount,
            }

            let payment = JSON.stringify(paymentObj);

            let data ={
                api_k: '0234$567DAs',
                paymentsystem: 'no',
                payment,
                type: this.card.type,
                prodavec_id: this.selectedProvider.id_old,
                service: this.id_servis,
            }

            this.for_test_params.forEach(item=>{
                data[item.name]=item.value
            })
            this.card_params.forEach(item=>{
                data[item.name]=item.value
            })

            let xhr = new XMLHttpRequest()
            let body = this.bodyPost(data)

            this.resultTest

            xhr.open("POST", url, true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            xhr.onreadystatechange = function() {//Call a function when the state changes.
                if(xhr.readyState == 4 && xhr.status == 200) {                   
                    let result =  JSON.parse(xhr.responseText) ;  
                    result.message = result.message.replace("{", "").replace("}", "")
                    EventBus.emit('test:result', result)            
                }
            }
            xhr.send(body);

        },
        bodyPost(data){
            let result =''
            let and_sumbol = ''
            Object.keys(data).forEach(key=>{
                result = result + and_sumbol + key + '=' + encodeURIComponent(data[key])
                and_sumbol = '&'
            })
            return result
        },
        updateResult(result){
            this.resultTest = result
            this.showResult = true
        }
    },

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
}

.popup{
    margin: auto;
    margin-top: 200px;
    padding-top: 10px;
    width: 1200px;
    height: 600px;
    border-radius: 30px;
    background-color: #FFFFFF;
}

.close_btn{
    margin-top: 10px;
    margin-left: auto;
    margin-right: 20px;
    width: 35px;
    height: 35px;
    cursor: pointer;
    img{
        width: 100%;
    }
}

.content_wrap{
    display: flex;
}

.card{
    width: 360px;
    height: 500px;
    border-right: 1px solid #D2D2D2;
    padding-left: 30px;
    padding-right: 30px;
}

.icon{
    height: 90px;
    width: 90px;
    margin: 0 auto;
    background-repeat: no-repeat;
    background-position: center;
    background-size: contain;
}

.title{
    margin-top: 40px;
    margin-bottom: 25px;
    height: 52px;
    font-size: 20px;
    line-height: 30px;
}

.discription{
    margin-top: 18px;
    height: 120px;
    font-family: 'TildaSans';
    font-weight: 300;
    font-size: 14px;
    line-height: 1.3;
}

.price{
    margin-top: 25px;
    font-size: 20px;
}

.button{
    height: 45px;
    width: 150px;
    margin: auto;
    margin-top: 34px;
    display: flex;
    color: #fff;
    font-size: 14px;
    background-color: #4555f0;
    border-radius: 50px;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    opacity: 0.3;

    .icon_btn{
    background-image: url('../../assets/icons/menu_left/settings_w.svg');
    width: 20px;
    height: 20px;
    margin-right: 5px;
    background-repeat: no-repeat;
    background-position: center;
    background-size: contain;
    }
}

.settings{
    margin-left: 45px;
    width: 60%;
    
    .title_settings{
        text-align: center;
        font-family: 'TildaSansBold';
        font-size: 24px;
        margin-top: 0px;
    }

    .servis_content_wrap{
        display: flex;
    }

    .form_content{
        width: 400px;
        
        .title_field_form{
            font-family: 'TildaSans';
            font-size: 14px;
            text-align: left;
            color: #969696;
            margin-bottom: 5px;
        }

        .provider_form, .id_sevis_and_type_form{
            position: relative;
            margin-bottom: 20px;
        }

        .id_sevis_and_type_form{
            display: flex;
            justify-content: flex-start;
            gap: 20px;
        }

        .provider_field, .id_sevis_field{
            position: relative;
            z-index: 10;
            height: 36px;
            display: flex;
            align-items: center;
            gap: 10px;
            background-color: #F4F4F4;
            border-radius: 30px;
        }
        .id_sevis_field{
            z-index: 0;
            border: none;
            text-align: center;
            font-family: 'TildaSansBold';
        }

        .icon_btn_list_provider{
            margin-left: 10px;
            width: 30px;
            border-right: 1px solid #D2D2D2;
            cursor: pointer;
        }

        .content_provider{
            display: flex;
            gap: 5px;
            color: #383838;
        }

        .list_providers_wrap{
            z-index: 1;
            position: absolute;
            top: 45px;
            .list_providers{
                padding-top: 25px;
                padding-left: 20px;
                padding-bottom: 20px;
                overflow-x: hidden;
                overflow-y: auto;
                border-bottom-left-radius: 20px;
                border-bottom-right-radius: 20px;
                height: 420px;
                width: 390px;
                background-color: #eaeaea;
                .row_provider{
                    display: flex;
                    gap: 10px;
                    color: #818181;
                    font-family: "TildaSans";
                    font-weight: 400;
                    cursor: pointer;
                }
            }

            .list_providers.close{
                display: none;
            }
        }

        .settings_field{
            background-color: #F4F4F4;
            border-radius: 20px;
            height: 270px;
            padding: 10px 20px;
            .settings_field_header{
                margin-bottom: 10px;
                display: flex;
                align-items: center;
                gap: 10px;
                border-bottom: 1px solid #D2D2D2;
                color: #969696;
                height: 35px;
                .icon_setting_add{
                    cursor: pointer;
                }

                .header_colum_1{
                    width: 50%;
                    border-right: 1px solid #D2D2D2;
                    color: #969696
                }
                .header_colum_2{
                    width: 50%;
                }
            }

            .settings_fields_content{
                overflow-x: hidden;
                overflow-y: auto;     
                height: 205px;          
            }

            .icon_setting_delete{
                cursor: pointer;
                opacity: 0.3;
                transition: 0.3s;
            }

            .icon_setting_delete:hover{
                opacity: 1.0;
            }

            .setting_field_row{
                display: flex;
                align-items: center;
                gap: 10px;     
                height: 30px;
                .header_colum_1{
                    width: 60%;
                }
                .header_colum_2{
                    width: 50%;
                }
            }
        }

    }

    input.colum{
        border: none;
        text-align: center;
        font-family: 'TildaSansBold';
        background-color: #F4F4F4;
    }

    .form_test_buttons{
        margin-top: 30px;
        margin-left: 30px;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        .form_test{
            padding: 10px 20px;
            width: 300px;
            height: 370px;
            background-color: #E2EFDA;
            border-radius: 20px;



            .title_test_form, .subtitle_test_form{
                color: #686868;
            }



            .subtitle_test_form{
                text-align: left;
                display: flex;
                gap: 10px;
                
            }

            .setting_wrap{
                display: flex;
                gap: 10px;
                font-family: "TildaSans";
                .test_name_setting{
                    color: #969696;
                }
            }

            .wrap_test_params{
                margin: 5px 0;
                display: flex;
                flex-direction: column;
                gap: 2px;
            }

            .icon_setting_add, .icon_setting_delete{
                cursor: pointer;
            }

            .icon_setting_delete{
                cursor: pointer;
                opacity: 0.3;
                transition: 0.3s;
            }

            .icon_setting_delete:hover{
                opacity: 1.0;
            }

            .prams_for_test{
                border: none;
                width: 100%;
                color:#969696;
                background-color: transparent;
            }

            .prams_for_test_name_vlaue{
                color:#0C151C;
            }
        }

        .form_buttons{
            display: flex;
            justify-content: space-around;
            div{
                border-radius: 30px;
                height: 45px;
                width: 135px;
                display: flex;
                align-items: center;
                justify-content: center;
            }
            .test_btn{
                border: 1px solid #4A55F0;
                color:#4A55F0;
                cursor: pointer;
            }
            .save_btn{
                background-color:  #4A55F0;
                color:#ffffff;
                cursor: pointer;
            }
        }
    }
}


.form_test{
    overflow-x: hidden;
    overflow-y: auto;
    height: 155px
}

.main_test_settings, .params_test_settings{
    margin-bottom: 10px;
}

.subtitle_test_form_user{
    padding-bottom: 10px;
    border-bottom: 1px solid #D2D2D2;   
}
.result_test{
    margin-top: 30px;

    .result_message{
        text-align: left;
    }
    
}
</style>