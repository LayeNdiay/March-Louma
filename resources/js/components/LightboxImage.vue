<style>
.lightbox__image{
 position: fixed;
}
.lightbox__loading{
    position: fixed;
    top: 50%;
    left : 50%;
    width: 40px;
    height:40px;
    padding: 10px;
    margin-left : -20px;
    margin-top : -20px;
    background: rgba(0,0,0, 0.5);
    border-radius: 40px;

}

.lightbox__loading::after{
    content: '';
    display: block;
    width: 20px;
    height: 20px;
     border-radius:30px;
     background: #fff;
    animation: lightbox-loading 0.5s ease infinite;
}
@keyframes lightbox-loading {
    0%{
        opacity: 0.5;
        transform: scale(.5);
    }
    50%{
        opacity: 1;
        transform: scale(1) ;
    }
    0%{
        opacity: 0.5;
        transform: scale(.5);
    }
}
</style>
<template>
    <div @click.stop>
        <div v-if="loading" class="lightbox__loading"></div>
        <img :src="src" class="lightbox__image" :style="style">
    </div>
</template>
<script >

export default({
    props:{
        image: String
    },
    data(){
        return{
            loading:true,
            src:false,
            style : {},
        }
    },
    methods : {
        resizeImage  (image){
        let width = image.width
        let  height = image.height
            if (width > window.innerWidth || height > window.innerHeight ) {
                let ratio =  width/height
                let windowRatio = window.innerWidth / window.innerHeight
                if ( ratio > windowRatio ) {
                    width  = window.innerWidth
                    height = width/ratio
                }
                else{
                    height = window.innerHeight
                    width = height*ratio
                }
            }
            this.style = {
                width : width + 'px',
                height :height + 'px',
                top : ((window.innerHeight - height ) * 0.5) + "px",
                left : ((window.innerWidth - width ) * 0.5) + "px"
            }
        }
    },
    mounted(){
        let image = new window.Image()
         image.onload = ()=> {
        this.loading = false
        this.src = this.image
        this.resizeImage(image)
        }
        window.addEventListener("resize",()=>{
            this.resizeImage(image)
        })
        image.src = this.image
    }
})
</script>