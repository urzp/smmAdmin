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
                                        <img class="icon_setting_add" src="@/assets/icons/btn_add.svg" alt="">
                                        <div class="header_colum header_colum_1">Название</div>
                                        <div class="header_colum header_colum_2">Значение</div>
                                    </div>
                                    <div v-for="(item) in card.params" :key="item.id" class="setting_field_row">
                                        <div class="colum header_colum_1">{{ item.name }}</div>
                                        <div class="colum header_colum_2">{{ item.value }}</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form_test_buttons">
                            <div class="form_test"></div>
                            <div class="form_buttons">
                                <div class="test_btn">ТЕСТ</div>
                                <div class="save_btn">СОХРАНИТЬ</div>
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
export default{
    name: 'PopupSettingCardProduct',
    async mounted(){
        this.updateList()
    },
    data(){
        return{
            pop_order:{},
            providers:'',
            selectedProvider:'',
            id_servis:'',
            type_servis:'',
            list_provider_open: false,
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
        }
    },
    methods:{
        closePopup(){
            this.$emit('update:modelValue', false)
            this.list_provider_open = false
        },
        async updateList(){
            let result = await getData('getData.php',{typeData:'providers'})
            if(!this.checkResult(result)) return false
            this.providers = await result.data
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
        selectProvider(id_old){
            this.updateSelectProvider(id_old)
            this.card.id_provider = id_old;
            this.list_provider_open = false
        },
        checkResult(result){
            this.lading = false
            if (result.success) return true
            this.notFound = true
            return false
        },
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
                    color: #969696;
                }
                .header_colum_2{
                    width: 50%;
                }
            }

            .setting_field_row{
                display: flex;
                align-items: center;
                gap: 10px;     
                height: 35px;
                .header_colum_1{
                    width: 60%;
                }
                .header_colum_2{
                    width: 50%;
                }
            }
        }

    }

    .form_test_buttons{
        margin-top: 30px;
        margin-left: 30px;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        .form_test{
            width: 300px;
            height: 370px;
            background-color: #E2EFDA;
            border-radius: 20px;
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
            }
            .save_btn{
                background-color:  #4A55F0;
                color:#ffffff;
            }
        }
    }
}

</style>