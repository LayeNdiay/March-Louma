<template>
  <div class="lightbox"  v-if="image" @click="close">
      <transition >
        <lightbox-image :image="image" :key="image"></lightbox-image>
      </transition>
     <div class="lightbox__close" @click="close">X</div>
     <div class="lightbox__btn lightbox__next" @click.stop.prevent="next"></div>
     <div class="lightbox__btn lightbox__prev" @click.stop.prevent="prev"></div>
  </div>
</template>

<script>
import "./lightboxDirective"
import store  from "./LightboxStore"
import lightboxImage from "./LightboxImage.vue"

export default {
    components :{
        lightboxImage
    },
    data(){
        return {
            state: store.state
        }
    },
    methods : {
        close() {
            store.close()
        },
        next(){
            store.next()
        }
        ,
        prev(){
            store.prev()
        }
    },
    computed : {
        image (){
          if(this.state.index !== false)
          {
              return this.state.image[this.state.index-1]
          }
        }
    }

}
</script>

<style>
    .lightbox{
        position: fixed;
        top:0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(255, 2555, 255, 0.9);
    }
    .lightbox__close{
        position: fixed;
        font-family:  sans-serif;
        top: 20px;
        right: 20px;
        font-size: 70px;
        color: rgba(211, 20, 20, 0.438);
        transition : transform 0.7s;
        background-color: transparent;
    }
    .lightbox__close:hover,.lightbox__btn:hover{
        cursor: pointer;
        transform: scale(1.2);
    }
    .lightbox__btn{
        position:fixed;
        top :50%;
        width: 50px;
        height: 90px;
        margin-top: -40px;
        background: #eee;
    }
    .lightbox__next{
        right: 20px;
        background: url(right.svg)  no-repeat;
    }
    .lightbox__prev{
        left: 20px;
        background: url(left.svg)  no-repeat;

    }
   
</style>