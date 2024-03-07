<template>
    <div class="wrap" v-bind="$attrs">
        <div class="title">{{ title }}</div>
    </div>
</template>

<script>
export default {
    name: 'ButtonStd',

    props:{
        title: String,
        width:{
            type: String,
            default: '200px'
        },
        height:{
            type: String,
            default: '45px'           
        },
        bg_color:{
            type: String,
            default: '#6B99C3',
        },
        bg_color_hover:{
            type: String,
            default: '#214260',
        }
    }

}
</script>

<style scoped>
    .wrap{
        width: v-bind(width);
        height: v-bind(height);
        display: flex;
        align-items: center;
        justify-content: center;
        background-color: v-bind(bg_color);
        border-radius: 30px ;
        cursor: pointer;
        transition: 0.3s;
    }
    .wrap:hover{
        background-color: v-bind(bg_color_hover);
    }

    .btn-right{
        float: right;
    }

    .title{
        color: #fff;
        font-size: 20px;
    }
</style>