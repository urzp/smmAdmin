<template>
    <div class="wrap">
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
        background-color: #6B99C3;
        border-radius: 30px ;
        cursor: pointer;
        transition: 0.3s;
    }
    .wrap:hover{
        background-color: #214260;
    }

    .title{
        color: #fff;
        font-size: 20px;
    }
</style>