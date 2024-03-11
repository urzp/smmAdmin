<template>
    <div class="wrap" v-bind="$attrs">
        <div class="title">{{ title }}</div>
        <slot/>
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
        border:{
            type: String,
            default: 'none',
        },
        border_color:{
            type: String,
            default: '#6B99C3',
        },
        bg_color_hover:{
            type: String,
            default: '#214260',
        },
        font_size:{
            type: String,
            default: '20px',          
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
        border: v-bind(border);
        border-color: v-bind(border_color);
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
        margin-left: auto;
    }

    .title{
        color: #fff;
        font-size: v-bind(font_size);
    }
</style>