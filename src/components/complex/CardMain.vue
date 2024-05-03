<template>
    <div class="bg_card" @mouseover="hover = true" @mouseleave="hover = false" :class="{'hover':hover}">
        <div class="title_row" :class="{'title_center':iconCentr}">
            <div v-if="!iconCentr" class="icon" >
                <slot name="small_icon"/>
            </div>
            <div class="title">{{ data.title }}</div>
        </div>
        <div class="main">
            <slot name="big_icon"/>
            <div v-if="!iconCentr" class="graphic">
                <div class="collum collum_1" @mouseover = "show_g_label(0)" @mouseleave="hover_g=false"></div>
                <div class="collum collum_2" @mouseover = "show_g_label(1)" @mouseleave="hover_g=false"></div>
                <div class="collum collum_3" @mouseover = "show_g_label(2)" @mouseleave="hover_g=false"></div>
                <div class="collum collum_4" @mouseover = "show_g_label(3)" @mouseleave="hover_g=false"></div>
                <div class="collum collum_5" @mouseover = "show_g_label(4)" @mouseleave="hover_g=false"></div>
                <div class="collum collum_6" @mouseover = "show_g_label(5)" @mouseleave="hover_g=false"></div>
                <div class="collum collum_7" @mouseover = "show_g_label(6)" @mouseleave="hover_g=false"></div>
            </div>
            <div class="hover-label" ref="hover_label" :class="{active: hover_g }">{{ g_label }}</div>
        </div>   
        <div class="footer">
            <div class="day_data">{{ data.title_day_data }} {{ data.day_data }}</div>
            <div class="line"></div>
            <div class="toatal_data">{{ data.title_total_data }} {{ data.total_data }}</div>
        </div>
    </div>
</template>

<script>

export default{
    name:'CardMain',
    async mounted(){
        if(!this.data.graphic) return false
        this.countGraphic(this.data.graphic)
        this.renderGraphic()
        document.addEventListener(`mousemove`, this.move);
    },
    data(){
        return{
            hover:false,
            hover_g:false,
            g_label:0,
            grap_1: '5px',
            grap_2: '5px',
            grap_3: '5px',
            grap_4: '5px',
            grap_5: '5px',
            grap_6: '5px',
            grap_7: '5px',
            grap_min: 5,
            grap_max: 155,
            g_data:[],
        }
    },
    props:{
        iconCentr:{
            type:Boolean,
            default:false
        },
        data:{
            type:Object,
            default:{}
        }
    },
    watch:{
        data:{
            handler(new_data){
                if(this.iconCentr) return false
                this.countGraphic(new_data.graphic)
                this.renderGraphic()
            },
            deep:true,
        }
    },
    methods:{
        countGraphic(data){
            let max_data = Math.max(...data)
            let min_data =  Math.min(...data)
            data.forEach((el,i) => {
                let y = 0
                if(max_data > 0) y = Number(el)/max_data
                this.g_data[i] = (y*(this.grap_max - this.grap_min) + this.grap_min)  + 'px'
            });
        },
        renderGraphic(){
            this.grap_1 = this.g_data[6]
            this.grap_2 = this.g_data[5]
            this.grap_3 = this.g_data[4]
            this.grap_4 = this.g_data[3]
            this.grap_5 = this.g_data[2]
            this.grap_6 = this.g_data[1]
            this.grap_7 = this.g_data[0]
        },
        show_g_label(item){
            this.g_label = this.data.graphic[6-item]
            this.hover_g = true
        },
        move(e){
            this.$refs.hover_label.style.left = `${e.pageX + 10}px`;
            this.$refs.hover_label.style.top = `${e.pageY + 10}px`;
        }

    }
}
</script>

<style lang="scss" scoped>
    .bg_card{
        width: 385px;
        height: 345px;
        padding: 20px;
        border-radius: 6px;
        background-color: #F0F0F0;
        cursor: pointer;
        transition: 0.3s;
    }
    .bg_card:hover{
        background-color: #16354D;
        box-shadow: 4px 4px 4px #00000029;
    }

    .title_row{
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    .title{
        margin-right: 45px;
        height: 60px;
        display: flex;
        align-items: center;
        font-size: 32px;
        line-height: 1.0;
        color: #253F54
    }

    .title_center{
        justify-content: center;   
        .title{
            margin-right:0;
        }
    }

    .hover{
        .title{
            color: #fff
        }
    }

    :deep(.light){
        display: block;
    }

    :deep(.dark){
        display: none;
    }

    .hover{
        :deep(.light){
            display: none!important;
        }
        :deep(.dark){
            display: block;
        }   
    }

    .main{
        height: 175px;
        display: flex;
        justify-content: center;
        align-items: center;
    }
    .graphic{
        width: 240px;
        height: 100%;
        display: flex;
        flex-direction: row;
        justify-content: space-between;
        column-gap: 9px;
        padding-top:30px;
        padding-bottom: 5px;
        align-items: flex-end;
        .collum{
            height: 100%;
            width: 25px;
            background-color: #6B99C3;
        }

        .collum_1{
            height: v-bind(grap_1);
        }

        .collum_2{
            height: v-bind(grap_2);
        }

        .collum_3{
            height: v-bind(grap_3);
        }

        .collum_4{
            height: v-bind(grap_4);
        }
        
        .collum_5{
            height: v-bind(grap_5);
        }
                
        .collum_6{
            height: v-bind(grap_6);
        }
                        
        .collum_7{
            height: v-bind(grap_7);
        }
    }

    .hover-label{
        position: absolute;
        width: 90px;
        height: 35px;
        background-color: #D3EAFF;
        display: flex;
        justify-content: center;
        align-items: center;
        color: #16354D;
        font-size: 18px;
        border-radius: 6px;
        box-shadow: 4px 4px 5px 2px #06243A;
        display: none;
    }

    .hover-label.active{
        display: flex;
    }

    .footer{
        display: flex;
        flex-direction: column;
        align-items: center;
    
        .day_data{
            height: 42px;
            font-size: 26px;
            color: #6B99C3;
        }
        .line{
            width: 160px;
            margin-top: -5px;
            border: 1px solid #253F54;
        }
        .toatal_data{
            margin-top: -10px;
            font-size: 28px;
            color: #253F54
        }
    }

    .hover{
        .line{
            border-color:#fff;
        }
        .toatal_data{
            color:#fff;
        }
    }
</style>