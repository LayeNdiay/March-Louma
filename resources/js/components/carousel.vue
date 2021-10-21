<template>
    <div class="carousel">
        <slot></slot>
        <span class="carousel__nav carousel__nex" @click="next">  </span>
        <span class="carousel__nav carousel__prev" @click="prev"> </span>
    </div>
</template>
<script>
export default {
    data (){
        return{
            slides : [],
            index : 0,
            direction : null
        }
    },
    mounted (){
        this.slides= this.$children
        this.slides.forEach((slide,i)=> {
            slide.index = i
        })
    },
    computed :{
        nbSlide() {
            return this.slides.length
        }
    }
    ,
    methods:{
        next(){
            this.index++
            if (this.index === this.nbSlide) {
                this.index = 0
            }
            this.direction="right"
            
        },
        prev(){
            this.index --
            if (this.index < 0  ) {
                this.index = this.nbSlide - 1
            }
            this.direction="left"
        },  
        goto(index){
            this.direction = index > this.index ? 'right' : 'left'
           this.index = index
        }
    }
}
</script>

<style>
    .carousel{
        position:relative;
        overflow: hidden;
    }
    .carousel__nav{
        position: absolute;
        cursor: pointer;
        top: 50%;
        margin-top: -31px;
        background: url(left.svg) no-repeat;
        left: 10px;
        width: 30px;
        height: 30px;
    }
    .carousel__nex{
        right: 10px;
        left: auto;
        background: url(right.svg) no-repeat;

    }
    .carousel__nav:hover{
        transform: scale(1.5);
    }
    .carousel__pagination{
    position: absolute;
    bottom: 10px;
    left: 0;
    right: 0;
    text-align: center;
    background-color: #fff;

    }
    .carousel__pagination button{
        display: inline-block;
        width: 15px;
        height: 15px;
        background-color: black;
        border-radius: 50%;
        opacity: .9;
        margin-left: 10px;
    }
    .carousel__pagination button.active{
        background-color: #fff;
    }

</style>