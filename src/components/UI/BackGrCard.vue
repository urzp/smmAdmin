<template>
    <div class="bg_card">
        <div class="bg_card_wrap">
            <slot/>
        </div>
    </div>
</template>

<script>
export default {
    name: 'BackGrCard',
    props:{
        title: String,
        width:{
            type: String,
            default: '100%'
        },
        height:{
            type: String,
            default: '300px'           
        },
        bg_color:{
            type: String,
            default: '#F0F0F0',
        },
        bg_color_hover:{
            type: String,
            default: '#F0F0F0',
        },
        border_radius:{
            type: String,
            default: '5px',
        },

    }
}
</script>

<style lang="scss" scoped>
.bg_card{
    width: v-bind(width);
    min-height: v-bind(height);
    background-color: v-bind(bg_color);
    border-radius: 5px;
    transition: 0.3s;
    border-radius: v-bind(border_radius);
}
.bg_card:hover{
    background-color: v-bind(bg_color_hover);
}
.bg_card_wrap{
    padding: 20px 30px;
    margin-bottom: 20px;
}
</style>