<template>
    <div class="h_colum">
        <div class="h_c_title" :class="{'pointer':type_f!='','filter_active':f_val!=''}" @click="show=true">{{ title }}</div>
        <FilterTrueFalse v-if="type_f=='true_false'" :show="show" v-model="f_val" :l_true="l_true" :l_false="l_false" :left="f_left"/>
        <FilterFind v-if="type_f=='find'" :show="show" v-model="f_val" :left="f_left"/>
        <FilterDate v-if="type_f=='date'" :show="show" v-model="f_date_val"/>
    </div>
</template>

<script>
export default{
    name:'h_colum',
    data(){
        return{
            show:false,
            f_val:'',
            f_date_val:this.modelValue,
        }
    },
    props:{
        modelValue:[String, Object],
        click_hand:{
            type:Boolean,
            default: false,
        },
        type_f:{
            type:String,
            default: '',
        },
        title:String,
        l_true:{
            type:String,
            default: 'success',
        },
        l_false:{
            type:String,
            default: 'fall',
        },
        f_left:{
            type:Boolean,
            default:false,
        }

    },
    emits: ['update:modelValue'],
    watch:{
        f_val(n_val){
            this.$emit('update:modelValue', n_val)
        },
        f_date_val(n_val){
            this.$emit('update:modelValue', n_val)
        },
        click_hand(){
            this.show = true
        }
    },
}
</script>

<style scoped>
    .pointer{
        cursor: pointer;
    }
    .filter_active{
        color:#16354D;
        font-family: 'Play-Bold';
    }
    .h_colum{
        -webkit-touch-callout: none; 
        -webkit-user-select: none; 
        -khtml-user-select: none; 
        -moz-user-select: none; 
        -ms-user-select: none; 
        user-select: none; 
    }
</style>